<?php

declare(strict_types=1);

namespace DolbyApi;

use DolbyApi\Exceptions\ApiTypeException;
use DolbyApi\Resource\MediaApiResource;
use DolbyApi\Responses\DolbyResponse;
use Saloon\Http\Connector;

class DolbyApi extends Connector
{
    /**
     * Define the custom response
     */
    protected ?string $response = DolbyResponse::class;

    public function __construct(string $token)
    {
        $this->withTokenAuth($token);
    }

    /**
     * Resolve the base URL of the service.
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
        return match ($apiType) {
            'media' => new MediaApiResource($this),
            default => throw new ApiTypeException(sprintf('The %s API type is invalid', $apiType)),
        };
    }
}
