<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model("location");
        // access();
    }


    function test() {
       echo n_crypt('123456');
    }

    function login() {
        //process login
        $errors = [];
        if(isset($_POST['action']) && $_POST['action'] == "login") {
            $user = $this->user->get_by_query(strtolower($_POST['email']));
            //users existance
            if(!$user) {
                $errors[] = "Invalid Credentials";
            } else {
                //check password
                if($user['password'] != n_crypt($_POST['password'])) {
                    $errors[] = "Invalid Credentials";
                } else {
                    //check role
                    if($user['role'] != "admin") {
                        $errors[] = "Access Denied";
                    } else {
                        //store session and go back home
                        // $user['profile'] = $this->profile->get_by_user($user['id']);
                        $_SESSION['user'] = $user;
                        redirect(base_url());
                    }
                }
            }
        }

        //don't allow logged in users
        if(isset($_SESSION['user']) && $_SESSION['user']) {
            redirect(base_url());
            exit();
        } else {
            $this->load->view('users/login',["errors" => $errors]);
        }
    }

    function logout() {
        session_destroy();
        redirect(base_url());
    }

    function edit($id = null) {
        $data['method'] = ($id ? "edit" : "create");
        $errors = [];
        $dbUser = null;
        // $dbProfile = null;

        if($id) {
            $dbUser = $this->db->where('id',$id)->get('users')->row_array();
            // $dbProfile = $this->db->where('user',$id)->get('profiles')->row_array();
        }

        if(isset($_POST['action'])) {

            $pUser = $_POST['user'];
            // $pProfile = $_POST['profile'];

            //validation process

            if(!$pUser['username'] || strlen($pUser['username']) < 3) {
                $errors[] = "Invalid User username";
            }

            if(!$pUser['password'] || strlen($pUser['password']) < 6) {
                $errors[] = "Password must be > 6";
            }

            if(!$pUser['firstname'] || strlen($pUser['firstname']) < 3) {
                $errors[] = "Invalid User First Name";
            }

            if(!$pUser['lastname'] || strlen($pUser['lastname']) < 3) {
                $errors[] = "Invalid User Last Name";
            }

            if(!$pUser['email'] || !filter_var($pUser['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid User Email";
            }

            $user = [
                "email"            => strtolower($pUser['email']),
                "username"         => $pUser['username'],
                "firstname"        => $pUser['firstname'],
                "lastname"         => $pUser['lastname'],
                "password"         => n_crypt($pUser['password']),
                "domain"           => $_SERVER['HTTP_HOST'],
                "email_activation" => uniqid("CHIP".(int) time() % 3),
                "sms_activation"   => rand(11111,99999),
                "status"           => "active",
                'created_at' => stamp()
            ];

            // $profile = [
            //     "user"        => $id,
            //     "firstname"   => $pProfile['firstname'],
            //     "lastname"    => $pProfile['lastname'],
            //     "skype"       => $pProfile['skype'],
            //     "paypal"      => $pProfile['paypal'],
            //     //"birthdate"   => $pProfile['birthdate'],
            //     // "type"        => $pProfile['type'],
            //     "city"        => $pProfile['city'],
            //     "country"     => $pProfile['country'],
            //     "zipcode"     => $pProfile['zipcode']
            // ];

            if($_POST['action'] == "create") {
                if(!$errors) {
                    $user['id'] = $this->user->insert($user);
                    // $profile['user'] = $user['id'];
                    // $profile['id'] = $this->profile->insert($profile);
                    unset($user['password']);
                    redirect(base_url()."users/search/");
                }
            }

            if($_POST['action'] == "update") {
                if(!$errors) {
                    $user['id'] = $id;
                    $user['updated_at'] = stamp();
                    // $profile['updated'] = stamp();

                    if($user) {
                        $this->user->update($user);
                        // $this->profile->update($profile);
                    }
                    redirect(base_url()."users/search/");
                }
            }
        } else {
            if($dbUser) {
                $dbUser['password'] = n_decrypt($dbUser['password']);
                $_POST['user'] = $dbUser;
                // $_POST['profile'] = $dbProfile;
            }
        }

        $data['errors'] = $errors;
        $this->load->view("users/edit",$data);
    }

    function auth() {
        $errors = [];
        //password
        if(strlen($_POST['password']) < 6) {
            $errors[] = "Invalid Password Input";
        }

        //email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid Email Input";
        }

        if(!$errors) {
            //email db check
            $user = $this->user->get_by_email(strtolower($_POST['email']));
            if (!$user) {
                $errors[] = "Invalid Credentials";
            } else {
                //email in => check password
                //new db check
                if($user["password"] == n_crypt($_POST['password'])) {
                    //normal auth
                    unset($user["password"]);
                    $_SESSION['user'] = $user;
                    j(["status" => "ok","data" => $user]);
                }
            }
        }

        if($errors) {
            j(['status' => "error","data" => $errors]);
        }
    }

    function search($page = 1) {

        $this->db->select("users.*")
                    ->where('status', 'active');

        if(isset($_GET['email']) && $_GET['email'] !== "") {
            $this->db->like("users.email",strtolower($_GET['email']));
        }

        if(isset($_GET['firstname']) && $_GET['firstname'] !== "") {
            $this->db->like("users.firstname",$_GET['firstname']);
        }

        if(isset($_GET['lastname']) && $_GET['lastname'] !== "") {
            $this->db->like("users.lastname",$_GET['lastname']);
        }



        $count_db = clone $this->db;
        $data['pages'] = pages($count_db->count_all_results('users'),$page);

        $data['users'] = $this->db->limit(LIMIT, ($page -1) * LIMIT)->order_by('users.id', 'DESC')->get('users')->result_array();

        $data['base_link'] = base_url()."users/search/";
        $this->load->view('users/search', $data);
    }

    function remove($id) {
        if($id) {
            $this->user->remove($id);
        }
        redirect(base_url() . "users/search");
        exit();
    }

}
