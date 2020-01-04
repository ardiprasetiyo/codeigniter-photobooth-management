<?php

    class Editing_model extends CI_Model{

        public function __construct(){
            parent::__construct();
            $this->load->database();
            date_default_timezone_set('Asia/Jakarta');
        }

        public function is_exist_list($param){
            $this->db->select('*');
            $this->db->from('tefa_editing');
            $this->db->where($param);
            $result = $this->db->get()->result_array();
            if( !$result ){
                return false;
            }
            return true;
        }

        public function add_editing_list($param){
            $result = $this->db->insert('tefa_editing', $param);
            if( !$result ){
                return false;
            }
            return true;
        }

        public function remove_editing_list($param){
            $this->db->where($param);
            $result = $this->db->delete('tefa_editing');
            if( !$result ){
                return false;
            }
            return true;
        }

        public function update_editing_list($param, $updated_data){
            $this->db->where($param);
            $result = $this->db->update('tefa_editing', $updated_data);
            if( !$result ){
                return false;
            }
            return true;
        }

        public function get_editing_list($param){
            $this->db->select('*');
            $this->db->from('tefa_editing');
            $this->db->where($param);
            $result = $this->db->get()->result_array();
            if( !$result ){
                return false;
            }
            return $result;
        }
    }