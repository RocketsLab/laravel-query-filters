<?php

namespace RocketsLab\LaravelQueryFilters\Common;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use RocketsLab\LaravelQueryFilters\Contracts\Filter;

class Limit extends Filter
{
    function applyFilter($builder): QueryBuilder|EloquentBuilder
    {
        return $builder->limit($this->queryValue());
    }
}
