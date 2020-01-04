<?php

    class Log_model extends CI_Model{

        public function __construct(){
            parent::__construct();
            $this->load->database();
            date_default_timezone_set('Asia/Jakarta');
        }

        public function write_log($log_data){
            $this->db->insert('tefa_log', $log_data);
        }

        public function get_specific_log($param){
            $this->db->select('id_log, log_date, log_activity, log_description, tefa_account.full_name, tefa_account.id, tefa_account.username, tefa_account.profile_images, tefa_account_roles.role_name, tefa_account_roles.id_role');
            $this->db->from('tefa_log');
            $this->db->where($param);
            $this->db->join('tefa_account', 'tefa_log.log_user = tefa_account.id');
            $this->db->join('tefa_account_roles', 'tefa_account_roles.id_role = tefa_account.role');
            $result = $this->db->get()->result_array();
            if( !$result ){
                return false;
                die;
            }
            return $result;
        }

        public function get_all_logs(){
            $this->db->select('id_log, log_date, log_activity, log_description, tefa_account.full_name, tefa_account.id, tefa_account.username, tefa_account.profile_images, tefa_account_roles.role_name, tefa_account_roles.id_role');
            $this->db->from('tefa_log');
            $this->db->join('tefa_account', 'tefa_log.log_user = tefa_account.id');
            $this->db->join('tefa_account_roles', 'tefa_account_roles.id_role = tefa_account.role');
            $result = $this->db->get()->result_array();
            if( !$result ){
                return false;
                die;
            }
            return $result;
        }

    }