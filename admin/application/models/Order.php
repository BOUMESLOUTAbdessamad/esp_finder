<?php

class Order extends CI_Model {
    function __construct() {
        // Call the Model constructor
        parent::__construct();

    }


    function get($limit, $offset) {
        return $this->db->select("orders.*, users.username, packs.price")
                        ->from("orders")
                        ->join("users", "orders.user = users.id")
                        ->join("packs","orders.pack = packs.id")
                        ->limit($limit, $offset)
                        ->order_by("orders.id", "DESC")
                        ->get()
                        ->result_array();
    }

    function get_pending($limit, $offset) {
        return $this->db->select("orders.*, users.username, packs.price")
                        ->from("orders")
                        ->join("users", "orders.user = users.id")
                        ->join("packs","orders.pack = packs.id")
                        ->where("orders.status", "pending")
                        ->limit($limit, $offset)
                        ->order_by("orders.id", "DESC")
                        ->get()
                        ->result_array();
    }
    function get_paid($limit, $offset) {
        return $this->db->select("orders.*, users.username, packs.price")
                        ->from("orders")
                        ->join("users", "orders.user = users.id")
                        ->join("packs","orders.pack = packs.id")
                        ->where("orders.status", "paid")
                        ->limit($limit, $offset)
                        ->order_by("orders.id", "DESC")
                        ->get()
                        ->result_array();
    }
}