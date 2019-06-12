<?php

namespace App\Tests;

use App\Entity\User;

class UserTest extends WebTestCase
{
    public function testCreateUser()
    {
        $this->username = null;
        $data = [
            'username' => 'toto',
            'plainPassword' => 'kamal123',
            'email' => 'toto@gmail.com',
        ];

        $response = $this->request('POST', '/users', $data, [], false);
        $json = json_decode($response->getContent(), true);

        $this->username = 'toto';

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('username', $json);
        $this->assertEquals($this->username, $json['username']);
    }

    /**
     * @depends testCreateUser
     */
    public function testUserList()
    {
        $response = $this->request('GET', '/users');
        $json = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('hydra:totalItems', $json);
        $this->assertGreaterThan(1, $json['hydra:totalItems']);

        $this->assertArrayHasKey('hydra:member', $json);
        $this->assertGreaterThan(1, count($json['hydra:member']));
    }

    /**
     * Updates an AchievementGroup.
     * @depends testCreateUser
     */
    public function testUpdateAchievementGroup(): void
    {
        $data = [
            'email' => 'toto2@gmail.com',
        ];

        $response = $this->request('PUT', $this->findOneIriBy(User::class, ['username' => $this->username]), $data);
        $json = json_decode($response->getContent(), true);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('email', $json);
        $this->assertEquals('toto2@gmail.com', $json['email']);
    }

    /**
     * Deletes an AchievementGroup.
     * @depends testCreateUser
     */
    public function testDeleteAchievementGroup(): void
    {
        $response = $this->request('DELETE', $this->findOneIriBy(User::class, ['username' => $this->username]));

        $this->assertEquals(204, $response->getStatusCode());
        $this->assertEmpty($response->getContent());
    }
}
