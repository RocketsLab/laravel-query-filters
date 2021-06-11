<?php


namespace RocketsLab\LaravelQueryFilters\Commands;

use Illuminate\Console\GeneratorCommand;

class QueryFilterMakeCommand extends GeneratorCommand
{
    protected $signature = 'make:query-filter {name}';

    protected $description = 'Create a new Laravel QueryFilter class';

    protected $type = 'QueryFilter';

    protected function buildClass($name): array|string
    {
        $namespace = $this->getNamespace($name);

        $replace["use {$namespace}\QueryFilters;\n"] = '';

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    protected function resolveStubPath($stub): string
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__.$stub;
    }

    protected function getStub(): string
    {
       return $this->resolveStubPath('/stubs/query-filter.stub');
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\QueryFilters';
    }
}
