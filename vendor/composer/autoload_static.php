<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5e3abeadf9660997de2d50cc27894df5
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Vis\\SubscribeManager\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Vis\\SubscribeManager\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'SubscribeManagerMigration' => __DIR__ . '/../..' . '/src/Migrations/2017_03_30_124121_subscribe_manager_migration.php',
        'Vis\\SubscribeManager\\SubscribeEntity' => __DIR__ . '/../..' . '/src/Models/SubscribeEntity.php',
        'Vis\\SubscribeManager\\SubscribeManagerController' => __DIR__ . '/../..' . '/src/Http/Controllers/SubscribeManagerController.php',
        'Vis\\SubscribeManager\\Subscriber' => __DIR__ . '/../..' . '/src/Models/Subscriber.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5e3abeadf9660997de2d50cc27894df5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5e3abeadf9660997de2d50cc27894df5::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5e3abeadf9660997de2d50cc27894df5::$classMap;

        }, null, ClassLoader::class);
    }
}
