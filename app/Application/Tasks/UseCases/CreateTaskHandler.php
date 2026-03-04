<?php

namespace App\Application\Tasks\UseCases;

use App\Domain\Tasks\Entities\Task;
use App\Domain\Tasks\Repositories\TaskRepositoryInterface;
use App\Domain\Tasks\ValueObjects\TaskStatus;
use App\Domain\Tasks\ValueObjects\TaskTitle;

class CreateTaskHandler
{
    public function __construct(
        public readonly TaskRepositoryInterface $task
    )
    {

    }

    public function handler(CreateTaskCommand $command) : Task
    {
        $task = new Task(
            new TaskTitle($command->title),
            TaskStatus::Pending
        );

        return $task;
    }
}
