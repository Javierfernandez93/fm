<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitedacdef1aab20a4660a295e080fdf993
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'M' => 
        array (
            'M3uParser\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'M3uParser\\' => 
        array (
            0 => __DIR__ . '/..' . '/gemorroj/m3u-parser/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitedacdef1aab20a4660a295e080fdf993::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitedacdef1aab20a4660a295e080fdf993::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitedacdef1aab20a4660a295e080fdf993::$classMap;

        }, null, ClassLoader::class);
    }
}
