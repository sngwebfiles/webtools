<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ImportDataModel;
use App\Models\PublicationsModel;
class Importdata extends BaseController
{


    public function __construct(){
        helper(['form']);
        // ini_set('max_execution_time', 6000);
        ini_set('max_execution_time', 0); 
        ini_set('memory_limit','2048M');
    }
    public function index()
    {
       
        $userModel = new UserModel();
        $email = session('email');// $_SESSION['email'];
        $data = $userModel->where('email', $email)->first();
        
        $ImportModel = new ImportDataModel();
        $data['xmlimport'] = $ImportModel->where('status_upload', 0)->findAll();

        $PubModel = new PublicationsModel();
        $data['wpaddpost'] = $PubModel->findAll();

        $info = [
            'title' => "Import Data to Database",
            'path' => "importdata",
            'styles' => '.',
            'script' => '<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="assets/js/pages/datatables.init.js">
            </script><script src="assets/js/cst.js"></script>'
        ];
        
        $data = array_merge($data, $info);

        return view('templates/header',$data)
        . view('pages/importdata')
        . view('templates/bottom');
    }


    public function write()
    {

            helper(['form']);

            if(empty($_POST['website'])){
                echo "Please select website!";
                exit;
            }

            if($_FILES['uploadxml']['name'] != ''){
                

                $from = $_FILES['uploadxml']['tmp_name'];
 
                $html   = utf8_encode(file_get_contents($from));
                $invalid_characters = '/[^\x9\xa\x20-\xD7FF\xE000-\xFFFD]/';
                $html = preg_replace($invalid_characters, '', $html);
                $xml = simplexml_load_string($html);

                $insertxml = new ImportDataModel();   

                $i = 0;
                $dtstart = date("Y-m-d H:i:s");

                foreach($xml->article as $rec){

                    $file_path="";
                        if (!empty($rec->articleImage)){
                            $url = $rec->articleImage;
                            $file_path = "downloads/".basename($url);
                            $download =  $this->get_image_from_url_crop($url,$file_path);
                        }

                    $data = [
                    'title'    => $rec->title,
                    'content' => $rec->content,
                    'category'    => $rec->blog_title,
                    'website'    => $_POST['website'],
                    'featured_image' => $file_path,
                    'by_line'     => $rec->author_firstname . " ".  $rec->author_lastname,
                    'date_created'     =>  date('Y-m-d H:i:s', intval($rec->created_at)),
                    'last_modified'     => date('Y-m-d H:i:s', intval($rec->published_at))];

                    // $res = $insertxml->where('title', $rec->titlel)->findAll();

                    // if(!empty($res)){
                        $insertxml->save($data);
                    // }
                    

                    $i++;
                    if($i==10){

                        $dtend = date("Y-m-d H:i:s");
                        $datetime1 = date_create($dtstart);
                        $datetime2 = date_create($dtend);
                        $interval = date_diff($datetime1, $datetime2);

                        echo "Date Start: ".$dtstart. " and Date End: ".$dtend."<br>";
                        echo $interval->format('Difference is: %h hours %i minutes %s second<br>');
                        echo "Total added: ".$i."<br>";
                        echo "Successfully Imported to Database.<br>";
                        echo "<a href='/importdata'>Refresh now!</a>";
                        exit;
                        //return redirect()->to('/importdata');
                    }

                }

                // $dtend = date("Y-m-d H:i:s");
                // $datetime1 = date_create($dtstart);
                // $datetime2 = date_create($dtend);
                // $interval = date_diff($datetime1, $datetime2);

                // echo "Date Start: ".$dtstart. " and Date End: ".$dtend."<br>";
                // echo $interval->format('Difference is: %h hours %i minutes %s second<br>');
                // echo "Total added: ".$i."<br>";
                // echo "Successfully Imported to Database.<br>";
                // echo "<a href='/importdata'>Refresh now!</a>";
                // exit;


            }else{
                $statusMsg = 'Please select a file to upload.';
            }
            
            echo $statusMsg;
            return redirect()->to('/importdata');

        }


        public function get_image_from_url_crop($image_url,$file_path) {
 
            $fn = $image_url;
            $size = getimagesize($fn);
            $ratio = $size[0]/$size[1]; // width/height
            if( $ratio > 1) {
                $width = 640;
                $height = 640/$ratio;
            }
            else {
                $width = 640*$ratio;
                $height = 640;
            }
            $src = imagecreatefromstring(file_get_contents($fn));
            $dst = imagecreatetruecolor($width,$height);
            imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
            imagedestroy($src);
            imagejpeg($dst,$file_path); // adjust format as needed
            imagedestroy($dst);
            return $file_path; 
        
        }



        public function delete($id = null)
        {
            $ImportModel = new ImportDataModel();
            $data['user'] = $ImportModel->where('id', $id)->delete();
            return redirect()->to(base_url('importdata') );
        }

        public function deleteempty()
        {
           
            $ImportModel = new ImportDataModel();
            $data['user'] = $ImportModel->where('title','')->where('content', '')->where('category', '')->delete();
            return redirect()->to(base_url('importdata') );
        }
        

        function deleteselected()
        {
            helper(['form']);

            $data = array();
            $ImportModel = new ImportDataModel();

            if(isset($_POST["post_list"])) {

                if(!empty($_POST['checked_id'])) {    
                    foreach($_POST['checked_id'] as $value){
                        $delete = $ImportModel->where('id', $value)->delete();
                    }
                }
            }
            return redirect()->to(base_url('importdata') );
        }


        public function truncate()
        {

            // $db      = \Config\Database::connect();
            // $builder = $db->table('tblimportadataxml');
            // $builder->truncate();

            $ImportModel = new ImportDataModel();
            $data['user'] = $ImportModel->truncate();
            return redirect()->to(base_url('importdata') );
        }
       
        public function wppoststory()
        {
 
                if(!empty($_POST['pub_id'])) {  

                    ini_set('max_execution_time', 0);

                    $pubSite = new PublicationsModel();
                    $pubid = $_POST['pub_id'];
                    $numpost = $_POST['num_post'];

                    $data = $pubSite->where('pub_id', $pubid)->first();
        
                    $rest_api_url = $data['wp_rest_api_endpoint_link']."posts";
                    $rest_api_media = $data['wp_rest_api_endpoint_link']."media";
                    $wp_uname = $data['wp_rest_api_user'];
                    $wp_pass = $data['wp_rest_api_pass'];

                    $restmedia = array("url"=>$rest_api_media,"user"=>$wp_uname,"pass"=>$wp_pass);
        
                    $ImportModel = new ImportDataModel();
                    // $data = $ImportModel->findAll($numpost);
                    $data = $ImportModel->where('status_upload', 0)->findAll($numpost);
                    
                    $count = 0;
                    $dtstart = date("Y-m-d H:i:s");
        
                    // echo "Date start: ".$dtstart."<br>";
        
                    foreach ($data as $pub){
              
                        $category = "6"; 
                        $tags = "12";  
                        $status = "publish";   //One of: publish, future, draft, pending, private
        
                        $imagepath = $pub['featured_image'];
                        
                        $img_featured_Id="";

                        if (!empty($imagepath)){
                            // $img_featured_Id = $this->upload_media($imagepath,$restmedia);
                            echo $imagepath;
                        } else {
                            echo "wala";
                             exit;
                        }

                       

                        $data_string = json_encode([
                            'title'    => $pub['title'],
                            'content'  => $pub['content'],
                            'categories'   => $category,
                            'featured_media'   => $img_featured_Id,
                            'tags'   => $tags,
                            'status' =>  $status,
                            'author'   => 2	
                        ]);

                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $rest_api_url);
                            curl_setopt($ch, CURLOPT_POST, 1);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                            // curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,300);

                            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                                'Content-Type: application/json',
                                'Content-Length: ' . strlen($data_string),
                                'Authorization: Basic ' . base64_encode($wp_uname . ':' . $wp_pass),
                            ]);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $result = curl_exec($ch);
        
                             $count++;
                            if (curl_errno($ch)) {
                                echo "Date Start: ".$dtstart. " and Date End: ".date("Y-m-d H:i:s")."<br>";
                                echo "Total Post: ".$count."<br>";
                                echo 'Error:' . curl_error($ch) ."<br>";
                                exit();
                            }
                            
                            curl_close($ch);
                            $result = json_decode($result);
                            $post_id = $result->id;
                            
                            if (!empty($imagepath)){
                                $updateimage = $this->attach_image($post_id,$img_featured_Id,$restmedia);
                            }
                            

                            $id = $pub['id'];
                            $result = $ImportModel->where('id', $id)->set(['status_upload' => '1'])->update();
                    }
        
                    echo "Date Start: ".$dtstart. " and Date End: ".date("Y-m-d H:i:s")."<br>";
                    echo "Total Post: ".$count."<br>";
                    // echo $updateimage."<br>";
                    // echo "Featured Image local: ".$path."<br>";
                    // echo "Featured Image online: ".$digital_edition_direct_url."<br>";
                    echo "Successfully WP Post Story created.";

                } else {
                    echo "Please select location!";
                }

        }

        public function upload_media($path,$rest)
        {
            $image = file_get_contents($path);
            $mime_type = mime_content_type($path);
            $size = filesize($path);
    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $rest['url']);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $image);
    
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Length: ' . $size,
                'Content-Type: ' . $mime_type,    
                'Content-Disposition: attachment; filename="' . basename($path) . '"',
                'Authorization: Basic ' . base64_encode($rest['user'] . ':' . $rest['pass']),
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            $resp = json_decode($result);
    
             $image_url = $resp->source_url;
             $image_id = $resp->id;

            curl_close($ch); 

            return $image_id;

        }


        function attach_image($post_id, $media_id,$rest) {

            
            $rest_api_url = $rest['url']."/". $media_id ;
            $data_string = json_encode([
                'post' => $post_id
            ]);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $rest_api_url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'Authorization: Basic ' . base64_encode($rest['user'] . ':' . $rest['pass']),
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
            $result = curl_exec($ch);
        
            curl_close($ch);
  
            // $result = json_decode($result);
            // if($result->id) {
            //     echo "Media $media_id is attached to POST $result->id. <br>";
            // }
         }



}
