<?php

declare(strict_types=1);

namespace DolbyApi;

use DolbyApi\Exceptions\ApiTypeException;
use Generator;
use Saloon\Http\Connector;
use Saloon\Contracts\Request;
use DolbyApi\Responses\DolbyResponse;
use DolbyApi\Resource\MediaApiResource;

class DolbyApi extends Connector
{
    /**
     * Define the custom response
     *
     * @var string
     */
    protected ?string $response = DolbyResponse::class;

    public function __construct(string $token)
    {
        $this->withTokenAuth($token);
    }

    /**
     * Resolve the base URL of the service.
     *
     * @return string
     */
    public function resolveBaseUrl(): string
    {
        return 'https://api.dolby.com';
    }

    /**
     * Define default headers
     *
     * @return string[]
     */
    protected function defaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    /**
     * Define default config
     *
     * @return string[]
     */
    protected function defaultConfig(): array
    {
        return [
            'timeout' => 120,
        ];
    }

    public function api(string $apiType): MediaApiResource
    {
        return match($apiType) {
            'media' => new MediaApiResource($this),
            default => throw new ApiTypeException(sprintf('The %s API type is invalid', $apiType)),
        };
    }
}
