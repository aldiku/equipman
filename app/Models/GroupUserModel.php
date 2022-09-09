<?php
namespace App\Models;
use CodeIgniter\Model;

class GroupUserModel extends Model {
    
	protected $table = 'auth_groups_users';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['group_id', 'user_id'];
	protected $useTimestamps = false;
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;    

	public function get_all_groups($type='nosuperadmin')
	{
		$data = $this->db->table('auth_groups')
		->where('id >', ($type == 'nosuperadmin') ? '1' : '0')
		->get()->getResultArray(); 
		return $data;

	}

	public function create_group($data){
		$cek = $this->db->table('auth_groups')->where('name', $data['name'])->get()->getRow();
		if(empty($cek)){
			return $this->db->table('auth_groups')->insert($data);
		}
		return false;
	}

	public function show_group($id){
		$cek = $this->db->table('auth_groups')->where('id', $id)->get()->getRow();
		return $cek;
	}

	public function update_group($id,$data){
		$cek = $this->db->table('auth_groups')->set($data)->where('id',$id)->update();
		return $cek;
	}

	public function get_roles($limit=10,$offset=0,$sort = "id", $order = "DESC",$q="",$status = '')
	{
		$search = '';
		if(!empty($q)){
			$str = [',',"'",'>','<'];
			$q = str_replace($str,"",$q);
			$search .= " AND g.name LIKE '%$q%' ";
		}

		$total = $this->db->Query("SELECT count(g.id) total from auth_groups g WHERE g.id >= 1 $search ")->getRow('total');
		if($total >= 1){
			$sql = "SELECT * from auth_groups g WHERE g.id >= 1 $search ORDER BY g.$sort $order LIMIT $offset,$limit ";
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

	public function get_permissions($limit=10,$offset=0,$sort = "id", $order = "DESC",$q="",$status = '')
	{
		$search = '';
		if(!empty($q)){
			$str = [',',"'",'>','<'];
			$q = str_replace($str,"",$q);
			$search .= " AND (ap.name LIKE '%$q%')";
		}

		$total = $this->db->Query("SELECT count(ap.id) total FROM auth_permissions ap WHERE ap.id >= '1' $search ")->getRow('total');
		if($total >= 1){
			$sql = "SELECT ap.*  FROM auth_permissions ap WHERE ap.id >= '1' $search ORDER BY ap.$sort $order LIMIT $offset,$limit ";
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

	public function get_rolepermissions($limit=10,$offset=0,$sort = "group_id", $order = "DESC",$q="",$status = '')
	{
		$search = '';
		if(!empty($q)){
			$str = [',',"'",'>','<'];
			$q = str_replace($str,"",$q);
			$search .= " AND (ap.name LIKE '%$q%' or g.name like '%$q%')";
		}

		$total = $this->db->Query("SELECT count(agp.group_id) total from auth_groups_permissions agp JOIN auth_groups g ON agp.group_id = g.id JOIN auth_permissions ap ON agp.permission_id = ap.id WHERE agp.group_id >= 1 $search ")->getRow('total');
		if($total >= 1){
			$sql = "SELECT agp.*, g.name AS group_name,ap.name AS permission, ap.description  FROM auth_groups_permissions agp JOIN auth_groups g ON agp.group_id = g.id JOIN auth_permissions ap ON agp.permission_id = ap.id WHERE agp.group_id >= '1' $search ORDER BY agp.$sort $order LIMIT $offset,$limit ";
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

	public function create_permission($data){
		$cek = $this->db->table('auth_permissions')->where('name', $data['name'])->get()->getRow();
		if(empty($cek)){
			return $this->db->table('auth_permissions')->insert($data);
		}
		return false;
	}

	public function show_permission($id){
		$cek = $this->db->table('auth_permissions')->where('id', $id)->get()->getRow();
		return $cek;
	}

	public function update_permission($id,$data){
		$cek = $this->db->table('auth_permissions')->set($data)->where('id',$id)->update();
		return $cek;
	}

	public function create_rolepermission($data){
		$cek = $this->db->table('auth_groups_permissions')->where([
			'group_id' => $data['group_id'],
			'permission_id' => $data['permission_id']
		])->get()->getRow();
		if(empty($cek)){
			return $this->db->table('auth_groups_permissions')->insert($data);
		}
		return false;
	}

	function deleteRolePermission($data){
		return $this->db->table('auth_groups_permissions')->delete($data);
	}
}