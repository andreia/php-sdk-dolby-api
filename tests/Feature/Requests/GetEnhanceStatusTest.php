<?php

declare(strict_types=1);

use DolbyApi\DolbyApi;
use DolbyApi\Requests\MediaApi\GetEnhanceStatus;
use DolbyApi\Responses\DolbyResponse;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

test('can retrieve enhance status from the api', function () {
    $mockClient = mockClient();
    $dolbyApi = new DolbyApi('my-api-token');
    $dolbyApi->withMockClient($mockClient);

    $jobId = 'fn708637-9f78-4023-32la-1285r04627ac';

    $response = $dolbyApi->send(new GetEnhanceStatus($jobId));

    $mockClient->assertSent(GetEnhanceStatus::class);

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request instanceof GetEnhanceStatus
            && $response->body() == '{"path":"/media/enhance","status":"Success","progress":100,"api_version":"v1.1.2","result":{}}"';
    });

    expect($response)->toBeInstanceOf(DolbyResponse::class);
});
