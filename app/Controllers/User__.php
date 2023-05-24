<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\UserModel;
class User extends BaseController
{
    public function index()
    {
        // $data = array();
        // helper(['form']);
        // return view('pages/register', $data);
        return view('templates/header')
                . view('pages/register')
                . view('templates/bottom');
    }
    // 
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
            return redirect()->to('/login');
        } else {
            $data['validation'] = $this->validator;
            // return view('/register', $data);
            return view('templates/header', $data)
            . view('pages/register')
            . view('templates/bottom');
        }
    }
    // login form
    public function login()
    {

        $data = array();
        helper(['form']);
        // return view('pages/login', $data);

        // $title = $page;
        // $name = "Abel Tobiaso";
        // $content = "Test Content of ".$page;

        // $data['title'] = $title;
        // $data['name'] = ucfirst($name);
        // $data['content'] = $content;

        return view('templates/header')
                . view('pages/login')
                . view('templates/bottom');

    }
 
    // check login auth
    public function loginAuth()
    {
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
                    'fname' => $data['fname'],
                    'lname' => $data['lname'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                // session()->set('username', "Hello World");
                return redirect()->to('pages/dashboard');
            } else {
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to('/login');
        }
    }
 
    // dashboard
    public function dashboard()
    {
        $data = array();
        $data['session'] = session();
        return view('dashboard', $data);
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

}
