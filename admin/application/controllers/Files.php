<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Files extends CI_Controller {
    function __construct() {
        parent::__construct();
        access();
    }

    function request($id = null) {
        $request = $this->db->select("users.email,profiles.firstname,profiles.lastname,files_requests.*,originals.file_name,originals.name as original_name,originals.path as original_path,repaireds.name as repaired_name,repaireds.path as repaired_path,repaireds.file_name as repaired_file_name,ref_methods.method,ref_gearboxes.gearbox")
                            ->where("files_requests.id",$id)
                            ->join('users',"users.id = files_requests.user")
                            ->join('profiles',"profiles.user = files_requests.user")
                            ->join('ref_methods',"ref_methods.id = files_requests.method")
                            ->join('ref_gearboxes',"ref_gearboxes.id = files_requests.gearbox")
                            ->join('files as originals',"originals.id = files_requests.original_file")
                            ->join('files as repaireds',"repaireds.id = files_requests.repaired_file","left")
                            ->get('files_requests')->row_array();

        //conversation handle
        $conversation = $this->db->where('entry',"files_requests")->where('entry_id',$request['id'])->get('conversations')->row_array();
        if(!$conversation) {
            $conversation = [
                "entry" => "files_requests",
                "entry_id" => $request['id'],
                "created" => stamp(),
                "updated" => stamp()
            ];
            $this->db->insert('conversations',$conversation);
            $conversation['id'] =$this->db->insert_id();
        }
        $data['conversation'] = $conversation;
        //
        if(!$request) {
            show_404();
        }
        $request['options'] = $this->db->select('ref_options.*')->where("requests_options.request",$id)->join("ref_options","ref_options.id = requests_options.option")->get('requests_options')->result_array();

        $data['request'] = $request;
        $this->load->view('files/request',$data);
    }
    
    function search($page = 1) {

        $this->db->select("*");

        if(isset($_GET['mark']) && $_GET['mark'] !== "") {
            $this->db->like("mark",$_GET['mark']);
        }

        if(isset($_GET['model']) && $_GET['model'] !== "") {
            $this->db->like("model",$_GET['model']);
        }

        if(isset($_GET['vin']) && $_GET['vin'] !== "") {
            $this->db->like("vin",$_GET['vin']);
        }

        //$this->db->where("files_requests.status != 'canceled'");

        $counter = clone $this->db;
        $data['pages'] = pages($counter->count_all_results("files_requests"),$page);
        $data['base_link'] = base_url()."files/search/";
        $this->db->join('users',"users.id = files_requests.user");
        $requests = $this->db->select('files_requests.*,users.email')->limit(LIMIT,($page - 1) * LIMIT)->order_by("files_requests.id","desc")->get('files_requests')->result_array();
        //calculate bg
        foreach($requests as $i => $request) {
            $requests[$i]['bg'] = ($request['status'] == "canceled" ? "bg-red" : null);
        }
        $data['requests'] =  $requests;
        $this->load->view("files/search",$data);
    }

    function save($request = null,$file = null) {
        if($request && $file) {
            $set = [
                "repaired_file" => $file,
                "updated" => stamp(),
                "status" => "repaired" // pending / repaired / delivered
            ];
            $this->db->where("id",$request)->set($set)->update('files_requests');
        }
    }

    function deliver($request = null) {
        access();
        if($request) {
            $set = [
                "processed" => stamp(),
                "status" => "delivered",
                "updated" => stamp()
            ];
            $this->db->where("id",$request)->set($set)->update('files_requests');

            //send email
            $request = $this->db->where("id",$request)->get('files_requests')->row_array();
            $user = $this->db->where("id",$request['user'])->get('users')->row_array();
            $profile = $this->db->where("user",$request['user'])->get('profiles')->row_array();
            $this->load->library('email');
		
            $this->email->from('info@chiptuning-file.com', 'Chiptuning File');
            $this->email->to($user['email']); 
            $this->email->set_header("From", "info@chiptuning-file.com");
            $this->email->set_header("Reply-To", "info@chiptuning-file.com");
            $this->email->set_header("Return-Path", "info@chiptuning-file.com");
            $this->email->subject('Your File Is Ready To Download');
            $this->email->message('Dear <b>'.$profile['firstname'].'</b> , The requested file for '.ucwords($request['mark'])." - ".ucwords($request['model']).' is ready for download . go to <a href="'.str_replace("admin.","",base_url()).'files/requests/?id='.$request["id"].'">Your File Request Here</a> to check it out .');  
    
            $result = $this->email->send();
            var_dump($result);
            //
        }
    }

    function cancel($request = null) {
        if($request) {

            $request = $this->db->where('id',$request)->get('files_requests')->row_array();
            //validate status 
            if($request['status'] == "canceled") {
                exit();
            }
            //get options
            $options = $this->db->select('ref_options.price')
                                ->where('request',$request['id'])
                                ->join('ref_options',"ref_options.id = requests_options.option")
                                ->get('requests_options')
                                ->result_array();
            $refund = 0;
            foreach($options as $option) {
                $refund += $option['price'];
            }

            //process refund
            $dbUser = $this->db->where('id',$request['user'])->get('users')->row_array();
            //update

            $userSet = [
                "balance" => $dbUser['balance'] + $refund,
                "reserved" => ($request['status'] == "delivered" ? $dbUser['reserved'] : $dbUser['reserved'] - $refund),
                "updated" => stamp()
            ];
            $this->db->where('id',$dbUser['id'])->set($userSet)->update('users');
            //
            $set = [
                "status" => "canceled",
                "updated" => stamp()
            ];
            $this->db->where("id",$request['id'])->set($set)->update('files_requests');
        }
    }

    function upload() {
        access();
        $allowed = ['zip',"rar","tar","gzip","jpeg","jpg","png","bin"];
        if(isset($_FILES['file'])) {
            //check uploadity
            if(!is_dir(UPLOADS)) {
                mkdir(UPLOADS);
                mkdir(UPLOADS."users");
            }
            //
            $subDir = "users".DS.$_SESSION['user']['id'].DS;
            //calculate/create subdir
            if(!is_dir(UPLOADS.$subDir)) {
                mkdir(UPLOADS.$subDir);
            }
            //
            $file = $_FILES['file'];
            $ext = preg_replace("#\?.*#", "", pathinfo($file['name'], PATHINFO_EXTENSION));
            if(!in_array($ext,$allowed)) {
                show_404();
                exit();
            }
            $user = $_SESSION['user'];
            $dbFile = array(
                "name" => $user["id"]."_".substr(md5($file['name']),0,12)."_".time().".".$ext,
                "user" => $user['id'],
                "file_name" => $_FILES['file']['name'],
                "path" => $subDir,
                "created" => stamp(),
                "updated" => stamp()
            );
            
            $this->db->insert('files',$dbFile);
            $dbFile['id'] = $this->db->insert_id();
            move_uploaded_file($file['tmp_name'],UPLOADS.$dbFile['path'].$dbFile['name']);
            j(['status' => "ok","data" => $dbFile]);
        } else {
            show_404();
        }
    }
}