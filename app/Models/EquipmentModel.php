<?php
namespace App\Models;
use CodeIgniter\Model;

class EquipmentModel extends Model {
    
	protected $table = 'data_section';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = true;
	protected $allowedFields = ['kode', 'nama_section', 'lokasi', 'id_area', 'id_equipment', 'description', 'created_at', 'updated_at', 'deleted_at'];
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

	public function get_all_section($limit=10,$offset=0,$sort = "id", $order = "DESC",$q="",$status = '')
	{
		$search = '';
		if(!empty($q)){
			$str = [',',"'",'>','<'];
			$q = str_replace($str,"",$q);
			$search .= " AND (s.kode LIKE '%$q%' OR s.nama_section LIKE '%$q%' OR a.area LIKE '%$q%')";
		}

		$total = $this->db->Query("SELECT count(s.id) total from data_section s LEFT JOIN data_area a on a.id = s.id_area WHERE s.deleted_at IS NULL $search ")->getRow('total');
		if($total >= 1){
			$sql = "SELECT s.*, a.area, e.nama as equipment from data_section s LEFT JOIN data_area a on a.id = s.id_area LEFT JOIN data_equipment e  ON s.id_equipment = e.id WHERE s.deleted_at IS NULL $search ORDER BY s.$sort $order LIMIT $offset,$limit ";
			$rows = $this->db->Query($sql)->getResultArray();
		}
		
		$data = [
			'rows' => $rows,
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