<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends CI_Controller {

    public $poweruser;
    public $modpermit;
    private $modid = 4;

    public function __construct() {
        parent::__construct();

        $this->load->model('Userauth');
        $this->load->model('Categorys');
        $this->load->model('Products');
        $this->load->model('Reports');

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
        $this->load->view('report/index');
    }

    public function search() {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('from_date', 'From Date', 'trim|xss_clean');
        $this->form_validation->set_rules('to_date', 'To Date', 'trim|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            // validation failed
            $this->load->view('report/index');
        } else {
            $input1 = $this->input->post('from_date');
            $input2 = $this->input->post('to_date');

            //Set from date and to date in session for PDF USE
            $this->session->set_userdata('from_date', $input1);
            $this->session->set_userdata('to_date', $input2);

            $data['content'] = $this->Reports->searchByinput($input1, $input2);
            $this->load->view('report/search_result', $data);
        }
    }

    public function pdf() {
        // Load all views as normal

        $data['from_date'] = $this->session->userdata('from_date');
        $data['to_date'] = $this->session->userdata('to_date');
        $data['content'] = $this->Reports->searchByinput($data['from_date'], $data['to_date']);

        $this->load->view('report/pdf', $data);

        // Get output html
        $html = $this->output->get_output();

        // Load library
        $this->load->library('dompdf_gen');

        // Convert to PDF
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $file_name = "Report-" . date("Y-m-d:h:i:s");
        $this->dompdf->stream($file_name);
    }

    public function csv() {
        $data['from_date'] = $this->session->userdata('from_date');
        $data['to_date'] = $this->session->userdata('to_date');
        $content = $this->Reports->searchByinput($data['from_date'], $data['to_date']);


        $text_data = "Invoice ID, Product Name, Sale Date, Quantity, Buy (Total), Sale (Total), Credit  \r\n\r\n";

        $final = $tproduct = $tsel = $tbuy = 0;
        foreach ($content as $row) {

            // product_name
            $product_id = $row['product_id'];
            $product_details = $this->Products->getProduct($product_id);
            $product_name = $product_details->name;

            //Quantity
            $quantity = $row['quantity'];

            //total buy
            $product_details = $this->Products->getProduct($product_id);
            $total_buy = $product_details->price_buy * $quantity;

            //total sell
            $total_sel = $row['total_amount'];

            $credit = $total_sel - $total_buy;

            $final += $total_sel - $total_buy;
            $tproduct += $quantity;
            $tbuy += $total_buy;
            $tsel += $total_sel;

            $text_data .= $row['invoice_id'] . "," . $product_name . "," . $row['sale_date'] . "," . $quantity . "," . $total_buy . "," . $total_sel . "," . $credit . "\r\n";
        }

        $text_data .= "Total, , ," . $tproduct . "," . $tbuy . "," . $tsel . "," . $final . "\r\n";

        $this->load->helper('download');
        force_download('report.csv', $text_data);
    }

}
