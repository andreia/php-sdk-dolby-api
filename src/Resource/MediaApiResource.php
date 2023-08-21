<?php

namespace DolbyApi\Resource;

use DolbyApi\Requests\MediaApi\GetAnalyzeMusicStatus;
use DolbyApi\Requests\MediaApi\GetAnalyzeSpeechStatus;
use DolbyApi\Requests\MediaApi\GetAnalyzeStatus;
use DolbyApi\Requests\MediaApi\GetDiagnoseStatus;
use DolbyApi\Requests\MediaApi\GetDownloadUrl;
use DolbyApi\Requests\MediaApi\GetEnhanceStatus;
use DolbyApi\Requests\MediaApi\GetUploadUrl;
use DolbyApi\Requests\MediaApi\StartAnalyze;
use DolbyApi\Requests\MediaApi\StartAnalyzeMusic;
use DolbyApi\Requests\MediaApi\StartAnalyzeSpeech;
use DolbyApi\Requests\MediaApi\StartDiagnose;
use DolbyApi\Requests\MediaApi\StartEnhance;
use DolbyApi\Responses\DolbyResponse as Response;

class MediaApiResource extends Resource
{
    public function enhance(string $input, string $output): Response
    {
        return $this->connector->send(new StartEnhance($input, $output));
    }

    public function enhanceStatus(string $jobId): Response
    {
        return $this->connector->send(new GetEnhanceStatus($jobId));
    }

    public function getDownloadUrl(string $url): Response
    {
        return $this->connector->send(new GetDownloadUrl($url));
    }

    public function getUploadUrl(string $url): Response
    {
        return $this->connector->send(new GetUploadUrl($url));
    }

    public function diagnose(string $input, array $content): Response
    {
        return $this->connector->send(new StartDiagnose($input, $content));
    }

    public function diagnoseStatus(string $jobId): Response
    {
        return $this->connector->send(new GetDiagnoseStatus($jobId));
    }

    public function analyze(string $input, string $output, array $loudness, array $content = ['type' => '']): Response
    {
        return $this->connector->send(new StartAnalyze($input, $output, $loudness, $content));
    }

    public function analyzeStatus(string $jobId): Response
    {
        return $this->connector->send(new GetAnalyzeStatus($jobId));
    }

    public function analyzeSpeech(string $input, string $output, array $onComplete): Response
    {
        return $this->connector->send(new StartAnalyzeSpeech($input, $output, $onComplete));
    }

    public function analyzeSpeechStatus(string $jobId): Response
    {
        return $this->connector->send(new GetAnalyzeSpeechStatus($jobId));
    }

    public function analyzeMusic(string $input, string $output, array $onComplete): Response
    {
        return $this->connector->send(new StartAnalyzeMusic($input, $output, $onComplete));
    }

    public function analyzeMusicStatus(string $jobId): Response
    {
        return $this->connector->send(new GetAnalyzeMusicStatus($jobId));
    }
}
