<?php namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;

class Dashboard extends BaseController
{
    use ResponseTrait;

    public function __construct()	{
	    $this->db = \Config\Database::connect();
        $this->report = new \App\Models\ReportModel();
	}

    public function index()
    {
        return view('admin/v-dashboard');
    }

    function section($id,$returntype = 'view'){
        $detail = $this->db->query("SELECT s.id,s.plant, s.kode, s.nama_section, a.area,s.id_equipment, e.nama AS equipment, s.description FROM data_section s JOIN data_area a ON s.id_area = a.id JOIN data_equipment e ON s.id_equipment = e.id where s.id = '$id'")->getRow();
        $x = 'd2';
        $where = '';
        $report = $this->report->get_data($id);
        if(!empty($report['Risk'])){
            $category = $report['Risk']['category'];
            $num = $report['Risk']['num'];
            $x= 'a';
            if($category == 'High'){
                $x = 'e';
            }
            if($category == 'Significant'){
                $x = 'd';
            }
            if($category == 'Medium'){
                $x = 'c';
            }
            if($category == 'Low'){
                $x = 'b';
            }
            $x2 = '1';
            if($num <= 25){
                $x2= '5';
            }
            if($num <= 20){
                $x2= '4';
            }
            if($num <= 15){
                $x2= '3';
            }
            if($num <= 10){
                $x2= '2';
            }
            if($num <= 5){
                $x2= '1';
            }
            $x.=$x2;
        }
        if($detail->id_equipment == '2'){ //pipeline
            if($detail->plant == '1'){ //darat /onshore
                if($detail->nama_section == 'Main'){
                    $where .= "WHERE id in (1,2,3,4,5,6)";
                }else{
                    $where .= "WHERE id in (1,2,3,4,5,6)";
                }
            }else{
                if($detail->nama_section == 'Main'){
                    $where .= "WHERE id in (1,2,3,4,7,8)";
                }else{
                    $where .= "WHERE id in (1,2,3,4,7,8)";
                }
            }
        }
        $tab_all = $this->db->query("SELECT * FROM data_tab $where")->getResultArray();
        $tab = [];
        
        foreach($tab_all as $t){
            
            $tab[] = [
                'id' => $t['id'],
                'tab' => $t['tab'],
                'field' => $this->get_field($t['tab'],$id),
            ];            
        }
        $data = [
            'detail' => $detail,
            'tab' => $tab,
            'report' => $report,
            'x' => $x,
        ];
        if($returntype == 'json'){
            return $this->respond($data);
        }
        return view('admin/seksi',$data);
    }

    public function get_field($tab,$section){
        $data = [];
        $field = $this->db->query("SELECT * FROM data_field f WHERE LOWER(f.tab) = '".strtolower($tab)."'")->getResultArray();
        if(!empty($field)){
            foreach($field as $f){
                $option = [];
                if($f['type'] == 'text_lookup'){
                    $option = $this->db->query("SELECT * FROM tbl_look_up l WHERE l.field = '".$f['look_up']."'")->getResultArray();
                }
                $id = 0;
                $val = '';
                $get_val = $this->db->query("SELECT `id`,`value` from data_value where section_id = '$section' AND field_id = '".$f['id']."'")->getRow();
                if(!empty($get_val)){
                    $id = $get_val->id;
                    $val = $get_val->value;
                }
                $data[$f['tab_group']][] = [
                    'id' => $f['id'],
                    'tab' => $f['tab'],
                    'label' => $f['label'],
                    'satuan' => $f['satuan'],
                    'type' => $f['type'],
                    'look_up' => $f['look_up'],
                    'inCoding' => $f['inCoding'],
                    'value' => [
                        'id' => $id,
                        'val' => $val,
                    ],
                    'option' => $option,
                ];
            }
        }
        return $data;
    }

    

    function save_val(){
        $data = $this->request->getPost();
        $mode = "save";
        $list = [];
        foreach($data as $k => $v){
            if($k != 'section_id'){
                $item = [
                    'section_id' => $data['section_id'],
                    'field_id' => $k
                ];
                $cek = $this->db->table('data_value')->where($item)->get()->getRow();
                if(!empty($cek)){
                    $mode = 'update';
                    $item['value'] = $v;
                    $item['updated_at'] = date('Y-m-d H:i:s');
                    $save = $this->db->table('data_value')->where('id',$cek->id)->update($item);
                }else{
                    $item['value'] = $v;
                    $item['created_at'] = date('Y-m-d H:i:s');
                    $item['updated_at'] = date('Y-m-d H:i:s');
                    $save = $this->db->table('data_value')->insert($item);
                }
            }
            $list[] = [
                'section_id' => $data['section_id'],
                'field_id' => $k,
                'value' => $v,
                'mode' => $mode
            ];
        }
        return $this->respond(['status' => true, 'mode' => $mode, 'list' => $list]);
    }

}
