<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function index()
    {
        $data = array(
            'msg' => 'Not Logged In'
        );
        return view('index',$data);
    }

}
