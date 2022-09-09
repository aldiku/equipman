<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use Myth\Auth\Entities\User;

class Roles extends BaseController
{
    use ResponseTrait;

    public function __construct()	{
	    $this->groupuser = new \App\Models\GroupUserModel();
        $this->validation =  \Config\Services::validation();
	}

    public function index(){
        $data = [
            'title' => "Roles & Permission Management",
            'groups' =>  $this->groupuser->get_all_groups('all'),
        ];
        return view('users/v-roles',$data);
    }

    function get_all(){
        $limit = empty($this->request->getGet('limit')) ? '10' : $this->request->getGet('limit') ;
        $offset = empty($this->request->getGet('offset')) ? '0' : $this->request->getGet('offset') ;
        $page = $this->request->getGet('page');
        if(!empty($page)){
            $offset = ($page-1)*$limit;
        }
		$search	= $this->request->getGet('search');
        $sort = empty($this->request->getGet('sort')) ? 'id' : $this->request->getGet('sort') ;
		$order = empty($this->request->getGet('order')) ? 'DESC' : $this->request->getGet('order') ;
		$status = empty($this->request->getGet('status')) ? '' : $this->request->getGet('status') ;
        $out = $this->groupuser->get_roles($limit,$offset,$sort,$order,$search,$status);
        return $this->respond($out);
    }

    function get_all_permissions(){
        $limit = empty($this->request->getGet('limit')) ? '10' : $this->request->getGet('limit') ;
        $offset = empty($this->request->getGet('offset')) ? '0' : $this->request->getGet('offset') ;
        $page = $this->request->getGet('page');
        if(!empty($page)){
            $offset = ($page-1)*$limit;
        }
        $search	= $this->request->getGet('search');
		$sort = empty($this->request->getGet('sort')) ? 'id' : $this->request->getGet('sort') ;
		$order = empty($this->request->getGet('order')) ? 'DESC' : $this->request->getGet('order') ;
		$status = empty($this->request->getGet('status')) ? '' : $this->request->getGet('status') ;
        $out = $this->groupuser->get_permissions($limit,$offset,$sort,$order,$search,$status);
        return $this->respond($out);
    }

    function get_all_rolepermissions(){
        $limit = empty($this->request->getGet('limit')) ? '10' : $this->request->getGet('limit') ;
        $offset = empty($this->request->getGet('offset')) ? '0' : $this->request->getGet('offset') ;
        $page = $this->request->getGet('page');
        if(!empty($page)){
            $offset = ($page-1)*$limit;
        }
        $search	= $this->request->getGet('search');
		$sort = empty($this->request->getGet('sort')) ? 'group_id' : $this->request->getGet('sort') ;
		$order = empty($this->request->getGet('order')) ? 'DESC' : $this->request->getGet('order') ;
		$status = empty($this->request->getGet('status')) ? '' : $this->request->getGet('status') ;
        $out = $this->groupuser->get_rolepermissions($limit,$offset,$sort,$order,$search,$status);
        return $this->respond($out);
    }

    function create(){
        $response['status'] = false;
        $response['messages'] = lang("App.insert-error") ;
        
        $fields['name'] = $this->request->getPost('name');
        $fields['description'] = $this->request->getPost('description');

        $id = $this->groupuser->create_group($fields);
        if ($id) {
            $response['status'] = true;
            $response['messages'] = lang("App.insert-success") ;	
        }
        return $this->respond($response);
    }

    function show($id){
        $status = false;
        $data = [];
        if(in_groups(['1','2'])){
            $status = true;
            $data = $this->groupuser->show_group($id);
        }
        return $this->respond(['status' => $status, 'data' => $data]);
    }

    function update($id){
        parse_str(file_get_contents("php://input"),$post_vars);
        $status = false;
        $message = '';
        $response = array();
        $fields['description'] = $post_vars['description'];

        $update = $this->groupuser->update_group($id,$fields);
        if ($update) {
            $status = true;
            $message = lang("App.insert-success") ;	
            
        } else{
            $message = lang("App.insert-error") ;
        }
        return $this->respond(['status' => $status, 'message' => $message]);
    }

    function createpermission(){
        $response['status'] = false;
        $response['messages'] = lang("App.insert-error") ;
        
        $fields['name'] = $this->request->getPost('name');
        $fields['description'] = $this->request->getPost('description');

        $id = $this->groupuser->create_permission($fields);
        if ($id) {
            $response['status'] = true;
            $response['messages'] = lang("App.insert-success") ;	
        }
        return $this->respond($response);
    }

    function showpermission($id){
        $status = false;
        $data = [];
        if(in_groups(['1','2'])){
            $status = true;
            $data = $this->groupuser->show_permission($id);
        }
        return $this->respond(['status' => $status, 'data' => $data]);
    }

    function updatepermission($id){
        parse_str(file_get_contents("php://input"),$post_vars);
        $status = false;
        $message = '';
        $response = array();
        $fields['description'] = $post_vars['description'];

        $update = $this->groupuser->update_permission($id,$fields);
        if ($update) {
            $status = true;
            $message = lang("App.insert-success") ;	
            
        } else{
            $message = lang("App.insert-error") ;
        }
        return $this->respond(['status' => $status, 'message' => $message]);
    }

    function createrolepermission(){
        $response['status'] = false;
        $response['messages'] = lang("App.insert-error") ;
        
        $fields['permission_id'] = $this->request->getPost('permission_id');
        $fields['group_id'] = $this->request->getPost('group_id');

        $id = $this->groupuser->create_rolepermission($fields);
        if ($id) {
            $response['status'] = true;
            $response['messages'] = lang("App.insert-success") ;	
        }
        return $this->respond($response);
    }

    function deleteRolePermission($group_id,$permission_id){
        $this->groupuser->deleteRolePermission(['group_id' => $group_id, 'permission_id'=> $permission_id]);
        return $this->respond(['status' => true]);
    }

}
