<?php

use App\Helpers\Fs;
use App\Admin\Auth;
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
                return view("auth/signup",["error"=>true,"emailExist"=>$checkEmail,"usernameExist"=>$checkUsername]);
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

                $file = "maillayouts/bears/index.html";
                $data = [
                    "username" => $username,
                    "user_id" => $newUserId,
                    "token" => $password
                ];
                $message = $mailer->useFile($file, $data);

                if($mailer->send()){
                    #redirect to verification
                    return Redirect("/account/success/w/verify");
                } 
            }
        }

        return view("auth/signup");
    }
    
    public function signin($request){

        if($request->method == "POST"){
            $email = $request->email;
            $password = $request->password;

            $userModel = new User;

            #check User
            $check = $userModel->select()->where(["email"=>$email]);
            if($check){
                $checkPassword = $userModel->confirm_password($password, $check["password"]);
                if($checkPassword){
                    Auth::login($check);
                    return Redirect("user/dashboard");
                }
                return view("auth/signin",["error"=>["message"=>"incorrect email address or password."]]);
            }
            return view("auth/signin",["error"=>["message"=>"account with this email address is not found."]]);
        }

        return view("auth/signin");
    }

    public function verify(){
        return view("auth/verification");
    }

    public function verified($request){

        if(isset($request->tg)){
            $user_id = $request->tg;

            $userModel = new User;

            $getU = $userModel->select(["verification"])->where(["user_id"=>$user_id]);

            if($getU){
                if($getU["verification"] === "verified"){
                    return Redirect("/account/signin");
                }
            }

            $update = $userModel->update(["status"=>"active","verification"=>"verified"])->where(["user_id"=>$user_id]);
            if($update){
                return view("auth/verification",
                ["message"=>
                    [
                        "title"=>"your account has been verified",
                        "content"=> "your account has been confirmed click the button below to complete account setup."
                    ],
                    "user_id"=>$user_id
                ]);
            }
        }

        return Error404();
    }

    # GET
    public function plan($request){

        if(isset($request->selected)){
            $selected = $request->selected;

            if($selected == "free") {
                $days = "7 days";
            } else if($selected == "standard"){
                $days = "";
            } else if($selected == "premium") {

            }

            $start_date = date("Y-m-d");
            $date=date_create($start_date);
            date_add($date,date_interval_create_from_date_string("14 days"));
            $end_date = date_format($date,"Y-m-d");


            $userS = new UserSetting;




        }
        return view("auth/sub_plans");
    }

    public function userProfile($request){

        if($request->method == "POST"){
            $data = [
                "firstname" => $request->firstname,
                "lastname" => $request->lastname,
                "address" => $request->adline1,
                "city" => $request->city,
                "state" => $request->state,
                "country" => $request->country,
                "zipCode" => $request->zipCode,
            ];

            $userModel = new User;
            $user_id = $request->param["userId"];
            $update = $userModel->update($data)->where(["user_id"=>$user_id]);
            if($update) {
                return Redirect("/account/n/company/".$user_id);
            }
        }

        return view("AccountSetup/address");
    }

    public function company($request){

        if($request->method == "POST") {
            $user_id = $request->param["userId"];
            $company = new Company;

            $companyName = $request->companyName;
            $companyWebsite = "";

            if(isset($request->yesno) && $request->yesno == "true"){
                $companyWebsite = $request->companyWebsite;
            }

            $insert = $company->insert(["user_id"=>$user_id,"companyName"=>$companyName, "website"=>$companyWebsite]);
            if($insert) {
                return Redirect("/account/signup");
                # return Redirect("/account/n/subscribers/".$user_id);
            }

        }

        return view("AccountSetup/aboutyourbusiness");
    }

    public function subscribers($request){
        return view("AccountSetup/subscribers");
    }

}


# gigs@clearwox.com