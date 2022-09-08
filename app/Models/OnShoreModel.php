<?php namespace App\Models;
use CodeIgniter\Model;

class OnShoreModel extends Model {  

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
        $this->section = '';
    }

    function get_data($section){
        $this->section = $section;
        $L1_POF_age = $this->get_valuefromDB('AgerFactor', "Age");    
        $L1_POF_Coating_Condition = $this->get_valuefromDB('CoatingCondition', "Coating_Condition");    
        $L1_POF_External_Demage = $this->get_valuefromDB('ExternalDemage', "External_Demage");
        $L1_POF_External_Inspection = $this->get_valuefromDB('externalfactor', "External_Inspection");
        $L1_POF_CP_Reading = $this->get_valuefromDB('CPReading', "CP_Reading");
        $L1_POF_CP_Survey = $this->get_valuefromDB('CPSurvey', "CP_Survey");
        $L1_POF_Cathodic_Interference = $this->get_valuefromDB('CathodicInterference', "Cathodic_Interference");
                
        $L1_POF_Internal_Inspection = $this->get_valuefromDB('InternalInspectionfactor', "Internal_Inspection");
        $L1_POF_Local_Corrosion = $this->get_valuefromDB('LocalCorrosion', "Local_Corrosion");
        $L1_POF_water = $this->get_valuefromDB('WaterPof', "Water");
                
        $L1_POF_Leak_History = $this->get_valuefromDB('LeakHistory', "Leak_History");
                
        $L1_POF_Design = $this->get_valuefromDB('Design', "Design");
        $L1_POF_Overpressure = $this->get_valuefromDB('Overpressure', "Overpressure");
        $L1_POF_Pressure_Cycling = $this->get_valuefromDB('PressureCycling', "Pressure_Cycling");
        $L1_POF_Temperature_Cycling = $this->get_valuefromDB('TemperatureCycling', "Temperature_Cycling");
        $L1_POF_Operational_Pigging = $this->get_valuefromDB('PiggingOps', "Operational_Pigging");
                
        $L1_POF_Sabotage = $this->get_valuefromDB('sabotagefactor', "Sabotage");
        $L1_POF_Row_Condition = $this->get_valuefromDB('rowCondition', "Row_Condition");
        $L1_POF_Pipeline_cover = $this->get_valuefromDB('Onshorepipelinecoverfactor', "Pipeline_cover");
        $L1_POF_Land_Stability = $this->get_valuefromDB('LandStability', "Land_Stability");
                
        $L1_COF_Location_factor = $this->get_valuefromDB('LocationFactor', "Location_factor");
        $L1_COF_Release_Quantity = $this->get_valuefromDB('ReleaseQuantity', "Release_Quantity");
        $L1_COF_Fluid_Type = $this->get_valuefromDB('FluidType', "Fluid_Type");
        $L1_COF_Financial_factor = $this->get_valuefromDB('financialFactor', "Financial");
        $L1_COF_reputationF = $this->get_valuefromDB('ReputationRatting', "Reputation");
        $L1_COF_Population_Density = $this->get_valuefromDB('PopulationDensity', "Population_Density");
        $L1_COF_Flammability_Toxic = $this->get_valuefromDB('FlammabilityToxic', "Flammability_Toxic");
        $L1_COF_Leak_Size = $this->get_valuefromDB('LeakSize', "Leak_Size");   
       

        $L1_POF_Atmospheric_Corrosion = ($L1_POF_age + $L1_POF_Coating_Condition + $L1_POF_External_Demage + $L1_POF_External_Inspection) / 4 ;
        $L1_POF_External_Corrosion = ($L1_POF_age + $L1_POF_CP_Reading + $L1_POF_CP_Survey + $L1_POF_Cathodic_Interference) / 4 ;
        $L1_POF_Internal_Corrosion = ($L1_POF_age + $L1_POF_Internal_Inspection + $L1_POF_Local_Corrosion + $L1_POF_water) / 4 ;
        $L1_POF_Corrosion = round($this->worksheetFunctionMax($L1_POF_Atmospheric_Corrosion, $L1_POF_External_Corrosion, $L1_POF_Internal_Corrosion), 0);
        $L1_POF_Defect_History = $L1_POF_Leak_History;
                
        $L1_POF_Operation = ($L1_POF_Design + $L1_POF_Overpressure + $L1_POF_Pressure_Cycling + $L1_POF_Temperature_Cycling + $L1_POF_Operational_Pigging) / 5;
        $L1_POF_third_party_demage = $L1_COF_Location_factor;
        $L1_POF_third_party = ($L1_POF_External_Inspection + $L1_POF_Pipeline_cover + $L1_POF_Land_Stability + $L1_POF_Row_Condition + $L1_POF_Sabotage + $L1_POF_third_party_demage) / 6;

        $L1_POF_Factor = round($this->worksheetFunctionMax($L1_POF_Operation, $L1_POF_Corrosion, $L1_POF_Defect_History, $L1_POF_third_party), 0) *3;

        $L1_COF_enviroment = ($L1_COF_Location_factor + $L1_COF_Release_Quantity + $L1_COF_Fluid_Type) / 3;
        $L1_COF_financial = $L1_COF_Financial_factor;
        $L1_COF_reputation = $L1_COF_reputationF;
        $L1_COF_Population_Density = $L1_COF_Population_Density;
        $L1_COF_safety = ($L1_COF_Flammability_Toxic + $L1_COF_Leak_Size + $L1_COF_Population_Density) / 3;

        $L1_COF_Factor = round($this->worksheetFunctionMax($L1_COF_enviroment, $L1_COF_financial, $L1_COF_reputation, $L1_COF_safety), 0) *3;
        $L1_POF_Category = $this->RBI_1_numofCategory($L1_POF_Factor) *0.5;
        $L1_COF_Category = $this->RBI_1_numofCategory($L1_COF_Factor);
        $L1_COF_Risk = $this->RBI_1_Risk($L1_POF_Category, $L1_COF_Category);
        
        //Inspection
        $L1_Inspection_Internal_value = $this->INPECTION_1_get_schedule($L1_POF_Factor, $L1_COF_Factor, "Internal", 'InternalInspectionHistorical', 'Piggable');
        $ScheduleInYearForInternal = $this->INPECTION_1_get_inspectionScheduleForIP($L1_POF_Factor, $L1_COF_Factor);
        $InternalInspectionNum = $this->get_valuefromDB('InternalInspectionHistorical', "Internal_Inspection_history");
        $NextInspectioDateForInternal = $this->INPECTION_1_get_nextInspectionDate($L1_Inspection_Internal_value, $LastInspectionDateforinternal);

        $L1_Inspection_External_value = $this->INPECTION_1_get_schedule($L1_POF_Factor, $L1_COF_Factor, "External", $ExternalInspectionHistorical, $PipelineType);
        $ScheduleInYearForInternal = $this->INPECTION_1_get_inspectionScheduleForIP($L1_POF_Factor, $L1_COF_Factor);
        $InternalInspectionNumForExternal = get_valuefromDB($ExternalInspectionHistorical, "External_Inspection_history");
        $NextInspectioDateForExternal = $this->INPECTION_1_get_nextInspectionDate($InternalInspectionNumForExternal, $LastInspectionDateforexternal);

        return [
            'L1_Inspection_Internal_value' =>  $L1_Inspection_Internal_value,
            'ScheduleInYearForInternal' =>  $ScheduleInYearForInternal,
            'InternalInspectionNum' =>  $InternalInspectionNum,
            'NextInspectioDateForInternal' =>  $NextInspectioDateForInternal,
    
            'L1_Inspection_External_value' =>  $L1_Inspection_External_value,
            'ScheduleInYearForInternal' =>  $ScheduleInYearForInternal,
            'InternalInspectionNumForExternal' =>  $InternalInspectionNumForExternal,
            'NextInspectioDateForExternal' =>  $NextInspectioDateForExternal
        ];
    }

    function worksheetFunctionMax(...$arr){
        $num = 0;
        foreach($arr as $a){
            if($num >= $a){
                $num = $a;
            }
        }
        return $num;
    }
    function get_valuefromDB($name,$as){
        $data = $this->db->table('data_value')
        ->join('data_field','data_field.id = data_value.field_id')
        ->join('data_section','data_section.id = data_value.section_id')
        ->where([
            'data_field.inCoding' => $name,
            'data_value.section_id' => $this->section,
            ])
        ->select('data_value.value')->get()->getRow('value');
        return empty($data) ? null : $data;
    }

    function RBI_1_numofCategory($pofOrcof_Factor){
        return abs(($pofOrcof_Factor / 5) - 0.1);
    } 

    function RBI_1_Risk($likelihood_Category, $consequence_Category){
        $category = "Medium";
        $num = "5";
        if($consequence_Category == 0.1 && $likelihood_Category == 0.9) {
            $category = "Medium";
            $num = "5";
        }elseif($consequence_Category == 0.1 && $likelihood_Category == 0.7) {
            $category = "Low";
            $num = "6";
        }elseif($consequence_Category == 0.1 && $likelihood_Category == 0.5) {
            $category = "Low";
            $num = "3";
        }elseif($consequence_Category == 0.1 && $likelihood_Category == 0.3) {
            $category = "Low";
            $num = "2";
        }elseif($consequence_Category == 0.1 && $likelihood_Category == 0.1) {
            $category = "Low";
            $num = "1";
        }elseif($consequence_Category == 0.3 && $likelihood_Category == 0.9) {
            $category = "Significant";
            $num = "10";
        }elseif($consequence_Category == 0.3 && $likelihood_Category == 0.7) {
            $category = "Medium";
            $num = "8";
        }elseif($consequence_Category == 0.3 && $likelihood_Category == 0.5) {
            $category = "Medium";
            $num = "6";
        }elseif($consequence_Category == 0.3 && $likelihood_Category == 0.3) {
            $category = "Low";
            $num = "4";
        }elseif($consequence_Category == 0.3 && $likelihood_Category == 0.1) {
            $category = "Low";
            $num = "2";
        }elseif($consequence_Category == 0.5 && $likelihood_Category == 0.9) {
            $category = "Significant";
            $num = "15";
        }elseif($consequence_Category == 0.5 && $likelihood_Category == 0.7) {
            $category = "Significant";
            $num = "12";
        }elseif($consequence_Category == 0.5 && $likelihood_Category == 0.5) {
            $category = "Medium";
            $num = "9";
        }elseif($consequence_Category == 0.5 && $likelihood_Category == 0.3) {
            $category = "Medium";
            $num = "6";
        }elseif($consequence_Category == 0.5 && $likelihood_Category == 0.1) {
            $category = "Low";
            $num = "3";
        }elseif($consequence_Category == 0.7 && $likelihood_Category == 0.9) {
            $category = "High";
            $num = "20";
        }elseif($consequence_Category == 0.7 && $likelihood_Category == 0.7) {
            $category = "Significant";
            $num = "16";
        }elseif($consequence_Category == 0.7 && $likelihood_Category == 0.5) {
            $category = "Significant";
            $num = "12";
        }elseif($consequence_Category == 0.7 && $likelihood_Category == 0.3) {
            $category = "Medium";
            $num = "8";
        }elseif($consequence_Category == 0.7 && $likelihood_Category == 0.1) {
            $category = "Low";
            $num = "4";
        }elseif($consequence_Category == 0.9 && $likelihood_Category == 0.9) {
            $category = "High";
            $num = "25";
        }elseif($consequence_Category == 0.9 && $likelihood_Category == 0.7) {
            $category = "High";
            $num = "20";
        }elseif($consequence_Category == 0.9 && $likelihood_Category == 0.5) {
            $category = "Significant";
            $num = "15";
        }elseif($consequence_Category == 0.9 && $likelihood_Category == 0.3) {
            $category = "Significant";
            $num = "10";
        }elseif($consequence_Category == 0.9 && $likelihood_Category == 0.1) {
            $category = "Medium";
            $num = "5";
        }

        return [
            'category' => $category,
            'num' => $num
        ];
 
    }

    function INPECTION_1_get_schedule($pof , $cof, $method, $inspectionHistory, $param){
        if ($method == "External") {
            $temp = $this->get_valuefromDB($param, "Pipeline_Type");
            $inspectionNum = $this->get_valuefromDB($inspectionHistory, "External_Inspection_history");
            if ($temp = 1) { 
                //trunkline
                $scheduleInspection = $this->INPECTION_1_get_inspectionScheduleForTrunkline($pof, $cof);
                $result = round($scheduleInspection * $inspectionNum, 2);
            }elseif ($temp = 3) { 
                //flowline
                $scheduleInspection = $this->INPECTION_1_get_inspectionScheduleForFlowline($pof, $cof);
                $result = Round($scheduleInspection * $inspectionNum, 2);
            }
        }elseif ($method == "Internal") {
            $inspectionNum = $this->get_valuefromDB($inspectionHistory, "Internal_Inspection_history");
            $scheduleInspection = $this->INPECTION_1_get_inspectionScheduleForIP($pof, $cof);
            if ($param == "Yes") {
                $result = Round($scheduleInspection * inspectionNum, 2);
            }else{
                $result = 0;
            }
            if (temp == 2) {
                $result = 0;
            }
        }
        return $result;
    }

    function INPECTION_1_get_inspectionScheduleForIP($likelihood_Category ,$consequence_Category){
        if($consequence_Category == 1 && $likelihood_Category == 5) {
            $result =  7;
        }elseif($consequence_Category == 1 && $likelihood_Category == 4) {
            $result =  8;
        }elseif($consequence_Category == 1 && $likelihood_Category == 3) {
            $result =  9;
        }elseif($consequence_Category == 1 && $likelihood_Category == 2) {
             $result =  9;
        }elseif($consequence_Category == 1 && $likelihood_Category == 1) {
            $result =  10;
        }elseif($consequence_Category == 2 && $likelihood_Category == 5) {
             $result =  4;
        }elseif($consequence_Category == 2 && $likelihood_Category == 4) {
            $result =  6;
        }elseif($consequence_Category == 2 && $likelihood_Category == 3) {
            $result =  7;
        }elseif($consequence_Category == 2 && $likelihood_Category == 2) {
           $result =  8;
        }elseif($consequence_Category == 2 && $likelihood_Category == 1) {
           $result =  9;
           
           
        }elseif($consequence_Category == 3 && $likelihood_Category == 5) {
            $result =  2;
        }elseif($consequence_Category == 3 && $likelihood_Category == 4) {
            $result =  3;
        }elseif($consequence_Category == 3 && $likelihood_Category == 3) {
            $result =  5;
        }elseif($consequence_Category == 3 && $likelihood_Category == 2) {
            $result =  7;
        }elseif($consequence_Category == 3 && $likelihood_Category == 1) {
           $result =  9;
           
        }elseif($consequence_Category == 4 && $likelihood_Category == 5) {
           $result =  1;
           }elseif($consequence_Category == 4 && $likelihood_Category == 4) {
           $result =  2;
        }elseif($consequence_Category == 4 && $likelihood_Category == 3) {
           $result =  3;
        }elseif($consequence_Category == 4 && $likelihood_Category == 2) {
          $result =  6;
        }elseif($consequence_Category == 4 && $likelihood_Category == 1) {
           $result =  8;
           
        }elseif($consequence_Category == 5 && $likelihood_Category == 5) {
            $result =  1;
        }elseif($consequence_Category == 5 && $likelihood_Category == 4) {
            $result =  1;
        }elseif($consequence_Category == 5 && $likelihood_Category == 3) {
           $result =  2;
        }elseif($consequence_Category == 5 && $likelihood_Category == 2) {
            $result =  4;
        }elseif($consequence_Category == 5 && $likelihood_Category == 1) {
            $result =  7;
        }
        return $result;
    }
    
    function INPECTION_1_get_inspectionScheduleForTrunkline($likelihood_Category ,$consequence_Category){
        //matrik ini sesuai dengan kesepakatan owner dalam tahun
        if($consequence_Category == 1 && $likelihood_Category == 5) {
            $result =  6;
        }elseif($consequence_Category == 1 && $likelihood_Category == 4) {
            $result =  6.5;
        }elseif($consequence_Category == 1 && $likelihood_Category == 3) {
            $result =  7;
        }elseif($consequence_Category == 1 && $likelihood_Category == 2) {
             $result =  7.5;
        }elseif($consequence_Category == 1 && $likelihood_Category == 1) {
            $result =  8;
        }elseif($consequence_Category == 2 && $likelihood_Category == 5) {
             $result =  4;
        }elseif($consequence_Category == 2 && $likelihood_Category == 4) {
            $result =  5.5;
        }elseif($consequence_Category == 2 && $likelihood_Category == 3) {
            $result =  6;
        }elseif($consequence_Category == 2 && $likelihood_Category == 2) {
           $result =  7;
        }elseif($consequence_Category == 2 && $likelihood_Category == 1) {
           $result =  7.5;
        }elseif($consequence_Category == 3 && $likelihood_Category == 5) {
            $result =  3.5;
        }elseif($consequence_Category == 3 && $likelihood_Category == 4) {
            $result =  4;
        }elseif($consequence_Category == 3 && $likelihood_Category == 3) {
            $result =  5;
        }elseif($consequence_Category == 3 && $likelihood_Category == 2) {
            $result =  6;
        }elseif($consequence_Category == 3 && $likelihood_Category == 1) {
           $result =  7;
        }elseif($consequence_Category == 4 && $likelihood_Category == 5) {
           $result =  2.5;
        }elseif($consequence_Category == 4 && $likelihood_Category == 4) {
           $result =  3;
        }elseif($consequence_Category == 4 && $likelihood_Category == 3) {
           $result =  4;
        }elseif($consequence_Category == 4 && $likelihood_Category == 2) {
          $result =  5.5;
        }elseif($consequence_Category == 4 && $likelihood_Category == 1) {
           $result =  6.5;
        }elseif($consequence_Category == 5 && $likelihood_Category == 5) {
            $result =  2;
        }elseif($consequence_Category == 5 && $likelihood_Category == 4) {
            $result =  2.5;
        }elseif($consequence_Category == 5 && $likelihood_Category == 3) {
           $result =  3.5;
        }elseif($consequence_Category == 5 && $likelihood_Category == 2) {
            $result =  4;
        }elseif($consequence_Category == 5 && $likelihood_Category == 1) {
            $result =  6;
        }
         return $result;
    }
    function INPECTION_1_get_inspectionScheduleForFlowline($likelihood_Category ,$consequence_Category){
        $result = 5;
        if($consequence_Category == 1 && $likelihood_Category == 5) {
            $result =  3.5;
        }elseif($consequence_Category == 1 && $likelihood_Category == 4) {
            $result =  4;
        }elseif($consequence_Category == 1 && $likelihood_Category == 3) {
            $result =  4.5;
        }elseif($consequence_Category == 1 && $likelihood_Category == 2) {
             $result =  4.5;
        }elseif($consequence_Category == 1 && $likelihood_Category == 1) {
            $result =  5;
        }elseif($consequence_Category == 2 && $likelihood_Category == 5) {
             $result =  2;
        }elseif($consequence_Category == 2 && $likelihood_Category == 4) {
            $result =  3;
        }elseif($consequence_Category == 2 && $likelihood_Category == 3) {
            $result =  3.5;
        }elseif($consequence_Category == 2 && $likelihood_Category == 2) {
           $result =  4;
        }elseif($consequence_Category == 2 && $likelihood_Category == 1) {
           $result =  4.5;
        }elseif($consequence_Category == 3 && $likelihood_Category == 5) {
            $result =  1.5;
        }elseif($consequence_Category == 3 && $likelihood_Category == 4) {
            $result =  2;
        }elseif($consequence_Category == 3 && $likelihood_Category == 3) {
            $result =  3;
        }elseif($consequence_Category == 3 && $likelihood_Category == 2) {
            $result =  3.5;
        }elseif($consequence_Category == 3 && $likelihood_Category == 1) {
           $result =  4.5;
        }elseif($consequence_Category == 4 && $likelihood_Category == 5) {
           $result =  1;
        }elseif($consequence_Category == 4 && $likelihood_Category == 4) {
           $result =  1.5;
        }elseif($consequence_Category == 4 && $likelihood_Category == 3) {
           $result =  2;
        }elseif($consequence_Category == 4 && $likelihood_Category == 2) {
          $result =  3;
        }elseif($consequence_Category == 4 && $likelihood_Category == 1) {
           $result =  4;
        }elseif($consequence_Category == 5 && $likelihood_Category == 5) {
            $result =  1;
        }elseif($consequence_Category == 5 && $likelihood_Category == 4) {
            $result =  1;
        }elseif($consequence_Category == 5 && $likelihood_Category == 3) {
           $result =  1.5;
        }elseif($consequence_Category == 5 && $likelihood_Category == 2) {
            $result =  2;
        }elseif($consequence_Category == 5 && $likelihood_Category == 1) {
            $result =  3.5;
        }
        return $result;
    }

    function checkIsNumber($String_number){
        if($String_number = "" || empty($String_number)) {
            $result = 0;
        }else{
            $result = $String_number;
        }
        return $result;
    }
    
    function conversion_FtoC($F){
        $result = ($F - 32) * (5 / 9);
        return round($result, 3);
    }

    function conversion_inchTomm($inch){
        $result = $inch * 25.4;
        return round($result, 3);
    }
    
    function conversion_inchToMeter($inch){
        $result = $inch * 0.0254;
        return $result;
    }
    
    function conversion_FtoK($temp_F){
        $result = (($temp_F - 32) * 0.55555555) + 273;
        return $result;
    }
    
    function conversion_psitopa($psi){
        $result = $psi * 6894.76;
       return round($result, 3);
    }
    
    function conversion_psitobara($psi){
        $psi = $psi + 14.7;
        $result = $psi * 0.0689476;
        return round($result, 3);
    }
}