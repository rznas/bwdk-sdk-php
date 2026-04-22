<?php
/**
 * ShippingMethod
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
 * ShippingMethod Class Doc Comment
 *
 * @category Class
 * @description Serializer for shipping method details.
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class ShippingMethod implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'ShippingMethod';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id' => 'int',
        'name' => 'string',
        'description' => 'string',
        'shipping_type' => '\OpenAPI\Client\Model\ShippingTypeEnum',
        'get_shipping_type_display' => 'string',
        'shipping_type_display' => 'string',
        'cost' => 'int',
        'secondary_cost' => 'int',
        'minimum_time_sending' => 'int',
        'maximum_time_sending' => 'int',
        'delivery_time_display' => 'string',
        'delivery_time_range_display' => '\OpenAPI\Client\Model\DeliveryTimeRangeDisplay',
        'inventory_address' => '\OpenAPI\Client\Model\BusinessAddress',
        'is_pay_at_destination' => 'bool'
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
        'name' => null,
        'description' => null,
        'shipping_type' => null,
        'get_shipping_type_display' => null,
        'shipping_type_display' => null,
        'cost' => null,
        'secondary_cost' => null,
        'minimum_time_sending' => null,
        'maximum_time_sending' => null,
        'delivery_time_display' => null,
        'delivery_time_range_display' => null,
        'inventory_address' => null,
        'is_pay_at_destination' => null
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'id' => false,
        'name' => false,
        'description' => false,
        'shipping_type' => false,
        'get_shipping_type_display' => false,
        'shipping_type_display' => false,
        'cost' => false,
        'secondary_cost' => false,
        'minimum_time_sending' => false,
        'maximum_time_sending' => false,
        'delivery_time_display' => false,
        'delivery_time_range_display' => false,
        'inventory_address' => false,
        'is_pay_at_destination' => false
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
        'name' => 'name',
        'description' => 'description',
        'shipping_type' => 'shipping_type',
        'get_shipping_type_display' => 'get_shipping_type_display',
        'shipping_type_display' => 'shipping_type_display',
        'cost' => 'cost',
        'secondary_cost' => 'secondary_cost',
        'minimum_time_sending' => 'minimum_time_sending',
        'maximum_time_sending' => 'maximum_time_sending',
        'delivery_time_display' => 'delivery_time_display',
        'delivery_time_range_display' => 'delivery_time_range_display',
        'inventory_address' => 'inventory_address',
        'is_pay_at_destination' => 'is_pay_at_destination'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'name' => 'setName',
        'description' => 'setDescription',
        'shipping_type' => 'setShippingType',
        'get_shipping_type_display' => 'setGetShippingTypeDisplay',
        'shipping_type_display' => 'setShippingTypeDisplay',
        'cost' => 'setCost',
        'secondary_cost' => 'setSecondaryCost',
        'minimum_time_sending' => 'setMinimumTimeSending',
        'maximum_time_sending' => 'setMaximumTimeSending',
        'delivery_time_display' => 'setDeliveryTimeDisplay',
        'delivery_time_range_display' => 'setDeliveryTimeRangeDisplay',
        'inventory_address' => 'setInventoryAddress',
        'is_pay_at_destination' => 'setIsPayAtDestination'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'name' => 'getName',
        'description' => 'getDescription',
        'shipping_type' => 'getShippingType',
        'get_shipping_type_display' => 'getGetShippingTypeDisplay',
        'shipping_type_display' => 'getShippingTypeDisplay',
        'cost' => 'getCost',
        'secondary_cost' => 'getSecondaryCost',
        'minimum_time_sending' => 'getMinimumTimeSending',
        'maximum_time_sending' => 'getMaximumTimeSending',
        'delivery_time_display' => 'getDeliveryTimeDisplay',
        'delivery_time_range_display' => 'getDeliveryTimeRangeDisplay',
        'inventory_address' => 'getInventoryAddress',
        'is_pay_at_destination' => 'getIsPayAtDestination'
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
        $this->setIfExists('name', $data ?? [], null);
        $this->setIfExists('description', $data ?? [], null);
        $this->setIfExists('shipping_type', $data ?? [], null);
        $this->setIfExists('get_shipping_type_display', $data ?? [], null);
        $this->setIfExists('shipping_type_display', $data ?? [], null);
        $this->setIfExists('cost', $data ?? [], null);
        $this->setIfExists('secondary_cost', $data ?? [], null);
        $this->setIfExists('minimum_time_sending', $data ?? [], null);
        $this->setIfExists('maximum_time_sending', $data ?? [], null);
        $this->setIfExists('delivery_time_display', $data ?? [], null);
        $this->setIfExists('delivery_time_range_display', $data ?? [], null);
        $this->setIfExists('inventory_address', $data ?? [], null);
        $this->setIfExists('is_pay_at_destination', $data ?? [], null);
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
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ((mb_strlen($this->container['name']) > 64)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be smaller than or equal to 64.";
        }

        if ($this->container['get_shipping_type_display'] === null) {
            $invalidProperties[] = "'get_shipping_type_display' can't be null";
        }
        if ($this->container['shipping_type_display'] === null) {
            $invalidProperties[] = "'shipping_type_display' can't be null";
        }
        if (!is_null($this->container['cost']) && ($this->container['cost'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'cost', must be smaller than or equal to 2147483647.";
        }

        if (!is_null($this->container['cost']) && ($this->container['cost'] < 0)) {
            $invalidProperties[] = "invalid value for 'cost', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['secondary_cost']) && ($this->container['secondary_cost'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'secondary_cost', must be smaller than or equal to 2147483647.";
        }

        if (!is_null($this->container['secondary_cost']) && ($this->container['secondary_cost'] < 0)) {
            $invalidProperties[] = "invalid value for 'secondary_cost', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['minimum_time_sending']) && ($this->container['minimum_time_sending'] > 32767)) {
            $invalidProperties[] = "invalid value for 'minimum_time_sending', must be smaller than or equal to 32767.";
        }

        if (!is_null($this->container['minimum_time_sending']) && ($this->container['minimum_time_sending'] < 0)) {
            $invalidProperties[] = "invalid value for 'minimum_time_sending', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['maximum_time_sending']) && ($this->container['maximum_time_sending'] > 32767)) {
            $invalidProperties[] = "invalid value for 'maximum_time_sending', must be smaller than or equal to 32767.";
        }

        if (!is_null($this->container['maximum_time_sending']) && ($this->container['maximum_time_sending'] < 0)) {
            $invalidProperties[] = "invalid value for 'maximum_time_sending', must be bigger than or equal to 0.";
        }

        if ($this->container['delivery_time_display'] === null) {
            $invalidProperties[] = "'delivery_time_display' can't be null";
        }
        if ($this->container['delivery_time_range_display'] === null) {
            $invalidProperties[] = "'delivery_time_range_display' can't be null";
        }
        if ($this->container['inventory_address'] === null) {
            $invalidProperties[] = "'inventory_address' can't be null";
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
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name نام روش/گزینه بسته‌بندی
     *
     * @return self
     */
    public function setName($name)
    {
        if (is_null($name)) {
            throw new \InvalidArgumentException('non-nullable name cannot be null');
        }
        if ((mb_strlen($name) > 64)) {
            throw new \InvalidArgumentException('invalid length for $name when calling ShippingMethod., must be smaller than or equal to 64.');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string|null $description شناسه روش ارسال برای استفاده در سفارش
     *
     * @return self
     */
    public function setDescription($description)
    {
        if (is_null($description)) {
            throw new \InvalidArgumentException('non-nullable description cannot be null');
        }
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets shipping_type
     *
     * @return \OpenAPI\Client\Model\ShippingTypeEnum|null
     */
    public function getShippingType()
    {
        return $this->container['shipping_type'];
    }

    /**
     * Sets shipping_type
     *
     * @param \OpenAPI\Client\Model\ShippingTypeEnum|null $shipping_type شناسه وضعیت ارسال از دیجی اکسپرس  * `1` - سایر * `2` - دیجی اکسپرس
     *
     * @return self
     */
    public function setShippingType($shipping_type)
    {
        if (is_null($shipping_type)) {
            throw new \InvalidArgumentException('non-nullable shipping_type cannot be null');
        }
        $this->container['shipping_type'] = $shipping_type;

        return $this;
    }

    /**
     * Gets get_shipping_type_display
     *
     * @return string
     */
    public function getGetShippingTypeDisplay()
    {
        return $this->container['get_shipping_type_display'];
    }

    /**
     * Sets get_shipping_type_display
     *
     * @param string $get_shipping_type_display get_shipping_type_display
     *
     * @return self
     */
    public function setGetShippingTypeDisplay($get_shipping_type_display)
    {
        if (is_null($get_shipping_type_display)) {
            throw new \InvalidArgumentException('non-nullable get_shipping_type_display cannot be null');
        }
        $this->container['get_shipping_type_display'] = $get_shipping_type_display;

        return $this;
    }

    /**
     * Gets shipping_type_display
     *
     * @return string
     */
    public function getShippingTypeDisplay()
    {
        return $this->container['shipping_type_display'];
    }

    /**
     * Sets shipping_type_display
     *
     * @param string $shipping_type_display shipping_type_display
     *
     * @return self
     */
    public function setShippingTypeDisplay($shipping_type_display)
    {
        if (is_null($shipping_type_display)) {
            throw new \InvalidArgumentException('non-nullable shipping_type_display cannot be null');
        }
        $this->container['shipping_type_display'] = $shipping_type_display;

        return $this;
    }

    /**
     * Gets cost
     *
     * @return int|null
     */
    public function getCost()
    {
        return $this->container['cost'];
    }

    /**
     * Sets cost
     *
     * @param int|null $cost هزینه ارسال برای منطقه اصلی (مثلاً تهران) به تومان
     *
     * @return self
     */
    public function setCost($cost)
    {
        if (is_null($cost)) {
            throw new \InvalidArgumentException('non-nullable cost cannot be null');
        }

        if (($cost > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $cost when calling ShippingMethod., must be smaller than or equal to 2147483647.');
        }
        if (($cost < 0)) {
            throw new \InvalidArgumentException('invalid value for $cost when calling ShippingMethod., must be bigger than or equal to 0.');
        }

        $this->container['cost'] = $cost;

        return $this;
    }

    /**
     * Gets secondary_cost
     *
     * @return int|null
     */
    public function getSecondaryCost()
    {
        return $this->container['secondary_cost'];
    }

    /**
     * Sets secondary_cost
     *
     * @param int|null $secondary_cost هزینه ارسال برای مناطق دیگر به تومان
     *
     * @return self
     */
    public function setSecondaryCost($secondary_cost)
    {
        if (is_null($secondary_cost)) {
            throw new \InvalidArgumentException('non-nullable secondary_cost cannot be null');
        }

        if (($secondary_cost > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $secondary_cost when calling ShippingMethod., must be smaller than or equal to 2147483647.');
        }
        if (($secondary_cost < 0)) {
            throw new \InvalidArgumentException('invalid value for $secondary_cost when calling ShippingMethod., must be bigger than or equal to 0.');
        }

        $this->container['secondary_cost'] = $secondary_cost;

        return $this;
    }

    /**
     * Gets minimum_time_sending
     *
     * @return int|null
     */
    public function getMinimumTimeSending()
    {
        return $this->container['minimum_time_sending'];
    }

    /**
     * Sets minimum_time_sending
     *
     * @param int|null $minimum_time_sending حداقل تعداد روز از تاریخ سفارش تا تحویل
     *
     * @return self
     */
    public function setMinimumTimeSending($minimum_time_sending)
    {
        if (is_null($minimum_time_sending)) {
            throw new \InvalidArgumentException('non-nullable minimum_time_sending cannot be null');
        }

        if (($minimum_time_sending > 32767)) {
            throw new \InvalidArgumentException('invalid value for $minimum_time_sending when calling ShippingMethod., must be smaller than or equal to 32767.');
        }
        if (($minimum_time_sending < 0)) {
            throw new \InvalidArgumentException('invalid value for $minimum_time_sending when calling ShippingMethod., must be bigger than or equal to 0.');
        }

        $this->container['minimum_time_sending'] = $minimum_time_sending;

        return $this;
    }

    /**
     * Gets maximum_time_sending
     *
     * @return int|null
     */
    public function getMaximumTimeSending()
    {
        return $this->container['maximum_time_sending'];
    }

    /**
     * Sets maximum_time_sending
     *
     * @param int|null $maximum_time_sending Maximum number of days from order date to delivery
     *
     * @return self
     */
    public function setMaximumTimeSending($maximum_time_sending)
    {
        if (is_null($maximum_time_sending)) {
            throw new \InvalidArgumentException('non-nullable maximum_time_sending cannot be null');
        }

        if (($maximum_time_sending > 32767)) {
            throw new \InvalidArgumentException('invalid value for $maximum_time_sending when calling ShippingMethod., must be smaller than or equal to 32767.');
        }
        if (($maximum_time_sending < 0)) {
            throw new \InvalidArgumentException('invalid value for $maximum_time_sending when calling ShippingMethod., must be bigger than or equal to 0.');
        }

        $this->container['maximum_time_sending'] = $maximum_time_sending;

        return $this;
    }

    /**
     * Gets delivery_time_display
     *
     * @return string
     */
    public function getDeliveryTimeDisplay()
    {
        return $this->container['delivery_time_display'];
    }

    /**
     * Sets delivery_time_display
     *
     * @param string $delivery_time_display delivery_time_display
     *
     * @return self
     */
    public function setDeliveryTimeDisplay($delivery_time_display)
    {
        if (is_null($delivery_time_display)) {
            throw new \InvalidArgumentException('non-nullable delivery_time_display cannot be null');
        }
        $this->container['delivery_time_display'] = $delivery_time_display;

        return $this;
    }

    /**
     * Gets delivery_time_range_display
     *
     * @return \OpenAPI\Client\Model\DeliveryTimeRangeDisplay
     */
    public function getDeliveryTimeRangeDisplay()
    {
        return $this->container['delivery_time_range_display'];
    }

    /**
     * Sets delivery_time_range_display
     *
     * @param \OpenAPI\Client\Model\DeliveryTimeRangeDisplay $delivery_time_range_display delivery_time_range_display
     *
     * @return self
     */
    public function setDeliveryTimeRangeDisplay($delivery_time_range_display)
    {
        if (is_null($delivery_time_range_display)) {
            throw new \InvalidArgumentException('non-nullable delivery_time_range_display cannot be null');
        }
        $this->container['delivery_time_range_display'] = $delivery_time_range_display;

        return $this;
    }

    /**
     * Gets inventory_address
     *
     * @return \OpenAPI\Client\Model\BusinessAddress
     */
    public function getInventoryAddress()
    {
        return $this->container['inventory_address'];
    }

    /**
     * Sets inventory_address
     *
     * @param \OpenAPI\Client\Model\BusinessAddress $inventory_address inventory_address
     *
     * @return self
     */
    public function setInventoryAddress($inventory_address)
    {
        if (is_null($inventory_address)) {
            throw new \InvalidArgumentException('non-nullable inventory_address cannot be null');
        }
        $this->container['inventory_address'] = $inventory_address;

        return $this;
    }

    /**
     * Gets is_pay_at_destination
     *
     * @return bool|null
     */
    public function getIsPayAtDestination()
    {
        return $this->container['is_pay_at_destination'];
    }

    /**
     * Sets is_pay_at_destination
     *
     * @param bool|null $is_pay_at_destination آیا روش ارسال پرداخت در مقصد است
     *
     * @return self
     */
    public function setIsPayAtDestination($is_pay_at_destination)
    {
        if (is_null($is_pay_at_destination)) {
            throw new \InvalidArgumentException('non-nullable is_pay_at_destination cannot be null');
        }
        $this->container['is_pay_at_destination'] = $is_pay_at_destination;

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


