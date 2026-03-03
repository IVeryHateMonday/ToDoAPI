<?php

namespace App\Domain\Tasks\ValueObjects;


class TaskTitle
{
    private string $value;

    public function __construct($value)
    {
        if (empty($value)){
            throw new \InvalidArgumentException("Task title cannot be null");
        }

        if (strlen($value)>255){
            throw new \InvalidArgumentException("Task title too long");
        }

        $this->value=$value;
    }

    public function getValue() : string
    {
         return $this->value;
    }
}
