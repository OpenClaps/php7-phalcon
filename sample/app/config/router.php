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
$router = new Router();
$router->setDI($di);

$version = $di->get('config')->app->version;
$logger = $di->get('logger');

$router->add('/{controller:[\w\-]+}/?{action:[\w\-]*}{params:/?.*}');
// $di->set('dispatcher', function() use ($di) {
//   //Create an EventsManager
//   $eventsManager = new Phalcon\Events\Manager();
//   $dispatcher = new Phalcon\Mvc\Dispatcher();  
//   $dispatcher->setEventsManager($eventsManager);	
//   $eventsManager->attach("dispatch:afterDispatchLoop", function($event, $dispatcher) use ($di) {
// 		// $response = $di->getResponse();
// 		$di->getResponse()->setHeader("Content-Type", "text/plain");
// 		// $result = $dispatcher->getReturnedValue();
// 		$di->getResponse()->setStatusCode(200);
// 		$di->getResponse()->setContent("asdfadsf");
// 		var_dump($di->getResponse()->getContent());
// 		die();
// 		$di->getResponse()->send();
// 	});
//   return $dispatcher;
// });



	// return $response;
	// var_dump($response);
	// die();
	// $response = new \Phalcon\Http\Response();
	// $response->setStatusCode(200);
	//Set the content of the response
	// $response->setJsonContent(array('data' => $result));

	// if ($response instanceof ResponseInterface) {
	// 	die("ASDf");
    // 	// Send the response
    // 	$response->send();
	// }

	// echo $response;
	//Return the response
	// print_r($response, 1);
	// var_dump($response);
	// die();
	// $response->send();
	// var_dump($response);
		// //Possible controller class name
		// $controllerName = Phalcon\Text::camelize($dispatcher->getControllerName()) . 'Controller';
		// //Possible method name
		// $actionName = $dispatcher->getActionName() . 'Action';

		// if (($controllerName === 'IndexController') && ($actionName === 'createAction')) {
		//     $dispatcher->setParams(array($di['request']->getPost()));
		// }

  // die("ASFD");


  

  // $eventsManager->attach("dispatch:beforeDispatchLoop", function($event, $dispatcher) use ($di) {
  //     //Possible controller class name
  //     $controllerName = Phalcon\Text::camelize($dispatcher->getControllerName()) . 'Controller';
  //     //Possible method name
  //     $actionName = $dispatcher->getActionName() . 'Action';

  //     if (($controllerName === 'IndexController') && ($actionName === 'createAction')) {
  //         $dispatcher->setParams(array($di['request']->getPost()));
  //     }
  // });


// $router->add("/forum/:controller/:action/:params", array(
//   'controller' => 1,
//   'action' => 2,
//   'params' => 3
// ));

// $router->add("/forum/:controller", array(
//   'controller' => 1   
// ));

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

// // Handel application wide router errors
// $app->error(
//   function ($exception) use ($logger) {
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
//             'message' => $exception->getMessage()
//           )
//         )
//       );
//       //Return the response
//       return $response;
//     }
//   }
// );

