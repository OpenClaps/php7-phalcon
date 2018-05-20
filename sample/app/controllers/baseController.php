<?php
namespace App\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class BaseController extends Controller
{
    public function afterExecuteRoute(\Phalcon\Mvc\Dispatcher $dispatcher) {
        $this->view->disable();
        $data = $this->view->getParamsToView();
        $this->response->setContentType('application/json', 'utf-8');
        if(!empty($data)){
            $this->response->setStatusCode(200)
                ->setContent(json_encode($data));;
        } else {
            $this->response->setStatusCode(404);            
        }
        // var_dump($this->response->getContent()); die;
        return $this->response->send();
    }

}
