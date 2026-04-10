<?php

namespace App\Domain\Tasks\Repositories;

interface GeneralRepositoryInterface
{
    public function save(array $data): void;
    public function getById(int $id);
    public function delete(int $id): void;

}
