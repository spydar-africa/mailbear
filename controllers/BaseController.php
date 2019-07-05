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

class BaseController extends Controller {

    public function index($request){
        return view("base/index");
    }

    public function about(){
        return view("base/about");
    }

    public function contact($request){

        if($request->method == "POST"){

            $firstname = $request->firstname;
            $lastname = $request->lastname;
            $email = $request->email;
            $mobile = $request->mobile;
            $message = $request->message;

            # Mailing 
            $mailer = new Mailer();
            $from = $mailer->sender($firstname." ".$lastname, $email);
            $receiver = $mailer->receiver("akinniyiakinpelumi@mgmail.com");
            $subject = $mailer->subject($firstname." ".$lastname." Sent you a message");
            $message = $mailer->message($message);

            if($mailer->send()){
                # return thankyou message
                return view("base/thankyou");
            } 
        }
        return view("base/contact");
    }

    public function pricing(){
        return view("base/pricing");
    }

    public function faq(){
        return view("base/faq");
    }
}