<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
class Register extends BaseController
{
    public function __construct(){
        helper(['form']);
    }
 
    public function index()
    {
        $data = [];
        $info = ['styles' => '','script' => ''];
        
        $data = array_merge($data, $info);
        // return view('auth/register', $data);
        return view('templates/header', $data)
                . view('auth/register')
                . view('templates/bottom');
    }
   
    public function register()
    {
        helper(['form']);
        $rules = [
            'username'          => 'required|min_length[2]|max_length[50]',
            'fname'          => 'required|min_length[2]|max_length[50]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[tblusers.email]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]'
        ];
 
        if ($this->validate($rules)) {
            $userModel = new UserModel();
 
            $data = [
                'fname'     => $this->request->getVar('fname'),
                'username'     => $this->request->getVar('username'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'created_date'     => time(),
                'status'     => 1,
            ];
            $userModel->save($data);
            return redirect()->to('/dashboard');
            
        } else {
            $data['validation'] = $this->validator;
            $info = ['styles' => '','script' => ''];
            $data = array_merge($data, $info);
            return view('templates/header', $data)
            . view('auth/register')
            . view('templates/bottom');
        }
    }
    
}
