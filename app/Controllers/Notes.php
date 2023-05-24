<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Controllers\BaseController;

class Notes extends BaseController
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
            'title' => "Notes",
            'path' => "notes",
            'styles' => '',
            'script' => ''
        ];
        
        $data = array_merge($data, $info);

        return view('templates/header',$data)
        . view('pages/notes')
        . view('templates/bottom');
    }
}
