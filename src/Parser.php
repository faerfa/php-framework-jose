<?php
declare(strict_types=1);

namespace framework\jose;

/**
 * JWT 解析器接口
 *
 * 这个接口定义了 JWT 解析器的基本操作，包括设置密钥和解析令牌。
 * 实现这个接口的类应该能够接受一个密钥，然后使用这个密钥解析 JWT 令牌。
 */
interface Parser
{
    /**
     * 设置用于 JWT（Json Web Token）签名和验证的密钥。
     *
     * @param string $secret 用于 JWT 签名和验证的密钥
     * @return Parser 返回 Parser 接口自身，方便链式调用
     */
    public function setSecret(string $secret): Parser;

    /**
     * 解析并验证给定的 JWT 字符串，返回一个 Jwt 或 Jws 对象。
     *
     * @param string $compact 需要解析的 JWT 字符串
     * @return Jwt|Jws 返回解析后的 Jwt 或 Jws 对象
     * @throws JoseException 当 JWT 字符串无法被解析或验证失败时，会抛出 JoseException 异常
     */
    public function parse(string $compact): Jwt|Jws;
}