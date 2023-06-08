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
        $data['xmlimport'] = $ImportModel->where('status_upload', 0)->orderBy('date_created', 'desc')->findAll();

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

    public function viewxml($id = null)
    {
       
        $userModel = new UserModel();
        $email = session('email');// $_SESSION['email'];
        $data = $userModel->where('email', $email)->first();
        
        $ImportModel = new ImportDataModel();
        $data['xmlview'] = $ImportModel->where('id', $id)->first();

        $info = [
            'title' => "View XML Data",
            'path' => "importdata",
            'styles' => '.',
            'script' => ''
        ];
        
        $data = array_merge($data, $info);

        return view('templates/header',$data)
        . view('pages/viewxml')
        . view('templates/bottom');
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

        $i=0;
        if(!empty($_POST['rec_id'])) { 
            foreach($_POST['rec_id'] as $value) {
                $i++;
                $delete = $ImportModel->where('id', $value)->delete();
            }
            echo "Numbers of records deleted: ".$i."<br>";
            echo "<a href='importdata'>Refresh now!</a>";
            //return redirect()->to(base_url('importdata') );
        } else {
            echo "Please select at least 1 record to delete.";
        }


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

    public function write()
    {

            helper(['form']);

            if(empty($_FILES['uploadxml']['name'])){
                echo "Please XML File!";
                exit;
            }

            if(empty($_POST['website'])){
                echo "Please select website!";
                exit;
            }
            if(empty($_POST['num_xml'])){
                echo "Please insert number of XML records!";
                exit;
            }

            if($_FILES['uploadxml']['name'] != ''){
                
                $from = $_FILES['uploadxml']['tmp_name'];
                $html   = file_get_contents($from);
                $invalid_characters = '/[^\x9\xa\x20-\xD7FF\xE000-\xFFFD]/';
                $html = preg_replace($invalid_characters, '', $html);
                $xml = simplexml_load_string($html);

                $insertxml = new ImportDataModel();   
                $PubModel = new PublicationsModel();
                $datapub = $PubModel->where('id', $_POST['website'])->first();

                $i = $_POST['num_xml'];//0;
                $e = 0;
                $a = 0;
                $count = $_POST['num_xml'];
                $xmlcount = 0;
                $cont = "false";
                $dtstart = date("Y-m-d H:i:s");
                $website = $datapub['wordpress_url'];
                $folderpath = "downloads/".$datapub['name'];
                $file_path="";
                if (!file_exists($folderpath)) {
                    mkdir($folderpath, 0755);
                } 
                
                $xmlcount = $xml->article->count();
                if($count>$xmlcount){
                    echo "Request count is higher than XML Records.<br>The maximum records of XML is: ".$xmlcount;
                    exit;
                }

                if($count=='all' || $count<='0'){
                    $count = $xmlcount;
                    $i = "All";
                } 

                foreach($xml->article as $rec){

                    $dtend = date("Y-m-d H:i:s");
                    $datetime1 = date_create($dtstart);
                    $datetime2 = date_create($dtend);
                    $interval = date_diff($datetime1, $datetime2);

                    $datecreated = date('Y-m-d H:i:s', intval($rec->created_at));
                    $res = $insertxml->where('pm_guid', $rec->guid)->where('website', $website)->first();

                        if ($res==null){

                            if (!empty($rec->articleImage)){
                                $url = $rec->articleImage;
                                $file_path = $folderpath."/".basename($url);
                                $fileexist = base_url()."/".$file_path;
                                if (!file_exists($fileexist)){
                                    $download =  $this->get_image_from_url_crop($url,$file_path);
                                }
                            }

                            $data = [
                            'title'         => $rec->title,
                            'content'       => $rec->content,
                            'category'      => $rec->blog_title,
                            'pm_blog_title' => $rec->blog_title,
                            'pm_guid'       => $rec->guid,
                            'website'       => $website,
                            'featured_image'    => $file_path,
                            'by_line'       => $rec->author_firstname . " ".  $rec->author_lastname,
                            'created_at'    =>  date('Y-m-d H:i:s'),
                            'date_created'  =>  $datecreated,
                            'last_modified' => date('Y-m-d H:i:s', intval($rec->published_at))];

                            $insertxml->save($data);
                            $a++;
                            // $this->writecount($_POST['num_xml'],$a); 
                            if($a==$i){
                                echo "Date Start: ".$dtstart. " and Date End: ".$dtend."<br>";
                                echo $interval->format('Difference is: %h hours %i minutes %s second<br>');
                                echo "Total inserted: ".$a."<br>";
                                echo "Total exits: ".$e."<br>";
                                echo "Total requests to insert: ".$i."<br>";
                                echo "Successfully Imported to Database.<br>";
                                echo "<a href='/importdata'>Refresh now!</a>";
                                exit;
                            } 

                        } else {
                            $e++;
                        }

                }

                echo "Date Start: ".$dtstart. " and Date End: ".$dtend."<br>";
                echo $interval->format('Difference is: %h hours %i minutes %s second<br>');
                echo "Total inserted: ".$a."<br>";
                echo "Total exits: ".$e."<br>";
                echo "Total requests to insert: ".$i."<br>";
                echo "Successfully Imported to Database.<br>";
                echo "<a href='/importdata'>Refresh now!</a>";
                exit;
                    //return redirect()->to('/importdata');
                
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

        public function wppoststory()
        {

                if(!empty($_POST['pub_id'])) {  

                    ini_set('max_execution_time', 0);

                    $pubSite = new PublicationsModel();
                    $pubid = $_POST['pub_id'];
                    $numpost = $_POST['num_post'];
                    
                    $datarest = $pubSite->where('wordpress_url', $pubid)->first();
        
                    $rest_api_url = $datarest['wp_rest_api_endpoint_link']."posts";
                    $rest_api_media = $datarest['wp_rest_api_endpoint_link']."media";
                    $rest_api_category = $datarest['wp_rest_api_endpoint_link']."categories?per_page=30";

                    $wp_uname = $datarest['wp_rest_api_user'];
                    $wp_pass = $datarest['wp_rest_api_pass'];

                    $restpost = array("url"=>$rest_api_url,"user"=>$wp_uname,"pass"=>$wp_pass);
                    $restmedia = array("url"=>$rest_api_media,"user"=>$wp_uname,"pass"=>$wp_pass);
                    $restcategory = array("url"=>$rest_api_category,"user"=>$wp_uname,"pass"=>$wp_pass);

                    $ImportModel = new ImportDataModel();
                    $data = $ImportModel->where('status_upload', 0)->where('website', $pubid)->orderBy('date_created', 'desc')->findAll($numpost);  //FOR GETTING ALL RECORDS - STATUS IS 0 (Not uploaded)

                    $count = 0;
                    $notpost = 0;
                    $img = 0;
                    $imgnoexist = 0;
                    $noimg = 0;
                    $dtstart = date("Y-m-d H:i:s");
        
                    $vartitle = "";
                    $varcontent = "";
                    $varblog_title = "";
                    $varguid = "";
                    $varby_line = "";
                    foreach ($data as $pub){
              
                        $info = array(
                            'title'  => $pub['title'],
                            'date'   => $pub['date_created'],
                            );

                        $vartitle = $pub['title'];   
                        $varcontent = $pub['content'];
                        $varblog_title = $pub['pm_blog_title'];
                        $varguid = $pub['pm_guid'];    
                        $varby_line = $pub['by_line'];

                            if (!empty($vartitle)){

                                $categoryid = $this->check_category($pub['category'],$restcategory); 
                                $status = "publish";   //One of: publish, future, draft, pending, private
                
                                // var_dump($categoryid);
                                $categoryid = $categoryid['cat1'].",".$categoryid['cat2'];
                                $imagepath = $pub['featured_image'];
                                $img_featured_Id="0";

                                if (!empty($imagepath)){
                                    if (file_exists($imagepath)){

                                       $img_featured_Id = $this->upload_media($imagepath,$restmedia);  //FOR UPLOADING FEATURED IMAGE
                                        $img++; 
                                    } else {
                                        $imgnoexist++;
                                    }
                                } else {
                                    $noimg++;
                                }

                                $meta = array(
                                    'pm_blog_title'  => $varblog_title,
                                    'pm_guid'   => $varguid,
                                    'by_line'   => $varby_line,
                                    );

                                $data_string = json_encode([
                                    'title'    => $vartitle,
                                    'content'  => $varcontent,
                                    'categories'   => $categoryid,
                                    'featured_media'   => $img_featured_Id,
                                    'modified'   => $pub['last_modified'],
                                    'meta'  => $meta,
                                    'date'   => $pub['date_created'],
                                    'status' =>  $status
                                ]);
                                // var_dump($data_string);

                                    $ch = curl_init();
                                    curl_setopt($ch, CURLOPT_URL, $rest_api_url);
                                    curl_setopt($ch, CURLOPT_POST, 1);
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

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
                                      $updateimage = $this->attach_image($post_id,$img_featured_Id,$restmedia);   //FOR UPDATING FEATURED IMAGE
                                    }
                                    
                                    // $this->writecount($numpost,$count);post_id
                                    $id = $pub['id'];
                                    $result = $ImportModel->where('id', $id)->set(['status_upload' => '1','website'=>$pubid,'post_id'=>$post_id])->update();
                            
                            } else {
                                $notpost++;
                             }
                    }
                            $dtend = date("Y-m-d H:i:s");
                            $datetime1 = date_create($dtstart);
                            $datetime2 = date_create($dtend);
                            $interval = date_diff($datetime1, $datetime2);

                            echo "Date Start: ".$dtstart. " and Date End: ".$dtend."<br>";
                            echo $interval->format('Difference is: %h hours %i minutes %s second<br>');
                            echo "Total Post request: ".$numpost."<br>";
                            echo "Total Post added online: ".$count."<br>";
                            echo "Total Post not posted online: ".$notpost."<br>";
                            echo "Total Featured Image added: ".$img."<br>";
                            echo "Total Featured Image not exists in local: ".$imgnoexist."<br>";
                            echo "Total No Featured Image: ".$noimg."<br>";
                            echo "Successfully WP Post Story created online.";

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

         }


         public function check_category($str,$rest)
         {
     
            //Business News, Rural News
            //Community News            
            //Sports, Bowls, Sport, Soccer, Football, Netball, Golf, Basketball, Combat Sports, Tennis, Cricket, Racing
            //Entertainment News
            //Temporary Digital Editions
            // , "Events", "Fleurieu Sun", "Real Estate"
            $news = array("Community News","Business News", "News", "Rural News","Rural","Community"); //two category
            $comnews = array("Community News","Community"); //two category
            $sport = array("Sports", "Bowls", "Sport", "Soccer", "Football", "Netball", "Golf", "Basketball", "Combat Sports", "Tennis", "Cricket"); 
            $entertainment = array("Entertainment News", "Entertainment"); //only one
            $digitaledition = array("Digital Editions",);

            if (in_array($str, $news))
            {
                $category = "News";
            } else if (in_array($str, $comnews)) {
                $category = "Community News";
            } else if (in_array($str, $sport)) {
                $category = "Sport";
            } else if (in_array($str, $entertainment)) {
                $category = "Entertainment";
            } else if (in_array($str, $digitaledition)) {
                $category = "Temporary Digital Editions";
            } else {
                $category = "News";
            }

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $rest['url']);
                curl_setopt($ch, CURLOPT_HTTPHEADER, [
                    'Content-Type: application/json',
                    'Authorization: Basic ' . base64_encode($rest['user'] . ':' . $rest['pass']),
                ]);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
                $result = curl_exec($ch);
                $response_data = json_decode($result);
        
                curl_close($ch);

                $category1 = "0";
                $category2 = "0";
                $cat_array = array();
                foreach ($response_data as $lst) {
                    if ($lst->name == $category){
                        $category1 = $lst->id;
                    }
                    if ($lst->name ==$str){
                        $category2 = $lst->id;
                    }
                    if($category2=='0'){
                        $category2 = $category1;
                    } 
                }
                $cat_array = array('cat1' => $category1, 'cat2' => $category2);
                return $cat_array;
         }

        public function check_wp_exist($info,$rest)
        {

            $title = $info['title'];
            $datepost = $info['date'];

            echo $title."<br><br><br>";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $rest['url']);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode($rest['user'] . ':' . $rest['pass']),
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
            $result = curl_exec($ch);
            $data = json_decode($result);

            curl_close($ch);
            foreach ($data as $lst) {
                if ($lst->title->rendered==$title){
                    echo $lst->slug;
                }
            }

        }


        public function wppostsearch()
        {
          
           if(!empty($_POST['pub_url'])) {  

                $keywords = $_POST['keywords'];
                if(!empty($keywords)) {  

                    $pubSite = new PublicationsModel();
                    $pubid = $_POST['pub_url'];

                    $datarest = $pubSite->where('wordpress_url', $pubid)->first();
                    $rest_api_url = $datarest['wp_rest_api_endpoint_link']."posts?search=".$keywords;
                    $wp_uname = $datarest['wp_rest_api_user'];
                    $wp_pass = $datarest['wp_rest_api_pass'];

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $rest_api_url);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                            'Content-Type: application/json',
                            'Authorization: Basic ' . base64_encode($wp_uname . ':' . $wp_pass),
                        ]);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                
                        $result = curl_exec($ch);
                        $response_data = json_decode($result);
                        curl_close($ch);

                        if(empty($response_data)){
                                echo "No record found in keywords: ".$keywords;
                        } else {
                            foreach ($response_data as $lst) {
                            echo $lst->title->rendered."<br>";
                            }
                        }

                } else {
                    echo "Keywords is Empty!";
                }
                
            } else {
                echo "Please select location!";
            }

        }


        public function totalcount()
        {
            $txtfile = "progress.txt";


            if (file_exists($txtfile)){

                header('Content-type: application/json');
                $conents_arr   = file($txtfile,FILE_IGNORE_NEW_LINES);
                foreach($conents_arr as $key=>$value)
                {
                   $conents_arr[$key]  = rtrim($value, "\r");
                }
                $json_contents = json_encode($conents_arr);
                echo $json_contents;

             } else {
                $file_handle = fopen($txtfile, 'w');
             }
        }
        


        public function writecount($numpost,$count){

            $count = ($count / $numpost) * $numpost;
            $txtfile = "progress.txt";
            $myfile = fopen($txtfile, "w") or die("Unable to open file!");
            $txt = $numpost . "\n";
            fwrite($myfile, $txt);
            $txt = $count;
            fwrite($myfile, $txt);
            fclose($myfile);
        }

        public function testxml(){

           
            $xml = "file:///C:/xampp/htdocs/pandpsites/Fleurieu_Sun_1684282907/articles_20.xml";                                                         
  
            $html   = file_get_contents($xml);
            $invalid_characters = '/[^\x9\xa\x20-\xD7FF\xE000-\xFFFD]/';
            $html = preg_replace($invalid_characters, '', $html);
            $xml = simplexml_load_string($html);

            echo $xml->article->count();
       
            echo "<pre>";
            // print_r($xml);
            echo "</pre>";

            // if ($xml === false) {
            // echo "Failed loading XML: ";
            //     foreach(libxml_get_errors() as $error) {
            //         echo "<br>", $error->message;
            //     }
            // } else {
            // // print_r($xml);
            //     foreach($xml as $child){
            //         echo "<br>".$child['article'] . " has " 
            //             . $child->count()." child.";
            //     }
            // }

    }


}
