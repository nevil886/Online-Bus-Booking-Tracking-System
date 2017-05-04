<?php

class EntryPoint_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function createEntryPoint($data) {

        return $this->db->insert('entry_point', array(
			'entryPoint' => $data['cEntryPoint']
		));
    }

    public function updateEntryPoint($data) {

       $postData = array(
            'entryPoint' => $data['uEntryPoint']
        );

        return $this->db->update('entry_point', $postData, "`entryPointNo` = '{$data['uEntryPointNo']}'");
  
    }
    
    public function searchSingleEntryPoint($id) {

        return $this->db->select('SELECT * FROM entry_point WHERE entryPointNo = :entryPointNo', array(':entryPointNo' => $id));
    }

    public function searchAllEntryPoint() {

        return $this->db->select('SELECT * FROM entry_point');
    }

    public function searchAllEnrtyPointNo() {

        return $this->db->select('SELECT entryPointNo,entryPoint FROM entry_point');
    }

    public function deleteEntryPoint($id) {

        return $this->db->delete('entry_point', "entryPointNo = '$id'");
        
    }

}

?>
