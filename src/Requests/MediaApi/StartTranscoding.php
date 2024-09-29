<?php

declare(strict_types=1);

namespace DolbyApi\Requests\MediaApi;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class StartTranscoding extends Request implements HasBody
{
    use HasJsonBody;

    /**
     * HTTP Method
     */
    protected Method $method = Method::POST;

    public function __construct(
        protected array $inputs,
        protected array $outputs,
        protected ?array $storage,
        protected ?array $onComplete,
    ) {}

    protected function defaultBody(): array
    {
        $body = [
            'inputs' => [$this->inputs],
            'outputs' => [$this->outputs],
        ];

        if ($this->storage !== null) {
            $body['storage'] = $this->storage;
        }

        if ($this->onComplete !== null) {
            $body['on_complete'] = $this->onComplete;
        }

        return $body;
    }

    /**
     * Start Transcoding
     *
     * Start transcoding to modify the size, bitrates, and formats for your media.
     *
     * @see https://docs.dolby.io/media-apis/reference/media-transcode-post
     */
    public function resolveEndpoint(): string
    {
        return '/media/transcode';
    }
}
