<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit5ae72362150c0b1a3fc0eace96900c1f
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit5ae72362150c0b1a3fc0eace96900c1f', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit5ae72362150c0b1a3fc0eace96900c1f', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit5ae72362150c0b1a3fc0eace96900c1f::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}