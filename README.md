# PHP SDK for Dolby API

Provides a PHP wrapper for [Dolby API](https://docs.dolby.io/).

## Installation

Installing via Composer:

```bash
composer require andreia/php-sdk-dolby-api
```

## Usage

### Instantiate the API class

```php
use DolbyApi\DolbyApi;

$dolbyApi = new DolbyApi('your-api-token');
```

### Media APIs

Media API 
https://docs.dolby.io/media-apis/docs

```php
$dolbyApi->api('media')
```

#### [Enhance API](https://docs.dolby.io/media-apis/docs/enhance-api-guide)

[Start Enhancing](https://docs.dolby.io/media-apis/reference/media-enhance-post)

```php
$dolbyApi->api('media')->enhance('input-string', 'output-string');
```

E.g.:
```php
$startEnhance = $dolbyApi->api('media')->enhance('https://dolbyio.s3-us-west-1.amazonaws.com/public/shelby/tunnel.original.mp4', 'dlb://example_out');

$startEnhance->body(); // "{"job_id":"5970da3d-cdbc-4128-b2f8-21ab61573d2e"}"
$startEnhance->json(); // decoded body: [ "job_id" => "44fccc05-54cc-4bda-84ba-a8c9ee4b8335"]
$startEnhance->status(); // 200
```

[Get Enhance Results](https://docs.dolby.io/media-apis/reference/media-enhance-get)

```php
$dolbyApi->api('media')->enhanceStatus('job-id');
```

E.g.:
```php
$enhanceStatus = $dolbyApi->api('media')->enhanceStatus('44fccc05-54cc-4bda-84ba-a8c9ee4b8335');
$enhanceStatus->body(); // {"path":"/media/enhance","status":"Success","progress":100,"api_version":"v1.1.2","result":{}}"
```

#### Input and Output API

**Input**

[Get Upload URL](https://docs.dolby.io/media-apis/reference/media-input-post)

```php
$uploadUrl = $dolbyApi->api('media')->getUploadUrl('your-dlb-url');
```

E.g.:
```php
$uploadUrl = $dolbyApi->api('media')->getUploadUrl('dlb://input/file.wav');
$uploadUrl->body(); // {"url":"https://media-api-proxfyprug.s3-accelerate.amazonaws.com/1129d723-42e6-40c6-a35d-07986d1be4af/input/file.wav?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Credential=ASIA2N2ZL3VQGKHMR3VL%2F20230228%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20230228T184217Z&X-Amz-Expires=3600&X-Amz-Security-Token=IQoJb3a79hu6%2B52SmSMc...CN20ld5RdKNOCNX%2BH%2BV8%3D&X-Amz-Signature=d866b39b6...54008d18970&X-Amz-SignedHeaders=host&x-id=PutObject"} 
```

**Output**

[Get Download URL](https://docs.dolby.io/media-apis/reference/media-output-post)

```php
$mediaDownloadResponse = $dolbyApi->api('media')->getDownloadUrl('your-dlb-url');
```

E.g:
```php
$mediaDownloadResponse = $dolbyApi->api('media')->getDownloadUrl('dlb://example_out');
$mediaDownloadResponse->body(); // {"url":"https://media-api-proxfyprug.s3-accelerate.amazonaws.com/1129d723-42e6-40c6-a35d-07986d1be4af/example_out?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Credential=ASIA2N2ZL3VQJGFYC2XN%2F20230228%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20230228T180833Z&X-Amz-Expires=3600&X-Amz-Security-Token=IQoJb3JpZ2luX2V..XFAHFKaFjPaCd%2Bk%3D&X-Amz-Signature=2cd8a66224c...3614e79d65d0fb2&X-Amz-SignedHeaders=host&x-id=GetObject"}
```

E.g. response with error:
```php
[
  "type" => "/problems/validation-error"
  "title" => "Your request parameters didn't validate"
  "status" => 400
  "instance" => "/media/output"
  "detail" => "Request body contains invalid json"
]
```

#### [Auto Diagnose API](https://docs.dolby.io/media-apis/docs/diagnose-api-guide)

[Start Diagnosing](https://docs.dolby.io/media-apis/reference/media-diagnose-post)

```php
$diagnoseResponse = $dolbyApi->api('media')->diagnose('input-string', 'content-array');
```

E.g.:
```php
$diagnoseResponse = $dolbyApi->api('media')->diagnose('https://dolbyio.s3-us-west-1.amazonaws.com/public/shelby/tunnel.original.mp4', ['type' => 'mobile_phone']);
$diagnoseResponse->body(); // "{"job_id":"671230t0-e785-4472-b4w3-c57fa31u645b"}"
```

[Get Diagnose Results](https://docs.dolby.io/media-apis/reference/media-diagnose-get)

```php
$diagnoseStatusResponse = $dolbyApi->api('media')->diagnoseStatus('job-id');
```

E.g.:
```php
$diagnoseStatusResponse = $dolbyApi->api('media')->diagnoseStatus('174230d0-e785-4472-b4a3-c57fa31f665b');
$diagnoseStatusResponse->body();  // "{"path":"/media/diagnose","status":"Success","progress":100,"api_version":"b1.0","result":{"media_info":{"container":{"kind":"mp4","duration":10.45,"bitrate":822169,"size":1073958},"audio":{"codec":"aac","channels":2,"sample_rate":44100,"duration":10.45,"bitrate":96000},"video":{"codec":"h264","frame_rate":30,"height":360,"width":640,"duration":10.45,"bitrate":711452}},"audio":{"quality_score":{"average":3.7,"distribution":[{"lower_bound":0,"upper_bound":1,"duration":0,"percentage":0},{"lower_bound":1,"upper_bound":2,"duration":0,"percentage":0},{"lower_bound":2,"upper_bound":3,"duration":2.5,"percentage":26.3},{"lower_bound":3,"upper_bound":4,"duration":3,"percentage":31.6},{"lower_bound":4,"upper_bound":5,"duration":4,"percentage":42.1},{"lower_bound":5,"upper_bound":6,"duration":0,"percentage":0},{"lower_bound":6,"upper_bound":7,"duration":0,"percentage":0},{"lower_bound":7,"upper_bound":8,"duration":0,"percentage":0},{"lower_bound":8,"upper_bound":9,"duration":0,"percentage":0},{"lower_bound":9,"upper_bound":10,"duration":0,"percentage":0}],"worst_segment":{"start":3.5,"end":8.5,"score":3.3}},"noise_score":{"average":0.9,"distribution":[{"lower_bound":0,"upper_bound":1,"duration":7,"percentage":73.7},{"lower_bound":1,"upper_bound":2,"duration":0.5,"percentage":5.3},{"lower_bound":2,"upper_bound":3,"duration":0.5,"percentage":5.3},{"lower_bound":3,"upper_bound":4,"duration":1,"percentage":10.5},{"lower_bound":4,"upper_bound":5,"duration":0.5,"percentage":5.3},{"lower_bound":5,"upper_bound":6,"duration":0,"percentage":0},{"lower_bound":6,"upper_bound":7,"duration":0,"percentage":0},{"lower_bound":7,"upper_bound":8,"duration":0,"percentage":0},{"lower_bound":8,"upper_bound":9,"duration":0,"percentage":0},{"lower_bound":9,"upper_bound":10,"duration":0,"percentage":0}]},"clipping":{"events":0},"loudness":{"measured":-14.91,"range":2.26,"gating_mode":"speech","sample_peak":-0.82,"true_peak":-0.81},"music":{"percentage":0},"silence":{"percentage":0,"at_beginning":0,"at_end":0,"num_sections":0,"silent_channels":[]},"speech":{"percentage":100,"events":{"plosive":6,"sibilance":0}}}}}"
```

#### [Analyse API](https://docs.dolby.io/media-apis/docs/analyze-api-guide)

[Start Analyzing](https://docs.dolby.io/media-apis/reference/media-analyze-post)

```php
$analyzeResponse = $dolbyApi->api('media')->analyze('input-string', 'output-string', ['profile' => 'selected-profile']);
```

E.g.:
```php
$loudness = [
    "profile" => "service_amazon",
];

$analyzeResponse = $dolbyApi->api('media')->analyze('https://dolbyio.s3-us-west-1.amazonaws.com/public/shelby/tunnel.original.mp4', 'dlb://analyze_out', $loudness);
$analyzeResponse->body(); // "{"job_id":"6202f5dd-21f7-433-8r66-42fta96c9f5e"}"
```

[Get Analyze Status](https://docs.dolby.io/media-apis/reference/media-analyze-get)

```php
$analyzeStatusResponse = $dolbyApi->api('media')->analyzeStatus('job-id');
```

E.g.:
```php
$analyzeStatusResponse = $dolbyApi->api('media')->analyzeStatus('6214f5ed-28t7-4961-8f26-40kcr96c9q5m');
$analyzeStatusResponse->body(); // "{"path":"/media/analyze","status":"Success","progress":100,"api_version":"b1.4","result":{}}"
```


#### [Analyse Speech API](https://docs.dolby.io/media-apis/docs/speech-analytics-api-guide)

[Start Analyzing Speech](https://docs.dolby.io/media-apis/reference/media-analyze-speech-post)

```php
$analyzeSpeechResponse = $dolbyApi->api('media')->analyzeSpeech('input-string', 'output-string', ["url" => "webhook-address-to-be-called-on-complete"]);
```

E.g.:
```php
$analyzeSpeechResponse = $dolbyApi->api('media')->analyzeSpeech('https://dolbyio.s3-us-west-1.amazonaws.com/public/shelby/tunnel.original.mp4', 'dlb://analyze_speech_out', ["url" => "https://webhookaddresstobecalledoncomplete.com/"]);
$analyzeSpeechResponse->body(); // "{"job_id":"1ba639sd-d876-46ga-845w-33ec4c5cer00"}"
```

[Get Analyze Speech Status](https://docs.dolby.io/media-apis/reference/media-analyze-speech-get)

```php
$analyzeSpeechStatusResponse = $dolbyApi->api('media')->analyzeSpeechStatus('job-id');
```

E.g.:
```php
$analyzeSpeechStatusResponse = $dolbyApi->api('media')->analyzeSpeechStatus('1ba639sd-d876-46ga-845w-33ec4c5cer00');
$analyzeSpeechStatusResponse->body(); // "{"path":"/media/analyze/speech","status":"Success","progress":100,"api_version":"b1.0","result":{}}"
```

#### [Analyse Music API](https://docs.dolby.io/media-apis/docs/analyze-music-api-guide)

[Start Analyzing Music](https://docs.dolby.io/media-apis/reference/media-analyze-music-post)

```php
$analyzeMusicResponse = $dolbyApi->api('media')->analyzeMusic('input-string', 'output-string', ["url" => "webhook-address-to-be-called-on-complete"]);
```

E.g.:
```php
$analyzeMusicResponse = $dolbyApi->api('media')->analyzeMusic('https://dolbyio.s3-us-west-1.amazonaws.com/public/shelby/tunnel.original.mp4', 'dlb://analyze_music_out', ["url" => "https://webhookaddresstobecalledoncomplete.com/"]);
$analyzeMusicResponse->body(); // "{"job_id":"0c1fae6e-39e5-4a36-a076-bf3315d5179f"}"
```

[Get Analyze Music Status](https://docs.dolby.io/media-apis/reference/media-analyze-music-get)

```php
$analyzeMusicStatusResponse = $dolbyApi->api('media')->analyzeMusicStatus('job-id');
```

E.g.:
```php
$analyzeMusicStatusResponse = $dolbyApi->api('media')->analyzeMusicStatus('0c1faw6e-39e5-4a36-a056-af3615e5189f');
$analyzeMusicStatusResponse->body(); // "{"path":"/media/analyze/music","status":"Success","progress":100,"api_version":"b1.0","result":{}}"
```

#### [Transcode API](https://docs.dolby.io/media-apis/docs/transcode-api-guide)

[Start Transcoding](https://docs.dolby.io/media-apis/reference/media-transcode-post)

```php
$transcodingResponse = $dolbyApi->api('media')->transcode('inputs-array', 'outputs-array', 'optional-storage-array', 'optional-on-complete-array');
```

E.g.:
```php
$inputs = [
    'source' => 'https://dolbyio.s3-us-west-1.amazonaws.com/public/shelby/indoors.original.mp4'
];

$outputs = [
    "id" => "my_mp4",
    "destination" => "dlb://out/airplane-transcoded.mp4",
    "kind" => "mp4",
];

$transcodingResponse = $dolbyApi->api('media')->transcode($inputs, $outputs);
$transcodingResponse->body(); // "{"job_id":"0c1fae6e-39e5-4a36-a076-bf3315d5179f"}"
```

[Get Transcode Results](https://docs.dolby.io/media-apis/reference/media-transcode-get)

```php
$transcodeResultsResponse = $dolbyApi->api('media')->transcodeResults('job-id');
```

E.g.:
```php
$transcodeResultsResponse = $dolbyApi->api('media')->transcodeResults('0c1fae6e-39e5-4a36-a076-bf3315d5179f');
$transcodeResultsResponse->body(); // {"path":"/media/transcode","status":"Success","progress":100,"api_version":"v1.7","result":{}}
```

#### [Music Mastering API](https://docs.dolby.io/media-apis/docs/music-mastering-api-guide)

TODO


### Communication APIs

TODO

### Streaming APIs

TODO

## Sponsor

[💚️ Become a Sponsor](https://github.com/sponsors/andreia)

## Testing

```bash
./vendor/bin/pest
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Contributions are welcome! :)

## License

The MIT License (MIT). Read [License](LICENSE) for more information.
