<?php

namespace App\Exceptions;

use App\Constants\ExceptionConstant;
use Throwable;

/**
 * Class AddressException
 *
 * @package App\Exceptions
 */
class PostException extends BaseException
{
    private $errorConfig = [
        '30001' => [
            'type'    => ExceptionConstant::FAILURE,
            'message' => '新增文章失敗',
            'sentry'  => false,
        ],
        '30002' => [
            'type'    => ExceptionConstant::FAILURE,
            'message' => '該文章不存在，請重新確認。',
            'sentry'  => false,
        ],
        '30003' => [
            'type'    => ExceptionConstant::FAILURE,
            'message' => '文章更新失敗。',
            'sentry'  => false,
        ]
    ];

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setErrorConfig($this->errorConfig);
    }
}
