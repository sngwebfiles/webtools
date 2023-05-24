<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Controllers\BaseController;

class Monitor extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $email = $_SESSION['email'];
        $data = $userModel->where('email', $email)->first();

        $info = [
            'title' => "Digital Editions",
            'path' => "monitor",
            'styles' => '',
            'script' => '<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="assets/js/pages/datatables.init.js"></script>'
        ];
        
        $data = array_merge($data, $info);

        return view('templates/header',$data)
        . view('pages/monitor')
        . view('templates/bottom');
    }
}
