<?php

namespace App\Application\Tasks\UseCases;

use App\Domain\Tasks\Entities\Task;
use App\Domain\Tasks\Repositories\TaskRepositoryInterface;
use App\Domain\Tasks\ValueObjects\TaskStatus;
use App\Domain\Tasks\ValueObjects\TaskTitle;
use App\Domain\Tasks\ValueObjects\TaskUserId;

class CreateTaskHandler
{
    public function __construct(
        public readonly TaskRepositoryInterface $task
    )
    {

    }

    public function handle(CreateTaskCommand $command) : Task
    {
        $task = new Task(
            new TaskTitle($command->title),
            TaskStatus::Pending,
            new TaskUserId($command->userId),

        );

        $this->task->save($task);

        return $task;
    }
}
