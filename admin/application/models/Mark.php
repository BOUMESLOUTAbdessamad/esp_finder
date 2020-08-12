<?php

class Mark extends CI_Model {
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    

    function get_by_name($name) {
        if($name) {
            return $this->db->where('marks.name',$name)->from("marks")->get()->row_array();

        }
    }

}