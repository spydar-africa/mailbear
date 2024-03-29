<?php

/** 
 * creating a model class
 * it must extends the schema class
 * in order to use the dboperation methods in 
 * the model class
 * @example creating a model
 * class User extends Schema{
 *  #state the table name in the public $table variable
 *  #the model structure should be design 
 *  #and assign to the public $model variable
 * }
 * */ 

use App\Core\Database\Schema;

class User extends Schema{

    public $table = 'users';

    private $user_id;
    private $firstname;
    private $lastname;
    private $email;
    private $username;
    private $password;


    public $model = array(
        'user_id' => 'textid',
        'firstname' => 'string',
        'lastname' => 'string',
        'email' => 'email',
        'username'=> 'uniquestring',
        "address" => "text",
        "city" => "string",
        "state" => "string",
        "country" => "string",
        "zipCode" => "int",
        'password' => 'string',
        "status" => "string",
        "verification" => "string",
    );

    public function gen_id(){

        $start = uniqid();
        $rand = rand(23456, 98125);
        $end = uniqid();
        return $start.$rand.$end;

    }

    public function set_password($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function confirm_password($password, $hash){
        return password_verify($password, $hash);
    }
}