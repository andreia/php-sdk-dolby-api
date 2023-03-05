<?php

declare(strict_types=1);

namespace DolbyApi\Requests\MediaApi;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class StartAnalyze extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * HTTP Method
     *
     * @var Method
     */
    protected Method $method = Method::POST;

    public function __construct(
        protected string $input,
        protected string $output,
        protected array $loudness,
        protected array $content,
    ){}

    protected function defaultBody(): array
    {
        return [
            'input' => $this->input,
            'output' => $this->output,
            'loudness' => $this->loudness,
            'content' => $this->content,
        ];
    }

    /**
     * Start Analyzing
     *
     * Start analyzing to learn about your media.
     *
     * @see https://docs.dolby.io/media-apis/reference/media-analyze-post
     *
     * @return string
     */
    public function resolveEndpoint(): string
    {
        return '/media/analyze';
    }
}
