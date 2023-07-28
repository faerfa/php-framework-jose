<?php
declare(strict_types=1);

namespace framework\jose\algorithm;

use framework\jose\Algorithm;
use framework\jose\JoseException;

/**
 * HS256 类实现了 Algorithm 接口，使用 HMAC SHA-256 算法进行签名和验证。
 */
class HS256 implements Algorithm
{
    private string $algorithm = "sha256";

    public function __construct()
    {
        if (!in_array("sha256", hash_hmac_algos())) {
            throw new JoseException(sprintf("%s is not supported algorithm", $this->algorithm), JoseException::ALGORITHM_NOT_EXIST);
        }
    }

    public function sign(string $data, string $secret): string
    {
        return hash_hmac("sha256", $data, $secret, true);
    }

    public function verify(string $data, string $signature, string $secret): bool
    {
        return hash_equals($this->sign($data, $secret), $signature);
    }

}