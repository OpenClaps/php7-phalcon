<?php

namespace App\Controllers;

require_once("BaseController.php");

class UserController extends BaseController 
{
    public function indexAction() {
        echo 'Hi in user Index 12323';
    }

    public function profileAction() {
        die("In profileAction 11111");
    }
}
