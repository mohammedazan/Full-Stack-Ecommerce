<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    //


    public function sendEmail(){

        $toemail='he34124@gmail.com';
        $message=' welcome to hashem fields';
        $subject='Welcome Email in laravel using Gmail ';
        Mail::to($toemail)->send(new WelcomeEmail($message,$subject));
    }
}
