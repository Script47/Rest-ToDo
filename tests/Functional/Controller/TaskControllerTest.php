<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class TaskControllerTest extends WebTestCase
{
    public function testListJson()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/tasks',
            [
                'format' => 'json'
            ]
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertEquals('application/json', $client->getResponse()->headers->get('Content-Type'));
    }

    public function testListXml()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/tasks',
            [
                'format' => 'xml'
            ]
        );

        $this->assertResponseStatusCodeSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertEquals('application/xml', $client->getResponse()->headers->get('Content-Type'));
    }

    public function testCreate()
    {
        $client = static::createClient();
        $data = [
            'content' => 'Some todo item...'
        ];
        $headers = [
            'Content-Type' => 'application/json'
        ];
        $client->request(
            'POST',
            '/tasks',
            [],
            [],
            $headers,
            json_encode($data)
        );
        $task = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED, $client->getResponse()->getStatusCode());
        $this->assertEquals('application/json', $client->getResponse()->headers->get('Content-Type'));
        $this->assertArrayHasKey('id', $task);
        $this->assertArrayHasKey('content', $task);
        $this->assertArrayHasKey('createdAt', $task);
        $this->assertSame($data['content'], $task['content']);
    }
}
