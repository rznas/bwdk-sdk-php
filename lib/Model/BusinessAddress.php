<?php
/**
 * BusinessAddress
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
 * <div dir=\"rtl\" style=\"text-align: right;\">  # مستندات فروشندگان در سرویس خرید با دیجی‌کالا  این پلتفرم برای فروشندگان (مرچنت‌ها) جهت یکپارچه‌سازی خدمات پرداخت و تجارت الکترونیکی با سیستم خرید با دیجی‌کالا. شامل مدیریت سفارشات، ارسال، و احراز هویت فروشندگان است.   <div dir=\"rtl\" style=\"text-align: right;\">  <!-- ## توضیح وضعیت‌های سفارش  ### ۱. INITIAL — ایجاد اولیه سفارش  **معنا:** سفارش توسط بک‌اند مرچنت ساخته شده ولی هنوز هیچ کاربری به آن اختصاص داده نشده است.  **چگونه اتفاق می‌افتد:** مرچنت با ارسال درخواست `POST /api/v1/orders/create` و ارائه اطلاعات کالاها، مبلغ و `callback_url`، یک سفارش جدید ایجاد می‌کند. BWDK یک `order_uuid` منحصربه‌فرد و لینک شروع سفارش (`order_start_url`) برمی‌گرداند.  **وابستگی‌ها:** نیازی به کاربر یا پرداخت ندارد. فقط اطلاعات کالا از سمت مرچنت کافی است.  ---  ### ۲. STARTED — آغاز جریان خرید  **معنا:** مشتری روی لینک شروع سفارش کلیک کرده و وارد محیط BWDK شده است، اما هنوز لاگین نکرده.  **چگونه اتفاق می‌افتد:** وقتی مشتری به `order_start_url` هدایت می‌شود، BWDK وضعیت سفارش را از `INITIAL` به `STARTED` تغییر می‌دهد. در این مرحله فرآیند احراز هویت (SSO) آغاز می‌شود.  **وابستگی‌ها:** مشتری باید به لینک شروع هدایت شده باشد.  ---  ### ۳. PENDING — انتظار برای تکمیل سفارش  **معنا:** مشتری با موفقیت وارد سیستم شده و سفارش به حساب او اختصاص یافته. مشتری در حال انتخاب آدرس، روش ارسال، بسته‌بندی یا تخفیف است.  **چگونه اتفاق می‌افتد:** پس از تکمیل ورود به سیستم (SSO)، BWDK سفارش را به کاربر وصل کرده و وضعیت را به `PENDING` تغییر می‌دهد.  **وابستگی‌ها:** ورود موفق کاربر به سیستم (SSO). در این مرحله مشتری می‌تواند آدرس، شیپینگ، پکینگ و تخفیف را انتخاب کند.  ---  ### ۴. WAITING_FOR_GATEWAY — انتظار برای پرداخت  **معنا:** مشتری اطلاعات سفارش را تأیید کرده و به درگاه پرداخت هدایت شده است.  **چگونه اتفاق می‌افتد:** مشتری دکمه «پرداخت» را می‌زند (`POST /api/v1/orders/submit`)، سیستم یک رکورد پرداخت ایجاد می‌کند و کاربر به درگاه Digipay هدایت می‌شود. وضعیت سفارش به `WAITING_FOR_GATEWAY` تغییر می‌کند.  **وابستگی‌ها:** انتخاب آدرس، روش ارسال و بسته‌بندی الزامی است. پرداخت باید ایجاد شده باشد.  ---  ### ۷. PAID_BY_USER — پرداخت موفق  **معنا:** تراکنش پرداخت با موفقیت انجام شده و وجه از حساب مشتری کسر شده است.  **چگونه اتفاق می‌افتد:** درگاه پرداخت نتیجه موفق را به BWDK اطلاع می‌دهد. سیستم پرداخت را تأیید و وضعیت سفارش را به `PAID_BY_USER` تغییر می‌دهد. در این لحظه مشتری به `callback_url` مرچنت هدایت می‌شود.  **وابستگی‌ها:** تأیید موفق تراکنش از سوی درگاه پرداخت (Digipay).  ---  ### ۹. VERIFIED_BY_MERCHANT — تأیید توسط مرچنت  **معنا:** مرچنت سفارش را بررسی کرده و موجودی کالا و صحت اطلاعات را تأیید نموده است. سفارش آماده ارسال است.  **چگونه اتفاق می‌افتد:** مرچنت با ارسال درخواست `POST /api/v1/orders/manager/{uuid}/verify` سفارش را تأیید می‌کند. این مرحله **اجباری** است و باید پس از پرداخت موفق انجام شود.  **وابستگی‌ها:** سفارش باید در وضعیت `PAID_BY_USER` باشد. مرچنت باید موجودی کالا را بررسی کند.  ---  ### ۲۰. SHIPPED — ارسال شد  **معنا:** سفارش از انبار خارج شده و در حال ارسال به مشتری است.  **چگونه اتفاق می‌افتد:** مرچنت پس از ارسال کالا، وضعیت سفارش را از طریق API به `SHIPPED` تغییر می‌دهد.  **وابستگی‌ها:** سفارش باید در وضعیت `VERIFIED_BY_MERCHANT` باشد.  ---  ### ۱۹. DELIVERED — تحویل داده شد  **معنا:** سفارش به دست مشتری رسیده و فرآیند خرید به پایان رسیده است.  **چگونه اتفاق می‌افتد:** مرچنت پس از تحویل موفق، وضعیت را به `DELIVERED` تغییر می‌دهد.  **وابستگی‌ها:** سفارش باید در وضعیت `SHIPPED` باشد.  ---  ### ۵. EXPIRED — منقضی شد  **معنا:** زمان رزرو سفارش به پایان رسیده و سفارش به صورت خودکار لغو شده است.  **چگونه اتفاق می‌افتد:** یک Task دوره‌ای به طور خودکار سفارش‌هایی که `reservation_expired_at` آن‌ها گذشته را پیدا کرده و وضعیتشان را به `EXPIRED` تغییر می‌دهد. این مکانیزم مانع بلوکه شدن موجودی کالا می‌شود.  **وابستگی‌ها:** سفارش باید در یکی از وضعیت‌های `INITIAL`، `STARTED`، `PENDING` یا `WAITING_FOR_GATEWAY` باشد و زمان رزرو آن گذشته باشد.  ---  ### ۱۸. EXPIRATION_TIME_EXCEEDED — زمان انقضا گذشت  **معنا:** در لحظه ثبت نهایی یا پرداخت، مشخص شد که زمان مجاز سفارش تمام شده است.  **چگونه اتفاق می‌افتد:** هنگام ارسال درخواست پرداخت (`submit_order`)، سیستم بررسی می‌کند که `expiration_time` سفارش هنوز معتبر است یا خیر. در صورت گذشتن زمان، وضعیت به `EXPIRATION_TIME_EXCEEDED` تغییر می‌کند.  **وابستگی‌ها:** سفارش در وضعیت `PENDING` یا `WAITING_FOR_GATEWAY` است و فیلد `expiration_time` سپری شده.  ---  ### ۶. CANCELLED — لغو توسط مشتری  **معنا:** مشتری در حین فرآیند خرید (قبل از پرداخت) سفارش را لغو کرده یا از صفحه خارج شده است.  **چگونه اتفاق می‌افتد:** مشتری در صفحه checkout دکمه «انصراف» را می‌زند یا پرداخت ناموفق بوده و سفارش به حالت لغو درمی‌آید.  **وابستگی‌ها:** سفارش باید در وضعیت `PENDING` یا `WAITING_FOR_GATEWAY` باشد. پرداختی انجام نشده است.  ---  ### ۸. FAILED_TO_PAY — پرداخت ناموفق  **معنا:** تراکنش پرداخت انجام نشد یا با خطا مواجه شد.  **چگونه اتفاق می‌افتد:** درگاه پرداخت نتیجه ناموفق برمی‌گرداند یا فرآیند بازگشت وجه در مرحله پرداخت با شکست مواجه می‌شود.  **وابستگی‌ها:** سفارش باید در وضعیت `WAITING_FOR_GATEWAY` بوده باشد.  ---  ### ۱۰. FAILED_TO_VERIFY_BY_MERCHANT — تأیید ناموفق توسط مرچنت  **معنا:** مرچنت سفارش را رد کرده است؛ معمولاً به دلیل ناموجود بودن کالا یا مغایرت اطلاعات.  **چگونه اتفاق می‌افتد:** مرچنت در پاسخ به درخواست verify، خطا برمی‌گرداند یا API آن وضعیت ناموفق تنظیم می‌کند. پس از این وضعیت، فرآیند استرداد وجه آغاز می‌شود.  **وابستگی‌ها:** سفارش باید در وضعیت `PAID_BY_USER` باشد.  ---  ### ۱۱. FAILED_BY_MERCHANT — خطا از سمت مرچنت  **معنا:** مرچنت پس از تأیید اولیه، اعلام می‌کند که قادر به انجام سفارش نیست (مثلاً به دلیل اتمام موجودی).  **چگونه اتفاق می‌افتد:** مرچنت وضعیت را به `FAILED_BY_MERCHANT` تغییر می‌دهد. وجه پرداختی مشتری مسترد خواهد شد.  **وابستگی‌ها:** سفارش باید در وضعیت `PAID_BY_USER` باشد.  ---  ### ۱۲. CANCELLED_BY_MERCHANT — لغو توسط مرچنت  **معنا:** مرچنت پس از پرداخت، سفارش را به هر دلیلی لغو کرده است.  **چگونه اتفاق می‌افتد:** مرچنت درخواست لغو سفارش را ارسال می‌کند. وجه پرداختی مشتری به او بازگردانده می‌شود.  **وابستگی‌ها:** سفارش باید در وضعیت `PAID_BY_USER` یا `VERIFIED_BY_MERCHANT` باشد.  ---  ### ۱۳. REQUEST_TO_REFUND — درخواست استرداد توسط مشتری  **معنا:** مشتری درخواست بازگشت وجه داده و سیستم در حال پردازش استرداد است.  **چگونه اتفاق می‌افتد:** مرچنت از طریق API درخواست استرداد را ثبت می‌کند (`POST /api/v1/orders/manager/{uuid}/refund`). سفارش وارد صف پردازش استرداد می‌شود.  **وابستگی‌ها:** سفارش باید در وضعیت `PAID_BY_USER` یا `VERIFIED_BY_MERCHANT` باشد.  ---  ### ۱۴، ۱۵، ۱۶. سایر وضعیت‌های درخواست استرداد  این وضعیت‌ها بر اساس دلیل استرداد از هم تفکیک می‌شوند:  - **۱۴ — REQUEST_TO_REFUND_TO_MERCHANT_AFTER_FAILED_TO_VERIFY:** استرداد پس از ناموفق بودن تأیید مرچنت؛ وجه به حساب مرچنت بازمی‌گردد. - **۱۵ — REQUEST_TO_REFUND_TO_CUSTOMER_AFTER_FAILED_BY_MERCHANT:** استرداد پس از خطای مرچنت؛ وجه به مشتری بازمی‌گردد. - **۱۶ — REQUEST_TO_REFUND_TO_MERCHANT_AFTER_CANCELLED_BY_MERCHANT:** استرداد پس از لغو توسط مرچنت؛ وجه به حساب مرچنت برمی‌گردد.  **چگونه اتفاق می‌افتد:** به صورت خودکار پس از رسیدن به وضعیت‌های ناموفق/لغو مربوطه توسط سیستم تنظیم می‌شود.  ---  ### ۱۷. REFUND_COMPLETED — استرداد تکمیل شد  **معنا:** وجه با موفقیت به صاحب آن (مشتری یا مرچنت بسته به نوع استرداد) بازگردانده شده است.  **چگونه اتفاق می‌افتد:** Task پردازش استرداد (`process_order_refund`) پس از تأیید موفق بازگشت وجه از سوی Digipay، وضعیت سفارش را به `REFUND_COMPLETED` تغییر می‌دهد.  **وابستگی‌ها:** یکی از وضعیت‌های درخواست استرداد (۱۳، ۱۴، ۱۵ یا ۱۶) باید فعال باشد و Digipay تراکنش استرداد را تأیید کرده باشد.  --> </div>
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
 * BusinessAddress Class Doc Comment
 *
 * @category Class
 * @description Serializer for BusinessAddress model. Used for merchant and shipping addresses.
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<string, mixed>
 */
class BusinessAddress implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'BusinessAddress';

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id' => 'int',
        'address' => 'string',
        'postal_code' => 'string',
        'city_name' => 'string',
        'state_name' => 'string',
        'district_id' => 'int',
        'district_name' => 'string',
        'longitude' => 'float',
        'latitude' => 'float',
        'building_number' => 'string',
        'unit' => 'string',
        'receiver_name' => 'string',
        'receiver_phone' => 'string',
        'is_accurate' => 'bool',
        'is_active' => 'bool',
        'created_at' => '\DateTime',
        'modified_at' => '\DateTime'
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
        'address' => null,
        'postal_code' => null,
        'city_name' => null,
        'state_name' => null,
        'district_id' => null,
        'district_name' => null,
        'longitude' => 'decimal',
        'latitude' => 'decimal',
        'building_number' => null,
        'unit' => null,
        'receiver_name' => null,
        'receiver_phone' => null,
        'is_accurate' => null,
        'is_active' => null,
        'created_at' => 'date-time',
        'modified_at' => 'date-time'
    ];

    /**
     * Array of nullable properties. Used for (de)serialization
     *
     * @var boolean[]
     */
    protected static array $openAPINullables = [
        'id' => false,
        'address' => false,
        'postal_code' => true,
        'city_name' => false,
        'state_name' => false,
        'district_id' => true,
        'district_name' => true,
        'longitude' => true,
        'latitude' => true,
        'building_number' => true,
        'unit' => true,
        'receiver_name' => true,
        'receiver_phone' => true,
        'is_accurate' => false,
        'is_active' => false,
        'created_at' => false,
        'modified_at' => false
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
        'address' => 'address',
        'postal_code' => 'postal_code',
        'city_name' => 'city_name',
        'state_name' => 'state_name',
        'district_id' => 'district_id',
        'district_name' => 'district_name',
        'longitude' => 'longitude',
        'latitude' => 'latitude',
        'building_number' => 'building_number',
        'unit' => 'unit',
        'receiver_name' => 'receiver_name',
        'receiver_phone' => 'receiver_phone',
        'is_accurate' => 'is_accurate',
        'is_active' => 'is_active',
        'created_at' => 'created_at',
        'modified_at' => 'modified_at'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'address' => 'setAddress',
        'postal_code' => 'setPostalCode',
        'city_name' => 'setCityName',
        'state_name' => 'setStateName',
        'district_id' => 'setDistrictId',
        'district_name' => 'setDistrictName',
        'longitude' => 'setLongitude',
        'latitude' => 'setLatitude',
        'building_number' => 'setBuildingNumber',
        'unit' => 'setUnit',
        'receiver_name' => 'setReceiverName',
        'receiver_phone' => 'setReceiverPhone',
        'is_accurate' => 'setIsAccurate',
        'is_active' => 'setIsActive',
        'created_at' => 'setCreatedAt',
        'modified_at' => 'setModifiedAt'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'address' => 'getAddress',
        'postal_code' => 'getPostalCode',
        'city_name' => 'getCityName',
        'state_name' => 'getStateName',
        'district_id' => 'getDistrictId',
        'district_name' => 'getDistrictName',
        'longitude' => 'getLongitude',
        'latitude' => 'getLatitude',
        'building_number' => 'getBuildingNumber',
        'unit' => 'getUnit',
        'receiver_name' => 'getReceiverName',
        'receiver_phone' => 'getReceiverPhone',
        'is_accurate' => 'getIsAccurate',
        'is_active' => 'getIsActive',
        'created_at' => 'getCreatedAt',
        'modified_at' => 'getModifiedAt'
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
        $this->setIfExists('address', $data ?? [], null);
        $this->setIfExists('postal_code', $data ?? [], null);
        $this->setIfExists('city_name', $data ?? [], null);
        $this->setIfExists('state_name', $data ?? [], null);
        $this->setIfExists('district_id', $data ?? [], null);
        $this->setIfExists('district_name', $data ?? [], null);
        $this->setIfExists('longitude', $data ?? [], null);
        $this->setIfExists('latitude', $data ?? [], null);
        $this->setIfExists('building_number', $data ?? [], null);
        $this->setIfExists('unit', $data ?? [], null);
        $this->setIfExists('receiver_name', $data ?? [], null);
        $this->setIfExists('receiver_phone', $data ?? [], null);
        $this->setIfExists('is_accurate', $data ?? [], null);
        $this->setIfExists('is_active', $data ?? [], null);
        $this->setIfExists('created_at', $data ?? [], null);
        $this->setIfExists('modified_at', $data ?? [], null);
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
        if ($this->container['address'] === null) {
            $invalidProperties[] = "'address' can't be null";
        }
        if (!is_null($this->container['postal_code']) && (mb_strlen($this->container['postal_code']) > 10)) {
            $invalidProperties[] = "invalid value for 'postal_code', the character length must be smaller than or equal to 10.";
        }

        if ($this->container['city_name'] === null) {
            $invalidProperties[] = "'city_name' can't be null";
        }
        if ((mb_strlen($this->container['city_name']) > 32)) {
            $invalidProperties[] = "invalid value for 'city_name', the character length must be smaller than or equal to 32.";
        }

        if ($this->container['state_name'] === null) {
            $invalidProperties[] = "'state_name' can't be null";
        }
        if ((mb_strlen($this->container['state_name']) > 32)) {
            $invalidProperties[] = "invalid value for 'state_name', the character length must be smaller than or equal to 32.";
        }

        if (!is_null($this->container['district_id']) && ($this->container['district_id'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'district_id', must be smaller than or equal to 2147483647.";
        }

        if (!is_null($this->container['district_id']) && ($this->container['district_id'] < 0)) {
            $invalidProperties[] = "invalid value for 'district_id', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['district_name']) && (mb_strlen($this->container['district_name']) > 32)) {
            $invalidProperties[] = "invalid value for 'district_name', the character length must be smaller than or equal to 32.";
        }

        if (!is_null($this->container['longitude']) && !preg_match("/^-?\\d{0,6}(?:\\.\\d{0,16})?$/", $this->container['longitude'])) {
            $invalidProperties[] = "invalid value for 'longitude', must be conform to the pattern /^-?\\d{0,6}(?:\\.\\d{0,16})?$/.";
        }

        if (!is_null($this->container['latitude']) && !preg_match("/^-?\\d{0,6}(?:\\.\\d{0,16})?$/", $this->container['latitude'])) {
            $invalidProperties[] = "invalid value for 'latitude', must be conform to the pattern /^-?\\d{0,6}(?:\\.\\d{0,16})?$/.";
        }

        if (!is_null($this->container['building_number']) && (mb_strlen($this->container['building_number']) > 10)) {
            $invalidProperties[] = "invalid value for 'building_number', the character length must be smaller than or equal to 10.";
        }

        if (!is_null($this->container['unit']) && (mb_strlen($this->container['unit']) > 50)) {
            $invalidProperties[] = "invalid value for 'unit', the character length must be smaller than or equal to 50.";
        }

        if (!is_null($this->container['receiver_name']) && (mb_strlen($this->container['receiver_name']) > 100)) {
            $invalidProperties[] = "invalid value for 'receiver_name', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['receiver_phone']) && (mb_strlen($this->container['receiver_phone']) > 100)) {
            $invalidProperties[] = "invalid value for 'receiver_phone', the character length must be smaller than or equal to 100.";
        }

        if ($this->container['created_at'] === null) {
            $invalidProperties[] = "'created_at' can't be null";
        }
        if ($this->container['modified_at'] === null) {
            $invalidProperties[] = "'modified_at' can't be null";
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
     * Gets address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     *
     * @param string $address address
     *
     * @return self
     */
    public function setAddress($address)
    {
        if (is_null($address)) {
            throw new \InvalidArgumentException('non-nullable address cannot be null');
        }
        $this->container['address'] = $address;

        return $this;
    }

    /**
     * Gets postal_code
     *
     * @return string|null
     */
    public function getPostalCode()
    {
        return $this->container['postal_code'];
    }

    /**
     * Sets postal_code
     *
     * @param string|null $postal_code postal_code
     *
     * @return self
     */
    public function setPostalCode($postal_code)
    {
        if (is_null($postal_code)) {
            array_push($this->openAPINullablesSetToNull, 'postal_code');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('postal_code', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($postal_code) && (mb_strlen($postal_code) > 10)) {
            throw new \InvalidArgumentException('invalid length for $postal_code when calling BusinessAddress., must be smaller than or equal to 10.');
        }

        $this->container['postal_code'] = $postal_code;

        return $this;
    }

    /**
     * Gets city_name
     *
     * @return string
     */
    public function getCityName()
    {
        return $this->container['city_name'];
    }

    /**
     * Sets city_name
     *
     * @param string $city_name city_name
     *
     * @return self
     */
    public function setCityName($city_name)
    {
        if (is_null($city_name)) {
            throw new \InvalidArgumentException('non-nullable city_name cannot be null');
        }
        if ((mb_strlen($city_name) > 32)) {
            throw new \InvalidArgumentException('invalid length for $city_name when calling BusinessAddress., must be smaller than or equal to 32.');
        }

        $this->container['city_name'] = $city_name;

        return $this;
    }

    /**
     * Gets state_name
     *
     * @return string
     */
    public function getStateName()
    {
        return $this->container['state_name'];
    }

    /**
     * Sets state_name
     *
     * @param string $state_name state_name
     *
     * @return self
     */
    public function setStateName($state_name)
    {
        if (is_null($state_name)) {
            throw new \InvalidArgumentException('non-nullable state_name cannot be null');
        }
        if ((mb_strlen($state_name) > 32)) {
            throw new \InvalidArgumentException('invalid length for $state_name when calling BusinessAddress., must be smaller than or equal to 32.');
        }

        $this->container['state_name'] = $state_name;

        return $this;
    }

    /**
     * Gets district_id
     *
     * @return int|null
     */
    public function getDistrictId()
    {
        return $this->container['district_id'];
    }

    /**
     * Sets district_id
     *
     * @param int|null $district_id district_id
     *
     * @return self
     */
    public function setDistrictId($district_id)
    {
        if (is_null($district_id)) {
            array_push($this->openAPINullablesSetToNull, 'district_id');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('district_id', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        if (!is_null($district_id) && ($district_id > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $district_id when calling BusinessAddress., must be smaller than or equal to 2147483647.');
        }
        if (!is_null($district_id) && ($district_id < 0)) {
            throw new \InvalidArgumentException('invalid value for $district_id when calling BusinessAddress., must be bigger than or equal to 0.');
        }

        $this->container['district_id'] = $district_id;

        return $this;
    }

    /**
     * Gets district_name
     *
     * @return string|null
     */
    public function getDistrictName()
    {
        return $this->container['district_name'];
    }

    /**
     * Sets district_name
     *
     * @param string|null $district_name district_name
     *
     * @return self
     */
    public function setDistrictName($district_name)
    {
        if (is_null($district_name)) {
            array_push($this->openAPINullablesSetToNull, 'district_name');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('district_name', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($district_name) && (mb_strlen($district_name) > 32)) {
            throw new \InvalidArgumentException('invalid length for $district_name when calling BusinessAddress., must be smaller than or equal to 32.');
        }

        $this->container['district_name'] = $district_name;

        return $this;
    }

    /**
     * Gets longitude
     *
     * @return float|null
     */
    public function getLongitude()
    {
        return $this->container['longitude'];
    }

    /**
     * Sets longitude
     *
     * @param float|null $longitude longitude
     *
     * @return self
     */
    public function setLongitude($longitude)
    {
        if (is_null($longitude)) {
            array_push($this->openAPINullablesSetToNull, 'longitude');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('longitude', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        if (!is_null($longitude) && (!preg_match("/^-?\\d{0,6}(?:\\.\\d{0,16})?$/", ObjectSerializer::toString($longitude)))) {
            throw new \InvalidArgumentException("invalid value for \$longitude when calling BusinessAddress., must conform to the pattern /^-?\\d{0,6}(?:\\.\\d{0,16})?$/.");
        }

        $this->container['longitude'] = $longitude;

        return $this;
    }

    /**
     * Gets latitude
     *
     * @return float|null
     */
    public function getLatitude()
    {
        return $this->container['latitude'];
    }

    /**
     * Sets latitude
     *
     * @param float|null $latitude latitude
     *
     * @return self
     */
    public function setLatitude($latitude)
    {
        if (is_null($latitude)) {
            array_push($this->openAPINullablesSetToNull, 'latitude');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('latitude', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }

        if (!is_null($latitude) && (!preg_match("/^-?\\d{0,6}(?:\\.\\d{0,16})?$/", ObjectSerializer::toString($latitude)))) {
            throw new \InvalidArgumentException("invalid value for \$latitude when calling BusinessAddress., must conform to the pattern /^-?\\d{0,6}(?:\\.\\d{0,16})?$/.");
        }

        $this->container['latitude'] = $latitude;

        return $this;
    }

    /**
     * Gets building_number
     *
     * @return string|null
     */
    public function getBuildingNumber()
    {
        return $this->container['building_number'];
    }

    /**
     * Sets building_number
     *
     * @param string|null $building_number building_number
     *
     * @return self
     */
    public function setBuildingNumber($building_number)
    {
        if (is_null($building_number)) {
            array_push($this->openAPINullablesSetToNull, 'building_number');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('building_number', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($building_number) && (mb_strlen($building_number) > 10)) {
            throw new \InvalidArgumentException('invalid length for $building_number when calling BusinessAddress., must be smaller than or equal to 10.');
        }

        $this->container['building_number'] = $building_number;

        return $this;
    }

    /**
     * Gets unit
     *
     * @return string|null
     */
    public function getUnit()
    {
        return $this->container['unit'];
    }

    /**
     * Sets unit
     *
     * @param string|null $unit unit
     *
     * @return self
     */
    public function setUnit($unit)
    {
        if (is_null($unit)) {
            array_push($this->openAPINullablesSetToNull, 'unit');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('unit', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($unit) && (mb_strlen($unit) > 50)) {
            throw new \InvalidArgumentException('invalid length for $unit when calling BusinessAddress., must be smaller than or equal to 50.');
        }

        $this->container['unit'] = $unit;

        return $this;
    }

    /**
     * Gets receiver_name
     *
     * @return string|null
     */
    public function getReceiverName()
    {
        return $this->container['receiver_name'];
    }

    /**
     * Sets receiver_name
     *
     * @param string|null $receiver_name receiver_name
     *
     * @return self
     */
    public function setReceiverName($receiver_name)
    {
        if (is_null($receiver_name)) {
            array_push($this->openAPINullablesSetToNull, 'receiver_name');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('receiver_name', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($receiver_name) && (mb_strlen($receiver_name) > 100)) {
            throw new \InvalidArgumentException('invalid length for $receiver_name when calling BusinessAddress., must be smaller than or equal to 100.');
        }

        $this->container['receiver_name'] = $receiver_name;

        return $this;
    }

    /**
     * Gets receiver_phone
     *
     * @return string|null
     */
    public function getReceiverPhone()
    {
        return $this->container['receiver_phone'];
    }

    /**
     * Sets receiver_phone
     *
     * @param string|null $receiver_phone receiver_phone
     *
     * @return self
     */
    public function setReceiverPhone($receiver_phone)
    {
        if (is_null($receiver_phone)) {
            array_push($this->openAPINullablesSetToNull, 'receiver_phone');
        } else {
            $nullablesSetToNull = $this->getOpenAPINullablesSetToNull();
            $index = array_search('receiver_phone', $nullablesSetToNull);
            if ($index !== FALSE) {
                unset($nullablesSetToNull[$index]);
                $this->setOpenAPINullablesSetToNull($nullablesSetToNull);
            }
        }
        if (!is_null($receiver_phone) && (mb_strlen($receiver_phone) > 100)) {
            throw new \InvalidArgumentException('invalid length for $receiver_phone when calling BusinessAddress., must be smaller than or equal to 100.');
        }

        $this->container['receiver_phone'] = $receiver_phone;

        return $this;
    }

    /**
     * Gets is_accurate
     *
     * @return bool|null
     */
    public function getIsAccurate()
    {
        return $this->container['is_accurate'];
    }

    /**
     * Sets is_accurate
     *
     * @param bool|null $is_accurate is_accurate
     *
     * @return self
     */
    public function setIsAccurate($is_accurate)
    {
        if (is_null($is_accurate)) {
            throw new \InvalidArgumentException('non-nullable is_accurate cannot be null');
        }
        $this->container['is_accurate'] = $is_accurate;

        return $this;
    }

    /**
     * Gets is_active
     *
     * @return bool|null
     */
    public function getIsActive()
    {
        return $this->container['is_active'];
    }

    /**
     * Sets is_active
     *
     * @param bool|null $is_active is_active
     *
     * @return self
     */
    public function setIsActive($is_active)
    {
        if (is_null($is_active)) {
            throw new \InvalidArgumentException('non-nullable is_active cannot be null');
        }
        $this->container['is_active'] = $is_active;

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
     * Gets modified_at
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->container['modified_at'];
    }

    /**
     * Sets modified_at
     *
     * @param \DateTime $modified_at modified_at
     *
     * @return self
     */
    public function setModifiedAt($modified_at)
    {
        if (is_null($modified_at)) {
            throw new \InvalidArgumentException('non-nullable modified_at cannot be null');
        }
        $this->container['modified_at'] = $modified_at;

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


