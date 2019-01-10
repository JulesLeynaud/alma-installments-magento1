<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5e5a256ea54a8f8e39b38741f33a2cf9
{
    public static $files = array (
        '225ac4f132a892d5909550111fa3a942' => __DIR__ . '/..' . '/alma/alma-php-client/src/lib/array.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'A' => 
        array (
            'Alma\\API\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Alma\\API\\' => 
        array (
            0 => __DIR__ . '/..' . '/alma/alma-php-client/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5e5a256ea54a8f8e39b38741f33a2cf9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5e5a256ea54a8f8e39b38741f33a2cf9::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
