<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdea7b8f20a51ccf89351b2f5fbcb5f72
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tasks\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tasks\\' => 
        array (
            0 => __DIR__ . '/../..' . '/DbClass',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdea7b8f20a51ccf89351b2f5fbcb5f72::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdea7b8f20a51ccf89351b2f5fbcb5f72::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}