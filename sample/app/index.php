<?php
use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Http\Response;
use Phalcon\Mvc\Url;

// Use Loader() to autoload our model
$loader = new Loader();

$loader->registerNamespaces(
    [
        'Store\Toys' => __DIR__ . '/models/',
    ]
);
$loader->register();
$di = new FactoryDefault();
$url = new Url();

// Setting a relative base URI
$url->setBaseUri("/supporting-app/tools/");

$app = new Micro($di);

// Define the routes here

// Retrieves all robots
$app->get(
    '/api/robots',
    function () {
        // Operation to fetch all the robots
        $robots = new \Store\Toys\Robots(); 
        // Create a response
        $response = new Response();
        $response->setJsonContent(
            [
                'status' => 'success',
                'data'   => $robots->getAll()
            ]
        );
        return $response;
    }
);

$app->handle();