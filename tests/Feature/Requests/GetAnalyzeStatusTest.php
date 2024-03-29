<?php

declare(strict_types=1);

use DolbyApi\DolbyApi;
use DolbyApi\Requests\MediaApi\GetAnalyzeStatus;
use DolbyApi\Responses\DolbyResponse;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

test('can retrieve analyze status from the api', function () {
    $mockClient = mockClient();
    $dolbyApi = new DolbyApi('my-api-token');
    $dolbyApi->withMockClient($mockClient);

    $jobId = 'fn708637-9f78-4023-32la-1285r04627ac';

    $response = $dolbyApi->send(new GetAnalyzeStatus($jobId));

    $mockClient->assertSent(GetAnalyzeStatus::class);

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request instanceof GetAnalyzeStatus
            && $response->body() == '{"path":"/media/analyze","status":"Success","progress":100,"api_version":"b1.4","result":{}}';
    });

    expect($response)->toBeInstanceOf(DolbyResponse::class);
});
