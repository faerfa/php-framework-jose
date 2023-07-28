<?php
declare(strict_types=1);

namespace framework\jose\impl;

use DateTime;
use framework\jose\Claims;
use JsonSerializable;

/**
 * 实现 Claims 和 JsonSerializable 接口的 ClaimsImpl 类
 */
class ClaimsImpl implements Claims, JsonSerializable
{
    /**
     * 声明
     * @var array
     */
    private array $claims = [];

    public function getIssuer(): ?string
    {
        return $this->getClaim(Claims::ISSUER);
    }

    public function setIssuer(?string $issuer): Claims
    {
        return $this->setClaim(Claims::ISSUER, $issuer);
    }

    public function getSubject(): mixed
    {
        return $this->getClaim(Claims::SUBJECT);
    }

    public function setSubject(mixed $subject): Claims
    {
        return $this->setClaim(Claims::SUBJECT, $subject);
    }

    public function getAudience(): string|array|null
    {
        return $this->getClaim(Claims::AUDIENCE);
    }

    public function setAudience(array|string|null $audience): Claims
    {
        return $this->setClaim(Claims::AUDIENCE, $audience);
    }

    public function getExpirationTime(): ?DateTime
    {
        $timestamp = $this->getClaim(Claims::EXPIRATION_TIME);
        if (!is_null($timestamp)) return new DateTime("@$timestamp");
        return null;
    }

    public function setExpirationTime(?DateTime $expirationTime): Claims
    {
        return $this->setClaim(Claims::EXPIRATION_TIME, $expirationTime?->getTimestamp());
    }

    public function getNotBefore(): ?DateTime
    {
        $timestamp = $this->getClaim(Claims::NOT_BEFORE);
        if (!is_null($timestamp)) return new DateTime("@$timestamp");
        return null;
    }

    public function setNotBefore(?DateTime $notBefore): Claims
    {
        return $this->setClaim(Claims::NOT_BEFORE, $notBefore?->getTimestamp());
    }

    public function getIssuedAt(): ?DateTime
    {
        $timestamp = $this->getClaim(Claims::ISSUED_AT);
        if (!is_null($timestamp)) return new DateTime("@$timestamp");
        return null;
    }

    public function setIssuedAt(?DateTime $issuedAt): Claims
    {
        return $this->setClaim(Claims::ISSUED_AT, $issuedAt?->getTimestamp());
    }

    public function getJwtId(): ?string
    {
        return $this->getClaim(Claims::JWT_ID);
    }

    public function setJwtId(?string $jwtId): Claims
    {
        return $this->setClaim(Claims::JWT_ID, $jwtId);
    }

    public function getClaim(string $name): mixed
    {
        return $this->claims[$name] ?? null;
    }

    public function setClaim(string $name, mixed $value): Claims
    {
        $this->claims[$name] = $value;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return array_filter($this->claims);
    }
}