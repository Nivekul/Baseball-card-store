<?php
	echo link_tag('css/template.css');
	$this->load->view('product/header.php');
	$this->load->view($main_content);
?>