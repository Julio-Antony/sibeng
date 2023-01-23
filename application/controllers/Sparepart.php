<?php

class Sparepart extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Model_product');
    }

    public function index()
    {
        $data['title'] = 'POS - Sparepart';
        $data['row'] = $this->Model_product->get_sparepart();
        $this->template->load('template', 'sparepart/sparepart_data', $data);
    }

    public function add()
    {
        $product = new stdClass();
        $product->product_id = null;
        $product->part_number = null;
        $product->product_name = null;
        $product->price = null;
        $product->stock = null;
        $data = array(
            'page' => 'Tambah',
            'title' => 'POS - Tambah Data Sparepart',
            'row' => $product
        );

        $this->template->load('template', 'sparepart/sparepart_form', $data);
    }

    public function edit($id)
    {
        $query = $this->Model_product->get_sparepart($id);
        if ($query->num_rows() > 0) {
            $product = $query->row();
            $data = array(
                'page' => 'Edit',
                'title' => 'POS - Edit Data Sparepart',
                'row' => $product
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
            if ($this->Model_product->check_partnumber($post['part_number'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Part Number $post[part_number] sudah dipakai sparepart lain");
                redirect('sparepart/add');
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->Model_product->add_sparepart($post);
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
                    $this->Model_product->add_sparepart($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('sparepart');
                }
            }
        } else if (isset($_POST['Edit'])) {
            if ($this->Model_product->check_partnumber($post['part_number'], $post['id'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Part Number $post[part_number] sudah dipakai sparepart lain");
                redirect('sparepart/edit/' . $post['id']);
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {

                        $item = $this->Model_product->get_sparepart($post['id'])->row();
                        if ($item->image != null) {
                            $target_file = './assets/dist/img/sparepart' . $item->image;
                            unlink($target_file);
                        }

                        $post['image'] = $this->upload->data('file_name');
                        $this->Model_product->edit_product($post);
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
                    $this->Model_product->edit_sparepart($post);
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
        $this->Model_product->delete_sparepart($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('error', 'Data dihapus');
        }
        redirect('sparepart');
    }
}
