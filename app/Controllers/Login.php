<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
class Login extends BaseController
{
    public function index()
    {
        $data = [];
        $info = [
            'styles' => '',
            'script' => ''
        ];
        $data = array_merge($data, $info);
        return view('templates/header',$data)
                . view('auth/login')
                . view('templates/bottom');
    }
    public function authenticate()
    {
        // $session = session();
        // $userModel = new UserModel();
 
        // $email = $this->request->getVar('email');
        // $password = $this->request->getVar('password');
         
        // $user = $userModel->where('email', $email)->first();
 
        // if(is_null($user)) {
        //     return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        // }
 
        // $pwd_verify = password_verify($password, $user['password']);
 
        // if(!$pwd_verify) {
        //     return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        // }
 
        // $ses_data = [
        //     'id' => $user['id'],
        //     'fname' => $user['fname'],
        //     'lname' => $user['lname'],
        //     'username' => $user['username'],
        //     'email' => $user['email'],
        //     'isLoggedIn' => TRUE
        // ];
        // $session->set($ses_data);

        // return view('templates/header')
        // . view('dashboard')
        // . view('templates/bottom');

        // return redirect()->to('pages/dashboard');


        $session = session();
        $userModel = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
 
        $data = $userModel->where('email', $email)->first();
 
        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $data['id'],
                    'uname' => $data['fname'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('dashboard');
                
            } else {
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/login');
        }


    }

    public function logout() {
        session_destroy();

        $data = array(
            'msg' => 'You are Logout Successfully'
        );

        return view('index',$data);

        // return redirect()->to('auth/login',$data);
    }

}
