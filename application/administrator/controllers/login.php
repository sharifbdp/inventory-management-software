<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Logins');
    }

    public function index() {

        $this->load->library('form_validation');
        if ($this->session->userdata('admin_logged')) {
            redirect('home/index');
        } else {
            $this->load->view('login/index');
        }
    }

    public function check() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('userid', 'userid', 'required|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'required|xss_clean|md5');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/index');
        } else {

            $login_id = $this->input->post('userid');
            $password = $this->input->post('password');
            $checkdata = $this->Logins->checkAdmin($login_id, $password);


            if (!empty($checkdata)) {
                $userinfo = array(
                    'username' => $checkdata->name,
                    'uid' => $checkdata->id,
                    'type' => $checkdata->type,
                    'admin_logged' => TRUE
                );

                $this->session->set_userdata($userinfo);

                $uid = $checkdata->id;
                $logininfo = $this->Logins->updateLoginInfo($uid);

                redirect('home/index');
            } else {

                $this->load->view('login/index');
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login/index');
    }

}