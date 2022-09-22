<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ContactSearchScope extends SearchScope
{
    protected array $searchColumns = [
        'first_name',
        'last_name',
        'email',
        'company.name'
    ];
}
