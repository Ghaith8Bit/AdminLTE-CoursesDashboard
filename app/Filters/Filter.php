<?php

namespace App\Filters;

use App\Filters\Applicators\FilterApplicator;
use App\Filters\Parsers\QueryParser;
use Illuminate\Http\Request;

abstract class Filter
{
    protected $model;
    protected $collection;
    protected $availableParams = [];
    private $result = [];

    public function __construct(Request $request)
    {
        $filters = (new QueryParser($request, $this->availableParams))->parse();
        $this->result = (new FilterApplicator($filters, $this->model, $this->collection))->apply();
    }

    public function get()
    {
        return $this->result;
    }
}
