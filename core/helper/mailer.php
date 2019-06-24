<?php

namespace App\Helpers;

class Mailer {

    public function _construct(){

    }

    public function attachment(){

    }

    public function message($message){
        $this->headers .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $this->text = true;
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
        $this->headers = "From: " . $name ." ". $email. "\r\n";
    }

    public function set_headers($replyto="no-reply", $mime_version="1.0"){
        $this->headers .= "Reply-To: ". $replyto . "\r\n";
        $this->headers .= "MIME-Version:". $mime_version ."\r\n";

        $this->headerStatus = true;
    }


    public function send(){

        if(mail($this->receiver, $this->subject, $this->message, $this->headers)){
            return true;
        } 
        return false;
    }

    public function useFile($file, $data){
        if(!isset($this->headerStatus)){
            Mailer::set_headers();
        }
        $this->headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $get_contect = file_get_contents($file);
        Mailer::keys($get_contect, $data);

    }

    public function keys($fcontent, $data) {
        if(!is_null($data)){
            foreach ($data as $key => $value) {
                $fcontent = preg_replace("/@{{(.*)\~".$key."\~(.*)}}(.*)@{{/", $value."$3@{{", $fcontent);
                $fcontent = preg_replace("/@{{(.*)\~".$key."\~(.*)}}/", $value, $fcontent);
            }
        }
        $this->message = $fcontent;
    }
}