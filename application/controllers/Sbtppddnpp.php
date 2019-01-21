<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sbtppddnpp extends CI_Controller {
	private $data;
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('auth');				
		$this->load->helper('url');			
		$this->load->database();
		$this->load->model('sbtppddnpp_model');
		$this->load->model('kota_model');
		$this->load->model('role_model');
		$this->load->model('menu_model');
		if(isset($this->session->userdata['is_logged_in'])){
			$this->data['menu'] = $this->menu_model->get_menu($this->session->userdata('ROLE_ID'));
			$this->data['sub_menu'] = $this->menu_model->get_sub_menu($this->session->userdata('ROLE_ID'));
		}else{
			$this->data['menu'] = $this->menu_model->get_menu($this->menu_model->get_guest_id('guest'));
			$this->data['sub_menu'] = $this->menu_model->get_sub_menu($this->menu_model->get_guest_id('guest'));			
		}
		$this->load->model('app_data_model');		
		$this->data['app_data'] = $this->app_data_model->get();		
		$this->data['error'] = array();
		$this->data['title'] = 'Satuan Biaya Tiket Pesawat Perjalanan Dinas Dalam Negeri Pergi Pulang (PP)';
	}

	public function index(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		$this->data['subtitle'] = 'List';
		$this->data['class'] = __CLASS__;
		$this->load->view('section_header', $this->data);
		$this->load->view('section_sidebar');
		$this->load->view('section_nav');
		$this->load->view('main_index');	
		$this->load->view('section_footer');			
	}
	
	public function list(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}			
		$filters = array();
		$limit = array('20', '0');
		$r_kota_asal = '';
		$r_kota_tujuan = '';

		if(isset($_POST['submit'])){
			if (isset($_POST['kota_asal'])) {
				if ($_POST['kota_asal'] != '' or $_POST['kota_asal'] != null) {
					$filters[] = "A.KOTA_ASAL_ID = '" . $_POST['kota_asal'] . "'";
					$r_kota_asal = $_POST['kota_asal'];
				}
			}
			if (isset($_POST['kota_tujuan'])) {
				if ($_POST['kota_tujuan'] != '' or $_POST['kota_tujuan'] != null) {
					$filters[] = "A.KOTA_TUJUAN_ID = '" . $_POST['kota_tujuan'] . "'";
					$r_kota_tujuan = $_POST['kota_tujuan'];
				}
			}			
			if (isset($_POST['offset'])) {
				if ($_POST['offset'] != '' or $_POST['offset'] != null) {
					$limit[1] = $_POST['offset'];
				}
			}			
		}
		
		$data = $this->sbtppddnpp_model->get($filters, $limit);
		$total_data = count($this->sbtppddnpp_model->get($filters));
		$limit[] = $total_data;
		
		//var_dump($data);

		$no_body = 0;
		$body= array();
		if(isset($data)){
            if (empty($data)) {
                $body[$no_body] = array(
                    (object) array ('colspan' => 100, 'classes' => ' empty bold align-center', 'value' => 'No Data')
                );
			} else {
				foreach ($data as $value) {
					$body[$no_body] = array(
						(object) array( 'classes' => ' hidden ', 'value' => $value->ID ),
						(object) array( 'classes' => ' bold align-left ', 'value' => $no_body+1 ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->KOTA_ASAL ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->KOTA_TUJUAN ),					
						(object) array( 'classes' => ' align-right ', 'value' => number_format($value->BISNIS, 0, ',', '.') ),
						(object) array( 'classes' => ' align-right ', 'value' => number_format($value->EKONOMI, 0, ',', '.') ),
					);
					$no_body++;
				}
			}
        } else {
            $body[$no_body] = array(
                (object) array ('colspan' => 100, 'classes' => ' empty bold align-center', 'value' => '')
            );
        }
		
		$header = array(
			array (
				(object) array ('rowspan' => 2, 'classes' => 'bold align-center capitalize', 'value' => 'No'),
				(object) array ('colspan' => 2, 'classes' => 'bold align-center capitalize', 'value' => 'kota'),					
				(object) array ('colspan' => 2, 'classes' => 'bold align-center capitalize', 'value' => 'satuan biaya tiket'),				
			),
			array (
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'Asal'),					
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'Tujuan'),			
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'Bisnis'),			
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'Ekonomi'),				
			)		
		);
		
		$kota_asal = array();
		$kota_tujuan = array();
		$data = $this->kota_model->get();
		if (empty($data)) {
			
		} else {
			foreach ($data as $value) {
				$kota_asal[] = (object) array('label'=>$value->NAMA, 'value'=>$value->ID);
				$kota_tujuan[] = (object) array('label'=>$value->NAMA, 'value'=>$value->ID);
			}
		}		
			
		$fields = array();
		$fields[] = (object) array(
			'type' 			=> 'select',
			'label' 		=> 'Kota Asal',
			'name' 			=> 'kota_asal',
			'placeholder'	=> '--Select Kota Asal--',
			'value' 		=> $r_kota_asal,
			'options'		=> $kota_asal,
			'classes' 		=> 'full-width
			',
		);		
		$fields[] = (object) array(
			'type' 			=> 'select',
			'label' 		=> 'Kota Tujuan',
			'name' 			=> 'kota_tujuan',
			'placeholder'	=> '--Select Kota Tujuan--',
			'value' 		=> $r_kota_tujuan,
			'options'		=> $kota_tujuan,
			'classes' 		=> 'full-width
			',
		);				
	

		if($this->session->userdata('ROLE_NAME') == 'administrator'){
			$this->data['list'] = (object) array (
				'type'  	=> 'table_default',
				'data'		=> (object) array (
					'classes'  	=> 'striped bordered hover',
					'insertable'=> true,
					'editable'	=> true,
					'deletable'	=> true,
					'statusable'=> true,
					'detailable'=> true,
					'pdf'		=> false,
					'xls'		=> false,
					'pagination'=> $limit,
					'filters'  	=> $fields,
					'toolbars'	=> null,
					'header'  	=> $header,
					'body'  	=> $body,
					'footer'  	=> null,
				)		
			);
		}else{
			$this->data['list'] = (object) array (
				'type'  	=> 'table_default',
				'data'		=> (object) array (
					'classes'  	=> 'striped bordered hover',
					'insertable'=> false,
					'editable'	=> false,
					'deletable'	=> false,
					'statusable'=> false,
					'detailable'=> true,
					'pdf'		=> false,
					'xls'		=> false,
					'pagination'=> $limit,
					'filters'  	=> $fields,
					'toolbars'	=> null,
					'header'  	=> $header,
					'body'  	=> $body,
					'footer'  	=> null,
				)		
			);

		}		
		echo json_encode($this->data['list']);
	}
	
	public function insert(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}			
		if(isset($_POST['submit'])){
			//validation
			$error_info = array();
			$error_status = false;
			if($_POST['kota_asal'] == ''){
				$error_info[] = 'kota asal can not be null';
				$error_status = true;
			}
			if($_POST['kota_tujuan'] == ''){
				$error_info[] = 'kota tujuan can not be null';
				$error_status = true;
			}			
			if($_POST['bisnis'] == ''){
				$error_info[] = 'bisnis can not be null';
				$error_status = true;
			}
			if($_POST['ekonomi'] == ''){
				$error_info[] = 'ekonomi can not be null';
				$error_status = true;
			}
			
			$filter = array();
			$filter[] = "A.KOTA_ASAL_ID = '". $_POST['kota_asal']."'";
			$filter[] = "A.KOTA_TUJUAN_ID = '". $_POST['kota_tujuan']."'";
			$data = $this->sbtppddnpp_model->get($filter);
			if(!empty($data)){
				$error_info[] = 'This pair has been inputted';
				$error_status = true;				
			}

			if(!is_numeric($_POST['bisnis'])){
				$error_info[] = 'bisnis Only numeric allowed';
				$error_status = true;				
			}			
			if(!is_numeric($_POST['ekonomi'])){
				$error_info[] = 'ekonomi Only numeric allowed';
				$error_status = true;				
			}
			
			if($error_status == true){
				$this->data['error'] = (object) array (
					'type'  	=> 'error',
					'data'		=> (object) array (
						'info'	=> $error_info,
					)
				);				
				echo json_encode($this->data['error']);
			}else{
				$this->data['insert'] = array(
						'KOTA_ASAL_ID' => $_POST['kota_asal'],
						'KOTA_TUJUAN_ID' => $_POST['kota_tujuan'],
						'BISNIS' => $_POST['bisnis'],
						'EKONOMI' => $_POST['ekonomi'],
					);						

				$result = $this->sbtppddnpp_model->insert($this->data['insert']);
				$info = array();
				$info[] = 'Insert data success';
				$this->data['success'] = (object) array (
					'type'  	=> 'success',
					'data'		=> (object) array (
						'info'	=> $info,
					)
				);			
				echo json_encode($this->data['success']);			
			}
		}else{
			$kota_asal = array();
			$kota_tujuan = array();
			$data = $this->kota_model->get();
			if (empty($data)) {
				
			} else {
				foreach ($data as $value) {
					$kota_asal[] = (object) array('label'=>$value->NAMA, 'value'=>$value->ID);
					$kota_tujuan[] = (object) array('label'=>$value->NAMA, 'value'=>$value->ID);
				}
			}		
			
			$fields = array();
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'kota asal',
				'name' 			=> 'kota_asal',
				'placeholder'	=> '--Select Kota Asal--',
				'value' 		=> '',
				'options'		=> $kota_asal,
				'classes' 		=> '',
			);			
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'kota tujuan',
				'name' 			=> 'kota_tujuan',
				'placeholder'	=> '--Select Kota Tujuan--',
				'value' 		=> '',
				'options'		=> $kota_tujuan,
				'classes' 		=> '',
			);			
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'bisnis',
				'name' 			=> 'bisnis',
				'placeholder'	=> 'bisnis',
				'value' 		=> '',
				'classes' 		=> 'full-width',
			);			
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'ekonomi',
				'name' 			=> 'ekonomi',
				'placeholder'	=> 'ekonomi',
				'value' 		=> '',
				'classes' 		=> 'full-width',
			);				
			

			$this->data['insert'] = (object) array (
				'type'  	=> 'insert_default',
				'data'		=> (object) array (
					'classes'  	=> '',
					'fields'  	=> $fields,
				)
			);	
			echo json_encode($this->data['insert']);			
		}
	}
	
	public function update(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}			
		if(isset($_POST['submit'])){
			$error_info = array();
			$error_status = false;
			if($_POST['kota_asal'] == ''){
				$error_info[] = 'kota asal can not be null';
				$error_status = true;
			}
			if($_POST['kota_tujuan'] == ''){
				$error_info[] = 'kota tujuan can not be null';
				$error_status = true;
			}			
			if($_POST['bisnis'] == ''){
				$error_info[] = 'bisnis can not be null';
				$error_status = true;
			}
			if($_POST['ekonomi'] == ''){
				$error_info[] = 'ekonomi can not be null';
				$error_status = true;
			}
			
			$filter = array();
			$filter[] = "A.KOTA_ASAL_ID = '". $_POST['kota_asal']."'";
			$filter[] = "A.KOTA_TUJUAN_ID = '". $_POST['kota_tujuan']."'";
			$filter[] = "A.ID != '". $_POST['id']."'";			
			$data = $this->sbtppddnpp_model->get($filter);
			if(!empty($data)){
				$error_info[] = 'This pair has been inputted';
				$error_status = true;				
			}

			if(!is_numeric($_POST['bisnis'])){
				$error_info[] = 'bisnis Only numeric allowed';
				$error_status = true;				
			}			
			if(!is_numeric($_POST['ekonomi'])){
				$error_info[] = 'ekonomi Only numeric allowed';
				$error_status = true;				
			}
			
			
			if($error_status == true){
				$this->data['error'] = (object) array (
					'type'  	=> 'error',
					'data'		=> (object) array (
						'info'	=> $error_info,
					)
				);				
				echo json_encode($this->data['error']);
			}else{
				$this->data['update'] = array(
						'KOTA_ASAL_ID' => $_POST['kota_asal'],
						'KOTA_TUJUAN_ID' => $_POST['kota_tujuan'],
						'BISNIS' => $_POST['bisnis'],
						'EKONOMI' => $_POST['ekonomi'],
					);						

				$result = $this->sbtppddnpp_model->update($this->data['update'], $_POST['id']);
				echo json_encode($result);
					$info = array();
					$info[] = 'Update data successfully';						
					$this->data['info'] = (object) array (
						'type'  	=> 'success',
						'data'		=> (object) array (
							'info'	=> $info,
						)
					);				
			}	
		}else{
			$r_id = '';
			$r_kota_asal = '';
			$r_kota_tujuan = '';
			$r_bisnis = '';
			$r_ekonomi = '';
			
			$filter = array();
			$filter[] = "A.ID = ". $_POST['id'];
			$this->data['result'] = $this->sbtppddnpp_model->get($filter);
			foreach($this->data['result'] as $value){
				$r_id 	= $value->ID;
				$r_kota_asal = $value->KOTA_ASAL_ID;
				$r_kota_tujuan = $value->KOTA_TUJUAN_ID;
				$r_bisnis = $value->BISNIS;
				$r_ekonomi = $value->EKONOMI;
			}			
			
			$kota_asal = array();
			$kota_tujuan = array();
			$data = $this->kota_model->get();
			if (empty($data)) {
				
			} else {
				foreach ($data as $value) {
					$kota_asal[] = (object) array('label'=>$value->NAMA, 'value'=>$value->ID);
					$kota_tujuan[] = (object) array('label'=>$value->NAMA, 'value'=>$value->ID);
				}
			}		
				
			$fields = array();
			$fields[] = (object) array(
				'type' 		=> 'hidden',
				'label' 	=> 'id',
				'name' 		=> 'id',
				'value' 	=> $r_id,
				'classes' 	=> '',
			);				
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'kota asal',
				'name' 			=> 'kota_asal',
				'placeholder'	=> '--Select Kota Tujuan--',
				'value' 		=> $r_kota_asal,
				'options'		=> $kota_asal,
				'classes' 		=> '',
			);			
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'kota tujuan',
				'name' 			=> 'kota_tujuan',
				'placeholder'	=> '--Select Kota Asal--',
				'value' 		=> $r_kota_tujuan,
				'options'		=> $kota_tujuan,
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'bisnis',
				'name' 			=> 'bisnis',
				'placeholder'	=> 'bisnis',
				'value' 		=> $r_bisnis,
				'classes' 		=> 'full-width',
			);			
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'ekonomi',
				'name' 			=> 'ekonomi',
				'placeholder'	=> 'ekonomi',
				'value' 		=> $r_ekonomi,
				'classes' 		=> 'full-width',
			);		

			$this->data['update'] = (object) array (
				'type'  	=> 'update_default',
				'data'		=> (object) array (
					'classes'  	=> '',
					'fields'  	=> $fields,
				)
			);
			echo json_encode($this->data['update']);			
				
		}
	}
	
	public function detail($id=null){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		if(isset($_POST['id']) and $_POST['id'] != null){
			$filters = array();
			$filters[] = "A.ID = ". $_POST['id'];
			$data = $this->sbtppddnpp_model->get($filters);
			
			$body= array();			
			if (empty($data)) {
                $body[] = array(
                    (object) array ('colspan' => 100, 'classes' => ' empty bold align-center', 'value' => 'No Data')
                );
			} else {
				foreach($data as $value){
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Kota Asal' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->KOTA_ASAL ),
					);					
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Kota Tujuan' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->KOTA_TUJUAN ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Bisnis' ),
						(object) array( 'classes' => ' align-left ', 'value' => number_format($value->BISNIS, 0, ',', '.') ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Ekonomi' ),
						(object) array( 'classes' => ' align-left ', 'value' => number_format($value->EKONOMI, 0, ',', '.') ),
					);					
					if($this->session->userdata('ROLE_NAME') == 'administrator'){
						$body[] = array(
							(object) array( 'classes' => ' bold align-left ', 'value' => 'Status' ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->STATUS ),
						);					
						$body[] = array(
							(object) array( 'classes' => ' bold align-left ', 'value' => 'Create Date' ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->CREATE_DATE ),
						);
						$body[] = array(
							(object) array( 'classes' => ' bold align-left ', 'value' => 'Update Date' ),
							(object) array( 'classes' => ' align-left ', 'value' => $value->UPDATE_DATE ),
						);
					}		
				}
			}
			
			$header = array(
				array (
					(object) array ('rowspan' => 1, 'classes' => 'bold align-left capitalize', 'value' => 'Label'),
					(object) array ('colspan' => 1, 'classes' => 'bold align-left capitalize', 'value' => 'Value'),	
				)		
			);			
			
			$this->data['detail'] = (object) array (
				'type'  	=> 'detail_default',
				'data'		=> (object) array (
					'classes'	=> 'striped bordered hover',
					'header'	=> $header,
					'body'		=> $body,
				)
			);			
			echo json_encode($this->data['detail']);
		}
	}	
	
	public function update_status(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}		
		if(isset($_POST['id']) and $_POST['id'] != null){
			$filters = array();
			$filters[] = "A.ID = ". $_POST['id'];
			
			$result = $this->sbtppddnpp_model->get($filters);
			if($result != null){
				foreach($result as $item){
					$status = $item->STATUS;
				}
				if($status == '1'){
					$new_status = '0';
				}else if($status == '0'){
					$new_status = '1';
				}
			}
			
			$this->data['update'] = array(
					'STATUS' => $new_status,
				);	
				
			$result = $this->sbtppddnpp_model->update($this->data['update'], $_POST['id']);
			if($result == true){
				$info = array();
				$info[] = 'Update status data successfully';						
				$this->data['info'] = (object) array (
					'type'  	=> 'success',
					'data'		=> (object) array (
						'info'	=> $info,
					)
				);
			}else{
				$info = array();
				$info[] = 'Update status data not successfull';
				$this->data['info'] = (object) array (
					'type'  	=> 'error',
					'data'		=> (object) array (
						'info'	=> $info,
					)
				);
			}			
			echo json_encode($this->data['info']);	
		}
	}
	
	public function delete(){
		if($this->auth->get_permission($this->session->userdata('ROLE_NAME'), __CLASS__ , __FUNCTION__ ) == false){
			redirect ('authentication/unauthorized');
		}			
		$this->data['delete'] = array(
				'ID' => $_POST['id'],
			);		
		$result = $this->sbtppddnpp_model->delete($this->data['delete']);
		echo json_encode($result);

		if($result == true){
			$info = array();
			$info[] = 'Delete data successfully';			
			$info[] = 'Have a nice day';			
			$this->data['info'] = (object) array (
				'type'  	=> 'success',
				'data'		=> (object) array (
					'info'	=> $info,
				)
			);
		}else{
			$info = array();
			$info[] = 'Delete data not successfull';
			$this->data['info'] = (object) array (
				'type'  	=> 'error',
				'data'		=> (object) array (
					'info'	=> $info,
				)
			);
		}
		echo json_encode($this->data['info']);			
	}
	
}

