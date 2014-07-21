<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends CI_Controller {

    public $poweruser;
    public $modpermit;
    private $modid = 2;

    public function __construct() {
        parent::__construct();
        $this->load->model('Categorys');
        $this->load->helper('form');
        $this->load->model('Userauth');

        /** check user status * */
        $uid = $this->session->userdata('uid');
        $this->poweruser = $this->Userauth->powerUser($uid);

        /** end check user status * */
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

    public function index() {
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'category/index';
        $config['total_rows'] = $this->Categorys->totalMainCategory();
        $config['per_page'] = 20;

        $this->pagination->initialize($config);

        $data['main_categorys'] = $this->Categorys->getMainCategory($config['per_page'], $this->uri->segment(3));
        $this->load->view('category/index', $data);
    }

    public function add() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Main Category Name', 'required');
        $this->form_validation->set_rules('parent_id', 'Category Parent/Child', 'required');
        $this->form_validation->set_rules('serial', 'Category Serial', 'required');

        if ($this->form_validation->run() == FALSE) {
            // validation failed
            $data['category'] = $this->Categorys->getAllMainCategory();
            $this->load->view('category/add', $data);
        } else {
            $data['name'] = $this->input->post('name', TRUE);
            $data['parent_id'] = $this->input->post('parent_id', TRUE);
            $data['serial'] = $this->input->post('serial', TRUE);
            $data['status'] = $this->input->post('status', TRUE);
            $data['last_action_date'] = date('Y-m-d H:i:s');
            $data['last_action_user'] = $this->session->userdata('uid');

            /*             * * Image Upload Start ** */

            $config['upload_path'] = '../uploads/category/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);

            $this->upload->do_upload('upload_files');
            $data_upload_files = $this->upload->data();
            $data['image'] = $data_upload_files['file_name'];

            /* echo $this->upload->display_errors();
              exit(0);
             */
            $config['source_image'] = $data_upload_files['full_path'];
            $config['new_image'] = '../uploads/category/thumbs/' . $data_upload_files['file_name'];
            $config['create_thumb'] = false;
            $config['maintain_ratio'] = true;
            $config['width'] = 1024;
            $config['height'] = 130;

            $this->load->library('image_lib', $config);

            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors('<p>', '</p>');
            }


            /*             * *  upload end    ** */


            $insert = $this->Categorys->insertCategory($data);

            if ($insert) {
                $msg = "Successfully Add '{$data['name']}' Category";
                $this->session->set_flashdata('item_name', $msg);
                redirect('category/index');
            } else {
                $data['controller_name'] = $this->Categorys->getControllerName();
                $this->load->view('category/add', $data);
            }
        }

        // success add data into database
    }

    public function edit($cid) {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Main Category Name', 'required');
        $this->form_validation->set_rules('parent_id', 'Category Parent/Child', 'required');
        $this->form_validation->set_rules('serial', 'Main Category Serial', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['content'] = $this->Categorys->getCategory($cid);
            $data['category'] = $this->Categorys->getAllMainCategory();
            $this->load->view('category/edit', $data);
        } else {

            $data['name'] = $this->input->post('name', TRUE);
            $data['parent_id'] = $this->input->post('parent_id', TRUE);
            $data['serial'] = $this->input->post('serial', TRUE);
            $data['status'] = $this->input->post('status', TRUE);
            $data['last_action_date'] = date('Y-m-d H:i:s');
            $data['last_action_user'] = $this->session->userdata('uid');


            /*             * ** Image Upload Start *** */

            $config['upload_path'] = '../uploads/category/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);

            $this->upload->do_upload('upload_files');
            $data_upload_files = $this->upload->data();
            if (!empty($data_upload_files['file_name'])) {
                $data['image'] = $data_upload_files['file_name'];

                /* echo $this->upload->display_errors();
                  exit(0);
                 */
                $config['source_image'] = $data_upload_files['full_path'];
                $config['new_image'] = '../uploads/category/thumbs/' . $data_upload_files['file_name'];
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = true;
                $config['width'] = 1024;
                $config['height'] = 130;

                $this->load->library('image_lib', $config);

                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors('<p>', '</p>');
                }
            }

            /*             * *  upload end    ** */

            $update = $this->Categorys->updateCategory($data, $cid);

            if ($update) {
                $msg = "Successfully Edit '{$data['name']}' Category";
                $this->session->set_flashdata('item_name', $msg);
                redirect('category/index');
            } else {
                $data['content'] = $this->Categorys->getCategory($cid);
                $data['controller_name'] = $this->Categorys->getControllerName();
                $data['error'] = 'Faild to update';
                $this->load->view('category/edit', $data);
            }
        }
    }

    public function delete($cid) {

        $content = $this->Categorys->getCategory($cid);
        $name = $content->name;
        $data['status'] = '13';
        $dels = $this->Categorys->updateCategory($data, $cid);
        if ($dels) {
            $msg = "Successfully Delete '{$name}' Category";
            $this->session->set_flashdata('item_name', $msg);
        } else {
            $msg = "Error Delete '{$name}' Category";
            $this->session->set_flashdata('error_item_name', $msg);
        }

        redirect('category/index');
    }

    public function active($cid) {

        $data['status'] = '1';
        $content = $this->Categorys->getCategory($cid);
        $name = $content->name;
        $update = $this->Categorys->updateCategory($data, $cid);
        if ($update) {

            $this->session->set_flashdata("item_name", "Active Category" . $name . " Succesfully");
            redirect('category/index');
        }
    }

    public function inactive($cid) {

        $data['status'] = '0';
        $content = $this->Categorys->getCategory($cid);
        $name = $content->name;
        $update = $this->Categorys->updateCategory($data, $cid);
        if ($update) {

            $this->session->set_flashdata("item_name", "Inactive Category " . $name . " Succesfully");
            redirect('category/index');
        }
    }

    public function getInfoSub($cid) {

        $cid = trim($cid);

        $data = $this->Categorys->getMsubMenu($cid);

        echo json_encode($data);
    }

}
