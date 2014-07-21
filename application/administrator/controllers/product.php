<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

    public $poweruser;
    public $modpermit;
    private $modid = 3;

    public function __construct() {
        parent::__construct();

        $this->load->model('Userauth');
        $this->load->model('Categorys');
        $this->load->model('Products');
        $this->load->model('Productsales');

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

    public function index() {
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'product/index';
        $config['total_rows'] = $this->Products->totalProduct();
        $config['per_page'] = 50;

        $this->pagination->initialize($config);

        $data['content'] = $this->Products->getAllproduct($config['per_page'], $this->uri->segment(3));
        $this->load->view('product/index', $data);
    }

    public function add() {

        $this->load->library('form_validation');

        /** this is for ckeditor and ckfinder * */
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');

        //configure base path of ckeditor folder
        $this->ckeditor->basePath = base_url() . 'asset/ckeditor/';
        $this->ckeditor->config['toolbar'] = 'Full';
        $this->ckeditor->config['language'] = 'en';
        //configure ckfinder with ckeditor config
        $this->ckfinder->SetupCKEditor($this->ckeditor, '../asset/ckfinder/');

        /** this is for ckeditor and ckfinder * */
        $this->form_validation->set_rules('cid', 'Main Category', 'required');
        $this->form_validation->set_rules('scid', 'Sub Category', '');
        $this->form_validation->set_rules('name', 'Product Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('price_buy', 'Product Price (Buy)', 'required');
        $this->form_validation->set_rules('price', 'Product Price (Sell)', 'required');
        $this->form_validation->set_rules('details', 'Product Details', 'required');

        $this->form_validation->set_rules('status', 'Inforamtion Status', '');

        //'required'

        if ($this->form_validation->run() == FALSE) {
            // validation failed
            $data['allmaincategory'] = $this->Categorys->getAllMainCategory();
            $this->load->view('product/add', $data);
        } else {
            $data['cid'] = $this->input->post('cid');
            $data['scid'] = $this->input->post('scid');

            $data['name'] = $this->input->post('name', TRUE);
            $data['details'] = $this->input->post('details');

            $data['status'] = $this->input->post('status', TRUE);

            $data['publish_date'] = $this->input->post('publish_date', TRUE);
            $data['serial'] = $this->input->post('serial', TRUE);
            $data['ime_no'] = $this->input->post('ime_no', TRUE);
            $data['model_no'] = $this->input->post('model_no', TRUE);
            $data['made'] = $this->input->post('made', TRUE);
            $data['quantity'] = $this->input->post('quantity', TRUE);
            $data['in_stock'] = $this->input->post('quantity', TRUE);
            $data['price_buy'] = $this->input->post('price_buy', TRUE);
            $data['price'] = $this->input->post('price', TRUE);

            $data['last_action_date'] = date('Y-m-d h:i:s');
            $data['last_action_user'] = $this->session->userdata('uid');

            /*             * * Image Upload Start ** */

            $config['upload_path'] = '../uploads/product_image/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|swf';

            $this->load->library('upload', $config);

            $this->upload->do_upload('upload_files');
            $data_upload_files = $this->upload->data();
            $data['image'] = $data_upload_files['file_name'];

            /* echo $this->upload->display_errors();
              exit(0);
             */
            $config['source_image'] = $data_upload_files['full_path'];
            $config['new_image'] = '../uploads/product_image/thumbs/' . $data_upload_files['file_name'];
            $config['create_thumb'] = false;
            $config['maintain_ratio'] = true;
            $config['width'] = 300;
            $config['height'] = 300;

            $this->load->library('image_lib', $config);

            if (!$this->image_lib->resize()) {
                echo $this->image_lib->display_errors('<p>', '</p>');
            }


            /*             * *  upload end    ** */

            $insert = $this->Products->insertProduct($data);

            if ($insert) {
                $msg = "Successfully Add '{$data['name']}' Product ";
                $this->session->set_flashdata('name', $msg);
                redirect('product/index');
            } else {
                $data['allmaincategory'] = $this->Categorys->getAllMainCategory();
                $this->load->view('product/add', $data);
            }
        }

        // success add data into database 
    }

    public function edit($infoid) {

        $infoid = trim($infoid);

        $this->load->library('form_validation');

        /** this is for ckeditor and ckfinder * */
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');

        //configure base path of ckeditor folder
        $this->ckeditor->basePath = base_url() . 'asset/ckeditor/';
        $this->ckeditor->config['toolbar'] = 'Full';
        $this->ckeditor->config['language'] = 'en';
        //configure ckfinder with ckeditor config
        $this->ckfinder->SetupCKEditor($this->ckeditor, '../../asset/ckfinder/');

        /** this is for ckeditor and ckfinder * */
        $this->form_validation->set_rules('cid', 'Main Category', 'required');
        $this->form_validation->set_rules('scid', 'Sub Category', '');
        $this->form_validation->set_rules('name', 'Product Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('details', 'Product Details', 'required');
        $this->form_validation->set_rules('price_buy', 'Product Price (Buy)', 'required');
        $this->form_validation->set_rules('price', 'Product Price (Sell)', 'required');
        $this->form_validation->set_rules('status', 'Inforamtion Status', '');
        $this->form_validation->set_rules('feature_product', 'Feature Product', '');

        //'required'

        if ($this->form_validation->run() == FALSE) {
            // validation failed
            $data['allmaincategory'] = $this->Categorys->getAllMainCategory();
            $data['content'] = $this->Products->getProduct($infoid);
            $this->load->view('product/edit', $data);
        } else {
            $data['cid'] = $this->input->post('cid');
            $data['scid'] = $this->input->post('scid');
            $data['name'] = $this->input->post('name', TRUE);
            $data['details'] = $this->input->post('details');

            $data['status'] = $this->input->post('status');
            $data['publish_date'] = $this->input->post('publish_date', TRUE);
            $data['serial'] = $this->input->post('serial', TRUE);
            $data['ime_no'] = $this->input->post('ime_no', TRUE);
            $data['model_no'] = $this->input->post('model_no', TRUE);
            $data['made'] = $this->input->post('made', TRUE);
            $data['quantity'] = $this->input->post('quantity', TRUE);
            $data['in_stock'] = $this->input->post('quantity', TRUE);
            $data['price_buy'] = $this->input->post('price_buy', TRUE);
            $data['price'] = $this->input->post('price', TRUE);


            /*             * * Image Upload Start ** */

            $config['upload_path'] = '../uploads/product_image/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|swf';

            $this->load->library('upload', $config);

            $this->upload->do_upload('upload_files');
            $data_upload_files = $this->upload->data();

            if (!empty($data_upload_files['file_name'])) {
                $data['image'] = $data_upload_files['file_name'];

                /* echo $this->upload->display_errors();
                  exit(0);
                 */
                $config['source_image'] = $data_upload_files['full_path'];
                $config['new_image'] = '../uploads/product_image/thumbs/' . $data_upload_files['file_name'];
                $config['create_thumb'] = false;
                $config['maintain_ratio'] = true;
                $config['width'] = 300;
                $config['height'] = 300;

                $this->load->library('image_lib', $config);

                if (!$this->image_lib->resize()) {
                    echo $this->image_lib->display_errors('<p>', '</p>');
                }
            }

            /*             * *  upload end    ** */


            $update = $this->Products->changeProduct($data, $infoid);

            if ($update) {
                $msg = "Successfully Edit '{$data['name']}' Product ";
                $this->session->set_flashdata('name', $msg);
                redirect('product/index');
            } else {
                $data['allmaincategory'] = $this->Categorys->getAllMainCategory();
                $data['content'] = $this->Products->getProduct($infoid);
                $this->load->view('product/edit', $data);
            }
        }

        // success add data into database
    }

    public function view($id) {

        $data['content'] = $this->Products->getProduct($id);
        $this->load->view('product/view', $data);
    }

    public function delete($did) {
        $did = trim($did);
        $data['status'] = '13';
        $change = $this->Products->changeProduct($data, $did);
        $content = $this->Products->getProduct($did);
        $name = $content->name;
        if ($change) {

            $this->session->set_flashdata("name", "Delete Product  '" . $name . "'  Succesfully");
            redirect('product/index');
        }
    }

    public function active($id) {
        $did = trim($id);
        $data['status'] = '1';

        $change = $this->Products->changeProduct($data, $did);


        $content = $this->Products->getProduct($did);
        $name = $content->name;
        if ($change) {

            $this->session->set_flashdata("name", "Active Product  '" . $name . "'  Succesfully");
            redirect('product/index');
        }
    }

    public function inactive($id) {

        $did = trim($id);
        $data['status'] = '0';

        $change = $this->Products->changeProduct($data, $did);


        $content = $this->Products->getProduct($did);
        $name = $content->name;
        if ($change) {

            $this->session->set_flashdata("name", "Inactive Product  '" . $name . "'  Succesfully");
            redirect('product/index');
        }
    }

    public function getProductName($mid) {

        $mid = trim($mid);

        $this->load->model('Products');

        $data = $this->Products->getAllProductName($mid);

        foreach ($data as $ds) {
            $dts[$ds['id']] = $ds['name'];
        }
        // $ds[$data->id] = $data->name;

        echo json_encode($dts);
    }

    public function ProductPrice($id) {

        $price = $this->Products->getProductPrice($id);
        echo json_encode($price);
    }

}
