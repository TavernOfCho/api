<?php

namespace App\Tests;

use App\Entity\AchievementGroup;

class AchievementGroupTest extends WebTestCase
{
    public function testAchievementGroupList()
    {
        $response = $this->request('GET', '/achievement_groups');
        $json = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('hydra:totalItems', $json);
        $this->assertGreaterThan(1, $json['hydra:totalItems']);

        $this->assertArrayHasKey('hydra:member', $json);
        $this->assertGreaterThan(1, count($json['hydra:member']));

    }

    /**
     * @depends testAchievementGroupList
     */
    public function testCreateAchievementGroup(): void
    {
        $data = [
            'name' => 'New AchievementGroup',
            'achievements' => [9126, 15]
        ];

        $response = $this->request('POST', '/achievement_groups', $data);
        $json = json_decode($response->getContent(), true);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('name', $json);
        $this->assertEquals('New AchievementGroup', $json['name']);

        $this->assertArrayHasKey('achievements', $json);
        $this->assertEquals(2, count($json['achievements']));

        $this->assertArrayHasKey('achievementsDetails', $json);
        $this->assertEquals(2, count($json['achievementsDetails']));
    }

    /**
     * Updates an AchievementGroup.
     * @depends testCreateAchievementGroup
     */
    public function testUpdateAchievementGroup(): void
    {
        $data = [
            'name' => 'AchievementGroup',
        ];

        $response = $this->request('PUT', $this->findOneIriBy(AchievementGroup::class, ['name' => 'New AchievementGroup']), $data);
        $json = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('name', $json);
        $this->assertEquals('AchievementGroup', $json['name']);
    }

    /**
     * Deletes an AchievementGroup.
     * @depends testCreateAchievementGroup
     */
    public function testDeleteAchievementGroup(): void
    {
        $response = $this->request('DELETE', $this->findOneIriBy(AchievementGroup::class, ['name' => 'AchievementGroup']));

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
