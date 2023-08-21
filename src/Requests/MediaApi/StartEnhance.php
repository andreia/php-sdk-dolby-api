<?php

declare(strict_types=1);

namespace DolbyApi\Requests\MediaApi;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class StartEnhance extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * HTTP Method
     */
    protected Method $method = Method::POST;

    public function __construct(
        protected string $input,
        protected string $output,
    ) {
    }

    protected function defaultBody(): array
    {
        return [
            'input' => $this->input,
            'output' => $this->output,
        ];
    }

    /**
     * Start Enhancing
     *
     * Start enhancing to improve your media.
     *
     * @see https://docs.dolby.io/media-apis/reference/media-enhance-post
     */
    public function resolveEndpoint(): string
    {
        return '/media/enhance';
    }
}
