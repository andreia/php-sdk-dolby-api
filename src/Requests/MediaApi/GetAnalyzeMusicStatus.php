<?php

declare(strict_types=1);

namespace DolbyApi\Requests\MediaApi;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class GetAnalyzeMusicStatus extends Request
{
    /**
     * HTTP Method
     */
    protected Method $method = Method::GET;

    public function __construct(
        protected string $jobId,
    ) {
    }

    protected function defaultQuery(): array
    {
        return [
            'job_id' => $this->jobId,
        ];
    }

    /**
     * Get Analyze Music Status
     *
     * For a given job_id, this method will check if the processing task has completed.
     *
     * @see https://docs.dolby.io/media-apis/reference/media-analyze-music-get
     */
    public function resolveEndpoint(): string
    {
        return '/media/analyze/music';
    }
}
