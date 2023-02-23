<?php

namespace michalkortas\LaravelIndexable\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     */

    public $model;
    public $items;
    public $resource;
    public $columns;
    public $modelName;
    public $indexable;
    public $tableFilters;
    public $rangeFilters;
    public $typeFilters;
    public $requestFilters;
    public $twoDimensionalHeader;
    public $actionButtons;
    public $fullscreen;
    public $withCheckbox;

    public function __construct(
        $model = [],
        $modelName = '',
        $items = [],
        $indexable = [],
        $tableFilters = false,
        $rangeFilters = [],
        $typeFilters = [],
        $actionButtons = false,
        $fullscreen = false,
        $withCheckbox = false,
        $resource = ''
    )
    {
        $this->model = $model;
        $this->modelName = $modelName;
        $this->items = $items;
        $this->rangeFilters = $rangeFilters;
        $this->typeFilters = $typeFilters;
        $this->resource = $resource;
        $this->columns = $this->getColumns($indexable);
        $this->indexable = $indexable;
        $this->twoDimensionalHeader = $this->isTwoDimensionalHeader($indexable);
        $this->tableFilters = $tableFilters;
        $this->requestFilters = \request()->only('tableFilters')['tableFilters'] ?? [];
        $this->actionButtons = $actionButtons;
        $this->fullscreen = $fullscreen;
        $this->withCheckbox = $withCheckbox;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('indexable::components/table');
    }

    private function getColumns($indexable) {
        $columns = [];

        foreach($indexable ?? [] as $key => $value) {
            if(is_array($value)) {
                foreach ($value ?? [] as $subKey => $subValue) {
                    $columns[$subKey] = $subValue;
                }
            }
            else {
                $columns[$key] = $value;
            }
        }
        return $columns;
    }

    private function isTwoDimensionalHeader($indexable) {
        foreach($indexable ?? [] as $key => $value) {
            if(is_array($value)) {
                return true;
            }
        }
        return false;
    }

}
