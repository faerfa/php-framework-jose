<?php
declare(strict_types=1);

namespace framework\jose;

use DateTime;

interface Builder
{
    /**
     * 设置令牌头部
     * @param Header $header
     * @return Builder
     */
    public function setHeader(Header $header): Builder;

    /**
     * 设置令牌声明
     * @param Claims $claims
     * @return Builder 用于方法链的Builder实例
     */
    public function setClaims(Claims $claims): Builder;

    /**
     * 设置令牌颁发者（可选）
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.1
     * @param string|null $issuer
     * @return Builder 用于方法链的Builder实例
     */
    public function setIssuer(?string $issuer): Builder;

    /**
     * 设置令牌主体（可选）
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.2
     * @param mixed $subject
     * @return Builder 用于方法链的Builder实例
     */
    public function setSubject(mixed $subject): Builder;

    /**
     * 设置令牌受众（可选）
     * @param string|array|null $audience
     * @return Builder 用于方法链的Builder实例
     */
    public function setAudience(string|array|null $audience): Builder;

    /**
     * 设置令牌到期时间（可选）
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.4
     * @param DateTime|null $expirationTime
     * @return Builder 用于方法链的Builder实例
     */
    public function setExpirationTime(?DateTime $expirationTime): Builder;

    /**
     * 设置令牌生效时间（可选）
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.5
     * @param DateTime|null $notBefore
     * @return Builder 用于方法链的Builder实例
     */
    public function setNotBefore(?DateTime $notBefore): Builder;

    /**
     * 设置令牌颁发时间
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.6
     * @param DateTime|null $issuedAt
     * @return Builder 用于方法链的Builder实例
     */
    public function setIssuedAt(?DateTime $issuedAt): Builder;

    /**
     * 设置令牌标识
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.7
     * @param string|null $jwtId
     * @return Builder 用于方法链的Builder实例
     */
    public function setJwtId(?string $jwtId): Builder;

    /**
     * 设置令牌自定义参数
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.2
     * @param string $name
     * @param mixed $value
     * @return Builder 用于方法链的Builder实例
     */
    public function setClaim(string $name, mixed $value): Builder;

    /**
     * 设置算法和的密钥进行签名
     * @param SignatureAlgorithm $algorithm 签名算法
     * @param string $secret 签名密钥
     * @return Builder
     */
    public function signWith(SignatureAlgorithm $algorithm, string $secret): Builder;

    /**
     * 创建令牌
     * @return string
     */
    public function compact(): string;
}