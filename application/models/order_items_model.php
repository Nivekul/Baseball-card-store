<?php
class Order_items_model extends CI_Model {
	function insert($order_item) {
		return $this->db->insert('order_items', array(	'order_id'=>$order_item->order_id,
														'product_id'=>$order_item->product_id,
														'quantity'=>$order_item->quantity
														));
	}

	function getOrder($order_id) {
	    $query=$this->db->get_where('order_items', array('order_id'=>$order_id));
	    return $query->result("Order_item");
	}

	function deleteAll() {
		$this->db->empty_table('order_items');
	}
}
?>