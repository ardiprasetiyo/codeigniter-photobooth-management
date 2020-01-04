<?php

    class Cashier_Controller extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library(['form_validation', 'session']);
            $this->load->helper('url', 'cookie');
            $this->load->model('Account_model');
            $this->load->model('Log_model');
            $this->load->model('Product_model');
            $this->load->model('Order_model');
            $this->load->model('Config_model');
            date_default_timezone_set('Asia/Jakarta');
            // if( !$this->session->userdata('user_data') || $this->session->userdata('user_data')['role_id'] != 6 ){
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

        public function order_product(){
            if( !$this->input->post('id-product') ){
                return json_encode(['status' => 'false', 'message' => 'Tidak ada produk yang dipilih']);
                die;
            }

            $product_detail = $this->Product_model->get_product(['id_product' => $this->input->post('id-product', true)]);
            if( !$product_detail ){
                return json_encode(['status' => 'false', 'message' => 'Product tidak ditemukan']);
                die;
            }
            
            $this->load->view('cashier/order_product', ['product_detail' => $product_detail]);
        }

        public function do_order_product(){
            $rules = [['field' => 'order-cetak',
                       'label' => 'Jumlah cetak',
                       'rules' => 'trim|required|integer'],
                      ['field' => 'id-product',
                       'label' => 'Target produk',
                       'rules' => 'trim|required|integer']];
            
            $is_valid = $this->form_validation->set_rules($rules)->run();
            if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => validation_errors()]);
                die;
            }
            
            // Check is ordered?
            
            $is_ordered = $this->Order_model->get_order_details(['order_product' => $this->input->post('id-product'),
                                                                 'order_code' => $_COOKIE['order-session']]);

            if( $is_ordered ){

                // Just Update The Number Of Item

                $result = $this->Order_model->update_order_details(['order_cetak' => $is_ordered[0]['order_cetak'] + $this->input->post('order-cetak', true)], ['order_product' => $this->input->post('id-product'), 'order_code' => $_COOKIE['order-session']]);
                if( !$result ){
                    echo json_encode(['status' => 'false', 'message' => 'Terjadi kesalahan saat update data']);
                    die;
                }

                echo json_encode(['status' => 'true', 'message' => 'Produk berhasil di update']);
                die;
            }
            

            // Add To Order List
            $result = $this->Order_model->add_order_detail(['order_code' => $_COOKIE['order-session'],
                                                            'order_product' => $this->input->post('id-product', true),
                                                            'order_cetak' => $this->input->post('order-cetak', true)]);

            if( !$result ){
                echo json_encode(['status' => 'false', 'message' => 'terjadi kesalahan server saat menginput produk']);
                die;
            }

            echo json_encode(['status' => 'true', 'message' => 'Produk berhasil ditambahkan']);

        }

        public function remove_order_details(){
            $rules = [['field' => 'id-product',
                       'label' => 'ID Produk',
                       'rules' => 'trim|required|integer']];

            $is_valid = $this->form_validation->set_rules($rules)->run();
            if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => validation_errors()]);
                die;
            }

            // remove order details
            $result = $this->Order_model->remove_order_details(['order_product' => $this->input->post('id-product', true)]);
            if( !$result ){
                echo json_encode(['status' => 'false', 'message' => 'terjadi kesalahan saat menghapus list produk']);
                die;
            }

            echo json_encode(['status' => 'true', 'message' => 'produk berhasil dihapus']);
        }

        public function order_checkout(){
            $order_detail = $this->Order_model->get_order(['order_code' => $_COOKIE['order-session']]);
            $this->load->view('cashier/order_checkout', ['order_detail' => $order_detail[0]]);
        }
        

        public function do_order_checkout(){
           
            // Set Rules
            $rules = [['field' => 'customer-name',
                       'label' => 'Nama customer',
                       'rules' => 'trim|required|max_length[200]'],
                      ['field' => 'customer-phone',
                       'label' => 'Nomor telefon customer',
                       'rules' => 'trim|required|numeric'],
                      ['field' => 'customer-email',
                       'label' => 'Email customer',
                       'rules' => 'trim|required|valid_email'],
                      ['field' => 'order-code',
                       'label' => 'Kode Order',
                       'rules' => 'trim|required'],
                      ['field' => 'order-date',
                       'label' => 'Tanggal Order',
                       'rules' => 'trim|required|integer'],
                      ['field' => 'order-deadline',
                       'label' => 'Estimasi selesai',
                       'rules' => 'trim|required|integer']];

            $is_valid = $this->form_validation->set_rules($rules)->run();

            if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => validation_errors()]);
                die;
            }

            // Create Folder On Storage
            $get_storage = $this->Config_model->get_config_value(['config_name' => 'storage_location'])[0]['config_value'];
            $store_location = $get_storage . $_COOKIE['order-session'];
            $create_folder = mkdir($store_location, 0777);
            chmod($store_location, 0777);

            // Update Order Info
            $this->Order_model->update_order(['order_date' => $this->input->post('order-date', true),
                                              'order_deadline' => $this->input->post('order-deadline', true),
                                              'customer_name' => $this->input->post('customer-name', true),
                                              'customer_phone' => $this->input->post('customer-phone', true),
                                              'customer_email' => $this->input->post('customer-email', true)], 
                                             ['order_code' => $_COOKIE['order-session']]);

            setcookie('order-session', null, -1, '/');
            echo json_encode(['status' => 'true', 'message' => 'berhasil']);
            die;

            
        }

        public function home(){
            if( !isset($_COOKIE['order-session']) ){
                $generated_order_code = date('dmy-his') . ".T";
                setcookie('order-session', $generated_order_code, time() + 999999, '/');
                $this->Order_model->add_order(['order_code' => $generated_order_code,
                                               'order_date' => 0,
                                               'order_deadline' => 0,
                                               'order_description' => '',
                                               'order_status' => 0,
                                               'customer_name' => '',
                                               'customer_phone' => '',
                                               'customer_email' => '',
                                               'is_approved' => 0]);
                $order_code = $generated_order_code;
            } else {
                $order_code = $_COOKIE['order-session'];
            }

            // Checking Valid Order Code
            $is_valid = $this->Order_model->get_order(['order_code' => $order_code]);

            // If Not Valid Order Code
            if( !$is_valid ){ 
                setcookie('order-session', null, -1, '/');
                redirect('cashier');
            }

            $product_list = $this->Product_model->get_product();
            $this->load->view('cashier/template/header', ['account_name' => $this->session->userdata('user_data')['full_name']]);
            $this->load->view('cashier/order', ['product_list' => $product_list, 'order_code' => $order_code]);
            $this->load->view('cashier/template/footer');
        }


        public function show_cart(){
            
            if( !$_COOKIE['order-session'] ){
                echo json_encode(['status' => 'false', 'message' => 'Tidak ada sesi order']);
                die;
            }

            // Get Detail List
            $detail_list = $this->Order_model->get_order_details(['order_code' => $_COOKIE['order-session']]);

            if( !$detail_list ){
                echo json_encode(['status' => 'false', 'message' => 'Tidak ada order']);
                die;
            }

            echo json_encode(['status' => 'true', 'message' => 'Order ditemukan', 'data' => $detail_list]);
            die;

        }
        
       
    }