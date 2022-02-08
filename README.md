# Previewify for Laravel

This is the official [Previewify](https://previewify.app) client for Laravel.

## Installation

You can install the package via Composer:

```bash
composer require flowframe/laravel-previewify
```

## Usage

### Configuration

You can set an API token in your `.env` by using `PREVIEWIFY_API_TOKEN`.

```php
return [

    /**
     * Previewify API token
     *
     * Obtain one from https://previewify.app/app/account
     */
    'api_token' => env('PREVIEWIFY_API_TOKEN'),

];
```

### Methods

```php
use Flowframe\Previewify\Previewify;

/** @var Previewify $previewify */
$previewify = app(Previewify::class);

$sites = $previewify->listSites();

$site = $previewify->showSite(siteId: 1);

$siteTemplates = $previewify->listSiteTemplates(siteId: 1);

// This will return a JSON response with the image URL, the request may take 4 to 8 seconds to complete
$downloadableImageUrl = $previewify->downloadImage(siteId: 1, templateId: 1, fields: [
    'previewify:title' => 'Hello from Laravel',
    'previewify:cta' => 'This is an example',
]);

// This method makes no API requests, we advise to use this over `downloadImage`
$signedImageUrl = $previewify->signedImageUrl(templateId: 1, [
    'previewify:title' => 'Hello from Laravel',
    'previewify:cta' => 'This is an example',
]);
```

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Lars Klopstra](https://github.com/flowframe)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
