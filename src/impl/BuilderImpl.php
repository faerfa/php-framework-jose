<?php
declare(strict_types=1);

namespace framework\jose\impl;

use DateTime;
use framework\jose\Builder;
use framework\jose\Claims;
use framework\jose\Header;
use framework\jose\Jose;
use framework\jose\SignatureAlgorithm;

/**
 * BuilderImpl 是 Builder 接口的具体实现类，它提供了构建 JWT（JSON Web Tokens）的功能。
 * 它的功能主要包括设置头部（Header）、声明（Claims）、签名算法、密钥，以及生成最终的令牌。
 */
class BuilderImpl implements Builder
{
    /**
     * 头部
     * @var Header|null
     */
    private ?Header $header = null;

    /**
     * 声明
     * @var Claims|null
     */
    private ?Claims $claims = null;

    /**
     * 算法
     * @var SignatureAlgorithm
     */
    private SignatureAlgorithm $algorithm = SignatureAlgorithm::NONE;

    /**
     * 密钥
     * @var string
     */
    private string $secret = "";

    protected function ensureHeader(): Header
    {
        if (is_null($this->header)) {
            if ($this->algorithm == SignatureAlgorithm::NONE) {
                $header = new JwtHeaderImpl();
            } else {
                $header = new JwsHeaderImpl();
                $header->setAlgorithm($this->algorithm);
            }
            $this->header = $header;
        }
        return $this->header;
    }

    public function setHeader(Header $header): Builder
    {
        $this->header = $header;
        return $this;
    }

    protected function ensureClaims(): Claims
    {
        if (is_null($this->claims)) {
            $this->claims = new ClaimsImpl();
        }
        return $this->claims;
    }

    public function setClaims(Claims $claims): Builder
    {
        $this->claims = $claims;
        return $this;
    }

    public function setIssuer(?string $issuer): Builder
    {
        $this->ensureClaims()->setIssuer($issuer);
        return $this;
    }

    public function setSubject(mixed $subject): Builder
    {
        $this->ensureClaims()->setSubject($subject);
        return $this;
    }

    public function setAudience(array|string|null $audience): Builder
    {
        $this->ensureClaims()->setAudience($audience);
        return $this;
    }

    public function setExpirationTime(?DateTime $expirationTime): Builder
    {
        $this->ensureClaims()->setExpirationTime($expirationTime);
        return $this;
    }

    public function setNotBefore(?DateTime $notBefore): Builder
    {
        $this->ensureClaims()->setNotBefore($notBefore);
        return $this;
    }

    public function setIssuedAt(?DateTime $issuedAt): Builder
    {
        $this->ensureClaims()->setIssuedAt($issuedAt);
        return $this;
    }

    public function setJwtId(?string $jwtId): Builder
    {
        $this->ensureClaims()->setJwtId($jwtId);
        return $this;
    }

    public function setClaim(string $name, mixed $value): Builder
    {
        $this->ensureClaims()->setClaim($name, $value);
        return $this;
    }

    public function signWith(SignatureAlgorithm $algorithm, string $secret): Builder
    {
        $this->algorithm = $algorithm;
        $this->secret = $secret;
        return $this;
    }

    public function compact(): string
    {
        $header = $this->ensureHeader();
        $claims = $this->ensureClaims();

        $token = $this->base64UrlEncode($header) . Jose::SEPARATOR_CHAR . $this->base64UrlEncode($claims);

        $token .= Jose::SEPARATOR_CHAR . $this->base64UrlEncode($this->algorithm->sign($token, $this->secret));

        return $token;
    }

    /**
     * 对给定的值进行 Base64Url 编码
     * @param object|string $value 要编码的值
     * @return string 编码后的字符串
     */
    protected function base64UrlEncode(object|string $value): string
    {
        if (gettype($value) == "object") {
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        }
        return rtrim(str_replace(array('+', '/'), array('-', '_'), base64_encode($value)), '=');
    }
}