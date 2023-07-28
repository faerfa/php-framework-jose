<?php
declare(strict_types=1);

namespace framework\jose;

use framework\jose\impl\BuilderImpl;
use framework\jose\impl\ParserImpl;

/**
 * Jose 类，提供了构建和解析 JWT 的静态方法
 */
class Jose
{
    /**
     * JWT 的分隔符
     */
    public const SEPARATOR_CHAR = ".";

    /**
     * 创建并返回一个 JWT 构建者
     *
     * @return Builder 一个 BuilderImpl 对象实例
     */
    public static function builder(): Builder
    {
        return new BuilderImpl();
    }

    /**
     * 创建并返回一个 JWT 解析器
     *
     * @return Parser 一个 ParserImpl 对象实例
     */
    public static function parser(): Parser
    {
        return new ParserImpl();
    }
}