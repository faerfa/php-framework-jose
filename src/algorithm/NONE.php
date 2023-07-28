<?php
declare(strict_types=1);

namespace framework\jose\algorithm;

use framework\jose\Algorithm;

class NONE implements Algorithm
{

    public function sign(string $data, string $secret): string
    {
        return "";
    }

    public function verify(string $data, string $signature, string $secret): bool
    {
        return true;
    }
}