<?php
declare(strict_types=1);

namespace framework\jose\impl;

use framework\jose\Header;
use framework\jose\JwsHeader;
use framework\jose\SignatureAlgorithm;

/**
 * JwsHeaderImpl 是 JwsHeader 接口的具体实现类，用于处理 JWT 的 JWS 头部信息。
 * 它包含了获取和设置签名算法的方法。
 */
class JwsHeaderImpl extends HeaderImpl implements JwsHeader
{
    public function __construct()
    {
        $this->setType(Header::TYPE_JWS);
    }

    public function getAlgorithm(): SignatureAlgorithm
    {
        return SignatureAlgorithm::from($this->getHeader(JwsHeader::ALGORITHM));
    }

    public function setAlgorithm(SignatureAlgorithm $algorithm): JwsHeader
    {
        $this->setHeader(JwsHeader::ALGORITHM, $algorithm->name);
        return $this;
    }
}