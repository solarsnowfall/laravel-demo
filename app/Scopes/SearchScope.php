<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SearchScope implements Scope
{
    protected array $searchColumns = [];

    public function apply(Builder $builder, Model $model)
    {
        if ($search = request('search')) {
            $columns = property_exists($model, 'searchColumns') ? $model->searchColumns : $this->searchColumns;

            foreach ($columns as $index => $column) {
                $parts = explode('.', $column);
                $method = $index === 0 ? 'where' : 'orWhere';

                if (count($parts) == 2) {
                    list($relationship, $col) = $parts;
                    $method .= 'Has';

                    $builder->$method($relationship, function(Builder $query) use ($col, $search) {
                        $query->where($col, 'LIKE', "%$search%");
                    });
                } elseif (count($parts) == 1) {
                    $builder->$method($column, 'LIKE', "%$search%");
                }
            }
        }
    }
}
