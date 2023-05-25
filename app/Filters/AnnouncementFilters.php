<?php

namespace App\Filters;

use App\Models\Announcement;

class AnnouncementFilters extends Filter
{
    protected $model = Announcement::class;

    protected $availableParams = [
        'title' => ['like'],
        'is_published' => ['eq'],
        'created_at' => ['gt', 'gte', 'lt', 'lte'],
    ];
}
