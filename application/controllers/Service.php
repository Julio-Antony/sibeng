<?php

class Service extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Model_service');
    }

    public function index()
    {
        $data['title'] = 'SIBENG - Service';
        $data['row'] = $this->Model_service->get();
        $this->template->load('template', 'service/service_data', $data);
    }

    public function add()
    {
        $service = new stdClass();
        $service->service_id = null;
        $service->service_name = null;
        $service->price = null;
        $data = array(
            'page' => 'Tambah',
            'title' => 'SIBENG - Tambah Data Service',
            'row' => $service
        );

        $this->template->load('template', 'service/service_form', $data);
    }

    public function edit($id)
    {
        $query = $this->Model_service->get($id);
        if ($query->num_rows() > 0) {
            $service = $query->row();
            $data = array(
                'page' => 'Edit',
                'title' => 'SIBENG - Edit Data Service',
                'row' => $service
            );
            $this->template->load('template', 'service/service_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('service') . "';</script>";
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['Tambah'])) {
            $this->Model_service->add($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
            redirect('service');
        } else if (isset($_POST['Edit'])) {
            $this->Model_service->edit($post);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Data berhasil disimpan');
            }
            redirect('service');
        }
    }

    public function delete($id)
    {
        $this->Model_service->delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('error', 'Data dihapus');
        }
        redirect('service');
    }
}
