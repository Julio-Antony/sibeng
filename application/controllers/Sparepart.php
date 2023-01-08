<?php

class Sparepart extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Model_sparepart');
    }

    public function index()
    {
        $data['title'] = 'POS - Sparepart';
        $data['row'] = $this->Model_sparepart->get();
        $this->template->load('template', 'sparepart/sparepart_data', $data);
    }

    public function add()
    {
        $sparepart = new stdClass();
        $sparepart->sparepart_id = null;
        $sparepart->part_number = null;
        $sparepart->sparepart_name = null;
        $sparepart->price = null;
        $sparepart->stock = null;
        $data = array(
            'page' => 'Tambah',
            'title' => 'POS - Tambah Data Sparepart',
            'row' => $sparepart
        );

        $this->template->load('template', 'sparepart/sparepart_form', $data);
    }

    public function edit($id)
    {
        $query = $this->Model_sparepart->get($id);
        if ($query->num_rows() > 0) {
            $sparepart = $query->row();
            $data = array(
                'page' => 'Edit',
                'title' => 'POS - Edit Data Sparepart',
                'row' => $sparepart
            );
            $this->template->load('template', 'sparepart/sparepart_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('supplier') . "';</script>";
        }
    }

    public function process()
    {
        $config['upload_path']    = './assets/dist/img/sparepart';
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['max_size']       = 2048;
        $config['file_name']      = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null, TRUE);
        if (isset($_POST['Tambah'])) {
            if ($this->Model_sparepart->check_partnumber($post['part_number'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Part Number $post[part_number] sudah dipakai sparepart lain");
                redirect('sparepart/add');
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->Model_sparepart->add($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect('sparepart');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('sparepart/add');
                    }
                } else {
                    $post['image'] = null;
                    $this->Model_sparepart->add($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('sparepart');
                }
            }
        } else if (isset($_POST['Edit'])) {
            if ($this->Model_sparepart->check_partnumber($post['barcode'], $post['id'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Part Number $post[part_number] sudah dipakai sparepart lain");
                redirect('sparepart/edit/' . $post['id']);
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {

                        $item = $this->Model_sparepart->get($post['id'])->row();
                        if ($item->image != null) {
                            $target_file = './assets/dist/img/sparepart' . $item->image;
                            unlink($target_file);
                        }

                        $post['image'] = $this->upload->data('file_name');
                        $this->Model_sparepart->edit($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect('sparepart');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('sparepart/edit');
                    }
                } else {
                    $post['image'] = null;
                    $this->Model_sparepart->edit($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('sparepart');
                }
            }
        }
    }

    public function delete($id)
    {
        $this->Model_sparepart->delete($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('danger', 'Data dihapus');
        }
        redirect('sparepart');
    }
}
