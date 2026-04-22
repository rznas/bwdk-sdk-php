# OrderDetail

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [readonly]
**created_at** | **\DateTime** |  | [readonly]
**order_uuid** | **string** |  | [readonly]
**reservation_expired_at** | **int** | Unix timestamp تا زمانی که سفارش برای پرداخت رزرو شده است | [readonly]
**merchant_order_id** | **string** | شناسه منحصر به فرد سفارش در سیستم فروشنده | [readonly]
**status** | [**\OpenAPI\Client\Model\OrderStatusEnum**](OrderStatusEnum.md) |  | [readonly]
**status_display** | **string** |  | [readonly]
**main_amount** | **int** | مجموع قیمت اولیه تمام کالاهای سفارش بدون تخفیف (به تومان) | [readonly]
**final_amount** | **int** | قیمت نهایی قابل پرداخت توسط مشتری: مبلغ_اصلی - مبلغ_تخفیف + مبلغ_مالیات (به تومان) | [readonly]
**total_paid_amount** | **int** | مبلغ کل پرداخت شده توسط کاربر: مبلغ_نهایی + هزینه_ارسال (به تومان) | [readonly]
**discount_amount** | **int** | مبلغ کل تخفیف اعمال شده بر سفارش (به تومان) | [readonly]
**tax_amount** | **int** | مبلغ کل مالیات برای سفارش (به تومان) | [readonly]
**shipping_amount** | **int** | هزینه ارسال برای سفارش (به تومان) | [readonly]
**loyalty_amount** | **int** | مقدار تخفیف از برنامه باشگاه مشتریان/پاداش (به تومان) | [readonly]
**callback_url** | **string** | آدرسی برای دریافت اطلاع رسانی وضعیت پرداخت پس از تکمیل سفارش | [readonly]
**merchant** | [**\OpenAPI\Client\Model\Merchant**](Merchant.md) |  |
**items** | [**\OpenAPI\Client\Model\OrderItemCreate[]**](OrderItemCreate.md) |  |
**source_address** | **mixed** |  | [readonly]
**destination_address** | **mixed** |  | [readonly]
**selected_shipping_method** | [**\OpenAPI\Client\Model\ShippingMethod**](ShippingMethod.md) |  | [readonly]
**shipping_selected_at** | **\DateTime** |  | [readonly]
**address_selected_at** | **\DateTime** |  | [readonly]
**packing_amount** | **int** | هزینه روش بسته‌بندی انتخاب‌شده (به تومان) | [readonly]
**packing_selected_at** | **\DateTime** |  | [readonly]
**selected_packing** | [**\OpenAPI\Client\Model\Packing**](Packing.md) |  | [readonly]
**can_select_packing** | **bool** |  | [readonly]
**can_select_shipping** | **bool** |  | [readonly]
**can_select_address** | **bool** |  | [readonly]
**can_proceed_to_payment** | **bool** |  | [readonly]
**is_paid** | **bool** |  | [readonly]
**user** | [**\OpenAPI\Client\Model\OrderUser**](OrderUser.md) |  | [readonly]
**payment** | [**\OpenAPI\Client\Model\PaymentOrder**](PaymentOrder.md) |  | [readonly]
**preparation_time** | **int** | Preparation time for the order (in days) | [readonly]
**weight** | **float** | Total weight of the order (in grams) | [readonly]
**selected_shipping_data** | **array<string,mixed>** |  | [readonly]
**reference_code** | **string** | کد مرجع یکتا برای پیگیری سفارش مشتری (قالب: BD-XXXXXXXX) | [readonly]
**promotion_discount_amount** | **float** |  | [readonly]
**promotion_data** | **array<string,mixed>** |  | [readonly]
**digipay_markup_amount** | **int** | Markup amount for the order (in Tomans) | [readonly]
**markup_commission_percentage** | **int** | Markup commission percentage for the order (in percent) | [readonly]
**previous_status** | [**\OpenAPI\Client\Model\OrderStatusEnum**](OrderStatusEnum.md) |  | [readonly]
**previous_status_display** | **string** |  | [readonly]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
