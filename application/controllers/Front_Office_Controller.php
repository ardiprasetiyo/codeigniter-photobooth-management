<?php

    class Front_Office_Controller extends CI_Controller{

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
            date_default_timezone_set('Asia/Jakarta');
            // if( !$this->session->userdata('user_data') || $this->session->userdata('user_data')['role_id'] != 5 ){
            //     redirect('login');
            //     die;
            // }
        }

        private function write_log($date, $id_user, $activity, $description){

            $log_data = ['log_date' => $date, 
                         'log_user' => $id_user, 
                         'log_activity' => $activity,
                         'log_description' => $description];
            $this->Log_model->write_log($log_data);
        }

        public function home(){
            $this->load->view('frontoffice/template/header', ['account_name' => $this->session->userdata('user_data')['full_name']]);
            $this->load->view('frontoffice/find_order');
            $this->load->view('frontoffice/template/footer');
        }

        public function do_search_order(){
            $rules = [['field' => 'order-code',
                       'label' => 'kode order',
                       'rules' => 'trim|required|max_length[200]']];

            $is_valid = $this->form_validation->set_rules($rules)->run();
            if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => validation_errors()]);
                die;
            }
            
            $is_available = $this->Order_model->is_exist(['order_code' => $this->input->post('order-code', true)]);
            
            if( !$is_available ){
                echo json_encode(['status' => 'false', 'message' => 'Order tidak ditemukan']);
                die;
            }

            $this->session->set_userdata('order-session', $this->input->post('order-code'));
            echo json_encode(['status' => 'true', 'message' => 'Order berhasil ditemukan']);
        }

        public function confirm_order(){
            if( !$this->session->userdata('order-session') ){
                redirect('/frontoffice/home/');
            }

            $is_available = $this->Order_model->is_exist(['order_code' => $this->session->userdata('order-session')]);
            if( !$is_available ){
                redirect('/frontoffice/home/');
            }
            
            $order_detail = $this->Order_model->get_order(['order_code' => $this->session->userdata('order-session')])[0];
            if( $order_detail['order_date'] == 0 ){
                redirect('/frontoffice/home/');
                
            }
            $order_list = $this->Order_model->get_order_details(['order_code' => $this->session->userdata('order-session')]);
            $this->load->view('frontoffice/template/header', ['account_name' => $this->session->userdata('user_data')['full_name']]);
            $this->load->view('frontoffice/confirm_order', ['order_detail' => $order_detail, 'order_list' => $order_list]);
            $this->load->view('frontoffice/template/footer');
        }

        public function review_order(){
            if( !$this->session->userdata('order-session') ){
                redirect('/frontoffice/home/');
            }

            $is_available = $this->Order_model->is_exist(['order_code' => $this->session->userdata('order-session')]);
            if( !$is_available ){
                redirect('/frontoffice/home/');
            }

            $storage_base_location = $this->Config_model->get_config_value(['config_name' => 'storage_location'])[0]['config_value'];
            $storage_mapping_link = $this->Config_model->get_config_value(['config_name' => 'storage_mapping_link'])[0]['config_value'];

            $image_directories = glob($storage_base_location . $this->session->userdata('order-session') . '/' .'*');

            if( !$image_directories ){
                redirect('frontoffice/empty_image');
            }

            foreach( $image_directories as $image_directory ){
                $list_photo[] = base_url() . $storage_mapping_link . $this->session->userdata('order-session') . '/' . basename($image_directory);
            }

            $order_details = $this->Order_model->get_order_details(['order_code' => $this->session->userdata('order-session')]);
            
            $this->load->view('frontoffice/template/header', ['account_name' => $this->session->userdata('user_data')['full_name']]);
            $this->load->view('frontoffice/review_order', ['list_photo' => $list_photo, 'order_details' => $order_details]);
            $this->load->view('frontoffice/template/footer');
        }

        public function approve_order(){
            $rules = [['field' => 'order-description',
                        'label' => 'Deskripsi order',
                        'rules' => 'trim|required']];
            $is_valid = $this->form_validation->set_rules($rules)->run();
            if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => validation_errors()]);
                die;
            }

            $order_session = $this->session->userdata('order-session');
            $is_updated = $this->Order_model->update_order(['order_description' => $this->input->post('order-description', true),
                                                            'is_approved' => 1,
                                                            'order_status' => 1],
                                                            
                                                            ['order_code' => $order_session]);
            if( !$is_updated ){
                echo json_encode(['status' => 'false', 'message' => 'Terjadi kesalahan server order gagal diperbaharui']);
                die;
            }
            
            if( !$this->Tracking_model->is_exist_tracking(['order_code' => $this->session->userdata('order-session')]) ){
                $is_tracked = $this->Tracking_model->add_tracking(['order_code' => $this->session->userdata('order-session'),
                                                                   'tracking_date' => time(),
                                                                   'tracking_location' => 'Front Office - Review Order',
                                                                   'tracking_description' => 'Order sudah ditindak lanjut oleh Front Office']);
            }

            // $order_data = $this->Order_model->get_order(['order_code' => $this->session->userdata('order-session', true)])[0];
            // $result = $this->_SendEmail($order_data['customer_email'], $order_data['order_code']);
            
            echo json_encode(['status' => 'true', 'message' => 'Order berhasil diperbaharui']);
            die;
        }

        // private function _SendEmail($to, $order_code){
        //     $config = ['protocol' => 'smtp',
        //                'smtp_host' => 'ssl://smtp.googlemail.com',
        //                'smtp_user' => 'tefaordermanagement@gmail.com',
        //                'smtp_pass' => 'tefaorder320',
        //                'smtp_port' => 465,
        //                'mailtype' => 'html',
        //                'charset' => 'utf-8',
        //                'newline' => "\r\n"];

        //     $this->load->library('email', $config);
        //     $this->email->from('tefaordermanagement@gmail.com', 'TEFA Order Management');
        //     $this->email->to($to);
        //     $this->email->subject('Link Softfile Fotobooth');
        //     $this->email->message('<b>( ' . $order_code . ' )</b> <br> Masukan kode order tersebut kedalam situs <a href="' . site_url() . '/customer/">TEFA Orderku</a> untuk mengunduh softfile foto booth anda');
        //     $this->email->send();
        // }

        public function empty_image(){
            $this->load->view('frontoffice/template/header', ['account_name' => $this->session->userdata('user_data')['full_name']]);
            $this->load->view('frontoffice/empty_image');
            $this->load->view('frontoffice/template/footer');
        }
       
    }