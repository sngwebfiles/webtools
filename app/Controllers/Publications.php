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
        $Err ="";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {  

            if(empty($_POST['pub_id'])) {  
                $Err = $Err."Publication ID is required<br>"; 
            } else { $Err = $Err.""; }
            if(empty($_POST['name'])) {  
                $Err = "Name is required<br>"; 
            } else { $Err = $Err.""; }
            if(empty($_POST['website'])) {  
                $Err = $Err."Website is required<br>"; 
            } else { $Err = $Err.""; }
            if(empty($_POST['loc'])) {  
                $Err = $Err."Location is required<br>"; 
            } else { $Err = $Err.""; }

            if ($Err ==""){
              
                $PubModel = new PublicationsModel();
                $data = [
                    'pub_id'        => $_POST['pub_id'],
                    'parent_pub_id' => $_POST['parent_pub_id'],
                    'group_pub_id'  => $_POST['group_pub_id'],
                    'name'          => $_POST['name'],
                    'wordpress_url'  => $_POST['website'],
                    'location'    => $_POST['loc'],
                    'wp_rest_api_endpoint_link' => $_POST['api_url'],
                    'wp_rest_api_user'          => $_POST['api_user'],
                    'wp_rest_api_pass'          => $_POST['api_pass']
                ];
                $PubModel->save($data);
                echo "ok";
            } else {
                echo $Err;
            }
        }
       
    }

   
}
