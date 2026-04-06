<?php

namespace App\Domain\Tasks\ValueObjects;

class TackUserId
{
    protected int $value;

    protected function __construct(int $value)
    {
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }
}
