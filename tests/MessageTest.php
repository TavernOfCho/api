<?php

namespace App\Tests;

use App\Entity\Message;

class MessageTest extends WebTestCase
{
    public function testMessageList()
    {
        $response = $this->request('GET', '/messages');
        $json = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('hydra:totalItems', $json);
        $this->assertGreaterThanOrEqual(30, $json['hydra:totalItems']);

        $this->assertArrayHasKey('hydra:member', $json);
        $this->assertEquals(30, count($json['hydra:member']));

    }

    /**
     * @depends testMessageList
     */
    public function testCreateMessage(): void
    {
        $data = [
            'text' => 'Hello World',
        ];

        $response = $this->request('POST', '/messages', $data);
        $json = json_decode($response->getContent(), true);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('text', $json);
        $this->assertEquals('Hello World', $json['text']);

        $this->assertArrayHasKey('sender', $json);
        $this->assertArrayHasKey('receiver', $json);
    }

    /**
     * Updates an AchievementGroup.
     * @depends testCreateMessage
     */
    public function testUpdateMessage(): void
    {
        $data = [
            'text' => 'GoodBye World',
        ];

        $response = $this->request('PUT', $this->findOneIriBy(Message::class, ['text' => 'Hello World']), $data);
        $json = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('text', $json);
        $this->assertEquals('GoodBye World', $json['text']);
    }

    /**
     * Deletes an AchievementGroup.
     * @depends testCreateMessage
     */
    public function testDeleteMessage(): void
    {
        $response = $this->request('DELETE', $this->findOneIriBy(Message::class, ['text' => 'GoodBye World']));

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertEmpty($response->getContent());
    }

    /**
     * Retrieves the documentation.
     */
    public function testRetrieveTheDocumentation(): void
    {
        $response = $this->request('GET', '/', null, ['Accept' => 'text/html']);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('text/html; charset=UTF-8', $response->headers->get('Content-Type'));

        $this->assertContains('Hello API Platform', $response->getContent());
    }
}
