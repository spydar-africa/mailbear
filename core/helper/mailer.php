<?php

namespace App\Helpers;

class Mailer {

    private $headers = "";
    private $subject;
    private $message;

    public function _construct(){

    }

    public function attachment(){

    }

    public function message($message){
        $this->headers .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $this->message = $message;
    }

    public function html($content){
        $this->headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $this->message = $content;
    }

    public function receiver($receiver){
        $this->receiver = $receiver;
    }

    public function subject($subject){
        $this->subject = $subject;
    }

    public function sender($name, $email){
        $this->headers .= "From: " . $name . "\r\n";
    }

    public function set_headers($replyto="<no-reply>", $mime_version="1.0"){
        $this->headers .= "Reply-To: ". $replyto . "\r\n";
        $this->headers .= "MIME-Version: $mime_version\r\n";

        $this->headerStatus = true;
    }


    public function send(){
        if(!isset($this->headerStatus)){
            Mailer::set_headers();
        }

        if(@mail($this->receiver, $this->subject, $this->message, $this->headers)){
            return true;
        } 
        return false;
    }
}