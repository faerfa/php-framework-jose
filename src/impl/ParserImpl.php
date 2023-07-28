<?php
declare(strict_types=1);

namespace framework\jose\impl;

use DateTime;
use framework\jose\Header;
use framework\jose\Jose;
use framework\jose\JoseException;
use framework\jose\Jws;
use framework\jose\Jwt;
use framework\jose\Parser;

/**
 * ParserImpl 是一种实现了 Parser 接口的 JWT 和 JWS 解析器。
 * 它可以解析和验证 JWT 和 JWS 令牌，并返回一个 Jwt 或 Jws 对象，
 * 该对象包含了令牌的头部 (Header) 和声明 (Claims)。
 */
class ParserImpl implements Parser
{
    /**
     * 用于签名验证的密钥
     * @var string
     */
    private string $secret = "";

    /**
     * 设置用于签名验证的密钥
     * @param string $secret 密钥字符串
     * @return Parser
     */
    public function setSecret(string $secret): Parser
    {
        $this->secret = $secret;
        return $this;
    }

    /**
     * 解析并验证 JWT 或 JWS 令牌
     * @param string $compact JWT 或 JWS 令牌
     * @return Jwt|Jws 返回解析后的 JWT 或 JWS 对象
     * @throws JoseException 如果令牌解析或验证失败，则抛出异常
     */
    public function parse(string $compact): Jwt|Jws
    {
        [$headerEncoded, $payloadEncoded, $signatureEncoded] = explode(Jose::SEPARATOR_CHAR, $compact);

        if (!isset($headerEncoded) || !isset($payloadEncoded) || !isset($signatureEncoded)) {
            throw new JoseException("Incomplete JWT or JWS", JoseException::INVALID_SIGNATURE);
        }

        $headers = json_decode($this->base64UrlDecode($headerEncoded), true);
        if (json_last_error() != JSON_ERROR_NONE) {
            throw new JoseException("Failed to parse JSON in header", JoseException::INVALID_SIGNATURE);
        }

        $header = match ($headers["typ"] ?? "") {
            Header::TYPE_JWT => new JwtHeaderImpl(),
            Header::TYPE_JWS => new JwsHeaderImpl(),
            default => throw new JoseException("Unsupported header type", JoseException::INVALID_SIGNATURE)
        };

        foreach ($headers as $name => $value) {
            $header->setHeader($name, $value);
        }

        if ($header->getType() == Header::TYPE_JWS) {
            $data = $headerEncoded . Jose::SEPARATOR_CHAR . $payloadEncoded;
            $signature = $this->base64UrlDecode($signatureEncoded);
            if (!$header->getAlgorithm()->verify($data, $signature, $this->secret)) {
                throw new JoseException("Signature invalid", JoseException::INVALID_SIGNATURE);
            }
        }

        $payloads = json_decode($this->base64UrlDecode($payloadEncoded), true);
        if (json_last_error() != JSON_ERROR_NONE) {
            throw new JoseException("Failed to parse JSON in payload", JoseException::INVALID_SIGNATURE);
        }

        $claims = new ClaimsImpl();
        foreach ($payloads as $name => $value) {
            $claims->setClaim($name, $value);
        }

        if (!is_null($claims->getExpirationTime())) {
            if (new DateTime() > $claims->getExpirationTime()) {
                throw new JoseException("Token has expired", JoseException::TOKEN_EXPIRED);
            }
        }

        if (!is_null($claims->getNotBefore())) {
            if (new DateTime() < $claims->getNotBefore()) {
                throw new JoseException("Token is not yet valid", JoseException::TOKEN_NOT_YET_VALID);
            }
        }

        return match ($header->getType()) {
            Header::TYPE_JWT => new JwtImpl($header, $claims),
            Header::TYPE_JWS => new JwsImpl($header, $claims, $signatureEncoded)
        };
    }

    /**
     * 将字符串从 base64 URL 安全编码格式转换为原始字符串
     * @param string $string 需要解码的 base64 URL 安全编码字符串
     * @return string 返回解码后的原始字符串
     */
    private function base64UrlDecode(string $string): string
    {
        return base64_decode(str_replace(array('-', '_'), array('+', '/'), $string));
    }

}