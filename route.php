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
Route::post("/contact", "BaseController::contact");

# Auth Routes 
Route::get("/account/signin","AuthController::signin");
Route::get("/account/signup","AuthController::signup");

Route::post("/account/signin","AuthController::signin");
Route::post("/account/signup","AuthController::signup");

Route::get("/account/success/w/verify","AuthController::verify");
Route::get("/account/n/v/","AuthController::verified");

Route::get("/account/n/plan/{userId:string}","AuthController::plan");

Route::get("/account/n/profile/{userId:string}","AuthController::userProfile");
Route::post("/account/n/profile/{userId:string}","AuthController::userProfile");

Route::get("/account/n/company/{userId:string}","AuthController::company");
Route::post("/account/n/company/{userId:string}","AuthController::company");

# /account/n/subscribers/
Route::get("/account/n/subscribers/{userId:string}","AuthController::subscribers");
Route::post("/account/n/subscribers/{userId:string}","AuthController::subscribers");

# App Routes [User Dashboard]
Route::get("/user/blank","UserController::blank");
Route::get("/user/dashboard","UserController::dashboard");
Route::get("/user/compose","UserController::compose");
Route::get("/user/compose/new/blank","UserController::blankMail");

Route::post("/user/mailer/sendmail","UserController::sendmail");

Route::get("/user/contacts","UserController::contacts");
Route::get("/user/contacts/add","UserController::addContacts");
Route::post("/user/contacts/add","UserController::addContacts");
Route::get("/user/contacts/views/{sn:int}","UserController::viewContacts");