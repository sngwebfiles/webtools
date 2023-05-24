<?php
namespace App\Controllers;
use CodeIgniter\Exceptions\PageNotFoundException; 
use App\Controllers\BaseController;

class Pages extends BaseController
{
    private $name;
    private $content;
    
    public function index()
    {
        // $this->load->view('pages\index');
        // return view('pages\blank');
    }

    public function view($page = 'home')
    {
        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            throw new PageNotFoundException($page);
        }

        $title = $page;
        $name = "Abel Tobiaso";
        $content = "Test Content of ".$page;

        $data['title'] = $title;
        $data['name'] = ucfirst($name);
        $data['content'] = $content;

        return view('templates/header', $data)
                . view('pages/' . $page)
                . view('templates/bottom');
    }


    
    
}
