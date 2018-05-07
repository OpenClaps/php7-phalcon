<?php
/**
 * Reference :https://olddocs.phalconphp.com/en/3.0.0/reference/micro.html
 * 
 * Set application base path, get application config object and i
 * load Micro app. Application specific module load is performed 
 * under "config/initializer" module
 * 
 * Load following components 
 * 1. Models, load models for application business logic
 * 2. Adapter, Common place for creating connection with DB,Cache and so on
 * 3. Router, for request routing
 * 
 * @package: Example Micro service
 * @author : Vijay Bose <vbose@apple.com>
 * @date: March 14, 2018
 */
use Phalcon\Di\FactoryDefault;
use Phalcon\Config\Adapter\Ini as IniConfig;
// use Phalcon\Mvc\Micro;
use Phalcon\Mvc\Application;


//Define Application Path
define("APPLICATION_PATH",__DIR__.DIRECTORY_SEPARATOR);
//Loading config
$di = new FactoryDefault();
$di->set(
  "config",
  function () {
      return new IniConfig(APPLICATION_PATH.'config'.DIRECTORY_SEPARATOR.'application.ini');
  }
);
$app = new Application($di);
//Load Dependency Injection and router
require_once(APPLICATION_PATH.'config'.DIRECTORY_SEPARATOR.'di.php');
require_once(APPLICATION_PATH.'config'.DIRECTORY_SEPARATOR.'router.php');
$app->handle();