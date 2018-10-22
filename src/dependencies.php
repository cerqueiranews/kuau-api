<?php

use Atlas\Orm\AtlasBuilder;

// DIC configuration
$container = $app->getContainer();

$container['upload_directory'] = __DIR__ . '/../public/uploads';
$container['webdir_upload'] = '/uploads/';

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// atlas
$container['atlas'] = function ($container) {
    $args = $container['settings']['atlas']['pdo'];
    $atlasBuilder = new AtlasBuilder(...$args);
    $atlasBuilder->setFactory(function ($class) use ($container) {
        if ($container->has($class)) {
            return $container->get($class);
        }

        return new $class();
    });
    return $atlasBuilder->newAtlas();
};
