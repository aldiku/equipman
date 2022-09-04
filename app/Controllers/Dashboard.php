<?php namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;

class Dashboard extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        return view('admin/dashbord');
    }

    public function tree(){
        $db = \Config\Database::connect();
        $data = $db->query("SELECT s.id,s.lokasi, s.kode, s.nama_section, a.area, e.nama AS equipment FROM data_section s JOIN data_area a ON s.id_area = a.id JOIN data_equipment e ON s.id_equipment = e.id")->getResultArray();
        $result = [];
        foreach ($data as $row){
            $result[$row['lokasi']][$row['area']][$row['equipment']][$row['kode']][] = $row;
        }        
        return $this->respond($result);
    }

    public function get_data($id){
        $db = \Config\Database::connect();
        $detail = $db->query("SELECT s.id,s.lokasi, s.kode, s.nama_section, a.area,s.id_equipment, e.nama AS equipment FROM data_section s JOIN data_area a ON s.id_area = a.id JOIN data_equipment e ON s.id_equipment = e.id where s.id = '$id'")->getRow();
        $where = '';
        if($detail->id_equipment == '2'){ //pipeline
            if($detail->lokasi == 'd'){ //darat /onshore
                if($detail->nama_section == 'Main'){
                    $where .= "WHERE id in (1,2,3,4,7,8,9)";
                }else{
                    $where .= "WHERE id in (1,2,3,4,7,8,10)";
                }
            }else{
                if($detail->nama_section == 'Main'){
                    $where .= "WHERE id in (1,2,3,4,5,6,11)";
                }else{
                    $where .= "WHERE id in (1,2,3,4,5,6,12)";
                }
            }
        }
        $tab_all = $db->query("SELECT * FROM data_tab $where")->getResultArray();
        $tab = [];
        foreach($tab_all as $t){
            $look_up_all = $db->query("SELECT * FROM tbl_look_up t WHERE t.category = '".$t['tab']."'")->getResultArray();
            $look_up = [];
            foreach ($look_up_all as $row){
                $look_up[$row['field']][] = $row;
            } 
            $tab[] = [
                'id' => $t['id'],
                'tab' => $t['tab'],
                'look_up' => $look_up
            ];
        }
        $data = [
            'tab' => $tab,
            'detail' => $detail
        ];
        // return $this->respond($data);
        return view('admin/seksi',$data);
    }

    public function get_data_json($id){
        $db = \Config\Database::connect();
        $data = $db->query("SELECT s.id,s.lokasi, s.kode, s.nama_section, a.area, e.nama AS equipment FROM data_section s JOIN data_area a ON s.id_area = a.id JOIN data_equipment e ON s.id_equipment = e.id where s.id = '$id'")->getRowArray();
        return $this->respond($data);
    }
}
