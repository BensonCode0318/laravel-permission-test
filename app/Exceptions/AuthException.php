<?php

namespace App\Exceptions;

use App\Constants\ExceptionConstant;
use Throwable;

/**
 * Class AddressException
 *
 * @package App\Exceptions
 */
class AuthException extends BaseException
{
    private $errorConfig = [
        '901' => [
            'type'    => ExceptionConstant::FAILURE,
            'message' => '驗證異常，請重新登入',
            'sentry'  => false,
        ],
        '902' => [
            'type'    => ExceptionConstant::FAILURE,
            'message' => '驗證過期，請重新登入。',
            'sentry'  => false,
        ],
        '903' => [
            'type'    => ExceptionConstant::FAILURE,
            'message' => '未帶Token，請重新登入',
            'sentry'  => false,
        ],
        '904' => [
            'type'    => ExceptionConstant::FAILURE,
            'message' => '該使用者沒有使用權限，請重新確認。',
            'sentry'  => false,
        ],
        '905' => [
            'type'    => ExceptionConstant::FAILURE,
            'message' => '該使用者沒有這個領域的權限，請重試。',
            'sentry'  => false,
        ]
    ];

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setErrorConfig($this->errorConfig);
    }
}
