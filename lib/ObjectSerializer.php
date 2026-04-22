<?php
/**
 * ObjectSerializer
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

namespace OpenAPI\Client;

use GuzzleHttp\Psr7\Utils;
use OpenAPI\Client\Model\ModelInterface;

/**
 * ObjectSerializer Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class ObjectSerializer
{
    /** @var string */
    private static $dateTimeFormat = \DateTime::ATOM;

    /**
     * Change the date format
     *
     * @param string $format   the new date format to use
     */
    public static function setDateTimeFormat($format)
    {
        self::$dateTimeFormat = $format;
    }

    /**
     * Serialize data
     *
     * @param mixed  $data   the data to serialize
     * @param string|null $type   the OpenAPIToolsType of the data
     * @param string|null $format the format of the OpenAPITools type of the data
     *
     * @return scalar|object|array|null serialized form of $data
     */
    public static function sanitizeForSerialization($data, $type = null, $format = null)
    {
        if (is_scalar($data) || null === $data) {
            return $data;
        }

        if ($data instanceof \DateTime) {
            return ($format === 'date') ? $data->format('Y-m-d') : $data->format(self::$dateTimeFormat);
        }

        if (is_array($data)) {
            foreach ($data as $property => $value) {
                $data[$property] = self::sanitizeForSerialization($value);
            }
            return $data;
        }

        if (is_object($data)) {
            $values = [];
            if ($data instanceof ModelInterface) {
                $formats = $data::openAPIFormats();
                foreach ($data::openAPITypes() as $property => $openAPIType) {
                    $getter = $data::getters()[$property];
                    $value = $data->$getter();
                    if ($value !== null && !in_array($openAPIType, ['\DateTime', '\SplFileObject', 'array', 'bool', 'boolean', 'byte', 'float', 'int', 'integer', 'mixed', 'number', 'object', 'string', 'void'], true)) {
                        $callable = [$openAPIType, 'getAllowableEnumValues'];
                        if (is_callable($callable)) {
                            /** array $callable */
                            $allowedEnumTypes = $callable();
                            if (!in_array($value, $allowedEnumTypes, true)) {
                                $imploded = implode("', '", $allowedEnumTypes);
                                throw new \InvalidArgumentException("Invalid value for enum '$openAPIType', must be one of: '$imploded'");
                            }
                        }
                    }
                    if (($data::isNullable($property) && $data->isNullableSetToNull($property)) || $value !== null) {
                        $values[$data::attributeMap()[$property]] = self::sanitizeForSerialization($value, $openAPIType, $formats[$property]);
                    }
                }
            } else {
                foreach ($data as $property => $value) {
                    $values[$property] = self::sanitizeForSerialization($value);
                }
            }
            return (object) $values;
        } else {
            return (string)$data;
        }
    }

    /**
     * Sanitize filename by removing path.
     * e.g. ../../sun.gif becomes sun.gif
     *
     * @param string $filename filename to be sanitized
     *
     * @return string the sanitized filename
     */
    public static function sanitizeFilename($filename)
    {
        if (preg_match("/.*[\/\\\\](.*)$/", $filename, $match)) {
            return $match[1];
        } else {
            return $filename;
        }
    }

    /**
     * Shorter timestamp microseconds to 6 digits length.
     *
     * @param string $timestamp Original timestamp
     *
     * @return string the shorten timestamp
     */
    public static function sanitizeTimestamp($timestamp)
    {
        if (!is_string($timestamp)) {
            return $timestamp;
        }

        return preg_replace('/(:\d{2}.\d{6})\d*/', '$1', $timestamp);
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the path, by url-encoding.
     *
     * @param string $value a string which will be part of the path
     *
     * @return string the serialized object
     */
    public static function toPathValue($value)
    {
        return rawurlencode(self::toString($value));
    }

    /**
     * Checks if a value is empty, based on its OpenAPI type.
     *
     * @param mixed  $value
     * @param string $openApiType
     *
     * @return bool true if $value is empty
     */
    private static function isEmptyValue($value, string $openApiType): bool
    {
        // If empty() returns false, it is not empty regardless of its type.
        if (!empty($value)) {
            return false;
        }

        // Null is always empty, as we cannot send a real "null" value in a query parameter.
        if ($value === null) {
            return true;
        }

        switch ($openApiType) {
            // For numeric values, false and '' are considered empty.
            // This comparison is safe for floating point values, since the previous call to empty() will
            // filter out values that don't match 0.
            case 'int':
            case 'integer':
                return $value !== 0;

            case 'number':
            case 'float':
                return $value !== 0 && $value !== 0.0;

            // For boolean values, '' is considered empty
            case 'bool':
            case 'boolean':
                return !in_array($value, [false, 0], true);

            // For string values, '' is considered empty.
            case 'string':
                return $value === '';

            // For all the other types, any value at this point can be considered empty.
            default:
                return true;
        }
    }

    /**
     * Take query parameter properties and turn it into an array suitable for
     * native http_build_query or GuzzleHttp\Psr7\Query::build.
     *
     * @param mixed  $value       Parameter value
     * @param string $paramName   Parameter name
     * @param string $openApiType OpenAPIType eg. array or object
     * @param string $style       Parameter serialization style
     * @param bool   $explode     Parameter explode option
     * @param bool   $required    Whether query param is required or not
     *
     * @return array
     */
    public static function toQueryValue(
        $value,
        string $paramName,
        string $openApiType = 'string',
        string $style = 'form',
        bool $explode = true,
        bool $required = true
    ): array {

        // Check if we should omit this parameter from the query. This should only happen when:
        //  - Parameter is NOT required; AND
        //  - its value is set to a value that is equivalent to "empty", depending on its OpenAPI type. For
        //    example, 0 as "int" or "boolean" is NOT an empty value.
        if (self::isEmptyValue($value, $openApiType)) {
            if ($required) {
                return ["{$paramName}" => ''];
            } else {
                return [];
            }
        }

        // Handle DateTime objects in query
        if ($openApiType === "\\DateTime" && $value instanceof \DateTime) {
            return ["{$paramName}" => $value->format(self::$dateTimeFormat)];
        }

        $query = [];
        $value = (in_array($openApiType, ['object', 'array'], true)) ? (array)$value : $value;

        // since \GuzzleHttp\Psr7\Query::build fails with nested arrays
        // need to flatten array first
        $flattenArray = function ($arr, $name, &$result = []) use (&$flattenArray, $style, $explode) {
            if (!is_array($arr)) {
                return $arr;
            }

            foreach ($arr as $k => $v) {
                $prop = ($style === 'deepObject') ? "{$name}[{$k}]" : $k;

                if (is_array($v)) {
                    $flattenArray($v, $prop, $result);
                } else {
                    if ($style !== 'deepObject' && !$explode) {
                        // push key itself
                        $result[] = $prop;
                    }
                    $result[$prop] = $v;
                }
            }
            return $result;
        };

        $value = $flattenArray($value, $paramName);

        // https://github.com/OAI/OpenAPI-Specification/blob/main/versions/3.1.0.md#style-values
        if ($openApiType === 'array' && $style === 'deepObject' && $explode) {
            return $value;
        }

        if ($openApiType === 'object' && ($style === 'deepObject' || $explode)) {
            return $value;
        }

        if ('boolean' === $openApiType && is_bool($value)) {
            $value = self::convertBoolToQueryStringFormat($value);
        }

        // handle style in serializeCollection
        $query[$paramName] = ($explode) ? $value : self::serializeCollection((array)$value, $style);

        return $query;
    }

    /**
     * Convert boolean value to format for query string.
     *
     * @param bool $value Boolean value
     *
     * @return int|string Boolean value in format
     */
    public static function convertBoolToQueryStringFormat(bool $value)
    {
        if (Configuration::BOOLEAN_FORMAT_STRING == Configuration::getDefaultConfiguration()->getBooleanFormatForQueryString()) {
            return $value ? 'true' : 'false';
        }

        return (int) $value;
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the header. If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601
     *
     * @param string $value a string which will be part of the header
     *
     * @return string the header string
     */
    public static function toHeaderValue($value)
    {
        $callable = [$value, 'toHeaderValue'];
        if (is_callable($callable)) {
            return $callable();
        }

        return self::toString($value);
    }

    /**
     * Take value and turn it into a string suitable for inclusion in
     * the parameter. If it's a string, pass through unchanged
     * If it's a datetime object, format it in ISO8601
     * If it's a boolean, convert it to "true" or "false".
     *
     * @param float|int|bool|\DateTime $value the value of the parameter
     *
     * @return string the header string
     */
    public static function toString($value)
    {
        if ($value instanceof \DateTime) { // datetime in ISO8601 format
            return $value->format(self::$dateTimeFormat);
        } elseif (is_bool($value)) {
            return $value ? 'true' : 'false';
        } else {
            return (string) $value;
        }
    }

    /**
     * Serialize an array to a string.
     *
     * @param array  $collection                 collection to serialize to a string
     * @param string $style                      the format use for serialization (csv,
     * ssv, tsv, pipes, multi)
     * @param bool   $allowCollectionFormatMulti allow collection format to be a multidimensional array
     *
     * @return string
     */
    public static function serializeCollection(array $collection, $style, $allowCollectionFormatMulti = false)
    {
        if ($allowCollectionFormatMulti && ('multi' === $style)) {
            // http_build_query() almost does the job for us. We just
            // need to fix the result of multidimensional arrays.
            return preg_replace('/%5B[0-9]+%5D=/', '=', http_build_query($collection, '', '&'));
        }
        switch ($style) {
            case 'pipeDelimited':
            case 'pipes':
                return implode('|', $collection);

            case 'tsv':
                return implode("\t", $collection);

            case 'spaceDelimited':
            case 'ssv':
                return implode(' ', $collection);

            case 'simple':
            case 'csv':
                // Deliberate fall through. CSV is default format.
            default:
                return implode(',', $collection);
        }
    }

    /**
     * Deserialize a JSON string into an object
     *
     * @param mixed    $data          object or primitive to be deserialized
     * @param string   $class         class name is passed as a string
     * @param string[]|null $httpHeaders   HTTP headers
     *
     * @return object|array|null a single or an array of $class instances
     */
    public static function deserialize($data, $class, $httpHeaders = null)
    {
        if (null === $data) {
            return null;
        }

        if (strcasecmp(substr($class, -2), '[]') === 0) {
            $data = is_string($data) ? json_decode($data) : $data;

            if (!is_array($data)) {
                throw new \InvalidArgumentException("Invalid array '$class'");
            }

            $subClass = substr($class, 0, -2);
            $values = [];
            foreach ($data as $key => $value) {
                $values[] = self::deserialize($value, $subClass, null);
            }
            return $values;
        }

        if (preg_match('/^(array<|map\[)/', $class)) { // for associative array e.g. array<string,int>
            $data = is_string($data) ? json_decode($data) : $data;
            settype($data, 'array');
            $inner = substr($class, 4, -1);
            $deserialized = [];
            if (strrpos($inner, ",") !== false) {
                $subClass_array = explode(',', $inner, 2);
                $subClass = $subClass_array[1];
                foreach ($data as $key => $value) {
                    $deserialized[$key] = self::deserialize($value, $subClass, null);
                }
            }
            return $deserialized;
        }

        if ($class === 'object') {
            settype($data, 'array');
            return $data;
        } elseif ($class === 'mixed') {
            settype($data, gettype($data));
            return $data;
        }

        if ($class === '\DateTime') {
            // Some APIs return an invalid, empty string as a
            // date-time property. DateTime::__construct() will return
            // the current time for empty input which is probably not
            // what is meant. The invalid empty string is probably to
            // be interpreted as a missing field/value. Let's handle
            // this graceful.
            if (!empty($data)) {
                try {
                    return new \DateTime($data);
                } catch (\Exception $exception) {
                    // Some APIs return a date-time with too high nanosecond
                    // precision for php's DateTime to handle.
                    // With provided regexp 6 digits of microseconds saved
                    return new \DateTime(self::sanitizeTimestamp($data));
                }
            } else {
                return null;
            }
        }

        if ($class === '\SplFileObject') {
            $data = Utils::streamFor($data);

            /** @var \Psr\Http\Message\StreamInterface $data */

            // determine file name
            if (
                is_array($httpHeaders)
                && array_key_exists('Content-Disposition', $httpHeaders)
                && preg_match('/inline; filename=[\'"]?([^\'"\s]+)[\'"]?$/i', $httpHeaders['Content-Disposition'], $match)
            ) {
                $filename = Configuration::getDefaultConfiguration()->getTempFolderPath() . DIRECTORY_SEPARATOR . self::sanitizeFilename($match[1]);
            } else {
                $filename = tempnam(Configuration::getDefaultConfiguration()->getTempFolderPath(), '');
            }

            $file = fopen($filename, 'w');
            while ($chunk = $data->read(200)) {
                fwrite($file, $chunk);
            }
            fclose($file);

            return new \SplFileObject($filename, 'r');
        }

        /** @psalm-suppress ParadoxicalCondition */
        if (in_array($class, ['\DateTime', '\SplFileObject', 'array', 'bool', 'boolean', 'byte', 'float', 'int', 'integer', 'mixed', 'number', 'object', 'string', 'void'], true)) {
            settype($data, $class);
            return $data;
        }


        if (method_exists($class, 'getAllowableEnumValues')) {
            if (!in_array($data, $class::getAllowableEnumValues(), true)) {
                $imploded = implode("', '", $class::getAllowableEnumValues());
                throw new \InvalidArgumentException("Invalid value for enum '$class', must be one of: '$imploded'");
            }
            return $data;
        } else {
            $data = is_string($data) ? json_decode($data) : $data;

            if (is_array($data)) {
                $data = (object) $data;
            }

            // If a discriminator is defined and points to a valid subclass, use it.
            $discriminator = $class::DISCRIMINATOR;
            if (!empty($discriminator) && isset($data->{$discriminator}) && is_string($data->{$discriminator})) {
                $subclass = '\OpenAPI\Client\Model\\' . $data->{$discriminator};
                if (is_subclass_of($subclass, $class)) {
                    $class = $subclass;
                }
            }

            /** @var ModelInterface $instance */
            $instance = new $class();
            foreach ($instance::openAPITypes() as $property => $type) {
                $propertySetter = $instance::setters()[$property];

                if (!isset($propertySetter)) {
                    continue;
                }

                if (!isset($data->{$instance::attributeMap()[$property]})) {
                    if ($instance::isNullable($property)) {
                        $instance->$propertySetter(null);
                    }

                    continue;
                }

                if (isset($data->{$instance::attributeMap()[$property]})) {
                    $propertyValue = $data->{$instance::attributeMap()[$property]};
                    $instance->$propertySetter(self::deserialize($propertyValue, $type, null));
                }
            }
            return $instance;
        }
    }

    /**
     * Build a query string from an array of key value pairs.
     *
     * This function can use the return value of `parse()` to build a query
     * string. This function does not modify the provided keys when an array is
     * encountered (like `http_build_query()` would).
     *
     * The function is copied from https://github.com/guzzle/psr7/blob/a243f80a1ca7fe8ceed4deee17f12c1930efe662/src/Query.php#L59-L112
     * with a modification which is described in https://github.com/guzzle/psr7/pull/603
     *
     * @param array     $params              Query string parameters.
     * @param int|false $encoding            Set to false to not encode, PHP_QUERY_RFC3986
     *                                       to encode using RFC3986, or PHP_QUERY_RFC1738
     *                                       to encode using RFC1738.
     */
    public static function buildQuery(array $params, $encoding = PHP_QUERY_RFC3986): string
    {
        if (!$params) {
            return '';
        }

        if ($encoding === false) {
            $encoder = function (string $str): string {
                return $str;
            };
        } elseif ($encoding === PHP_QUERY_RFC3986) {
            $encoder = 'rawurlencode';
        } elseif ($encoding === PHP_QUERY_RFC1738) {
            $encoder = 'urlencode';
        } else {
            throw new \InvalidArgumentException('Invalid type');
        }

        $castBool = Configuration::BOOLEAN_FORMAT_INT == Configuration::getDefaultConfiguration()->getBooleanFormatForQueryString()
            ? function ($v) { return (int) $v; }
            : function ($v) { return $v ? 'true' : 'false'; };

        $qs = '';
        foreach ($params as $k => $v) {
            $k = $encoder((string) $k);
            if (!is_array($v)) {
                $qs .= $k;
                $v = is_bool($v) ? $castBool($v) : $v;
                if ($v !== null) {
                    $qs .= '='.$encoder((string) $v);
                }
                $qs .= '&';
            } else {
                foreach ($v as $vv) {
                    $qs .= $k;
                    $vv = is_bool($vv) ? $castBool($vv) : $vv;
                    if ($vv !== null) {
                        $qs .= '='.$encoder((string) $vv);
                    }
                    $qs .= '&';
                }
            }
        }

        return $qs ? substr($qs, 0, -1) : '';
    }
}
