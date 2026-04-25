# bwdk_sdk

<div dir=\"rtl\" style=\"text-align: right;\">

# مستندات فروشندگان در سرویس خرید با دیجی‌کالا

این پلتفرم برای فروشندگان (مرچنت‌ها) جهت یکپارچه‌سازی خدمات پرداخت و تجارت الکترونیکی با سیستم خرید با دیجی‌کالا.
شامل مدیریت سفارشات، ارسال، و احراز هویت فروشندگان است.

</div>



## Installation & Usage

### Requirements

PHP 8.1 and later.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/rznas/bwdk-sdk-php.git"
    }
  ],
  "require": {
    "rznas/bwdk-sdk-php": "*@dev"
  }
}
```

Then run `composer install`

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/bwdk_sdk/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



// Configure API key authorization: MerchantAPIKeyAuth
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// $config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');


$apiInstance = new OpenAPI\Client\Api\MerchantOrdersApi(
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
    echo 'Exception when calling MerchantOrdersApi->orderApiV1CreateOrderCreate: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://bwdk-backend.digify.shop*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*MerchantOrdersApi* | [**orderApiV1CreateOrderCreate**](docs/Api/MerchantOrdersApi.md#orderapiv1createordercreate) | **POST** /order/api/v1/create-order/ | ساخت سفارش
*MerchantOrdersApi* | [**orderApiV1ManagerList**](docs/Api/MerchantOrdersApi.md#orderapiv1managerlist) | **GET** /order/api/v1/manager/ | لیست سفارشات
*MerchantOrdersApi* | [**orderApiV1ManagerPaidList**](docs/Api/MerchantOrdersApi.md#orderapiv1managerpaidlist) | **GET** /order/api/v1/manager/paid/ | سفارش پرداخت‌شده و تایید‌نشده
*MerchantOrdersApi* | [**orderApiV1ManagerRefundCreate**](docs/Api/MerchantOrdersApi.md#orderapiv1managerrefundcreate) | **POST** /order/api/v1/manager/{order_uuid}/refund/ | بازگشت سفارش
*MerchantOrdersApi* | [**orderApiV1ManagerRetrieve**](docs/Api/MerchantOrdersApi.md#orderapiv1managerretrieve) | **GET** /order/api/v1/manager/{order_uuid}/ | دریافت سفارش
*MerchantOrdersApi* | [**orderApiV1ManagerUpdateStatusUpdate**](docs/Api/MerchantOrdersApi.md#orderapiv1managerupdatestatusupdate) | **PUT** /order/api/v1/manager/{order_uuid}/update-status/ | Update Order Status
*MerchantOrdersApi* | [**orderApiV1ManagerVerifyCreate**](docs/Api/MerchantOrdersApi.md#orderapiv1managerverifycreate) | **POST** /order/api/v1/manager/{order_uuid}/verify/ | تایید سفارش
*MerchantWalletApi* | [**walletsApiV1WalletBalanceRetrieve**](docs/Api/MerchantWalletApi.md#walletsapiv1walletbalanceretrieve) | **GET** /wallets/api/v1/wallet-balance/ | Get Wallet Balance
*OrderShippingApi* | [**orderApiV1ManagerCancelShipmentCreate**](docs/Api/OrderShippingApi.md#orderapiv1managercancelshipmentcreate) | **POST** /order/api/v1/manager/{order_uuid}/cancel-shipment/ | Cancel Shipment
*OrderShippingApi* | [**orderApiV1ManagerChangeShippingMethodUpdate**](docs/Api/OrderShippingApi.md#orderapiv1managerchangeshippingmethodupdate) | **PUT** /order/api/v1/manager/{order_uuid}/change-shipping-method/ | Change Shipping Method
*OrderShippingApi* | [**orderApiV1ManagerReviveShipmentCreate**](docs/Api/OrderShippingApi.md#orderapiv1managerreviveshipmentcreate) | **POST** /order/api/v1/manager/{order_uuid}/revive-shipment/ | Revive Shipment
*SellerProfileManagementApi* | [**merchantApiV1AuthStatusRetrieve**](docs/Api/SellerProfileManagementApi.md#merchantapiv1authstatusretrieve) | **GET** /merchant/api/v1/auth/status/ | وضعیت لاگین بودن

## Models

- [AuthStatusResponse](docs/Model/AuthStatusResponse.md)
- [BusinessAddress](docs/Model/BusinessAddress.md)
- [DeliveryTimeRangeDisplay](docs/Model/DeliveryTimeRangeDisplay.md)
- [ErrorEnum](docs/Model/ErrorEnum.md)
- [GatewayTypeEnum](docs/Model/GatewayTypeEnum.md)
- [Merchant](docs/Model/Merchant.md)
- [MerchantOrderCancelShipmentResponse](docs/Model/MerchantOrderCancelShipmentResponse.md)
- [MerchantOrderRefundResponse](docs/Model/MerchantOrderRefundResponse.md)
- [MerchantOrderReviveShipmentResponse](docs/Model/MerchantOrderReviveShipmentResponse.md)
- [MerchantPaidOrderList](docs/Model/MerchantPaidOrderList.md)
- [NullEnum](docs/Model/NullEnum.md)
- [Option](docs/Model/Option.md)
- [OrderCreate](docs/Model/OrderCreate.md)
- [OrderCreateResponse](docs/Model/OrderCreateResponse.md)
- [OrderDetail](docs/Model/OrderDetail.md)
- [OrderError](docs/Model/OrderError.md)
- [OrderItemCreate](docs/Model/OrderItemCreate.md)
- [OrderStatusEnum](docs/Model/OrderStatusEnum.md)
- [OrderUser](docs/Model/OrderUser.md)
- [Packing](docs/Model/Packing.md)
- [PaginatedMerchantPaidOrderListList](docs/Model/PaginatedMerchantPaidOrderListList.md)
- [PaginatedOrderDetailList](docs/Model/PaginatedOrderDetailList.md)
- [PaymentOrder](docs/Model/PaymentOrder.md)
- [RefundOrder](docs/Model/RefundOrder.md)
- [ReviveShipment](docs/Model/ReviveShipment.md)
- [ShippingMethod](docs/Model/ShippingMethod.md)
- [ShippingTypeEnum](docs/Model/ShippingTypeEnum.md)
- [TypeNameEnum](docs/Model/TypeNameEnum.md)
- [UpdateOrderStatus](docs/Model/UpdateOrderStatus.md)
- [VerifyOrder](docs/Model/VerifyOrder.md)
- [WalletBalance](docs/Model/WalletBalance.md)

## Authorization

Authentication schemes defined for the API:
### MerchantAPIKeyAuth

- **Type**: API key
- **API key parameter name**: Authorization
- **Location**: HTTP header


## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author



## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `1.0.0`
    - Generator version: `7.21.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`
