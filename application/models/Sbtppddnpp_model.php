<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sbtppddnpp_model extends CI_Model {
	
	private $_table1 = "sbtppddnpp";
	private $_table2 = "kota";

    public function __construct(){
		parent::__construct();
		$this->_table1 = $this->_table1.'_'.date("Y");
    }

	public function get($filters=null, $limit=null){
		$sql = "SELECT A.*, B.NAMA KOTA_ASAL, C.NAMA KOTA_TUJUAN FROM " . $this->_table1 ." A LEFT JOIN ". $this->_table2 ." B ";
		$sql .= " ON A.KOTA_ASAL_ID = B.ID";
		$sql .= " LEFT JOIN ". $this->_table2 ." C ";
		$sql .= " ON A.KOTA_TUJUAN_ID = C.ID";	
		$sql .= " WHERE 1=1";
		if(isset($filters) and $filters != null){
			foreach ($filters as $filter) {
				$sql .= " AND " . $filter;
			}
		}
		$sql .= " ORDER BY ID ASC";
		if(isset($limit) and $limit != null){
			$sql .= " LIMIT ".$limit[0]." OFFSET ".$limit[1];
		}
		//var_dump($sql); die;
		
		$query = $this->db->query($sql);
		$result = $query->result();
		//var_dump($result); die;	
		return $result;
	}
	
	public function insert($data){
		$result = $this->db->insert($this->_table1, $data);
		return $result;
	}
	
	public function update($data, $id){;
		$this->db->where('ID', $id);
		$result = $this->db->update($this->_table1, $data);
		return $result;
	}
	
	public function delete($data){
		$result = $this->db->delete($this->_table1, $data);
		return $result;
	}
	
}
