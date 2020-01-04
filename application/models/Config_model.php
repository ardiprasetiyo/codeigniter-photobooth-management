<?php

    class Config_model extends CI_Model{

        public function __construct(){
            parent::__construct();
            $this->load->database();
            date_default_timezone_set('Asia/Jakarta');
        }


        public function get_config_value($param){
            $this->db->select('*');
            $this->db->from('tefa_tom_config');
            $this->db->where($param);
            $result = $this->db->get()->result_array();
            if( !$result ){
                return false;
                die;
            }
            return $result;
        }

    }