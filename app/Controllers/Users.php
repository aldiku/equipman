<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use Myth\Auth\Entities\User;

class Users extends BaseController
{
    use ResponseTrait;

    public function __construct()	{
	    $this->users = new \App\Models\UsersModel();
	    $this->groupuser = new \App\Models\GroupUserModel();
        $this->validation =  \Config\Services::validation();
        $this->default_group = '4';
	}

    public function index(){
        $data = [
            'title' => "Users Management",
            'groups' =>  $this->groupuser->get_all_groups(),
        ];
        return view('users/v-users',$data);
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
        $out = $this->users->get_users($limit,$offset,$sort,$order,$search,$status);
        return $this->respond($out);
    }

    function create(){
        $entity = new User();
        $entity->setPassword($this->request->getPost('password'));
        $response = array();
		$fields['id'] = $this->request->getPost('id');
        $fields['email'] = $this->request->getPost('email');
        $fields['username'] = $this->request->getPost('username');
        $fields['name'] = $this->request->getPost('name');
        $fields['password_hash'] = $entity->password_hash;
        $fields['active'] = '0';
        $fields['created_at'] = date('Y-m-d H:i:s');
        $fields['updated_at'] = date('Y-m-d H:i:s');


        $this->validation->setRules([
			'email' => ['label' => 'Email', 'rules' => 'required|valid_email|min_length[0]|max_length[255]|is_unique[users.email,id,{id}]'],
            'username' => ['label' => 'Username', 'rules' => 'required|min_length[0]|max_length[30]|is_unique[users.username,id,{id}]'],
            'name' => ['label' => 'Name', 'rules' => 'required|min_length[0]|max_length[255]'],
            'password_hash' => ['label' => 'Password hash', 'rules' => 'permit_empty|min_length[0]|max_length[255]']
        ]);

        if ($this->validation->run($fields) == FALSE) {

            $response['status'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {
            $id = $this->users->insert($fields);
            if ($id) {
                $this->groupuser->insert([
                    'group_id' => $this->default_group,
                    'user_id' => $id
                ]);
                $response['status'] = true;
                $response['messages'] = lang("App.insert-success") ;	
				
            } else {
				
                $response['status'] = false;
                $response['messages'] = lang("App.insert-error") ;
				
            }
        }
        return $this->respond($response);
    }

    function show($id){
        $status = false;
        $data = [];
        if(in_groups(['1','2'])){
            $status = true;
            $data = $this->users->get_user($id);
        }
        return $this->respond(['status' => $status, 'data' => $data]);
    }

    function update($id){
        parse_str(file_get_contents("php://input"),$post_vars);
        $status = false;
        $message = '';
        $newPassword = $post_vars['password'];
        if(!empty($newPassword)){
            $entity = new User();
            $entity->setPassword($newPassword);
            $fields['password_hash'] = $entity->password_hash;
        }
        $response = array();
        $fields['name'] = $post_vars['name'];
        $fields['active'] = $post_vars['active'];
        $fields['updated_at'] = date('Y-m-d H:i:s');
        $newGroup = $post_vars['group'];
        if(!empty($newGroup)){
            $cek = $this->groupuser->where('user_id',$id)->findAll();
            if(empty($cek)){
                $this->groupuser->insert(['group_id' => $newGroup,'user_id' => $id]);
            }else{
                $this->groupuser->set(['group_id' => $newGroup])->where('user_id',$id)->update();
            }
        }

        $update = $this->users->update($id,$fields);
        if ($update) {
            $status = true;
            $message = lang("App.insert-success") ;	
            
        } else{
            $message = lang("App.insert-error") ;
        }
        return $this->respond(['status' => $status, 'message' => $message]);
    }

    function delete($id){
        $update = $this->users->update($id,['deleted_at' => date('Y-m-d H:i:s')]);
        return $this->respond(['status' => true]);
    }

}
