<?php
namespace App\Models;
use CodeIgniter\Model;

class UsersModel extends Model {
    
	protected $table = 'users';
	protected $primaryKey = 'id';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['email', 'username', 'name', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash', 'status', 'status_message', 'active', 'force_pass_reset', 'created_at', 'updated_at', 'deleted_at'];
	protected $useTimestamps = false;
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

	public function get_users($limit=10,$offset=0,$sort = "id", $order = "DESC",$q="",$status = '')
	{
		$search = '';
		if(!empty($q)){
			$str = [',',"'",'>','<'];
			$q = str_replace($str,"",$q);
			$search .= " AND u.name LIKE '%$q%' ";
		}
		if(!empty($status)){
			$status .= " AND u.active = '$status' ";
		}

		$total = $this->db->Query("SELECT count(u.id) total from users u WHERE u.deleted_at IS NULL $search ")->getRow('total');
		if($total >= 1){
			$sql = "SELECT u.id, u.name, u.username,u.email,u.active, a.group_id, g.name as groupname,  u.created_at, u.updated_at from users u LEFT JOIN auth_groups_users a on a.user_id = u.id LEFT JOIN auth_groups  g ON a.group_id = g.id WHERE u.deleted_at IS NULL $search ORDER BY u.$sort $order LIMIT $offset,$limit ";
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

	public function get_user($id)
	{
		$sql = "SELECT u.id, u.name, u.username,u.email,u.active, a.group_id, g.name as groupname,  u.created_at, u.updated_at from users u LEFT JOIN auth_groups_users a on a.user_id = u.id LEFT JOIN auth_groups  g ON a.group_id = g.id WHERE u.id = $id";
		$data = $this->db->Query($sql)->getRow();
		return $data;

	}
}