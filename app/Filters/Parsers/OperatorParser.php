<?php

namespace App\Filters\Parsers;

use InvalidArgumentException;

class OperatorParser
{

    private $operator;
    private $value;

    public function __construct($operator, $value)
    {
        $this->operator = $operator;
        $this->value = $value;
    }

    public function parse()
    {
        switch ($this->operator) {
            case 'gt':
                $operator = '>';
                $value = $this->value;
                break;
            case 'lt':
                $operator = '<';
                $value = $this->value;
                break;
            case 'gte':
                $operator = '>=';
                $value = $this->value;
                break;
            case 'lte':
                $operator = '<=';
                $value = $this->value;
                break;
            case 'eq':
                $operator = '=';
                $value = $this->value;
                break;
            case 'neq':
                $operator = '<>';
                $value = $this->value;
                break;
            case 'null':
                switch ($this->value) {
                    case '0':
                        $operator = '!=';
                        $value = NULL;
                        break;
                    case '1':
                        $operator = '=';
                        $value = NULL;
                        break;
                    default:
                        throw new InvalidArgumentException("Invalid operator: $this->value");
                }
                break;
            case 'like':
                $operator = 'LIKE';
                $value = "%$this->value%";
                break;
            default:
                throw new InvalidArgumentException("Invalid operator: $this->operator");
        }
        return [$operator, $value];
    }
}
