<?php


namespace RocketsLab\LaravelQueryFilters\Common;

use RocketsLab\LaravelQueryFilters\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class OrderAsc extends Filter
{
    function applyFilter($builder): QueryBuilder|EloquentBuilder
    {
        return $builder->orderBy($this->queryValue());
    }
}
