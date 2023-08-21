<?php

declare(strict_types=1);

use DolbyApi\DolbyApi;
use DolbyApi\Requests\MediaApi\StartAnalyze;
use DolbyApi\Responses\DolbyResponse;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

test('can post to analyze media', function () {
    $mockClient = mockClient();
    $dolbyApi = new DolbyApi('my-api-token');
    $dolbyApi->withMockClient($mockClient);

    $input = 'https://dolbyio.s3-us-west-1.amazonaws.com/public/shelby/tunnel.original.mp4';
    $output = 'dlb://analyze_out';
    $loudness = ['profile' => 'service_amazon'];
    $content = ['type' => ''];

    $response = $dolbyApi->send(new StartAnalyze($input, $output, $loudness, $content));

    $mockClient->assertSent(StartAnalyze::class);

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request instanceof StartAnalyze
            && $response->body() == '{"job_id":"fn708637-9f78-4023-32la-1285r04627ac"}';
    });

    expect($response)->toBeInstanceOf(DolbyResponse::class);
});
