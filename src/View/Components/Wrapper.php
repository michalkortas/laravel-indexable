<?php

namespace michalkortas\LaravelIndexable\View\Components;

use Illuminate\View\Component;

class Wrapper extends Component
{
    /**
     * Create a new component instance.
     */

    public $title;
    public $description;
    public $create;
    public $resource;
    public $tableFilters;
    public $storedTableFilters;
    public $items;
    public $actionButtons;
    public $indexable;
    public $model;
    public $rangeFilters;
    public $typeFilters;
    public $modelName;
    public $fullscreen;

    public function __construct(
        $title = '',
        $description = '',
        $create = true,
        $resource = '',
        $tableFilters = true,
        $storedTableFilters = false,
        $actionButtons = true,
        $items = [],
        $requestFilters = [],
        $modelName = [],
        $fullscreen = true
    )
    {
        $this->create = $create;
        $this->resource = $resource;
        $this->tableFilters = $tableFilters;
        $this->requestFilters = $requestFilters;
        $this->storedTableFilters = $storedTableFilters;
        $this->actionButtons = $actionButtons;
        $this->items = $items;
        $this->model = $this->getModel($this->items);
        $this->rangeFilters = $this->getRangeFilters($this->model);
        $this->typeFilters = $this->getTypeFilters($this->model);
        $this->modelName = $this->getModelName($this->model);
        $this->indexable = $this->getIndexable($this->model);
        $this->title = $title ?? $this->model->indexTitle ?? '';
        $this->description = $description ?? $this->model->indexDescription ?? '';
        $this->fullscreen = $fullscreen;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('indexable::components/wrapper');
    }

    private function getModel($items) {
        if(isset($items[0]))
            return $items[0];

        return [];
    }

    private function getModelName($model) {
        if(is_object($model))
            return get_class($model);

        return '';
    }

    private function getIndexable($model) {
        if(!empty($model) && !empty($model->indexable))
            return $model->indexable;

        return [];
    }

    private function getRangeFilters($model) {
        if(!empty($model) && !empty($model->rangeFilters))
            return $model->rangeFilters;

        return [];
    }

    private function getTypeFilters($model) {
        if(!empty($model) && !empty($model->typeFilters))
            return $model->typeFilters;

        return [];
    }
}
