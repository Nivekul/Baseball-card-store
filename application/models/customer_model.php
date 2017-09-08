<?php
class customer_model extends CI_Model {

	function get($username, $password) {  
		$query = $this->db->get_where('customers', array('login'=>$username, 'password'=>$password));
		return $query->row(0, 'Customer');
	} 

	function getByID($id) {
		$query = $this->db->get_where('customers', array('id'=>$id));
		return $query->row(0, 'Customer');
	} 

	function insert($customer) {
		return $this->db->insert("customers", array('first' => $customer->first,
													'last' => $customer->last,
				                                	'login' => $customer->login,
											      	'password' => $customer->password,
												  	'email' => $customer->email));
	}

	function deleteAll() {
		$this->db->empty_table('customers');
	}
}
?>
