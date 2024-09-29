<?php

declare(strict_types=1);

namespace DolbyApi\Requests\MediaApi;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetTranscodeResults extends Request
{
    /**
     * HTTP Method
     */
    protected Method $method = Method::GET;

    public function __construct(
        protected string $jobId,
    ) {}

    protected function defaultQuery(): array
    {
        return [
            'job_id' => $this->jobId,
        ];
    }

    /**
     * Get Transcode Results
     *
     * For a given job_id, this method will check if the transcoding task
     * has completed and return transcoding results.
     *
     * @see https://docs.dolby.io/media-apis/reference/media-transcode-get
     */
    public function resolveEndpoint(): string
    {
        return '/media/transcode';
    }
}
