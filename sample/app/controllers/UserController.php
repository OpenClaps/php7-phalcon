<?php
require_once("baseController.php");

class UserController extends BaseController
{

    public function indexAction() {
        echo 'Hi in user Index'; 
        // die;
        $result = array(
            'key' => 123,
            'value' => 'test value'
        );
        $this->view->data = $result;
    }

    public function profileAction() {
        die("In Test Action");
    }
}
