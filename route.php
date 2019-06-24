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

Route::post("/account/signin","AuthController::signin");
Route::post("/account/signup","AuthController::signup");

Route::get("/account/success/w/verify","AuthController::verify");

# App Routes [User Dashboard]
Route::get("/user/blank","UserController::blank");

Route::get("/user/dashboard","UserController::dashboard");
Route::get("/user/compose","UserController::compose");
