<?php

declare(strict_types=1);

use DolbyApi\DolbyApi;
use DolbyApi\Requests\MediaApi\GetDiagnoseStatus;
use DolbyApi\Responses\DolbyResponse;
use Saloon\Contracts\Request;
use Saloon\Contracts\Response;

test('can retrieve diagnose status from the api', function () {
    $mockClient = mockClient();
    $dolbyApi = new DolbyApi('my-api-token');
    $dolbyApi->withMockClient($mockClient);

    $jobId = 'fn708637-9f78-4023-32la-1285r04627ac';

    $response = $dolbyApi->send(new GetDiagnoseStatus($jobId));

    $mockClient->assertSent(GetDiagnoseStatus::class);

    $mockClient->assertSent(function (Request $request, Response $response) {
        return $request instanceof GetDiagnoseStatus
            && $response->body() == '{"path":"/media/diagnose","status":"Success","progress":100,"api_version":"b1.0","result":{"media_info":{"container":{"kind":"mp4","duration":10.45,"bitrate":822169,"size":1073958},"audio":{"codec":"aac","channels":2,"sample_rate":44100,"duration":10.45,"bitrate":96000},"video":{"codec":"h264","frame_rate":30,"height":360,"width":640,"duration":10.45,"bitrate":711452}},"audio":{"quality_score":{"average":3.7,"distribution":[{"lower_bound":0,"upper_bound":1,"duration":0,"percentage":0},{"lower_bound":1,"upper_bound":2,"duration":0,"percentage":0},{"lower_bound":2,"upper_bound":3,"duration":2.5,"percentage":26.3},{"lower_bound":3,"upper_bound":4,"duration":3,"percentage":31.6},{"lower_bound":4,"upper_bound":5,"duration":4,"percentage":42.1},{"lower_bound":5,"upper_bound":6,"duration":0,"percentage":0},{"lower_bound":6,"upper_bound":7,"duration":0,"percentage":0},{"lower_bound":7,"upper_bound":8,"duration":0,"percentage":0},{"lower_bound":8,"upper_bound":9,"duration":0,"percentage":0},{"lower_bound":9,"upper_bound":10,"duration":0,"percentage":0}],"worst_segment":{"start":3.5,"end":8.5,"score":3.3}},"noise_score":{"average":0.9,"distribution":[{"lower_bound":0,"upper_bound":1,"duration":7,"percentage":73.7},{"lower_bound":1,"upper_bound":2,"duration":0.5,"percentage":5.3},{"lower_bound":2,"upper_bound":3,"duration":0.5,"percentage":5.3},{"lower_bound":3,"upper_bound":4,"duration":1,"percentage":10.5},{"lower_bound":4,"upper_bound":5,"duration":0.5,"percentage":5.3},{"lower_bound":5,"upper_bound":6,"duration":0,"percentage":0},{"lower_bound":6,"upper_bound":7,"duration":0,"percentage":0},{"lower_bound":7,"upper_bound":8,"duration":0,"percentage":0},{"lower_bound":8,"upper_bound":9,"duration":0,"percentage":0},{"lower_bound":9,"upper_bound":10,"duration":0,"percentage":0}]},"clipping":{"events":0},"loudness":{"measured":-14.91,"range":2.26,"gating_mode":"speech","sample_peak":-0.82,"true_peak":-0.81},"music":{"percentage":0},"silence":{"percentage":0,"at_beginning":0,"at_end":0,"num_sections":0,"silent_channels":[]},"speech":{"percentage":100,"events":{"plosive":6,"sibilance":0}}}}}';
    });

    expect($response)->toBeInstanceOf(DolbyResponse::class);
});
