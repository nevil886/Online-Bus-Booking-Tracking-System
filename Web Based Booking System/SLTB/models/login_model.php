<?php

class Login_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function loginToSystem() {

        /* $data=$this->db->select('SELECT userName, privilege FROM system_user 
          WHERE userName = :userName AND password = :password',
          array(
          ':userName' => $_POST['userName'],
          ':password' => Hash::create('md5', $_POST['password'], HASH_PASSWORD_KEY)
          ));
          foreach ($data as $key => $value)
          if (true) {
          Session::init();
          Session::set('privilege', $value['privilege']);
          Session::set('loggedIn', true);
          Session::set('userName', $value['userName']);
          if ($data['privilege'] == 'Booker')
          header('location: ../index');
          else
          header('location: ../systemUser');
          } else {
          header('location: ../login');
          } */

        $sth = $this->db->prepare("SELECT userName, privilege FROM system_user WHERE 
                userName = :userName AND password = :password");
        $sth->execute(array(
            ':userName' => $_POST['userName'],
            ':password' => Hash::create('md5', $_POST['password'], HASH_PASSWORD_KEY)
        ));
        $data = $sth->fetch();
        $count = $sth->rowCount();
        if ($count > 0) {
            Session::init();
            Session::set('privilege', $data['privilege']);
            Session::set('loggedIn', true);
            Session::set('userName', $data['userName']);
            if ($data['privilege'] == 'Conduct')
                header('location: ../Report');
            elseif ($data['privilege'] == 'Booker')
                header('location: ../index');
            else
                header('location: ../systemUser');
        } else {
            header('location: ../login');
        }
    }

}

?>