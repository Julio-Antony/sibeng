<?php

class Stock extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['model_product', 'model_supplier', 'model_stock']);
    }

    public function stock_in_data()
    {
        $data['title'] = 'POS - Stock In';
        $data['row'] = $this->model_stock->get_stock_in()->result();
        $this->template->load('template', 'stock/stock_in', $data);
    }

    public function stock_in_add()
    {
        $item = $this->model_product->get_item()->result();
        $supplier = $this->model_supplier->get()->result();
        $data = [
            'item' => $item,
            'supplier' => $supplier,
            'title' => 'POS - Add Stock in'
        ];
        $this->template->load('template', 'stock/stock_in_form', $data);
    }

    public function process()
    {
        if (isset($_POST['in_add'])) {
            $post = $this->input->post(null, TRUE);
            $this->model_stock->add_stock_in($post);
            $this->model_product->update_stock_in($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
            redirect('stock/stock_in_data');
        }
    }

    public function stock_in_delete()
    {
        $stock_id = $this->uri->segment(3);
        $item_id = $this->uri->segment(4);
        $qty = $this->model_stock->get($stock_id)->row()->qty;
        $data = [
            'qty' => $qty,
            'item_id' => $item_id
        ];
        $this->model_product->update_stock_out($data);
        $this->model_stock->delete_stock($stock_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('stock/stock_in_data');
    }

    public function stock_out()
    {
        $data['title'] = 'POS - Stock Out';
        $data['row'] = $this->model_stock->get_stock_out()->result();
        $this->template->load('template', 'stock/stock_out', $data);
    }

    public function stock_out_add()
    {
        $item = $this->model_product->get_item()->result();
        $supplier = $this->model_supplier->get()->result();
        $data = [
            'item' => $item,
            'supplier' => $supplier,
            'title' => 'POS - Add Stock Out'
        ];
        $this->template->load('template', 'stock/stock_out_form', $data);
    }

    public function process_stock_out()
    {
        if (isset($_POST['in_add'])) {
            $post = $this->input->post(null, TRUE);
            $this->model_stock->add_stock_out($post);
            $this->model_product->update_stock_out($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
            redirect('stock/stock_out');
        }
    }

    public function stock_out_delete()
    {
        $stock_id = $this->uri->segment(3);
        $item_id = $this->uri->segment(4);
        $qty = $this->model_stock->get($stock_id)->row()->qty;
        $data = [
            'qty' => $qty,
            'item_id' => $item_id
        ];
        $this->model_product->update_stock_in($data);
        $this->model_stock->delete_stock($stock_id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
        }
        redirect('stock/stock_out');
    }
}
