<?php

declare(strict_types=1);

namespace Guzzle;

use ApiClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Client\ClientInterface;

class GuzzleApiClient implements ApiClient
{
    public function __construct(private ClientInterface $client) {}

    public function search(string $url, array $params): array
    {
        try {
            return json_decode(
                $this->client->request('GET', $url, ['form_params' => $params])
                    ->getBody()
                    ->getContents(), true
            );
        } catch (GuzzleException $e) {
            /** TODO: error handling or logging*/
            throw new \Exception($e->getMessage());
        }
    }
}
