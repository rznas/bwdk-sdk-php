<?php
/**
 * OrderDetail
 *
 * PHP version 8.1
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * BWDK API
 *
 * <div dir=\"rtl\" style=\"text-align: right;\">  # مستندات فروشندگان در سرویس خرید با دیجی‌کالا  این پلتفرم برای فروشندگان (مرچنت‌ها) جهت یکپارچه‌سازی خدمات پرداخت و تجارت الکترونیکی با سیستم خرید با دیجی‌کالا. شامل مدیریت سفارشات، ارسال، و احراز هویت فروشندگان است.     ```mermaid flowchart TD     START([شروع]) --> INITIAL      INITIAL[\"1️⃣ INITIAL\\nسفارش ایجاد شد\"]     STARTED[\"2️⃣ STARTED\\nمشتری به BWDK هدایت شد\"]     PENDING[\"3️⃣ PENDING\\nمشتری وارد شد و سفارش در انتظار پرداخت\"]     WAITING_FOR_GATEWAY[\"4️⃣ WAITING_FOR_GATEWAY\\nمشتری به درگاه پرداخت هدایت شد\"]     PAID_BY_USER[\"7️⃣ PAID_BY_USER\\nپرداخت موفق\"]     VERIFIED_BY_MERCHANT[\"9️⃣ VERIFIED_BY_MERCHANT\\nتأیید شده توسط فروشنده\"]     SHIPPED[\"🚚 SHIPPED\\nارسال شد\"]     DELIVERED[\"✅ DELIVERED\\nتحویل داده شد\"]      EXPIRED[\"⏰ EXPIRED\\nمنقضی شد\"]     EXPIRATION_TIME_EXCEEDED[\"⏱️ EXPIRATION_TIME_EXCEEDED\\nزمان انقضا گذشت\"]     CANCELLED[\"❌ CANCELLED\\nلغو توسط مشتری\"]     FAILED_TO_PAY[\"💳 FAILED_TO_PAY\\nپرداخت ناموفق\"]     FAILED_TO_VERIFY_BY_MERCHANT[\"🔴 FAILED_TO_VERIFY_BY_MERCHANT\\nتأیید مرچنت ناموفق\"]     FAILED_BY_MERCHANT[\"🔴 FAILED_BY_MERCHANT\\nخطا از سمت مرچنت\"]     CANCELLED_BY_MERCHANT[\"🔴 CANCELLED_BY_MERCHANT\\nلغو توسط مرچنت\"]      R_CUSTOMER_REQUEST[\"1️⃣3️⃣ REQUEST_TO_REFUND\\nدرخواست استرداد توسط مشتری\"]     R_FAILED_VERIFY[\"1️⃣4️⃣ REQUEST_TO_REFUND\\nاسترداد پس از تأیید ناموفق مرچنت\"]     R_FAILED_MERCHANT[\"1️⃣5️⃣ REQUEST_TO_REFUND\\nاسترداد پس از خطای مرچنت\"]     R_CANCELLED_MERCHANT[\"1️⃣6️⃣ REQUEST_TO_REFUND\\nاسترداد پس از لغو مرچنت\"]     REFUND_COMPLETED[\"✅ REFUND_COMPLETED\\nاسترداد تکمیل شد\"]      INITIAL -->|\"مرچنت سفارش ایجاد کرد\"| STARTED     STARTED -->|\"مشتری وارد سیستم شد\"| PENDING     PENDING -->|\"مشتری سفارش را نهایی و ثبت کرد\"| WAITING_FOR_GATEWAY     WAITING_FOR_GATEWAY -->|\"پرداخت با موفقیت انجام شد\"| PAID_BY_USER     PAID_BY_USER -->|\"مرچنت سفارش را تأیید کرد\"| VERIFIED_BY_MERCHANT     VERIFIED_BY_MERCHANT -->|\"مرچنت وضعیت را به ارسال تغییر داد\"| SHIPPED     SHIPPED -->|\"مرچنت تحویل را تأیید کرد\"| DELIVERED      INITIAL -->|\"زمان رزرو به پایان رسید\"| EXPIRED     STARTED -->|\"زمان رزرو به پایان رسید\"| EXPIRED     PENDING -->|\"زمان رزرو به پایان رسید\"| EXPIRED     WAITING_FOR_GATEWAY -->|\"زمان رزرو به پایان رسید\"| EXPIRED      PENDING -->|\"زمان مجاز سفارش سپری شده بود\"| EXPIRATION_TIME_EXCEEDED     WAITING_FOR_GATEWAY -->|\"زمان مجاز سفارش سپری شده بود\"| EXPIRATION_TIME_EXCEEDED      PENDING -->|\"مشتری انصراف داد\"| CANCELLED     WAITING_FOR_GATEWAY -->|\"مشتری انصراف داد\"| CANCELLED      WAITING_FOR_GATEWAY -->|\"پرداخت ناموفق بود\"| FAILED_TO_PAY      PAID_BY_USER -->|\"مرچنت تأیید را رد کرد\"| FAILED_TO_VERIFY_BY_MERCHANT     PAID_BY_USER -->|\"مرچنت اعلام ناتوانی در انجام سفارش کرد\"| FAILED_BY_MERCHANT     PAID_BY_USER -->|\"مرچنت سفارش را لغو کرد\"| CANCELLED_BY_MERCHANT     VERIFIED_BY_MERCHANT -->|\"مرچنت سفارش را لغو کرد\"| CANCELLED_BY_MERCHANT      PAID_BY_USER -->|\"مرچنت درخواست استرداد داد\"| R_CUSTOMER_REQUEST     VERIFIED_BY_MERCHANT -->|\"مرچنت درخواست استرداد داد\"| R_CUSTOMER_REQUEST     FAILED_TO_VERIFY_BY_MERCHANT -->|\"سیستم استرداد را آغاز کرد\"| R_FAILED_VERIFY     FAILED_BY_MERCHANT -->|\"سیستم استرداد را آغاز کرد\"| R_FAILED_MERCHANT     CANCELLED_BY_MERCHANT -->|\"سیستم استرداد را آغاز کرد\"| R_CANCELLED_MERCHANT      R_CUSTOMER_REQUEST -->|\"استرداد توسط دیجی‌پی تأیید شد\"| REFUND_COMPLETED     R_FAILED_VERIFY -->|\"استرداد توسط دیجی‌پی تأیید شد\"| REFUND_COMPLETED     R_FAILED_MERCHANT -->|\"استرداد توسط دیجی‌پی تأیید شد\"| REFUND_COMPLETED     R_CANCELLED_MERCHANT -->|\"استرداد توسط دیجی‌پی تأیید شد\"| REFUND_COMPLETED      style INITIAL fill:#9e9e9e,color:#fff     style STARTED fill:#1565c0,color:#fff     style PENDING fill:#ef6c00,color:#fff     style WAITING_FOR_GATEWAY fill:#6a1b9a,color:#fff     style PAID_BY_USER fill:#2e7d32,color:#fff     style VERIFIED_BY_MERCHANT fill:#1b5e20,color:#fff     style SHIPPED fill:#0277bd,color:#fff     style DELIVERED fill:#1b5e20,color:#fff     style EXPIRED fill:#b71c1c,color:#fff     style EXPIRATION_TIME_EXCEEDED fill:#b71c1c,color:#fff     style CANCELLED fill:#7f0000,color:#fff     style FAILED_TO_PAY fill:#b71c1c,color:#fff     style FAILED_TO_VERIFY_BY_MERCHANT fill:#b71c1c,color:#fff     style FAILED_BY_MERCHANT fill:#b71c1c,color:#fff     style CANCELLED_BY_MERCHANT fill:#7f0000,color:#fff     style R_CUSTOMER_REQUEST fill:#e65100,color:#fff     style R_FAILED_VERIFY fill:#e65100,color:#fff     style R_FAILED_MERCHANT fill:#e65100,color:#fff     style R_CANCELLED_MERCHANT fill:#e65100,color:#fff     style REFUND_COMPLETED fill:#2e7d32,color:#fff ```  ---  <div dir=\"rtl\" style=\"text-align: right;\">  ## توضیح وضعیت‌های سفارش  ### ۱. INITIAL — ایجاد اولیه سفارش  **معنا:** سفارش توسط بک‌اند مرچنت ساخته شده ولی هنوز هیچ کاربری به آن اختصاص داده نشده است.  **چگونه اتفاق می‌افتد:** مرچنت با ارسال درخواست `POST /api/v1/orders/create` و ارائه اطلاعات کالاها، مبلغ و `callback_url`، یک سفارش جدید ایجاد می‌کند. BWDK یک `order_uuid` منحصربه‌فرد و لینک شروع سفارش (`order_start_url`) برمی‌گرداند.  **وابستگی‌ها:** نیازی به کاربر یا پرداخت ندارد. فقط اطلاعات کالا از سمت مرچنت کافی است.  ---  ### ۲. STARTED — آغاز جریان خرید  **معنا:** مشتری روی لینک شروع سفارش کلیک کرده و وارد محیط BWDK شده است، اما هنوز لاگین نکرده.  **چگونه اتفاق می‌افتد:** وقتی مشتری به `order_start_url` هدایت می‌شود، BWDK وضعیت سفارش را از `INITIAL` به `STARTED` تغییر می‌دهد. در این مرحله فرآیند احراز هویت (SSO) آغاز می‌شود.  **وابستگی‌ها:** مشتری باید به لینک شروع هدایت شده باشد.  ---  ### ۳. PENDING — انتظار برای تکمیل سفارش  **معنا:** مشتری با موفقیت وارد سیستم شده و سفارش به حساب او اختصاص یافته. مشتری در حال انتخاب آدرس، روش ارسال، بسته‌بندی یا تخفیف است.  **چگونه اتفاق می‌افتد:** پس از تکمیل ورود به سیستم (SSO)، BWDK سفارش را به کاربر وصل کرده و وضعیت را به `PENDING` تغییر می‌دهد.  **وابستگی‌ها:** ورود موفق کاربر به سیستم (SSO). در این مرحله مشتری می‌تواند آدرس، شیپینگ، پکینگ و تخفیف را انتخاب کند.  ---  ### ۴. WAITING_FOR_GATEWAY — انتظار برای پرداخت  **معنا:** مشتری اطلاعات سفارش را تأیید کرده و به درگاه پرداخت هدایت شده است.  **چگونه اتفاق می‌افتد:** مشتری دکمه «پرداخت» را می‌زند (`POST /api/v1/orders/submit`)، سیستم یک رکورد پرداخت ایجاد می‌کند و کاربر به درگاه Digipay هدایت می‌شود. وضعیت سفارش به `WAITING_FOR_GATEWAY` تغییر می‌کند.  **وابستگی‌ها:** انتخاب آدرس، روش ارسال و بسته‌بندی الزامی است. پرداخت باید ایجاد شده باشد.  ---  ### ۷. PAID_BY_USER — پرداخت موفق  **معنا:** تراکنش پرداخت با موفقیت انجام شده و وجه از حساب مشتری کسر شده است.  **چگونه اتفاق می‌افتد:** درگاه پرداخت نتیجه موفق را به BWDK اطلاع می‌دهد. سیستم پرداخت را تأیید و وضعیت سفارش را به `PAID_BY_USER` تغییر می‌دهد. در این لحظه مشتری به `callback_url` مرچنت هدایت می‌شود.  **وابستگی‌ها:** تأیید موفق تراکنش از سوی درگاه پرداخت (Digipay).  ---  ### ۹. VERIFIED_BY_MERCHANT — تأیید توسط مرچنت  **معنا:** مرچنت سفارش را بررسی کرده و موجودی کالا و صحت اطلاعات را تأیید نموده است. سفارش آماده ارسال است.  **چگونه اتفاق می‌افتد:** مرچنت با ارسال درخواست `POST /api/v1/orders/manager/{uuid}/verify` سفارش را تأیید می‌کند. این مرحله **اجباری** است و باید پس از پرداخت موفق انجام شود.  **وابستگی‌ها:** سفارش باید در وضعیت `PAID_BY_USER` باشد. مرچنت باید موجودی کالا را بررسی کند.  ---  ### ۲۰. SHIPPED — ارسال شد  **معنا:** سفارش از انبار خارج شده و در حال ارسال به مشتری است.  **چگونه اتفاق می‌افتد:** مرچنت پس از ارسال کالا، وضعیت سفارش را از طریق API به `SHIPPED` تغییر می‌دهد.  **وابستگی‌ها:** سفارش باید در وضعیت `VERIFIED_BY_MERCHANT` باشد.  ---  ### ۱۹. DELIVERED — تحویل داده شد  **معنا:** سفارش به دست مشتری رسیده و فرآیند خرید به پایان رسیده است.  **چگونه اتفاق می‌افتد:** مرچنت پس از تحویل موفق، وضعیت را به `DELIVERED` تغییر می‌دهد.  **وابستگی‌ها:** سفارش باید در وضعیت `SHIPPED` باشد.  ---  ### ۵. EXPIRED — منقضی شد  **معنا:** زمان رزرو سفارش به پایان رسیده و سفارش به صورت خودکار لغو شده است.  **چگونه اتفاق می‌افتد:** یک Task دوره‌ای به طور خودکار سفارش‌هایی که `reservation_expired_at` آن‌ها گذشته را پیدا کرده و وضعیتشان را به `EXPIRED` تغییر می‌دهد. این مکانیزم مانع بلوکه شدن موجودی کالا می‌شود.  **وابستگی‌ها:** سفارش باید در یکی از وضعیت‌های `INITIAL`، `STARTED`، `PENDING` یا `WAITING_FOR_GATEWAY` باشد و زمان رزرو آن گذشته باشد.  ---  ### ۱۸. EXPIRATION_TIME_EXCEEDED — زمان انقضا گذشت  **معنا:** در لحظه ثبت نهایی یا پرداخت، مشخص شد که زمان مجاز سفارش تمام شده است.  **چگونه اتفاق می‌افتد:** هنگام ارسال درخواست پرداخت (`submit_order`)، سیستم بررسی می‌کند که `expiration_time` سفارش هنوز معتبر است یا خیر. در صورت گذشتن زمان، وضعیت به `EXPIRATION_TIME_EXCEEDED` تغییر می‌کند.  **وابستگی‌ها:** سفارش در وضعیت `PENDING` یا `WAITING_FOR_GATEWAY` است و فیلد `expiration_time` سپری شده.  ---  ### ۶. CANCELLED — لغو توسط مشتری  **معنا:** مشتری در حین فرآیند خرید (قبل از پرداخت) سفارش را لغو کرده یا از صفحه خارج شده است.  **چگونه اتفاق می‌افتد:** مشتری در صفحه checkout دکمه «انصراف» را می‌زند یا پرداخت ناموفق بوده و سفارش به حالت لغو درمی‌آید.  **وابستگی‌ها:** سفارش باید در وضعیت `PENDING` یا `WAITING_FOR_GATEWAY` باشد. پرداختی انجام نشده است.  ---  ### ۸. FAILED_TO_PAY — پرداخت ناموفق  **معنا:** تراکنش پرداخت انجام نشد یا با خطا مواجه شد.  **چگونه اتفاق می‌افتد:** درگاه پرداخت نتیجه ناموفق برمی‌گرداند یا فرآیند بازگشت وجه در مرحله پرداخت با شکست مواجه می‌شود.  **وابستگی‌ها:** سفارش باید در وضعیت `WAITING_FOR_GATEWAY` بوده باشد.  ---  ### ۱۰. FAILED_TO_VERIFY_BY_MERCHANT — تأیید ناموفق توسط مرچنت  **معنا:** مرچنت سفارش را رد کرده است؛ معمولاً به دلیل ناموجود بودن کالا یا مغایرت اطلاعات.  **چگونه اتفاق می‌افتد:** مرچنت در پاسخ به درخواست verify، خطا برمی‌گرداند یا API آن وضعیت ناموفق تنظیم می‌کند. پس از این وضعیت، فرآیند استرداد وجه آغاز می‌شود.  **وابستگی‌ها:** سفارش باید در وضعیت `PAID_BY_USER` باشد.  ---  ### ۱۱. FAILED_BY_MERCHANT — خطا از سمت مرچنت  **معنا:** مرچنت پس از تأیید اولیه، اعلام می‌کند که قادر به انجام سفارش نیست (مثلاً به دلیل اتمام موجودی).  **چگونه اتفاق می‌افتد:** مرچنت وضعیت را به `FAILED_BY_MERCHANT` تغییر می‌دهد. وجه پرداختی مشتری مسترد خواهد شد.  **وابستگی‌ها:** سفارش باید در وضعیت `PAID_BY_USER` باشد.  ---  ### ۱۲. CANCELLED_BY_MERCHANT — لغو توسط مرچنت  **معنا:** مرچنت پس از پرداخت، سفارش را به هر دلیلی لغو کرده است.  **چگونه اتفاق می‌افتد:** مرچنت درخواست لغو سفارش را ارسال می‌کند. وجه پرداختی مشتری به او بازگردانده می‌شود.  **وابستگی‌ها:** سفارش باید در وضعیت `PAID_BY_USER` یا `VERIFIED_BY_MERCHANT` باشد.  ---  ### ۱۳. REQUEST_TO_REFUND — درخواست استرداد توسط مشتری  **معنا:** مشتری درخواست بازگشت وجه داده و سیستم در حال پردازش استرداد است.  **چگونه اتفاق می‌افتد:** مرچنت از طریق API درخواست استرداد را ثبت می‌کند (`POST /api/v1/orders/manager/{uuid}/refund`). سفارش وارد صف پردازش استرداد می‌شود.  **وابستگی‌ها:** سفارش باید در وضعیت `PAID_BY_USER` یا `VERIFIED_BY_MERCHANT` باشد.  ---  ### ۱۴، ۱۵، ۱۶. سایر وضعیت‌های درخواست استرداد  این وضعیت‌ها بر اساس دلیل استرداد از هم تفکیک می‌شوند:  - **۱۴ — REQUEST_TO_REFUND_TO_MERCHANT_AFTER_FAILED_TO_VERIFY:** استرداد پس از ناموفق بودن تأیید مرچنت؛ وجه به حساب مرچنت بازمی‌گردد. - **۱۵ — REQUEST_TO_REFUND_TO_CUSTOMER_AFTER_FAILED_BY_MERCHANT:** استرداد پس از خطای مرچنت؛ وجه به مشتری بازمی‌گردد. - **۱۶ — REQUEST_TO_REFUND_TO_MERCHANT_AFTER_CANCELLED_BY_MERCHANT:** استرداد پس از لغو توسط مرچنت؛ وجه به حساب مرچنت برمی‌گردد.  **چگونه اتفاق می‌افتد:** به صورت خودکار پس از رسیدن به وضعیت‌های ناموفق/لغو مربوطه توسط سیستم تنظیم می‌شود.  ---  ### ۱۷. REFUND_COMPLETED — استرداد تکمیل شد  **معنا:** وجه با موفقیت به صاحب آن (مشتری یا مرچنت بسته به نوع استرداد) بازگردانده شده است.  **چگونه اتفاق می‌افتد:** Task پردازش استرداد (`process_order_refund`) پس از تأیید موفق بازگشت وجه از سوی Digipay، وضعیت سفارش را به `REFUND_COMPLETED` تغییر می‌دهد.  **وابستگی‌ها:** یکی از وضعیت‌های درخواست استرداد (۱۳، ۱۴، ۱۵ یا ۱۶) باید فعال باشد و Digipay تراکنش استرداد را تأیید کرده باشد.  </div>
 *
 * The version of the OpenAPI document: 1.0.0
 * Generated by: https://openapi-generator.tech
 * Generator version: 7.21.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace OpenAPI\Client\Model;

use \ArrayAccess;
use \OpenAPI\Client\ObjectSerializer;

/**
 * OrderDetail Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class OrderDetail implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'OrderDetail';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id' => 'int',
        'created_at' => '\DateTime',
        'order_uuid' => 'string',
        'reservation_expired_at' => 'int',
        'merchant_order_id' => 'string',
        'status' => '\OpenAPI\Client\Model\OrderStatusEnum',
        'status_display' => 'string',
        'main_amount' => 'int',
        'final_amount' => 'int',
        'total_paid_amount' => 'int',
        'discount_amount' => 'int',
        'tax_amount' => 'int',
        'shipping_amount' => 'int',
        'loyalty_amount' => 'int',
        'callback_url' => 'string',
        'merchant' => '\OpenAPI\Client\Model\Merchant',
        'items' => '\OpenAPI\Client\Model\OrderItemCreate[]',
        'source_address' => 'mixed',
        'destination_address' => 'mixed',
        'selected_shipping_method' => '\OpenAPI\Client\Model\ShippingMethod',
        'shipping_selected_at' => '\DateTime',
        'address_selected_at' => '\DateTime',
        'packing_amount' => 'int',
        'packing_selected_at' => '\DateTime',
        'selected_packing' => '\OpenAPI\Client\Model\Packing',
        'can_select_packing' => 'bool',
        'can_select_shipping' => 'bool',
        'can_select_address' => 'bool',
        'can_proceed_to_payment' => 'bool',
        'is_paid' => 'bool',
        'user' => '\OpenAPI\Client\Model\OrderUser',
        'payment' => '\OpenAPI\Client\Model\PaymentOrder',
        'preparation_time' => 'int',
        'weight' => 'float',
        'selected_shipping_data' => 'array<string,mixed>',
        'reference_code' => 'string',
        'promotion_discount_amount' => 'float',
        'promotion_data' => 'array<string,mixed>',
        'digipay_markup_amount' => 'int',
        'markup_commission_percentage' => 'int',
        'previous_status' => '\OpenAPI\Client\Model\OrderStatusEnum',
        'previous_status_display' => 'string'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'id' => null,
        'created_at' => 'date-time',
        'order_uuid' => 'uuid',
        'reservation_expired_at' => null,
        'merchant_order_id' => null,
        'status' => null,
        'status_display' => null,
        'main_amount' => null,
        'final_amount' => null,
        'total_paid_amount' => null,
        'discount_amount' => null,
        'tax_amount' => null,
        'shipping_amount' => null,
        'loyalty_amount' => null,
        'callback_url' => 'uri',
        'merchant' => null,
        'items' => null,
        'source_address' => null,
        'destination_address' => null,
        'selected_shipping_method' => null,
        'shipping_selected_at' => 'date-time',
        'address_selected_at' => 'date-time',
        'packing_amount' => null,
        'packing_selected_at' => 'date-time',
        'selected_packing' => null,
        'can_select_packing' => null,
        'can_select_shipping' => null,
        'can_select_address' => null,
        'can_proceed_to_payment' => null,
        'is_paid' => null,
        'user' => null,
        'payment' => null,
        'preparation_time' => null,
        'weight' => 'double',
        'selected_shipping_data' => null,
        'reference_code' => null,
        'promotion_discount_amount' => 'double',
        'promotion_data' => null,
        'digipay_markup_amount' => null,
        'markup_commission_percentage' => null,
        'previous_status' => null,
        'previous_status_display' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'id' => false,
        'created_at' => false,
        'order_uuid' => false,
        'reservation_expired_at' => true,
        'merchant_order_id' => false,
        'status' => false,
        'status_display' => false,
        'main_amount' => false,
        'final_amount' => false,
        'total_paid_amount' => false,
        'discount_amount' => false,
        'tax_amount' => false,
        'shipping_amount' => false,
        'loyalty_amount' => false,
        'callback_url' => false,
        'merchant' => false,
        'items' => false,
        'source_address' => true,
        'destination_address' => true,
        'selected_shipping_method' => false,
        'shipping_selected_at' => true,
        'address_selected_at' => true,
        'packing_amount' => false,
        'packing_selected_at' => true,
        'selected_packing' => false,
        'can_select_packing' => false,
        'can_select_shipping' => false,
        'can_select_address' => false,
        'can_proceed_to_payment' => false,
        'is_paid' => false,
        'user' => false,
        'payment' => false,
        'preparation_time' => false,
        'weight' => false,
        'selected_shipping_data' => false,
        'reference_code' => false,
        'promotion_discount_amount' => false,
        'promotion_data' => false,
        'digipay_markup_amount' => false,
        'markup_commission_percentage' => false,
        'previous_status' => true,
        'previous_status_display' => false
    ];

    /**
     * If a nullable field gets set to null, insert it here
     *
     * @var boolean[]
     */
    protected array $openAPINullablesSetToNull = [];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of nullable properties
     *
     * @return array
     */
    protected static function openAPINullables(): array
    {
        return self::$openAPINullables;
    }

    /**
     * Array of nullable field names deliberately set to null
     *
     * @return boolean[]
     */
    private function getOpenAPINullablesSetToNull(): array
    {
        return $this->openAPINullablesSetToNull;
    }

    /**
     * Setter - Array of nullable field names deliberately set to null
     *
     * @param boolean[] $openAPINullablesSetToNull
     */
    private function setOpenAPINullablesSetToNull(array $openAPINullablesSetToNull): void
    {
        $this->openAPINullablesSetToNull = $openAPINullablesSetToNull;
    }

    /**
     * Checks if a property is nullable
     *
     * @param string $property
     * @return bool
     */
    public static function isNullable(string $property): bool
    {
        return self::openAPINullables()[$property] ?? false;
    }

    /**
     * Checks if a nullable property is set to null.
     *
     * @param string $property
     * @return bool
     */
    public function isNullableSetToNull(string $property): bool
    {
        return in_array($property, $this->getOpenAPINullablesSetToNull(), true);
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
        'created_at' => 'created_at',
        'order_uuid' => 'order_uuid',
        'reservation_expired_at' => 'reservation_expired_at',
        'merchant_order_id' => 'merchant_order_id',
        'status' => 'status',
        'status_display' => 'status_display',
        'main_amount' => 'main_amount',
        'final_amount' => 'final_amount',
        'total_paid_amount' => 'total_paid_amount',
        'discount_amount' => 'discount_amount',
        'tax_amount' => 'tax_amount',
        'shipping_amount' => 'shipping_amount',
        'loyalty_amount' => 'loyalty_amount',
        'callback_url' => 'callback_url',
        'merchant' => 'merchant',
        'items' => 'items',
        'source_address' => 'source_address',
        'destination_address' => 'destination_address',
        'selected_shipping_method' => 'selected_shipping_method',
        'shipping_selected_at' => 'shipping_selected_at',
        'address_selected_at' => 'address_selected_at',
        'packing_amount' => 'packing_amount',
        'packing_selected_at' => 'packing_selected_at',
        'selected_packing' => 'selected_packing',
        'can_select_packing' => 'can_select_packing',
        'can_select_shipping' => 'can_select_shipping',
        'can_select_address' => 'can_select_address',
        'can_proceed_to_payment' => 'can_proceed_to_payment',
        'is_paid' => 'is_paid',
        'user' => 'user',
        'payment' => 'payment',
        'preparation_time' => 'preparation_time',
        'weight' => 'weight',
        'selected_shipping_data' => 'selected_shipping_data',
        'reference_code' => 'reference_code',
        'promotion_discount_amount' => 'promotion_discount_amount',
        'promotion_data' => 'promotion_data',
        'digipay_markup_amount' => 'digipay_markup_amount',
        'markup_commission_percentage' => 'markup_commission_percentage',
        'previous_status' => 'previous_status',
        'previous_status_display' => 'previous_status_display'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'created_at' => 'setCreatedAt',
        'order_uuid' => 'setOrderUuid',
        'reservation_expired_at' => 'setReservationExpiredAt',
        'merchant_order_id' => 'setMerchantOrderId',
        'status' => 'setStatus',
        'status_display' => 'setStatusDisplay',
        'main_amount' => 'setMainAmount',
        'final_amount' => 'setFinalAmount',
        'total_paid_amount' => 'setTotalPaidAmount',
        'discount_amount' => 'setDiscountAmount',
        'tax_amount' => 'setTaxAmount',
        'shipping_amount' => 'setShippingAmount',
        'loyalty_amount' => 'setLoyaltyAmount',
        'callback_url' => 'setCallbackUrl',
        'merchant' => 'setMerchant',
        'items' => 'setItems',
        'source_address' => 'setSourceAddress',
        'destination_address' => 'setDestinationAddress',
        'selected_shipping_method' => 'setSelectedShippingMethod',
        'shipping_selected_at' => 'setShippingSelectedAt',
        'address_selected_at' => 'setAddressSelectedAt',
        'packing_amount' => 'setPackingAmount',
        'packing_selected_at' => 'setPackingSelectedAt',
        'selected_packing' => 'setSelectedPacking',
        'can_select_packing' => 'setCanSelectPacking',
        'can_select_shipping' => 'setCanSelectShipping',
        'can_select_address' => 'setCanSelectAddress',
        'can_proceed_to_payment' => 'setCanProceedToPayment',
        'is_paid' => 'setIsPaid',
        'user' => 'setUser',
        'payment' => 'setPayment',
        'preparation_time' => 'setPreparationTime',
        'weight' => 'setWeight',
        'selected_shipping_data' => 'setSelectedShippingData',
        'reference_code' => 'setReferenceCode',
        'promotion_discount_amount' => 'setPromotionDiscountAmount',
        'promotion_data' => 'setPromotionData',
        'digipay_markup_amount' => 'setDigipayMarkupAmount',
        'markup_commission_percentage' => 'setMarkupCommissionPercentage',
        'previous_status' => 'setPreviousStatus',
        'previous_status_display' => 'setPreviousStatusDisplay'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'created_at' => 'getCreatedAt',
        'order_uuid' => 'getOrderUuid',
        'reservation_expired_at' => 'getReservationExpiredAt',
        'merchant_order_id' => 'getMerchantOrderId',
        'status' => 'getStatus',
        'status_display' => 'getStatusDisplay',
        'main_amount' => 'getMainAmount',
        'final_amount' => 'getFinalAmount',
        'total_paid_amount' => 'getTotalPaidAmount',
        'discount_amount' => 'getDiscountAmount',
        'tax_amount' => 'getTaxAmount',
        'shipping_amount' => 'getShippingAmount',
        'loyalty_amount' => 'getLoyaltyAmount',
        'callback_url' => 'getCallbackUrl',
        'merchant' => 'getMerchant',
        'items' => 'getItems',
        'source_address' => 'getSourceAddress',
        'destination_address' => 'getDestinationAddress',
        'selected_shipping_method' => 'getSelectedShippingMethod',
        'shipping_selected_at' => 'getShippingSelectedAt',
        'address_selected_at' => 'getAddressSelectedAt',
        'packing_amount' => 'getPackingAmount',
        'packing_selected_at' => 'getPackingSelectedAt',
        'selected_packing' => 'getSelectedPacking',
        'can_select_packing' => 'getCanSelectPacking',
        'can_select_shipping' => 'getCanSelectShipping',
        'can_select_address' => 'getCanSelectAddress',
        'can_proceed_to_payment' => 'getCanProceedToPayment',
        'is_paid' => 'getIsPaid',
        'user' => 'getUser',
        'payment' => 'getPayment',
        'preparation_time' => 'getPreparationTime',
        'weight' => 'getWeight',
        'selected_shipping_data' => 'getSelectedShippingData',
        'reference_code' => 'getReferenceCode',
        'promotion_discount_amount' => 'getPromotionDiscountAmount',
        'promotion_data' => 'getPromotionData',
        'digipay_markup_amount' => 'getDigipayMarkupAmount',
        'markup_commission_percentage' => 'getMarkupCommissionPercentage',
        'previous_status' => 'getPreviousStatus',
        'previous_status_display' => 'getPreviousStatusDisplay'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[]|null $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(?array $data = null)
    {
        $this->setIfExists('id', $data ?? [], null);
        $this->setIfExists('created_at', $data ?? [], null);
        $this->setIfExists('order_uuid', $data ?? [], null);
        $this->setIfExists('reservation_expired_at', $data ?? [], null);
        $this->setIfExists('merchant_order_id', $data ?? [], null);
        $this->setIfExists('status', $data ?? [], null);
        $this->setIfExists('status_display', $data ?? [], null);
        $this->setIfExists('main_amount', $data ?? [], null);
        $this->setIfExists('final_amount', $data ?? [], null);
        $this->setIfExists('total_paid_amount', $data ?? [], null);
        $this->setIfExists('discount_amount', $data ?? [], null);
        $this->setIfExists('tax_amount', $data ?? [], null);
        $this->setIfExists('shipping_amount', $data ?? [], null);
        $this->setIfExists('loyalty_amount', $data ?? [], null);
        $this->setIfExists('callback_url', $data ?? [], null);
        $this->setIfExists('merchant', $data ?? [], null);
        $this->setIfExists('items', $data ?? [], null);
        $this->setIfExists('source_address', $data ?? [], null);
        $this->setIfExists('destination_address', $data ?? [], null);
        $this->setIfExists('selected_shipping_method', $data ?? [], null);
        $this->setIfExists('shipping_selected_at', $data ?? [], null);
        $this->setIfExists('address_selected_at', $data ?? [], null);
        $this->setIfExists('packing_amount', $data ?? [], null);
        $this->setIfExists('packing_selected_at', $data ?? [], null);
        $this->setIfExists('selected_packing', $data ?? [], null);
        $this->setIfExists('can_select_packing', $data ?? [], null);
        $this->setIfExists('can_select_shipping', $data ?? [], null);
        $this->setIfExists('can_select_address', $data ?? [], null);
        $this->setIfExists('can_proceed_to_payment', $data ?? [], null);
        $this->setIfExists('is_paid', $data ?? [], null);
        $this->setIfExists('user', $data ?? [], null);
        $this->setIfExists('payment', $data ?? [], null);
        $this->setIfExists('preparation_time', $data ?? [], null);
        $this->setIfExists('weight', $data ?? [], null);
        $this->setIfExists('selected_shipping_data', $data ?? [], null);
        $this->setIfExists('reference_code', $data ?? [], null);
        $this->setIfExists('promotion_discount_amount', $data ?? [], null);
        $this->setIfExists('promotion_data', $data ?? [], null);
        $this->setIfExists('digipay_markup_amount', $data ?? [], null);
        $this->setIfExists('markup_commission_percentage', $data ?? [], null);
        $this->setIfExists('previous_status', $data ?? [], null);
        $this->setIfExists('previous_status_display', $data ?? [], null);
    }

    /**
     * Sets $this->container[$variableName] to the given data or to the given default Value; if $variableName
     * is nullable and its value is set to null in the $fields array, then mark it as "set to null" in the
     * $this->openAPINullablesSetToNull array
     *
     * @param string $variableName
     * @param array  $fields
     * @param mixed  $defaultValue
     */
    private function setIfExists(string $variableName, array $fields, $defaultValue): void
    {
        if (self::isNullable($variableName) && array_key_exists($variableName, $fields) && is_null($fields[$variableName])) {
            $this->openAPINullablesSetToNull[] = $variableName;
        }

        $this->container[$variableName] = $fields[$variableName] ?? $defaultValue;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if ($this->container['created_at'] === null) {
            $invalidProperties[] = "'created_at' can't be null";
        }
        if ($this->container['order_uuid'] === null) {
            $invalidProperties[] = "'order_uuid' can't be null";
        }
        if ($this->container['reservation_expired_at'] === null && !$this->isNullableSetToNull('reservation_expired_at')) {
            $invalidProperties[] = "'reservation_expired_at' can't be null";
        }
        if ($this->container['merchant_order_id'] === null) {
            $invalidProperties[] = "'merchant_order_id' can't be null";
        }
        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        if ($this->container['status_display'] === null) {
            $invalidProperties[] = "'status_display' can't be null";
        }
        if ($this->container['main_amount'] === null) {
            $invalidProperties[] = "'main_amount' can't be null";
        }
        if ($this->container['final_amount'] === null) {
            $invalidProperties[] = "'final_amount' can't be null";
        }
        if ($this->container['total_paid_amount'] === null) {
            $invalidProperties[] = "'total_paid_amount' can't be null";
        }
        if ($this->container['discount_amount'] === null) {
            $invalidProperties[] = "'discount_amount' can't be null";
        }
        if ($this->container['tax_amount'] === null) {
            $invalidProperties[] = "'tax_amount' can't be null";
        }
        if ($this->container['shipping_amount'] === null) {
            $invalidProperties[] = "'shipping_amount' can't be null";
        }
        if ($this->container['loyalty_amount'] === null) {
            $invalidProperties[] = "'loyalty_amount' can't be null";
        }
        if ($this->container['callback_url'] === null) {
            $invalidProperties[] = "'callback_url' can't be null";
        }
        if ($this->container['merchant'] === null) {
            $invalidProperties[] = "'merchant' can't be null";
        }
        if ($this->container['items'] === null) {
            $invalidProperties[] = "'items' can't be null";
        }
        if ($this->container['source_address'] === null && !$this->isNullableSetToNull('source_address')) {
            $invalidProperties[] = "'source_address' can't be null";
        }
        if ($this->container['destination_address'] === null && !$this->isNullableSetToNull('destination_address')) {
            $invalidProperties[] = "'destination_address' can't be null";
        }
        if ($this->container['selected_shipping_method'] === null) {
            $invalidProperties[] = "'selected_shipping_method' can't be null";
        }
        if ($this->container['shipping_selected_at'] === null && !$this->isNullableSetToNull('shipping_selected_at')) {
            $invalidProperties[] = "'shipping_selected_at' can't be null";
        }
        if ($this->container['address_selected_at'] === null && !$this->isNullableSetToNull('address_selected_at')) {
            $invalidProperties[] = "'address_selected_at' can't be null";
        }
        if ($this->container['packing_amount'] === null) {
            $invalidProperties[] = "'packing_amount' can't be null";
        }
        if ($this->container['packing_selected_at'] === null && !$this->isNullableSetToNull('packing_selected_at')) {
            $invalidProperties[] = "'packing_selected_at' can't be null";
        }
        if ($this->container['selected_packing'] === null) {
            $invalidProperties[] = "'selected_packing' can't be null";
        }
        if ($this->container['can_select_packing'] === null) {
            $invalidProperties[] = "'can_select_packing' can't be null";
        }
        if ($this->container['can_select_shipping'] === null) {
            $invalidProperties[] = "'can_select_shipping' can't be null";
        }
        if ($this->container['can_select_address'] === null) {
            $invalidProperties[] = "'can_select_address' can't be null";
        }
        if ($this->container['can_proceed_to_payment'] === null) {
            $invalidProperties[] = "'can_proceed_to_payment' can't be null";
        }
        if ($this->container['is_paid'] === null) {
            $invalidProperties[] = "'is_paid' can't be null";
        }
        if ($this->container['user'] === null) {
            $invalidProperties[] = "'user' can't be null";
        }
        if ($this->container['payment'] === null) {
            $invalidProperties[] = "'payment' can't be null";
        }
        if ($this->container['preparation_time'] === null) {
            $invalidProperties[] = "'preparation_time' can't be null";
        }
        if ($this->container['weight'] === null) {
            $invalidProperties[] = "'weight' can't be null";
        }
        if ($this->container['selected_shipping_data'] === null) {
            $invalidProperties[] = "'selected_shipping_data' can't be null";
        }
        if ($this->container['reference_code'] === null) {
            $invalidProperties[] = "'reference_code' can't be null";
        }
        if ($this->container['promotion_discount_amount'] === null) {
            $invalidProperties[] = "'promotion_discount_amount' can't be null";
        }
        if ($this->container['promotion_data'] === null) {
            $invalidProperties[] = "'promotion_data' can't be null";
        }
        if ($this->container['digipay_markup_amount'] === null) {
            $invalidProperties[] = "'digipay_markup_amount' can't be null";
        }
        if ($this->container['markup_commission_percentage'] === null) {
            $invalidProperties[] = "'markup_commission_percentage' can't be null";
        }
        if ($this->container['previous_status'] === null && !$this->isNullableSetToNull('previous_status')) {
            $invalidProperties[] = "'previous_status' can't be null";
        }
        if ($this->container['previous_status_display'] === null) {
            $invalidProperties[] = "'previous_status_display' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets id
     *
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int $id id
     *
     * @return self
     */
    public function setId($id)
    {
        if (is_null($id)) {
            throw new \InvalidArgumentException('non-nullable id cannot be null');
        }
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets created_at
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at
     *
     * @param \DateTime $created_at created_at
     *
     * @return self
     */
    public function setCreatedAt($created_at)
    {
        if (is_null($created_at)) {
            throw new \InvalidArgumentException('non-nullable created_at cannot be null');
        }
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets order_uuid
     *
     * @return string
     */
    public function getOrderUuid()
    {
        return $this->container['order_uuid'];
    }

    /**
     * Sets order_uuid
     *
     * @param string $order_uuid order_uuid
     *
     * @return self
     */
    public function setOrderUuid($order_uuid)
    {
        if (is_null($order_uuid)) {
            throw new \InvalidArgumentException('non-nullable order_uuid cannot be null');
        }
        $this->container['order_uuid'] = $order_uuid;

        return $this;
    }

    /**
     * Gets reservation_expired_at
     *
     * @return int|null
     */
    public function getReservationExpiredAt()
    {
        return $this->container['reservation_expired_at'];
    }

    /**
     * Sets reservation_expired_at
     *
     * @param int|null $reservation_expired_at Unix timestamp تا زمانی که سفارش برای پرداخت رزرو شده است
     *
     * @return self
     */
    public function setReservationExpiredAt($reservation_expired_at)
    {
        if (is_null($reservation_expired_at)) {
            array_push($this->openAPINullablesSetToNull, 'reservation_expired_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('reservation_expired_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['reservation_expired_at'] = $reservation_expired_at;

        return $this;
    }

    /**
     * Gets merchant_order_id
     *
     * @return string
     */
    public function getMerchantOrderId()
    {
        return $this->container['merchant_order_id'];
    }

    /**
     * Sets merchant_order_id
     *
     * @param string $merchant_order_id شناسه منحصر به فرد سفارش در سیستم فروشنده
     *
     * @return self
     */
    public function setMerchantOrderId($merchant_order_id)
    {
        if (is_null($merchant_order_id)) {
            throw new \InvalidArgumentException('non-nullable merchant_order_id cannot be null');
        }
        $this->container['merchant_order_id'] = $merchant_order_id;

        return $this;
    }

    /**
     * Gets status
     *
     * @return \OpenAPI\Client\Model\OrderStatusEnum
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param \OpenAPI\Client\Model\OrderStatusEnum $status status
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (is_null($status)) {
            throw new \InvalidArgumentException('non-nullable status cannot be null');
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets status_display
     *
     * @return string
     */
    public function getStatusDisplay()
    {
        return $this->container['status_display'];
    }

    /**
     * Sets status_display
     *
     * @param string $status_display status_display
     *
     * @return self
     */
    public function setStatusDisplay($status_display)
    {
        if (is_null($status_display)) {
            throw new \InvalidArgumentException('non-nullable status_display cannot be null');
        }
        $this->container['status_display'] = $status_display;

        return $this;
    }

    /**
     * Gets main_amount
     *
     * @return int
     */
    public function getMainAmount()
    {
        return $this->container['main_amount'];
    }

    /**
     * Sets main_amount
     *
     * @param int $main_amount مجموع قیمت‌های اولیه تمام کالاها بدون تخفیف (به تومان)
     *
     * @return self
     */
    public function setMainAmount($main_amount)
    {
        if (is_null($main_amount)) {
            throw new \InvalidArgumentException('non-nullable main_amount cannot be null');
        }
        $this->container['main_amount'] = $main_amount;

        return $this;
    }

    /**
     * Gets final_amount
     *
     * @return int
     */
    public function getFinalAmount()
    {
        return $this->container['final_amount'];
    }

    /**
     * Sets final_amount
     *
     * @param int $final_amount قیمت نهایی قابل پرداخت توسط مشتری: مبلغ_اصلی - مبلغ_تخفیف + مبلغ_مالیات (به تومان)
     *
     * @return self
     */
    public function setFinalAmount($final_amount)
    {
        if (is_null($final_amount)) {
            throw new \InvalidArgumentException('non-nullable final_amount cannot be null');
        }
        $this->container['final_amount'] = $final_amount;

        return $this;
    }

    /**
     * Gets total_paid_amount
     *
     * @return int
     */
    public function getTotalPaidAmount()
    {
        return $this->container['total_paid_amount'];
    }

    /**
     * Sets total_paid_amount
     *
     * @param int $total_paid_amount مبلغ کل پرداخت شده توسط کاربر: مبلغ_نهایی + هزینه_ارسال (به تومان)
     *
     * @return self
     */
    public function setTotalPaidAmount($total_paid_amount)
    {
        if (is_null($total_paid_amount)) {
            throw new \InvalidArgumentException('non-nullable total_paid_amount cannot be null');
        }
        $this->container['total_paid_amount'] = $total_paid_amount;

        return $this;
    }

    /**
     * Gets discount_amount
     *
     * @return int
     */
    public function getDiscountAmount()
    {
        return $this->container['discount_amount'];
    }

    /**
     * Sets discount_amount
     *
     * @param int $discount_amount کل تخفیف اعمال شده بر سفارش (به تومان)
     *
     * @return self
     */
    public function setDiscountAmount($discount_amount)
    {
        if (is_null($discount_amount)) {
            throw new \InvalidArgumentException('non-nullable discount_amount cannot be null');
        }
        $this->container['discount_amount'] = $discount_amount;

        return $this;
    }

    /**
     * Gets tax_amount
     *
     * @return int
     */
    public function getTaxAmount()
    {
        return $this->container['tax_amount'];
    }

    /**
     * Sets tax_amount
     *
     * @param int $tax_amount مبلغ کل مالیات برای سفارش (به تومان)
     *
     * @return self
     */
    public function setTaxAmount($tax_amount)
    {
        if (is_null($tax_amount)) {
            throw new \InvalidArgumentException('non-nullable tax_amount cannot be null');
        }
        $this->container['tax_amount'] = $tax_amount;

        return $this;
    }

    /**
     * Gets shipping_amount
     *
     * @return int
     */
    public function getShippingAmount()
    {
        return $this->container['shipping_amount'];
    }

    /**
     * Sets shipping_amount
     *
     * @param int $shipping_amount هزینه ارسال برای سفارش (به تومان)
     *
     * @return self
     */
    public function setShippingAmount($shipping_amount)
    {
        if (is_null($shipping_amount)) {
            throw new \InvalidArgumentException('non-nullable shipping_amount cannot be null');
        }
        $this->container['shipping_amount'] = $shipping_amount;

        return $this;
    }

    /**
     * Gets loyalty_amount
     *
     * @return int
     */
    public function getLoyaltyAmount()
    {
        return $this->container['loyalty_amount'];
    }

    /**
     * Sets loyalty_amount
     *
     * @param int $loyalty_amount مقدار تخفیف از برنامه باشگاه مشتریان/پاداش (به تومان)
     *
     * @return self
     */
    public function setLoyaltyAmount($loyalty_amount)
    {
        if (is_null($loyalty_amount)) {
            throw new \InvalidArgumentException('non-nullable loyalty_amount cannot be null');
        }
        $this->container['loyalty_amount'] = $loyalty_amount;

        return $this;
    }

    /**
     * Gets callback_url
     *
     * @return string
     */
    public function getCallbackUrl()
    {
        return $this->container['callback_url'];
    }

    /**
     * Sets callback_url
     *
     * @param string $callback_url آدرسی برای دریافت اطلاع رسانی وضعیت پرداخت پس از تکمیل سفارش
     *
     * @return self
     */
    public function setCallbackUrl($callback_url)
    {
        if (is_null($callback_url)) {
            throw new \InvalidArgumentException('non-nullable callback_url cannot be null');
        }
        $this->container['callback_url'] = $callback_url;

        return $this;
    }

    /**
     * Gets merchant
     *
     * @return \OpenAPI\Client\Model\Merchant
     */
    public function getMerchant()
    {
        return $this->container['merchant'];
    }

    /**
     * Sets merchant
     *
     * @param \OpenAPI\Client\Model\Merchant $merchant merchant
     *
     * @return self
     */
    public function setMerchant($merchant)
    {
        if (is_null($merchant)) {
            throw new \InvalidArgumentException('non-nullable merchant cannot be null');
        }
        $this->container['merchant'] = $merchant;

        return $this;
    }

    /**
     * Gets items
     *
     * @return \OpenAPI\Client\Model\OrderItemCreate[]
     */
    public function getItems()
    {
        return $this->container['items'];
    }

    /**
     * Sets items
     *
     * @param \OpenAPI\Client\Model\OrderItemCreate[] $items items
     *
     * @return self
     */
    public function setItems($items)
    {
        if (is_null($items)) {
            throw new \InvalidArgumentException('non-nullable items cannot be null');
        }
        $this->container['items'] = $items;

        return $this;
    }

    /**
     * Gets source_address
     *
     * @return mixed|null
     */
    public function getSourceAddress()
    {
        return $this->container['source_address'];
    }

    /**
     * Sets source_address
     *
     * @param mixed|null $source_address source_address
     *
     * @return self
     */
    public function setSourceAddress($source_address)
    {
        if (is_null($source_address)) {
            array_push($this->openAPINullablesSetToNull, 'source_address');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('source_address', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['source_address'] = $source_address;

        return $this;
    }

    /**
     * Gets destination_address
     *
     * @return mixed|null
     */
    public function getDestinationAddress()
    {
        return $this->container['destination_address'];
    }

    /**
     * Sets destination_address
     *
     * @param mixed|null $destination_address destination_address
     *
     * @return self
     */
    public function setDestinationAddress($destination_address)
    {
        if (is_null($destination_address)) {
            array_push($this->openAPINullablesSetToNull, 'destination_address');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('destination_address', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['destination_address'] = $destination_address;

        return $this;
    }

    /**
     * Gets selected_shipping_method
     *
     * @return \OpenAPI\Client\Model\ShippingMethod
     */
    public function getSelectedShippingMethod()
    {
        return $this->container['selected_shipping_method'];
    }

    /**
     * Sets selected_shipping_method
     *
     * @param \OpenAPI\Client\Model\ShippingMethod $selected_shipping_method selected_shipping_method
     *
     * @return self
     */
    public function setSelectedShippingMethod($selected_shipping_method)
    {
        if (is_null($selected_shipping_method)) {
            throw new \InvalidArgumentException('non-nullable selected_shipping_method cannot be null');
        }
        $this->container['selected_shipping_method'] = $selected_shipping_method;

        return $this;
    }

    /**
     * Gets shipping_selected_at
     *
     * @return \DateTime|null
     */
    public function getShippingSelectedAt()
    {
        return $this->container['shipping_selected_at'];
    }

    /**
     * Sets shipping_selected_at
     *
     * @param \DateTime|null $shipping_selected_at shipping_selected_at
     *
     * @return self
     */
    public function setShippingSelectedAt($shipping_selected_at)
    {
        if (is_null($shipping_selected_at)) {
            array_push($this->openAPINullablesSetToNull, 'shipping_selected_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('shipping_selected_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['shipping_selected_at'] = $shipping_selected_at;

        return $this;
    }

    /**
     * Gets address_selected_at
     *
     * @return \DateTime|null
     */
    public function getAddressSelectedAt()
    {
        return $this->container['address_selected_at'];
    }

    /**
     * Sets address_selected_at
     *
     * @param \DateTime|null $address_selected_at address_selected_at
     *
     * @return self
     */
    public function setAddressSelectedAt($address_selected_at)
    {
        if (is_null($address_selected_at)) {
            array_push($this->openAPINullablesSetToNull, 'address_selected_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('address_selected_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['address_selected_at'] = $address_selected_at;

        return $this;
    }

    /**
     * Gets packing_amount
     *
     * @return int
     */
    public function getPackingAmount()
    {
        return $this->container['packing_amount'];
    }

    /**
     * Sets packing_amount
     *
     * @param int $packing_amount هزینه روش بسته‌بندی انتخاب‌شده (به تومان)
     *
     * @return self
     */
    public function setPackingAmount($packing_amount)
    {
        if (is_null($packing_amount)) {
            throw new \InvalidArgumentException('non-nullable packing_amount cannot be null');
        }
        $this->container['packing_amount'] = $packing_amount;

        return $this;
    }

    /**
     * Gets packing_selected_at
     *
     * @return \DateTime|null
     */
    public function getPackingSelectedAt()
    {
        return $this->container['packing_selected_at'];
    }

    /**
     * Sets packing_selected_at
     *
     * @param \DateTime|null $packing_selected_at packing_selected_at
     *
     * @return self
     */
    public function setPackingSelectedAt($packing_selected_at)
    {
        if (is_null($packing_selected_at)) {
            array_push($this->openAPINullablesSetToNull, 'packing_selected_at');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('packing_selected_at', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['packing_selected_at'] = $packing_selected_at;

        return $this;
    }

    /**
     * Gets selected_packing
     *
     * @return \OpenAPI\Client\Model\Packing
     */
    public function getSelectedPacking()
    {
        return $this->container['selected_packing'];
    }

    /**
     * Sets selected_packing
     *
     * @param \OpenAPI\Client\Model\Packing $selected_packing selected_packing
     *
     * @return self
     */
    public function setSelectedPacking($selected_packing)
    {
        if (is_null($selected_packing)) {
            throw new \InvalidArgumentException('non-nullable selected_packing cannot be null');
        }
        $this->container['selected_packing'] = $selected_packing;

        return $this;
    }

    /**
     * Gets can_select_packing
     *
     * @return bool
     */
    public function getCanSelectPacking()
    {
        return $this->container['can_select_packing'];
    }

    /**
     * Sets can_select_packing
     *
     * @param bool $can_select_packing can_select_packing
     *
     * @return self
     */
    public function setCanSelectPacking($can_select_packing)
    {
        if (is_null($can_select_packing)) {
            throw new \InvalidArgumentException('non-nullable can_select_packing cannot be null');
        }
        $this->container['can_select_packing'] = $can_select_packing;

        return $this;
    }

    /**
     * Gets can_select_shipping
     *
     * @return bool
     */
    public function getCanSelectShipping()
    {
        return $this->container['can_select_shipping'];
    }

    /**
     * Sets can_select_shipping
     *
     * @param bool $can_select_shipping can_select_shipping
     *
     * @return self
     */
    public function setCanSelectShipping($can_select_shipping)
    {
        if (is_null($can_select_shipping)) {
            throw new \InvalidArgumentException('non-nullable can_select_shipping cannot be null');
        }
        $this->container['can_select_shipping'] = $can_select_shipping;

        return $this;
    }

    /**
     * Gets can_select_address
     *
     * @return bool
     */
    public function getCanSelectAddress()
    {
        return $this->container['can_select_address'];
    }

    /**
     * Sets can_select_address
     *
     * @param bool $can_select_address can_select_address
     *
     * @return self
     */
    public function setCanSelectAddress($can_select_address)
    {
        if (is_null($can_select_address)) {
            throw new \InvalidArgumentException('non-nullable can_select_address cannot be null');
        }
        $this->container['can_select_address'] = $can_select_address;

        return $this;
    }

    /**
     * Gets can_proceed_to_payment
     *
     * @return bool
     */
    public function getCanProceedToPayment()
    {
        return $this->container['can_proceed_to_payment'];
    }

    /**
     * Sets can_proceed_to_payment
     *
     * @param bool $can_proceed_to_payment can_proceed_to_payment
     *
     * @return self
     */
    public function setCanProceedToPayment($can_proceed_to_payment)
    {
        if (is_null($can_proceed_to_payment)) {
            throw new \InvalidArgumentException('non-nullable can_proceed_to_payment cannot be null');
        }
        $this->container['can_proceed_to_payment'] = $can_proceed_to_payment;

        return $this;
    }

    /**
     * Gets is_paid
     *
     * @return bool
     */
    public function getIsPaid()
    {
        return $this->container['is_paid'];
    }

    /**
     * Sets is_paid
     *
     * @param bool $is_paid is_paid
     *
     * @return self
     */
    public function setIsPaid($is_paid)
    {
        if (is_null($is_paid)) {
            throw new \InvalidArgumentException('non-nullable is_paid cannot be null');
        }
        $this->container['is_paid'] = $is_paid;

        return $this;
    }

    /**
     * Gets user
     *
     * @return \OpenAPI\Client\Model\OrderUser
     */
    public function getUser()
    {
        return $this->container['user'];
    }

    /**
     * Sets user
     *
     * @param \OpenAPI\Client\Model\OrderUser $user user
     *
     * @return self
     */
    public function setUser($user)
    {
        if (is_null($user)) {
            throw new \InvalidArgumentException('non-nullable user cannot be null');
        }
        $this->container['user'] = $user;

        return $this;
    }

    /**
     * Gets payment
     *
     * @return \OpenAPI\Client\Model\PaymentOrder
     */
    public function getPayment()
    {
        return $this->container['payment'];
    }

    /**
     * Sets payment
     *
     * @param \OpenAPI\Client\Model\PaymentOrder $payment payment
     *
     * @return self
     */
    public function setPayment($payment)
    {
        if (is_null($payment)) {
            throw new \InvalidArgumentException('non-nullable payment cannot be null');
        }
        $this->container['payment'] = $payment;

        return $this;
    }

    /**
     * Gets preparation_time
     *
     * @return int
     */
    public function getPreparationTime()
    {
        return $this->container['preparation_time'];
    }

    /**
     * Sets preparation_time
     *
     * @param int $preparation_time زمان آمادهسازی سفارش (به روز)
     *
     * @return self
     */
    public function setPreparationTime($preparation_time)
    {
        if (is_null($preparation_time)) {
            throw new \InvalidArgumentException('non-nullable preparation_time cannot be null');
        }
        $this->container['preparation_time'] = $preparation_time;

        return $this;
    }

    /**
     * Gets weight
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->container['weight'];
    }

    /**
     * Sets weight
     *
     * @param float $weight وزن کل سفارش (بر حسب گرم)
     *
     * @return self
     */
    public function setWeight($weight)
    {
        if (is_null($weight)) {
            throw new \InvalidArgumentException('non-nullable weight cannot be null');
        }
        $this->container['weight'] = $weight;

        return $this;
    }

    /**
     * Gets selected_shipping_data
     *
     * @return array<string,mixed>
     */
    public function getSelectedShippingData()
    {
        return $this->container['selected_shipping_data'];
    }

    /**
     * Sets selected_shipping_data
     *
     * @param array<string,mixed> $selected_shipping_data selected_shipping_data
     *
     * @return self
     */
    public function setSelectedShippingData($selected_shipping_data)
    {
        if (is_null($selected_shipping_data)) {
            throw new \InvalidArgumentException('non-nullable selected_shipping_data cannot be null');
        }
        $this->container['selected_shipping_data'] = $selected_shipping_data;

        return $this;
    }

    /**
     * Gets reference_code
     *
     * @return string
     */
    public function getReferenceCode()
    {
        return $this->container['reference_code'];
    }

    /**
     * Sets reference_code
     *
     * @param string $reference_code کد مرجع منحصر به فرد برای پیگیری سفارش مشتری (فرمت: BD-XXXXXXXX)
     *
     * @return self
     */
    public function setReferenceCode($reference_code)
    {
        if (is_null($reference_code)) {
            throw new \InvalidArgumentException('non-nullable reference_code cannot be null');
        }
        $this->container['reference_code'] = $reference_code;

        return $this;
    }

    /**
     * Gets promotion_discount_amount
     *
     * @return float
     */
    public function getPromotionDiscountAmount()
    {
        return $this->container['promotion_discount_amount'];
    }

    /**
     * Sets promotion_discount_amount
     *
     * @param float $promotion_discount_amount promotion_discount_amount
     *
     * @return self
     */
    public function setPromotionDiscountAmount($promotion_discount_amount)
    {
        if (is_null($promotion_discount_amount)) {
            throw new \InvalidArgumentException('non-nullable promotion_discount_amount cannot be null');
        }
        $this->container['promotion_discount_amount'] = $promotion_discount_amount;

        return $this;
    }

    /**
     * Gets promotion_data
     *
     * @return array<string,mixed>
     */
    public function getPromotionData()
    {
        return $this->container['promotion_data'];
    }

    /**
     * Sets promotion_data
     *
     * @param array<string,mixed> $promotion_data promotion_data
     *
     * @return self
     */
    public function setPromotionData($promotion_data)
    {
        if (is_null($promotion_data)) {
            throw new \InvalidArgumentException('non-nullable promotion_data cannot be null');
        }
        $this->container['promotion_data'] = $promotion_data;

        return $this;
    }

    /**
     * Gets digipay_markup_amount
     *
     * @return int
     */
    public function getDigipayMarkupAmount()
    {
        return $this->container['digipay_markup_amount'];
    }

    /**
     * Sets digipay_markup_amount
     *
     * @param int $digipay_markup_amount مبلغ نشانه‌گذاری برای سفارش (به تومان)
     *
     * @return self
     */
    public function setDigipayMarkupAmount($digipay_markup_amount)
    {
        if (is_null($digipay_markup_amount)) {
            throw new \InvalidArgumentException('non-nullable digipay_markup_amount cannot be null');
        }
        $this->container['digipay_markup_amount'] = $digipay_markup_amount;

        return $this;
    }

    /**
     * Gets markup_commission_percentage
     *
     * @return int
     */
    public function getMarkupCommissionPercentage()
    {
        return $this->container['markup_commission_percentage'];
    }

    /**
     * Sets markup_commission_percentage
     *
     * @param int $markup_commission_percentage درصد کمیسیون نشانه‌گذاری برای سفارش (به درصد)
     *
     * @return self
     */
    public function setMarkupCommissionPercentage($markup_commission_percentage)
    {
        if (is_null($markup_commission_percentage)) {
            throw new \InvalidArgumentException('non-nullable markup_commission_percentage cannot be null');
        }
        $this->container['markup_commission_percentage'] = $markup_commission_percentage;

        return $this;
    }

    /**
     * Gets previous_status
     *
     * @return \OpenAPI\Client\Model\OrderStatusEnum|null
     */
    public function getPreviousStatus()
    {
        return $this->container['previous_status'];
    }

    /**
     * Sets previous_status
     *
     * @param \OpenAPI\Client\Model\OrderStatusEnum|null $previous_status previous_status
     *
     * @return self
     */
    public function setPreviousStatus($previous_status)
    {
        if (is_null($previous_status)) {
            array_push($this->openAPINullablesSetToNull, 'previous_status');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('previous_status', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['previous_status'] = $previous_status;

        return $this;
    }

    /**
     * Gets previous_status_display
     *
     * @return string
     */
    public function getPreviousStatusDisplay()
    {
        return $this->container['previous_status_display'];
    }

    /**
     * Sets previous_status_display
     *
     * @param string $previous_status_display previous_status_display
     *
     * @return self
     */
    public function setPreviousStatusDisplay($previous_status_display)
    {
        if (is_null($previous_status_display)) {
            throw new \InvalidArgumentException('non-nullable previous_status_display cannot be null');
        }
        $this->container['previous_status_display'] = $previous_status_display;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer|string $offset Offset
     *
     * @return boolean
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer|string $offset Offset
     *
     * @return mixed|null
     */
    #[\ReturnTypeWillChange]
    public function offsetGet(mixed $offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer|string $offset Offset
     *
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


