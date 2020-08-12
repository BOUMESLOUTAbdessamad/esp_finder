<?php
class Location extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_countries() {
        return $this->db->select('*')
                    ->from("countries")
                    ->order_by("name", "ASC")
                    ->get()->result_array();
    }

}