<?php
declare(strict_types=1);

namespace framework\jose;

use DateTime;

/**
 * Interface JWT Claims 声明字段
 * <br>
 * JSON Web Token (JWT) 中的声明字段接口，定义了一组标准的声明字段，用于在JWT中传递各种有关主体(subject)、颁发者(issuer)、受众(audience)等信息。
 * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4
 */
interface Claims
{
    /**
     * 令牌颁发者 (Issuer)
     * @var string
     */
    public const ISSUER = "iss";

    /**
     * 令牌主体 (Subject)
     * @var string|null
     */
    public const SUBJECT = "sub";

    /**
     * 令牌受众 (Audience)
     * @var string|array|null
     */
    public const AUDIENCE = "aud";

    /**
     * 令牌到期时间 (Expiration Time)
     * @var string
     */
    public const EXPIRATION_TIME = "exp";

    /**
     * 令牌生效时间 (Not Before)
     * @var string
     */
    public const NOT_BEFORE = "nbf";

    /**
     * 令牌颁发时间 (Issued At)
     * @var string
     */
    public const ISSUED_AT = "iat";

    /**
     * 令牌标识 (JWT ID)
     * @var string|null
     */
    public const JWT_ID = "jti";

    /**
     * 获取令牌颁发者
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.1
     * @return string|null
     */
    public function getIssuer(): ?string;

    /**
     * 设置令牌颁发者（可选）
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.1
     * @param string|null $issuer 令牌颁发者 (Issuer)
     * @return Claims 用于方法链的Claims实例
     */
    public function setIssuer(?string $issuer): Claims;

    /**
     * 获取令牌主体
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.2
     * @return mixed
     */
    public function getSubject(): mixed;

    /**
     * 设置令牌主体（可选）
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.2
     * @param mixed $subject 令牌主体 (Subject)
     * @return Claims 用于方法链的Claims实例
     */
    public function setSubject(mixed $subject): Claims;

    /**
     * 获取令牌受众
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.3
     * @return string|array|null
     */
    public function getAudience(): string|array|null;

    /**
     * 设置令牌受众（可选）
     * @param string|array|null $audience 令牌受众 (Audience)
     * @return Claims 用于方法链的Claims实例
     */
    public function setAudience(string|array|null $audience): Claims;

    /**
     * 获取令牌到期时间
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.4
     * @return DateTime|null
     */
    public function getExpirationTime(): ?DateTime;

    /**
     * 设置令牌到期时间（可选）
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.4
     * @param DateTime|null $expirationTime 令牌到期时间 (Expiration Time)
     * @return Claims 用于方法链的Claims实例
     */
    public function setExpirationTime(?DateTime $expirationTime): Claims;

    /**
     * 获取令牌生效时间
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.5
     * @return DateTime|null
     */
    public function getNotBefore(): ?DateTime;

    /**
     * 设置令牌生效时间（可选）
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.5
     * @param DateTime|null $notBefore 令牌生效时间 (Not Before)
     * @return Claims 用于方法链的Claims实例
     */
    public function setNotBefore(?DateTime $notBefore): Claims;

    /**
     * 获取令牌颁发时间
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.6
     * @return DateTime|null
     */
    public function getIssuedAt(): ?DateTime;

    /**
     * 设置令牌颁发时间
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.6
     * @param DateTime|null $issuedAt 令牌颁发时间 (Issued At)
     * @return Claims 用于方法链的Claims实例
     */
    public function setIssuedAt(?DateTime $issuedAt): Claims;

    /**
     * 获取令牌标识
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.7
     * @return string|null
     */
    public function getJwtId(): ?string;

    /**
     * 设置令牌标识
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.1.7
     * @param string|null $jwtId 令牌标识 (JWT ID)
     * @return Claims 用于方法链的Claims实例
     */
    public function setJwtId(?string $jwtId): Claims;

    /**
     * 获取令牌自定义参数
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.2
     * @param string $name 参数名称
     * @return mixed
     */
    public function getClaim(string $name): mixed;

    /**
     * 设置令牌自定义参数
     * @link https://datatracker.ietf.org/doc/html/rfc7519#section-4.2
     * @param string $name 参数名称
     * @param mixed $value 参数值
     * @return Claims 用于方法链的Claims实例
     */
    public function setClaim(string $name, mixed $value): Claims;
}