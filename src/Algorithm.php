<?php
declare(strict_types=1);

namespace framework\jose;

/**
 * Algorithm 接口定义了一个签名算法应有的行为。
 *
 * 这个接口定义了两个主要方法：sign 和 verify。sign 方法用于生成签名，verify 方法用于验证签名。
 * 实现这个接口的类需要提供这两个方法的具体实现。
 */
interface Algorithm
{
    /**
     * 生成签名
     * @param string $data 需要签名的数据
     * @param string $secret 密钥
     * @return string 生成的签名
     * @throws JoseException 当提供了无效的数据或密钥时抛出
     */
    public function sign(string $data, string $secret): string;

    /**
     * 校验签名
     * @param string $data 被签名的数据
     * @param string $signature 需要验证的签名
     * @param string $secret 密钥
     * @return bool 如果签名有效返回 true，否则返回 false
     * @throws JoseException 当提供了无效的数据、密钥或签名时抛出
     */
    public function verify(string $data, string $signature, string $secret): bool;
}