<?php

namespace michalkortas\LaravelIndexable;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use michalkortas\LaravelIndexable\View\Components\Td;
use michalkortas\LaravelIndexable\View\Components\ThFilters;
use michalkortas\LaravelIndexable\View\Components\Wrapper;
use michalkortas\LaravelIndexable\View\Components\Table;

class LaravelIndexableServiceProvider extends ServiceProvider
{
        /**
     * Register the application's policies.
     *
     * @return void
     */

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'indexable');

        $this->loadViewComponentsAs('indexable', [
            Wrapper::class,
            Table::class,
            ThFilters::class,
            Td::class,
        ]);
    }

    public function register()
    {

    }
}
