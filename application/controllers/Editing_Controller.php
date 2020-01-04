<?php

    class Editing_Controller extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library(['form_validation', 'session']);
            $this->load->helper('url');
            $this->load->model('Account_model');
            $this->load->model('Log_model');
            $this->load->model('Product_model');
            $this->load->model('Order_model');
            $this->load->model('Config_model');
            $this->load->model('Tracking_model');
            $this->load->model('Editing_model');
            date_default_timezone_set('Asia/Jakarta');
            if( !$this->session->userdata('user_data') || $this->session->userdata('user_data')['role_id'] != 3 ){
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
            $this->load->view('editing/template/header', ['account_name' => $this->session->userdata('user_data')['full_name']]);
            $this->load->view('editing/home');
            $this->load->view('editing/template/footer');
        }

        public function add_editing_list(){
            $rules = [['field' => 'order-code',
                       'label' => 'Kode Order',
                       'rules' => 'trim|required|max_length[200]']];
            $is_valid = $this->form_validation->set_rules($rules)->run();
            if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => validation_errors()]);
                die;
            }

            $order_data = $this->Order_model->get_order(['order_code' => $this->input->post('order-code', true)]);

            if( !$order_data ){
                echo json_encode(['status' => 'false', 'message' => 'Order tidak ditemukan']);
                die;
            }

            if( $order_data[0]['is_approved'] < 1 ){
                echo json_encode(['status' => 'false', 'message' => 'Order belum di Approve']);
                die;
            }
            
            $is_exist_on_list = $this->Editing_model->is_exist_list(['order_code' => $this->input->post('order-code', true)]);
            if( $is_exist_on_list ){
                $list_info = $this->Editing_model->get_editing_list(['order_code' => $this->input->post('order-code', true)]);
                echo json_encode(['status' => 'false', 
                                  'message' => 'Order sudah dikerjakan oleh ' . $this->Account_model->get_account(['id' => $list_info[0]['editor']])['full_name'] ]);
                die;
            }

            $is_submited = $this->Editing_model->add_editing_list(['order_code' => $this->input->post('order-code', true),
                                                                   'editor' => $this->session->userdata('user_data')['id'],
                                                                   'editing_date_start' => time(),
                                                                   'editing_date_finish' => 0,
                                                                   'editing_status' => 0]);
            if( !$is_submited ){
                echo json_encode(['status' => 'false', 'message' => 'Terjadi kesalahan server, gagal menambah order']);
                die;
            }

            if( !$this->Tracking_model->is_exist_tracking(['order_code' => $this->input->post('order-code', true),
                                                           'tracking_location' => 'Editing - Editing Session']) ){
                 $this->Tracking_model->add_tracking(['order_code' => $this->input->post('order-code', true),
                                                      'tracking_date' => time(),
                                                      'tracking_location' => 'Editing - Editing Session',
                                                      'tracking_description' => 'Order sedang dalam proses editing']);
            }

            $update_product = $this->Order_model->update_order(['order_status' => 2], ['order_code' => $this->input->post('order-code', true)]);
            echo json_encode(['status' => 'true', 'message' => 'Order berhasil ditambahkan']);
            die;
        }

        public function get_editing_list($args = false){
            $id_editor = $this->session->userdata('user_data')['id'];
            $result = [];

            // Hitung Batas Minimal Waktu
            $date =  date('H', time());
            $limit_date = time() - ( 24 - (24 - $date) ) * 60 * 60 ;
            
            // Get Editing List
            $editing_list = $this->Editing_model->get_editing_list(['editor' => $id_editor, 'editing_date_start >= ' => $limit_date]);
            if( !$editing_list ){
                if( $args == 'editing_point' ){
                    return false;
                    die;
                }
                echo json_encode(['status' => 'false', 'message' => 'Belum ada order masuk']);
                die;
            }

            foreach( $editing_list as $list ){
            // Get Order Detail
            $order_details = $this->Order_model->get_order_details(['order_code' => $list['order_code']]);

                
                // Poin Set To 0
                $poin = 0;

                // Get Poin 
                foreach( $order_details as $order ){
                    $poin += $order['product_basepoint'] * $order['order_cetak'];
                }

                $order_arr = [['order_code' => $order['order_code'],
                               'order_point' => $poin,
                               'order_status' => $list['editing_status']]];
            
                array_push($result, $order_arr[0]);

            }

            if( $args == 'editing_point' ){
                return $result;
                die;
            }
            
            echo json_encode(['status' => 'true', 'message' => 'List berhasil didapatkan', 'data' => $result]);
        }


        public function get_editing_point(){
            $total_point = 0;
            $suspended_point = 0;
            $collected_point = 0;

            $editing_list = $this->get_editing_list('editing_point');
            if( !$editing_list ){
                $result = ['total_point' => $total_point, 
                           'suspended_point' => $suspended_point, 
                           'collected_point' => $collected_point];
                echo json_encode(['status' => 'true', 'message' => 'List Berhasil Didapatkan', 'data' => $result]);
                die;
            }

            foreach( $editing_list as $list ){
                if( $list['order_status'] > 0 ){
                    $collected_point += $list['order_point'];
                } else {
                    $suspended_point += $list['order_point'];
                }
                $total_point += $list['order_point'];
            }

            $result = ['total_point' => $total_point, 
                       'suspended_point' => $suspended_point, 
                       'collected_point' => $collected_point];

            echo json_encode(['status' => 'true', 'message' => 'List berhasil didapatkan', 'data' => $result]);
        }


        public function do_cancel_editing(){
            $rules = [['field' => 'order-code',
                       'label' => 'Kode Order',
                       'rules' => 'trim|required|max_length[200]']];
            
            $is_valid = $this->form_validation->set_rules($rules)->run();
            if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => validation_errors()]);
                die;
            }

            $is_exist_on_list = $this->Editing_model->is_exist_list(['order_code' => $this->input->post('order-code', true),
                                                                     'editor' => $this->session->userdata('user_data')['id']]);
            
            if( !$is_exist_on_list ){
                echo json_encode(['status' => 'false', 'message' => 'Gagal membatalkan order, silahkan coba beberapa saat lagi']);
                die;
            }

            $result = $this->Editing_model->remove_editing_list(['order_code' => $this->input->post('order-code', true),
                                                                      'editor' => $this->session->userdata('user_data')['id']]);

            if( !$result ){
                echo json_encode(['status' => 'false', 'message' => 'Terjadi kesalahan server saat membatalkan order, silahkan coba beberapa saat lagi']);
                die;
            }

            echo json_encode(['status' => 'true', 'message' => 'Berhasil membatalkan order']);
        }

        

        public function do_finish_editing(){
             $rules = [['field' => 'order-code',
                       'label' => 'Kode Order',
                       'rules' => 'trim|required|max_length[200]']];
            
            $is_valid = $this->form_validation->set_rules($rules)->run();
            if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => validation_errors()]);
                die;
            }

            $is_exist_on_list = $this->Editing_model->is_exist_list(['order_code' => $this->input->post('order-code', true),
                                                                     'editor' => $this->session->userdata('user_data')['id']]);
            if( !$is_exist_on_list ){
                echo json_encode(['status' => 'false', 'message' => 'Gagal membatalkan order, silahkan coba beberapa saat lagi']);
                die;
            }

            $result = $this->Editing_model->update_editing_list(['order_code' => $this->input->post('order-code', true),
                                                                 'editor' => $this->session->userdata('user_data')['id']], 
                                                                ['editing_status' => 1,
                                                                 'editing_date_finish' => time()]);
            if( !$result ){
                echo json_encode(['status' => 'false', 'message' => 'Terjadi kesalahan server saat membatalkan order, silahkan coba beberapa saat lagi']);
                die;
            }

            echo json_encode(['status' => 'true', 'message' => 'Berhasil membatalkan order']);
        }


        public function do_cancel_finish_editing(){
            $rules = [['field' => 'order-code',
                      'label' => 'Kode Order',
                      'rules' => 'trim|required|max_length[200]']];
           
           $is_valid = $this->form_validation->set_rules($rules)->run();
           if( !$is_valid ){
               echo json_encode(['status' => 'false', 'message' => validation_errors()]);
               die;
           }

           $is_exist_on_list = $this->Editing_model->is_exist_list(['order_code' => $this->input->post('order-code', true),
                                                                    'editor' => $this->session->userdata('user_data')['id']]);
           if( !$is_exist_on_list ){
               echo json_encode(['status' => 'false', 'message' => 'Gagal membatalkan order, silahkan coba beberapa saat lagi']);
               die;
           }

           $result = $this->Editing_model->update_editing_list(['order_code' => $this->input->post('order-code', true),
                                                                'editor' => $this->session->userdata('user_data')['id']], 
                                                               ['editing_status' => 0,
                                                                'editing_date_finish' => 0]);
           if( !$result ){
               echo json_encode(['status' => 'false', 'message' => 'Terjadi kesalahan server saat membatalkan order, silahkan coba beberapa saat lagi']);
               die;
           }

           echo json_encode(['status' => 'true', 'message' => 'Berhasil membatalkan order']);
       }

       public function get_order_detail(){
           $rules = [['field' => 'order-code',
                      'label' => 'Kode Order',
                      'rules' => 'trim|required|max_length[200]']];
            $is_valid = $this->form_validation->set_rules($rules)->run();
            if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => validation_errors()]);
                die;
            }

            $order_data = $this->Order_model->get_order(['order_code' => $this->input->post('order-code', true)]);
            if( !$order_data ){
                echo json_encode(['status' => 'false', 'message' => 'Order tidak ditemukan']);
                die;
            }
            
            echo json_encode(['status' => 'true', 'message' => 'Order berhasil ditemukan', 'data' => $order_data]);

       }
       
    }