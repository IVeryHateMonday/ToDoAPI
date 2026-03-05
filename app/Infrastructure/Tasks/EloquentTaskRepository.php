<?php

namespace App\Infrastructure\Tasks;

use App\Domain\Tasks\Entities\Task as DomainTask;
use App\Domain\Tasks\Repositories\TaskRepositoryInterface;
use App\Domain\Tasks\ValueObjects\TaskStatus;
use App\Domain\Tasks\ValueObjects\TaskTitle;
use App\Models\Task as EloquentTask;

class EloquentTaskRepository implements TaskRepositoryInterface
{
    public function save(DomainTask $task): void
    {
        $model = new EloquentTask();
        $model->title  = $task->getTitle()->getValue();
        $model->status = $task->getStatus()->value;

        $model->save();

        $task->setId($model->id);

    }

    public function findById(int $id): ?DomainTask
    {
        $model = EloquentTask::find($id);

        if (! $model) {
            return null;
        }



        $task= new DomainTask(
            new TaskTitle($model->title),
            TaskStatus::from($model->status),
        );

        $task->setId($model->id);

        return $task;

    }

    public function delete(DomainTask $task): void
    {
        // тут треба мати id у DomainTask, щоб видаляти по ньому
        // приклад, якщо є getId():
        // EloquentTask::where('id', $task->getId())->delete();
    }
}
