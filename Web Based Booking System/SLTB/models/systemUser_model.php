<?php

class SystemUser_Model extends Model {

    public function __construct() {
        parent::__construct();
        Session::init();
    }

    public function createSystemUser($data) {
        return $this->db->insert('system_user', array(
                    'userName' => $data['cUserName'],
                    'empolyeeNo' => $data['cEmpolyeeNo'],
                    'empolyeeName' => $data['cEmpolyeeName'],
                    'empolyeeMNo' => $data['cEmpolyeeMNo']
                ));
    }

    public function updateSystemUser($data) {

        $postData = array(
            'userName' => $data['uUserName'],
            'empolyeeNo' => $data['uEmpolyeeNo'],
            'empolyeeName' => $data['uEmpolyeeName'],
            'empolyeeMNo' => $data['uEmpolyeeMNo']
        );

        return $this->db->update('system_user', $postData, "`userName` = '{$data['uUserName']}'");
    }

    public function createPrivilege($data) {
        $password = $data['loginUserName'] . '@sltb';
        $postData = array(
            'userName' => $data['loginUserName'],
            'password' => Hash::create('md5', $password, HASH_PASSWORD_KEY),
            'privilege' => $data['loginPrivilege']
        );

        return $this->db->update('system_user', $postData, "`userName` = '{$data['loginUserName']}'");
    }

    public function updatePassword($data) {
        $userName = Session::get('userName');
        $currentPassword = Hash::create('md5', $data['currentPassword'], HASH_PASSWORD_KEY);
        $newPassword = Hash::create('md5', $data['newPassword'], HASH_PASSWORD_KEY);

        $sth = $this->db->prepare("SELECT * FROM system_user WHERE 
                userName = :userName AND password = :password");
        $sth->execute(array(
            ':userName' => $userName,
            ':password' => $currentPassword
        ));
        
        $count = $sth->rowCount();
        if ($count > 0) {
            $postData = array(
                'password' => $newPassword
            );
            return $this->db->update('system_user', $postData, "`userName` = '{$userName}'");
        } else {
            return 'Enter Correct Current Password';
        }


//        return $this->db->update('system_user', $postData, "`userName` = '{$userName}'");
//        $this->db->beginTransaction();
//        try {
//            $sth = $this->db->prepare('UPDATE system_user SET password="' . $newPassword . '" 
//                    WHERE 
//                    userName="' . $userName . '" ');
//            $sth->execute();
//            return $this->db->commit();
//        } catch (Exception $e) {
//            $this->db->rollBack();
//            return $e->getMessage();
//        }
    }

    public function searchSingleSystemUser($id) {
        return $this->db->select('SELECT * FROM system_user WHERE userName = :userName', array(':userName' => $id));
    }

    public function xhrSearchSingleUser() {

        $id = $_POST['userName'];
        $result = $this->db->select('SELECT * FROM system_user WHERE userName = :userName', array(':userName' => $id));
        echo json_encode($result);
    }

    public function searchAllSystemUser() {
//return $this->db->select('SELECT id, login, role FROM user');

        return $this->db->select('SELECT * FROM system_user');
    }

    public function deleteSystemUser($id) {
        return $this->db->delete('system_user', "userName = '$id'");
    }

}

?>
