<?php
/**
 * All following dependency injections are perfomed
 * in this file
 * @package: config
 * @author : Vijay Bose <vbose@apple.com>
 * @date: March 14, 2018
 */
 use Phalcon\Loader;
 use Phalcon\Logger\Multiple as MultipleStream;
 use Phalcon\Logger\Adapter\Stream as StreamAdapter;
 use Phalcon\Mvc\Micro\Collection;

  $di = \Phalcon\DI\FactoryDefault::getDefault();
  $config = $di->get('config');

  /**
  * ########################################################
  * Invoke logging for application add to DI container for
  * application level access
  * Levels:
  * critical
  * emergency
  * debug
  * error
  * info
  * notice
  * warning
  * alert
  * ########################################################
  */
    $di->set(
        "logger",
        function () {
            $logger = new MultipleStream();
            $logger->push(
                new StreamAdapter('php://stdout')
            );
            return $logger;
        }
    );
/**
 * ########################################################
 *  Model invoking and injection using binder is performed
 *  in the below session
 * ########################################################
 */
$loader = new Loader();
// Register some namespaces
$loader->registerNamespaces(
	[
		'App\Models' =>  APPLICATION_PATH.'models',
		'App\Controllers' =>  APPLICATION_PATH.'controllers',
	]
);

$loader->registerDirs(
    array(
        APPLICATION_PATH . 'models/',
        APPLICATION_PATH . 'controllers/'
    ));

 //register autoloader
 $loader->register();

// var_dump($loader);

/**
 * ########################################################
 *  Middleware injection are performed in the below session
 * ########################################################
 */
// $app->after(
//     function () use ($app) {
//         $response = new \Phalcon\Http\Response();
//         $response->setStatusCode(200);
//         $response->setJsonContent(
//           array(
//           'error'=>array(
//               'code' => 200,
//               'message' => 'Success hi hi'
//             )
//           )
//         );
//         return $response;
//     }
// );

/**
 * ##########################################################
 *  All data source connections performed in the below session
 * ##########################################################
 */
$di->set('collectionManager', function () {
    return new \Phalcon\Mvc\Collection\Manager();
}, true);
// Mysql database
$di->set('MysqlDB', function () use ($config) {
$conn = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        "host"     => $config->resource->mysql->db->host,
        "username" => $config->resource->mysql->db->username,
        "password" => $config->resource->mysql->db->password,
        "dbname"   => $config->resource->mysql->db->dbname,
        "port"     => $config->resource->mysql->db->port,
        "options"  => array(
            PDO::ATTR_AUTOCOMMIT => 0
        )
    ));
    return $conn;
});
//MongoDB Database
$di->set('MongoDB', function () use ($config) {
    $mongo = null;
    try {
        $mongoParams = $config->resource->mongo->db;
        if (empty($mongoParams->username) OR empty($mongoParams->password)) {
            $mongo = new MongoDB\Driver\Manager('mongodb://' . $mongoParams->host);
        } else {
            $mongo = new MongoDB\Driver\Manager("mongodb://" . $mongoParams->username . ":" . $mongoParams->password . "@" . $mongoParams->host, array("db" => $mongoParams->dbname));
        }
    } catch (MongoDB\Driver\Exception\Exception $e) {
        $logger = $di->get('logger');
        $logger->error("Mongo Connection failed with : ". $e->getMessage());
    }
    return $mongo;
}, TRUE);

$di->set('Redis', function () use ($config) {
    //@todo: Need to add exception handler for redis adapter
    $redisParams = $config->resource->redis->db;
    $redis = new Redis(); 
    $redis->connect($redisParams->host, $redisParams->port); 
    return $redis;
});

// $di->set(
//     "view",
//     function () {
//         $view = new View();
//         // Disable several levels
//         $view->disableLevel(
//             [
//                 View::LEVEL_NO_RENDER => true
//             ]
//         );

//         return $view;
//     },
//     true
// );
