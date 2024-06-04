<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
   
    public function Home(){
        return view('guest/home');
    }
}
