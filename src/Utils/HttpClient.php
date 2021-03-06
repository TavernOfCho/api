<?php


namespace App\Utils;


class HttpClient
{
    private $kernelEnv;

    public function __construct($kernelEnv)
    {
        $this->kernelEnv = $kernelEnv;
    }

    public function __invoke(string $url, string $jwt, string $postData)
    {
        $result = file_get_contents($url, false, stream_context_create(['http' => [
            'method' => 'POST',
            'header' => "Content-type: application/x-www-form-urlencoded\r\nAuthorization: Bearer $jwt",
            'content' => $postData,
        ]]));

        if (false === $result) {
            throw new \RuntimeException(sprintf('Unable to publish the update to the Mercure hub: %s', error_get_last()['message'] ?? 'unknown error'));
        }

        return $result;
    }
}
