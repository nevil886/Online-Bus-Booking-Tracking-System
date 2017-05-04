<?php
class Conductor_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function createConductor($data) {

        $arrayData = array();
        $arrayData[0]['table'] = 'conductor';
        $arrayData[0]['data'] = array(
            'conductorNo' => $data['cConductorNo'],
            'conductorName' => $data['cConductorName'],
            'conductorMNo' => $data['cConductorMNo'],
            'busNo' => $data['cBusNo']
        );
        $arrayData[1]['table'] = 'assign_coductor';
        $arrayData[1]['data'] = array(
            'userName' => Session::get('userName'),
            'conductorNo' => $data['cConductorNo'],
            'date' => date("Y-m-d")
        );
        return $this->db->traInsert($arrayData);
    }
    
    public function updateConductor($data) {

        $postData = array(
            'conductorNo' => $data['uConductorNo'],
            'conductorName' => $data['uConductorName'],
            'conductorMNo' => $data['uConductorMNo'],
            'busNo' => $data['uBusNo']
        );

        return $this->db->update('conductor', $postData, "`conductorNo` = '{$data['uConductorNo']}'");
   
    }
    
    public function searchSingleConductor($id) {

        return $this->db->select('SELECT * FROM conductor WHERE conductorNo = :conductorNo', array(':conductorNo' => $id));
        
    }
    
    public function searchAllConductor() {

       return $this->db->select('SELECT * FROM conductor');
    }
    
    public function deleteConductor($id) {

         return $this->db->delete('conductor', "conductorNo = '$id'");
    }
}
?>
