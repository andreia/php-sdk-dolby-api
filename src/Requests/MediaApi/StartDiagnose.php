<?php

declare(strict_types=1);

namespace DolbyApi\Requests\MediaApi;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class StartDiagnose extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * HTTP Method
     */
    protected Method $method = Method::POST;

    public function __construct(
        protected string $input,
        protected array $content,
    ) {}

    protected function defaultBody(): array
    {
        return [
            'input' => $this->input,
            'content' => $this->content,
        ];
    }

    /**
     * Start Diagnosing
     *
     * Quick diagnosis for discovering audio quality issues with your media.
     *
     * @see https://docs.dolby.io/media-apis/reference/media-diagnose-post
     */
    public function resolveEndpoint(): string
    {
        return '/media/diagnose';
    }
}
