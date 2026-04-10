<?php

namespace Domain\Tasks\Entity;

use App\Domain\Tasks\Entities\Task;
use App\Domain\Tasks\ValueObjects\TaskStatus;
use App\Domain\Tasks\ValueObjects\TaskTitle;
use App\Domain\Tasks\ValueObjects\TaskUserId;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function test_it_create_with_pending_status()
    {
        $task= new Task(
            new TaskTitle('Test'),
            TaskStatus::Pending,
            new TaskUserId(1)
        );

        $this->assertSame('Test', $task->getTitle()->getValue());

        $this->assertTrue($task->getStatus()->isCompleted()===false);

    }

    public function test_task_can_be_completed()
    {
        $task= new Task(
            new TaskTitle('Test'),
            TaskStatus::Pending,
            new TaskUserId(1)
        );

        $task->complete();

        $this->assertTrue($task->getStatus()->isCompleted());
    }
}
