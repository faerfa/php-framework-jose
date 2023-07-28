<?php
declare(strict_types=1);

namespace framework\jose;

/**
 * JwsHeader 接口定义了 JSON Web Signature (JWS) 头部需要的方法。
 * 这些方法包括获取和设置签名算法。
 *
 * "alg" (Algorithm) 是头部参数，用于指定用于签名的算法。
 *
 * @link https://datatracker.ietf.org/doc/html/rfc7515#section-4.1
 */
interface JwsHeader extends Header
{
    /**
     * "alg" (Algorithm) Header Parameter
     */
    public const ALGORITHM = "alg";

    /**
     * 获取签名算法
     *
     * 这个方法返回一个 SignatureAlgorithm 对象，表示头部中的 "alg" 参数的值。
     * 如果头部中没有 "alg" 参数，这个方法将抛出一个 JoseException 异常。
     *
     * @return SignatureAlgorithm 签名算法
     * @throws JoseException 如果头部中没有 "alg" 参数
     */
    public function getAlgorithm(): SignatureAlgorithm;

    /**
     * 设置签名算法
     *
     * 这个方法设置头部中的 "alg" 参数的值。参数是一个表示签名算法的字符串。
     * 这个方法返回 Header 对象，允许方法链调用。
     *
     * @param SignatureAlgorithm $algorithm 签名算法
     * @return Header 头部对象
     */
    public function setAlgorithm(SignatureAlgorithm $algorithm): Header;
}