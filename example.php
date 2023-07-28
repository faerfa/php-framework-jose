<?php
declare(strict_types=1);

use framework\jose\Jose;
use framework\jose\JoseException;
use framework\jose\SignatureAlgorithm;

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $filePath = sprintf("%s%s.php", __DIR__ . DIRECTORY_SEPARATOR, str_replace("framework/jose/", "src/", $class));
    if (is_readable($filePath)) {
        require_once $filePath;
        if (class_exists($class)) {
            return true;
        }
    }
    return false;
});


try {
    $builder = Jose::builder()
        ->signWith(SignatureAlgorithm::HS256, "123")
        ->setClaim("name", "test")
        ->setExpirationTime((new DateTime())->modify("+ 1 day"))
        ->compact();
    var_dump($builder);

    $parse = Jose::parser()
        ->setSecret("123")
        ->parse($builder);
    var_dump($parse);
    var_dump($parse->getPayload()->getClaim("name"));
} catch (JoseException $exception) {
    var_dump($exception->getMessage());
}



