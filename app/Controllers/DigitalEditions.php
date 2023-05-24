<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
class DigitalEditions extends BaseController
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
            'title' => "Digital Editions",
            'path' => "write-wp-digital-editions"
        ];
        
        $data = array_merge($data, $info);

        return view('templates/header',$data)
        . view('pages/write-wp-digital-editions')
        . view('templates/bottom');
    }


    public function write()
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
            'title' => "Digital Editions",
            'path' => "write-wp-digital-editions",
            'styles' => '',
            'script' => '<script src="assets/libs/parsleyjs/parsley.min.js"></script>
            <script src="assets/js/pages/form-validation.init.js"></script>
            <script src="assets/libs/tinymce/tinymce.min.js"></script>
            <script src="assets/js/pages/form-editor.init.js"></script>
            '
        ];
        
        $data = array_merge($data, $info);

        return view('templates/header',$data)
        . view('pages/write-wp-digital-editions')
        . view('templates/bottom');
    }

}
