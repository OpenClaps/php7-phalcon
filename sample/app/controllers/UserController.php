<?php
// namespace App\Controllers;

use Phalcon\Mvc\Controller;

class UserController extends Controller
{
    public function indexAction(){
        // echo 'Hi in Index'; die;
        return array(
            'key' => 123,
            'value' => 'test value'
        );
    }

    public function profileAction()
    {
        die("In Test Action");
    }
}
