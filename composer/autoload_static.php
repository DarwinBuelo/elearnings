<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6b4e539b0c24260a6df24b073271d626
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6b4e539b0c24260a6df24b073271d626::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6b4e539b0c24260a6df24b073271d626::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}