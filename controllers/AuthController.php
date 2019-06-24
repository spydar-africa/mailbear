<?php

use App\Helpers\Fs;
use App\Helpers\Mailer;
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

class AuthController extends Controller {

    public function signup($request){

        if($request->method == "POST"){
            $username = $request->username;
            $email = $request->email;

            # check user 
            $userModel = new User;
            $checkEmail = $userModel->select()->where(["email"=>$email]);
            $checkUsername = $userModel->select()->where(["username"=>$username]);

            if($checkEmail || $checkUsername){
                return view("auth/signup",["error"=>true,"emailExist"=>$checkEmail,"usernameExists"=>$checkUsername]);
            }

            # create new user 
            $password = $userModel->set_password($request->password);
            $newUserId = $userModel->gen_id();
            $new = $userModel->insert(["user_id"=>$newUserId,"email"=>$email,"username"=>$username,"password"=>$password]);

            if($new) {
                #sending verification email

                $mailer = new Mailer();

                $from = $mailer->sender("Mailbear", "<no-reply@mailbear.com>");
                $receiver = $mailer->receiver($email);
                $subject = $mailer->subject("Mailbear Account Verification");
                $message = $mailer->html("");

                

                #redirect to verification
                return Redirect("/account/success/w/verify");
            }
        }

        return view("auth/signup");
    }
    
    public function signin(){
        return view("auth/signin");
    }

}