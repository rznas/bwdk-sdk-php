# OrderItemCreate

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**name** | **string** | نام کامل محصول شامل تمام مشخصات |
**primary_amount** | **int** | قیمت اولیه برای هر واحد بدون تخفیف (به تومان) | [optional]
**amount** | **int** | قیمت نهایی برای تمام واحدها بعد از تخفیف (به تومان) | [optional]
**count** | **int** | تعداد واحدهای این کالا در سفارش |
**discount_amount** | **int** | مبلغ کل تخفیف برای این کالا (به تومان) | [optional]
**tax_amount** | **int** | مبلغ کل مالیات برای این کالا (به تومان) | [optional]
**image_link** | **string** | آدرس تصویر محصول | [optional]
**options** | [**\OpenAPI\Client\Model\Option[]**](Option.md) |  |
**preparation_time** | **int** | زمان آمادهسازی کالا (به روز) | [optional] [default to 2]
**weight** | **float** | وزن کالا (بر حسب گرم) | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
