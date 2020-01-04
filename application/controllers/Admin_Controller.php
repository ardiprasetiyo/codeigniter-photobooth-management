<?php

    class Admin_Controller extends CI_Controller{

        public function __construct(){
            parent::__construct();
            $this->load->library(['form_validation', 'session']);
            $this->load->helper('url');
            $this->load->model('Account_model');
            $this->load->model('Log_model');
            $this->load->model('Product_model');
            date_default_timezone_set('Asia/Jakarta');
            if( !$this->session->userdata('user_data') || $this->session->userdata('user_data')['role_id'] != 2 ){
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
            $this->load->view('admin/home');
        }

        // Product Management

        public function add_product(){
            $this->load->view('admin/add_product');   
        }

        public function do_add_product(){
            if( !$_POST ){
                echo json_encode(['status' => 'false', 'message' => 'Forbidden Access']);
                die;
            }

            $rules = [['field' => 'add-product-name',
                       'label' => 'Nama Produk',
                       'rules' => 'trim|required|max_length[100]'],
                      ['field' => 'add-product-description',
                       'label' => 'Deskripsi Produk',
                       'rules' => 'trim|required|max_length[100]'],
                      ['field' => 'add-product-cost',
                       'label' => 'Harga Produk',
                       'rules' => 'trim|required|integer'],
                      ['field' => 'add-product-basepoint',
                       'label' => 'Poin Utama',
                       'rules' => 'trim|required|integer'],
                      ['field' => 'add-product-duration',
                       'label' => 'Lama pengerjaan',
                       'rules' => 'trim|required|integer']];
            
            $is_valid = $this->form_validation->set_rules($rules)->run();

            if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => validation_errors()]);
                die;
            }

            $is_exist_product = $this->Product_model->is_exist(['product_name' => $this->input->post('add-product-name', true)]);

            if( $is_exist_product ){
                echo json_encode(['status' => 'false', 'message' => 'Produk sudah ada']);
                die;
            }

            $product_data = ['product_name' => $this->input->post('add-product-name', true),
                             'product_description' => $this->input->post('add-product-description', true),
                             'product_cost' => $this->input->post('add-product-cost', true),
                             'product_basepoint' => $this->input->post('add-product-basepoint', true),
                             'product_deadline' => $this->input->post('add-product-duration', true)];
            
            $result = $this->Product_model->add_product($product_data);

            if( !$result ){
                echo json_encode(['status' => 'false', 'message' => 'Terjadi kesalahan server saat menginput produk']);
                die;
            }

            echo json_encode(['status' => 'true', 'message' => 'Produk berhasil ditambahkan']);
            die;

        }

        public function remove_product($id_product = false){
            if( !$id_product ) {
                echo json_encode(['status' => 'false', 'message' => 'Produk Tidak Ditemukan']);
                die;
            }

            $product_data = $this->Product_model->get_product(['id_product' => $id_product]);
            if( !$product_data ){
                echo json_encode(['status' => 'false', 'message' => 'Produk Tidak Ditemukan']);
                die;
            }

            $this->load->view('admin/remove_product', ['product_data' => $product_data[0]]);
        }

        public function do_remove_product(){
            if( !$_POST ){
                echo json_encode(['status' => 'false', 'message' => 'Produk Tidak Ditemukan']);
                die;
            }

            $rules = [['field' => 'id-product',
                      'label' => 'Target produk',
                      'rules' => 'trim|required|integer']];

            $is_valid = $this->form_validation->set_rules($rules)->run();

            if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => 'Forbidden Access']);
                die;
            }
            $id_product = $this->input->post('id-product', true);
            $product_info = $this->Product_model->get_product(['id_product' => $id_product]);
            if( !$product_info ){
                echo json_encode(['status' => 'false', 'message' => 'Produk Tidak Tersedia']);
                die;
            }

            $result = $this->Product_model->remove_product(['id_product' => $id_product]);

            if(!$result){
                echo json_encode(['status' => 'false', 'message' => 'Terjadi Kesalahan Server Saat Menghapus Produk']);
                die;
            }
            $this->write_log(time(), $this->session->userdata['user_data']['id'], 'Hapus Produk', 'Menghapus Produk Dengan Nama ' . $product_info[0]['product_name']);
            echo json_encode(['status' => 'true', 'message' => 'Produk Berhasil Dihapus']);
        }


        public function edit_product($product_id = false){
            if( !$product_id ){
                echo json_encode(['status' => 'false', 'message' => 'Forbidden Access']);
                die;
            }
            
            $product_info = $this->Product_model->get_product(['id_product' => $product_id]);
            if( !$product_info ){
                echo json_encode(['status' => 'false', 'message' => 'Produk tidak tersedia']);
                die;
            }

            $this->load->view('admin/edit_product', ['product_data' => $product_info[0]]);
        }

        public function do_edit_product(){
            if( !$_POST ){
                echo json_encode(['status' => 'false', 'message' => 'Forbidden Access']);
                die;
            }

            $rules = [['field' => 'edit-product-name',
                       'label' => 'Nama Produk',
                       'rules' => 'trim|required|max_length[100]'],
                      ['field' => 'edit-product-description',
                       'label' => 'Deskripsi Produk',
                       'rules' => 'trim|required|max_length[100]'],
                      ['field' => 'edit-product-cost',
                       'label' => 'Harga Produk',
                       'rules' => 'trim|required|integer'],
                      ['field' => 'edit-product-basepoint',
                       'label' => 'Poin Utama',
                       'rules' => 'trim|required|integer'],
                      ['field' => 'edit-product-duration',
                       'label' => 'Lama pengerjaan',
                       'rules' => 'trim|required|integer'],
                      ['field' => 'product-target',
                       'label' => 'Target produk',
                       'rules' => 'trim|required|integer']];
            
            $is_valid = $this->form_validation->set_rules($rules)->run();

            if( !$is_valid ){
                echo json_encode(['status' => 'false', 'message' => validation_errors()]);
                die;
            }
            $id_product = $this->input->post('product-target', true);

            $product_new_data = ['product_name' => $this->input->post('edit-product-name', true),
                                 'product_description' => $this->input->post('edit-product-description', true),
                                 'product_cost' => $this->input->post('edit-product-cost', true),
                                 'product_basepoint' => $this->input->post('edit-product-basepoint', true),
                                 'product_deadline' => $this->input->post('edit-product-duration', true)];
            
            $result = $this->Product_model->edit_product($product_new_data, ['id_product' => $id_product]);

            if( !$result ){
                echo json_encode(['status' => 'false', 'message' => 'Terjadi kesalahan server saat mengubah produk']);
                die;
            }
            $this->write_log(time(), $this->session->userdata('user_data')['id'], 'Edit Informasi Produk', ' Mengubah Informasi Produk Dengan ID Produk ' . $id_product);
            echo json_encode(['status' => 'true', 'message' => 'Produk berhasil diubah']);
            die;

        }

        // End Of Product Management

       
    }