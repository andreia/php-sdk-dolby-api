<?php

declare(strict_types=1);

use DolbyApi\DolbyApi;
use DolbyApi\Requests\MediaApi\StartDiagnose;
use DolbyApi\Responses\DolbyResponse;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

test('can post to diagnose media', function () {
    $mockClient = mockClient();
    $dolbyApi = new DolbyApi('my-api-token');
    $dolbyApi->withMockClient($mockClient);

    $input = 'https://dolbyio.s3-us-west-1.amazonaws.com/public/shelby/tunnel.original.mp4';
    $content = ['type' => 'mobile_phone'];

    $response = $dolbyApi->send(new StartDiagnose($input, $content));

    $mockClient->assertSent(StartDiagnose::class);

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request instanceof StartDiagnose
            && $response->body() == '{"job_id":"sn708637-9t78-4023-32la-1285r04652ac"}';
    });

    expect($response)->toBeInstanceOf(DolbyResponse::class);
});
