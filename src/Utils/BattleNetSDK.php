<?php

namespace App\Utils;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BattleNetSDK
{
    /** @var Client $client */
    private $client;

    /** @var string $client_id */
    private $client_id;

    /** @var string $client_secret */
    private $client_secret;

    /** @var SessionInterface $session */
    private $session;

    /** @var FilesystemAdapter $cacheManager */
    private $cacheManager;

    const LONG_TIME = 86400; //1 day to seconds
    const SHORT_TIME = 600; //10 minutes to seconds

    /**
     * BattleNetSDK constructor.
     * @param string $client_id
     * @param string $client_secret
     * @param string $kernelCacheDir
     * @param SessionInterface $session
     */
    public function __construct(string $client_id, string $client_secret, string $kernelCacheDir,
                                SessionInterface $session)
    {
        $this->client = new Client([
            'base_uri' => 'https://eu.api.blizzard.com/',
            'timeout' => 10,
        ]);

        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->session = $session;
        $this->cacheManager = new FilesystemAdapter("BattleNetSDK", self::SHORT_TIME, $kernelCacheDir);
    }

    /**
     * @return array
     */
    public function getRealms()
    {
        return $this->cacheHandle(function () {
            $response = $this->client->request('GET', '/data/wow/realm/', [
                'query' => [
                    'namespace' => 'dynamic-eu',
                    'locale' => 'fr_FR',
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            $content = $this->getJsonContent($response);
            $realms = $content['realms'];
            $realms = array_combine(array_column($realms, 'name'), array_column($realms, 'slug'));

            return $realms;

        }, 'realms', self::LONG_TIME);
    }

    /**
     * @param string $slug
     * @return array
     */
    public function getRealm(string $slug)
    {
        return $this->cacheHandle(function () use ($slug) {
            $response = $this->client->request('GET', sprintf('/data/wow/realm/%s', $slug), [
                'query' => [
                    'namespace' => 'dynamic-eu',
                    'locale' => 'fr_FR',
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, sprintf('realm_%s', $slug), self::LONG_TIME);
    }


    /**
     * @return string
     */
    private function generateAccessToken()
    {
        $response = $this->client->request("POST", "https://eu.battle.net/oauth/token", [
            'form_params' => ['grant_type' => 'client_credentials'],
            'auth' => [$this->client_id, $this->client_secret]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        $this->session->set('access_token', [
            'access_token' => $data['access_token'],
            'expires_at' => (new \DateTime())->add(new \DateInterval(sprintf("PT%sS", $data['expires_in'])))
        ]);

        return $this->session->get('access_token')['access_token'];
    }

    /**
     * @return string
     */
    private function getAccessToken()
    {
        if (!$this->session->has('access_token') || $this->session->has('access_token')['expires_at'] >= new \DateTime()) {
            return $this->generateAccessToken();
        }

        return $this->session->get('access_token')['access_token'];
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    private function getJsonContent(ResponseInterface $response)
    {
        $this->verifyStatus($response);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param ResponseInterface $response
     * @param int $code
     */
    private function verifyStatus(ResponseInterface $response, int $code = 200)
    {
        if ($response->getStatusCode() != $code) {
            throw new \Exception("Error");
        }
    }

    /**
     * @param callable $callback
     * @param string $itemName
     * @param int $expiresAfter
     * @return mixed
     */
    private function cacheHandle(callable $callback, string $itemName, int $expiresAfter = 600)
    {
        $cacheContent = $this->cacheManager->getItem($itemName);
        if ($cacheContent->isHit()) {
            return $cacheContent->get();
        }

        $this->cacheManager->save($cacheContent->expiresAfter($expiresAfter)->set($callback()));

        return $cacheContent->get();
    }
}
