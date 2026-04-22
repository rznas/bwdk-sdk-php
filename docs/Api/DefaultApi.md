# OpenAPI\Client\DefaultApi



All URIs are relative to https://bwdk-backend.digify.shop, except if the operation defines another base path.

| Method | HTTP request | Description |
| ------------- | ------------- | ------------- |
| [**merchantApiV1AuthStatusRetrieve()**](DefaultApi.md#merchantApiV1AuthStatusRetrieve) | **GET** /merchant/api/v1/auth/status/ | وضعیت لاگین بودن |
| [**orderApiV1CreateOrderCreate()**](DefaultApi.md#orderApiV1CreateOrderCreate) | **POST** /order/api/v1/create-order/ | ساخت سفارش |
| [**orderApiV1ManagerCancelShipmentCreate()**](DefaultApi.md#orderApiV1ManagerCancelShipmentCreate) | **POST** /order/api/v1/manager/{order_uuid}/cancel-shipment/ | لغو ارسال سفارش |
| [**orderApiV1ManagerChangeShippingMethodUpdate()**](DefaultApi.md#orderApiV1ManagerChangeShippingMethodUpdate) | **PUT** /order/api/v1/manager/{order_uuid}/change-shipping-method/ | تغییر روش ارسال |
| [**orderApiV1ManagerList()**](DefaultApi.md#orderApiV1ManagerList) | **GET** /order/api/v1/manager/ | لیست سفارشات |
| [**orderApiV1ManagerPaidList()**](DefaultApi.md#orderApiV1ManagerPaidList) | **GET** /order/api/v1/manager/paid/ | سفارش پرداخت‌شده و تایید‌نشده |
| [**orderApiV1ManagerRefundCreate()**](DefaultApi.md#orderApiV1ManagerRefundCreate) | **POST** /order/api/v1/manager/{order_uuid}/refund/ | بازگشت سفارش |
| [**orderApiV1ManagerRetrieve()**](DefaultApi.md#orderApiV1ManagerRetrieve) | **GET** /order/api/v1/manager/{order_uuid}/ | دریافت سفارش |
| [**orderApiV1ManagerReviveShipmentCreate()**](DefaultApi.md#orderApiV1ManagerReviveShipmentCreate) | **POST** /order/api/v1/manager/{order_uuid}/revive-shipment/ | احیای ارسال سفارش |
| [**orderApiV1ManagerUpdateStatusUpdate()**](DefaultApi.md#orderApiV1ManagerUpdateStatusUpdate) | **PUT** /order/api/v1/manager/{order_uuid}/update-status/ | به‌روزرسانی وضعیت سفارش |
| [**orderApiV1ManagerVerifyCreate()**](DefaultApi.md#orderApiV1ManagerVerifyCreate) | **POST** /order/api/v1/manager/{order_uuid}/verify/ | تایید سفارش |
| [**walletsApiV1WalletBalanceRetrieve()**](DefaultApi.md#walletsApiV1WalletBalanceRetrieve) | **GET** /wallets/api/v1/wallet-balance/ | دریافت موجودی کیف پول |


## `merchantApiV1AuthStatusRetrieve()`

```php
merchantApiV1AuthStatusRetrieve(): \OpenAPI\Client\Model\AuthStatusResponse
```

وضعیت لاگین بودن

<div dir=\"rtl\" style=\"text-align: right;\">  بررسی وضعیت احراز هویت فروشنده  ## توضیحات  این endpoint برای بررسی اعتبار **API_KEY** فروشنده استفاده می‌شود. اگر کلید معتبر باشد، پاسخ `is_authenticated: true` برمی‌گردد. از این endpoint برای تأیید صحت کلید API قبل از شروع عملیات استفاده کنید.  نیاز به **API_KEY** فروشنده دارد (فقط Header لازم است، بدنه درخواست ندارد).  </div>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->merchantApiV1AuthStatusRetrieve();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->merchantApiV1AuthStatusRetrieve: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

This endpoint does not need any parameter.

### Return type

[**\OpenAPI\Client\Model\AuthStatusResponse**](../Model/AuthStatusResponse.md)

### Authorization

[MerchantAPIKeyAuth](../../README.md#MerchantAPIKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `orderApiV1CreateOrderCreate()`

```php
orderApiV1CreateOrderCreate($order_create): \OpenAPI\Client\Model\OrderCreateResponse
```

ساخت سفارش

<div dir=\"rtl\" style=\"text-align: right;\">  ساخت سفارش جدید در سیستم BWDK  ## توضیحات  این endpoint برای ایجاد یک سفارش جدید در سیستم خرید با دیجی‌کالا استفاده می‌شود. در این درخواست باید اطلاعات سفارش، اقلام سبد خرید، و آدرس callback شامل شود.  برای شروع ارتباط با سرویس‌های **خرید با دیجی‌کالا** شما باید دارای **API_KEY** باشید که این مورد از سمت تیم دیجی‌فای در اختیار شما قرار خواهد گرفت.  ### روند کاری  **مرحله ۱: درخواست ساخت سفارش**  کاربر پس از انتخاب کالاهای خود در سبد خرید، بر روی دکمه **خرید با دیجی‌کالا** کلیک می‌کند و بک‌اند مرچنت درخواستی برای ساخت سفارش BWDK دریافت می‌کند. در این مرحله اولین درخواست خود را به بک‌اند BWDK ارسال می‌نمایید:  BWDK یک سفارش جدید برای مرچنت با وضعیت **INITIAL** ایجاد می‌کند و **order_uuid** را جنریت می‌کند. آدرس **order_start_url** نقطه شروع مسیر تکمیل سفارش است (انتخاب آدرس، شیپینگ، پکینگ، پرداخت و غیره). <br> </div>  ```mermaid sequenceDiagram     participant M as فروشنده     participant API as BWDK API     participant C as مشتری     participant PG as درگاه پرداخت      M->>API: POST /api/v1/orders/create     Note over M,API: شناسه سفارش, کالاها, مبلغ, callback_url     API-->>M: {لینک شروع سفارش, شناسه سفارش}      M->>C: تغییر مسیر به لینک شروع      C->>API: تکمیل درخواست خرید توسط مشتری     API->>PG: شروع فرآیند پرداخت     PG-->>C: نتیجه پرداخت     PG->>API: تأیید پرداخت     API-->>C: تغییر مسیر به callback_url      M->>API: POST /api/v1/orders/manager/{uuid}/verify     Note over M,API: {شناسه منحصربفرد فروشنده}     API-->>M: سفارش تأیید شد و آماده ارسال است ```  </div>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$order_create = new \OpenAPI\Client\Model\OrderCreate(); // \OpenAPI\Client\Model\OrderCreate

try {
    $result = $apiInstance->orderApiV1CreateOrderCreate($order_create);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->orderApiV1CreateOrderCreate: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **order_create** | [**\OpenAPI\Client\Model\OrderCreate**](../Model/OrderCreate.md)|  | |

### Return type

[**\OpenAPI\Client\Model\OrderCreateResponse**](../Model/OrderCreateResponse.md)

### Authorization

[MerchantAPIKeyAuth](../../README.md#MerchantAPIKeyAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `orderApiV1ManagerCancelShipmentCreate()`

```php
orderApiV1ManagerCancelShipmentCreate($order_uuid): \OpenAPI\Client\Model\MerchantOrderCancelShipmentResponse
```

لغو ارسال سفارش

<div dir=\"rtl\" style=\"text-align: right;\">  لغو مرسوله دیجی‌اکسپرس  ## توضیحات  این endpoint برای لغو یک مرسوله ثبت‌شده در سرویس دیجی‌اکسپرس استفاده می‌شود. پس از لغو موفق، مرسوله از صف ارسال خارج می‌شود.  نیاز به **API_KEY** فروشنده دارد.  ## شرایط لغو  * سفارش باید دارای روش ارسال **DigiExpress** باشد * مرسوله باید در وضعیت **در انتظار تحویل به پیک** (Request for Pickup) باشد  </div>  ```mermaid sequenceDiagram     participant M as فروشنده     participant API as BWDK API     participant DX as دیجی‌اکسپرس      M->>API: POST /order/api/v1/manager/{order_uuid}/cancel-shipment/     Note over M,API: Header: X-API-KEY (بدون بدنه)      alt روش ارسال DigiExpress نیست         API-->>M: 400 خطا         Note over API,M: {error: \"Selected shipping method is not DigiExpress\"}     else مرسوله قابل لغو نیست         API-->>M: 400 خطا         Note over API,M: {error: \"...\"}     else لغو موفق         API->>DX: لغو مرسوله         DX-->>API: تأیید لغو         API-->>M: 200 موفق         Note over API,M: {message, order_uuid, status, status_display}     end ```

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
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
    echo 'Exception when calling DefaultApi->orderApiV1ManagerCancelShipmentCreate: ', $e->getMessage(), PHP_EOL;
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

تغییر روش ارسال

<div dir=\"rtl\" style=\"text-align: right;\">  تغییر روش ارسال سفارش  ## توضیحات  این endpoint به فروشنده اجازه می‌دهد روش ارسال یک سفارش را تغییر دهد. این عملیات معمولاً زمانی استفاده می‌شود که فروشنده بخواهد از DigiExpress به روش ارسال پیش‌فرض (یا بالعکس) تغییر دهد.  نیاز به **API_KEY** فروشنده دارد.  ## پارامترهای ورودی  * **updated_shipping**: شناسه روش ارسال جدید * **preparation_time** (اختیاری): زمان آماده‌سازی (روز) برای DigiExpress  </div>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
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
    echo 'Exception when calling DefaultApi->orderApiV1ManagerChangeShippingMethodUpdate: ', $e->getMessage(), PHP_EOL;
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

## `orderApiV1ManagerList()`

```php
orderApiV1ManagerList($cities, $created_at, $cursor, $order_ids, $ordering, $payment_types, $provinces, $reference_code, $search, $shipping_types, $status, $statuses, $today_pickup): \OpenAPI\Client\Model\PaginatedOrderDetailList
```

لیست سفارشات

<div dir=\"rtl\" style=\"text-align: right;\">  لیست سفارشات فروشنده  ## توضیحات  این endpoint لیست تمام سفارشات مرتبط با فروشنده را با امکان فیلتر، جستجو و مرتب‌سازی برمی‌گرداند. نتایج به صورت صفحه‌بندی‌شده (Cursor Pagination) ارسال می‌شوند و به ترتیب جدیدترین سفارش اول مرتب می‌شوند.  نیاز به **API_KEY** فروشنده دارد.  ## پارامترهای فیلتر  * **status**: وضعیت سفارش (INITIAL, PENDING, PAID_BY_USER, VERIFIED_BY_MERCHANT, ...) * **created_at__gte / created_at__lte**: فیلتر بر اساس تاریخ ایجاد * **search**: جستجو در شماره تلفن مشتری، نام، کد مرجع، شناسه سفارش مرچنت * **ordering**: مرتب‌سازی بر اساس created_at, final_amount, status, merchant_order_id  </div>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cities = 'cities_example'; // string
$created_at = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime
$cursor = 'cursor_example'; // string | مقدار نشانگر صفحه‌بندی.
$order_ids = 'order_ids_example'; // string
$ordering = 'ordering_example'; // string | کدام فیلد باید هنگام مرتب‌سازی نتایج استفاده شود.
$payment_types = 'payment_types_example'; // string
$provinces = 'provinces_example'; // string
$reference_code = 'reference_code_example'; // string
$search = 'search_example'; // string | یک عبارت جستجو.
$shipping_types = 'shipping_types_example'; // string
$status = 56; // int | * `1` - اولیه * `2` - شروع در * `3` - در انتظار * `4` - در انتظار درگاه * `5` - منقضی شده * `6` - لغو شده * `7` - ممنوع شده توسط ما * `8` - ناموفق در پرداخت * `9` - تأیید شده توسط فروشنده * `10` - ناموفق در تأیید توسط فروشنده * `11` - فروشگاه * `12` - لغو شده توسط فروشنده * `13` - درخواست بازگرداندن وجه به مشتری به دلیل درخواست مشتری * `14` - درخواست بازگرداندن وجه به فروشنده پس از ناموفقی در تأیید توسط فروشنده * `15` - درخواست بازگرداندن وجه به مشتری پس از ناموفقی توسط فروشنده * `16` - بازگردانده شده به فروشنده پس از لغو توسط فروشنده * `17` - بازگرداندن وجه تکمیل شد * `18` - زمان مجاز برای منقضی کردن گذشته است * `19` - تحویل نشده * `20` - مرسوله
$statuses = 'statuses_example'; // string
$today_pickup = True; // bool

try {
    $result = $apiInstance->orderApiV1ManagerList($cities, $created_at, $cursor, $order_ids, $ordering, $payment_types, $provinces, $reference_code, $search, $shipping_types, $status, $statuses, $today_pickup);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->orderApiV1ManagerList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **cities** | **string**|  | [optional] |
| **created_at** | **\DateTime**|  | [optional] |
| **cursor** | **string**| مقدار نشانگر صفحه‌بندی. | [optional] |
| **order_ids** | **string**|  | [optional] |
| **ordering** | **string**| کدام فیلد باید هنگام مرتب‌سازی نتایج استفاده شود. | [optional] |
| **payment_types** | **string**|  | [optional] |
| **provinces** | **string**|  | [optional] |
| **reference_code** | **string**|  | [optional] |
| **search** | **string**| یک عبارت جستجو. | [optional] |
| **shipping_types** | **string**|  | [optional] |
| **status** | **int**| * &#x60;1&#x60; - اولیه * &#x60;2&#x60; - شروع در * &#x60;3&#x60; - در انتظار * &#x60;4&#x60; - در انتظار درگاه * &#x60;5&#x60; - منقضی شده * &#x60;6&#x60; - لغو شده * &#x60;7&#x60; - ممنوع شده توسط ما * &#x60;8&#x60; - ناموفق در پرداخت * &#x60;9&#x60; - تأیید شده توسط فروشنده * &#x60;10&#x60; - ناموفق در تأیید توسط فروشنده * &#x60;11&#x60; - فروشگاه * &#x60;12&#x60; - لغو شده توسط فروشنده * &#x60;13&#x60; - درخواست بازگرداندن وجه به مشتری به دلیل درخواست مشتری * &#x60;14&#x60; - درخواست بازگرداندن وجه به فروشنده پس از ناموفقی در تأیید توسط فروشنده * &#x60;15&#x60; - درخواست بازگرداندن وجه به مشتری پس از ناموفقی توسط فروشنده * &#x60;16&#x60; - بازگردانده شده به فروشنده پس از لغو توسط فروشنده * &#x60;17&#x60; - بازگرداندن وجه تکمیل شد * &#x60;18&#x60; - زمان مجاز برای منقضی کردن گذشته است * &#x60;19&#x60; - تحویل نشده * &#x60;20&#x60; - مرسوله | [optional] |
| **statuses** | **string**|  | [optional] |
| **today_pickup** | **bool**|  | [optional] |

### Return type

[**\OpenAPI\Client\Model\PaginatedOrderDetailList**](../Model/PaginatedOrderDetailList.md)

### Authorization

[MerchantAPIKeyAuth](../../README.md#MerchantAPIKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `orderApiV1ManagerPaidList()`

```php
orderApiV1ManagerPaidList($cities, $created_at, $cursor, $order_ids, $ordering, $payment_types, $provinces, $reference_code, $search, $shipping_types, $status, $statuses, $today_pickup): \OpenAPI\Client\Model\PaginatedMerchantPaidOrderListList
```

سفارش پرداخت‌شده و تایید‌نشده

لیست تمامی سفارشاتی که توسط کاربر پرداخت شده اند ولی توسط فروشنده تایید نشده اند.

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$cities = 'cities_example'; // string
$created_at = new \DateTime('2013-10-20T19:20:30+01:00'); // \DateTime
$cursor = 'cursor_example'; // string | مقدار نشانگر صفحه‌بندی.
$order_ids = 'order_ids_example'; // string
$ordering = 'ordering_example'; // string | کدام فیلد باید هنگام مرتب‌سازی نتایج استفاده شود.
$payment_types = 'payment_types_example'; // string
$provinces = 'provinces_example'; // string
$reference_code = 'reference_code_example'; // string
$search = 'search_example'; // string | یک عبارت جستجو.
$shipping_types = 'shipping_types_example'; // string
$status = 56; // int | * `1` - اولیه * `2` - شروع در * `3` - در انتظار * `4` - در انتظار درگاه * `5` - منقضی شده * `6` - لغو شده * `7` - ممنوع شده توسط ما * `8` - ناموفق در پرداخت * `9` - تأیید شده توسط فروشنده * `10` - ناموفق در تأیید توسط فروشنده * `11` - فروشگاه * `12` - لغو شده توسط فروشنده * `13` - درخواست بازگرداندن وجه به مشتری به دلیل درخواست مشتری * `14` - درخواست بازگرداندن وجه به فروشنده پس از ناموفقی در تأیید توسط فروشنده * `15` - درخواست بازگرداندن وجه به مشتری پس از ناموفقی توسط فروشنده * `16` - بازگردانده شده به فروشنده پس از لغو توسط فروشنده * `17` - بازگرداندن وجه تکمیل شد * `18` - زمان مجاز برای منقضی کردن گذشته است * `19` - تحویل نشده * `20` - مرسوله
$statuses = 'statuses_example'; // string
$today_pickup = True; // bool

try {
    $result = $apiInstance->orderApiV1ManagerPaidList($cities, $created_at, $cursor, $order_ids, $ordering, $payment_types, $provinces, $reference_code, $search, $shipping_types, $status, $statuses, $today_pickup);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->orderApiV1ManagerPaidList: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **cities** | **string**|  | [optional] |
| **created_at** | **\DateTime**|  | [optional] |
| **cursor** | **string**| مقدار نشانگر صفحه‌بندی. | [optional] |
| **order_ids** | **string**|  | [optional] |
| **ordering** | **string**| کدام فیلد باید هنگام مرتب‌سازی نتایج استفاده شود. | [optional] |
| **payment_types** | **string**|  | [optional] |
| **provinces** | **string**|  | [optional] |
| **reference_code** | **string**|  | [optional] |
| **search** | **string**| یک عبارت جستجو. | [optional] |
| **shipping_types** | **string**|  | [optional] |
| **status** | **int**| * &#x60;1&#x60; - اولیه * &#x60;2&#x60; - شروع در * &#x60;3&#x60; - در انتظار * &#x60;4&#x60; - در انتظار درگاه * &#x60;5&#x60; - منقضی شده * &#x60;6&#x60; - لغو شده * &#x60;7&#x60; - ممنوع شده توسط ما * &#x60;8&#x60; - ناموفق در پرداخت * &#x60;9&#x60; - تأیید شده توسط فروشنده * &#x60;10&#x60; - ناموفق در تأیید توسط فروشنده * &#x60;11&#x60; - فروشگاه * &#x60;12&#x60; - لغو شده توسط فروشنده * &#x60;13&#x60; - درخواست بازگرداندن وجه به مشتری به دلیل درخواست مشتری * &#x60;14&#x60; - درخواست بازگرداندن وجه به فروشنده پس از ناموفقی در تأیید توسط فروشنده * &#x60;15&#x60; - درخواست بازگرداندن وجه به مشتری پس از ناموفقی توسط فروشنده * &#x60;16&#x60; - بازگردانده شده به فروشنده پس از لغو توسط فروشنده * &#x60;17&#x60; - بازگرداندن وجه تکمیل شد * &#x60;18&#x60; - زمان مجاز برای منقضی کردن گذشته است * &#x60;19&#x60; - تحویل نشده * &#x60;20&#x60; - مرسوله | [optional] |
| **statuses** | **string**|  | [optional] |
| **today_pickup** | **bool**|  | [optional] |

### Return type

[**\OpenAPI\Client\Model\PaginatedMerchantPaidOrderListList**](../Model/PaginatedMerchantPaidOrderListList.md)

### Authorization

[MerchantAPIKeyAuth](../../README.md#MerchantAPIKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `orderApiV1ManagerRefundCreate()`

```php
orderApiV1ManagerRefundCreate($order_uuid, $refund_order): \OpenAPI\Client\Model\MerchantOrderRefundResponse
```

بازگشت سفارش

<div dir=\"rtl\" style=\"text-align: right;\"> بازگشت و لغو سفارش  ## توضیحات  این endpoint برای بازگشت یا لغو سفارشی استفاده می‌شود که قبلاً پرداخت شده یا تایید شده است. در این مرحله مبلغ سفارش به کاربر بازگشت داده می‌شود و وضعیت سفارش به **REFUNDED** تغییر می‌یابد.   ## شرایط بازگشت  سفارش باید در یکی از وضعیت‌های زیر باشد تا بازگشت امکان‌پذیر باشد: * **PAID_BY_USER**: سفارش پرداخت شده است اما هنوز تایید نشده * **VERIFIED_BY_MERCHANT**: سفارش تایید شده است  سفارش نباید قبلاً بازگشت داده شده باشد.  **پاسخ خطا** - اگر سفارش در وضعیت مناسب نباشد یا قبلاً بازگشت داده شده باشد </div>  ```mermaid sequenceDiagram     participant M as فروشنده     participant API as BWDK API      M->>API: POST /api/v1/orders/manager/{uuid}/refund     Note over M,API: {reason: \"درخواست مشتری\"}      alt سفارش قابل بازگشت نیست         API-->>M: 500 خطا         Note over API,M: {error: \"شروع بازگشت ناموفق بود.<br/>لطفاً دوباره تلاش کنید.\"}     else سفارش معتبر است         API-->>M: 200 موفق         Note over API,M: {message: \"درخواست بازگشت با<br/>موفقیت شروع شد\",<br/>order_uuid, status: 13,<br/>status_display,<br/>refund_reason}          M->>API: GET /api/v1/orders/manager/{uuid}         Note over M,API: بررسی وضعیت سفارش<br/>(endpoint جداگانه /refund/status وجود ندارد)          alt status: 17 (بازگشت تکمیل شد)             API-->>M: 200 موفق             Note over API,M: {order_uuid, status: 17,<br/>status_display: \"بازگشت تکمیل شد\",<br/>metadata.refund_tracking_code,<br/>metadata.refund_completed_at}          else status: 13 (در حال پردازش)             API-->>M: 200 موفق             Note over API,M: {order_uuid, status: 13,<br/>status_display: \"درخواست بازگشت به مشتری<br/>به دلیل درخواست<br/>مشتری\",<br/>metadata.refund_reason}          else status: قبلی (بازگشت ناموفق)             API-->>M: 200 موفق             Note over API,M: {order_uuid, status: (قبلی),<br/>metadata.refund_error,<br/>metadata.refund_failed_at}         end     end ```

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$order_uuid = 'order_uuid_example'; // string
$refund_order = new \OpenAPI\Client\Model\RefundOrder(); // \OpenAPI\Client\Model\RefundOrder

try {
    $result = $apiInstance->orderApiV1ManagerRefundCreate($order_uuid, $refund_order);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->orderApiV1ManagerRefundCreate: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **order_uuid** | **string**|  | |
| **refund_order** | [**\OpenAPI\Client\Model\RefundOrder**](../Model/RefundOrder.md)|  | [optional] |

### Return type

[**\OpenAPI\Client\Model\MerchantOrderRefundResponse**](../Model/MerchantOrderRefundResponse.md)

### Authorization

[MerchantAPIKeyAuth](../../README.md#MerchantAPIKeyAuth)

### HTTP request headers

- **Content-Type**: `application/json`, `application/x-www-form-urlencoded`, `multipart/form-data`
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `orderApiV1ManagerRetrieve()`

```php
orderApiV1ManagerRetrieve($order_uuid): \OpenAPI\Client\Model\OrderDetail
```

دریافت سفارش

<div dir=\"rtl\" style=\"text-align: right;\">  # مدیریت سفارشات  ## توضیحات  این endpoint برای مدیریت و مشاهده سفارشات فروشنده استفاده می‌شود.  </div>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$order_uuid = 'order_uuid_example'; // string

try {
    $result = $apiInstance->orderApiV1ManagerRetrieve($order_uuid);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->orderApiV1ManagerRetrieve: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **order_uuid** | **string**|  | |

### Return type

[**\OpenAPI\Client\Model\OrderDetail**](../Model/OrderDetail.md)

### Authorization

[MerchantAPIKeyAuth](../../README.md#MerchantAPIKeyAuth)

### HTTP request headers

- **Content-Type**: Not defined
- **Accept**: `application/json`

[[Back to top]](#) [[Back to API list]](../../README.md#endpoints)
[[Back to Model list]](../../README.md#models)
[[Back to README]](../../README.md)

## `orderApiV1ManagerReviveShipmentCreate()`

```php
orderApiV1ManagerReviveShipmentCreate($order_uuid, $revive_shipment): \OpenAPI\Client\Model\MerchantOrderReviveShipmentResponse
```

احیای ارسال سفارش

<div dir=\"rtl\" style=\"text-align: right;\">  احیای مرسوله دیجی‌اکسپرس  ## توضیحات  این endpoint برای احیای (reactivate) یک مرسوله دیجی‌اکسپرس که قبلاً لغو شده یا در وضعیت غیرفعال است استفاده می‌شود. با ارسال `preparation_time` (زمان آماده‌سازی بر حسب روز)، زمان جدید آماده بودن بار تنظیم می‌شود.  نیاز به **API_KEY** فروشنده دارد.  ## پارامترهای ورودی  * **preparation_time** (اختیاری، پیش‌فرض: ۲): تعداد روز تا آماده‌شدن بار برای تحویل به پیک  ## شرایط  * سفارش باید دارای روش ارسال **DigiExpress** باشد * مرسوله باید در وضعیت قابل احیا باشد  </div>  ```mermaid sequenceDiagram     participant M as فروشنده     participant API as BWDK API     participant DX as دیجی‌اکسپرس      M->>API: POST /order/api/v1/manager/{order_uuid}/revive-shipment/     Note over M,API: Header: X-API-KEY<br/>{preparation_time: 2}      alt روش ارسال DigiExpress نیست         API-->>M: 400 خطا         Note over API,M: {error: \"Selected shipping method is not DigiExpress\"}     else احیا موفق         API->>DX: احیای مرسوله با زمان جدید         DX-->>API: تأیید احیا         API-->>M: 200 موفق         Note over API,M: {message, order_uuid, status, status_display}     end ```

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
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
    echo 'Exception when calling DefaultApi->orderApiV1ManagerReviveShipmentCreate: ', $e->getMessage(), PHP_EOL;
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

## `orderApiV1ManagerUpdateStatusUpdate()`

```php
orderApiV1ManagerUpdateStatusUpdate($order_uuid, $update_order_status): \OpenAPI\Client\Model\OrderDetail
```

به‌روزرسانی وضعیت سفارش

<div dir=\"rtl\" style=\"text-align: right;\">  بروزرسانی وضعیت سفارش  ## توضیحات  این endpoint به فروشنده امکان می‌دهد وضعیت یک سفارش را به‌صورت مستقیم تغییر دهد. این endpoint برای مواردی مانند علامت‌گذاری سفارش به‌عنوان «ارسال شده» یا «تحویل داده شده» توسط فروشنده استفاده می‌شود.  نیاز به **API_KEY** فروشنده دارد.  ## وضعیت‌های مجاز  * **DELIVERED**: تحویل شد * **DISPATCHED**: ارسال شد * سایر وضعیت‌های تعریف‌شده در سیستم  </div>  ```mermaid sequenceDiagram     participant M as فروشنده     participant API as BWDK API      M->>API: PUT /order/api/v1/manager/{order_uuid}/update-status/     Note over M,API: Header: X-API-KEY<br/>{status: \"DELIVERED\"}      alt وضعیت معتبر است         API-->>M: 200 موفق         Note over API,M: اطلاعات کامل سفارش با وضعیت جدید     else وضعیت نامعتبر است         API-->>M: 400 خطا         Note over API,M: {error: \"invalid status\"}     end ```

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$order_uuid = 'order_uuid_example'; // string
$update_order_status = new \OpenAPI\Client\Model\UpdateOrderStatus(); // \OpenAPI\Client\Model\UpdateOrderStatus

try {
    $result = $apiInstance->orderApiV1ManagerUpdateStatusUpdate($order_uuid, $update_order_status);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->orderApiV1ManagerUpdateStatusUpdate: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **order_uuid** | **string**|  | |
| **update_order_status** | [**\OpenAPI\Client\Model\UpdateOrderStatus**](../Model/UpdateOrderStatus.md)|  | |

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

## `orderApiV1ManagerVerifyCreate()`

```php
orderApiV1ManagerVerifyCreate($order_uuid, $verify_order): \OpenAPI\Client\Model\OrderDetail
```

تایید سفارش

<div dir=\"rtl\" style=\"text-align: right;\">  تایید سفارش پس از پرداخت  ## توضیحات  پس از اتمام فرایند پرداخت توسط کاربر، مرچنت باید سفارش را تایید کند. این endpoint برای تایید و نهایی کردن سفارش پس از پرداخت موفق توسط مشتری استفاده می‌شود. در این مرحله مرچنت سفارش را تایید می‌کند و وضعیت سفارش به **VERIFIED_BY_MERCHANT** تغییر می‌یابد.  ## روند کاری  **مرحله ۲: بازگشت کاربر و دریافت نتیجه**  پس از تکمیل فرایند پرداخت (موفق یا ناموفق)، کاربر به آدرس callback_url که هنگام ساخت سفارش ارسال کرده بودید بازگردانده می‌شود. در این درخواست وضعیت سفارش به صورت query parameters ارسال می‌شود:   **Query Parameters:** * **success**: متغیر منطقی نشان‌دهنده موفق یا ناموفق بودن سفارش * **status**: وضعیت سفارش (PAID، FAILED، وغیره) * **phone_number**: شماره تلفن مشتری * **order_uuid**: شناسه یکتای سفارش * **merchant_order_id**: شناسه سفارش در سیستم مرچنت  **مرحله ۳: تایید سفارش در بک‌اند**  سپس شما باید این endpoint را فراخوانی کنید تا سفارش را تایید کنید و اطمینان حاصل کنید که سفارش موفقیت‌آمیز ثبت شده است: </div>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);
$order_uuid = 'order_uuid_example'; // string
$verify_order = new \OpenAPI\Client\Model\VerifyOrder(); // \OpenAPI\Client\Model\VerifyOrder

try {
    $result = $apiInstance->orderApiV1ManagerVerifyCreate($order_uuid, $verify_order);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->orderApiV1ManagerVerifyCreate: ', $e->getMessage(), PHP_EOL;
}
```

### Parameters

| Name | Type | Description  | Notes |
| ------------- | ------------- | ------------- | ------------- |
| **order_uuid** | **string**|  | |
| **verify_order** | [**\OpenAPI\Client\Model\VerifyOrder**](../Model/VerifyOrder.md)|  | |

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

## `walletsApiV1WalletBalanceRetrieve()`

```php
walletsApiV1WalletBalanceRetrieve(): \OpenAPI\Client\Model\WalletBalance
```

دریافت موجودی کیف پول

<div dir=\"rtl\" style=\"text-align: right;\">  موجودی کیف پول فروشنده  ## توضیحات  این endpoint موجودی کیف پول فروشنده را برمی‌گرداند. کیف پول برای پرداخت هزینه ارسال دیجی‌اکسپرس استفاده می‌شود. هنگام ثبت مرسوله دیجی‌اکسپرس، هزینه ارسال به‌صورت خودکار از کیف پول کسر می‌شود.  نیاز به **API_KEY** فروشنده دارد.  </div>

### Example

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');


// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\DefaultApi(
    // If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
    // This is optional, `GuzzleHttp\Client` will be used as default.
    new GuzzleHttp\Client(),
    $config
);

try {
    $result = $apiInstance->walletsApiV1WalletBalanceRetrieve();
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->walletsApiV1WalletBalanceRetrieve: ', $e->getMessage(), PHP_EOL;
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
