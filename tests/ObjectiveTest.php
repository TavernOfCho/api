<?php

namespace App\Tests;

use App\Entity\Objective;
use App\Entity\User;

class ObjectiveTest extends WebTestCase
{
    public function testObjectiveList()
    {
        $response = $this->request('GET', '/objectives');
        $json = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('hydra:totalItems', $json);
        $this->assertGreaterThanOrEqual(5, $json['hydra:totalItems']);

        $this->assertArrayHasKey('hydra:member', $json);
        $this->assertGreaterThanOrEqual(5, count($json['hydra:member']));

    }


    /**
     * @depends testObjectiveList
     */
    public function testCreateObjective(): void
    {
        $data = [
            'title' => 'Hello World',
            'endingDate' => (new \DateTime())->format('Y-m-d h:i:s'),
            'achievementId' => 15,
            'character' => 'Zengg',
            'realm' => 'Dalaran',
            'bnetUser' => $this->findOneIriBy(User::class, ['username' => 'john'])
        ];

        $response = $this->request('POST', '/objectives', $data);
        $json = json_decode($response->getContent(), true);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('title', $json);
        $this->assertEquals('Hello World', $json['title']);

        $this->assertArrayHasKey('endingDate', $json);
        $this->assertArrayHasKey('achievementId', $json);
        $this->assertArrayHasKey('character', $json);
        $this->assertArrayHasKey('realm', $json);
        $this->assertArrayHasKey('bnetUser', $json);
    }

    /**
     * Updates an Objective.
     * @depends testCreateObjective
     */
    public function testUpdateObjective(): void
    {
        $data = [
            'title' => 'GoodBye World',
        ];

        $response = $this->request('PUT', $this->findOneIriBy(Objective::class, ['title' => 'Hello World']), $data);
        $json = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('title', $json);
        $this->assertEquals('GoodBye World', $json['title']);
    }

    /**
     * Deletes an Objective.
     * @depends testUpdateObjective
     */
    public function testDeleteObjective(): void
    {
        $response = $this->request('DELETE', $this->findOneIriBy(Objective::class, ['title' => 'GoodBye World']));

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
