<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webkul\CMS\Models\Page;
use Webkul\Recipe\Repositories\RecipeRepository;
use Webkul\Product\Repositories\ProductRepository;

class MigrateRecipes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bagisto:migrate-recipes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate recipes from CMS Pages to the new Recipe module';

    protected $recipeRepository;
    protected $productRepository;

    public function __construct(RecipeRepository $recipeRepository, ProductRepository $productRepository)
    {
        parent::__construct();
        $this->recipeRepository = $recipeRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cmsPages = Page::with('translations')->get()->filter(function ($page) {
            return strpos($page->url_key, 'recipes/') === 0;
        });

        if ($cmsPages->isEmpty()) {
            $this->info('No CMS recipes found to migrate.');
            return 0;
        }

        $this->info("Found {$cmsPages->count()} recipes to migrate.");

        foreach ($cmsPages as $cmsPage) {
            $this->line("Migrating: {$cmsPage->url_key}");

            // Default image
            $featuredImage = null;
            $linkedProductUrls = [];

            // We will collect translations data
            $translationsData = [];

            foreach ($cmsPage->translations as $translation) {
                $html = $translation->html_content;
                
                $ingredients = [];
                $instructions = [];
                
                if ($html) {
                    $dom = new \DOMDocument();
                    @$dom->loadHTML('<?xml encoding="utf-8" ?>' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

                    // Extract first image
                    if (!$featuredImage) {
                        $images = $dom->getElementsByTagName('img');
                        if ($images->length > 0) {
                            $featuredImage = $images->item(0)->getAttribute('src');
                            // Strip /storage/ prefix if present
                            $featuredImage = str_replace('/storage/', '', $featuredImage);
                        }
                    }

                    // Extract links to products
                    $links = $dom->getElementsByTagName('a');
                    foreach ($links as $link) {
                        $href = $link->getAttribute('href');
                        // hrefs might be like "/organic-moringa-leaf-powder"
                        $href = ltrim(parse_url($href, PHP_URL_PATH), '/');
                        if (!empty($href)) {
                            $linkedProductUrls[] = $href;
                        }
                    }

                    // Extract ingredients (<ul><li>)
                    $uls = $dom->getElementsByTagName('ul');
                    if ($uls->length > 0) {
                        $lis = $uls->item(0)->getElementsByTagName('li');
                        foreach ($lis as $li) {
                            $ingredients[] = trim($li->textContent);
                        }
                    }

                    // Extract instructions (<ol><li>)
                    $ols = $dom->getElementsByTagName('ol');
                    if ($ols->length > 0) {
                        $lis = $ols->item(0)->getElementsByTagName('li');
                        foreach ($lis as $li) {
                            $instructions[] = trim($li->textContent);
                        }
                    }
                }

                $translationsData[$translation->locale] = [
                    'name'             => $translation->page_title,
                    'url_key'          => $translation->url_key,
                    'description'      => $translation->meta_description, // Defaulting description to meta
                    'ingredients'      => $ingredients,
                    'instructions'     => $instructions,
                    'meta_title'       => $translation->meta_title,
                    'meta_description' => $translation->meta_description,
                    'meta_keywords'    => $translation->meta_keywords,
                ];
            }

            // Create Recipe
            $recipeData = [
                'status'         => 1,
                'featured_image' => $featuredImage,
                'prep_time'      => 10, // Default values
                'cook_time'      => 0,
                'difficulty'     => 1,
                'servings'       => 1,
            ];

            foreach ($translationsData as $locale => $data) {
                foreach ($data as $key => $value) {
                    $recipeData[$locale][$key] = $value;
                }
            }

            $recipe = $this->recipeRepository->create($recipeData);

            // Link products
            $linkedProductUrls = array_unique($linkedProductUrls);
            $productIdsToSync = [];
            foreach ($linkedProductUrls as $url) {
                $product = $this->productRepository->whereTranslation('url_key', $url)->first();
                if ($product) {
                    $productIdsToSync[] = $product->id;
                }
            }

            if (!empty($productIdsToSync)) {
                $recipe->products()->sync($productIdsToSync);
                $this->line("Linked to products: " . implode(', ', $productIdsToSync));
            }

            // Delete CMS page
            $cmsPage->delete();
            $this->info("Successfully migrated and deleted CMS Page: {$cmsPage->url_key}");
        }

        $this->info('Migration completed successfully.');
        return 0;
    }
}
