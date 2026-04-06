<?php

namespace App\Domain\Tasks\Repositories;

interface GeneralRepositoryInterface
{
    public function save(array $data): void;
}
