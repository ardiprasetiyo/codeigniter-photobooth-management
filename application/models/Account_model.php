<?php

    class Account_model extends CI_Model{

        public function __construct(){
            parent::__construct();
            $this->load->database();
            date_default_timezone_set('Asia/Jakarta');
        }

        private function set_last_login($id){
            $option = ['last_login' => time()];
            $this->db->where('id', $id);
            $this->db->update('tefa_account', $option);
        }

        public function is_exist_account($param){
            $this->db->select('id');
            $this->db->from('tefa_account');
            $this->db->where($param);
            $result = $this->db->get()->result_array();
            if( !empty($result) ){
                return true;
                die;
            }
            return false;
        }

        public function get_account($data){
            $this->db->select('id, username, full_name, email, last_login, is_active, role, role_name, profile_images');
            $this->db->from('tefa_account');
            $this->db->join('tefa_account_roles', 'tefa_account.role = tefa_account_roles.id_role');
            $this->db->where($data);
            $result = $this->db->get()->result_array();
            if( !$result ){
                return false;
            }
            $this->set_last_login($result[0]['id']);
            return $result[0];
        }

        public function get_all_roles(){
            $this->db->select('*');
            $this->db->from('tefa_account_roles');
            $result = $this->db->get()->result_array();
            if( !$result ){
                return false;
            }
            return $result;
        }

        public function add_account($data){
            $result = $this->db->insert('tefa_account', $data);
            if( !$result ){
                return false;
            }
                return true;
        }

        public function edit_account($target_id, $data){
            $this->db->where('id', $target_id);
            $result = $this->db->update('tefa_account', $data);
            if( !$result ){
                return false;
            }
                return true;
        }

        public function remove_account($param){
           $this->db->where($param);
           $result = $this->db->delete('tefa_account');
           if( !$result ){
                return false;
            }
                return true;
        }

    }