<?php
class User extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get($limit, $offset) {
        return $this->db->select("users.*,profiles.user, profiles.firstname, profiles.lastname ,profiles.firstname, profiles.type,profiles.skype,profiles.paypal")
                        ->from('users')
                        ->join("profiles", "profiles.user = users.id")
                        ->where('status', 'active')
                        ->limit($limit, $offset)
                        ->order_by('users.id', 'DESC')
                        ->get()->result_array();
    }

    function get_by_email($email) {
        if ($email) {
            return $this->db->select("*")
			->from('users')
			->where('email', $email)
			->get()
			->row_array();
        }
    }

    function get_roles($user = NULL) {
        if($user) {
            return $this->db->select("roles.name")
			->from('users_roles')
			->where('user',$user)
            ->join('roles',"roles.id = users_roles.role")
            ->get()
			->result_array();
        }
    }

    function get_available_roles() {
        return $this->db->select('id, name as role')->from('roles')->order_by('name')->get()->result_array();
    }

    function get_by_query($q) {
        if ($q) {
            return $this->db->select("*")
			->from('users')
			->or_where('email', $q)
            ->or_where("username",$q)
			->get()
			->row_array();
        }
    }

    function search_by_name($k) {
        if($k) {
            return $this->db->select("users.*,profiles.firstname,profiles.lastname,profiles.profile_pic,profiles.phone,profiles.about,profiles.company,profiles.position,ref_types.name as refType")
			->from('users')
			->join("profiles","profiles.user_id = users.id")
			->join("ref_types","ref_types.id = users.type","left")
			->or_like('profiles.first_name', $k)
			->or_like('profiles.last_name', $k)
			->get()
			->result_array();
        }
    }

    function get_by_id($id) {
        if ($id) {
            return $this->db->select("profiles.*,users.*")
			->from('users')
			->join("profiles","profiles.user = users.id")
			->where('users.id', $id)
			->get()
			->row_array();
        }
    }
    
    function remove_roles($user) {
        if($user) {
            $this->db->where('user', $user)->delete('users_roles');
        }

    }

    function get_users_roles($user) {
        return $this->db->select('*')->from('users_roles')->where('user', $user)->get()->result_array();
    }

    function get_roles_by_id($id) {
        if($id){
            return $this->db->select("roles.*, users_roles.user, users.id")
                            ->join('users_roles', 'users_roles.role = roles.id')
                            ->join('users', 'users.id = users_roles.user')
                            ->get('roles')->result_array();
        }
    }

    function insert($user) {
        if($user) {
            $this->db->insert('users',$user);
            return $this->db->insert_id();
        }
    }

    function update($user) {
        if ($user) {
            return $this->db->where("id",$user['id'])->set($user)->update("users");
        }
    }

    function remove($id) {

        if($id) {
            $status['status'] = 'deleted';
            $this->db->where("id", $id)->update('users', $status);
        }
    }
}