<?php

namespace Webkul\Recipe\Http\Controllers\Shop;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Webkul\Recipe\Repositories\RecipeRepository;

class RecipeController extends Controller
{
    use DispatchesJobs, ValidatesRequests;

    protected $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    public function index()
    {
        return view(request('_config.view'));
    }

    public function view($urlKey)
    {
        $cleanKey = ltrim($urlKey, '/');
        $rawKey = str_replace('recipes/', '', $cleanKey);
        $recipesKey = 'recipes/' . $rawKey;

        $recipe = $this->recipeRepository->getModel()
            ->where('status', 1)
            ->whereHas('translations', function ($query) use ($cleanKey, $recipesKey, $rawKey) {
                $query->whereIn('url_key', [$cleanKey, $recipesKey, $rawKey]);
            })
            ->firstOrFail();

        return view(request('_config.view'), compact('recipe'));
    }
}
