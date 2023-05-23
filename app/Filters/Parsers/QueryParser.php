<?php

namespace App\Filters\Parsers;

use Illuminate\Http\Request;

class QueryParser
{
    private $queryParams;
    private $availableParams;
    private $filters = [];

    public function __construct(Request $request, array $availableParams)
    {
        $this->queryParams = (array) $request->query();
        $this->availableParams = $availableParams;
    }

    public function parse()
    {
        foreach ($this->availableParams as $param => $operators) {
            if (isset($this->queryParams[$param]))
                foreach ($operators as $operator) {
                    if (key_exists($operator, $this->queryParams[$param])) {
                        [$operator, $value] = (new OperatorParser($operator, $this->queryParams[$param][$operator]))->parse();
                        array_push($this->filters, [$param, $operator, $value]);
                        break;
                    }
                }
        }
        return $this->filters;
    }
}
