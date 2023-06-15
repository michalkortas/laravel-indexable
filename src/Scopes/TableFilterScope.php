<?php

namespace michalkortas\LaravelIndexable\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TableFilterScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    private function getColumns($indexable) {
        $columns = [];

        foreach($indexable ?? [] as $key => $value) {
            if(is_numeric($key) && !empty($value['key'])) {
                $key = $value['key'] ;
                $columns[$key] = $value;
            } else {
                if(is_array($value)) {
                    foreach ($value ?? [] as $subKey => $subValue) {
                        $columns[$subKey] = $subValue;
                    }
                }
                else {
                    $columns[$key] = $value;
                }
            }

        }

        return $columns;
    }

    public function apply(Builder $builder, Model $model)
    {
        $post = \request()->only('tableFilters');

        $modelName = \request()->only('tableFiltersModel')['tableFiltersModel'] ?? '';

        $filters = $post['tableFilters'] ?? [];

        foreach($filters as $relation => $value)
        {
            if(is_array($value)) {
                if(array_key_exists('from', $value) && array_key_exists('to', $value) && !empty($value['from']) && !empty($value['to'])) {
                    if($value !== null && (($model->indexableAll ?? false) || array_key_exists($relation, $this->getColumns($model->indexable))) && (is_object($model) && $modelName === get_class($model)))
                    {
                        $relationNames=explode( '.', $relation);

                        if(count($relationNames) > 1)
                        {
                            $columnName = end($relationNames);

                            $relationName = implode(".", array_slice($relationNames, 0, -1));

                            $builder->whereHas($relationName, function ($q) use($value, $columnName){
                                $q->whereBetween($columnName, [$value['from'], $value['to']]);
                            });
                        }
                        else {
                            $builder->whereBetween($relation, [$value['from'], $value['to']]);
                        }
                    }
                }
            } else {
                if($value !== null && (($model->indexableAll ?? false) || array_key_exists($relation, $this->getColumns($model->indexable))) && (is_object($model) && $modelName === get_class($model)))
                {
                    $relationNames=explode( '.', $relation);

                    if(count($relationNames) > 1)
                    {
                        $columnName = end($relationNames);

                        $relationName = implode(".", array_slice($relationNames, 0, -1));

                        $builder->whereHas($relationName, function ($q) use($value, $columnName){
                            if(is_numeric($value)) {
                                $q->where($columnName, $value);
                            }
                            else{
                                if(in_array($columnName, ($model->strictSearch ?? [])))
                                    $q->where($columnName, 'like', $value);
                                else
                                    $q->where($columnName, 'like', "%".$value."%");
                            }
                        });
                    }
                    else {
                        if (is_numeric($value)) {
                            $builder->where($relation, $value);
                        } else {
                            if(in_array($relation, ($model->strictSearch ?? [])))
                                $builder->where($relation, 'like', $value);
                            else
                                $builder->where($relation, 'like', "%".$value."%");
                        }
                    }
                }
            }

        }
    }
}
