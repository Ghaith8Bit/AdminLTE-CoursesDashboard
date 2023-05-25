<?php

namespace App\Filters;

use App\Models\User;

class UserFilters extends Filter
{
    protected $model = User::class;

    protected $availableParams = [
        'name' => ['like'],
        'email' => ['like'],
        'role_id' => ['eq'],
        'created_at' => ['gt', 'gte', 'lt', 'lte'],
    ];
}
