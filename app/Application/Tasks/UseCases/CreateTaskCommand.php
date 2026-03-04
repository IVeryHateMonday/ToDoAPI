<?php

namespace App\Application\Tasks\UseCases;

class CreateTaskCommand
{
    public function __construct(
        public readonly string $title
    )
    {

    }
}
