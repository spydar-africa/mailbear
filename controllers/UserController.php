<?php

use App\Helpers\Fs;
use App\Admin\Auth;
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

HasPermission("user","account/signin");
class UserController extends Controller {

    public function blank(){
        return view("app/blank");
    }

    public function dashboard(){
        return view("app/dashboard");
    }

    public function compose(){
        return view("app/compose");
    }

    public function blankMail(){

        $userModel = new User;
        return view("app/blank");
    }

    public function contacts(){

        $cGroupModel = new ContactGroup;
        $user_id = Auth::id("user_id");

        $getContacts = $cGroupModel->selectAll()->where(["user_id"=>$user_id]);

        for ($i=0; $i < count($getContacts); $i++) { 
            # code...
            $cleaned = trim($getContacts[$i]["contacts"],",");
            $splited = explode(",",$cleaned);
            $num = count($splited);
            $getContacts[$i]["number"] = $num;
        }

        return view("app/contacts",["groups"=>$getContacts]);
    }

    public function addContacts($request){

        if($request->method == "POST"){
            $user_id = Auth::id("user_id");
            $groupName = $request->groupName;

            # Checking if group name exists
            $cGroupModel = new ContactGroup;
            $checks = $cGroupModel->select()->where(["user_id"=>$user_id,"group_name"=>$groupName]);
            if($checks) {
                return view("app/addContacts",["error"=>["message"=>"Group name already exists."]]);
            }

            # insert into contactGroup
            $insert = $cGroupModel->insert([
                "user_id" => $user_id,
                "group_name" => $groupName,
                "contacts" => trim($request->groupContacts,",")
            ]);

            if($insert) {
                return view("app/addContacts",["message"=>"New Contact group has been successfully created!"]);
            }
        }
        return view("app/addContacts");
    }

    public function viewContacts($request){
        $cGroupModel = new ContactGroup;

        $user_id = Auth::id("user_id");
        $sn = $request->param["sn"];

        if(isset($request->m) && isset($request->in)){
            $mode = $request->m;
            $target = $request->in;

            switch($mode){

                case 'view':
                    # code...
                    break;
                case 'edit':
                    # code...
                    break;
                case 'delete':
                    # code...
                    break;
            }
        }

        # get Target
        $getTarget = $cGroupModel->select()->where(["user_id"=>$user_id,"sn"=>$sn]);
        if($getTarget){
            return view("app/viewContacts",["target"=>$getTarget]);
        }

        return Redirect("/user/contacts");
    }
}