<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait HasSearch
{
    /**
     * Scope a query to search across configured columns.
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        $term = trim((string) $term);

        if ($term === '') {
            return $query;
        }

        $model = $query->getModel();
        $columns = method_exists($model, 'getSearchableColumns')
            ? $model->getSearchableColumns()
            : [];

        if (empty($columns)) {
            return $query;
        }

        return $query->where(function (Builder $builder) use ($term, $columns) {
            foreach ($columns as $column) {
                $builder->orWhere($column, 'LIKE', "%{$term}%");
            }
        });
    }

    /**
     * Retrieve the searchable columns defined on the model.
     */
    public function getSearchableColumns(): array
    {
        return property_exists($this, 'searchableColumns') ? $this->searchableColumns : [];
    }
}

