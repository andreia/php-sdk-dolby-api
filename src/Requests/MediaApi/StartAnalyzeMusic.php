<?php

declare(strict_types=1);

namespace DolbyApi\Requests\MediaApi;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class StartAnalyzeMusic extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * HTTP Method
     */
    protected Method $method = Method::POST;

    public function __construct(
        protected string $input,
        protected string $output,
        protected array $onComplete,
    ) {}

    protected function defaultBody(): array
    {
        return [
            'input' => $this->input,
            'output' => $this->output,
            'on_complete' => $this->onComplete,
        ];
    }

    /**
     * Start Analyzing Music
     *
     * Start analyzing to learn about music in your media.
     *
     * @see https://docs.dolby.io/media-apis/reference/media-analyze-music-post
     */
    public function resolveEndpoint(): string
    {
        return '/media/analyze/music';
    }
}
