<?php
/**
 * OrderCreate
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
 * OrderCreate Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class OrderCreate implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'OrderCreate';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'merchant_order_id' => 'string',
        'merchant_unique_id' => 'string',
        'main_amount' => 'int',
        'final_amount' => 'int',
        'total_paid_amount' => 'int',
        'discount_amount' => 'int',
        'tax_amount' => 'int',
        'shipping_amount' => 'int',
        'loyalty_amount' => 'int',
        'callback_url' => 'string',
        'destination_address' => 'mixed',
        'items' => '\OpenAPI\Client\Model\OrderItemCreate[]',
        'merchant' => 'int',
        'source_address' => 'mixed',
        'user' => 'int',
        'reservation_expired_at' => 'int',
        'reference_code' => 'string',
        'preparation_time' => 'int',
        'weight' => 'float'
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @var string[]
     * @phpstan-var array<string, string|null>
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'merchant_order_id' => null,
        'merchant_unique_id' => null,
        'main_amount' => null,
        'final_amount' => null,
        'total_paid_amount' => null,
        'discount_amount' => null,
        'tax_amount' => null,
        'shipping_amount' => null,
        'loyalty_amount' => null,
        'callback_url' => 'uri',
        'destination_address' => null,
        'items' => null,
        'merchant' => null,
        'source_address' => null,
        'user' => null,
        'reservation_expired_at' => null,
        'reference_code' => null,
        'preparation_time' => null,
        'weight' => 'double'
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'merchant_order_id' => false,
        'merchant_unique_id' => false,
        'main_amount' => false,
        'final_amount' => false,
        'total_paid_amount' => false,
        'discount_amount' => false,
        'tax_amount' => false,
        'shipping_amount' => false,
        'loyalty_amount' => false,
        'callback_url' => false,
        'destination_address' => true,
        'items' => false,
        'merchant' => false,
        'source_address' => true,
        'user' => true,
        'reservation_expired_at' => true,
        'reference_code' => false,
        'preparation_time' => false,
        'weight' => false
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
        'merchant_order_id' => 'merchant_order_id',
        'merchant_unique_id' => 'merchant_unique_id',
        'main_amount' => 'main_amount',
        'final_amount' => 'final_amount',
        'total_paid_amount' => 'total_paid_amount',
        'discount_amount' => 'discount_amount',
        'tax_amount' => 'tax_amount',
        'shipping_amount' => 'shipping_amount',
        'loyalty_amount' => 'loyalty_amount',
        'callback_url' => 'callback_url',
        'destination_address' => 'destination_address',
        'items' => 'items',
        'merchant' => 'merchant',
        'source_address' => 'source_address',
        'user' => 'user',
        'reservation_expired_at' => 'reservation_expired_at',
        'reference_code' => 'reference_code',
        'preparation_time' => 'preparation_time',
        'weight' => 'weight'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'merchant_order_id' => 'setMerchantOrderId',
        'merchant_unique_id' => 'setMerchantUniqueId',
        'main_amount' => 'setMainAmount',
        'final_amount' => 'setFinalAmount',
        'total_paid_amount' => 'setTotalPaidAmount',
        'discount_amount' => 'setDiscountAmount',
        'tax_amount' => 'setTaxAmount',
        'shipping_amount' => 'setShippingAmount',
        'loyalty_amount' => 'setLoyaltyAmount',
        'callback_url' => 'setCallbackUrl',
        'destination_address' => 'setDestinationAddress',
        'items' => 'setItems',
        'merchant' => 'setMerchant',
        'source_address' => 'setSourceAddress',
        'user' => 'setUser',
        'reservation_expired_at' => 'setReservationExpiredAt',
        'reference_code' => 'setReferenceCode',
        'preparation_time' => 'setPreparationTime',
        'weight' => 'setWeight'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'merchant_order_id' => 'getMerchantOrderId',
        'merchant_unique_id' => 'getMerchantUniqueId',
        'main_amount' => 'getMainAmount',
        'final_amount' => 'getFinalAmount',
        'total_paid_amount' => 'getTotalPaidAmount',
        'discount_amount' => 'getDiscountAmount',
        'tax_amount' => 'getTaxAmount',
        'shipping_amount' => 'getShippingAmount',
        'loyalty_amount' => 'getLoyaltyAmount',
        'callback_url' => 'getCallbackUrl',
        'destination_address' => 'getDestinationAddress',
        'items' => 'getItems',
        'merchant' => 'getMerchant',
        'source_address' => 'getSourceAddress',
        'user' => 'getUser',
        'reservation_expired_at' => 'getReservationExpiredAt',
        'reference_code' => 'getReferenceCode',
        'preparation_time' => 'getPreparationTime',
        'weight' => 'getWeight'
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
        $this->setIfExists('merchant_order_id', $data ?? [], null);
        $this->setIfExists('merchant_unique_id', $data ?? [], null);
        $this->setIfExists('main_amount', $data ?? [], null);
        $this->setIfExists('final_amount', $data ?? [], null);
        $this->setIfExists('total_paid_amount', $data ?? [], null);
        $this->setIfExists('discount_amount', $data ?? [], null);
        $this->setIfExists('tax_amount', $data ?? [], null);
        $this->setIfExists('shipping_amount', $data ?? [], null);
        $this->setIfExists('loyalty_amount', $data ?? [], null);
        $this->setIfExists('callback_url', $data ?? [], null);
        $this->setIfExists('destination_address', $data ?? [], null);
        $this->setIfExists('items', $data ?? [], null);
        $this->setIfExists('merchant', $data ?? [], null);
        $this->setIfExists('source_address', $data ?? [], null);
        $this->setIfExists('user', $data ?? [], null);
        $this->setIfExists('reservation_expired_at', $data ?? [], null);
        $this->setIfExists('reference_code', $data ?? [], null);
        $this->setIfExists('preparation_time', $data ?? [], 2);
        $this->setIfExists('weight', $data ?? [], null);
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

        if ($this->container['merchant_order_id'] === null) {
            $invalidProperties[] = "'merchant_order_id' can't be null";
        }
        if ((mb_strlen($this->container['merchant_order_id']) > 64)) {
            $invalidProperties[] = "invalid value for 'merchant_order_id', the character length must be smaller than or equal to 64.";
        }

        if ($this->container['merchant_unique_id'] === null) {
            $invalidProperties[] = "'merchant_unique_id' can't be null";
        }
        if ((mb_strlen($this->container['merchant_unique_id']) > 64)) {
            $invalidProperties[] = "invalid value for 'merchant_unique_id', the character length must be smaller than or equal to 64.";
        }

        if (!is_null($this->container['main_amount']) && ($this->container['main_amount'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'main_amount', must be smaller than or equal to 2147483647.";
        }

        if (!is_null($this->container['main_amount']) && ($this->container['main_amount'] < 0)) {
            $invalidProperties[] = "invalid value for 'main_amount', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['final_amount']) && ($this->container['final_amount'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'final_amount', must be smaller than or equal to 2147483647.";
        }

        if (!is_null($this->container['final_amount']) && ($this->container['final_amount'] < 0)) {
            $invalidProperties[] = "invalid value for 'final_amount', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['total_paid_amount']) && ($this->container['total_paid_amount'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'total_paid_amount', must be smaller than or equal to 2147483647.";
        }

        if (!is_null($this->container['total_paid_amount']) && ($this->container['total_paid_amount'] < 0)) {
            $invalidProperties[] = "invalid value for 'total_paid_amount', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['discount_amount']) && ($this->container['discount_amount'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'discount_amount', must be smaller than or equal to 2147483647.";
        }

        if (!is_null($this->container['discount_amount']) && ($this->container['discount_amount'] < 0)) {
            $invalidProperties[] = "invalid value for 'discount_amount', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['tax_amount']) && ($this->container['tax_amount'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'tax_amount', must be smaller than or equal to 2147483647.";
        }

        if (!is_null($this->container['tax_amount']) && ($this->container['tax_amount'] < 0)) {
            $invalidProperties[] = "invalid value for 'tax_amount', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['shipping_amount']) && ($this->container['shipping_amount'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'shipping_amount', must be smaller than or equal to 2147483647.";
        }

        if (!is_null($this->container['shipping_amount']) && ($this->container['shipping_amount'] < 0)) {
            $invalidProperties[] = "invalid value for 'shipping_amount', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['loyalty_amount']) && ($this->container['loyalty_amount'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'loyalty_amount', must be smaller than or equal to 2147483647.";
        }

        if (!is_null($this->container['loyalty_amount']) && ($this->container['loyalty_amount'] < 0)) {
            $invalidProperties[] = "invalid value for 'loyalty_amount', must be bigger than or equal to 0.";
        }

        if ($this->container['callback_url'] === null) {
            $invalidProperties[] = "'callback_url' can't be null";
        }
        if ((mb_strlen($this->container['callback_url']) > 256)) {
            $invalidProperties[] = "invalid value for 'callback_url', the character length must be smaller than or equal to 256.";
        }

        if ($this->container['destination_address'] === null && !$this->isNullableSetToNull('destination_address')) {
            $invalidProperties[] = "'destination_address' can't be null";
        }
        if ($this->container['items'] === null) {
            $invalidProperties[] = "'items' can't be null";
        }
        if ($this->container['user'] === null && !$this->isNullableSetToNull('user')) {
            $invalidProperties[] = "'user' can't be null";
        }
        if (!is_null($this->container['reservation_expired_at']) && ($this->container['reservation_expired_at'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'reservation_expired_at', must be smaller than or equal to 2147483647.";
        }

        if (!is_null($this->container['reservation_expired_at']) && ($this->container['reservation_expired_at'] < 0)) {
            $invalidProperties[] = "invalid value for 'reservation_expired_at', must be bigger than or equal to 0.";
        }

        if ($this->container['reference_code'] === null) {
            $invalidProperties[] = "'reference_code' can't be null";
        }
        if (!is_null($this->container['preparation_time']) && ($this->container['preparation_time'] < 0)) {
            $invalidProperties[] = "invalid value for 'preparation_time', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['weight']) && ($this->container['weight'] < 0)) {
            $invalidProperties[] = "invalid value for 'weight', must be bigger than or equal to 0.";
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
     * @param string $merchant_order_id شناسه منحصر به فرد این سفارش در سیستم فروشنده
     *
     * @return self
     */
    public function setMerchantOrderId($merchant_order_id)
    {
        if (is_null($merchant_order_id)) {
            throw new \InvalidArgumentException('non-nullable merchant_order_id cannot be null');
        }
        if ((mb_strlen($merchant_order_id) > 64)) {
            throw new \InvalidArgumentException('invalid length for $merchant_order_id when calling OrderCreate., must be smaller than or equal to 64.');
        }

        $this->container['merchant_order_id'] = $merchant_order_id;

        return $this;
    }

    /**
     * Gets merchant_unique_id
     *
     * @return string
     */
    public function getMerchantUniqueId()
    {
        return $this->container['merchant_unique_id'];
    }

    /**
     * Sets merchant_unique_id
     *
     * @param string $merchant_unique_id شناسه منحصر به فرد برای تأیید اصالت سفارش
     *
     * @return self
     */
    public function setMerchantUniqueId($merchant_unique_id)
    {
        if (is_null($merchant_unique_id)) {
            throw new \InvalidArgumentException('non-nullable merchant_unique_id cannot be null');
        }
        if ((mb_strlen($merchant_unique_id) > 64)) {
            throw new \InvalidArgumentException('invalid length for $merchant_unique_id when calling OrderCreate., must be smaller than or equal to 64.');
        }

        $this->container['merchant_unique_id'] = $merchant_unique_id;

        return $this;
    }

    /**
     * Gets main_amount
     *
     * @return int|null
     */
    public function getMainAmount()
    {
        return $this->container['main_amount'];
    }

    /**
     * Sets main_amount
     *
     * @param int|null $main_amount مجموع قیمت‌های اولیه تمام کالاها بدون تخفیف (به تومان)
     *
     * @return self
     */
    public function setMainAmount($main_amount)
    {
        if (is_null($main_amount)) {
            throw new \InvalidArgumentException('non-nullable main_amount cannot be null');
        }

        if (($main_amount > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $main_amount when calling OrderCreate., must be smaller than or equal to 2147483647.');
        }
        if (($main_amount < 0)) {
            throw new \InvalidArgumentException('invalid value for $main_amount when calling OrderCreate., must be bigger than or equal to 0.');
        }

        $this->container['main_amount'] = $main_amount;

        return $this;
    }

    /**
     * Gets final_amount
     *
     * @return int|null
     */
    public function getFinalAmount()
    {
        return $this->container['final_amount'];
    }

    /**
     * Sets final_amount
     *
     * @param int|null $final_amount مبلغ نهایی: مبلغ_اصلی - مبلغ_تخفیف + مبلغ_مالیات (به تومان)
     *
     * @return self
     */
    public function setFinalAmount($final_amount)
    {
        if (is_null($final_amount)) {
            throw new \InvalidArgumentException('non-nullable final_amount cannot be null');
        }

        if (($final_amount > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $final_amount when calling OrderCreate., must be smaller than or equal to 2147483647.');
        }
        if (($final_amount < 0)) {
            throw new \InvalidArgumentException('invalid value for $final_amount when calling OrderCreate., must be bigger than or equal to 0.');
        }

        $this->container['final_amount'] = $final_amount;

        return $this;
    }

    /**
     * Gets total_paid_amount
     *
     * @return int|null
     */
    public function getTotalPaidAmount()
    {
        return $this->container['total_paid_amount'];
    }

    /**
     * Sets total_paid_amount
     *
     * @param int|null $total_paid_amount مبلغ کل پرداخت شده توسط کاربر: مبلغ_نهایی + هزینه_ارسال (به تومان)
     *
     * @return self
     */
    public function setTotalPaidAmount($total_paid_amount)
    {
        if (is_null($total_paid_amount)) {
            throw new \InvalidArgumentException('non-nullable total_paid_amount cannot be null');
        }

        if (($total_paid_amount > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $total_paid_amount when calling OrderCreate., must be smaller than or equal to 2147483647.');
        }
        if (($total_paid_amount < 0)) {
            throw new \InvalidArgumentException('invalid value for $total_paid_amount when calling OrderCreate., must be bigger than or equal to 0.');
        }

        $this->container['total_paid_amount'] = $total_paid_amount;

        return $this;
    }

    /**
     * Gets discount_amount
     *
     * @return int|null
     */
    public function getDiscountAmount()
    {
        return $this->container['discount_amount'];
    }

    /**
     * Sets discount_amount
     *
     * @param int|null $discount_amount مبلغ کل تخفیف برای تمام سفارش (به تومان)
     *
     * @return self
     */
    public function setDiscountAmount($discount_amount)
    {
        if (is_null($discount_amount)) {
            throw new \InvalidArgumentException('non-nullable discount_amount cannot be null');
        }

        if (($discount_amount > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $discount_amount when calling OrderCreate., must be smaller than or equal to 2147483647.');
        }
        if (($discount_amount < 0)) {
            throw new \InvalidArgumentException('invalid value for $discount_amount when calling OrderCreate., must be bigger than or equal to 0.');
        }

        $this->container['discount_amount'] = $discount_amount;

        return $this;
    }

    /**
     * Gets tax_amount
     *
     * @return int|null
     */
    public function getTaxAmount()
    {
        return $this->container['tax_amount'];
    }

    /**
     * Sets tax_amount
     *
     * @param int|null $tax_amount مبلغ کل مالیات برای تمام سفارش (به تومان)
     *
     * @return self
     */
    public function setTaxAmount($tax_amount)
    {
        if (is_null($tax_amount)) {
            throw new \InvalidArgumentException('non-nullable tax_amount cannot be null');
        }

        if (($tax_amount > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $tax_amount when calling OrderCreate., must be smaller than or equal to 2147483647.');
        }
        if (($tax_amount < 0)) {
            throw new \InvalidArgumentException('invalid value for $tax_amount when calling OrderCreate., must be bigger than or equal to 0.');
        }

        $this->container['tax_amount'] = $tax_amount;

        return $this;
    }

    /**
     * Gets shipping_amount
     *
     * @return int|null
     */
    public function getShippingAmount()
    {
        return $this->container['shipping_amount'];
    }

    /**
     * Sets shipping_amount
     *
     * @param int|null $shipping_amount هزینه ارسال برای سفارش (به تومان)
     *
     * @return self
     */
    public function setShippingAmount($shipping_amount)
    {
        if (is_null($shipping_amount)) {
            throw new \InvalidArgumentException('non-nullable shipping_amount cannot be null');
        }

        if (($shipping_amount > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $shipping_amount when calling OrderCreate., must be smaller than or equal to 2147483647.');
        }
        if (($shipping_amount < 0)) {
            throw new \InvalidArgumentException('invalid value for $shipping_amount when calling OrderCreate., must be bigger than or equal to 0.');
        }

        $this->container['shipping_amount'] = $shipping_amount;

        return $this;
    }

    /**
     * Gets loyalty_amount
     *
     * @return int|null
     */
    public function getLoyaltyAmount()
    {
        return $this->container['loyalty_amount'];
    }

    /**
     * Sets loyalty_amount
     *
     * @param int|null $loyalty_amount مبلغ تخفیف باشگاه مشتریان/پاداش (به تومان)
     *
     * @return self
     */
    public function setLoyaltyAmount($loyalty_amount)
    {
        if (is_null($loyalty_amount)) {
            throw new \InvalidArgumentException('non-nullable loyalty_amount cannot be null');
        }

        if (($loyalty_amount > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $loyalty_amount when calling OrderCreate., must be smaller than or equal to 2147483647.');
        }
        if (($loyalty_amount < 0)) {
            throw new \InvalidArgumentException('invalid value for $loyalty_amount when calling OrderCreate., must be bigger than or equal to 0.');
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
     * @param string $callback_url آدرس وب‌هوک برای دریافت اطلاع رسانی وضعیت پرداخت
     *
     * @return self
     */
    public function setCallbackUrl($callback_url)
    {
        if (is_null($callback_url)) {
            throw new \InvalidArgumentException('non-nullable callback_url cannot be null');
        }
        if ((mb_strlen($callback_url) > 256)) {
            throw new \InvalidArgumentException('invalid length for $callback_url when calling OrderCreate., must be smaller than or equal to 256.');
        }

        $this->container['callback_url'] = $callback_url;

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
     * Gets merchant
     *
     * @return int|null
     */
    public function getMerchant()
    {
        return $this->container['merchant'];
    }

    /**
     * Sets merchant
     *
     * @param int|null $merchant مقدار توسط سیستم جایگذاری می شود
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
     * @param mixed|null $source_address مقدار توسط سیستم جایگذاری می شود
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
     * Gets user
     *
     * @return int|null
     */
    public function getUser()
    {
        return $this->container['user'];
    }

    /**
     * Sets user
     *
     * @param int|null $user user
     *
     * @return self
     */
    public function setUser($user)
    {
        if (is_null($user)) {
            array_push($this->openAPINullablesSetToNull, 'user');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('user', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        $this->container['user'] = $user;

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
     * @param int|null $reservation_expired_at مهلت پرداخت (به عنوان Unix timestamp) قبل از اتمام سفارش
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

        if (!is_null($reservation_expired_at) && ($reservation_expired_at > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $reservation_expired_at when calling OrderCreate., must be smaller than or equal to 2147483647.');
        }
        if (!is_null($reservation_expired_at) && ($reservation_expired_at < 0)) {
            throw new \InvalidArgumentException('invalid value for $reservation_expired_at when calling OrderCreate., must be bigger than or equal to 0.');
        }

        $this->container['reservation_expired_at'] = $reservation_expired_at;

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
     * Gets preparation_time
     *
     * @return int|null
     */
    public function getPreparationTime()
    {
        return $this->container['preparation_time'];
    }

    /**
     * Sets preparation_time
     *
     * @param int|null $preparation_time زمان آمادهسازی سفارش (به روز)
     *
     * @return self
     */
    public function setPreparationTime($preparation_time)
    {
        if (is_null($preparation_time)) {
            throw new \InvalidArgumentException('non-nullable preparation_time cannot be null');
        }

        if (($preparation_time < 0)) {
            throw new \InvalidArgumentException('invalid value for $preparation_time when calling OrderCreate., must be bigger than or equal to 0.');
        }

        $this->container['preparation_time'] = $preparation_time;

        return $this;
    }

    /**
     * Gets weight
     *
     * @return float|null
     */
    public function getWeight()
    {
        return $this->container['weight'];
    }

    /**
     * Sets weight
     *
     * @param float|null $weight وزن کل سفارش (بر حسب گرم)
     *
     * @return self
     */
    public function setWeight($weight)
    {
        if (is_null($weight)) {
            throw new \InvalidArgumentException('non-nullable weight cannot be null');
        }

        if (($weight < 0)) {
            throw new \InvalidArgumentException('invalid value for $weight when calling OrderCreate., must be bigger than or equal to 0.');
        }

        $this->container['weight'] = $weight;

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


