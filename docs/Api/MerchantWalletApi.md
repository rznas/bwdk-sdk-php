# OpenAPI\Client\MerchantWalletApi



All URIs are relative to https://bwdk-backend.digify.shop, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**walletsApiV1WalletBalanceRetrieve()**](MerchantWalletApi.md#walletsApiV1WalletBalanceRetrieve) | **GET** /wallets/api/v1/wallet-balance/ | Get Wallet Balance |


## `walletsApiV1WalletBalanceRetrieve()`

```php
walletsApiV1WalletBalanceRetrieve(): \OpenAPI\Client\Model\WalletBalance
```

Get Wallet Balance

<div dir=\"rtl\" style=\"text-align: right;\">  موجودی کیف پول فروشنده  ## توضیحات  این endpoint موجودی کیف پول فروشنده را برمی‌گرداند. کیف پول برای پرداخت هزینه ارسال دیجی‌اکسپرس استفاده می‌شود. هنگام ثبت مرسوله دیجی‌اکسپرس، هزینه ارسال به‌صورت خودکار از کیف پول کسر می‌شود.  نیاز به **API_KEY** فروشنده دارد.  </div>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\MerchantWalletApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->walletsApiV1WalletBalanceRetrieve();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling MerchantWalletApi->walletsApiV1WalletBalanceRetrieve: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\WalletBalance**](../Model/WalletBalance.md)

### Authorization

[MerchantAPIKeyAuth](../../README.md#MerchantAPIKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
