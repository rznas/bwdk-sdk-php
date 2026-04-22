# BWDK PHP SDK — Integration Guide for Agents

You are integrating **BWDK (Buy With DigiKala)** into a PHP project (Laravel / Symfony / Slim / CodeIgniter / Yii) via this SDK. Read this file **first**, then consult the companion references below.

## BWDK constants

- **Host:** `https://bwdk-backend.digify.shop`
- **Auth scheme:** `MerchantAPIKeyAuth` — header `Authorization: <api_key>`.
- **Main API class:** `OpenAPI\Client\Api\DefaultApi`.
- **Configuration class:** `OpenAPI\Client\Configuration`.
- **HTTP transport:** Guzzle (`GuzzleHttp\Client`) — required as a dependency of the host project.
- **PHP:** 8.1+.

## Companion references

| File                        | When to read                                                  |
|-----------------------------|---------------------------------------------------------------|
| `README.md`                 | Composer install, autoload wiring, and "Getting Started" example. Follow it verbatim. |
| `FLOWCHART.md`              | Canonical order state machine. All callback/webhook branching MUST match these state names. |
| `docs/Api/DefaultApi.md`    | Exact method names and signatures per endpoint.               |
| `docs/Model/*.md`           | Per-model reference (e.g. `docs/Model/OrderCreate.md`).       |

Do **not** duplicate install or method-signature details here — fetch `README.md`.

## Minimal wrapper pattern

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';

use OpenAPI\Client\Api\DefaultApi;
use OpenAPI\Client\Configuration;
use GuzzleHttp\Client as HttpClient;

$config = Configuration::getDefaultConfiguration()
    ->setHost('https://bwdk-backend.digify.shop')
    ->setApiKey('Authorization', getenv('BWDK_API_KEY'));

$api = new DefaultApi(new HttpClient(), $config);
$order = $api->orderApiV1CreateOrderCreate($payload);
```

Method names are camelCase and OpenAPI-generated (e.g. `orderApiV1CreateOrderCreate`, `orderApiV1ManagerVerifyCreate`). Look them up in `docs/Api/DefaultApi.md`; do **not** guess.

## Integration invariants

1. **SDK only.** Never call BWDK with raw Guzzle, `cURL` (`curl_*`), `file_get_contents`, or Symfony `HttpClient`.
2. **Callback flow.** After payment, BWDK redirects the customer to your `callback_url`. Load the order (`orderApiV1ManagerRetrieve`), switch on `$order->getStatus()` per `FLOWCHART.md`, then call `orderApiV1ManagerVerifyCreate` — `verify` is mandatory before `SHIPPED`.
3. **Errors.** Catch `OpenAPI\Client\ApiException`; inspect `->getCode()`, `->getResponseBody()`, `->getResponseHeaders()`. Retry only on transport errors, never on 4xx.
4. **Pinning.** Pin a concrete version in `composer.json` (matching a `vX.Y.Z` tag); do not use `dev-main` or `@dev` in production.

## Project conventions

- **Laravel:** bind `DefaultApi` as a singleton in a service provider; inject it via type-hint.
- **Symfony:** register it as a service in `services.yaml` with `$config` as a factory argument.
- **Autoload:** PSR-4 is expected — don't add manual `require` statements for generated classes; let Composer's autoloader handle it.
