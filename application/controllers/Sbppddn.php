<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sbppddn extends CI_Controller {
	private $data;
	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->library('auth');				
		$this->load->helper('url');			
		$this->load->database();
		$this->load->model('sbppddn_model');
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
		$this->data['title'] = 'Satuan Biaya Penginapan Perjalanan Dinas Dalam Negeri';
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
		
		$data = $this->sbppddn_model->get($filters, $limit);
		$total_data = count($this->sbppddn_model->get($filters));
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
						(object) array( 'classes' => ' align-right ', 'value' => number_format($value->ES_I, 0, ',', '.') ),
						(object) array( 'classes' => ' align-right ', 'value' => number_format($value->ES_II, 0, ',', '.') ),
						(object) array( 'classes' => ' align-right ', 'value' => number_format($value->GOL_IV, 0, ',', '.') ),
						(object) array( 'classes' => ' align-right ', 'value' => number_format($value->GOL_III, 0, ',', '.') ),
						(object) array( 'classes' => ' align-right ', 'value' => number_format($value->GOL_I_II, 0, ',', '.') ),
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
				(object) array ('rowspan' => 2, 'classes' => 'bold align-center capitalize', 'value' => 'provinsi'),					
				(object) array ('rowspan' => 2, 'classes' => 'bold align-center capitalize', 'value' => 'satuan'),			
				(object) array ('rowspan' => 1, 'colspan' => 5, 'classes' => 'bold align-center capitalize', 'value' => 'tarif hotel'),					
			),
			array (
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'Pejabat Negara / Pejabat Eselon I'),					
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'Pejabat Negara Lainnnya / Pejabat Eselon II'),			
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'Pejabat Eselon III / Golongan IV'),			
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'Pejabat Eselon IV / Golongan III'),		
				(object) array ('rowspan' => 1, 'classes' => 'bold align-center capitalize', 'value' => 'Golongan I/II'),			
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
			if($_POST['es_i'] == ''){
				$error_info[] = 'es_i can not be null';
				$error_status = true;
			}
			if($_POST['es_ii'] == ''){
				$error_info[] = 'es_ii can not be null';
				$error_status = true;
			}
			if($_POST['gol_iv'] == ''){
				$error_info[] = 'gol_iv can not be null';
				$error_status = true;
			}
			if($_POST['gol_iii'] == ''){
				$error_info[] = 'gol_iii can not be null';
				$error_status = true;
			}
			if($_POST['gol_i_ii'] == ''){
				$error_info[] = 'gol_i_ii can not be null';
				$error_status = true;
			}			
			
			$filter = array();
			$filter[] = "A.PROVINSI_ID = '". $_POST['provinsi']."'";
			$data = $this->sbppddn_model->get($filter);
			if(!empty($data)){
				$error_info[] = 'This pair has been inputted';
				$error_status = true;				
			}

			if(!is_numeric($_POST['es_i'])){
				$error_info[] = 'es_i only numeric allowed';
				$error_status = true;				
			}
			if(!is_numeric($_POST['es_ii'])){
				$error_info[] = 'es_ii only numeric allowed';
				$error_status = true;				
			}
			if(!is_numeric($_POST['gol_iv'])){
				$error_info[] = 'gol_iv only numeric allowed';
				$error_status = true;				
			}
			if(!is_numeric($_POST['gol_iii'])){
				$error_info[] = 'gol_iii only numeric allowed';
				$error_status = true;				
			}
			if(!is_numeric($_POST['gol_i_ii'])){
				$error_info[] = 'gol_i_ii only numeric allowed';
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
						'ES_I' => $_POST['es_i'],
						'ES_II' => $_POST['es_ii'],
						'GOL_IV' => $_POST['gol_iv'],
						'GOL_III' => $_POST['gol_iii'],
						'GOL_I_II' => $_POST['gol_i_ii'],
					);						

				$result = $this->sbppddn_model->insert($this->data['insert']);
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
			$filter[] = "NAMA like '%OH%'";
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
				'label' 		=> 'es_i',
				'name' 			=> 'es_i',
				'placeholder'	=> 'es_i',
				'value' 		=> '',
				'classes' 		=> '',
			);			
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'es_ii',
				'name' 			=> 'es_ii',
				'placeholder'	=> 'es_ii',
				'value' 		=> '',
				'classes' 		=> '',
			);			
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'gol_iv',
				'name' 			=> 'gol_iv',
				'placeholder'	=> 'gol_iv',
				'value' 		=> '',
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'gol_iii',
				'name' 			=> 'gol_iii',
				'placeholder'	=> 'gol_iii',
				'value' 		=> '',
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'gol_i_ii',
				'name' 			=> 'gol_i_ii',
				'placeholder'	=> 'gol_i_ii',
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
			if($_POST['es_i'] == ''){
				$error_info[] = 'es_i can not be null';
				$error_status = true;
			}
			if($_POST['es_ii'] == ''){
				$error_info[] = 'es_ii can not be null';
				$error_status = true;
			}
			if($_POST['gol_iv'] == ''){
				$error_info[] = 'gol_iv can not be null';
				$error_status = true;
			}
			if($_POST['gol_iii'] == ''){
				$error_info[] = 'gol_iii can not be null';
				$error_status = true;
			}
			if($_POST['gol_i_ii'] == ''){
				$error_info[] = 'gol_i_ii can not be null';
				$error_status = true;
			}			
			
			$filter = array();
			$filter[] = "A.PROVINSI_ID = '". $_POST['provinsi']."'";
			$filter[] = "A.ID != '". $_POST['id']."'";			
			$data = $this->sbppddn_model->get($filter);
			if(!empty($data)){
				$error_info[] = 'This pair has been inputted';
				$error_status = true;				
			}

			if(!is_numeric($_POST['es_i'])){
				$error_info[] = 'es_i only numeric allowed';
				$error_status = true;				
			}
			if(!is_numeric($_POST['es_ii'])){
				$error_info[] = 'es_ii only numeric allowed';
				$error_status = true;				
			}
			if(!is_numeric($_POST['gol_iv'])){
				$error_info[] = 'gol_iv only numeric allowed';
				$error_status = true;				
			}
			if(!is_numeric($_POST['gol_iii'])){
				$error_info[] = 'gol_iii only numeric allowed';
				$error_status = true;				
			}
			if(!is_numeric($_POST['gol_i_ii'])){
				$error_info[] = 'gol_i_ii only numeric allowed';
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
						'ES_I' => $_POST['es_i'],
						'ES_II' => $_POST['es_ii'],
						'GOL_IV' => $_POST['gol_iv'],
						'GOL_III' => $_POST['gol_iii'],
						'GOL_I_II' => $_POST['gol_i_ii'],
					);						

				$result = $this->sbppddn_model->update($this->data['update'], $_POST['id']);
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
			$r_es_i = '';
			$r_es_ii = '';
			$r_gol_iv = '';
			$r_gol_iii = '';
			$r_gol_i_ii = '';
			
			$filter = array();
			$filter[] = "A.ID = ". $_POST['id'];
			$this->data['result'] = $this->sbppddn_model->get($filter);
			foreach($this->data['result'] as $value){
				$r_id 	= $value->ID;
				$r_provinsi = $value->PROVINSI_ID;
				$r_satuan = $value->SATUAN_ID;
				$r_es_i = $value->ES_I;
				$r_es_ii = $value->ES_II;
				$r_gol_iv = $value->GOL_IV;
				$r_gol_iii = $value->GOL_III;
				$r_gol_i_ii = $value->GOL_I_II;
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
			$filter[] = "NAMA like '%OH%'";
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
				'label' 		=> 'es_i',
				'name' 			=> 'es_i',
				'placeholder'	=> 'es_i',
				'value' 		=> $r_es_i,
				'classes' 		=> '',
			);			
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'es_ii',
				'name' 			=> 'es_ii',
				'placeholder'	=> 'es_ii',
				'value' 		=> $r_es_ii,
				'classes' 		=> '',
			);			
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'gol_iv',
				'name' 			=> 'gol_iv',
				'placeholder'	=> 'gol_iv',
				'value' 		=> $r_gol_iv,
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'gol_iii',
				'name' 			=> 'gol_iii',
				'placeholder'	=> 'gol_iii',
				'value' 		=> $r_gol_iii,
				'classes' 		=> '',
			);
			$fields[] = (object) array(
				'type' 			=> 'text',
				'label' 		=> 'gol_i_ii',
				'name' 			=> 'gol_i_ii',
				'placeholder'	=> 'gol_i_ii',
				'value' 		=> $r_gol_i_ii,
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
			$data = $this->sbppddn_model->get($filters);

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
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Pejabat Negara / Pejabat Eselon I' ),
						(object) array( 'classes' => ' align-left ', 'value' => number_format($value->ES_I, 0, ',', '.') ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Pejabat Negara Lainnnya / Pejabat Eselon II' ),
						(object) array( 'classes' => ' align-left ', 'value' => number_format($value->ES_II, 0, ',', '.') ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Pejabat Eselon III / Golongan IV' ),
						(object) array( 'classes' => ' align-left ', 'value' => number_format($value->GOL_IV, 0, ',', '.') ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Pejabat Eselon IV / Golongan III' ),
						(object) array( 'classes' => ' align-left ', 'value' => number_format($value->GOL_III, 0, ',', '.') ),
					);
					$body[] = array(
						(object) array( 'classes' => ' bold align-left ', 'value' => 'Golongan I/II' ),
						(object) array( 'classes' => ' align-left ', 'value' => number_format($value->GOL_I_II, 0, ',', '.') ),
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
			
			$result = $this->sbppddn_model->get($filters);
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
				
			$result = $this->sbppddn_model->update($this->data['update'], $_POST['id']);
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
		$result = $this->sbppddn_model->delete($this->data['delete']);
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

