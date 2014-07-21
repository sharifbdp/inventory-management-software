<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Productsale extends CI_Controller {

    public $poweruser;
    public $modpermit;
    private $modid = 4;

    public function __construct() {
        parent::__construct();

        $this->load->model('Userauth');
        $this->load->model('Products');
        $this->load->model('Categorys');
        //$this->load->model('Submenus');
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

        $config['base_url'] = base_url() . 'productsale/index';
        $config['total_rows'] = $this->Productsales->totalProductsale();
        $config['per_page'] = 20;

        $this->pagination->initialize($config);

        $data['content'] = $this->Productsales->getAllProductsale($config['per_page'], $this->uri->segment(3));
        $this->load->view('productsale/index', $data);
    }

    public function add() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('cid', 'Main Category', '');
        $this->form_validation->set_rules('scid', 'Sub Category', '');
        $this->form_validation->set_rules('product_id', 'Product ID', '');
        $this->form_validation->set_rules('product_price', 'product_price', 'trim|required|xss_clean');
        $this->form_validation->set_rules('quantity', 'Product Quantity', 'required');
        $this->form_validation->set_rules('total_amount', 'Product Total Amount', '');
        $this->form_validation->set_rules('status', 'Inforamtion Status', '');

        $this->form_validation->set_rules('cus_name', 'Customer Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cus_email', 'Customer Email Address', 'trim|xss_clean');
        $this->form_validation->set_rules('contact_no', 'contact_no', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cus_address', 'Customer Address', 'trim|xss_clean');

        //'required'

        if ($this->form_validation->run() == FALSE) {
            // validation failed
            $data['allmaincategory'] = $this->Categorys->getAllMainCategory();
            $this->load->view('productsale/add', $data);
        } else {
            $data['cid'] = $this->input->post('cid');
            $data['scid'] = $this->input->post('scid');
            $data['product_id'] = $this->input->post('product_id');

            $data['product_price'] = $this->input->post('product_price', TRUE);
            $data['quantity'] = $this->input->post('quantity', TRUE);
            $data['total_amount'] = $this->input->post('total_amount', TRUE);
            $data['sale_date'] = $this->input->post('sale_date', TRUE);
            $data['warranty_start'] = $this->input->post('warranty_start', TRUE);
            $data['warranty_end'] = $this->input->post('warranty_end', TRUE);

            $data['status'] = $this->input->post('status');
            $data['last_action_date'] = date('Y-m-d h:i:s');
            $data['last_action_user'] = $this->session->userdata('uid');

            // Customer Information
            $data_c['cus_name'] = $this->input->post('cus_name', TRUE);
            $data_c['cus_email'] = $this->input->post('cus_email', TRUE);
            $data_c['cus_address'] = $this->input->post('cus_address', TRUE);
            $data_c['contact_no'] = $this->input->post('contact_no', TRUE);

            // Account Table
            $data_a['product_id'] = $this->input->post('product_id');
            $data_a['credit'] = $this->input->post('total_amount', TRUE);

            $price_buy = $this->Products->getProductPrice($data_a['product_id']);
            $product_buy_price = $price_buy->price_buy;
            $data_a['debit'] = $product_buy_price * $data['quantity'];
            $data_a['balance'] = $data_a['credit'] - $data_a['debit'];

            // $product_id and $after_sell_in_stock save to the session and use in invoice function.
            $has_stock = $price_buy->in_stock;

            $product_stock = array(
                'product_id' => $data['product_id'],
                'after_sell_in_stock' => $has_stock - $data['quantity'],
            );

            $this->session->set_userdata($product_stock);


            $insert = $this->Productsales->insertProductsale($data, $data_c, $data_a);

            if ($insert) {

                $product_id = $data['product_id'];
                $product_details = $this->Products->getProduct($product_id);
                $name = $product_details->name;

                $last_id = $this->db->insert_id();
                $saleid = $this->Productsales->getSaleID($last_id);

                $sale_id = $saleid->sale_id;

                $msg = "Successfully Add '{$name}' Product Sale ";
                $this->session->set_flashdata('name', $msg);
                redirect('productsale/checkout/' . $sale_id);
            } else {
                $data['allmaincategory'] = $this->Categorys->getAllMainCategory();
                $this->load->view('productsale/add', $data);
            }
        }

        // success add data into database 
    }

    public function edit($infoid) {

        $infoid = trim($infoid);

        $this->load->library('form_validation');

        $this->form_validation->set_rules('cid', 'Main Category', '');
        $this->form_validation->set_rules('scid', 'Sub Category', '');
        $this->form_validation->set_rules('product_id', 'Product ID', '');
        $this->form_validation->set_rules('product_price', 'product_price', 'trim|required|xss_clean');
        $this->form_validation->set_rules('quantity', 'Product Quantity', 'required');
        $this->form_validation->set_rules('total_amount', 'Product Total Amount', '');
        $this->form_validation->set_rules('status', 'Inforamtion Status', '');

        $this->form_validation->set_rules('cus_name', 'Customer Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cus_email', 'Customer Email Address', 'trim|xss_clean');
        $this->form_validation->set_rules('contact_no', 'contact_no', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cus_address', 'Customer Address', 'trim|xss_clean');

        //'required'

        if ($this->form_validation->run() == FALSE) {
            // validation failed
            $data['allmaincategory'] = $this->Categorys->getAllMainCategory();
            $data['content'] = $this->Productsales->getProductsale($infoid);
            $data['customer_info'] = $this->Productsales->getCustomerInfo($infoid);
            $this->load->view('productsale/edit', $data);
        } else {
            $data['cid'] = $this->input->post('cid');
            $data['scid'] = $this->input->post('scid');
            $data['product_id'] = $this->input->post('product_id');

            $data['product_price'] = $this->input->post('product_price', TRUE);
            $data['quantity'] = $this->input->post('quantity', TRUE);
            $data['total_amount'] = $this->input->post('total_amount', TRUE);
            $data['sale_date'] = $this->input->post('sale_date', TRUE);
            $data['warranty_start'] = $this->input->post('warranty_start', TRUE);
            $data['warranty_end'] = $this->input->post('warranty_end', TRUE);

            $data['status'] = $this->input->post('status');

            // Customer Information
            $data_c['cus_name'] = $this->input->post('cus_name', TRUE);
            $data_c['cus_email'] = $this->input->post('cus_email', TRUE);
            $data_c['cus_address'] = $this->input->post('cus_address', TRUE);
            $data_c['contact_no'] = $this->input->post('contact_no', TRUE);

            // Account Table
            $data_a['product_id'] = $this->input->post('product_id');
            $data_a['credit'] = $this->input->post('total_amount', TRUE);
            $price_buy = $this->Products->getProductPrice($data_a['product_id']);
            $product_buy_price = $price_buy->price_buy;
            $data_a['debit'] = $product_buy_price * $data['quantity'];
            $data_a['balance'] = $data_a['credit'] - $data_a['debit'];

            // $product_id and $after_sell_in_stock save to the session and use in invoice function.
            $has_stock = $price_buy->in_stock;

            $product_stock = array(
                'product_id' => $data['product_id'],
                'after_sell_in_stock' => $has_stock - $data['quantity'],
            );

            $this->session->set_userdata($product_stock);


            $update = $this->Productsales->changeInfo($data, $infoid, $data_c, $data_a);

            if ($update) {

                $product_id = $data['product_id'];
                $product_details = $this->Products->getProduct($product_id);
                $name = $product_details->name;

                $msg = "Successfully Edit '{$name}' Product Sale ";
                $this->session->set_flashdata('name', $msg);
                redirect('productsale/checkout/' . $infoid);
            } else {
                $data['allmaincategory'] = $this->Categorys->getAllMainCategory();
                $data['content'] = $this->Productsales->getProductsale($infoid);
                $data['customer_info'] = $this->Productsales->getCustomerInfo($infoid);
                $this->load->view('productsale/edit', $data);
            }
        }

        // success add data into database
    }

    public function delete($did) {
        $did = trim($did);
        $data['status'] = '13';
        $change = $this->Productsales->UpdateInfo($data, $did);

        $content = $this->Productsales->getProductsale($did);

        $product_id = $content->product_id;
        $product_details = $this->Products->getProduct($product_id);
        $name = $product_details->name;

        if ($change) {

            $this->session->set_flashdata("name", "Delete Product Sale  '" . $name . "'  Succesfully");
            redirect('productsale/index');
        }
    }

    public function active($id) {
        $did = trim($id);
        $data['status'] = '1';

        $change = $this->Productsales->UpdateInfo($data, $did);
        $content = $this->Productsales->getProductsale($did);

        $product_id = $content->product_id;
        $product_details = $this->Products->getProduct($product_id);
        $name = $product_details->name;

        if ($change) {

            $this->session->set_flashdata("name", "Active Product Sale  '" . $name . "'  Succesfully");
            redirect('productsale/index');
        }
    }

    public function inactive($id) {

        $did = trim($id);
        $data['status'] = '0';

        $change = $this->Productsales->UpdateInfo($data, $did);
        $content = $this->Productsales->getProductsale($did);

        $product_id = $content->product_id;
        $product_details = $this->Products->getProduct($product_id);
        $name = $product_details->name;

        if ($change) {

            $this->session->set_flashdata("name", "Inactive Product Sale  '" . $name . "'  Succesfully");
            redirect('productsale/index');
        }
    }

    public function checkout($infoid) {

        $infoid = trim($infoid);

        $data['allmaincategory'] = $this->Categorys->getAllMainCategory();
        $data['content'] = $this->Productsales->getProductsale($infoid);
        $data['customer_info'] = $this->Productsales->getCustomerInfo($infoid);
        $this->load->view('productsale/checkout', $data);
    }

    public function invoice($infoid) {

        $infoid = trim($infoid);

        $data['allmaincategory'] = $this->Categorys->getAllMainCategory();
        $data['content'] = $this->Productsales->getProductsale($infoid);
        $data['customer_info'] = $this->Productsales->getCustomerInfo($infoid);
        $datas['invoice_id'] = date('ymd') . "AA" . $data['customer_info']->sale_id;

        // Get session data and save in to product table
        $product_id = $this->session->userdata('product_id');
        $data_p['in_stock'] = $this->session->userdata('after_sell_in_stock');

        $this->Products->changeProduct($data_p, $product_id);

        $change = $this->Productsales->UpdateInfo($datas, $infoid);

        $this->load->view('productsale/invoice', $data);
    }

    public function search($input) {

        $input = trim($input);
        $data['results'] = $this->Productsales->searchByinput($input);

        $this->load->view('productsale/result', $data);
    }

    public function view() {

        $data['allmaincategory'] = $this->Categorys->getAllMainCategory();
        $this->load->view('productsale/view', $data);
    }

}
