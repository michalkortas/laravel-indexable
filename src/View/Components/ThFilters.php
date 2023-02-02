<?php

namespace michalkortas\LaravelIndexable\View\Components;

use Illuminate\View\Component;

class ThFilters extends Component
{
    /**
     * Create a new component instance.
     */

    public $tableFilters;
    public $name;
    public $requestFilters;
    public $rangeFilters;
    public $typeFilters;
    public $path;
    public $isRangeFilter;
    public $filterType;
    public $filterLabels;

    public function __construct(
        $tableFilters = false,
        $name = '',
        $requestFilters = [],
        $rangeFilters = [],
        $typeFilters = [],
        $filterLabels = [],
        $path = ''
    )
    {
        $this->tableFilters = $tableFilters;
        $this->name = $name;
        $this->requestFilters = $requestFilters;
        $this->rangeFilters = $rangeFilters;
        $this->typeFilters = $typeFilters;
        $this->path = $path;
        $this->isRangeFilter = array_key_exists($path, $this->rangeFilters);
        $this->filterType = array_key_exists($path, $this->typeFilters) ? $this->typeFilters[$path] : 'text';
        $this->filterLabels = $this->getFilterLabels();
    }

    public function getFilterLabels() {
        if(!$this->isRangeFilter) {
            return [
                'strict' => 'Wpisz szukaną frazę'
            ];
        } else {
            return [
                'from' => $this->rangeFilters[$this->path][0] ?? 'Od',
                'to' => $this->rangeFilters[$this->path][0] ?? 'Do',
            ];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('indexable::components/th-filters');
    }

}
