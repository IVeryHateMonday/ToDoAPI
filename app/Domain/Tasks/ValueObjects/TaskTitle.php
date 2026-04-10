<?php

namespace App\Domain\Tasks\ValueObjects;


class TaskTitle
{
    private const MAX_LENGTH = 255;

    private string $value;

    public function __construct(string $value)
    {
        $this->ensureNotEmpty($value);
        $this->ensureNotTooLong($value);

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    private function ensureNotEmpty(string $value): void
    {
        if ($value === '') {
            throw new \InvalidArgumentException('Task title cannot be empty');
        }
    }

    private function ensureNotTooLong(string $value): void
    {
        if (strlen($value) > self::MAX_LENGTH) {
            throw new \InvalidArgumentException('Task title too long');
        }
    }
}
