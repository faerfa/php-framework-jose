<?php
declare(strict_types=1);

namespace framework\jose\impl;

use framework\jose\Claims;
use framework\jose\Header;
use framework\jose\Jwt;

/**
 * JwtImpl 是一个 Jwt 的实现，提供了创建和处理 JWT 的功能。
 * JwtImpl 会存储 JWT 的头部和声明信息，并提供了获取这些信息的方法。
 */
class JwtImpl implements Jwt
{
    /**
     * JWT 的头部部分。头部包含了关于如何处理 JWT 的元数据。
     *
     * @var Header
     */
    private Header $header;

    /**
     * JWT 的声明（Payload）。声明包含了实际要传输的信息，以及其他可选的元数据。
     *
     * @var Claims
     */
    private Claims $claims;

    /**
     * 创建一个新的 JwtImpl 实例。
     *
     * @param Header $header JWT 的头部部分。
     * @param Claims $claims JWT 的声明（Payload）部分。
     */
    public function __construct(Header $header, Claims $claims)
    {
        $this->header = $header;
        $this->claims = $claims;
    }

    public function getHeader(): Header
    {
        return $this->header;
    }

    public function getPayload(): Claims
    {
        return $this->claims;
    }
}