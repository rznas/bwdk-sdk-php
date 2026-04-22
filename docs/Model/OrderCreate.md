# OrderCreate

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**merchant_order_id** | **string** | شناسه منحصر به فرد این سفارش در سیستم فروشنده |
**merchant_unique_id** | **string** | شناسه منحصر به فرد برای تأیید اصالت سفارش |
**main_amount** | **int** | مجموع قیمت‌های اولیه تمام کالاها بدون تخفیف (به تومان) | [optional]
**final_amount** | **int** | مبلغ نهایی: مبلغ_اصلی - مبلغ_تخفیف + مبلغ_مالیات (به تومان) | [optional]
**total_paid_amount** | **int** | مبلغ کل پرداخت شده توسط کاربر: مبلغ_نهایی + هزینه_ارسال (به تومان) | [optional]
**discount_amount** | **int** | مبلغ کل تخفیف برای تمام سفارش (به تومان) | [optional]
**tax_amount** | **int** | مبلغ کل مالیات برای تمام سفارش (به تومان) | [optional]
**shipping_amount** | **int** | هزینه ارسال برای سفارش (به تومان) | [optional]
**loyalty_amount** | **int** | مبلغ تخفیف باشگاه مشتریان/پاداش (به تومان) | [optional]
**callback_url** | **string** | آدرس وب‌هوک برای دریافت اطلاع رسانی وضعیت پرداخت |
**destination_address** | **mixed** |  | [readonly]
**items** | [**\OpenAPI\Client\Model\OrderItemCreate[]**](OrderItemCreate.md) |  |
**merchant** | **int** | مقدار توسط سیستم جایگذاری می شود | [optional]
**source_address** | **mixed** | مقدار توسط سیستم جایگذاری می شود | [optional]
**user** | **int** |  | [readonly]
**reservation_expired_at** | **int** | مهلت پرداخت (به عنوان Unix timestamp) قبل از اتمام سفارش | [optional]
**reference_code** | **string** | کد مرجع منحصر به فرد برای پیگیری سفارش مشتری (فرمت: BD-XXXXXXXX) | [readonly]
**preparation_time** | **int** | زمان آمادهسازی سفارش (به روز) | [optional] [default to 2]
**weight** | **float** | وزن کل سفارش (بر حسب گرم) | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)
