<?php

use App\Helpers\Fs;
use App\Action\Urls\Controller;
use App\Action\Urls\view;
use App\Core\Engine\Router\Request;

# Create all action method in the Controller class
# all method from the must must return
# either a view or a content
/** 
 * @param 'optional' [Request $req]
 * # used when an action is used on a post request
 * @example creating an action method
 * public function index(){
 * @param 'filename' in the views folder
 *     return view("index");
 * }
 * */ 

class ContactUs extends Controller {

    public function contactus($request){

        if (isset ($_POST['submit'])){

            $firstname = $request->firstname;
            $lastname = $reques->lastname];
            $mobile = $request->mobile;
            $email = $request->email;
            $message = $request->message;

        }
        return view("auth/thankyou");
    }
    
}



