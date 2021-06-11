<?php
namespace RocketsLab\LaravelQueryFilters;

use Illuminate\Support\ServiceProvider;
use RocketsLab\LaravelQueryFilters\Commands\QueryFilterMakeCommand;

class QueryFiltersServiceProvider extends ServiceProvider
{
    public function register()
    {
        $path = realpath(__DIR__ . '/../config/query-filters.php');

        $this->mergeConfigFrom($path, "query-filters");
    }

    public function boot()
    {
        $this->publishesConfig();

        $this->bootCommands();
    }

    protected function publishesConfig()
    {
        $path = realpath(__DIR__ . '/../config/query-filters.php');

        $this->publishes([$path => config_path('query-filters.php')], "config");
    }

    protected function bootCommands()
    {
        if(! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            QueryFilterMakeCommand::class
        ]);
    }
}
