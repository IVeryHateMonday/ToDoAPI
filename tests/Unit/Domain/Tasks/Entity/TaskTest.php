<?php

namespace Domain\Tasks\Entity;

use App\Domain\Tasks\Entities\Task;
use App\Domain\Tasks\ValueObjects\TaskStatus;
use App\Domain\Tasks\ValueObjects\TaskTitle;
use Tests\TestCase;

class TaskTest extends TestCase
{
    public function test_it_create_with_pending_status()
    {
        $task= new Task(
            new TaskTitle('Test'),
            TaskStatus::Pending
        );

        $this->assertSame('Test', $task->getTitle()->getValue());

        $this->assertTrue($task->getStatus()->isCompleted()===false);

    }

    public function test_task_can_be_completed()
    {
        $task= new Task(
            new TaskTitle('Test'),
            TaskStatus::Pending
        );

        $task->complete();

        $this->assertTrue($task->getStatus()->isCompleted());
    }
}
