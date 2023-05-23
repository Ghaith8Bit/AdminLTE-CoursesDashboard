<?php

namespace App\Filters\Applicators;

class FilterApplicator
{
    private array $filters;
    private $model;
    private $collection;

    public function __construct(array $filters, $model, $collection = NULL)
    {
        $this->filters = $filters;
        $this->model = $model;
        $this->collection = $collection;
    }

    public function apply($perPage = 6)
    {
        $query = $this->model::query();
        foreach ($this->filters as $filter) {
            [$param, $operator, $value] = $filter;
            $query->where($param, $operator, $value);
        }
        $result = $query->paginate($perPage);
        if (isset($this->collection)) {
            $result = new $this->collection($result->items());
        }
        return $result;
    }
}
