<?php

namespace App\Domain\Tasks\Entities;

use App\Domain\Tasks\ValueObjects\TaskStatus;
use App\Domain\Tasks\ValueObjects\TaskTitle;

class Task
{
    protected  $id;

    protected TaskTitle $title;

    protected TaskStatus $status;

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

    /**
     * @param TaskStatus $status
     */
    public function setStatus(TaskStatus $status): void
    {
        $this->status = $status;
    }

    /**
     * @param TaskTitle $title
     */
    public function setTitle(TaskTitle $title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
}
