# ShippingMethod

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [readonly]
**name** | **string** | نام روش ارسال |
**description** | **string** | توضیحات روش ارسال و جزئیات تحویل آن | [optional]
**shipping_type** | [**\OpenAPI\Client\Model\ShippingTypeEnum**](ShippingTypeEnum.md) | نوع روش ارسال: عادی یا دیجی اکسپرس  * &#x60;1&#x60; - سایر * &#x60;2&#x60; - دیجی اکسپرس | [optional]
**get_shipping_type_display** | **string** |  | [readonly]
**shipping_type_display** | **string** |  | [readonly]
**cost** | **int** | هزینه ارسال برای منطقه اولیه (مثلاً تهران) به تومان | [optional]
**secondary_cost** | **int** | هزینه ارسال برای مناطق دیگر به تومان | [optional]
**minimum_time_sending** | **int** | حداقل تعداد روزها از تاریخ سفارش تا تحویل | [optional]
**maximum_time_sending** | **int** | حداکثر تعداد روزها از تاریخ سفارش تا تحویل | [optional]
**delivery_time_display** | **string** |  | [readonly]
**delivery_time_range_display** | [**\OpenAPI\Client\Model\DeliveryTimeRangeDisplay**](DeliveryTimeRangeDisplay.md) |  | [readonly]
**inventory_address** | [**\OpenAPI\Client\Model\BusinessAddress**](BusinessAddress.md) |  | [readonly]
**is_pay_at_destination** | **bool** | Whether the shipping method is pay at destination | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
