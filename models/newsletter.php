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

class Newsletter extends Schema{

    public $table = 'newsletters';

    public $model = array(
        "sn" => "sn",
        "user_id" => "string",
        "emails" => "email",
    );

}