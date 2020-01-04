<?php


class Customer_Controller extends CI_Controller {

	 public function __construct(){
            parent::__construct();
            $this->load->library(['form_validation', 'session']);
            $this->load->helper(['url', 'download']);
            $this->load->model('Account_model');
            $this->load->model('Log_model');
            $this->load->model('Product_model');
            $this->load->model('Order_model');
            $this->load->model('Config_model');
            $this->load->model('Tracking_model');
            $this->load->model('Editing_model');
            date_default_timezone_set('Asia/Jakarta');
        }

	public function home()
	{
		if( $this->session->userdata('order_session') ){
			$this->session->unset_userdata('order_session');
		}

		if( $this->session->userdata('flash_data') ){
			$notif = $this->session->userdata('flash_data');
			$this->session->unset_userdata('flash_data');
		} else {
			$notif = false;
		}

		$this->load->view('customer/template/header');
		$this->load->view('customer/find_order', ['notif' => $notif]);
		$this->load->view('customer/template/footer');
	}

	public function find_order(){
		$rules = [['field' => 'order-code',
				   'label' => 'Kode Order',
				   'rules' => 'trim|required|max_length[200]']];

		$is_valid = $this->form_validation->set_rules($rules)->run();
		if( !$is_valid ){
			$this->session->set_userdata(['flash_data' => validation_errors()]);
			redirect('customer');
		}

		$order_data = $this->Order_model->get_order(['order_code' => $this->input->post('order-code', true)])[0];
		if( !$order_data ){
			$this->session->set_userdata(['flash_data' => "Maaf order tidak ditemukan"]);
			redirect('customer');
		}

		$this->session->set_userdata(['order_session' => $order_data['order_code']]);
		redirect('customer/order_lookup');
	}

	public function order_lookup(){
		if( !$this->session->userdata('order_session') ){
			$this->session->set_userdata(['flash_data' => "Mohon input kode order terlebih dahulu"]);
			redirect('customer');
		}

		$order_data = $this->Order_model->get_order(['order_code' => $this->session->userdata('order_session')]);

		if( !$order_data ){
			$this->session->set_userdata(['flash_data' => "Kode order yang anda input tidak valid"]);
			redirect('customer');
		}

		$this->load->view('customer/template/header');
		$this->load->view('customer/order_lookup', ['order_data' => $order_data[0]]);
		$this->load->view('customer/template/footer');
	}

	public function get_photo(){
		if( !$this->session->userdata('order_session') ){
			$this->session->set_userdata(['flash_data' => "Mohon input kode order terlebih dahulu"]);
			redirect('customer');
		}

		$storage = $this->Config_model->get_config_value(['config_name' => 'storage_location'])[0];
		$mapped_storage = $this->Config_model->get_config_value(['config_name' => 'storage_mapping_link'])[0];
		foreach( glob($storage['config_value'] . $this->session->userdata('order_session') . "/" . "*") as $file ){
			if( is_dir($file) ){
				continue;
			}

			$file_name[] = basename($file);

		}

		$this->load->view('customer/template/header');
		$this->load->view('customer/photo_download', ['file_name' => $file_name]);
		$this->load->view('customer/template/footer');
	}

	public function download_photo($photo_id){
		if( !$photo_id ){
			echo "Terjadi Kesalahan.";
			die;
		}

		if( !$this->session->userdata('order_session') ){
			$this->session->set_userdata(['flash_data' => "Mohon input kode order terlebih dahulu"]);
			redirect('customer');
		}

		$filename = $photo_id;
		$storage = $this->Config_model->get_config_value(['config_name' => 'storage_location'])[0]['config_value'];

		$is_ok = force_download($filename, file_get_contents($storage . $this->session->userdata('order_session') . "/" . $filename));

		if( !$is_ok ){
			echo "Terjadi Kesalahan Saat Pengunduhan.";
			die;
		}

	}
}
