<?php

namespace App\Domain\Tasks\Entities;

use App\Domain\Tasks\ValueObjects\TaskStatus;
use App\Domain\Tasks\ValueObjects\TaskTitle;
use App\Domain\Tasks\ValueObjects\TaskUserId;

class Task
{
    private ?int $id = null;

    private TaskTitle $title;

    private TaskStatus $status;

    protected TaskUserId $userId;

    public function __construct(
        TaskTitle $title,
        TaskStatus $status,
        TaskUserId $userId
    ) {
        $this->title = $title;
        $this->status = $status;
        $this->userId = $userId;
    }
    public function complete(): void
    {
        $this->status = TaskStatus::Completed;
    }

    public function isCompleted(): bool
    {
        return $this->status->isCompleted();
    }

    /**
     * @return TaskTitle
     */
    public function getTitle(): TaskTitle
    {
        return $this->title;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return TaskStatus
     */
    public function getStatus(): TaskStatus
    {
        return $this->status;
    }

    public function getUserId(): TaskUserId
    {
        return $this->userId;
    }

}
