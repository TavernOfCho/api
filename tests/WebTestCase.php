<?php

namespace App\Tests;

use App\Entity\User;
use Hautelook\AliceBundle\PhpUnit\RefreshDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;
use Symfony\Component\HttpFoundation\Response;

class WebTestCase extends BaseWebTestCase
{
    use RefreshDatabaseTrait;

    /** @var KernelBrowser */
    protected $kernelBrowser;

    /** @var User $user */
    protected $user;

    protected function setUp()
    {
        parent::setUp();

        $this->kernelBrowser = static::createClient();
        $this->kernelBrowser->setServerParameters([
            'HTTPS' => self::$container->getParameter('https'),
            'HTTP_HOST' => self::$container->getParameter('http_host')
        ]);
    }


    /**
     * @param string $method
     * @param string $uri
     * @param string|array|null $content
     * @param array $headers
     * @return Response
     */
    protected function request(string $method, string $uri, $content = null, array $headers = []): Response
    {
        $server = [
            'CONTENT_TYPE' => 'application/ld+json',
            'HTTP_ACCEPT' => 'application/ld+json',
            'HTTP_AUTHORIZATION' => sprintf('Bearer %s', $this->getAccessToken())
        ];
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

    protected function findOneIriBy(string $resourceClass, array $criteria): string
    {
        $resource = static::$container->get('doctrine')->getRepository($resourceClass)->findOneBy($criteria);

        return static::$container->get('api_platform.iri_converter')->getIriFromitem($resource);
    }

    protected function getAccessToken()
    {
        $this->kernelBrowser->request('POST', '/login_check', [], [], [
            'CONTENT_TYPE' => 'application/json'
        ], json_encode([
            'username' => $this->getUser()->getUsername(),
            'password' => $this->getUser()->getPlainPassword(),
        ]));

        $response = $this->kernelBrowser->getResponse();
        $accessToken = json_decode($response->getContent(), true);

        return $accessToken['token'];
    }

    /**
     * @return User
     */
    protected function getUser()
    {
        return $this->user ?: $this->user = static::$container->get('doctrine')->getRepository(User::class)->findOneBy([]);
    }


}
