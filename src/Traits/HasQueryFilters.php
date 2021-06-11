<?php


namespace RocketsLab\LaravelQueryFilters\Traits;

use Illuminate\Pipeline\Pipeline;

trait HasQueryFilters
{
    public static function queryFilter(array $queryFilters, array $values = null)
    {
        return app(Pipeline::class)
            ->send([
                'builder' => static::query(),
                'values' => $values ?? request()->all()
            ])
            ->through($queryFilters)
            ->then(fn($payload) => $payload['builder']);
    }
}
