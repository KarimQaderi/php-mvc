<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit179df87f4e2ff52abfb688593434c336
{
    public static $files = array (
        '437c42e15993211e19220ce4ccd054c1' => __DIR__ . '/../..' . '/App/helper.php',
    );

    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit179df87f4e2ff52abfb688593434c336::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit179df87f4e2ff52abfb688593434c336::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
