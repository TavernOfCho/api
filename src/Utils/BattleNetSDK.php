<?php

namespace App\Utils;

use App\Exception\BattleNetException;
use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class BattleNetSDK
{
    /** @var HttpClientInterface $client */
    private $client;

    /** @var string $client_id */
    private $client_id;

    /** @var string $client_secret */
    private $client_secret;

    /** @var SessionInterface $session */
    private $session;

    /** @var FilesystemAdapter $cacheManager */
    private $cacheManager;

    /** @var string $locale */
    private $locale;

    const LONG_TIME = 86400; //1 day to seconds
    const SHORT_TIME = 600; //10 minutes to seconds

    /**
     * BattleNetSDK constructor.
     * @param string $client_id
     * @param string $client_secret
     * @param SessionInterface $session
     * @param CacheItemPoolInterface $cacheManager
     * @param HttpClientInterface $battleNetClient
     * @param Locale $locale
     */
    public function __construct(string $client_id, string $client_secret, SessionInterface $session,
                                CacheItemPoolInterface $cacheManager, HttpClientInterface $battleNetClient,
                                Locale $locale)
    {
        $this->client = $battleNetClient;
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->session = $session;
        $this->cacheManager = $cacheManager;
        $this->locale = $locale->getLocale();
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
                    'locale' => $this->locale,
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, $this->getCacheKey('realms'), self::LONG_TIME);
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
                    'locale' => $this->locale,
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, $this->getCacheKey(sprintf('realm_%s', $slug)), self::LONG_TIME);
    }

    /**
     * @param string $name
     * @param string $realm
     * @param string|null $fields
     * @return array
     */
    public function getCharacter(string $name, string $realm, string $fields = null)
    {
        return $this->cacheHandle(function () use ($name, $realm, $fields) {
            $response = $this->client->request('GET', sprintf('/wow/character/%s/%s', $realm, $name), [
                'query' => [
                    'region' => 'eu',
                    'fields' => $fields,
                    'locale' => $this->locale,
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, $this->getCacheKey(sprintf('character_%s_%s_%s', $realm, $name, $fields)), self::SHORT_TIME);
    }

    /**
     * @return array
     */
    public function getCharacterClasses()
    {
        return $this->cacheHandle(function () {
            $response = $this->client->request('GET', '/wow/data/character/classes', [
                'query' => [
                    'region' => 'eu',
                    'locale' => $this->locale,
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, $this->getCacheKey('character_classes'), self::LONG_TIME);
    }

    /**
     * @return array
     */
    public function getCharacterRaces()
    {
        return $this->cacheHandle(function () {
            $response = $this->client->request('GET', '/wow/data/character/races', [
                'query' => [
                    'region' => 'eu',
                    'locale' => $this->locale,
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, $this->getCacheKey('character_races'), self::LONG_TIME);
    }

    /**
     * @return array
     */
    public function getMounts()
    {
        return $this->cacheHandle(function () {
            $response = $this->client->request('GET', '/wow/mount/', [
                'query' => [
                    'region' => 'eu',
                    'locale' => $this->locale,
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, $this->getCacheKey('mount'), self::LONG_TIME);
    }


    /**
     * @param string $id
     * @return mixed
     */
    public function getAchievement(string $id)
    {
        return $this->cacheHandle(function () use ($id) {
            $response = $this->client->request('GET', sprintf('/wow/achievement/%s', $id), [
                'query' => [
                    'region' => 'eu',
                    'locale' => $this->locale,
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, $this->getCacheKey(sprintf('achievement_%s', $id)), self::LONG_TIME);
    }

    /**
     * @return array
     */
    public function getAchievements(): array
    {
        return $this->cacheHandle(function () {
            $response = $this->client->request('GET', '/wow/data/character/achievements', [
                'query' => [
                    'region' => 'eu',
                    'locale' => $this->locale,
                    'access_token' => $this->getAccessToken()
                ]
            ]);

            return $this->getJsonContent($response);
        }, $this->getCacheKey('achievements'), self::LONG_TIME);
    }

    /**
     * @return string
     */
    private function generateAccessToken()
    {
        $response = $this->client->request("POST", "https://eu.battle.net/oauth/token", [
            'body' => ['grant_type' => 'client_credentials'],
            'auth_basic' => [$this->client_id, $this->client_secret]
        ]);

        $data = json_decode($response->getContent(false), true);

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
        return json_decode($response->getContent(), true);
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

        $result = $this->handleResultAndNullResultCase($callback);

        $this->cacheManager->save($cacheContent->expiresAfter($expiresAfter)->set($result));

        return $cacheContent->get();
    }

    /**
     * @param int $timestamp
     * @return bool|string
     */
    public static function formatTimestamp($timestamp)
    {
        return substr_replace((string)$timestamp, '', -3);
    }

    /**
     * @param $timestamp
     * @return \DateTime
     */
    public static function timestampToDate($timestamp)
    {
        return (new \DateTime())->setTimestamp(self::formatTimestamp($timestamp));
    }

    /**
     * @param string $name
     * @return string
     */
    private function getCacheKey(string $name)
    {
        return sprintf("%s_%s", $name, $this->locale);
    }

    /**
     * @param callable $callback
     * @return array
     * @throws BattleNetException
     */
    private function handleResultAndNullResultCase(callable $callback)
    {
        // Used to launch a "try again" when the blizzard API returns a null result
        if (null === $result = $callback()) {
            $result = $callback();
        }

        // If the result is still null, then we throw an exception
        if (null === $result) {
            throw new BattleNetException();
        }

        return $result;
    }
}
