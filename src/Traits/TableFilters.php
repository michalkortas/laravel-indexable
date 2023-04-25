<?php

namespace michalkortas\LaravelIndexable\Traits;

use michalkortas\LaravelIndexable\Scopes\TableFilterScope;

trait TableFilters {

    public static function bootTableFilters() {
        static::addGlobalScope(new TableFilterScope);
    }
    
    public array $indexable = [];
    public array $rangeFilters = [];
    public array $typeFilters = [];
}
