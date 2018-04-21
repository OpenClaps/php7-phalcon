<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class User extends Model
{
    /**
     * Connect with data source and get user email address
     * @param void
     * @return {array} $result
     */
    public function email()
    {
        $result = array (
            'name' => 'TestName',
            'email' => 'test@test.com'
        );
        return $result;
    }
    
    public static function edit(){
        
        // var_dump("DSf");
        // die();
        // $result = array (
        //     'static' => 'TestName'
        // );
        return $result;
    }

}
