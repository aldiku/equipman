<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(){
        if(logged_in()){
            return redirect()->to('/dashboard');
        }else{
            return redirect()->to('/login');
        }
        // return view('front/v-home');
    }
}
