<?php

namespace App\Domain\Tasks\ValueObjects;

enum TaskStatus :string
{
    case Pending = 'pending';
    case Completed = 'completed';
    public function isCompleted():bool
    {
        return $this === self::Completed;
    }

}
