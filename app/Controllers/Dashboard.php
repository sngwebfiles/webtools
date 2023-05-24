<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Dashboard extends BaseController
{

    public function index()
    {
        $userModel = new UserModel();
        $email = $_SESSION['email'];
        $data = $userModel->where('email', $email)->first();
        
        // $mydata = [
        //     'id' => $data['id'],
        //     'fname' => $data['fname'],
        //     'lname' => $data['lname'],
        //     'username' => $data['username'],
        //     'email' => $data['email']
        // ];
        
        $info = [
            'title' => "Dashboard",
            'path' => "Homepage",
            'styles' => '',
            'script' => ''
        ];
        
        $data = array_merge($data, $info);

        return view('templates/header',$data)
        . view('pages/dashboard')
        . view('templates/bottom');
    }
}
