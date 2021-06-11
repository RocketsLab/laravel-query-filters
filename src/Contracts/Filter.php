<?php


namespace RocketsLab\LaravelQueryFilters\Contracts;

use \Illuminate\Database\Query\Builder as QueryBuilder;
use \Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Support\Str;

abstract class Filter
{
    /*
     * You can change the filterName setting this property
     */
    protected string $queryFilterName;

    protected QueryBuilder|EloquentBuilder $builder;

    protected array $values;

    /*
     * Handle and process the QueryFilter
     */
    public function handle($payload, \Closure $next)
    {
        ['builder' => $this->builder, 'values' => $this->values] = $payload;

        if(!isset($this->values[$this->filterName()]) || is_null($this->values[$this->filterName()])) {
            return $next($payload);
        }

        return $next($this->buildPayload($this->applyFilter($this->builder)));
    }

    abstract function applyFilter($builder): QueryBuilder|EloquentBuilder;

    /*
     * Returns the filter name based on class basename to snake format
     * eg: Search -> search , SomeValue -> some_value
     */
    protected function filterName(): string
    {
        return $this->valuesFilterName ?? Str::snake(class_basename($this));
    }

    /*
     * Returns the queryString value from values array
     */
    protected function queryValue(): mixed
    {
        return $this->values[$this->filterName()];
    }

    /*
     * Builds the correct Pipeline payload
     */
    private function buildPayload($builder): array
    {
        return [
            'builder' => $builder,
            'values' => $this->values
        ];
    }
}
