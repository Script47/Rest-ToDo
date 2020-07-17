<?php


namespace App\Tests\Unit\Entity;


use App\Entity\Task;
use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testContent()
    {
        $content = 'Hello, World!';
        $task = new Task();
        $task->setContent($content);
        $this->assertSame($content, $task->getContent());
    }

    public function testCreatedAt()
    {
        $task = new Task();
        $this->assertInstanceOf('DateTimeInterface', $task->getCreatedAt());
    }
}
