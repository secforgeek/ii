<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit39133159b975f0aebac7317469d55d77
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit39133159b975f0aebac7317469d55d77::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit39133159b975f0aebac7317469d55d77::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}