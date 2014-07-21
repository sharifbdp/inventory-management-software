<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public $poweruser;
    public $modpermit;
    private $modid = 20;

    public function __construct() {
        parent::__construct();

        $this->load->library('parser');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('text');
        $this->load->library('Ajax_pagination');
        
        $this->load->model('Userauth');
        $this->load->model('Users');

        /*         * * check user status ** */
        $uid = $this->session->userdata('uid');
        $this->poweruser = $this->Userauth->powerUser($uid);

        /*         * * end check user status ** */

        // this is check module permission
        $this->modpermit = $this->Userauth->modulePermission($uid, $this->modid);


        if (!$this->session->userdata('admin_logged')) {
            redirect('login/index');
        }

        if (!$this->poweruser) {
            if (!$this->modpermit) {
                redirect('unauthorized/permission');
                //echo $this->modpermit;
            }
        }
    }

//

    function Paging() {

        parent::Controller();
        
    }

    function index() {
        redirect('user/my_friends');
    }

    function my_friends() {
        $pdata['TotalRec'] = $this->Users->TotalRec();
        $pdata['perPage'] = $this->perPage();
        $pdata['ajax_function'] = 'get_friends_ajax';

        $subdata['paging'] = $this->parser->parse('paging', $pdata, TRUE);
        $subdata['all_friends'] = $this->Users->my_friends($this->perPage());

        $data['body_content'] = $this->parser->parse('friend_list', $subdata, TRUE);

        $this->load->view('main', $data);
    }

    function get_friends_ajax() {
        $pdata['TotalRec'] = $this->Users->TotalRec();
        $pdata['perPage'] = $this->perPage();

        $pdata['ajax_function'] = 'get_friends_ajax';

        $data['paging'] = $this->parser->parse('paging', $pdata, TRUE);
        $data['all_friends'] = $this->Users->my_friends($this->perPage());

        $this->load->view('list', $data);
    }

    function PerPage() {
        return 5;
    }

    /*
      public function index() {
      $this->load->library('pagination');

      $config['base_url'] = base_url() . 'user/index';
      $config['total_rows'] = $this->Users->totalUser();
      $config['per_page'] = 20;

      $this->pagination->initialize($config);

      $data['poweruser'] = $this->poweruser;

      $data['all_user'] = $this->Users->getAllUser($config['per_page'], $this->uri->segment(3));

      $this->load->view('user/index', $data);
      }
     *
     */

    public function add() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'User Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('login_id', 'Login ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|md5');

        if ($this->form_validation->run() == FALSE) {
            $data['allmodule'] = $this->Users->getAllModule();
            $this->load->view('user/add', $data);
        } else {

            $data['name'] = $this->input->post('name');
            $data['login_id'] = $this->input->post('login_id');
            $data['password'] = $this->input->post('password');
            $data['status'] = $this->input->post('status');
            $data['type'] = $this->input->post('type');
            if ($data['type'] == 1) {
                $data['user_status'] = 1; // power user
            } else {
                $data['user_status'] = 2; // normal user
            }
            //$data['user_status'] = $this->input->post('user_status');
            $data['last_login_date'] = date('Y-m-d H:i:s');


            $module_id = $this->input->post('module_id');

            // insert data into user table

            $insert = $this->Users->insertData($data);

            if ($data['user_status'] != '1') {

                if ($insert) {
                    for ($i = 0; $i < count($module_id); $i++) {
                        $insermper = $this->Users->insertModulePermission($insert, $module_id[$i]);
                    }

                    $this->session->set_flashdata("name", "Add user" . $data['name'] . " Succesfully");
                    redirect('user/index');
                }
            } else {
                redirect('user/index');
            }
        }
    }

    public function edit($lid) {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'User Name', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('login_id', 'Login ID', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|md5');

        if ($this->form_validation->run() == FALSE) {

            $data['content'] = $this->Users->viewUser($lid);
            $data['allmodule'] = $this->Users->getAllModule();

            $this->load->view('user/edit', $data);
        } else {

            $data['name'] = $this->input->post('name');
            //$data['login_id'] = $this->input->post('login_id');
            $data['password'] = $this->input->post('password');
            $data['status'] = $this->input->post('status');
            $data['type'] = $this->input->post('type');
            if ($data['type'] == 1) {
                $data['user_status'] = 1; // power user
            } else {
                $data['user_status'] = 2; // normal user
            }
            //$data['user_status'] = $this->input->post('user_status');
            $data['last_login_date'] = date('Y-m-d H:i:s');


            $module_id = $this->input->post('module_id');

            // insert data into user table

            $update = $this->Users->updateData($lid, $data);

            if ($update) {
                $deleteallm = $this->Users->deleteModulePermission($lid);

                for ($i = 0; $i < count($module_id); $i++) {
                    $insermper = $this->Users->insertModulePermission($lid, $module_id[$i]);
                }

                $this->session->set_flashdata("name", "Edit user " . $data['name'] . " Succesfully");

                redirect('user/index');
            }
        }
    }

    public function delete($did) {
        $data['status'] = '13';
        $delete = $this->Users->deleteUser($did, $data);

        $content = $this->Users->viewUser($did);
        $name = $content->name;
        if ($delete) {

            $this->session->set_flashdata("name", "Delete user " . $name . " Succesfully");
            redirect('user/index');
        }
    }

    public function active($id) {
        $data['status'] = '1';
        $delete = $this->Users->deleteUser($id, $data);

        $content = $this->Users->viewUser($id);
        $name = $content->name;
        if ($delete) {

            $this->session->set_flashdata("name", "Active user " . $name . " Succesfully");
            redirect('user/index');
        }
    }

    public function inactive($id) {

        $data['status'] = '0';
        $delete = $this->Users->deleteUser($id, $data);

        $content = $this->Users->viewUser($id);
        $name = $content->name;
        if ($delete) {

            $this->session->set_flashdata("name", "Inactive user " . $name . " Succesfully");
            redirect('user/index');
        }
    }

    public function check_user_name($login_id) {

        echo $this->Users->check_user_name($login_id);
    }

}
