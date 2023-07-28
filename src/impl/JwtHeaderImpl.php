<?php
declare(strict_types=1);

namespace framework\jose\impl;

use framework\jose\Header;

/**
 * JWT Header 的实现类
 *
 * 这个类继承自 `HeaderImpl`，并在构造函数中自动设置了 Header 的类型（'typ'）为 'JWT'。
 */
class JwtHeaderImpl extends HeaderImpl
{
    /**
     * 构造函数
     *
     * 在创建 `JwtHeaderImpl` 类的实例时，自动将 Header 的类型（'typ'）设置为 'JWT'。
     */
    public function __construct()
    {
        $this->setType(Header::TYPE_JWT);
    }
}