<?php
declare(strict_types=1);

namespace framework\jose;

/**
 * Jwt 接口定义了 JWT（JSON Web Tokens）的基本结构和功能。
 * JWT 是一种开放的标准，用于在网络上安全地传输信息。
 */
interface Jwt
{
    /**
     * 获取 JWT 的头部信息。
     *
     * 头部通常包含用于处理 JWT 的元数据，如算法类型。
     *
     * @return Header JWT 的头部信息。
     */
    public function getHeader(): Header;

    /**
     * 获取 JWT 的载荷（Payload）。
     *
     * 载荷包含了实际要传输的信息，以及其他可选的元数据，如过期时间、发行人等。
     *
     * @return Claims JWT 的载荷信息。
     */
    public function getPayload(): Claims;
}