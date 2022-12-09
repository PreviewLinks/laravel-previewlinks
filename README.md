# PreviewLinks for Laravel

This is the official [PreviewLinks](https://previewlinks.io) client for Laravel.

## Installation

You can install the package via Composer:

```bash
composer require previewlinks/laravel-previewlinks
```

## Usage

### Configuration

You can set an API token in your `.env` by using `PREVIEWLINKS_API_TOKEN`.

```php
return [

    /**
     * PreviewLinks API token
     *
     * Obtain one from https://previewlinks.io/app/account
     */
    'api_token' => env('PREVIEWLINKS_API_TOKEN'),

];
```

### Methods

```php
use PreviewLinks\PreviewLinks;

/** @var PreviewLinks $previewlinks */
$previewlinks = app(PreviewLinks::class);

$sites = $previewlinks->listSites();

$site = $previewlinks->showSite(siteId: 1);

$siteTemplates = $previewlinks->listSiteTemplates(siteId: 1);

// This will return a JSON response with the image URL, the request may take 4 to 8 seconds to complete
$downloadableImageUrl = $previewlinks->downloadImage(siteId: 1, templateId: 1, fields: [
    'previewlinks:title' => 'Hello from Laravel',
    'previewlinks:cta' => 'This is an example',
]);

// This method makes no API requests, we advise to use this over `downloadImage`
$signedImageUrl = $previewlinks->signedImageUrl(templateId: 1, [
    'previewlinks:title' => 'Hello from Laravel',
    'previewlinks:cta' => 'This is an example',
]);
```

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Logan Craft](https://github.com/craftlogan)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
