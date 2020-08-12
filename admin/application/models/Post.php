<?php

class Post extends CI_Model {
    function __construct() {
        // Call the Model constructor
        parent::__construct();

    }
    
    function get($limit) {

        return $this->db->select('posts.*, users.id as user, users.username,  profiles.firstname, profiles.lastname')
                        ->join('users', 'posts.user = users.id')
                        ->join('profiles', 'users.id = profiles.user')
                        ->limit($limit)
                        ->from('posts')
                        ->order_by("id", "DESC")
                        ->get()->result_array();
    }
    
    function insert($post) {
        if($post) {
            $this->db->insert("posts",$post);
            return $this->db->insert_id();
        }
    }

    function get_by_id($id) {
        if($id) {
            return $this->db->select("posts.*,profiles.firstname,profiles.lastname,files.path as cover_path")->from('posts')
            ->join("profiles","profiles.user = posts.user")
            ->join("files","files.id = profiles.picture","left")
            ->join("users","users.id = posts.user")
            ->where("posts.id",$id)
            ->get()
            ->row_array();
        }
    }
    
    function update($post) {
        if($post) {
            return $this->db->where("id",$post['id'])->update('posts',$post);
        }
    }
	
    function remove($post) {
        if($post) {
            $this->db->where('id',$post)->delete("posts");
        }
    }
    
    function get_posts($page = 1) {
        if ($page) {
            return $this->db->distinct()->select("posts.*,profiles.firstname,profiles.title,profiles.lastname,files.path as avatar_path,files.name as avatar_name")->from('posts')
            ->join("profiles","profiles.user = posts.user")
            ->join("files","files.id = profiles.picture","left")
            ->join("users","users.id = posts.user")
            ->limit(15)
            ->order_by("id","DESC")
            ->get()
            ->result_array();
        }
    }




}