<?php

declare(strict_types=1);

namespace DolbyApi\Requests\MediaApi;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class GetUploadUrl extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * HTTP Method
     */
    protected Method $method = Method::POST;

    public function __construct(
        protected string $url,
    ) {}

    protected function defaultBody(): array
    {
        return [
            'url' => $this->url,
        ];
    }

    /**
     * Get Upload URL
     *
     * Return a pre-signed url you can use to PUT and upload your media file.
     *
     * @see https://docs.dolby.io/media-apis/reference/media-input-post
     */
    public function resolveEndpoint(): string
    {
        return '/media/input';
    }
}
