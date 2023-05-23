<?php

namespace App\Filters;

use App\Models\Course;

class CourseFilters extends Filter
{
    protected $model = Course::class;

    protected $availableParams = [
        'name' => ['like'],
        'description' => ['like'],
        'price' => ['eq', 'neq', 'gt', 'gte', 'lt', 'lte'],
        'start_date' => ['eq', 'neq', 'gt', 'gte', 'lt', 'lte'],
        'end_date' => ['eq', 'neq', 'gt', 'gte', 'lt', 'lte'],
    ];
}
