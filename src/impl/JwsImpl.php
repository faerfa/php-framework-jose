<?php
declare(strict_types=1);

namespace framework\jose\impl;

use framework\jose\Claims;
use framework\jose\Header;
use framework\jose\Jws;

/**
 * JwsImpl 是一个 Jws 的实现类，提供了创建和处理 JSON Web Signature (JWS) 的功能。
 * JwsImpl 会存储 JWT 的头部、声明和签名信息，并提供了获取这些信息的方法。
 */
class JwsImpl implements Jws
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
     * JWT 的签名部分。签名用于验证 JWT 的发送者的身份和 JWT 的完整性。
     *
     * @var string
     */
    private string $signature;

    /**
     * 创建一个新的 JwsImpl 实例。
     *
     * @param Header $header JWT 的头部部分。
     * @param Claims $claims JWT 的声明（Payload）部分。
     * @param string $signature JWT 的签名部分。
     */
    public function __construct(Header $header, Claims $claims, string $signature)
    {
        $this->header = $header;
        $this->claims = $claims;
        $this->signature = $signature;
    }

    public function getHeader(): Header
    {
        return $this->header;
    }

    public function getPayload(): Claims
    {
        return $this->claims;
    }

    public function getSignature(): string
    {
        return $this->signature;
    }
}