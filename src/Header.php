<?php
declare(strict_types=1);

namespace framework\jose;

/**
 * JWT Header 接口
 *
 * 该接口定义了 JWT Header 的结构，依据的是 RFC 7519 - JSON Web Token (JWT) 标准。
 * 它包含了获取和设置 JWT Header 中 'typ', 'cty' 和自定义字段的方法。
 *
 * 'typ' (Type) Header 参数：定义了 JWT 的类型。常见的值有 "JWT" 和 "JWS"。
 * 'cty' (Content Type) Header 参数：JWT 应用使用它来声明整个 JWT 的媒体类型。
 *
 * 此外，接口提供了设置和获取自定义字段的方法，这些可以是任何未由标准定义的任意数据。
 *
 * @link https://datatracker.ietf.org/doc/html/rfc7519#section-5
 */
interface Header
{
    /**
     * 'typ' (Type) Header 参数标识符
     */
    public const TYPE = "typ";

    /**
     * 'typ' 的 JSON Web Token 值
     */
    public const TYPE_JWT = "JWT";

    /**
     * 'typ' 的 JSON Web Signature 值
     */
    public const TYPE_JWS = "JWS";

    /**
     * 'cty' (Content Type) Header 参数标识符
     */
    public const CONTENT_TYPE = "cty";

    /**
     * 获取 'typ' (Type) Header 参数的方法。
     *
     * @return string 返回 Header 中 'typ' 参数的值
     */
    public function getType(): string;

    /**
     * 设置 'typ' (Type) Header 参数的方法。
     *
     * @param string $type 要设置的 'typ' 参数的值
     * @return Header 返回 JWT Header 的实例
     */
    public function setType(string $type): Header;

    /**
     * 获取 'cty' (Content Type) Header 参数的方法。
     *
     * @return string 返回 Header 中 'cty' 参数的值
     */
    public function getContentType(): string;

    /**
     * 设置 'cty' (Content Type) Header 参数的方法。
     *
     * @param string $contentType 要设置的 'cty' 参数的值
     * @return Header 返回 JWT Header 的实例
     */
    public function setContentType(string $contentType): Header;

    /**
     * 获取自定义 Header 参数的方法。
     *
     * @param string $name 要获取的自定义 Header 参数的名称
     * @return mixed 返回自定义 Header 参数的值
     */
    public function getHeader(string $name): mixed;

    /**
     * 设置自定义 Header 参数的方法。
     *
     * @param string $name 要设置的自定义 Header 参数的名称
     * @param mixed $value 要设置的自定义 Header 参数的值
     * @return Header 返回 JWT Header 的实例
     */
    public function setHeader(string $name, mixed $value): Header;
}