<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'          => array(__DIR__.'/../vendor/symfony/src', __DIR__.'/../vendor/bundles'),
    'Sensio'           => __DIR__.'/../vendor/bundles',
    'JMS'              => __DIR__.'/../vendor/bundles',
    'Doctrine\\Common' => __DIR__.'/../vendor/doctrine-common/lib',
    'Doctrine\\DBAL'   => __DIR__.'/../vendor/doctrine-dbal/lib',
    'Doctrine'         => __DIR__.'/../vendor/doctrine/lib',
    'Monolog'          => __DIR__.'/../vendor/monolog/src',
    'Assetic'          => __DIR__.'/../vendor/assetic/src',
    'Metadata'         => __DIR__.'/../vendor/metadata/src',
    'Sonata'          => array(
        __DIR__ .'/../vendor/bundles',
        __DIR__.'/../vendor/sonata-doctrine-extensions/src',
    ),
    'PhpAmqpLib'       => __DIR__.'/../vendor/php-amqplib',
    'Exporter'         => __DIR__.'/../vendor/exporter/lib',
    'Knp\Bundle'       => __DIR__.'/../vendor/bundles',
    'Knp\Menu'         => __DIR__.'/../vendor/knp/menu/src',
    'SimpleThings'     => __DIR__.'/../vendor/bundles',
    'FOS'              => __DIR__.'/../vendor/bundles',
    'EWZ'              => __DIR__.'/../vendor/bundles',
    'SamJ'             => __DIR__.'/../vendor/DoctrineSluggableBundle/src',
    'Application'      => __DIR__,
));
$loader->registerPrefixes(array(
    'Twig_Extensions_' => __DIR__.'/../vendor/twig-extensions/lib',
    'Twig_'            => __DIR__.'/../vendor/twig/lib',
));

// intl
if (!function_exists('intl_get_error_code')) {
    require_once __DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs/functions.php';

    $loader->registerPrefixFallbacks(array(__DIR__.'/../vendor/symfony/src/Symfony/Component/Locale/Resources/stubs'));
}

$loader->registerNamespaceFallbacks(array(
    __DIR__.'/../src',
));
$loader->register();

AnnotationRegistry::registerLoader(function($class) use ($loader) {
    $loader->loadClass($class);
    return class_exists($class, false);
});
AnnotationRegistry::registerFile(__DIR__.'/../vendor/doctrine/lib/Doctrine/ORM/Mapping/Driver/DoctrineAnnotations.php');

require __DIR__.'/../vendor/swiftmailer/lib/swift_required.php';
