<?php

namespace Domain\Tasks\ValueObjects;

use App\Domain\Tasks\ValueObjects\TaskTitle;
use Cassandra\Exception\InvalidArgumentException;
use Tests\TestCase;

class TaskTitleTest extends TestCase
{
    public function test_it_accepts_valid_title()
    {
        $title = new TaskTitle('Wake up');

        $this->assertSame('Wake up', $title->getValue());
    }

    public function test_it_empty_title()
    {
        $this->expectException(\InvalidArgumentException::class);

        new TaskTitle('');
    }

    public function test_it_when_title_too_long()
    {
        $this->expectException(\InvalidArgumentException::class);

        new TaskTitle(str_repeat('a',300));
    }
}
