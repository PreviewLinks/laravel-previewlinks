<?php

namespace PreviewLinks;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PreviewLinks
{
    public const API_BASE_URL = 'https://previewlinks.io/api/v1';

    public const GENERATE_BASE_URL = 'https://previewlinks.io/generate';

    public function http(): PendingRequest
    {
        return Http::withToken(config('previewlinks.api_token'))
            ->baseUrl(static::API_BASE_URL);
    }

    public function listSites(): Response
    {
        return $this->http()->get('/sites');
    }

    public function showSite(int $siteId): Response
    {
        return $this->http()->get("/sites/{$siteId}");
    }

    public function listSiteTemplates(int $siteId): Response
    {
        return $this->http()->get("/sites/{$siteId}/templates");
    }

    public function downloadImage(int $siteId, int $templateId, array $fields): Response
    {
        return $this->http()->post("/sites/{$siteId}/templates/{$templateId}/download", [
            'fields' => $fields,
        ]);
    }

    public function signedImageUrl(int $templateId, array $fields): string
    {
        $base64Fields = base64_encode(json_encode($fields));

        $signature = hash_hmac(
            'sha256',
            $base64Fields,
            config('previewlinks.api_token'),
        );

        return static::GENERATE_BASE_URL . "/templates/{$templateId}/signed?fields={$base64Fields}&signature={$signature}";
    }
}
