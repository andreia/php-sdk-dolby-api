<?php

declare(strict_types=1);

use DolbyApi\DolbyApi;
use DolbyApi\Requests\MediaApi\StartAnalyzeSpeech;
use DolbyApi\Responses\DolbyResponse;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

test('can post to analyze speech', function () {
    $mockClient = mockClient();
    $dolbyApi = new DolbyApi('my-api-token');
    $dolbyApi->withMockClient($mockClient);

    $input = 'https://dolbyio.s3-us-west-1.amazonaws.com/public/shelby/tunnel.original.mp4';
    $output = 'dlb://analyze_speech_out';
    $onComplete = ["url" => "https://docs.dolby.io/"];

    $response = $dolbyApi->send(new StartAnalyzeSpeech($input, $output, $onComplete));

    $mockClient->assertSent(StartAnalyzeSpeech::class);

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request instanceof StartAnalyzeSpeech
            && $response->body() == "{\"job_id\":\"sn708637-9t78-4023-32la-1285r04652ac\"}";
    });

    expect($response)->toBeInstanceOf(DolbyResponse::class);
});
