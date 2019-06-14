<?php

namespace App\Tests;

use App\Entity\User;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Symfony\Component\HttpFoundation\Response;

abstract class WebTestCase extends BaseWebTestCase
{
    use RefreshDatabaseTrait;

    /** @var KernelBrowser */
    protected $kernelBrowser;

    /** @var string $accessToken */
    protected $accessToken;

    /** @var string $username */
    protected $username = 'john';

    protected function setUp()
    {
        parent::setUp();

        $this->kernelBrowser = static::createClient();
        $this->kernelBrowser->setServerParameters([
            'HTTPS' => self::$container->getParameter('https'),
            'HTTP_HOST' => self::$container->getParameter('http_host')
        ]);

        $this->accessToken = $this->initAccessToken();
    }

    /**
     * @param string $method
     * @param string $uri
     * @param string|array|null $content
     * @param array $headers
     * @param bool $authorization
     * @return Response
     */
    protected function request(string $method, string $uri, $content = null, array $headers = [], bool $authorization = true): Response
    {
        $server = [
            'CONTENT_TYPE' => 'application/ld+json',
            'HTTP_ACCEPT' => 'application/ld+json',
            'HTTP_AUTHORIZATION' => sprintf('Bearer %s', $this->accessToken)
        ];

        if (!$authorization) {
            unset($server['HTTP_AUTHORIZATION']);
        }

        foreach ($headers as $key => $value) {
            if (strtolower($key) === 'content-type') {
                $server['CONTENT_TYPE'] = $value;

                continue;
            }

            $server['HTTP_' . strtoupper(str_replace('-', '_', $key))] = $value;
        }

        if (is_array($content) && false !== preg_match('#^application/(?:.+\+)?json$#', $server['CONTENT_TYPE'])) {
            $content = json_encode($content);
        }

        $this->kernelBrowser->request($method, $uri, [], [], $server, $content);

        return $this->kernelBrowser->getResponse();
    }

    /**
     * @param string $resourceClass
     * @param array $criteria
     * @return string
     */
    protected function findOneIriBy(string $resourceClass, array $criteria): string
    {
        $resource = static::$container->get('doctrine')->getRepository($resourceClass)->findOneBy($criteria);

        return static::$container->get('api_platform.iri_converter')->getIriFromitem($resource);
    }

    protected function initAccessToken()
    {
        if (null === $this->username) {
            return false;
        }

        /** @var User $user */
        $user = static::$container->get('doctrine')->getRepository(User::class)->findOneBy(['username' => $this->username]);

        $this->kernelBrowser->request('POST', '/login_check', [], [], [
            'CONTENT_TYPE' => 'application/json'
        ], json_encode([
            'username' => $user->getUsername(),
            'password' => 'test',
        ]));

        $response = $this->kernelBrowser->getResponse();
        $accessToken = json_decode($response->getContent(), true);

        return $accessToken['token'];
    }

    /**
     * @param Response $response
     * @param array $json
     * @param bool $weak
     */
    protected function assertCollectionOperation(Response $response, array $json, bool $weak = false)
    {
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('hydra:totalItems', $json);
        $this->assertGreaterThan(0, $json['hydra:totalItems']);

        $this->assertArrayHasKey('hydra:member', $json);

        if (!$weak) {
            $this->assertCount(30, $json['hydra:member']);
        }
    }

    /**
     * @param Response $response
     * @param array $json
     */
    protected function assertItemOperation(Response $response, array $json)
    {
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/ld+json; charset=utf-8', $response->headers->get('Content-Type'));

        $this->assertArrayHasKey('@context', $json);
        $this->assertArrayHasKey('@id', $json);
        $this->assertArrayHasKey('@type', $json);
    }
}
