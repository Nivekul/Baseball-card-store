<?php
class Admin extends CI_Controller {

	function __construct() {
    		// Call the Controller constructor
	    	parent::__construct();
	    	
	    	
	    	$config['upload_path'] = './images/product/';
	    	$config['allowed_types'] = 'gif|jpg|png';
/*	    	$config['max_size'] = '100';
	    	$config['max_width'] = '1024';
	    	$config['max_height'] = '768';
*/
	    		    	
	    	$this->load->library('upload', $config);	    	
    }

	function index() {
		$this->load->model('product_model');
		$products = $this->product_model->getAll();
		$data['products']=$products;

		$data['main_content'] = 'admin/list.php';
		$this->load->view('admin/main.php',$data);
    }

    function allOrders() {
    	$this->load->model('product_model');
    	$this->load->model('customer_model');
		$this->load->model('order_items_model');
		$this->load->model('orders_model');
    	$data['main_content']= 'admin/allOrders.php';
    	$this->load->view('admin/main.php',$data);
    }

    function deleteAll() {
    	$this->load->model('product_model');
    	$this->load->model('customer_model');
		$this->load->model('order_items_model');
		$this->load->model('orders_model');

		//$this->product_model->deleteAll();
		$this->customer_model->deleteAll();
		$this->order_items_model->deleteAll();
		$this->orders_model->deleteAll();
		redirect('admin/index', 'refresh');
    }

}


?>