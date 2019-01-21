<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sbtpddn extends CI_Controller {
	private $data;
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('auth');				
		$this->load->helper('url');			
		$this->load->database();
		$this->load->model('sbtpddn_model');
		$this->load->model('provinsi_model');
		$this->load->model('satuan_model');
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
		$this->data['title'] = 'Satuan Biaya Taksi Perjalanan Dinas Dalam Negeri';
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
		$r_provinsi = '';

		if(isset($_POST['submit'])){
			if (isset($_POST['provinsi'])) {
				if ($_POST['provinsi'] != '' or $_POST['provinsi'] != null) {
					$filters[] = "A.PROVINSI_ID = '" . $_POST['provinsi'] . "'";
					$r_provinsi = $_POST['provinsi'];
				}
			}
			if (isset($_POST['offset'])) {
				if ($_POST['offset'] != '' or $_POST['offset'] != null) {
					$limit[1] = $_POST['offset'];
				}
			}			
		}
		
		$data = $this->sbtpddn_model->get($filters, $limit);
		$total_data = count($this->sbtpddn_model->get($filters));
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
						(object) array( 'classes' => ' align-left ', 'value' => $value->PROVINSI ),
						(object) array( 'classes' => ' align-center ', 'value' => $value->SATUAN ),						
						(object) array( 'classes' => ' align-right ', 'value' => number_format($value->BESARAN, 0, ',', '.') ),
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
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'No'),
				(object) array ('colspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'provinsi'),					
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'satuan'),			
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'besaran'),						
			)		
		);
		
		$provinsi = array();
		$data = $this->provinsi_model->get();
		if (empty($data)) {
			
		} else {
			foreach ($data as $value) {
				$provinsi[] = (object) array('label'=>$value->NAMA, 'value'=>$value->ID);
			}
		}		
			
		$fields = array();
		$fields[] = (object) array(
			'type' 			=> 'select',
			'label' 		=> 'provinsi',
			'name' 			=> 'provinsi',
			'placeholder'	=> '--Select Provinsi--',
			'value' 		=> $r_provinsi,
			'options'		=> $provinsi,
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
			if($_POST['provinsi'] == ''){
				$error_info[] = 'provinsi can not be null';
				$error_status = true;
			}
			if($_POST['satuan'] == ''){
				$error_info[] = 'satuan can not be null';
				$error_status = true;
			}
			if($_POST['besaran'] == ''){
				$error_info[] = 'besaran can not be null';
				$error_status = true;
			}
			
			$filter = array();
			$filter[] = "A.PROVINSI_ID = '". $_POST['provinsi']."'";
			$data = $this->sbtpddn_model->get($filter);
			if(!empty($data)){
				$error_info[] = 'This pair has been inputted';
				$error_status = true;				
			}

			if(!is_numeric($_POST['besaran'])){
				$error_info[] = 'besaran Only numeric allowed';
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
						'PROVINSI_ID' => $_POST['provinsi'],
						'SATUAN_ID' => $_POST['satuan'],
						'BESARAN' => $_POST['besaran'],
					);						

				$result = $this->sbtpddn_model->insert($this->data['insert']);
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
			$provinsi = array();
			$data = $this->provinsi_model->get();
			if (empty($data)) {
				
			} else {
				foreach ($data as $value) {
					$provinsi[] = (object) array('label'=>$value->NAMA, 'value'=>$value->ID);
				}
			}	
			
			$satuan = array();
			$filter = array();
			$filter[] = "NAMA like '%Orang/Kali%'";
			$data = $this->satuan_model->get($filter);
			if (empty($data)) {
				
			} else {
				foreach ($data as $value) {
					$satuan[] = (object) array('label'=>$value->NAMA, 'value'=>$value->ID);
				}
			}		
				
			$fields = array();
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'provinsi',
				'name' 			=> 'provinsi',
				'placeholder'	=> '--Select Provinsi--',
				'value' 		=> '',
				'options'		=> $provinsi,
				'classes' 		=> '',
			);			
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'satuan',
				'name' 			=> 'satuan',
				'placeholder'	=> '',
				'value' 		=> '',
				'options'		=> $satuan,
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'besaran',
				'name' 			=> 'besaran',
				'placeholder'	=> 'besaran',
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
			if($_POST['provinsi'] == ''){
				$error_info[] = 'provinsi can not be null';
				$error_status = true;
			}
			if($_POST['satuan'] == ''){
				$error_info[] = 'satuan can not be null';
				$error_status = true;
			}
			if($_POST['besaran'] == ''){
				$error_info[] = 'besaran can not be null';
				$error_status = true;
			}
			
			$filter = array();
			$filter[] = "A.PROVINSI_ID = '". $_POST['provinsi']."'";
			$filter[] = "A.ID != '". $_POST['id']."'";
			$data = $this->sbtpddn_model->get($filter);
			if(!empty($data)){
				$error_info[] = 'This pair has been inputted';
				$error_status = true;				
			}

			if(!is_numeric($_POST['besaran'])){
				$error_info[] = 'besaran Only numeric allowed';
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
						'PROVINSI_ID' => $_POST['provinsi'],
						'SATUAN_ID' => $_POST['satuan'],
						'BESARAN' => $_POST['besaran'],
					);						

				$result = $this->sbtpddn_model->update($this->data['update'], $_POST['id']);
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
			$r_provinsi = '';
			$r_satuan = '';
			$r_besaran = '';
			
			$filter = array();
			$filter[] = "A.ID = ". $_POST['id'];
			$this->data['result'] = $this->sbtpddn_model->get($filter);
			foreach($this->data['result'] as $value){
				$r_id 	= $value->ID;
				$r_provinsi = $value->PROVINSI_ID;
				$r_satuan = $value->SATUAN_ID;
				$r_besaran = $value->BESARAN;
			}			
			
			$provinsi = array();
			$data = $this->provinsi_model->get();
			if (empty($data)) {
				
			} else {
				foreach ($data as $value) {
					$provinsi[] = (object) array('label'=>$value->NAMA, 'value'=>$value->ID);
				}
			}	
			
			$satuan = array();
			$filter = array();
			$filter[] = "NAMA like '%Orang/Kali%'";
			$data = $this->satuan_model->get($filter);
			if (empty($data)) {
				
			} else {
				foreach ($data as $value) {
					$satuan[] = (object) array('label'=>$value->NAMA, 'value'=>$value->ID);
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
				'label' 		=> 'provinsi',
				'name' 			=> 'provinsi',
				'placeholder'	=> '--Select Provinsi--',
				'value' 		=> $r_provinsi,
				'options'		=> $provinsi,
				'classes' 		=> '',
			);			
			$fields[] = (object) array(
				'type' 			=> 'select',
				'label' 		=> 'satuan',
				'name' 			=> 'satuan',
				'placeholder'	=> '',
				'value' 		=> $r_satuan,
				'options'		=> $satuan,
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'besaran',
				'name' 			=> 'besaran',
				'placeholder'	=> 'besaran',
				'value' 		=> $r_besaran,
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
			$data = $this->sbtpddn_model->get($filters);
			
			$body= array();			
			if (empty($data)) {
                $body[] = array(
                    (object) array ('colspan' => 100, 'classes' => ' empty bold align-center', 'value' => 'No Data')
                );
			} else {
				foreach($data as $value){
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Provinsi' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->PROVINSI ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Satuan' ),
						(object) array( 'classes' => ' align-left ', 'value' => $value->SATUAN ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Besaran' ),
						(object) array( 'classes' => ' align-left ', 'value' => number_format($value->BESARAN, 0, ',', '.') ),
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
			
			$result = $this->sbtpddn_model->get($filters);
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
				
			$result = $this->sbtpddn_model->update($this->data['update'], $_POST['id']);
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
		$result = $this->sbtpddn_model->delete($this->data['delete']);
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

