<?php

class Customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('Model_customer');
    }

    public function index()
    {
        $data['title'] = 'POS - Customer';
        $data['row'] = $this->Model_customer->get();
        $this->template->load('template', 'customer/customer_data', $data);
    }

    public function add()
    {
        $customer = new stdClass();
        $customer->customer_id = null;
        $customer->gender = null;
        $customer->customer_name = null;
        $customer->phone = null;
        $customer->address = null;
        $data = array(
            'page' => 'add',
            'title' => 'POS - Add Customer',
            'row' => $customer
        );

        $this->template->load('template', 'customer/customer_form', $data);
    }

    public function edit($id)
    {
        $query = $this->Model_customer->get($id);
        if ($query->num_rows() > 0) {
            $customer = $query->row();
            $data = array(
                'page' => 'edit',
                'title' => 'POS - Edit Customer',
                'row' => $customer
            );
            $this->template->load('template', 'customer/customer_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('customer') . "';</script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->Model_customer->add($post);
        } else if (isset($_POST['edit'])) {
            $this->Model_customer->edit($post);
        }

        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Berhasil simpan data');</script>";
        }
        echo "<script>window.location = '" . site_url('customer') . "';</script>";
    }

    public function delete($id)
    {
        $this->Model_customer->delete($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Berhasil hapus data');</script>";
        }
        echo "<script>window.location = '" . site_url('customer') . "';</script>";
    }
}
