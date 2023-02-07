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
    public $isBooleanFilter;
    public $filterType;
    public $filterLabels;
    public $isEmpty;
    public $booleanOptions;

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
        $this->isBooleanFilter = ($this->typeFilters[$path] ?? '') === 'boolean';
        $this->filterType = array_key_exists($path, $this->typeFilters) ? $this->typeFilters[$path] : 'text';
        $this->filterLabels = $this->getFilterLabels();
        $this->isEmpty = $this->isEmpty();
        $this->booleanOptions = [
            null => 'wszystko',
            0 => 'Nie',
            1 => 'Tak',
        ];
    }

    public function getFilterLabels() {
        if($this->isRangeFilter) {
            return [
                'from' => $this->rangeFilters[$this->path][0] ?? 'Od',
                'to' => $this->rangeFilters[$this->path][0] ?? 'Do',
            ];
        }
        elseif($this->isBooleanFilter) {
            return [
                'strict' => 'Wybierz jedną z opcji'
            ];
        } else {
            return [
                'strict' => 'Wpisz szukaną frazę'
            ];
        }
    }

    public function isEmpty():bool {
        if(!$this->isRangeFilter) {
            return empty($this->requestFilters[$this->path] ?? '');
        } else {
            return empty($this->requestFilters[$this->path]['from'] ?? '') && empty($this->requestFilters[$this->path]['to'] ?? '');
        }

        return true;
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
