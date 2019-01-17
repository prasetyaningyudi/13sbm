<?php

$roles = array(
			'' => array (
				'home' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete'),
			),
			'administrator' => array (
				'assignmenu' => array ('index', 'list', 'insert', 'update', 'delete'),
				'menu' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail', 'modal_form', 'modal_table', 'data_form'),
				'user' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail', 'm_form_user_info', 'insert_user_info', 'm_user_info'),
				'role' => array ('index', 'list', 'insert', 'update', 'update_status', 'detail'),
				'app_data' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail'),				
				'daftar_sbm' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail'),							
				'satuan' => array ('index', 'list', 'insert', 'update', 'delete', 'detail'),							
				'provinsi' => array ('index', 'list', 'insert', 'update', 'delete', 'detail'),							
				'kota' => array ('index', 'list', 'insert', 'update', 'delete', 'detail'),							
				'sbuhpddn' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail'),							
				'sbppddn' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail'),							
				'sbtpddn' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail'),							
				'sbtppddnpp' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail'),							
			),
			'supervisor' => array (
				'user' => array ('index', 'list', 'insert', 'update', 'update_status', 'delete', 'detail', 'm_form_user_info', 'insert_user_info', 'm_user_info'),		
			),		
		);


