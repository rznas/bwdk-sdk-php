<?php
/**
 * MerchantOrdersApi
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

namespace OpenAPI\Client\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\FormDataProcessor;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\ObjectSerializer;

/**
 * MerchantOrdersApi Class Doc Comment
 *
 * @category Class
 * @package  OpenAPI\Client
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class MerchantOrdersApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /** @var string[] $contentTypes **/
    public const contentTypes = [
        'orderApiV1CreateOrderCreate' => [
            'application/json',
            'application/x-www-form-urlencoded',
            'multipart/form-data',
        ],
        'orderApiV1ManagerList' => [
            'application/json',
        ],
        'orderApiV1ManagerPaidList' => [
            'application/json',
        ],
        'orderApiV1ManagerRefundCreate' => [
            'application/json',
            'application/x-www-form-urlencoded',
            'multipart/form-data',
        ],
        'orderApiV1ManagerRetrieve' => [
            'application/json',
        ],
        'orderApiV1ManagerUpdateStatusUpdate' => [
            'application/json',
            'application/x-www-form-urlencoded',
            'multipart/form-data',
        ],
        'orderApiV1ManagerVerifyCreate' => [
            'application/json',
            'application/x-www-form-urlencoded',
            'multipart/form-data',
        ],
    ];

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ?ClientInterface $client = null,
        ?Configuration $config = null,
        ?HeaderSelector $selector = null,
        int $hostIndex = 0
    ) {
        $this->client = $client ?: new Client();
        $this->config = $config ?: Configuration::getDefaultConfiguration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex = $hostIndex;
    }

    /**
     * Set the host index
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation orderApiV1CreateOrderCreate
     *
     * ساخت سفارش
     *
     * @param  \OpenAPI\Client\Model\OrderCreate $order_create order_create (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1CreateOrderCreate'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\OrderCreateResponse
     */
    public function orderApiV1CreateOrderCreate($order_create, string $contentType = self::contentTypes['orderApiV1CreateOrderCreate'][0])
    {
        list($response) = $this->orderApiV1CreateOrderCreateWithHttpInfo($order_create, $contentType);
        return $response;
    }

    /**
     * Operation orderApiV1CreateOrderCreateWithHttpInfo
     *
     * ساخت سفارش
     *
     * @param  \OpenAPI\Client\Model\OrderCreate $order_create (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1CreateOrderCreate'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\OrderCreateResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function orderApiV1CreateOrderCreateWithHttpInfo($order_create, string $contentType = self::contentTypes['orderApiV1CreateOrderCreate'][0])
    {
        $request = $this->orderApiV1CreateOrderCreateRequest($order_create, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 201:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\OrderCreateResponse',
                        $request,
                        $response,
                    );
            }

            

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\OpenAPI\Client\Model\OrderCreateResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\OrderCreateResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation orderApiV1CreateOrderCreateAsync
     *
     * ساخت سفارش
     *
     * @param  \OpenAPI\Client\Model\OrderCreate $order_create (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1CreateOrderCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderApiV1CreateOrderCreateAsync($order_create, string $contentType = self::contentTypes['orderApiV1CreateOrderCreate'][0])
    {
        return $this->orderApiV1CreateOrderCreateAsyncWithHttpInfo($order_create, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation orderApiV1CreateOrderCreateAsyncWithHttpInfo
     *
     * ساخت سفارش
     *
     * @param  \OpenAPI\Client\Model\OrderCreate $order_create (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1CreateOrderCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderApiV1CreateOrderCreateAsyncWithHttpInfo($order_create, string $contentType = self::contentTypes['orderApiV1CreateOrderCreate'][0])
    {
        $returnType = '\OpenAPI\Client\Model\OrderCreateResponse';
        $request = $this->orderApiV1CreateOrderCreateRequest($order_create, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'orderApiV1CreateOrderCreate'
     *
     * @param  \OpenAPI\Client\Model\OrderCreate $order_create (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1CreateOrderCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function orderApiV1CreateOrderCreateRequest($order_create, string $contentType = self::contentTypes['orderApiV1CreateOrderCreate'][0])
    {

        // verify the required parameter 'order_create' is set
        if ($order_create === null || (is_array($order_create) && count($order_create) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_create when calling orderApiV1CreateOrderCreate'
            );
        }


        $resourcePath = '/order/api/v1/create-order/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;





        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($order_create)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($order_create));
            } else {
                $httpBody = $order_create;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation orderApiV1ManagerList
     *
     * لیست سفارشات
     *
     * @param  string|null $cities cities (optional)
     * @param  \DateTime|null $created_at created_at (optional)
     * @param  string|null $cursor مقدار نشانگر صفحه‌بندی. (optional)
     * @param  string|null $order_ids order_ids (optional)
     * @param  string|null $ordering کدام فیلد باید هنگام مرتب‌سازی نتایج استفاده شود. (optional)
     * @param  string|null $payment_types payment_types (optional)
     * @param  string|null $provinces provinces (optional)
     * @param  string|null $reference_code reference_code (optional)
     * @param  string|null $search یک عبارت جستجو. (optional)
     * @param  string|null $shipping_types shipping_types (optional)
     * @param  int|null $status * &#x60;1&#x60; - اولیه * &#x60;2&#x60; - شروع شده * &#x60;3&#x60; - در انتظار * &#x60;4&#x60; - در انتظار درگاه * &#x60;5&#x60; - منقضی شده * &#x60;6&#x60; - لغو شده * &#x60;7&#x60; - پرداخت‌شده توسط کاربر * &#x60;8&#x60; - پرداخت موفیت آمیز نبود * &#x60;9&#x60; - تأیید شده توسط فروشگاه * &#x60;10&#x60; - تأیید توسط فروشگاه ناموفق بود * &#x60;11&#x60; - ناموفق از سوی فروشگاه * &#x60;12&#x60; - لغوشده توسط فروشگاه * &#x60;13&#x60; - درخواست بازگشت وجه به مشتری به دلیل درخواست مشتری * &#x60;14&#x60; - درخواست بازگشت وجه به فروشگاه پس از عدم تأیید توسط فروشگاه * &#x60;15&#x60; - درخواست بازگشت وجه به مشتری پس از ناموفق بودن توسط فروشگاه * &#x60;16&#x60; - بازپرداخت به فروشگاه پس از لغو توسط فروشگاه * &#x60;17&#x60; - بازپرداخت تکمیل شد * &#x60;18&#x60; - زمان انقضا گذشته است * &#x60;19&#x60; - تحویل شده * &#x60;20&#x60; - جمع اوری شده و در حال ارسال (optional)
     * @param  string|null $statuses statuses (optional)
     * @param  bool|null $today_pickup today_pickup (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerList'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\PaginatedOrderDetailList
     */
    public function orderApiV1ManagerList($cities = null, $created_at = null, $cursor = null, $order_ids = null, $ordering = null, $payment_types = null, $provinces = null, $reference_code = null, $search = null, $shipping_types = null, $status = null, $statuses = null, $today_pickup = null, string $contentType = self::contentTypes['orderApiV1ManagerList'][0])
    {
        list($response) = $this->orderApiV1ManagerListWithHttpInfo($cities, $created_at, $cursor, $order_ids, $ordering, $payment_types, $provinces, $reference_code, $search, $shipping_types, $status, $statuses, $today_pickup, $contentType);
        return $response;
    }

    /**
     * Operation orderApiV1ManagerListWithHttpInfo
     *
     * لیست سفارشات
     *
     * @param  string|null $cities (optional)
     * @param  \DateTime|null $created_at (optional)
     * @param  string|null $cursor مقدار نشانگر صفحه‌بندی. (optional)
     * @param  string|null $order_ids (optional)
     * @param  string|null $ordering کدام فیلد باید هنگام مرتب‌سازی نتایج استفاده شود. (optional)
     * @param  string|null $payment_types (optional)
     * @param  string|null $provinces (optional)
     * @param  string|null $reference_code (optional)
     * @param  string|null $search یک عبارت جستجو. (optional)
     * @param  string|null $shipping_types (optional)
     * @param  int|null $status * &#x60;1&#x60; - اولیه * &#x60;2&#x60; - شروع شده * &#x60;3&#x60; - در انتظار * &#x60;4&#x60; - در انتظار درگاه * &#x60;5&#x60; - منقضی شده * &#x60;6&#x60; - لغو شده * &#x60;7&#x60; - پرداخت‌شده توسط کاربر * &#x60;8&#x60; - پرداخت موفیت آمیز نبود * &#x60;9&#x60; - تأیید شده توسط فروشگاه * &#x60;10&#x60; - تأیید توسط فروشگاه ناموفق بود * &#x60;11&#x60; - ناموفق از سوی فروشگاه * &#x60;12&#x60; - لغوشده توسط فروشگاه * &#x60;13&#x60; - درخواست بازگشت وجه به مشتری به دلیل درخواست مشتری * &#x60;14&#x60; - درخواست بازگشت وجه به فروشگاه پس از عدم تأیید توسط فروشگاه * &#x60;15&#x60; - درخواست بازگشت وجه به مشتری پس از ناموفق بودن توسط فروشگاه * &#x60;16&#x60; - بازپرداخت به فروشگاه پس از لغو توسط فروشگاه * &#x60;17&#x60; - بازپرداخت تکمیل شد * &#x60;18&#x60; - زمان انقضا گذشته است * &#x60;19&#x60; - تحویل شده * &#x60;20&#x60; - جمع اوری شده و در حال ارسال (optional)
     * @param  string|null $statuses (optional)
     * @param  bool|null $today_pickup (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerList'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\PaginatedOrderDetailList, HTTP status code, HTTP response headers (array of strings)
     */
    public function orderApiV1ManagerListWithHttpInfo($cities = null, $created_at = null, $cursor = null, $order_ids = null, $ordering = null, $payment_types = null, $provinces = null, $reference_code = null, $search = null, $shipping_types = null, $status = null, $statuses = null, $today_pickup = null, string $contentType = self::contentTypes['orderApiV1ManagerList'][0])
    {
        $request = $this->orderApiV1ManagerListRequest($cities, $created_at, $cursor, $order_ids, $ordering, $payment_types, $provinces, $reference_code, $search, $shipping_types, $status, $statuses, $today_pickup, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\PaginatedOrderDetailList',
                        $request,
                        $response,
                    );
            }

            

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\OpenAPI\Client\Model\PaginatedOrderDetailList',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\PaginatedOrderDetailList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation orderApiV1ManagerListAsync
     *
     * لیست سفارشات
     *
     * @param  string|null $cities (optional)
     * @param  \DateTime|null $created_at (optional)
     * @param  string|null $cursor مقدار نشانگر صفحه‌بندی. (optional)
     * @param  string|null $order_ids (optional)
     * @param  string|null $ordering کدام فیلد باید هنگام مرتب‌سازی نتایج استفاده شود. (optional)
     * @param  string|null $payment_types (optional)
     * @param  string|null $provinces (optional)
     * @param  string|null $reference_code (optional)
     * @param  string|null $search یک عبارت جستجو. (optional)
     * @param  string|null $shipping_types (optional)
     * @param  int|null $status * &#x60;1&#x60; - اولیه * &#x60;2&#x60; - شروع شده * &#x60;3&#x60; - در انتظار * &#x60;4&#x60; - در انتظار درگاه * &#x60;5&#x60; - منقضی شده * &#x60;6&#x60; - لغو شده * &#x60;7&#x60; - پرداخت‌شده توسط کاربر * &#x60;8&#x60; - پرداخت موفیت آمیز نبود * &#x60;9&#x60; - تأیید شده توسط فروشگاه * &#x60;10&#x60; - تأیید توسط فروشگاه ناموفق بود * &#x60;11&#x60; - ناموفق از سوی فروشگاه * &#x60;12&#x60; - لغوشده توسط فروشگاه * &#x60;13&#x60; - درخواست بازگشت وجه به مشتری به دلیل درخواست مشتری * &#x60;14&#x60; - درخواست بازگشت وجه به فروشگاه پس از عدم تأیید توسط فروشگاه * &#x60;15&#x60; - درخواست بازگشت وجه به مشتری پس از ناموفق بودن توسط فروشگاه * &#x60;16&#x60; - بازپرداخت به فروشگاه پس از لغو توسط فروشگاه * &#x60;17&#x60; - بازپرداخت تکمیل شد * &#x60;18&#x60; - زمان انقضا گذشته است * &#x60;19&#x60; - تحویل شده * &#x60;20&#x60; - جمع اوری شده و در حال ارسال (optional)
     * @param  string|null $statuses (optional)
     * @param  bool|null $today_pickup (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderApiV1ManagerListAsync($cities = null, $created_at = null, $cursor = null, $order_ids = null, $ordering = null, $payment_types = null, $provinces = null, $reference_code = null, $search = null, $shipping_types = null, $status = null, $statuses = null, $today_pickup = null, string $contentType = self::contentTypes['orderApiV1ManagerList'][0])
    {
        return $this->orderApiV1ManagerListAsyncWithHttpInfo($cities, $created_at, $cursor, $order_ids, $ordering, $payment_types, $provinces, $reference_code, $search, $shipping_types, $status, $statuses, $today_pickup, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation orderApiV1ManagerListAsyncWithHttpInfo
     *
     * لیست سفارشات
     *
     * @param  string|null $cities (optional)
     * @param  \DateTime|null $created_at (optional)
     * @param  string|null $cursor مقدار نشانگر صفحه‌بندی. (optional)
     * @param  string|null $order_ids (optional)
     * @param  string|null $ordering کدام فیلد باید هنگام مرتب‌سازی نتایج استفاده شود. (optional)
     * @param  string|null $payment_types (optional)
     * @param  string|null $provinces (optional)
     * @param  string|null $reference_code (optional)
     * @param  string|null $search یک عبارت جستجو. (optional)
     * @param  string|null $shipping_types (optional)
     * @param  int|null $status * &#x60;1&#x60; - اولیه * &#x60;2&#x60; - شروع شده * &#x60;3&#x60; - در انتظار * &#x60;4&#x60; - در انتظار درگاه * &#x60;5&#x60; - منقضی شده * &#x60;6&#x60; - لغو شده * &#x60;7&#x60; - پرداخت‌شده توسط کاربر * &#x60;8&#x60; - پرداخت موفیت آمیز نبود * &#x60;9&#x60; - تأیید شده توسط فروشگاه * &#x60;10&#x60; - تأیید توسط فروشگاه ناموفق بود * &#x60;11&#x60; - ناموفق از سوی فروشگاه * &#x60;12&#x60; - لغوشده توسط فروشگاه * &#x60;13&#x60; - درخواست بازگشت وجه به مشتری به دلیل درخواست مشتری * &#x60;14&#x60; - درخواست بازگشت وجه به فروشگاه پس از عدم تأیید توسط فروشگاه * &#x60;15&#x60; - درخواست بازگشت وجه به مشتری پس از ناموفق بودن توسط فروشگاه * &#x60;16&#x60; - بازپرداخت به فروشگاه پس از لغو توسط فروشگاه * &#x60;17&#x60; - بازپرداخت تکمیل شد * &#x60;18&#x60; - زمان انقضا گذشته است * &#x60;19&#x60; - تحویل شده * &#x60;20&#x60; - جمع اوری شده و در حال ارسال (optional)
     * @param  string|null $statuses (optional)
     * @param  bool|null $today_pickup (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderApiV1ManagerListAsyncWithHttpInfo($cities = null, $created_at = null, $cursor = null, $order_ids = null, $ordering = null, $payment_types = null, $provinces = null, $reference_code = null, $search = null, $shipping_types = null, $status = null, $statuses = null, $today_pickup = null, string $contentType = self::contentTypes['orderApiV1ManagerList'][0])
    {
        $returnType = '\OpenAPI\Client\Model\PaginatedOrderDetailList';
        $request = $this->orderApiV1ManagerListRequest($cities, $created_at, $cursor, $order_ids, $ordering, $payment_types, $provinces, $reference_code, $search, $shipping_types, $status, $statuses, $today_pickup, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'orderApiV1ManagerList'
     *
     * @param  string|null $cities (optional)
     * @param  \DateTime|null $created_at (optional)
     * @param  string|null $cursor مقدار نشانگر صفحه‌بندی. (optional)
     * @param  string|null $order_ids (optional)
     * @param  string|null $ordering کدام فیلد باید هنگام مرتب‌سازی نتایج استفاده شود. (optional)
     * @param  string|null $payment_types (optional)
     * @param  string|null $provinces (optional)
     * @param  string|null $reference_code (optional)
     * @param  string|null $search یک عبارت جستجو. (optional)
     * @param  string|null $shipping_types (optional)
     * @param  int|null $status * &#x60;1&#x60; - اولیه * &#x60;2&#x60; - شروع شده * &#x60;3&#x60; - در انتظار * &#x60;4&#x60; - در انتظار درگاه * &#x60;5&#x60; - منقضی شده * &#x60;6&#x60; - لغو شده * &#x60;7&#x60; - پرداخت‌شده توسط کاربر * &#x60;8&#x60; - پرداخت موفیت آمیز نبود * &#x60;9&#x60; - تأیید شده توسط فروشگاه * &#x60;10&#x60; - تأیید توسط فروشگاه ناموفق بود * &#x60;11&#x60; - ناموفق از سوی فروشگاه * &#x60;12&#x60; - لغوشده توسط فروشگاه * &#x60;13&#x60; - درخواست بازگشت وجه به مشتری به دلیل درخواست مشتری * &#x60;14&#x60; - درخواست بازگشت وجه به فروشگاه پس از عدم تأیید توسط فروشگاه * &#x60;15&#x60; - درخواست بازگشت وجه به مشتری پس از ناموفق بودن توسط فروشگاه * &#x60;16&#x60; - بازپرداخت به فروشگاه پس از لغو توسط فروشگاه * &#x60;17&#x60; - بازپرداخت تکمیل شد * &#x60;18&#x60; - زمان انقضا گذشته است * &#x60;19&#x60; - تحویل شده * &#x60;20&#x60; - جمع اوری شده و در حال ارسال (optional)
     * @param  string|null $statuses (optional)
     * @param  bool|null $today_pickup (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function orderApiV1ManagerListRequest($cities = null, $created_at = null, $cursor = null, $order_ids = null, $ordering = null, $payment_types = null, $provinces = null, $reference_code = null, $search = null, $shipping_types = null, $status = null, $statuses = null, $today_pickup = null, string $contentType = self::contentTypes['orderApiV1ManagerList'][0])
    {















        $resourcePath = '/order/api/v1/manager/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $cities,
            'cities', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $created_at,
            'created_at', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $cursor,
            'cursor', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $order_ids,
            'order_ids', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $ordering,
            'ordering', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $payment_types,
            'payment_types', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $provinces,
            'provinces', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $reference_code,
            'reference_code', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $search,
            'search', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $shipping_types,
            'shipping_types', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $status,
            'status', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $statuses,
            'statuses', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $today_pickup,
            'today_pickup', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);




        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation orderApiV1ManagerPaidList
     *
     * سفارش پرداخت‌شده و تایید‌نشده
     *
     * @param  string|null $cities cities (optional)
     * @param  \DateTime|null $created_at created_at (optional)
     * @param  string|null $cursor مقدار نشانگر صفحه‌بندی. (optional)
     * @param  string|null $order_ids order_ids (optional)
     * @param  string|null $ordering کدام فیلد باید هنگام مرتب‌سازی نتایج استفاده شود. (optional)
     * @param  string|null $payment_types payment_types (optional)
     * @param  string|null $provinces provinces (optional)
     * @param  string|null $reference_code reference_code (optional)
     * @param  string|null $search یک عبارت جستجو. (optional)
     * @param  string|null $shipping_types shipping_types (optional)
     * @param  int|null $status * &#x60;1&#x60; - اولیه * &#x60;2&#x60; - شروع شده * &#x60;3&#x60; - در انتظار * &#x60;4&#x60; - در انتظار درگاه * &#x60;5&#x60; - منقضی شده * &#x60;6&#x60; - لغو شده * &#x60;7&#x60; - پرداخت‌شده توسط کاربر * &#x60;8&#x60; - پرداخت موفیت آمیز نبود * &#x60;9&#x60; - تأیید شده توسط فروشگاه * &#x60;10&#x60; - تأیید توسط فروشگاه ناموفق بود * &#x60;11&#x60; - ناموفق از سوی فروشگاه * &#x60;12&#x60; - لغوشده توسط فروشگاه * &#x60;13&#x60; - درخواست بازگشت وجه به مشتری به دلیل درخواست مشتری * &#x60;14&#x60; - درخواست بازگشت وجه به فروشگاه پس از عدم تأیید توسط فروشگاه * &#x60;15&#x60; - درخواست بازگشت وجه به مشتری پس از ناموفق بودن توسط فروشگاه * &#x60;16&#x60; - بازپرداخت به فروشگاه پس از لغو توسط فروشگاه * &#x60;17&#x60; - بازپرداخت تکمیل شد * &#x60;18&#x60; - زمان انقضا گذشته است * &#x60;19&#x60; - تحویل شده * &#x60;20&#x60; - جمع اوری شده و در حال ارسال (optional)
     * @param  string|null $statuses statuses (optional)
     * @param  bool|null $today_pickup today_pickup (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerPaidList'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\PaginatedMerchantPaidOrderListList
     */
    public function orderApiV1ManagerPaidList($cities = null, $created_at = null, $cursor = null, $order_ids = null, $ordering = null, $payment_types = null, $provinces = null, $reference_code = null, $search = null, $shipping_types = null, $status = null, $statuses = null, $today_pickup = null, string $contentType = self::contentTypes['orderApiV1ManagerPaidList'][0])
    {
        list($response) = $this->orderApiV1ManagerPaidListWithHttpInfo($cities, $created_at, $cursor, $order_ids, $ordering, $payment_types, $provinces, $reference_code, $search, $shipping_types, $status, $statuses, $today_pickup, $contentType);
        return $response;
    }

    /**
     * Operation orderApiV1ManagerPaidListWithHttpInfo
     *
     * سفارش پرداخت‌شده و تایید‌نشده
     *
     * @param  string|null $cities (optional)
     * @param  \DateTime|null $created_at (optional)
     * @param  string|null $cursor مقدار نشانگر صفحه‌بندی. (optional)
     * @param  string|null $order_ids (optional)
     * @param  string|null $ordering کدام فیلد باید هنگام مرتب‌سازی نتایج استفاده شود. (optional)
     * @param  string|null $payment_types (optional)
     * @param  string|null $provinces (optional)
     * @param  string|null $reference_code (optional)
     * @param  string|null $search یک عبارت جستجو. (optional)
     * @param  string|null $shipping_types (optional)
     * @param  int|null $status * &#x60;1&#x60; - اولیه * &#x60;2&#x60; - شروع شده * &#x60;3&#x60; - در انتظار * &#x60;4&#x60; - در انتظار درگاه * &#x60;5&#x60; - منقضی شده * &#x60;6&#x60; - لغو شده * &#x60;7&#x60; - پرداخت‌شده توسط کاربر * &#x60;8&#x60; - پرداخت موفیت آمیز نبود * &#x60;9&#x60; - تأیید شده توسط فروشگاه * &#x60;10&#x60; - تأیید توسط فروشگاه ناموفق بود * &#x60;11&#x60; - ناموفق از سوی فروشگاه * &#x60;12&#x60; - لغوشده توسط فروشگاه * &#x60;13&#x60; - درخواست بازگشت وجه به مشتری به دلیل درخواست مشتری * &#x60;14&#x60; - درخواست بازگشت وجه به فروشگاه پس از عدم تأیید توسط فروشگاه * &#x60;15&#x60; - درخواست بازگشت وجه به مشتری پس از ناموفق بودن توسط فروشگاه * &#x60;16&#x60; - بازپرداخت به فروشگاه پس از لغو توسط فروشگاه * &#x60;17&#x60; - بازپرداخت تکمیل شد * &#x60;18&#x60; - زمان انقضا گذشته است * &#x60;19&#x60; - تحویل شده * &#x60;20&#x60; - جمع اوری شده و در حال ارسال (optional)
     * @param  string|null $statuses (optional)
     * @param  bool|null $today_pickup (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerPaidList'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\PaginatedMerchantPaidOrderListList, HTTP status code, HTTP response headers (array of strings)
     */
    public function orderApiV1ManagerPaidListWithHttpInfo($cities = null, $created_at = null, $cursor = null, $order_ids = null, $ordering = null, $payment_types = null, $provinces = null, $reference_code = null, $search = null, $shipping_types = null, $status = null, $statuses = null, $today_pickup = null, string $contentType = self::contentTypes['orderApiV1ManagerPaidList'][0])
    {
        $request = $this->orderApiV1ManagerPaidListRequest($cities, $created_at, $cursor, $order_ids, $ordering, $payment_types, $provinces, $reference_code, $search, $shipping_types, $status, $statuses, $today_pickup, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\PaginatedMerchantPaidOrderListList',
                        $request,
                        $response,
                    );
            }

            

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\OpenAPI\Client\Model\PaginatedMerchantPaidOrderListList',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\PaginatedMerchantPaidOrderListList',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation orderApiV1ManagerPaidListAsync
     *
     * سفارش پرداخت‌شده و تایید‌نشده
     *
     * @param  string|null $cities (optional)
     * @param  \DateTime|null $created_at (optional)
     * @param  string|null $cursor مقدار نشانگر صفحه‌بندی. (optional)
     * @param  string|null $order_ids (optional)
     * @param  string|null $ordering کدام فیلد باید هنگام مرتب‌سازی نتایج استفاده شود. (optional)
     * @param  string|null $payment_types (optional)
     * @param  string|null $provinces (optional)
     * @param  string|null $reference_code (optional)
     * @param  string|null $search یک عبارت جستجو. (optional)
     * @param  string|null $shipping_types (optional)
     * @param  int|null $status * &#x60;1&#x60; - اولیه * &#x60;2&#x60; - شروع شده * &#x60;3&#x60; - در انتظار * &#x60;4&#x60; - در انتظار درگاه * &#x60;5&#x60; - منقضی شده * &#x60;6&#x60; - لغو شده * &#x60;7&#x60; - پرداخت‌شده توسط کاربر * &#x60;8&#x60; - پرداخت موفیت آمیز نبود * &#x60;9&#x60; - تأیید شده توسط فروشگاه * &#x60;10&#x60; - تأیید توسط فروشگاه ناموفق بود * &#x60;11&#x60; - ناموفق از سوی فروشگاه * &#x60;12&#x60; - لغوشده توسط فروشگاه * &#x60;13&#x60; - درخواست بازگشت وجه به مشتری به دلیل درخواست مشتری * &#x60;14&#x60; - درخواست بازگشت وجه به فروشگاه پس از عدم تأیید توسط فروشگاه * &#x60;15&#x60; - درخواست بازگشت وجه به مشتری پس از ناموفق بودن توسط فروشگاه * &#x60;16&#x60; - بازپرداخت به فروشگاه پس از لغو توسط فروشگاه * &#x60;17&#x60; - بازپرداخت تکمیل شد * &#x60;18&#x60; - زمان انقضا گذشته است * &#x60;19&#x60; - تحویل شده * &#x60;20&#x60; - جمع اوری شده و در حال ارسال (optional)
     * @param  string|null $statuses (optional)
     * @param  bool|null $today_pickup (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerPaidList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderApiV1ManagerPaidListAsync($cities = null, $created_at = null, $cursor = null, $order_ids = null, $ordering = null, $payment_types = null, $provinces = null, $reference_code = null, $search = null, $shipping_types = null, $status = null, $statuses = null, $today_pickup = null, string $contentType = self::contentTypes['orderApiV1ManagerPaidList'][0])
    {
        return $this->orderApiV1ManagerPaidListAsyncWithHttpInfo($cities, $created_at, $cursor, $order_ids, $ordering, $payment_types, $provinces, $reference_code, $search, $shipping_types, $status, $statuses, $today_pickup, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation orderApiV1ManagerPaidListAsyncWithHttpInfo
     *
     * سفارش پرداخت‌شده و تایید‌نشده
     *
     * @param  string|null $cities (optional)
     * @param  \DateTime|null $created_at (optional)
     * @param  string|null $cursor مقدار نشانگر صفحه‌بندی. (optional)
     * @param  string|null $order_ids (optional)
     * @param  string|null $ordering کدام فیلد باید هنگام مرتب‌سازی نتایج استفاده شود. (optional)
     * @param  string|null $payment_types (optional)
     * @param  string|null $provinces (optional)
     * @param  string|null $reference_code (optional)
     * @param  string|null $search یک عبارت جستجو. (optional)
     * @param  string|null $shipping_types (optional)
     * @param  int|null $status * &#x60;1&#x60; - اولیه * &#x60;2&#x60; - شروع شده * &#x60;3&#x60; - در انتظار * &#x60;4&#x60; - در انتظار درگاه * &#x60;5&#x60; - منقضی شده * &#x60;6&#x60; - لغو شده * &#x60;7&#x60; - پرداخت‌شده توسط کاربر * &#x60;8&#x60; - پرداخت موفیت آمیز نبود * &#x60;9&#x60; - تأیید شده توسط فروشگاه * &#x60;10&#x60; - تأیید توسط فروشگاه ناموفق بود * &#x60;11&#x60; - ناموفق از سوی فروشگاه * &#x60;12&#x60; - لغوشده توسط فروشگاه * &#x60;13&#x60; - درخواست بازگشت وجه به مشتری به دلیل درخواست مشتری * &#x60;14&#x60; - درخواست بازگشت وجه به فروشگاه پس از عدم تأیید توسط فروشگاه * &#x60;15&#x60; - درخواست بازگشت وجه به مشتری پس از ناموفق بودن توسط فروشگاه * &#x60;16&#x60; - بازپرداخت به فروشگاه پس از لغو توسط فروشگاه * &#x60;17&#x60; - بازپرداخت تکمیل شد * &#x60;18&#x60; - زمان انقضا گذشته است * &#x60;19&#x60; - تحویل شده * &#x60;20&#x60; - جمع اوری شده و در حال ارسال (optional)
     * @param  string|null $statuses (optional)
     * @param  bool|null $today_pickup (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerPaidList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderApiV1ManagerPaidListAsyncWithHttpInfo($cities = null, $created_at = null, $cursor = null, $order_ids = null, $ordering = null, $payment_types = null, $provinces = null, $reference_code = null, $search = null, $shipping_types = null, $status = null, $statuses = null, $today_pickup = null, string $contentType = self::contentTypes['orderApiV1ManagerPaidList'][0])
    {
        $returnType = '\OpenAPI\Client\Model\PaginatedMerchantPaidOrderListList';
        $request = $this->orderApiV1ManagerPaidListRequest($cities, $created_at, $cursor, $order_ids, $ordering, $payment_types, $provinces, $reference_code, $search, $shipping_types, $status, $statuses, $today_pickup, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'orderApiV1ManagerPaidList'
     *
     * @param  string|null $cities (optional)
     * @param  \DateTime|null $created_at (optional)
     * @param  string|null $cursor مقدار نشانگر صفحه‌بندی. (optional)
     * @param  string|null $order_ids (optional)
     * @param  string|null $ordering کدام فیلد باید هنگام مرتب‌سازی نتایج استفاده شود. (optional)
     * @param  string|null $payment_types (optional)
     * @param  string|null $provinces (optional)
     * @param  string|null $reference_code (optional)
     * @param  string|null $search یک عبارت جستجو. (optional)
     * @param  string|null $shipping_types (optional)
     * @param  int|null $status * &#x60;1&#x60; - اولیه * &#x60;2&#x60; - شروع شده * &#x60;3&#x60; - در انتظار * &#x60;4&#x60; - در انتظار درگاه * &#x60;5&#x60; - منقضی شده * &#x60;6&#x60; - لغو شده * &#x60;7&#x60; - پرداخت‌شده توسط کاربر * &#x60;8&#x60; - پرداخت موفیت آمیز نبود * &#x60;9&#x60; - تأیید شده توسط فروشگاه * &#x60;10&#x60; - تأیید توسط فروشگاه ناموفق بود * &#x60;11&#x60; - ناموفق از سوی فروشگاه * &#x60;12&#x60; - لغوشده توسط فروشگاه * &#x60;13&#x60; - درخواست بازگشت وجه به مشتری به دلیل درخواست مشتری * &#x60;14&#x60; - درخواست بازگشت وجه به فروشگاه پس از عدم تأیید توسط فروشگاه * &#x60;15&#x60; - درخواست بازگشت وجه به مشتری پس از ناموفق بودن توسط فروشگاه * &#x60;16&#x60; - بازپرداخت به فروشگاه پس از لغو توسط فروشگاه * &#x60;17&#x60; - بازپرداخت تکمیل شد * &#x60;18&#x60; - زمان انقضا گذشته است * &#x60;19&#x60; - تحویل شده * &#x60;20&#x60; - جمع اوری شده و در حال ارسال (optional)
     * @param  string|null $statuses (optional)
     * @param  bool|null $today_pickup (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerPaidList'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function orderApiV1ManagerPaidListRequest($cities = null, $created_at = null, $cursor = null, $order_ids = null, $ordering = null, $payment_types = null, $provinces = null, $reference_code = null, $search = null, $shipping_types = null, $status = null, $statuses = null, $today_pickup = null, string $contentType = self::contentTypes['orderApiV1ManagerPaidList'][0])
    {















        $resourcePath = '/order/api/v1/manager/paid/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $cities,
            'cities', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $created_at,
            'created_at', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $cursor,
            'cursor', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $order_ids,
            'order_ids', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $ordering,
            'ordering', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $payment_types,
            'payment_types', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $provinces,
            'provinces', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $reference_code,
            'reference_code', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $search,
            'search', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $shipping_types,
            'shipping_types', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $status,
            'status', // param base name
            'integer', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $statuses,
            'statuses', // param base name
            'string', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);
        // query params
        $queryParams = array_merge($queryParams, ObjectSerializer::toQueryValue(
            $today_pickup,
            'today_pickup', // param base name
            'boolean', // openApiType
            'form', // style
            true, // explode
            false // required
        ) ?? []);




        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation orderApiV1ManagerRefundCreate
     *
     * بازگشت سفارش
     *
     * @param  string $order_uuid order_uuid (required)
     * @param  \OpenAPI\Client\Model\RefundOrder|null $refund_order refund_order (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerRefundCreate'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\MerchantOrderRefundResponse|\OpenAPI\Client\Model\OrderError
     */
    public function orderApiV1ManagerRefundCreate($order_uuid, $refund_order = null, string $contentType = self::contentTypes['orderApiV1ManagerRefundCreate'][0])
    {
        list($response) = $this->orderApiV1ManagerRefundCreateWithHttpInfo($order_uuid, $refund_order, $contentType);
        return $response;
    }

    /**
     * Operation orderApiV1ManagerRefundCreateWithHttpInfo
     *
     * بازگشت سفارش
     *
     * @param  string $order_uuid (required)
     * @param  \OpenAPI\Client\Model\RefundOrder|null $refund_order (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerRefundCreate'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\MerchantOrderRefundResponse|\OpenAPI\Client\Model\OrderError, HTTP status code, HTTP response headers (array of strings)
     */
    public function orderApiV1ManagerRefundCreateWithHttpInfo($order_uuid, $refund_order = null, string $contentType = self::contentTypes['orderApiV1ManagerRefundCreate'][0])
    {
        $request = $this->orderApiV1ManagerRefundCreateRequest($order_uuid, $refund_order, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\MerchantOrderRefundResponse',
                        $request,
                        $response,
                    );
                case 500:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\OrderError',
                        $request,
                        $response,
                    );
            }

            

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\OpenAPI\Client\Model\MerchantOrderRefundResponse',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\MerchantOrderRefundResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\OrderError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation orderApiV1ManagerRefundCreateAsync
     *
     * بازگشت سفارش
     *
     * @param  string $order_uuid (required)
     * @param  \OpenAPI\Client\Model\RefundOrder|null $refund_order (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerRefundCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderApiV1ManagerRefundCreateAsync($order_uuid, $refund_order = null, string $contentType = self::contentTypes['orderApiV1ManagerRefundCreate'][0])
    {
        return $this->orderApiV1ManagerRefundCreateAsyncWithHttpInfo($order_uuid, $refund_order, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation orderApiV1ManagerRefundCreateAsyncWithHttpInfo
     *
     * بازگشت سفارش
     *
     * @param  string $order_uuid (required)
     * @param  \OpenAPI\Client\Model\RefundOrder|null $refund_order (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerRefundCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderApiV1ManagerRefundCreateAsyncWithHttpInfo($order_uuid, $refund_order = null, string $contentType = self::contentTypes['orderApiV1ManagerRefundCreate'][0])
    {
        $returnType = '\OpenAPI\Client\Model\MerchantOrderRefundResponse';
        $request = $this->orderApiV1ManagerRefundCreateRequest($order_uuid, $refund_order, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'orderApiV1ManagerRefundCreate'
     *
     * @param  string $order_uuid (required)
     * @param  \OpenAPI\Client\Model\RefundOrder|null $refund_order (optional)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerRefundCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function orderApiV1ManagerRefundCreateRequest($order_uuid, $refund_order = null, string $contentType = self::contentTypes['orderApiV1ManagerRefundCreate'][0])
    {

        // verify the required parameter 'order_uuid' is set
        if ($order_uuid === null || (is_array($order_uuid) && count($order_uuid) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_uuid when calling orderApiV1ManagerRefundCreate'
            );
        }



        $resourcePath = '/order/api/v1/manager/{order_uuid}/refund/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($order_uuid !== null) {
            $resourcePath = str_replace(
                '{' . 'order_uuid' . '}',
                ObjectSerializer::toPathValue($order_uuid),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($refund_order)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($refund_order));
            } else {
                $httpBody = $refund_order;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation orderApiV1ManagerRetrieve
     *
     * دریافت سفارش
     *
     * @param  string $order_uuid order_uuid (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerRetrieve'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\OrderDetail
     */
    public function orderApiV1ManagerRetrieve($order_uuid, string $contentType = self::contentTypes['orderApiV1ManagerRetrieve'][0])
    {
        list($response) = $this->orderApiV1ManagerRetrieveWithHttpInfo($order_uuid, $contentType);
        return $response;
    }

    /**
     * Operation orderApiV1ManagerRetrieveWithHttpInfo
     *
     * دریافت سفارش
     *
     * @param  string $order_uuid (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerRetrieve'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\OrderDetail, HTTP status code, HTTP response headers (array of strings)
     */
    public function orderApiV1ManagerRetrieveWithHttpInfo($order_uuid, string $contentType = self::contentTypes['orderApiV1ManagerRetrieve'][0])
    {
        $request = $this->orderApiV1ManagerRetrieveRequest($order_uuid, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\OrderDetail',
                        $request,
                        $response,
                    );
            }

            

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\OpenAPI\Client\Model\OrderDetail',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\OrderDetail',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation orderApiV1ManagerRetrieveAsync
     *
     * دریافت سفارش
     *
     * @param  string $order_uuid (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerRetrieve'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderApiV1ManagerRetrieveAsync($order_uuid, string $contentType = self::contentTypes['orderApiV1ManagerRetrieve'][0])
    {
        return $this->orderApiV1ManagerRetrieveAsyncWithHttpInfo($order_uuid, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation orderApiV1ManagerRetrieveAsyncWithHttpInfo
     *
     * دریافت سفارش
     *
     * @param  string $order_uuid (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerRetrieve'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderApiV1ManagerRetrieveAsyncWithHttpInfo($order_uuid, string $contentType = self::contentTypes['orderApiV1ManagerRetrieve'][0])
    {
        $returnType = '\OpenAPI\Client\Model\OrderDetail';
        $request = $this->orderApiV1ManagerRetrieveRequest($order_uuid, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'orderApiV1ManagerRetrieve'
     *
     * @param  string $order_uuid (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerRetrieve'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function orderApiV1ManagerRetrieveRequest($order_uuid, string $contentType = self::contentTypes['orderApiV1ManagerRetrieve'][0])
    {

        // verify the required parameter 'order_uuid' is set
        if ($order_uuid === null || (is_array($order_uuid) && count($order_uuid) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_uuid when calling orderApiV1ManagerRetrieve'
            );
        }


        $resourcePath = '/order/api/v1/manager/{order_uuid}/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($order_uuid !== null) {
            $resourcePath = str_replace(
                '{' . 'order_uuid' . '}',
                ObjectSerializer::toPathValue($order_uuid),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'GET',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation orderApiV1ManagerUpdateStatusUpdate
     *
     * Update Order Status
     *
     * @param  string $order_uuid order_uuid (required)
     * @param  \OpenAPI\Client\Model\UpdateOrderStatus $update_order_status update_order_status (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerUpdateStatusUpdate'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\OrderDetail
     */
    public function orderApiV1ManagerUpdateStatusUpdate($order_uuid, $update_order_status, string $contentType = self::contentTypes['orderApiV1ManagerUpdateStatusUpdate'][0])
    {
        list($response) = $this->orderApiV1ManagerUpdateStatusUpdateWithHttpInfo($order_uuid, $update_order_status, $contentType);
        return $response;
    }

    /**
     * Operation orderApiV1ManagerUpdateStatusUpdateWithHttpInfo
     *
     * Update Order Status
     *
     * @param  string $order_uuid (required)
     * @param  \OpenAPI\Client\Model\UpdateOrderStatus $update_order_status (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerUpdateStatusUpdate'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\OrderDetail, HTTP status code, HTTP response headers (array of strings)
     */
    public function orderApiV1ManagerUpdateStatusUpdateWithHttpInfo($order_uuid, $update_order_status, string $contentType = self::contentTypes['orderApiV1ManagerUpdateStatusUpdate'][0])
    {
        $request = $this->orderApiV1ManagerUpdateStatusUpdateRequest($order_uuid, $update_order_status, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\OrderDetail',
                        $request,
                        $response,
                    );
            }

            

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\OpenAPI\Client\Model\OrderDetail',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\OrderDetail',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation orderApiV1ManagerUpdateStatusUpdateAsync
     *
     * Update Order Status
     *
     * @param  string $order_uuid (required)
     * @param  \OpenAPI\Client\Model\UpdateOrderStatus $update_order_status (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerUpdateStatusUpdate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderApiV1ManagerUpdateStatusUpdateAsync($order_uuid, $update_order_status, string $contentType = self::contentTypes['orderApiV1ManagerUpdateStatusUpdate'][0])
    {
        return $this->orderApiV1ManagerUpdateStatusUpdateAsyncWithHttpInfo($order_uuid, $update_order_status, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation orderApiV1ManagerUpdateStatusUpdateAsyncWithHttpInfo
     *
     * Update Order Status
     *
     * @param  string $order_uuid (required)
     * @param  \OpenAPI\Client\Model\UpdateOrderStatus $update_order_status (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerUpdateStatusUpdate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderApiV1ManagerUpdateStatusUpdateAsyncWithHttpInfo($order_uuid, $update_order_status, string $contentType = self::contentTypes['orderApiV1ManagerUpdateStatusUpdate'][0])
    {
        $returnType = '\OpenAPI\Client\Model\OrderDetail';
        $request = $this->orderApiV1ManagerUpdateStatusUpdateRequest($order_uuid, $update_order_status, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'orderApiV1ManagerUpdateStatusUpdate'
     *
     * @param  string $order_uuid (required)
     * @param  \OpenAPI\Client\Model\UpdateOrderStatus $update_order_status (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerUpdateStatusUpdate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function orderApiV1ManagerUpdateStatusUpdateRequest($order_uuid, $update_order_status, string $contentType = self::contentTypes['orderApiV1ManagerUpdateStatusUpdate'][0])
    {

        // verify the required parameter 'order_uuid' is set
        if ($order_uuid === null || (is_array($order_uuid) && count($order_uuid) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_uuid when calling orderApiV1ManagerUpdateStatusUpdate'
            );
        }

        // verify the required parameter 'update_order_status' is set
        if ($update_order_status === null || (is_array($update_order_status) && count($update_order_status) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $update_order_status when calling orderApiV1ManagerUpdateStatusUpdate'
            );
        }


        $resourcePath = '/order/api/v1/manager/{order_uuid}/update-status/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($order_uuid !== null) {
            $resourcePath = str_replace(
                '{' . 'order_uuid' . '}',
                ObjectSerializer::toPathValue($order_uuid),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($update_order_status)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($update_order_status));
            } else {
                $httpBody = $update_order_status;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'PUT',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation orderApiV1ManagerVerifyCreate
     *
     * تایید سفارش
     *
     * @param  string $order_uuid order_uuid (required)
     * @param  \OpenAPI\Client\Model\VerifyOrder $verify_order verify_order (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerVerifyCreate'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return \OpenAPI\Client\Model\OrderDetail
     */
    public function orderApiV1ManagerVerifyCreate($order_uuid, $verify_order, string $contentType = self::contentTypes['orderApiV1ManagerVerifyCreate'][0])
    {
        list($response) = $this->orderApiV1ManagerVerifyCreateWithHttpInfo($order_uuid, $verify_order, $contentType);
        return $response;
    }

    /**
     * Operation orderApiV1ManagerVerifyCreateWithHttpInfo
     *
     * تایید سفارش
     *
     * @param  string $order_uuid (required)
     * @param  \OpenAPI\Client\Model\VerifyOrder $verify_order (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerVerifyCreate'] to see the possible values for this operation
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response or if the response body is not in the expected format
     * @throws \InvalidArgumentException
     * @return array of \OpenAPI\Client\Model\OrderDetail, HTTP status code, HTTP response headers (array of strings)
     */
    public function orderApiV1ManagerVerifyCreateWithHttpInfo($order_uuid, $verify_order, string $contentType = self::contentTypes['orderApiV1ManagerVerifyCreate'][0])
    {
        $request = $this->orderApiV1ManagerVerifyCreateRequest($order_uuid, $verify_order, $contentType);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();


            switch($statusCode) {
                case 200:
                    return $this->handleResponseWithDataType(
                        '\OpenAPI\Client\Model\OrderDetail',
                        $request,
                        $response,
                    );
            }

            

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            return $this->handleResponseWithDataType(
                '\OpenAPI\Client\Model\OrderDetail',
                $request,
                $response,
            );
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\OrderDetail',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    throw $e;
            }
        

            throw $e;
        }
    }

    /**
     * Operation orderApiV1ManagerVerifyCreateAsync
     *
     * تایید سفارش
     *
     * @param  string $order_uuid (required)
     * @param  \OpenAPI\Client\Model\VerifyOrder $verify_order (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerVerifyCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderApiV1ManagerVerifyCreateAsync($order_uuid, $verify_order, string $contentType = self::contentTypes['orderApiV1ManagerVerifyCreate'][0])
    {
        return $this->orderApiV1ManagerVerifyCreateAsyncWithHttpInfo($order_uuid, $verify_order, $contentType)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation orderApiV1ManagerVerifyCreateAsyncWithHttpInfo
     *
     * تایید سفارش
     *
     * @param  string $order_uuid (required)
     * @param  \OpenAPI\Client\Model\VerifyOrder $verify_order (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerVerifyCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function orderApiV1ManagerVerifyCreateAsyncWithHttpInfo($order_uuid, $verify_order, string $contentType = self::contentTypes['orderApiV1ManagerVerifyCreate'][0])
    {
        $returnType = '\OpenAPI\Client\Model\OrderDetail';
        $request = $this->orderApiV1ManagerVerifyCreateRequest($order_uuid, $verify_order, $contentType);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                        if ($returnType !== 'string') {
                            $content = json_decode($content);
                        }
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders()
                    ];
                },
                function ($exception) {
                    $response = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'orderApiV1ManagerVerifyCreate'
     *
     * @param  string $order_uuid (required)
     * @param  \OpenAPI\Client\Model\VerifyOrder $verify_order (required)
     * @param  string $contentType The value for the Content-Type header. Check self::contentTypes['orderApiV1ManagerVerifyCreate'] to see the possible values for this operation
     *
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    public function orderApiV1ManagerVerifyCreateRequest($order_uuid, $verify_order, string $contentType = self::contentTypes['orderApiV1ManagerVerifyCreate'][0])
    {

        // verify the required parameter 'order_uuid' is set
        if ($order_uuid === null || (is_array($order_uuid) && count($order_uuid) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_uuid when calling orderApiV1ManagerVerifyCreate'
            );
        }

        // verify the required parameter 'verify_order' is set
        if ($verify_order === null || (is_array($verify_order) && count($verify_order) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $verify_order when calling orderApiV1ManagerVerifyCreate'
            );
        }


        $resourcePath = '/order/api/v1/manager/{order_uuid}/verify/';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;



        // path params
        if ($order_uuid !== null) {
            $resourcePath = str_replace(
                '{' . 'order_uuid' . '}',
                ObjectSerializer::toPathValue($order_uuid),
                $resourcePath
            );
        }


        $headers = $this->headerSelector->selectHeaders(
            ['application/json', ],
            $contentType,
            $multipart
        );

        // for model (json/xml)
        if (isset($verify_order)) {
            if (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the body
                $httpBody = \GuzzleHttp\Utils::jsonEncode(ObjectSerializer::sanitizeForSerialization($verify_order));
            } else {
                $httpBody = $verify_order;
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name' => $formParamName,
                            'contents' => $formParamValueItem
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);

            } elseif (stripos($headers['Content-Type'], 'application/json') !== false) {
                # if Content-Type contains "application/json", json_encode the form parameters
                $httpBody = \GuzzleHttp\Utils::jsonEncode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = ObjectSerializer::buildQuery($formParams);
            }
        }

        // this endpoint requires API key authentication
        $apiKey = $this->config->getApiKeyWithPrefix('Authorization');
        if ($apiKey !== null) {
            $headers['Authorization'] = $apiKey;
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $operationHost = $this->config->getHost();
        $query = ObjectSerializer::buildQuery($queryParams);
        return new Request(
            'POST',
            $operationHost . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option
     *
     * @throws \RuntimeException on file opening failure
     * @return array of http client options
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        if ($this->config->getCertFile()) {
            $options[RequestOptions::CERT] = $this->config->getCertFile();
        }

        if ($this->config->getKeyFile()) {
            $options[RequestOptions::SSL_KEY] = $this->config->getKeyFile();
        }

        return $options;
    }

    private function handleResponseWithDataType(
        string $dataType,
        RequestInterface $request,
        ResponseInterface $response
    ): array {
        if ($dataType === '\SplFileObject') {
            $content = $response->getBody(); //stream goes to serializer
        } else {
            $content = (string) $response->getBody();
            if ($dataType !== 'string') {
                try {
                    $content = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
                } catch (\JsonException $exception) {
                    throw new ApiException(
                        sprintf(
                            'Error JSON decoding server response (%s)',
                            $request->getUri()
                        ),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                        $content
                    );
                }
            }
        }

        return [
            ObjectSerializer::deserialize($content, $dataType, []),
            $response->getStatusCode(),
            $response->getHeaders()
        ];
    }

    private function responseWithinRangeCode(
        string $rangeCode,
        int $statusCode
    ): bool {
        $left = (int) ($rangeCode[0].'00');
        $right = (int) ($rangeCode[0].'99');

        return $statusCode >= $left && $statusCode <= $right;
    }
}
