<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

abstract class TitleFilterService
{
    /**
     * Применить фильтрацию по title, если параметр передан.
     *
     * @param Builder $query
     * @param string|null $title
     * @return Builder
     */
    protected function applyTitleFilter(Builder $query, ?string $title): Builder
    {
        return $query->when(!empty($title), function ($query) use ($title) {
        return $query->where('title', 'like', "%{$title}%");
    });
    }
}
