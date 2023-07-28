<?php
declare(strict_types=1);

namespace framework\jose;

use ReflectionClass;
use ReflectionException;

/**
 * SignatureAlgorithm 枚举定义了支持的签名算法。
 *
 * 这个枚举包括 NONE 和 HS256 两个签名算法。
 * 它提供了 sign 和 verify 方法，分别用于生成签名和验证签名。
 * 这两个方法都通过调用 algorithm 方法获取具体的 Algorithm 实例，并调用该实例的对应方法。
 */
enum SignatureAlgorithm: string
{
    case NONE = "NONE";
    case HS256 = "HS256";

    /**
     * 生成签名
     *
     * @param string $data 需要签名的数据
     * @param string $secret 密钥
     * @return string 生成的签名
     * @throws JoseException 当提供了无效的数据或密钥时抛出
     */
    public function sign(string $data, string $secret): string
    {
        return $this->algorithm()->sign($data, $secret);
    }

    /**
     * 校验签名
     *
     * @param string $data 被签名的数据
     * @param string $signature 需要验证的签名
     * @param string $secret 密钥
     * @return bool 如果签名有效返回 true，否则返回 false
     * @throws JoseException 当提供了无效的数据、密钥或签名时抛出
     */
    public function verify(string $data, string $signature, string $secret): bool
    {
        return $this->algorithm()->verify($data, $signature, $secret);
    }

    /**
     * 获取具体的 Algorithm 实例
     *
     * 这个方法使用 PHP 的反射机制来动态创建具体的 Algorithm 实例。
     *
     * @return Algorithm 具体的 Algorithm 实例
     * @throws JoseException 当创建 Algorithm 实例失败时抛出
     */
    public function algorithm(): Algorithm
    {
        $algorithm = sprintf("%s\%s\%s", __NAMESPACE__, __FUNCTION__, $this->name);

        try {
            $reflectionClass = new ReflectionClass($algorithm);
            if (!$reflectionClass->implementsInterface(Algorithm::class)) {
                throw new JoseException(sprintf("%s no implemented algorithm interface", $this->name), JoseException::ALGORITHM_NOT_EXIST);
            }
            return $reflectionClass->newInstance();
        } catch (ReflectionException $e) {
            throw new JoseException(sprintf("algorithm %s not exist", $this->name), JoseException::ALGORITHM_NOT_EXIST);
        }
    }
}