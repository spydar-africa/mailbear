<?php

/** 
 * @create all routes here 
 * @using the mapRoute method from the Route Class
 * @param "type=array()"
 * @properties = url, method, action | type="string"
 * @example 
 * Route::mapRoute([
 *      "url" => "/",
 *      "method" => "get",
 *      "action" => "BaseController::index"
 * ]);
 * # Creating a route with parameter
 * Route::mapRoute([
 *      "url" => "/profile/{id:int}",
 *      "method" => "get",
 *      "action" => "BaseController::index"
 * ]);
 * 
 * # using method function
 * Route::get("/admin", "AdminController::create_template");
 * Route::post("/admin", "AdminController::create_template");
 * */

Route::get("/", "BaseController::index");
Route::get("/index", "BaseController::index");
Route::get("/about", "BaseController::about");
Route::get("/pricing", "BaseController::pricing");
Route::get("/faq", "BaseController::faq");
Route::get("/contact", "BaseController::contact");


# Auth Routes 
Route::get("/account/signin","AuthController::signin");
Route::get("/account/signup","AuthController::signup");

# App Routes [User Dashboard]
Route::get("/user/blank","UserController::blank");

Route::get("/op",function(){
    return view("AccountSetup/index");
});

Route::get("/aboutbusiness",function(){
    return view("AccountSetup/aboutyourbusiness");
});

Route::get("/inputaddress",function(){
    return view("AccountSetup/address");
});

Route::get("/subscribers",function(){
    return view("AccountSetup/subscribers");
});

Route::get("/connectyoursm",function(){
    return view("AccountSetup/connectyoursm");
});

Route::get("/marketingpath",function(){
    return view("AccountSetup/marketingpath");
});

Route::get("/finalizingsetup",function(){
    return view("AccountSetup/finalsetup");
});