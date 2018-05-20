<?php
/**
 * Routing for the application is performed in this file.
 * All request will consume models directly and perform
 * business logic for consolidating micro services with 
 * minimal implementation. All data modeling and mapping 
 * for response in JSON/XML should be performed in model.
 * @package: config
 * @author : Vijay Bose 
 * @date: March 14, 2018
 */

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;

$di = \Phalcon\DI\FactoryDefault::getDefault();
$version = $di->get('config')->app->version;
$logger = $di->get('logger');

$router = new Router();
$router->setDI($di);


// list of routes
$userController = new \App\Controllers\UserController();
$app->get(
    "/user/index",
    [
        $userController,
        "indexAction"
    ]
);

$app->get(
    "/user/profile/{name}",
    [
        $userController,
        "profileAction"
    ]
);

$router->handle();

// //@todo: Need to update routing with controller pattern
// $app->get(
//   '/user/profile/{name}',
//   function ($name) use ($di) {
//     //Test connection MongoDB
//     $mongoAdapter = $di->get('MongoDB');
//     $stats = new MongoDB\Driver\Command(["dbstats" => 1]);
//     $res = $mongoAdapter->executeCommand("testdb", $stats);
//     $stats = current($res->toArray());
//     //Test connection with redis
//     $redisAdapter = $di->get('Redis');
//      //Create a response instance
//      $response = new \Phalcon\Http\Response();
//      //Set the content of the response
//      $response->setJsonContent(
//        array(
//        'data'=>array(
//            "user" => $name,
//            "Connected DB for Mongo" => $stats->db,
//            "What is ping for redis" => $redisAdapter->ping()
//          )
//        )
//      );
//      //Return the response
//      return $response;      
//   }
// );

// $router->handle();

// Handel application wide router errors
// $app->error(
//   function ($exception) use ($logger) {

// 	echo "HERE.. .";
//     //Log error
//     $logger->error("Router fail with: ". $exception->getMessage());
//     //404 request not found
//     if($exception->getCode() == 0){
//       //Create a response instance
//       $response = new \Phalcon\Http\Response();
//       $response->setStatusCode(404);
//       //Set the content of the response
//       $response->setJsonContent(
//         array(
//         'error'=>array(
//             'code' => 404,
//             // 'message' => 'No data found'
//             'message' => $exception->getMessage() . "<br><br>".  $exception->getTraceAsString()
//           )
//         )
//       );
//       //Return the response
//       return $response;
//     }
//   }
// );

$app->notFound(function () use ($app) {

	var_dump($app->router->getRoutes());
    $app->response->setStatusCode(404, "Not Found")->sendHeaders();
    echo 'This is crazy, but this page was not found!';
});

