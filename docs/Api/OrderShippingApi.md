# OpenAPI\Client\OrderShippingApi



All URIs are relative to https://bwdk-backend.digify.shop, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**orderApiV1ManagerCancelShipmentCreate()**](OrderShippingApi.md#orderApiV1ManagerCancelShipmentCreate) | **POST** /order/api/v1/manager/{order_uuid}/cancel-shipment/ | Cancel Shipment |
| [**orderApiV1ManagerChangeShippingMethodUpdate()**](OrderShippingApi.md#orderApiV1ManagerChangeShippingMethodUpdate) | **PUT** /order/api/v1/manager/{order_uuid}/change-shipping-method/ | Change Shipping Method |
| [**orderApiV1ManagerReviveShipmentCreate()**](OrderShippingApi.md#orderApiV1ManagerReviveShipmentCreate) | **POST** /order/api/v1/manager/{order_uuid}/revive-shipment/ | Revive Shipment |


## `orderApiV1ManagerCancelShipmentCreate()`

```php
orderApiV1ManagerCancelShipmentCreate($order_uuid): \OpenAPI\Client\Model\MerchantOrderCancelShipmentResponse
```

Cancel Shipment

<div dir=\"rtl\" style=\"text-align: right;\">  لغو مرسوله دیجی‌اکسپرس  ## توضیحات  این endpoint برای لغو یک مرسوله ثبت‌شده در سرویس دیجی‌اکسپرس استفاده می‌شود. پس از لغو موفق، مرسوله از صف ارسال خارج می‌شود.  نیاز به **API_KEY** فروشنده دارد.  ## شرایط لغو  * سفارش باید دارای روش ارسال **DigiExpress** باشد * مرسوله باید در وضعیت **در انتظار تحویل به پیک** (Request for Pickup) باشد  </div>  ```mermaid sequenceDiagram     participant M as فروشنده     participant API as BWDK API     participant DX as دیجی‌اکسپرس      M->>API: POST /order/api/v1/manager/{order_uuid}/cancel-shipment/     Note over M,API: Header: X-API-KEY (بدون بدنه)      alt روش ارسال DigiExpress نیست         API-->>M: 400 خطا         Note over API,M: {error: \"Selected shipping method is not DigiExpress\"}     else مرسوله قابل لغو نیست         API-->>M: 400 خطا         Note over API,M: {error: \"...\"}     else لغو موفق         API->>DX: لغو مرسوله         DX-->>API: تأیید لغو         API-->>M: 200 موفق         Note over API,M: {message, order_uuid, status, status_display}     end ```

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\OrderShippingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$order_uuid = 'order_uuid_example'; // string

try {
    $result = $apiInstance->orderApiV1ManagerCancelShipmentCreate($order_uuid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderShippingApi->orderApiV1ManagerCancelShipmentCreate: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **order_uuid** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\MerchantOrderCancelShipmentResponse**](../Model/MerchantOrderCancelShipmentResponse.md)

### Authorization

[MerchantAPIKeyAuth](../../README.md#MerchantAPIKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `orderApiV1ManagerChangeShippingMethodUpdate()`

```php
orderApiV1ManagerChangeShippingMethodUpdate($order_uuid, $order_detail): \OpenAPI\Client\Model\OrderDetail
```

Change Shipping Method

<div dir=\"rtl\" style=\"text-align: right;\">  تغییر روش ارسال سفارش  ## توضیحات  این endpoint به فروشنده اجازه می‌دهد روش ارسال یک سفارش را تغییر دهد. این عملیات معمولاً زمانی استفاده می‌شود که فروشنده بخواهد از DigiExpress به روش ارسال پیش‌فرض (یا بالعکس) تغییر دهد.  نیاز به **API_KEY** فروشنده دارد.  ## پارامترهای ورودی  * **updated_shipping**: شناسه روش ارسال جدید * **preparation_time** (اختیاری): زمان آماده‌سازی (روز) برای DigiExpress  </div>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\OrderShippingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$order_uuid = 'order_uuid_example'; // string
$order_detail = new \OpenAPI\Client\Model\OrderDetail(); // \OpenAPI\Client\Model\OrderDetail

try {
    $result = $apiInstance->orderApiV1ManagerChangeShippingMethodUpdate($order_uuid, $order_detail);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderShippingApi->orderApiV1ManagerChangeShippingMethodUpdate: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **order_uuid** | **string**|  | |
| **order_detail** | [**\OpenAPI\Client\Model\OrderDetail**](../Model/OrderDetail.md)|  | |

### Return type

[**\OpenAPI\Client\Model\OrderDetail**](../Model/OrderDetail.md)

### Authorization

[MerchantAPIKeyAuth](../../README.md#MerchantAPIKeyAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `orderApiV1ManagerReviveShipmentCreate()`

```php
orderApiV1ManagerReviveShipmentCreate($order_uuid, $revive_shipment): \OpenAPI\Client\Model\MerchantOrderReviveShipmentResponse
```

Revive Shipment

<div dir=\"rtl\" style=\"text-align: right;\">  احیای مرسوله دیجی‌اکسپرس  ## توضیحات  این endpoint برای احیای (reactivate) یک مرسوله دیجی‌اکسپرس که قبلاً لغو شده یا در وضعیت غیرفعال است استفاده می‌شود. با ارسال `preparation_time` (زمان آماده‌سازی بر حسب روز)، زمان جدید آماده بودن بار تنظیم می‌شود.  نیاز به **API_KEY** فروشنده دارد.  ## پارامترهای ورودی  * **preparation_time** (اختیاری، پیش‌فرض: ۲): تعداد روز تا آماده‌شدن بار برای تحویل به پیک  ## شرایط  * سفارش باید دارای روش ارسال **DigiExpress** باشد * مرسوله باید در وضعیت قابل احیا باشد  </div>  ```mermaid sequenceDiagram     participant M as فروشنده     participant API as BWDK API     participant DX as دیجی‌اکسپرس      M->>API: POST /order/api/v1/manager/{order_uuid}/revive-shipment/     Note over M,API: Header: X-API-KEY<br/>{preparation_time: 2}      alt روش ارسال DigiExpress نیست         API-->>M: 400 خطا         Note over API,M: {error: \"Selected shipping method is not DigiExpress\"}     else احیا موفق         API->>DX: احیای مرسوله با زمان جدید         DX-->>API: تأیید احیا         API-->>M: 200 موفق         Note over API,M: {message, order_uuid, status, status_display}     end ```

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\OrderShippingApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$order_uuid = 'order_uuid_example'; // string
$revive_shipment = new \OpenAPI\Client\Model\ReviveShipment(); // \OpenAPI\Client\Model\ReviveShipment

try {
    $result = $apiInstance->orderApiV1ManagerReviveShipmentCreate($order_uuid, $revive_shipment);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling OrderShippingApi->orderApiV1ManagerReviveShipmentCreate: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **order_uuid** | **string**|  | |
| **revive_shipment** | [**\OpenAPI\Client\Model\ReviveShipment**](../Model/ReviveShipment.md)|  | [optional] |

### Return type

[**\OpenAPI\Client\Model\MerchantOrderReviveShipmentResponse**](../Model/MerchantOrderReviveShipmentResponse.md)

### Authorization

[MerchantAPIKeyAuth](../../README.md#MerchantAPIKeyAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)
