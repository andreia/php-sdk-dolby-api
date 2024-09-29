<?php

declare(strict_types=1);

use DolbyApi\DolbyApi;
use DolbyApi\Requests\MediaApi\StartTranscoding;
use DolbyApi\Responses\DolbyResponse;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

/**
 * @see https://docs.dolby.io/media-apis/docs/transcoding-media
 */
test('can post to transcode', function () {
    $mockClient = mockClient();
    $dolbyApi = new DolbyApi('my-api-token');
    $dolbyApi->withMockClient($mockClient);

    $inputs = [
        'source' => 'https://dolbyio.s3-us-west-1.amazonaws.com/public/shelby/indoors.original.mp4',
    ];

    $outputs = [
        'id' => 'my_mp4',
        'destination' => 'dlb://out/airplane-transcoded.mp4',
        'kind' => 'mp4',
    ];

    $response = $dolbyApi->send(new StartTranscoding($inputs, $outputs));

    $mockClient->assertSent(StartTranscoding::class);

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request instanceof StartTranscoding
            && $response->body() == '{"job_id":"tr988637-9fb8-4123-62lt-1485r04627st"}';
    });

    expect($response)->toBeInstanceOf(DolbyResponse::class);
});
