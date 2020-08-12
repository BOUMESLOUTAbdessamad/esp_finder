<?php

class Model extends CI_Model {
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_marks() {
        return $this->db->select('*')
                        ->from('marks')
                        ->order_by('name', 'ASC')
                        ->get()->result_array();
    }
    function get_by_id($id) {
        if($id) {
            return $this->db->where('id',$id)->from("models")->get()->row_array();
        }
    }

    function insert($model) {
        if($model) {
            $this->db->insert('models', $model);
            return $this->db->insert_id();
        }
    }

    function update($model) {
        if($model){
            $this->db->where('id', $model['id'])->set($model)->update('models');
        }
    }

    function remove($id) {
        if($id) {
            $this->db->where('id', $id)->delete('models');
        }
    }
}