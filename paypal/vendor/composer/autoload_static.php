<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5b4f16d65bc093c544cc4996365fcd1a
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PayPal' => 
            array (
                0 => __DIR__ . '/..' . '/paypal/rest-api-sdk-php/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5b4f16d65bc093c544cc4996365fcd1a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5b4f16d65bc093c544cc4996365fcd1a::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit5b4f16d65bc093c544cc4996365fcd1a::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}