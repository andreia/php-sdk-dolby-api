<?php

declare(strict_types=1);

namespace DolbyApi\Requests\MediaApi;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class GetDownloadUrl extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * HTTP Method
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    public function __construct(
        protected string $url,
    ){}

    protected function defaultBody(): array
    {
        return [
            'url' => $this->url,
        ];
    }

    /**
     * Get Download URL
     *
     * Download media you previously uploaded with /media/input or media that was generated through another Dolby Media API.
     *
     * @see https://docs.dolby.io/media-apis/reference/media-output-post
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/media/output';
    }
}
