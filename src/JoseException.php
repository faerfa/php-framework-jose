<?php
declare(strict_types=1);

namespace framework\jose;

use RuntimeException;

class JoseException extends RuntimeException
{
    /**
     * 算法不存在的错误码
     */
    const ALGORITHM_NOT_EXIST = 1;

    /**
     * 无效签名的错误码
     */
    const INVALID_SIGNATURE = 2;

    /**
     * 令牌过期的错误码
     */
    const TOKEN_EXPIRED = 3;

    /**
     * 令牌未生效的错误码
     */
    const TOKEN_NOT_YET_VALID = 4;

}