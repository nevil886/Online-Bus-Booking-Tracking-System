<?php

class Bus_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function createBus($data) {
        $arrayData = array();
        $arrayData[0]['table'] = 'bus';
        $arrayData[0]['data'] = array(
            'busNo' => $data['cBus_busNo'],
            'busModel' => $data['cBus_busModel'],
            'numberOfSeat' => $data['cBus_numberOfSeat'],
        );
        $arrayData[1]['table'] = 'assign_bus ';
        $arrayData[1]['data'] = array(
            'userName' => Session::get('userName'),
            'busNo' => $data['cBus_busNo'],
            'date' => date("Y-m-d"),
            'sql' => 'I'
        );
        return $this->db->traInsert($arrayData);

//        return $this->db->insert('bus', array(
//			'busNo' => $data['cBus_busNo'],
//			'journeyNo' => $data['cBus_JourneyNo'],
//			'busModel' => $data['cBus_busModel'],
//                        'numberOfSeat' => $data['cBus_numberOfSeat'],
//                        'departureTime' => $data['cBus_departureTime'],
//                        'arrivalTime' => $data['cBus_arrivalTime']
//		));
    }

    public function updateBus($data) {

        $postData_update = array(
            'busNo' => $data['uBus_busNo'],
            'busModel' => $data['uBus_busModel'],
            'numberOfSeat' => $data['uBus_numberOfSeat'],
        );

        $postData_insert = array(
            'userName' => Session::get('userName'),
            'busNo' => $data['uBus_busNo'],
            'date' => date("Y-m-d"),
            'sql' => 'U'
        );

        return $this->db->update_and_insert('bus', $postData_update, "`busNo` = '{$data['uBus_busNo']}'", 'assign_bus', $postData_insert);
    }

    public function searchSingleBus($id) {

        return $this->db->select('SELECT * FROM bus WHERE busNo = :busNo', array(':busNo' => $id));
    }

    public function xhrSearchSingleBus() {

        $id = $_POST['busNo'];
        $result = $this->db->select('SELECT * FROM bus WHERE busNo = :busNo', array(':busNo' => $id));
        echo json_encode($result);
    }

    public function searchAllBus() {

        return $this->db->select('SELECT * FROM bus');
    }
    public function xhrSearchAllBusandJourney() {

        return $this->db->select('SELECT bus.busNo,bus.numberOfSeat,journey_for_bus.journeyNo 
                                  FROM journey_for_bus
                                  JOIN bus ON bus.busNo=journey_for_bus.busNo');
    }
    public function searchJourneyforBus($id) {

        return $this->db->select('SELECT * FROM journey_for_bus WHERE busNo = "' . $id . '" ');
    }

    public function searchAvailablelBus($from, $to) {
        $availablelBus = $this->db->select('SELECT
                bus.busNo,
                bus.numberOfSeat,
                journey.routeNo,
                journey.departureTime,
                journey.arrivalTime,
                journey.price,
                journey.journeyNo
                FROM journey
                JOIN journey_for_bus ON journey.journeyNo = journey_for_bus.journeyNo
                JOIN bus ON journey_for_bus.busNo = bus.busNo  
                WHERE journey.journeyFrom ="' . $from . '" AND journey.journeyTo ="' . $to . '" ');

        $arrayData = array();
        $arrayDataEntry = array();
        $i = 0;

        if (isset($availablelBus)) {
            foreach ($availablelBus as $key => $value) {

                $arrayData[$i]['busNo'] = $value['busNo'];
                $arrayData[$i]['routeNo'] = $value['routeNo'];
                $arrayData[$i]['departureTime'] = $value['departureTime'];
                $arrayData[$i]['arrivalTime'] = $value['arrivalTime'];
                $arrayData[$i]['numberOfSeat'] = $value['numberOfSeat'];
                $arrayData[$i]['price'] = $value['price'];
                $entryPoint = $this->db->select('SELECT 
                        entry_point.entryPoint 
                        FROM entry_point
                        JOIN entrypoint_for_journey ON entry_point.entryPointNo = entrypoint_for_journey.entryPointNo
                        WHERE journeyNo = "' . $value['journeyNo'] . '" ');
                $j = 0;
                if (isset($entryPoint)) {
                    foreach ($entryPoint as $key => $value2) {
                        $arrayDataEntry[$j]['entryPoint'] = $value2['entryPoint'];
                        $j++;
                    }
                }
                $arrayData[$i]['entry_Point'] = $arrayDataEntry;

                $i++;
            }

            return $arrayData;
        }
    }

    public function getjourneyNo($from, $to) {

        return $this->db->select('SELECT journeyNo FROM journey WHERE journeyFrom ="' . $from . '" AND journeyTo ="' . $to . '" ');
    }

    public function getjourneyNo2($busNo,$from,$to) {

        return $this->db->select('SELECT journey_for_bus.journeyNo 
                                  FROM journey_for_bus
                                  JOIN journey ON journey.journeyNo = journey_for_bus.journeyNo
                                  WHERE 
                                  journey.journeyFrom ="' . $from . '" AND 
                                  journey.journeyTo ="' . $to . '" AND
                                  journey_for_bus.busNo ="' . $busNo . '"');
    }
    
    public function deleteBus($id) {
        $postData_insert = array(
            'userName' => Session::get('userName'),
            'busNo' => $id,
            'date' => date("Y-m-d"),
            'sql' => 'D'
        );
        return $this->db->delete_and_insert('bus', "busNo = '$id'", 'assign_bus', $postData_insert);
    }

    public function addJourneytoBus($data) {
        /**
          $arrayData = array();
          if (isset($data['journeyNo'])) {
          $optionArray = $data['journeyNo'];
          $x = 0;
          for ($i = 0; $i < count($optionArray); $i++) {
          $arrayData[++$x]['table'] = 'journey_for_bus';
          $arrayData[$x]['data'] = array(
          'busNo' => $data['busNo'],
          'journeyNo' => $optionArray[$i]
          );
          }
          }
          $this->db->traInsert($arrayData);
         */
        $result = $this->db->select('SELECT COUNT(busNo) FROM journey_for_bus WHERE busNo = :busNo', array(':busNo' => $data['busNo']));
        //$re = $this->db->select('SELECT COUNT(busNo) FROM journey_for_bus WHERE busNo = "' . $data['busNo'] . '"');
        foreach ($result as $key => $value) {
            $count = $value['COUNT(busNo)'];
        }
        if($count >= 2){
            return $data['busNo'].'/false';
        }  else {
           $this->db->insert('journey_for_bus', array(
            'busNo' => $data['busNo'],
            'journeyNo' => $data['journeyNo'],
        )); 
           return $data['busNo'];
        }
    
    }

    public function deleteJourneyforBus($id, $idb) {
        $this->db->delete('journey_for_bus', "journey_for_bus_No = '$id'");
        return $idb;
    }

}

?>
