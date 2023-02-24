<?php
namespace App\Scopes;
use Illuminate\Database\Eloquent\{Scope, Model, Builder};

class ActiveScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->where('is_delete', false);
    }
}