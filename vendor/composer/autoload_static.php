<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit06e89df0fc30f36904a0034a45c44853
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Braintree\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Braintree\\' => 
        array (
            0 => __DIR__ . '/..' . '/braintree/braintree_php/lib/Braintree',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit06e89df0fc30f36904a0034a45c44853::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit06e89df0fc30f36904a0034a45c44853::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
