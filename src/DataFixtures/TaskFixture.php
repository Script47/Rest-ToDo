<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TaskFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $randomContent = [
            'This is item #1.',
            'This is item #2.',
            'This is item #3',
            'This is item #4',
            'This is item #5',
        ];

        for ($i = 0; $i < 10; $i++) {
            $task = new Task();
            $task->setContent('This is item #' . ($i + 1));
            $manager->persist($task);
        }

        $manager->flush();
    }
}
