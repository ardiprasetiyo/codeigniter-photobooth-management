<?php 


    class Auth_Controller extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library(['form_validation', 'session']);
            $this->load->helper('url');
            $this->load->model('Account_model');
            $this->load->model('Log_model');
            date_default_timezone_set('Asia/Jakarta');
        }

        private function write_log($date, $id_user, $activity, $description){

            $log_data = ['log_date' => $date, 
                         'log_user' => $id_user, 
                         'log_activity' => $activity,
                         'log_description' => $description];
            $this->Log_model->write_log($log_data);
        }

        public function login(){

            if( $this->session->userdata('user_data') ){
                $user_role = $this->session->userdata('user_data')['role_name'];
                redirect(strtolower($user_role) . '/');
            }

            $flash = $this->session->userdata('login_err');
            if( !$flash ){
                $flash = null;
            }

            $this->load->view('login', ['login_err' => $flash]);
            $this->session->unset_userdata('login_err');
        }
        
        public function do_login(){

            $username = $this->input->post('username', true);
            $password = hash("sha256", $this->input->post('password', true));
            $is_she_remember_me = $this->input->post('remember-me', true);

            // Aturan validasi
            $config = [['field' => 'username',
                        'label' => 'Username',
                        'rules' => 'trim|required'],

                       ['field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|required']];

            // Validasi form
            $is_valid = $this->form_validation->set_rules($config)->run();
            if( !$is_valid ){
                $this->session->set_userdata(['login_err' => ['note' => validation_errors()]]);
                redirect('login');
                die;
            }

            // Cek keabsahan username password
            $data = ['username' => $username, 'password' => $password, 'is_active' => 1];
            $valid_user_data = $this->Account_model->get_account($data);
            if( !$valid_user_data ){
                $this->session->set_userdata(['login_err' => ['note' => 'Akun tidak ditemukan <br> <br>']]);
                redirect('login');
                die;
            }

            $userdata = ['id' => $valid_user_data['id'],
                         'username' => $valid_user_data['username'],
                         'full_name' => $valid_user_data['full_name'],
                         'role_id' => $valid_user_data['role'],
                         'role_name' => $valid_user_data['role_name']];
            
            $this->write_log(time(), $userdata['id'], 'Login Aplikasi', 'Melakukan request login kedalam aplikasi');
            $this->session->set_userdata('user_data', $userdata);   
            redirect(strtolower($userdata['role_name']) . '/');
        }

        public function logout(){
            $this->session->unset_userdata(['user_data']);
            redirect('login');
            die;
        }

    }