<?php

class Report extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('model_transaction');
    }

    public function sales_report()
    {
        $data['row'] = $this->model_transaction->get_sale();
        $data['title'] = 'POS - Report';
        $this->template->load('template', 'report/sales_report', $data);
    }

    public function sales_detail($sales_id = null)
    {
        $detail = $this->model_transaction->get_sale_detail($sales_id)->result();
        echo json_encode($detail);
    }
}
