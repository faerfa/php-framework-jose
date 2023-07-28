<?php
declare(strict_types=1);

namespace framework\jose\impl;

use framework\jose\Header;
use JsonSerializable;

/**
 * JWT Header 的实现类
 *
 * 这个类实现了 `Header` 接口，并提供了对 JWT Header 参数的设置和获取的功能。
 * 这个类也实现了 `JsonSerializable` 接口，以便将 Header 对象序列化为 JSON 格式。
 */
class HeaderImpl implements Header, JsonSerializable
{
    /**
     * 用于存储 Header 参数的数组。
     */
    private array $headers = [];

    public function getType(): string
    {
        return $this->getHeader(Header::TYPE);
    }

    public function setType(string $type): Header
    {
        return $this->setHeader(Header::TYPE, $type);
    }

    public function getContentType(): string
    {
        return $this->getHeader(Header::CONTENT_TYPE);
    }

    public function setContentType(string $contentType): Header
    {
        return $this->setHeader(Header::CONTENT_TYPE, $contentType);
    }

    public function getHeader(string $name): mixed
    {
        return $this->headers[$name] ?? null;
    }

    public function setHeader(string $name, mixed $value): Header
    {
        if (!is_null($value)) $this->headers[$name] = $value;
        return $this;
    }

    public function jsonSerialize(): array
    {
        return $this->headers;
    }
}