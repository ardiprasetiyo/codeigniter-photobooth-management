<?php

    class Su_Controller extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library(['form_validation', 'session']);
            $this->load->helper('url');
            $this->load->model('Account_model');
            $this->load->model('Log_model');
            date_default_timezone_set('Asia/Jakarta');
            if( !$this->session->userdata('user_data') || $this->session->userdata('user_data')['role_id'] != 1 ){
                redirect('login');
                die;
            }
        }

        private function write_log($date, $id_user, $activity, $description){

            $log_data = ['log_date' => $date, 
                         'log_user' => $id_user, 
                         'log_activity' => $activity,
                         'log_description' => $description];
            $this->Log_model->write_log($log_data);
        }

        public function home(){
            $this->load->view('superadmin/template/header');
            $this->load->view('superadmin/home');
            $this->load->view('superadmin/template/footer');
        }


        // Account Management

        public function add_account(){
            $roles = $this->Account_model->get_all_roles();
            if( !$roles ){
                $roles = null;
            }
            $this->load->view('superadmin/add_account', ['roles' => $roles]);
        }

        public function remove_account($user_id = null){
            $user_data = $this->Account_model->get_account(['id' => $user_id]);
            if( !$user_data ){
                echo json_encode(['status' => 'false', 'message' => 'Tidak ada akun ditemukan']);
                die;
            }

            $this->load->view('superadmin/remove_account', ['user_data' => $user_data]);
        }

        public function do_remove_account(){
            $rules = [['field' => 'id-account',
                      'label' => 'ID Account',
                      'rules' => 'trim|required|integer']];

            $is_valid = $this->form_validation->set_rules($rules)->run();
 
            if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => validation_errors()]);
                die;
             }

            $user_id = $this->input->post('id-account');
            $username_target = $this->Account_model->get_account(['id' => $user_id])['username'];
            if( !$username_target){
                echo json_encode(['status' => 'false', 'message' => 'Akun tidak ditemukan atau sudah dihapus']);
                die;
            }
            $result = $this->Account_model->remove_account(['id' => $user_id]);
            
            if( !$result ){
                echo json_encode(['status' => 'false', 'message' => 'Terjadi kesalahan server saat menghapus akun']);
                die;
            }
            $this->write_log(time(), $this->session->userdata['user_data']['id'], 'Penghapusan Akun', 'Melakukan penghapusan akun terhadap akun ' . $username_target);
            echo json_encode(['status' => 'true', 'message' => 'Penghapusan akun berhasil dilakukan']);
            die;
            
        }

        
        public function do_add_account(){
            
            
            if( !$_POST ){
                echo json_encode(['status' => 'false', 'message' => 'Forbidden Access']);
                die;
            }

            $rules = [['field' => 'reg-username',
                       'label' => 'username',
                       'rules' => 'trim|required|min_length[6]|max_length[100]'],
                      ['field' => 'reg-password',
                       'label' => 'password',
                       'rules' => 'trim|required|min_length[6]|max_length[100]'],
                      ['field' => 'reg-ver-password',
                       'label' => 'confirmation password',
                       'rules' => 'trim|required|matches[reg-password]'],
                      ['field' => 'reg-fullname',
                       'label' => 'full name',
                       'rules' => 'trim|required|max_length[100]'],
                      ['field' => 'reg-email',
                       'label' => 'email',
                       'rules' => 'trim|required|valid_email'],
                      ['field' => 'reg-role',
                       'label' => 'role',
                       'rules' => 'trim|integer']
            ];

            $is_valid = $this->form_validation->set_rules($rules)->run();
            
            if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => validation_errors()]);
                die;
            }

            $username = $this->input->post('reg-username', true);
            $password = hash('sha256', $this->input->post('reg-password', true));
            $ver_password = $this->input->post('reg-ver-password', true);
            $full_name = $this->input->post('reg-fullname', true);
            $email = $this->input->post('reg-email', true);
            $role = $this->input->post('reg-role', true);
            
            $is_exist = $this->Account_model->is_exist_account(['username' => $username]);
            
            if( $is_exist ){
                echo json_encode(['status' => 'false', 'message' => 'Akun sudah pernah dibuat']);
                die;
            }
            
            $userdata = ['username' => $username,
                         'password' => $password,
                         'full_name' => $full_name,
                         'email' => $email,
                         'role' => $role,
                         'last_login' => 0,
                         'is_active' => 1,
                         'profile_images' => 'default'];
 
            $result = $this->Account_model->add_account($userdata);

            if( !$result ){
                echo json_encode(['status' => 'false', 'message' => 'Terjadi kesalahan server saat menambahkan user']);
                die;
            }

            $this->write_log(time(), $this->session->userdata('user_data')['id'], 'Penambahan User', 'menambahkan user baru dengan username ' . $userdata['username']);
            echo json_encode(['status' => 'true', 'message' => 'Berhasil menambahkan user baru']);
            

        }

        public function edit_account($user_id = false){
            if( !$user_id ){
                echo json_encode(['status' => 'false', 'message' => 'Forbidden Access']);
                die;
            }

            $userdata = $this->Account_model->get_account(['id' => $user_id]);
            $roles = $this->Account_model->get_all_roles();
            if( !$userdata ){
                echo json_encode(['status' => 'false', 'message' => 'Akun tidak ditemukan']);
                die;
            }
            $this->load->view('superadmin/edit_account', ['userdata' => $userdata, 'roles' => $roles]);
        }

        public function do_edit_account(){
            if( !$_POST ){
                echo json_encode(['status' => 'false', 'message' => 'Forbidden Access']);
                die;
            }

            if( !$this->input->post('user-id') ){
                echo json_encode(['status' => 'false', 'message' => 'Forbidden Access']);
                die;
            }

            $rules = [['field' => 'new-fullname',
                       'label' => 'full name',
                       'rules' => 'trim|required|max_length[100]'],
                      ['field' => 'new-email',
                       'label' => 'email',
                       'rules' => 'trim|required|valid_email'],
                      ['field' => 'new-role',
                       'label' => 'role',
                       'rules' => 'trim|integer'],
                      ['field' => 'is-active',
                       'label' => 'Aktivasi Akun',
                       'rules' => 'trim|integer|required'],
                    ];

            if( !empty( $this->input->post('new-password') ) || !empty( $this->input->post('new-ver-password') ) ){
                $new_rule = [['field' => 'new-password',
                              'label' => 'password',
                              'rules' => 'trim|required|min_length[6]|max_length[100]'],

                             ['field' => 'new-ver-password',
                              'label' => 'confirmation password',
                              'rules' => 'trim|required|matches[new-password]']];
                array_push($rules, $new_rule[0], $new_rule[1]);
            }

           $is_valid = $this->form_validation->set_rules($rules)->run();


           if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => validation_errors()]);
                die;
           }

           $userdata = ['full_name' => $this->input->post('new-fullname', true),
                        'email' => $this->input->post('new-email', true),
                        'role' => $this->input->post('new-role', true),
                        'is_active' => $this->input->post('is-active', true)
            ];

            if( !empty( $this->input->post('new-password') ) ){ 
                $userdata['password'] = hash("sha256", $this->input->post('new-password', true));
            }

            $user_id = $this->input->post('user-id', true);
            $datauser = $this->Account_model->get_account(['id' => $user_id]);

            $result = $this->Account_model->edit_account($user_id, $userdata);

            if( !$result ){
                echo json_encode(['status' => 'false', 'message' => 'Terjadi kesalahan server saat mengubah data']);
                die;
            }

            $this->write_log(time(), $this->session->userdata('user_data')['id'], 'Edit Informasi User', 'merubah informasi data akun dengan username ' . $datauser['username']);
            echo json_encode(['status' => 'true', 'message' => 'Data berhasil dirubah']);

        }

        // End Of Account Managemet


        // Log Management

        public function app_log(){
            $log_data = $this->Log_model->get_all_logs();
            $this->load->view('superadmin/view_log', ['logs' => $log_data]);
        }

        // End Of Log Management

    }
