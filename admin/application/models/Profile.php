<?php

class Profile extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function update($profile) {
        if (isset($profile["id"])) {
            return $this->db->where("id",$profile['id'])->set($profile)->update("profiles");
        } else if  (isset($profile['user'])) {
            return $this->db->where("user",$profile['user'])->set($profile)->update("profiles");
        }
    }
    
    function get_by_user($id) {
        if($id) {
            return $this->db->where('user',$id)->from("profiles")->get()->row_array();
        }
    }
    
    function get_by_ids($ids) {
        if($ids) {
            return $this->db->select("profiles.id,profiles.first_name,profiles.last_name,profiles.user_id,profiles.profile_pic,files.name as avatar_name,files.path as avatar_path")
                            ->from("profiles")
                            ->join("files","files.id = profiles.profile_pic","left")
                            ->where_in('profiles.user',$ids)
                            ->get()
                            ->result_array();
        }
    }
    
    function insert($profile) {
        if($profile) {
            $this->db->insert('profiles',$profile);
            return $this->db->insert_id();
        }
    }
    
}
