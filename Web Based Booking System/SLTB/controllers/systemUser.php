<?php

class SystemUser extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
    }

    /*
     * View System User pages.
     */

    function index() {
        if (Session::get('privilege') == 'Admin' || Session::get('privilege') == 'Operator') {
            $this->view->searchAllSystemUser = $this->searchAllSystemUser();
            $this->view->render('systemUser/index');
        } else {
            $this->error();
        }
    }

    function create() {
        if (Session::get('privilege') == 'Operator') {
            $this->view->render('systemUser/create');
        } else {
            $this->error();
        }
    }

    function update() {
        if (Session::get('privilege') == 'Operator') {
            $this->view->render('systemUser/update');
        } else {
            $this->error();
        }
    }

    function updateFromTable($id) {
        if (Session::get('privilege') == 'Operator') {
            $this->view->user = $this->model->searchSingleSystemUser($id);
            $this->view->render('systemUser/update');
        } else {
            $this->error();
        }
    }

    function createUserLogin() {
        if (Session::get('privilege') == 'Admin') {
            $this->view->render('systemUser/createUserLogin');
        } else {
            $this->error();
        }
    }

    function changePassword() {
        if (Session::get('loggedIn') == true) {
            $this->view->render('systemUser/changePassword');
        } else {
            $this->error();
        }
    }

    /*
     * method in SystemUser class.
     */

    function createSystemUser() {
        if (Session::get('privilege') == 'Operator') {
            $val = $this->model->createSystemUser($_POST);
            if ($val == 1) {
                $mag = 'Success';
                header('location: ' . URL . 'systemUser/create/' . $mag . '');
            } else {
                $mag = 'Fail/" (' . $val . ') "';
                header('location: ' . URL . 'systemUser/create/' . $mag . '');
            }
        } else {
            $this->error();
        }
    }

    function updateSystemUser() {
        if (Session::get('privilege') == 'Operator') {
            $val = $this->model->updateSystemUser($_POST);
            if ($val == 1) {
                $mag = 'Success';
                header('location: ' . URL . 'systemUser/update/' . $mag . '');
            } else {
                $mag = 'Fail/" (' . $val . ') "';
                header('location: ' . URL . 'systemUser/update/' . $mag . '');
            }
        } else {
            $this->error();
        }
    }

    function createPrivilege() {
        if (Session::get('privilege') == 'Admin') {
            $this->model->createPrivilege($_POST);
            header('location: ' . URL . 'systemUser');
        } else {
            $this->error();
        }
    }

    function updatePassword() {
        if (Session::get('loggedIn') == true) {
            $val = $this->model->updatePassword($_POST);
            if ($val == 1) {
                $mag = 'Success';
                header('location: ' . URL . 'systemUser/changePassword/' . $mag . '');
            } else {
                $mag = 'Fail/" (' . $val . ') "';
                header('location: ' . URL . 'systemUser/changePassword/' . $mag . '');
            }
        } else {
            $this->error();
        }
    }

    function searchSingleSystemUser() {
        if (Session::get('privilege') == 'Operator') {
            return $this->model->searchSingleSystemUser();
        } else {
            $this->error();
        }
    }

    function xhrSearchSingleUser() {
        if (Session::get('privilege') == 'Operator') {
            return $this->model->xhrSearchSingleUser();
        } else {
            $this->error();
        }
    }

    function searchAllSystemUser() {
        if (Session::get('privilege') == 'Admin' || Session::get('privilege') == 'Operator') {
            return $this->model->searchAllSystemUser();
        } else {
            $this->error();
        }
    }

    function deleteSystemUser($id) {
        if (Session::get('privilege') == 'Operator') {
            $val = $this->model->deleteSystemUser($id);
            if ($val != 1)
                $mag = ' " Cannot delete " Because This value is use for another table. (You can delete new value)';
            header('location: ' . URL . 'systemUser/index/' . $mag . '');
        } else {
            $this->error();
        }
    }

    function error() {
        require 'controllers/error.php';
        $controller = new Error();
        $controller->index('Sorry ...! You can not Accsess This Page');
    }

}

?>
