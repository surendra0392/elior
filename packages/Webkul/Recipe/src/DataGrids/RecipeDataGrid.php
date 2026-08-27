<?php

namespace Webkul\Recipe\DataGrids;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class RecipeDataGrid extends DataGrid
{
    /**
     * Primary column.
     *
     * @var string
     */
    protected $primaryColumn = 'id';

    /**
     * Prepare query builder.
     *
     * @return Builder
     */
    public function prepareQueryBuilder()
    {
        $currentLocale = app()->getLocale();

        $queryBuilder = DB::table('recipes')
            ->select(
                'recipes.id',
                'recipe_translations.name',
                'recipe_translations.url_key',
                'recipes.status',
                'recipes.prep_time',
                'recipes.difficulty',
                'recipes.created_at'
            )
            ->leftJoin('recipe_translations', function ($leftJoin) use ($currentLocale) {
                $leftJoin->on('recipes.id', '=', 'recipe_translations.recipe_id')
                    ->where('recipe_translations.locale', '=', $currentLocale);
            });

        $this->addFilter('id', 'recipes.id');
        $this->addFilter('name', 'recipe_translations.name');
        $this->addFilter('status', 'recipes.status');

        return $queryBuilder;
    }

    /**
     * Prepare columns.
     *
     * @return void
     */
    public function prepareColumns()
    {
        $this->addColumn([
            'index'      => 'id',
            'label'      => trans('admin::app.datagrid.id'),
            'type'       => 'integer',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'name',
            'label'      => trans('admin::app.datagrid.name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'prep_time',
            'label'      => 'Prep Time (Mins)',
            'type'       => 'integer',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                return ($row->prep_time ?? 0) . ' mins';
            },
        ]);

        $this->addColumn([
            'index'      => 'difficulty',
            'label'      => 'Difficulty',
            'type'       => 'string',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                if ($row->difficulty == 1) {
                    return '<span class="badge badge-md badge-success">Easy</span>';
                } elseif ($row->difficulty == 2) {
                    return '<span class="badge badge-md badge-warning">Medium</span>';
                } else {
                    return '<span class="badge badge-md badge-danger">Hard</span>';
                }
            },
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.datagrid.status'),
            'type'       => 'boolean',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
            'closure'    => function ($row) {
                return $row->status
                    ? '<span class="badge badge-md badge-success">' . trans('admin::app.datagrid.active') . '</span>'
                    : '<span class="badge badge-md badge-danger">' . trans('admin::app.datagrid.inactive') . '</span>';
            },
        ]);
    }

    /**
     * Prepare actions.
     *
     * @return void
     */
    public function prepareActions()
    {
        $this->addAction([
            'icon'   => 'icon-view',
            'title'  => trans('admin::app.datagrid.view'),
            'method' => 'GET',
            'target' => '_blank',
            'url'    => function ($row) {
                return route('shop.recipes.view', $row->url_key);
            },
        ]);

        $this->addAction([
            'icon'   => 'icon-edit',
            'title'  => trans('admin::app.datagrid.edit'),
            'method' => 'GET',
            'url'    => function ($row) {
                return route('admin.recipes.edit', $row->id);
            },
        ]);

        $this->addAction([
            'icon'   => 'icon-delete',
            'title'  => trans('admin::app.datagrid.delete'),
            'method' => 'DELETE',
            'url'    => function ($row) {
                return route('admin.recipes.destroy', $row->id);
            },
        ]);
    }
}
