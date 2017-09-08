<?php
class Orders_model extends CI_Model {
	function getAll() {
		$query = $this->db->get('orders');
		return $query->result('Order');
	}


	function get($customer_id, $date, $time) {
		$query = $this->db->get_where('orders', array('customer_id'=>$customer_id,
														'order_date'=>$date,
														'order_time'=>$time));
		return $query->row(0,'Order');
	}
	function insert($order) {
		return $this->db->insert('orders', array('customer_id' => $order->customer_id,
												'total' => $order->total,
												'creditcard_number' => $order->creditcard_number,
												'creditcard_month' => $order->creditcard_month,
												'creditcard_year' => $order->creditcard_year,
												'order_date' => $order->order_date,
												'order_time' => $order->order_time
												));
	}

	function getOrderId($customer_id) {
	    $this->db->where('customer_id',$customer_id);
	    $this->db->order_by("id","desc");
	    $this->db->from('orders');
	    $query = $this->db->get();
	    return $query->row(0, 'Order');
	}

	function deleteAll() {
		$this->db->empty_table('orders');
	}
}
?>
