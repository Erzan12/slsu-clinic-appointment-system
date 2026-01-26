<?php

namespace App\Services;
use Illuminate\Support\Facades\Mail;

class MailerService
{
    public static function send($name,$email,$type)
    {
        $to_name = $name;
        $to_email = $email;
        $data = array('name'=>$name, "type" => $type);
        Mail::send('emails.mail', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)
                ->subject('SLSU - CAS Appointment Request Update');
            $message->from(env('MAIL_FROM_ADDRESS'),'Request Update');
        });
    }
}