<?php

declare(strict_types=1);

use DolbyApi\DolbyApi;
use DolbyApi\Requests\MediaApi\GetUploadUrl;
use DolbyApi\Responses\DolbyResponse;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

test('can retrieve upload url from the api', function () {
    $mockClient = mockClient();
    $dolbyApi = new DolbyApi('my-api-token');
    $dolbyApi->withMockClient($mockClient);

    $url = 'dlb://input/file.wav';

    $response = $dolbyApi->send(new GetUploadUrl($url));

    $mockClient->assertSent(GetUploadUrl::class);

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request instanceof GetUploadUrl
            && $response->body() == "{\"url\":\"https:\\/\\/media-api-proxfyprug.s3-accelerate.amazonaws.com\\/1129d723-42e6-40c6-a35d-07986d1be4af\\/input\\/file.wav?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Credential=ASIA2N2ZL3VQGKHMR3VL%2F20230228%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20230228T184217Z&X-Amz-Expires=3600&X-Amz-Security-Token=IQoJb3JpZ2luX2VjENgE1Y7Ha79hu...CNX%2BH%2BV8%3D&X-Amz-Signature=d866b39b680172ae5a0e084c2d08c54008d18970&X-Amz-SignedHeaders=host&x-id=PutObject\"}";
    });

    expect($response)->toBeInstanceOf(DolbyResponse::class);
});
