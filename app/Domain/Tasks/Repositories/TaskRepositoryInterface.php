<?php

namespace App\Domain\Tasks\Repositories;

use App\Domain\Tasks\Entities\Task;
interface TaskRepositoryInterface
{
    public function save(Task $task): void;
    public function findById(int $id): ?Task;
    public function delete(Task $task): void;
}
