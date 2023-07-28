<?php
declare(strict_types=1);

namespace framework\jose;

/**
 * Jws 接口定义了处理 JSON Web Signature (JWS) 的基本结构和功能。
 * JWS 是 JWT 结构的一部分，它包含了 JWT 的签名信息。
 * JWS 接口扩展了 Jwt 接口，并添加了一个用于获取签名的方法。
 */
interface Jws extends Jwt
{
    /**
     * 获取 JWT 的 JWS 签名。
     * 签名用于验证 JWT 的发送者的身份和 JWT 的完整性。
     *
     * @return string JWT 的 JWS 签名。
     */
    public function getSignature(): string;
}