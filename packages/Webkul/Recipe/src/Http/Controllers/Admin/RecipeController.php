<?php

namespace Webkul\Recipe\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Webkul\Recipe\Repositories\RecipeRepository;
use Webkul\Product\Repositories\ProductRepository;

class RecipeController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $recipeRepository;
    protected $productRepository;

    public function __construct(
        RecipeRepository $recipeRepository,
        ProductRepository $productRepository
    ) {
        $this->recipeRepository = $recipeRepository;
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        if (request()->ajax()) {
            return app(\Webkul\Recipe\DataGrids\RecipeDataGrid::class)->toJson();
        }

        return view(request('_config.view'));
    }

    public function create()
    {
        $products = $this->productRepository->all();

        return view(request('_config.view'), compact('products'));
    }

    public function store()
    {
        $this->validate(request(), [
            'name'        => 'required',
            'url_key'     => 'required|unique:recipe_translations,url_key',
            'description' => 'nullable',
        ]);

        $data = request()->all();

        if (request()->hasFile('featured_image')) {
            $data['featured_image'] = request()->file('featured_image')->store('recipes');
        }

        // Process ingredients array
        if (isset($data['ingredients']) && is_string($data['ingredients'])) {
            $data['ingredients'] = array_filter(array_map('trim', explode("\n", $data['ingredients'])));
        }

        // Process instructions array
        if (isset($data['instructions']) && is_string($data['instructions'])) {
            $data['instructions'] = array_filter(array_map('trim', explode("\n", $data['instructions'])));
        }

        $locale = app()->getLocale();
        $recipeData = [
            'status'         => $data['status'] ?? 0,
            'featured_image' => $data['featured_image'] ?? null,
            'prep_time'      => $data['prep_time'] ?? 0,
            'cook_time'      => $data['cook_time'] ?? 0,
            'difficulty'     => $data['difficulty'] ?? 1,
            'servings'       => $data['servings'] ?? 1,
            $locale          => [
                'name'             => $data['name'],
                'url_key'          => $data['url_key'],
                'description'      => $data['description'] ?? '',
                'ingredients'      => $data['ingredients'] ?? [],
                'instructions'     => $data['instructions'] ?? [],
                'meta_title'       => $data['meta_title'] ?? $data['name'],
                'meta_description' => $data['meta_description'] ?? $data['description'] ?? '',
                'meta_keywords'    => $data['meta_keywords'] ?? '',
            ],
        ];

        $recipe = $this->recipeRepository->create($recipeData);

        if (! empty($data['product_ids'])) {
            $recipe->products()->sync($data['product_ids']);
        }

        \Spatie\ResponseCache\Facades\ResponseCache::forget('/');

        session()->flash('success', 'Recipe created successfully.');

        return redirect()->route(request('_config.redirect'));
    }

    public function edit($id)
    {
        $recipe = $this->recipeRepository->with(['translations', 'products'])->findOrFail($id);
        $products = $this->productRepository->all();

        return view(request('_config.view'), compact('recipe', 'products'));
    }

    public function update($id)
    {
        $this->validate(request(), [
            'name'        => 'required',
            'url_key'     => 'required|unique:recipe_translations,url_key,' . $id . ',recipe_id',
            'description' => 'nullable',
        ]);

        $data = request()->all();
        $recipe = $this->recipeRepository->findOrFail($id);

        if (request()->hasFile('featured_image')) {
            if ($recipe->featured_image) {
                Storage::delete($recipe->featured_image);
            }
            $data['featured_image'] = request()->file('featured_image')->store('recipes');
        } else {
            $data['featured_image'] = $recipe->featured_image;
        }

        if (isset($data['ingredients']) && is_string($data['ingredients'])) {
            $data['ingredients'] = array_filter(array_map('trim', explode("\n", $data['ingredients'])));
        }

        if (isset($data['instructions']) && is_string($data['instructions'])) {
            $data['instructions'] = array_filter(array_map('trim', explode("\n", $data['instructions'])));
        }

        $locale = app()->getLocale();
        $recipeData = [
            'status'         => $data['status'] ?? 0,
            'featured_image' => $data['featured_image'],
            'prep_time'      => $data['prep_time'] ?? 0,
            'cook_time'      => $data['cook_time'] ?? 0,
            'difficulty'     => $data['difficulty'] ?? 1,
            'servings'       => $data['servings'] ?? 1,
            $locale          => [
                'name'             => $data['name'],
                'url_key'          => $data['url_key'],
                'description'      => $data['description'] ?? '',
                'ingredients'      => $data['ingredients'] ?? [],
                'instructions'     => $data['instructions'] ?? [],
                'meta_title'       => $data['meta_title'] ?? $data['name'],
                'meta_description' => $data['meta_description'] ?? $data['description'] ?? '',
                'meta_keywords'    => $data['meta_keywords'] ?? '',
            ],
        ];

        $this->recipeRepository->update($recipeData, $id);

        if (isset($data['product_ids'])) {
            $recipe->products()->sync($data['product_ids']);
        } else {
            $recipe->products()->sync([]);
        }

        \Spatie\ResponseCache\Facades\ResponseCache::forget('/');

        session()->flash('success', 'Recipe updated successfully.');

        return redirect()->route(request('_config.redirect'));
    }

    public function destroy($id)
    {
        $this->recipeRepository->delete($id);

        \Spatie\ResponseCache\Facades\ResponseCache::forget('/');

        return response()->json(['message' => 'Recipe deleted successfully.']);
    }
}
