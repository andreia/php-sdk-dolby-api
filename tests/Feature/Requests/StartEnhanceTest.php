<?php

declare(strict_types=1);

use DolbyApi\DolbyApi;
use DolbyApi\Requests\MediaApi\StartEnhance;
use DolbyApi\Responses\DolbyResponse;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

test('can post to enhance media', function () {
    $mockClient = mockClient();
    $dolbyApi = new DolbyApi('my-api-token');
    $dolbyApi->withMockClient($mockClient);

    $input = 'https://dolbyio.s3-us-west-1.amazonaws.com/public/shelby/tunnel.original.mp4';
    $output = 'dlb://example_out';

    $response = $dolbyApi->send(new StartEnhance($input, $output));

    $mockClient->assertSent(StartEnhance::class);

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request instanceof StartEnhance
            && $response->body() == "{\"job_id\":\"5879da3d-ad3c-4798-h2f8-21eb61573d2e\"}";
    });

    expect($response)->toBeInstanceOf(DolbyResponse::class);
});
