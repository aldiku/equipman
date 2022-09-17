<?php
namespace App\Models;
use CodeIgniter\Model;

class EquipmentModel extends Model {
    
	protected $table = 'data_section';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = true;
	protected $allowedFields = ['kode', 'nama_section', 'plant', 'id_area', 'id_equipment','parent', 'description', 'created_at', 'updated_at', 'deleted_at'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    

	public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
		$this->report = new \App\Models\ReportModel();
    }

	public function clone_data_value($source_id, $new_id){
		if($source_id != '0'){
			$cek_value = $this->db->Query("SELECT * from data_value where section_id = '$source_id'")->getResultArray();
			$data = $this->db->Query("SELECT plant,id_area,id_equipment,nama_section,kode,description from data_section where id = '$source_id'")->getRowArray();
			if(empty($cek_value)){
				//create value if parent empty
				// $out = [];
				foreach($data as $key => $val){
					if($key == 'plant'){
						$field = '1';
					}
					if($key == 'id_area'){
						$field = '2';
					}
					if($key == 'id_equipment'){
						$field = '3';
					}
					if($key == 'nama_section'){
						$field = '4';
						$val = ucwords($val);
					}
					if($key == 'kode'){
						$field = '5';
					}
					if($key == 'description'){
						$field = '6';
					}
					// $out[] = [
					// 	'section_id' => $source_id,
					// 	'field_id' => $field,
					// 	'value' => $val,
					// 	'created_at' => date('Y-m-d H:i:s')
					// ];
					$cek = $this->db->table("data_value")->where([
						'section_id' => $source_id,
						'field_id' => $field,
					])->get()->getRow();
					if(empty($cek)){
						$this->db->table('data_value')->insert([
							'section_id' => $source_id,
							'field_id' => $field,
							'value' => $val,
							'created_at' => date('Y-m-d H:i:s')
						]);
					}else{
						$this->db->table('data_value')->set([
							'section_id' => $source_id,
							'field_id' => $field,
							'value' => $val,
							'updated_at' => date('Y-m-d H:i:s')
						])->where([
							'section_id' => $source_id,
							'field_id' => $field,
						])->update();
					}
				}
				$this->clone_data_value($source_id, $new_id);
			}else{
				foreach($cek_value as $c){
					$cek = $this->db->table("data_value")->where([
						'section_id' => $new_id,
						'field_id' => $c['field_id'],
					])->get()->getRow();
					if(empty($cek)){
						$this->db->table('data_value')->insert([
							'section_id' => $new_id,
							'field_id' => $c['field_id'],
							'value' => $c['value'],
							'created_at' => date('Y-m-d H:i:s')
						]);
					}else{
						$this->db->table('data_value')->set([
							'section_id' => $new_id,
							'field_id' => $c['field_id'],
							'value' => $c['value'],
							'updated_at' => date('Y-m-d H:i:s')
						])->where([
							'section_id' => $new_id,
							'field_id' => $c['field_id'],
						])->update();
					}
				}
			}
		}
	}

	public function get_tree($plant = 'all', $area='all',$equipment = 'all',$section = 'all', $keyword='',$withReport = false){
		$search = '';
		if($plant != 'all' && is_numeric($plant)){
			$search .= " AND s.plant = '$plant' ";
		}
		if($area != 'all' && is_numeric($area)){
			$search .= " AND s.id_area = '$area' ";
		}
		if($equipment != 'all' && is_numeric($equipment)){
			$search .= " AND s.id_equipment = '$equipment' ";
		}
		if($section != 'all'){
			if(strtolower($section) == 'main'){
				$search .= " AND s.parent = '0' ";
			}else{
				$search .= " AND s.parent != '0' ";
			}
		}
		if(!empty($keyword)){
			$search .= " AND (s.kode like '%$keyword%' or s.nama_section like '%$keyword%') ";
		}

		$query = "SELECT s.id,s.plant, s.kode, s.nama_section, a.area, e.nama AS equipment FROM data_section s JOIN data_area a ON s.id_area = a.id JOIN data_equipment e ON s.id_equipment = e.id WHERE s.deleted_at IS NULL $search";
		$data = $this->db->query($query)->getResultArray();
		$result = [];
		foreach ($data as $row){
			$result[$row['plant']][$row['area']][$row['equipment']][$row['kode']][] = [
				'id' => $row['id'],
				'plant' => $row['plant'],
				'kode' => $row['kode'],
				'nama_section' => $row['nama_section'],
				'area' => $row['area'],
				'equipment' => $row['equipment'],
				'report' => $withReport ? $this->report->get_data($row['id']) : []
			];
		}    
		// $result['query'] = $query;
		return $result;
	}

	public function get_all_equipment(){
		$data = $this->db->table('data_equipment')
		->get()->getResultArray(); 
		return $data;
	}

	public function get_all_area(){
		$data = $this->db->table('data_area')
		->get()->getResultArray(); 
		return $data;
	}

	public function get_all_section($limit=10,$offset=0,$sort = "id", $order = "DESC",$q="",$plant = 'all',$area = 'all',$equipment = 'all')
	{
		$search = '';
		if($plant != 'all' && is_numeric($plant)){
			$search .= " AND s.plant = '$plant' ";
		}
		if($area != 'all' && is_numeric($area)){
			$search .= " AND s.id_area = '$area' ";
		}
		if($equipment != 'all' && is_numeric($equipment)){
			$search .= " AND s.id_equipment = '$equipment' ";
		}
		if(!empty($q)){
			$str = [',',"'",'>','<'];
			$q = str_replace($str,"",$q);
			$search .= " AND (s.kode LIKE '%$q%' OR s.nama_section LIKE '%$q%' OR a.area LIKE '%$q%')";
		}

		$total = $this->db->Query("SELECT count(s.id) total from data_section s LEFT JOIN data_area a on a.id = s.id_area WHERE s.deleted_at IS NULL AND s.parent = '0' $search ")->getRow('total');
		if($total >= 1){
			$sql = "SELECT s.*, a.area, e.nama as equipment from data_section s LEFT JOIN data_area a on a.id = s.id_area LEFT JOIN data_equipment e  ON s.id_equipment = e.id WHERE s.deleted_at IS NULL AND s.parent = '0' $search ORDER BY s.$sort $order LIMIT $offset,$limit ";
			$rows = $this->db->Query($sql)->getResultArray();
			$list =[];
			foreach($rows as $r){
				$child = [];
				$parent = $r['id'];
				if($parent != '0'){
					$get_child = $this->db->Query("SELECT s.*, a.area, e.nama as equipment from data_section s LEFT JOIN data_area a on a.id = s.id_area LEFT JOIN data_equipment e  ON s.id_equipment = e.id WHERE s.deleted_at IS NULL AND s.parent = '$parent'")->getResultArray();
					if(!empty($get_child)){
						$child = $get_child;
					}
				}
				$list[] = [
					'id' => $r['id'],
					'kode' => $r['kode'],
					'plant' => $r['plant'],
					'nama_section' => $r['nama_section'],
					'id_area' => $r['id_area'],
					'id_equipment' => $r['id_equipment'],
					'area' => $r['area'],
					'equipment' => $r['equipment'],
					'parent' => $r['parent'],
					'child' => $child,
					'created_at' => $r['created_at'],
					'updated_at' => $r['updated_at'],
					'deleted_at' => $r['deleted_at'],
				];
			}
		}
		
		$data = [
			'rows' => $list,
			'offset' => $offset,
			'total' => (int)$total,
			'next' => ($offset+$limit >= $total) ? FALSE : TRUE,
			'limit' => (int)$limit,
			'currentPage' => ceil(($offset - 1) / $limit) + 1,
			'totalPage' => ceil($total/$limit),
		];
		return $data;

	}

	public function get_detail($id)
	{
		$sql = "SELECT s.*, a.area, e.nama as equipment from data_section s LEFT JOIN data_area a on a.id = s.id_area LEFT JOIN data_equipment e  ON s.id_equipment = e.id WHERE s.id = $id";
		$data = $this->db->Query($sql)->getRow();
		return $data;

	}
}