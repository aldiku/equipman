<?php namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Equipment extends BaseController
{
    use ResponseTrait;

    public function __construct()	{
	    $this->equipment = new \App\Models\EquipmentModel();
        $this->validation =  \Config\Services::validation();
	}

    function index(){
        $data = [
            'title' => "Section Management",
            'area' => $this->equipment->get_all_area(),
            'equipment' => $this->equipment->get_all_equipment(),
        ];
        return view('admin/v-equipment',$data);
    }

    function get_all_section(){
        $limit = empty($this->request->getGet('limit')) ? '10' : $this->request->getGet('limit') ;
        $offset = empty($this->request->getGet('offset')) ? '0' : $this->request->getGet('offset') ;
        $page = $this->request->getGet('page');
        if(!empty($page)){
            $offset = ($page-1)*$limit;
        }
		$search	= $this->request->getGet('search');
        $sort = empty($this->request->getGet('sort')) ? 'id' : $this->request->getGet('sort') ;
		$order = empty($this->request->getGet('order')) ? 'DESC' : $this->request->getGet('order') ;
		$plant = empty($this->request->getGet('plant')) ? 'all' : $this->request->getGet('plant') ;
		$area = empty($this->request->getGet('area')) ? 'all' : $this->request->getGet('area') ;
		$equipment = empty($this->request->getGet('equipment')) ? 'all' : $this->request->getGet('equipment') ;
        $out = $this->equipment->get_all_section($limit,$offset,$sort,$order,$search,$plant,$area,$equipment);
        return $this->respond($out);
    }

    function create_section(){
        $response = array();
        $fields['kode'] = $this->request->getPost('kode');
        $fields['nama_section'] = $this->request->getPost('nama_section');
        $fields['plant'] = $this->request->getPost('plant');
        $fields['id_area'] = $this->request->getPost('id_area');
        $fields['parent'] = $this->request->getPost('parent');
        $fields['id_equipment'] = $this->request->getPost('id_equipment');
        $fields['description'] = $this->request->getPost('description');
        $fields['created_at'] = date('Y-m-d H:i:s');
        $fields['updated_at'] = date('Y-m-d H:i:s');

        $response['status'] = false;
        $this->validation->setRules([
			'kode' => ['label' => 'Kode', 'rules' => 'required|min_length[0]|max_length[255]'],
			'nama_section' => ['label' => 'Nama Section', 'rules' => 'required|min_length[0]|max_length[255]'],
			'plant' => ['label' => 'plant', 'rules' => 'required'],
			'id_area' => ['label' => 'Area', 'rules' => 'required'],
			'id_equipment' => ['label' => 'Equipment', 'rules' => 'required'],
        ]);
        if ($this->validation->run($fields) == FALSE) {
			$response['message'] = $this->validation->getErrors();//Show Error in Input Form
        } else {
            if($fields['parent'] != '0' &&  $fields['nama_section'] == 'Main'){
                $response['message'] = "Section ini tidak boleh Main" ;
            }else{
                $cek_exist = $this->db->where([
                    'plant' => $fields['plant'],
                    'nama_section' => $fields['nama_section'],
                    'id_area' => $fields['id_area'],
                    'id_equipment' => $fields['id_equipment'],
                    'kode' => $fields['kode'],
                ])->get()->getRow();
                if(empty($cek_exist)){
                    $id = $this->equipment->insert($fields);
                    if ($id) {
                        $this->equipment->clone_data_value($fields['parent'],$id);
                        $response['status'] = true;
                        $response['message'] = lang("App.insert-success") ;	
                    } else {
                        $response['message'] = lang("App.insert-error") ;
                    }
                }else{
                    $response['message'] = "Maaf, Data equipment sudah pernah di daftarkan." ;
                }
            }
        }
        return $this->respond($response);
    }

    function show_section($id){
        $status = false;
        $data = [];
        if(in_groups(['1','2'])){
            $status = true;
            $data = $this->equipment->get_detail($id);
        }
        return $this->respond(['status' => $status, 'data' => $data]);
    }

    function update_section($id){
        parse_str(file_get_contents("php://input"),$post_vars);
        $status = false;
        $message = '';
        $response = array();
        $fields['kode'] = $post_vars['kode'];
        $fields['nama_section'] = $post_vars['nama_section'];
        $fields['kode'] = $post_vars['kode'];
        $fields['nama_section'] = $post_vars['nama_section'];
        $fields['plant'] = $post_vars['plant'];
        $fields['id_area'] = $post_vars['id_area'];
        $fields['id_equipment'] = $post_vars['id_equipment'];
        $fields['description'] = $post_vars['description'];
        $fields['updated_at'] = date('Y-m-d H:i:s');
       
        $update = $this->equipment->update($id,$fields);
        if ($update) {
            $status = true;
            $message = lang("App.insert-success") ;	
            
        } else{
            $message = lang("App.insert-error") ;
        }
        return $this->respond(['status' => $status, 'message' => $message]);
    }

    function delete_section($id){
        $update = $this->equipment->update($id,['deleted_at' => date('Y-m-d H:i:s')]);
        return $this->respond(['status' => true]);
    }

    //area
    function create_area(){
        $response = array();
        $fields['area'] = $this->request->getPost('area');
        $this->validation->setRules([
			'area' => ['label' => 'area', 'rules' => 'required|min_length[0]|max_length[255]'],
        ]);
        if ($this->validation->run($fields) == FALSE) {
            $response['status'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {
            $id = $this->db->table('data_area')->insert($fields);
            if ($id) {
                $response['status'] = true;
                $response['messages'] = lang("App.insert-success") ;	
            } else {
                $response['status'] = false;
                $response['messages'] = lang("App.insert-error") ;
            }
        }
        return $this->respond($response);
    }

    function show_area($id){
        $status = false;
        $data = [];
        if(in_groups(['1','2'])){
            $status = true;
            $data = $this->db->table('data_area')->where('id',$id)->get()->getRow();
        }
        return $this->respond(['status' => $status, 'data' => $data]);
    }

    function update_area($id){
        parse_str(file_get_contents("php://input"),$post_vars);
        $status = false;
        $message = '';
        $response = array();
        $fields['area'] = $post_vars['area'];
        
        $update = $this->db->table('data_area')->where('id',$id)->update($fields);
        if ($update) {
            $status = true;
            $message = lang("App.insert-success") ;	
            
        } else{
            $message = lang("App.insert-error") ;
        }
        return $this->respond(['status' => $status, 'message' => $message]);
    }

    function delete_area($id){
        if(in_groups(['1','2'])){
            $update = $this->db->table('data_area')->where('id',$id)->delete();
            return $this->respond(['status' => true]);
        }
        return $this->respond(['status' => false]);
    }

    //equip
    function create_equipment(){
        $response = array();
        $fields['nama'] = $this->request->getPost('nama');
        $this->validation->setRules([
			'nama' => ['label' => 'Nama', 'rules' => 'required|min_length[0]|max_length[255]'],
        ]);
        if ($this->validation->run($fields) == FALSE) {
            $response['status'] = false;
			$response['messages'] = $this->validation->getErrors();//Show Error in Input Form
			
        } else {
            $id = $this->db->table('data_equipment')->insert($fields);
            if ($id) {
                $response['status'] = true;
                $response['messages'] = lang("App.insert-success") ;	
            } else {
                $response['status'] = false;
                $response['messages'] = lang("App.insert-error") ;
            }
        }
        return $this->respond($response);
    }

    function show_equipment($id){
        $status = false;
        $data = [];
        if(in_groups(['1','2'])){
            $status = true;
            $data = $this->db->table('data_equipment')->where('id',$id)->get()->getRow();
        }
        return $this->respond(['status' => $status, 'data' => $data]);
    }

    function update_equipment($id){
        parse_str(file_get_contents("php://input"),$post_vars);
        $status = false;
        $message = '';
        $response = array();
        $fields['nama'] = $post_vars['nama'];
        
        $update = $this->db->table('data_equipment')->where('id',$id)->update($fields);
        if ($update) {
            $status = true;
            $message = lang("App.insert-success") ;	
            
        } else{
            $message = lang("App.insert-error") ;
        }
        return $this->respond(['status' => $status, 'message' => $message]);
    }

    function delete_equipment($id){
        if(in_groups(['1','2'])){
            $update = $this->db->table('data_equipment')->where('id',$id)->delete();
            return $this->respond(['status' => true]);
        }
        return $this->respond(['status' => false]);
    }
}
