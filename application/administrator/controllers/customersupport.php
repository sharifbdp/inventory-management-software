<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customersupport extends CI_Controller {

    public $poweruser;
    public $modpermit;
    private $modid = 5;

    public function __construct() {
        parent::__construct();

        $this->load->model('Userauth');
        $this->load->model('Users');
        $this->load->model('Products');
        $this->load->model('Categorys');
        $this->load->model('Productsales');
        $this->load->model('Customersupports');

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

        $config['base_url'] = base_url() . 'customersupport/index';
        $config['total_rows'] = $this->Customersupports->totalCustomersupport();
        $config['per_page'] = 20;

        $this->pagination->initialize($config);

        $data['content'] = $this->Customersupports->getAllCustomersupport($config['per_page'], $this->uri->segment(3));

        $this->load->view('customersupport/index', $data);
    }

    public function addproblem($infoid) {

        $infoid = trim($infoid);

        $this->load->library('form_validation');

        $this->form_validation->set_rules('problem', 'problem specification', 'required|xss_clean');
        $this->form_validation->set_rules('eng_id', 'Select Engineer', 'required|xss_clean');
        $this->form_validation->set_rules('return_date', 'device return date', 'required|xss_clean');
        $this->form_validation->set_rules('total_amount', 'total payable amount', 'trim|required|xss_clean');

        $this->form_validation->set_rules('cus_name', 'Customer Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cus_email', 'Customer Email Address', 'trim|xss_clean');
        $this->form_validation->set_rules('contact_no', 'contact_no', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cus_address', 'Customer Address', 'trim|xss_clean');

        $datas['customer_info'] = $this->Customersupports->getCustomerInfo($infoid);
        //'required'

        if ($this->form_validation->run() == FALSE) {
            // validation failed
            $datas['content'] = $this->Productsales->getProductsale($infoid);

            $this->load->view('customersupport/addproblem', $datas);
        } else {
            $data['customer_id'] = $datas['customer_info']->id;
            $data['problem'] = $this->input->post('problem');
            $data['eng_id'] = $this->input->post('eng_id');
            $data['return_date'] = $this->input->post('return_date');
            $data['total_amount'] = $this->input->post('total_amount', TRUE);

            // Customer Information
            $data['cus_name'] = $this->input->post('cus_name', TRUE);
            $data['cus_email'] = $this->input->post('cus_email', TRUE);
            $data['cus_address'] = $this->input->post('cus_address', TRUE);
            $data['contact_no'] = $this->input->post('contact_no', TRUE);
            $data['status'] = $this->input->post('status');

            $data['last_action_date'] = date('Y-m-d h:i:s');
            $data['last_action_user'] = $this->session->userdata('uid');

            $update = $this->Customersupports->insertCustomersupport($data);

            if ($update) {
                $last_id = $this->db->insert_id();

                $msg = "Successfully Add Device Problem.";
                $this->session->set_flashdata('name', $msg);
                redirect('customersupport/checkout/' . $last_id);
            } else {
                $data['content'] = $this->Customersupports->getCustomersupport($infoid);
                $data['customer_info'] = $this->Customersupports->getCustomerInfo($infoid);
                $this->load->view('customersupport/addproblem', $data);
            }
        }

        // success add data into database
    }

    public function edit($infoid) {

        $infoid = trim($infoid);

        $this->load->library('form_validation');

        $this->form_validation->set_rules('problem', 'problem specification', 'required|xss_clean');
        $this->form_validation->set_rules('eng_id', 'Select Engineer', 'required|xss_clean');
        $this->form_validation->set_rules('return_date', 'device return date', 'required|xss_clean');
        $this->form_validation->set_rules('total_amount', 'total payable amount', 'trim|required|xss_clean');

        $this->form_validation->set_rules('cus_name', 'Customer Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cus_email', 'Customer Email Address', 'trim|xss_clean');
        $this->form_validation->set_rules('contact_no', 'contact_no', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cus_address', 'Customer Address', 'trim|xss_clean');

        //'required'

        if ($this->form_validation->run() == FALSE) {
            // validation failed

            $data['product_sale'] = $this->Productsales->getProductsale($infoid);
            $data['content'] = $this->Customersupports->getCustomersupport($infoid);
            $this->load->view('customersupport/edit', $data);
        } else {
            //$data['customer_id'] = $datas['customer_info']->id;
            $data['problem'] = $this->input->post('problem');
            $data['eng_id'] = $this->input->post('eng_id');
            $data['return_date'] = $this->input->post('return_date');
            $data['total_amount'] = $this->input->post('total_amount', TRUE);

            // Customer Information
            $data['cus_name'] = $this->input->post('cus_name', TRUE);
            $data['cus_email'] = $this->input->post('cus_email', TRUE);
            $data['cus_address'] = $this->input->post('cus_address', TRUE);
            $data['contact_no'] = $this->input->post('contact_no', TRUE);
            $data['status'] = $this->input->post('status');

            $update = $this->Customersupports->changeInfo($data, $infoid);

            if ($update) {

                $msg = "Successfully Add Device Problem.";
                $this->session->set_flashdata('name', $msg);
                redirect('customersupport/checkout/' . $infoid);
            } else {
                $data['content'] = $this->Customersupports->getCustomersupport($infoid);
                $this->load->view('customersupport/addproblem', $data);
            }
        }

        // success add data into database
    }

    public function delete($did) {
        $did = trim($did);
        $data['status'] = '13';
        $change = $this->Customersupports->UpdateInfo($data, $did);

        $content = $this->Customersupports->getCustomersupport($did);

        $product_id = $content->product_id;
        $product_details = $this->Products->getProduct($product_id);
        $name = $product_details->name;

        if ($change) {

            $this->session->set_flashdata("name", "Delete Product Sale  '" . $name . "'  Succesfully");
            redirect('customersupport/index');
        }
    }

    public function active($id) {
        $did = trim($id);
        $data['status'] = '1';

        $change = $this->Customersupports->UpdateInfo($data, $did);
        $content = $this->Customersupports->getCustomersupport($did);

        $product_id = $content->product_id;
        $product_details = $this->Products->getProduct($product_id);
        $name = $product_details->name;

        if ($change) {

            $this->session->set_flashdata("name", "Active Product Sale  '" . $name . "'  Succesfully");
            redirect('customersupport/index');
        }
    }

    public function inactive($id) {

        $did = trim($id);
        $data['status'] = '0';

        $change = $this->Customersupports->UpdateInfo($data, $did);
        $content = $this->Customersupports->getCustomersupport($did);

        $product_id = $content->product_id;
        $product_details = $this->Products->getProduct($product_id);
        $name = $product_details->name;

        if ($change) {

            $this->session->set_flashdata("name", "Inactive Product Sale  '" . $name . "'  Succesfully");
            redirect('customersupport/index');
        }
    }

    public function checkout($infoid) {

        $infoid = trim($infoid);

        $data['content'] = $this->Customersupports->getCustomersupport($infoid);
        $this->load->view('customersupport/checkout', $data);
    }

    public function invoice($infoid) {

        $infoid = trim($infoid);

        $data['content'] = $this->Customersupports->getCustomersupport($infoid);
        $datas['invoice_id'] = date('ymd') . "AA" . $data['content']->id;

        $change = $this->Customersupports->UpdateInfo($datas, $infoid);

        $this->load->view('customersupport/invoice', $data);
    }

    public function search($input) {

        $input = trim($input);

        $data['results'] = $this->Customersupports->searchByinput($input);

        $this->load->view('customersupport/result', $data);
    }

    public function view($infoid) {

        $infoid = trim($infoid);
        $data['content'] = $this->Customersupports->getCustomersupport($infoid);

        $this->load->library('form_validation');

        $this->form_validation->set_rules('eng_comments', 'Engineer Comments', 'xss_clean');
        $this->form_validation->set_rules('status', 'Support Status', 'required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            // validation failed
            $this->load->view('customersupport/view', $data);
        } else {
            $ds['eng_comments'] = $this->input->post('eng_comments', TRUE);
            $ds['status'] = $this->input->post('status', TRUE);

            $update = $this->Customersupports->changeInfo($ds, $infoid);

            if ($update) {
                $msg = "Successfully Update Customer Support (<strong>{$data['content']->invoice_id}</strong>).";
                $this->session->set_flashdata('name', $msg);
                redirect('customersupport');
            } else {
                $this->load->view('customersupport/view', $data);
            }
        }
    }

}
