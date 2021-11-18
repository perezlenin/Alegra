<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcd618859bd45f331bed4c9353b263d15
{
    public static $files = array (
        'f88f8987adfe3f7cf9978fa9a9d148bc' => __DIR__ . '/..' . '/workerman/psr7/src/functions_include.php',
    );

    public static $prefixLengthsPsr4 = array (
        'W' => 
        array (
            'Workerman\\Psr7\\' => 15,
            'Workerman\\MySQL\\' => 16,
            'Workerman\\Http\\' => 15,
            'Workerman\\' => 10,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Workerman\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/workerman/psr7/src',
        ),
        'Workerman\\MySQL\\' => 
        array (
            0 => __DIR__ . '/..' . '/workerman/mysql/src',
        ),
        'Workerman\\Http\\' => 
        array (
            0 => __DIR__ . '/..' . '/workerman/http-client/src',
        ),
        'Workerman\\' => 
        array (
            0 => __DIR__ . '/..' . '/workerman/workerman',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcd618859bd45f331bed4c9353b263d15::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcd618859bd45f331bed4c9353b263d15::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcd618859bd45f331bed4c9353b263d15::$classMap;

        }, null, ClassLoader::class);
    }
}