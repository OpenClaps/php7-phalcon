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
// use App\Controllers;

$di = \Phalcon\DI\FactoryDefault::getDefault();
$router = new Router();
$router->setDI($di);

$version = $di->get('config')->app->version;
$logger = $di->get('logger');


//@todo: Need to update routing with controller pattern
$app->get(
  '/user/profile/{name}',
  function ($name) use ($di) {
    //Test connection MongoDB
    $mongoAdapter = $di->get('MongoDB');
    $stats = new MongoDB\Driver\Command(["dbstats" => 1]);
    $res = $mongoAdapter->executeCommand("testdb", $stats);
    $stats = current($res->toArray());
    //Test connection with redis
    $redisAdapter = $di->get('Redis');
     //Create a response instance
     $response = new \Phalcon\Http\Response();
     //Set the content of the response
     $response->setJsonContent(
       array(
       'data'=>array(
           "user" => $name,
           "Connected DB for Mongo" => $stats->db,
           "What is ping for redis" => $redisAdapter->ping()
         )
       )
     );
     //Return the response
     return $response;      
  }
);

$router->handle();

// Handel application wide router errors
$app->error(
  function ($exception) use ($logger) {
    //Log error
    $logger->error("Router fail with: ". $exception->getMessage());
    //404 request not found
    if($exception->getCode() == 0){
      //Create a response instance
      $response = new \Phalcon\Http\Response();
      $response->setStatusCode(404);
      //Set the content of the response
      $response->setJsonContent(
        array(
        'error'=>array(
            'code' => 404,
            // 'message' => 'No data found'
            'message' => $exception->getMessage()
          )
        )
      );
      //Return the response
      return $response;
    }
  }
);