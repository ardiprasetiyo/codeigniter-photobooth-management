<?php

    class Tracking_model extends CI_Model{

        public function __construct(){
            parent::__construct();
            $this->load->database();
            date_default_timezone_set('Asia/Jakarta');
        }

        public function is_exist_tracking($param){
            $this->db->select('id_tracking');
            $this->db->from('tefa_order_tracking');
            $this->db->where($param);
            $result = $this->db->get()->result_array();
            if( !empty($result) ){
                return true;
                die;
            }
            return false;
        }

        public function get_tracking($param){
            $this->db->select('*');
            $this->db->from('tefa_order_tracking');
            $this->db->where($param);
            $result = $this->db->get()->result_array();
            if( !$result ){
                return false;
                die;
            }
            return $result;
        }

        public function add_tracking($tracking_data){
            $result = $this->db->insert('tefa_order_tracking', $tracking_data);
            if( !$result ){
                return false;
                die;
            }
            return true;
        }

        public function update_tracking($new_tracking, $param){
            $this->db->where($param);
            $result = $this->db->update('tefa_order_tracking', $new_tracking);
            if( !$result ){
                return false;
                die;
            }
            return true;
        }

    }