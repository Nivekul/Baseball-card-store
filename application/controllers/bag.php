<?php
class Bag extends CI_Controller {

	function index() {
		$this->load->model('product_model');
		$data['main_content'] = 'product/orders.php';
		$this->load->view('product/main.php', $data);
	}

	function add($id) {
		$this->load->model('product_model');
		$product = new Product();
		$product = $this->product_model->get($id);
		if (is_array($this->session->userdata('orders'))) {
			$orders = $this->session->userdata('orders');
			if (array_key_exists($product->id, $orders)) {
				$orders[$product->id] += 1;
			} else {
				$orders[$product->id] = 1;
			}
			$this->session->set_userdata('orders', $orders);
		} else {
			$orders = array($product->id => 1);
			$this->session->set_userdata('orders', $orders);
		}
		redirect(site_url(), 'refresh');
	}

	function update() {
		$orders = $this->session->userdata('orders');
		foreach ($orders as $id => $quantity) {
			$newQuantity = intval($this->input->post($id));
			if (is_int($newQuantity)) {
				if ($newQuantity > 0) {
					$orders[$id] = $newQuantity;
				} else {
					unset($orders[$id]);
				}
			}
		}
		$this->session->set_userdata('orders', $orders);
		redirect(site_url('bag/index'), 'refresh');
	}

	function remove($id) {
		$orders = $this->session->userdata('orders');
		unset($orders[$id]);
		$this->session->set_userdata('orders', $orders);
		redirect(site_url('bag/index'), 'refresh');
	}

	function checkout() {		
		$this->load->model('product_model');

		date_default_timezone_set('UTC');
		$this->load->model('product_model');
		$this->load->model('order_items_model');
		$this->load->model('orders_model');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('card_number', 'Card Number', 'trim|required|exact_length[16]');
		$this->form_validation->set_rules('expire_date', 'Expiration Date', 'trim|required|callback_valid_expire_date');

		if (!$this->form_validation->run()) {
			$data['main_content'] = 'product/checkout.php';
			$this->load->view('product/main.php', $data);
		} else if (!$this->session->userdata('orders')) {
			redirect('store/index', 'refresh');
		} else {
			$order = new Order();
			$order->customer_id = $this->session->userdata('id');
			$order->creditcard_number = $this->input->post('card_number');
			$order->creditcard_month = substr($this->input->post('expire_date'), 0, 2);
			$order->creditcard_year = substr($this->input->post('expire_date'), 3, 2);
			$order->total = $this->calculate_total();
			$order->order_date = date('Y-m-d');
			$order->order_time = date('G:i:s');

			$this->orders_model->insert($order);
			$order = $this->orders_model->get($order->customer_id, $order->order_date, $order->order_time);

			$bag = $this->session->userdata('orders');
			$order_item = new Order_item();
			foreach ($bag as $id => $quantity) {
				$order_item->order_id = intval($order->id);
				$order_item->product_id = $id;
				$order_item->quantity = $quantity;

				$this->order_items_model->insert($order_item);
			}
			$this->session->unset_userdata('orders');
			$data['main_content'] = 'product/order_complete.php';
			$this->load->view('product/main.php', $data);
		}
	}

	function valid_expire_date($date) {
		date_default_timezone_set('UTC');
		$month = date('n');
		$year = date('y');
		if (strlen($date) == 5 && 1<=$month && $month<=12) {
			if (intval(substr($date, 3, 2)) >= $year) {
				return TRUE;
			} else if (intval(substr($date, 0, 2)) >= $month){
				return TRUE;
			} else {
				$this->form_validation->set_message('valid_expire_date', 'This card has expired.');
				return FALSE;
			}
		} else {
			$this->form_validation->set_message('valid_expire_date', 'Invalid expiration date.');
			return FALSE;
		}
	}

	function calculate_total() {
		$orders = $this->session->userdata('orders');
		$total = 0;
		foreach ($orders as $id => $quantity) {
			$product = new product();
			$product = $this->product_model->get($id);
			$subtotal = $product->price*$quantity;
			$total += $subtotal;
		}
		return $total;
	}



	function print_receipt() {
		$this->load->model('product_model');
		$this->load->model('order_items_model');
		$this->load->model('orders_model');
		$data['attributes'] = 'onload="print_receipt()" style="border:none;"}';
		$data['main_content'] = 'product/receipt.php';
		$this->load->view('product/print_main.php', $data);
	}

	function email_receipt() {

		$this->load->model('product_model');
		$this->load->model('order_items_model');
		$this->load->model('orders_model');

	    $data['attributes'] = 'style="border:none;"}';
	    $data['main_content'] = 'product/receipt.php';

		date_default_timezone_set('UTC');
	    $this->load->library('email');

        $config['protocol']    = 'smtp';

        $config['smtp_host']    = 'ssl://smtp.gmail.com';

        $config['smtp_port']    = '465';

        $config['smtp_timeout'] = '7';

        $config['smtp_user']    = 'luckylujiatian@gmail.com';

        $config['smtp_pass']    = 'Lk426429';

        $config['charset']    = 'utf-8';

        $config['newline']    = "\r\n";

        $config['mailtype'] = 'html'; // or html

        $config['validation'] = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);


        $this->email->from('luckylujiatian@gmail.com', 'Kevin');
        $this->email->to($this->session->userdata('email')); 


        $this->email->subject('Email Test');

        $this->email->message($this->load->view('product/print_main.php', $data, TRUE));  

        $this->email->send();

        $data['main_content'] = 'product/email_success.php';
        $this->load->view('product/main.php',$data);

	    
	}








}
?>