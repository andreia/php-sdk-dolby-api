<?php

declare(strict_types=1);

use DolbyApi\DolbyApi;
use DolbyApi\Requests\MediaApi\GetTranscodeResults;
use DolbyApi\Responses\DolbyResponse;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

test('can retrieve transcoding results from the api', function () {
    $mockClient = mockClient();
    $dolbyApi = new DolbyApi('my-api-token');
    $dolbyApi->withMockClient($mockClient);

    $jobId = 'tr988637-9fb8-4023-32lt-1285r04627st';

    $response = $dolbyApi->send(new GetTranscodeResults($jobId));

    $mockClient->assertSent(GetTranscodeResults::class);

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request instanceof GetTranscodeResults
            && $response->body() == '{"path":"/media/transcode","status":"Success","progress":100,"api_version":"b1.4","result":{}}';
    });

    expect($response)->toBeInstanceOf(DolbyResponse::class);
});
