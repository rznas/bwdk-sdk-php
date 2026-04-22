# ShippingMethod

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [readonly]
**name** | **string** | نام روش/گزینه بسته‌بندی |
**description** | **string** | شناسه روش ارسال برای استفاده در سفارش | [optional]
**shipping_type** | [**\OpenAPI\Client\Model\ShippingTypeEnum**](ShippingTypeEnum.md) | شناسه وضعیت ارسال از دیجی اکسپرس  * &#x60;1&#x60; - سایر * &#x60;2&#x60; - دیجی اکسپرس | [optional]
**get_shipping_type_display** | **string** |  | [readonly]
**shipping_type_display** | **string** |  | [readonly]
**cost** | **int** | هزینه ارسال برای منطقه اصلی (مثلاً تهران) به تومان | [optional]
**secondary_cost** | **int** | هزینه ارسال برای مناطق دیگر به تومان | [optional]
**minimum_time_sending** | **int** | حداقل تعداد روز از تاریخ سفارش تا تحویل | [optional]
**maximum_time_sending** | **int** | Maximum number of days from order date to delivery | [optional]
**delivery_time_display** | **string** |  | [readonly]
**delivery_time_range_display** | [**\OpenAPI\Client\Model\DeliveryTimeRangeDisplay**](DeliveryTimeRangeDisplay.md) |  | [readonly]
**inventory_address** | [**\OpenAPI\Client\Model\BusinessAddress**](BusinessAddress.md) |  | [readonly]
**is_pay_at_destination** | **bool** | آیا روش ارسال پرداخت در مقصد است | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
