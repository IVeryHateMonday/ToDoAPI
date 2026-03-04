<?php

namespace App\Domain\Tasks\Entities;

use App\Domain\Tasks\ValueObjects\TaskStatus;
use App\Domain\Tasks\ValueObjects\TaskTitle;

class Task
{
    protected  $id;

    protected TaskTitle $title;

    protected TaskStatus $status;

    public function __construct(
        TaskTitle $title,
        TaskStatus $status
    ) {
        $this->title = $title;
        $this->status = $status;
    }
    public function complete(): void
    {
         $this->status= TaskStatus::Completed;
    }

    /**
     * @return TaskTitle
     */
    public function getTitle(): TaskTitle
    {
        return $this->title;
    }

    /**
     * @return TaskStatus
     */
    public function getStatus(): TaskStatus
    {
        return $this->status;
    }

}
