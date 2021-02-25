<?php

class Supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('Model_supplier');
    }

    public function index()
    {
        $data['title'] = 'POS - Supplier';
        $data['row'] = $this->Model_supplier->get();
        $this->template->load('template', 'supplier/supplier_data', $data);
    }

    public function add()
    {
        $supplier = new stdClass();
        $supplier->supplier_id = null;
        $supplier->supplier_name = null;
        $supplier->phone = null;
        $supplier->description = null;
        $supplier->address = null;
        $data = array(
            'page' => 'add',
            'title' => 'POS - Add Supplier',
            'row' => $supplier
        );

        $this->template->load('template', 'supplier/supplier_form', $data);
    }

    public function edit($id)
    {
        $query = $this->Model_supplier->get($id);
        if ($query->num_rows() > 0) {
            $supplier = $query->row();
            $data = array(
                'page' => 'edit',
                'title' => 'POS - Edit Supplier',
                'row' => $supplier
            );
            $this->template->load('template', 'supplier/supplier_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('supplier') . "';</script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->Model_supplier->add($post);
        } else if (isset($_POST['edit'])) {
            $this->Model_supplier->edit($post);
        }

        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Berhasil simpan data');</script>";
        }
        echo "<script>window.location = '" . site_url('supplier') . "';</script>";
    }

    public function delete($id)
    {
        $this->Model_supplier->delete($id);
        $error = $this->db->error();
        if ($error['code'] != 0) {
            echo "<script>alert('Data tidak boleh dihapus !!!');</script>";
        } else {
            echo "<script>alert('Berhasil hapus data');</script>";
        }
        echo "<script>window.location = '" . site_url('supplier') . "';</script>";
    }
}
