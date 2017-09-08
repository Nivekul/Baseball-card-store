<?php
class Login extends CI_Controller {

    function index() {
		$data['login'] = FALSE;
    	$data['signup'] = FALSE;

    	if ($this->session->userdata('logged_in')) {
    		$data['main_content'] = 'product/logout.php';
    	} else {
			$data['main_content'] = 'product/login_form.php';
		}
		$this->load->view('product/main.php', $data);
    }

    function signin() {
    	$this->load->model('customer_model');
		$this->load->library('form_validation');

    	$data['main_content'] = 'product/login_form.php';
    	$data['login'] = TRUE;
    	$data['signup'] = FALSE;
    	$data['login_fail'] = FALSE;

		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

		if (!$this->form_validation->run()) {
			$this->load->view('product/main.php',$data);
		} else {
			// Logging in
			$data['username'] = $this->input->post('username');
			$data['password'] = $this->input->post('password');

			if (strcmp($data['username'], 'admin') == 0 && strcmp($data['password'], 'admin123') == 0 ) {
				redirect('admin/index','location');
			} else {
				$customer = $this->customer_model->get($data['username'],$data['password']);
				if ($customer) { //Success
					$this->set_user($customer);

					$data['message'] = 'LOGIN SUCCESSFUL';
					$data['main_content'] = 'product/login_success.php';

				} else { // Fail
					$data['login_fail'] = TRUE;
					$data['message'] = '';
					$data['main_content'] = 'product/login_form.php';
				}

				$this->load->view('product/main.php',$data);
			}
		}
    }

    function signup() {
		$this->load->library('form_validation');

       	$data['main_content'] = 'product/login_form.php';
    	$data['login'] = FALSE;
    	$data['signup'] = TRUE;

    	$this->form_validation->set_rules('first', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('signup_username', 'Username', 'trim|required');
		$this->form_validation->set_rules('signup_password', 'Password', 'trim|required|min_length[6]|matches[confPassword]');
		$this->form_validation->set_rules('confPassword', 'Password Confirmation', 'trim|required');
		$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');

		if (!$this->form_validation->run()) {
			$this->load->view('product/main.php',$data);
		} else {
			$this->load->model('customer_model');
			// Create new customer
			$customer = new customer;

			$customer->first = $this->input->post('first');
			$customer->last = $this->input->post('last');
			$customer->login = $this->input->post('signup_username');
			$customer->password = $this->input->post('signup_password');
			$customer->email = $this->input->post('email');

			$this->customer_model->insert($customer);
			$customer = $this->customer_model->get($customer->login, $customer->password);
			
			$this->set_user($customer);

			$data['message'] = 'ACCOUNT CREATED.';
			// Go to login success view
			$data['main_content'] = 'product/login_success.php';
			$this->load->view('product/main.php',$data);
		}
    }

    function logout() {
    	$this->session->set_userdata('logged_in', FALSE);
    	redirect('store/index', 'refresh');
    }

    function set_user($customer) {
    	$user_data = array(
    				'id' => intval($customer->id),
					'first' => $customer->first,
					'last' => $customer->last,
					'username' => $customer->login,
					'email' => $customer->email,
					'logged_in' => TRUE
			);

		$this->session->set_userdata($user_data);
    }
}

?>