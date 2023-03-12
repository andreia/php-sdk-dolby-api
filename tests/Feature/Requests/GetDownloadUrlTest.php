<?php

declare(strict_types=1);

use DolbyApi\DolbyApi;
use DolbyApi\Requests\MediaApi\GetDownloadUrl;
use DolbyApi\Responses\DolbyResponse;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

test('can retrieve download url from the api', function () {
    $mockClient = mockClient();
    $dolbyApi = new DolbyApi('my-api-token');
    $dolbyApi->withMockClient($mockClient);

    $url = 'dlb://example_out';

    $response = $dolbyApi->send(new GetDownloadUrl($url));

    $mockClient->assertSent(GetDownloadUrl::class);

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request instanceof GetDownloadUrl
            && $response->body() == "{\"url\":\"https://media-api-proxfyprug.s3-accelerate.amazonaws.com/1129d723-42e6-40c6-a35d-07986d1be4af/example_out?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Credential=ASIA2N2ZL3VQJGFYC2XN%2F20230228%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20230228T180833Z&X-Amz-Expires=3600&X-Amz-Security-Token=IQoJb3JpZ2luX2...uciW1Zjouk%3D&X-Amz-Signature=2cd8a66224c1b44096782d8ac90a3614e79d65d0fb2&X-Amz-SignedHeaders=host&x-id=GetObject\"}";
    });

    expect($response)->toBeInstanceOf(DolbyResponse::class);
});
