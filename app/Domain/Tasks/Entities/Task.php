<?php

namespace App\Domain\Tasks\Entities;

class Task
{
    protected $id;

    protected $title;

    protected $status;

    public function complete(): void
    {
         $this->status='complete';
    }

}
