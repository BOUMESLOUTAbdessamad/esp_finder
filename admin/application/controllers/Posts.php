<?php 

class Posts extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("post");
        access();
    }

    function search($page = 1) {

        $this->db->select('posts.*,files.path as image_path,files.name as image_name')
            ->join('files',"files.id = posts.image","left")
            ->order_by("id", "DESC");

        $count_db = clone $this->db;
        
        $data['pages'] = pages($count_db->count_all_results('posts'),$page);
        $data['posts'] =  $this->db->limit(LIMIT,($page -1) * LIMIT)->get('posts')->result_array();
        $data['base_link'] = base_url()."posts/search/";
        $this->load->view('news/search', $data);
    }

    function edit($id = NULL) {

        //post();
        $data['method'] = ($id ? "edit" : "create");
        $errors = [];
        $dbPost = null;
        $Ppost = null;
        if($id)  {
            $dbPost = $this->post->get_by_id($id);
        }
        

        if(isset($_POST['action'])) {
            
            $Ppost = $_POST['post'];
            
            if(!isset($Ppost['title'])) $errors[] = "Title can't be empty";
            

            if(!isset($Ppost['content'])) $errors[] = "Content can't be empty";
             

            $post = [
                    "user"    => $_SESSION['user']['id'],
                    "title"   => $Ppost['title'],
                    "content" => $Ppost['content'],
                    "image" => $Ppost['image'],
                    "created" => stamp(),
                    "updated" => stamp()
            ];

            if($_POST['action'] == "create" ) {

                if($post) {
                    $Ppost['id'] = $this->post->insert($post);

                    redirect(base_url().'posts/search');
                }
            }

            if($_POST['action'] == "edit") {

                if(!$errors){
                    $post['id'] = $id;
                    $this->post->update($post);
                    
                    redirect(base_url().'posts/search');
                }
            }
            
        } else {
            if($dbPost) {
                $_POST['post'] = $dbPost;
            }
        }

        $data['errors'] = $errors;
        $this->load->view('news/edit', $data);
    }

    function remove($id) {
        if($id) {
            $this->post->remove($id);
            redirect(base_url().'posts/search');
        }
           
    }
}

?>