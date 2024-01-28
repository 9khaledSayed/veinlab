<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class BranchScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if (setting('current_branch') != 'all' && setting('current_branch') && auth()->guard('employee')->check())
            $builder->whereBranchId(setting('current_branch'));
    }
}
