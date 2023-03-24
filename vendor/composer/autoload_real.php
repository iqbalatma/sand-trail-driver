<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitc4342c3ae77f90d0ca56d5171f18ec03
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

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitc4342c3ae77f90d0ca56d5171f18ec03', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitc4342c3ae77f90d0ca56d5171f18ec03', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitc4342c3ae77f90d0ca56d5171f18ec03::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
