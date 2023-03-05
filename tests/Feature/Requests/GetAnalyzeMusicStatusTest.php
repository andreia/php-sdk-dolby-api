<?php

declare(strict_types=1);

use DolbyApi\DolbyApi;
use DolbyApi\Requests\MediaApi\GetAnalyzeMusicStatus;
use DolbyApi\Responses\DolbyResponse;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

test('can retrieve analyze music status from the api', function () {
    $mockClient = mockClient();
    $dolbyApi = new DolbyApi('my-api-token');
    $dolbyApi->withMockClient($mockClient);

    $jobId = 'fn708637-9f78-4023-32la-1285r04627ac';

    $response = $dolbyApi->send(new GetAnalyzeMusicStatus($jobId));

    $mockClient->assertSent(GetAnalyzeMusicStatus::class);

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request instanceof GetAnalyzeMusicStatus
            && $response->body() == "{\"job_id\":\"fn708637-9f78-4023-32la-1285r04627ac\"}";
    });

    expect($response)->toBeInstanceOf(DolbyResponse::class);
});
