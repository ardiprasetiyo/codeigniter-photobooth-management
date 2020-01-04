<?php

    class Order_model extends CI_Model{

        public function __construct(){
            parent::__construct();
            $this->load->database();
            date_default_timezone_set('Asia/Jakarta');
        }

        public function is_exist($order_param){
            $this->db->select('*');
            $this->db->from('tefa_order');
            $this->db->where($order_param);
            $result = $this->db->get()->result_array();
            if( !$result ){
                return false;
                die;
            }
            return true;
        }

        public function get_order($param = false){
            $this->db->select('*');
            $this->db->from('tefa_order');
            if( $param ){
                $this->db->where($param);
            }
            $result = $this->db->get()->result_array();
            if( !$result ){
                return false;
            }
            return $result;
        }

        public function get_order_details($param){
            $this->db->select('*');
            $this->db->from('tefa_order_details');
            $this->db->where($param);
            $this->db->join('tefa_product', 'tefa_order_details.order_product = tefa_product.id_product');
            $result = $this->db->get()->result_array();
            if( !$result ){
                return false;
            }
            return $result;
        }
        

        public function add_order($order_data){
            $result = $this->db->insert('tefa_order', $order_data);
            if( !$result ){
                return false;
            }
            return true;
        }

        public function add_order_detail($order_data){
            $result = $this->db->insert('tefa_order_details', $order_data);
            if( !$result ){
                return false;
            }
            return true;
        }

        public function update_order_details($data, $param){
            $this->db->where($param);
            $result = $this->db->update('tefa_order_details', $data);
            if( !$result ){
                return false;
            }
            return true;
            
        }


        public function remove_order_details($param){
            $this->db->where($param);
            $result = $this->db->delete('tefa_order_details');
            if( !$result ){
                return false;
            }
            return true;
            
        }

        public function update_order($data, $param){
            $this->db->where($param);
            $result = $this->db->update('tefa_order', $data);
            if( !$result ){
                return false;
            }
            return true;
        }


    }