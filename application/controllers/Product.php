<?php

class Product extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        check_admin();
        $this->load->model('model_product');
    }

    function get_ajax()
    {
        $list = $this->model_product->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->image != null ? '<img src="' . base_url('assets/dist/img/product/' . $item->image) . '" class="img" style="width:100px">' : null;
            $row[] = $item->barcode . '<br><a href="' . site_url('item/barcode_qrcode/' . $item->item_id) . '" class="btn btn-default btn-xs">Generate <i class="fa fa-barcode"></i></a>';
            $row[] = $item->item_name;
            $row[] = $item->category_name;
            $row[] = indo_currency($item->price);
            $row[] = $item->stock;
            // $row[] = '<a href="' . site_url('product/edit_item/' . $item->item_id) . '" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
            //         <a href="' . site_url('product/delete_item/' . $item->item_id) . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
            $row[] = '<a href="' . site_url('product/delete_item/' . $item->item_id) . '" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';

            $row[] = $item->unit_name;
            // add html for action
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->model_product->count_all(),
            "recordsFiltered" => $this->model_product->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function index()
    {
        $data['title'] = 'POS - Category';
        $data['row'] = $this->model_product->get_category();
        $this->template->load('template', 'product/product_category', $data);
    }

    public function add_category()
    {
        $category = new stdClass();
        $category->category_id = null;
        $category->category_name = null;
        $data = array(
            'page' => 'add',
            'title' => 'POS - Add Category',
            'row' => $category
        );

        $this->template->load('template', 'product/product_category_form', $data);
    }

    public function edit_category($id)
    {
        $query = $this->model_product->get_category($id);
        if ($query->num_rows() > 0) {
            $category = $query->row();
            $data = array(
                'page' => 'edit',
                'title' => 'Edit Category',
                'row' => $category
            );
            $this->template->load('template', 'product/product_category_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('product') . "';</script>";
        }
    }

    public function process_category()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->model_product->add_category($post);
        } else if (isset($_POST['edit'])) {
            $this->model_product->edit_category($post);
        }

        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Berhasil simpan data');</script>";
        }
        echo "<script>window.location = '" . site_url('product') . "';</script>";
    }

    public function delete_category($id)
    {
        $this->model_product->delete_category($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Berhasil hapus data');</script>";
        }
        echo "<script>window.location = '" . site_url('product') . "';</script>";
    }

    public function unit()
    {
        $data['title'] = 'POS - Unit';
        $data['row'] = $this->model_product->get_unit();
        $this->template->load('template', 'product/product_unit', $data);
    }

    public function add_unit()
    {
        $unit = new stdClass();
        $unit->unit_id = null;
        $unit->unit_name = null;
        $data = array(
            'page' => 'add',
            'title' => 'POS - Add Unit',
            'row' => $unit
        );

        $this->template->load('template', 'product/product_unit_form', $data);
    }

    public function edit_unit($id)
    {
        $query = $this->model_product->get_unit($id);
        if ($query->num_rows() > 0) {
            $unit = $query->row();
            $data = array(
                'page' => 'edit',
                'title' => 'POS - Edit Unit',
                'row' => $unit
            );
            $this->template->load('template', 'product/product_unit_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('product/unit') . "';</script>";
        }
    }

    public function process_unit()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            $this->model_product->add_unit($post);
        } else if (isset($_POST['edit'])) {
            $this->model_product->edit_unit($post);
        }

        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Berhasil simpan data');</script>";
        }
        echo "<script>window.location = '" . site_url('product/unit') . "';</script>";
    }

    public function delete_unit($id)
    {
        $this->model_product->delete_unit($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Berhasil hapus data');</script>";
        }
        echo "<script>window.location = '" . site_url('product/unit') . "';</script>";
    }

    public function item()
    {
        $data['title'] = 'POS - Product';
        $data['row'] = $this->model_product->get_item();
        $this->template->load('template', 'product/product_item', $data);
    }

    public function add_item()
    {
        $item = new stdClass();
        $item->item_id = null;
        $item->image = null;
        $item->barcode = null;
        $item->item_name = null;
        $item->price = null;

        $query_category = $this->model_product->get_category();
        $query_unit = $this->model_product->get_unit();

        $kategori['null'] = '- Choose Category -';
        foreach ($query_category->result() as $ktg) {
            $kategori[$ktg->category_id] = $ktg->category_name;
        }

        $satuan['null'] = '- Choose Unit -';
        foreach ($query_unit->result() as $unt) {
            $satuan[$unt->unit_id] = $unt->unit_name;
        }

        $data = array(
            'page' => 'add',
            'title' => 'POS - Add Product',
            'row' => $item,
            'category' => $kategori, 'selectedcategory' => null,
            'unit' => $satuan, 'selectedunit' => null,
        );

        $this->template->load('template', 'product/product_item_form', $data);
    }

    public function edit_item($id)
    {
        $query = $this->model_product->get_item($id);
        if ($query->num_rows() > 0) {
            $item = $query->row();
            $query_category = $this->model_product->get_category();

            $query_unit = $this->model_product->get_unit();
            $satuan['null'] = '- Choose Unit -';
            foreach ($query_unit->result() as $unt) {
                $satuan[$unt->unit_id] = $unt->unit_name;
            }

            $data = array(
                'page' => 'edit',
                'title' => 'POS - Edit Item',
                'row' => $item,
                'category' => $query_category,
                'unit' => $satuan,
                'selectedunit' => $item->unit_id,
            );
            $this->template->load('template', 'product/product_item_form', $data);
        } else {
            echo "<script>alert('Data tidak ditemukan');";
            echo "window.location='" . site_url('product/item') . "';</script>";
        }
    }

    public function process_item()
    {
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['upload_path'] = './assets/dist/img/product';
        $config['file_name'] = 'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            if ($this->model_product->check_barcode($post['barcode'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Barcode <strong>$post[barcode]</strong> sudah dipakai barang lain");
                redirect('product/add_item/');
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->model_product->add_item($post);

                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect('product/item');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('product/add_item');
                    }
                } else {
                    $post['image'] = null;
                    $this->model_product->add_item($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('product/item');
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->model_product->check_barcode($post['barcode'], $post['id'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Barcode <strong>$post[barcode]</strong> sudah dipakai barang lain");
                redirect('product/edit_item/' . $post['id']);
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {

                        $item = $this->model_product->get_item($post['id'])->row();
                        if ($item->image != null) {
                            $target_file = './assets/dist/img/product/' . $item->image;
                            unlink($target_file);
                        }

                        $post['image'] = $this->upload->data('file_name');
                        $this->model_product->edit_item($post);

                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data berhasil disimpan');
                        }
                        redirect('product/item');
                    } else {
                        $error = $this->upload->display_error();
                        $this->session->set_flashdata('error', $error);
                        redirect('product/edit_item');
                    }
                } else {
                    $post['image'] = null;
                    $this->model_product->edit_item($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data berhasil disimpan');
                    }
                    redirect('product/edit_item');
                }
            }
        }
    }

    function barcode_generator($id)
    {
        $data['title'] = 'POS - Barcode Generator';
        $data['row'] = $this->model_product->get_item($id)->row();
        $this->template->load('template', 'product/barcode', $data);
    }

    function print_barcode($id)
    {
        $data['row'] = $this->model_product->get_item($id)->row();
        $html = $this->load->view('product/print_barcode', $data, true);
        $this->fungsi->pdf_generator($html, 'barcode-' . $data['row']->barcode, 'A4', 'landscape');
    }

    function print_qrcode($id)
    {
        $data['row'] = $this->model_product->get_item($id)->row();
        $html = $this->load->view('product/print_qrcode', $data, true);
        $this->fungsi->pdf_generator($html, 'barcode-' . $data['row']->barcode, 'A4', 'potrait');
    }

    public function delete_item($id)
    {
        $item = $this->model_product->get_item($id)->row();
        if ($item->image != null) {
            $target_file = './assets/dist/img/product/' . $item->image;
            unlink($target_file);
        }

        $this->model_product->delete_item($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Berhasil hapus data');</script>";
        }
        echo "<script>window.location = '" . site_url('product/item') . "';</script>";
    }
}
