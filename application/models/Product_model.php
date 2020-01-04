<?php

    class Product_model extends CI_Model{

        public function __construct(){
            parent::__construct();
            $this->load->database();
            date_default_timezone_set('Asia/Jakarta');
        }

        public function is_exist($product_param){
            $this->db->select('*');
            $this->db->from('tefa_product');
            $this->db->where($product_param);
            $result = $this->db->get()->result_array();
            if( !$result ){
                return false;
                die;
            }
            return true;
        }

        public function get_product($param = false){
            $this->db->select('*');
            $this->db->from('tefa_product');
            if( $param ){
                $this->db->where($param);
            }
            $result = $this->db->get()->result_array();
            if( !$result ){
                return false;
            }
            return $result;
        }

        public function add_product($product_data){
            $result = $this->db->insert('tefa_product', $product_data);
            if( !$result ){
                return false;
            }
            return true;
        }

        public function edit_product($product_data, $param){
            $this->db->where($param);
            $result = $this->db->update('tefa_product', $product_data);
            if( !$result ){
                return false;
            }
            return true;
        }

        public function remove_product($param){
            $this->db->where($param);
            $result = $this->db->delete('tefa_product');
            if( !$result ){
                return false;
            }
            return true;
        }

    }