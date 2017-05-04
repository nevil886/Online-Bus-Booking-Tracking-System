<?php

class Journey_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function createJourney($data) {

       //$j_No=$this->setJourneyNo($data['cRouteNo'],$data['cJourneyFrom'],$data['cJourneyTo']);
       return $this->db->insert('journey',array(
            'journeyNo' => $data['cJNo'],
            'routeNo' => $data['cRouteNo'],
            'journeyFrom' => $data['cJourneyFrom'],
            'journeyTo' => $data['cJourneyTo'],
            'departureTime' => $data['cBus_departureTime'],
            'arrivalTime' => $data['cBus_arrivalTime'],
            'price' => $data['cPrice']
        ));
    }

    public function updateJourney($data) {

        $postData = array(
            'routeNo' => $data['uRouteNo'],
            'journeyFrom' => $data['uJourneyFrom'],
            'journeyTo' => $data['uJourneyTo'],
            'departureTime' => $data['uBus_departureTime'],
            'arrivalTime' => $data['uBus_arrivalTime'],
            'price' => $data['uPrice']
        );

        return $this->db->update('journey', $postData, "`journeyNo` = '{$data['ujourneyNo']}'");
    }

    public function searchAllJourneyNo() {
        return $this->db->select('SELECT journeyNo FROM journey');
    }
    
    public function searchSingleJourney($id) {
        return $this->db->select('SELECT * FROM journey WHERE journeyNo = :journeyNo', array(':journeyNo' => $id));
    }

    public function searchAllJourney() {
        return $this->db->select('SELECT * FROM journey ORDER BY journeyNo ASC ');
    }
    
    public function searchAllJourneyFrom() {
        return $this->db->select('SELECT * FROM journey GROUP BY journeyFrom ORDER BY journeyNo ASC ');
    }
     public function searchAllJourneyTo() {
        return $this->db->select('SELECT * FROM journey GROUP BY journeyTo ORDER BY journeyNo ASC ');
    }
    
    public function searchAvailableAllJourney() {
        return $this->db->select('SELECT journey.journeyNo 
                                FROM journey 
                                LEFT JOIN journey_for_bus ON  journey.journeyNo = journey_for_bus.journeyNo  where journey_for_bus.journeyNo IS NULL
                                ORDER BY journey.journeyNo ASC');
    }

    public function searchEntryPointForJourney($id) {
        //return $this->db->select('SELECT * FROM entrypoint_for_journey WHERE journeyNo='.$id.'');
        return $this->db->select('SELECT
                entrypoint_for_journey.entryPoint_for_journeyNo,
                entrypoint_for_journey.journeyNo,
                entrypoint_for_journey.entryPointNo,
                entry_point.entryPoint 
                FROM entrypoint_for_journey JOIN entry_point ON entrypoint_for_journey.entryPointNo = entry_point.entryPointNo 
                WHERE entrypoint_for_journey.journeyNo ="' . $id . '"');
    }
    
    public function deleteJourney($id) {

        return $this->db->delete('journey', "journeyNo = '$id'");
    }

    public function addEntryPointForJourney($data) {

            $arrayData = array();
            if (isset($data['enntryPoint'])) {
            $optionArray = $data['enntryPoint'];
            $x = 0;
            for ($i = 0; $i < count($optionArray); $i++) {
                $arrayData[++$x]['table'] = 'entrypoint_for_journey';
                $arrayData[$x]['data'] = array(
                    'journeyNo' => $data['journeyNo'],
                    'entryPointNo' => $optionArray[$i]
                );
            }
        }
        $this->db->traInsert($arrayData);
        return $data['journeyNo'];
    }
    
    public function deleteEntryPointForJourney($ide,$idj) {
        $this->db->delete('entrypoint_for_journey', "entryPoint_for_journeyNo = '$ide'");
        return $idj;
    }
    
    public function setJourneyNo($r_No,$j_f,$j_t) {
        
        $arrayJ_f = $j_f;
        $arrayJ_t = $j_t;
        $j_No = $arrayJ_f[0].$arrayJ_t[0].$r_No;
        
//        echo $j_No;
//        exit();
        return $j_No;
    }
    
    
}

?>
