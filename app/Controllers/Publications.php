<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PublicationsModel;

class Publications extends BaseController
{
    public function __construct(){
        helper(['form']);
    }
    public function index()
    {
        $userModel = new UserModel();
        $email = $_SESSION['email'];
        $data = $userModel->where('email', $email)->first();
        
        $PubModel = new PublicationsModel();
        $email = $_SESSION['email'];
        // $data = $PubModel->where('email', $email)->first();

    
        $data['allpub'] = $PubModel->findAll();
  


        $info = [
            'title' => "Publications",
            'path' => "publications",
            'styles' => '',
            'script' => '<script src="assets/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>
            <script src="assets/js/pages/form-element.init.js"></script>
            </script><script src="assets/js/cst.js"></script>'
        ];
        
        $data = array_merge($data, $info);

        return view('templates/header',$data)
        . view('pages/publications')
        . view('templates/bottom');
    }

 public function savepub()
    {
        helper(['form']);
        $rules = [
            'pub_id'          => 'required|min_length[1]|max_length[10]',
            'parent_pub_id'   => 'required|min_length[1]|max_length[10]',
            'name'          => 'required|min_length[2]|max_length[50]',
        ];

        // echo "aaasas0";
 
            echo $this->request->getVar('pub_id');
        // // $session = session();   
        // if ($this->validate($rules)) {
        //     // $userModel = new UserModel();
        //     $PubModel = new PublicationsModel();
 
        //     $data = [
        //         'pub_id'     => $this->request->getVar('pub_id'),
        //         'parent_pub_id'     => $this->request->getVar('parent_pub_id'),
        //         'name'     => $this->request->getVar('name'),
        //         // 'email'    => $this->request->getVar('email'),
        //         // 'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        //         // 'created_date'     => time(),
        //         // 'status'     => 1,
        //     ];
        //     $PubModel->save($data);
        //     return redirect()->to('/publications');
            
        // } else {
        //     $data['validation'] = $this->validator;
        //     $info = ['styles' => '','script' => ''];
        //     $data = array_merge($data, $info);
        //     // return view('templates/header', $data)
        //     // . view('pages/publications')
        //     // . view('templates/bottom');
        //     // $session->setFlashdata('msg', 'Password is incorrect.');
        //     return redirect()->to('/publications');
        // }
    }

    public function savepub222()
    {
        helper(['form']);
        $rules = [
            'pub_id'          => 'required|min_length[1]|max_length[10]',
            'parent_pub_id'   => 'required|min_length[1]|max_length[10]',
            'name'          => 'required|min_length[2]|max_length[50]',

            // 'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[tblusers.email]',
            // 'password'      => 'required|min_length[4]|max_length[50]',
            // 'confirmpassword'  => 'matches[password]'
        ];
 
        if ($this->validate($rules)) {
            // $userModel = new UserModel();
 
            // $data = [
            //     'fname'     => $this->request->getVar('fname'),
            //     'username'     => $this->request->getVar('username'),
            //     'email'    => $this->request->getVar('email'),
            //     'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            //     'created_date'     => time(),
            //     'status'     => 1,
            // ];
            // $userModel->save($data);
            return redirect()->to('/publications');
            
        } else {

            $info = [
                'title' => "Publications",
                'path' => "publications",
                'styles' => '',
                'script' => '<script src="assets/libs/bs-custom-file-input/bs-custom-file-input.min.js"></script>
                <script src="assets/js/pages/form-element.init.js"></script>'
            ];

            $data['validation'] = $this->validator;

            $data = array_merge($data, $info);

            // return view('templates/header',$data)
            // . view('pages/publications')
            // . view('templates/bottom');

            return redirect()->to('/publications');
        }
    }
}
