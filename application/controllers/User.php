<?php

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Model_user');
        $this->load->library('form_validation');
    }

    public function profile()
    {
        $data['title'] = 'POS - My profile';
        $data['row'] = $this->Model_user->get();
        $data['user'] = $this->fungsi->user_login();
        $this->template->load('template', 'user/my_profile', $data);
    }

    public function list()
    {
        $data['title'] = 'POS - User List';
        $data['row'] = $this->Model_user->get();
        $this->template->load('template', 'user/user_list', $data);
    }

    public function add()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required|is_unique[user.username]');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]', array('matches' => '%s tidak sesuai dengan password'));
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', '%s masih kosong,silahkan isi');
        $this->form_validation->set_message('is_unique', '%s sudah dipakai, silahkan ganti yang baru');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'POS - Add User';
            $this->template->load('template', 'user/user_add', $data);
        } else {
            $post = $this->input->post(null, true);
            $this->Model_user->add($post);
            if ($this->db->affected_rows() > 0) {
                echo "<script>alert('Berhasil tambah data');</script>";
                echo "<script>window.location = '" . site_url('user/list') . "';</script>";
            }
        }
    }


    public function edit($id)
    {
        $this->form_validation->set_rules('name', 'Nama', 'required|callback_name_check');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|callback_email_check');

        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'required|trim');
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]', array('matches' => '%s tidak sesuai dengan password'));
        }

        if ($this->input->post('password2')) {
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|matches[password]', array('matches' => '%s tidak sesuai dengan password'));
        }

        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');

        $this->form_validation->set_message('required', '%s masih kosong,silahkan isi');
        $this->form_validation->set_message('is_unique', '%s sudah dipakai, silahkan ganti yang baru');

        $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

        if ($this->form_validation->run() == false) {
            $query = $this->Model_user->get($id);
            if ($query->num_rows() > 0) {
                $data['title'] = 'POS - Edit User';
                $data['row'] = $query->row();
                $this->template->load('template', 'user/user_edit', $data);
            } else {
                echo "<script>alert('Data tidak ditemukan');";
                echo "window.location='" . site_url('user') . "';</script>";
            }
        } else {
            $post = $this->input->post(null, true);
            $this->Model_user->edit($post);
            if ($this->db->affected_rows() > 0) {
                echo "<script>alert('Data berhasil disimpan');</script>";
                echo "<script>window.location = '" . site_url('user/list') . "';</script>";
            }
        }
    }

    function name_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE username = '$post[name]'AND user_id !='$post[user_id]'");

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('name_check', '%s ini sudah dipakai, silahkan diganti');
            return false;
        } else {
            return true;
        }
    }

    function email_check()
    {
        $post = $this->input->post(null, TRUE);
        $query = $this->db->query("SELECT * FROM user WHERE email = '$post[email]'AND user_id !='$post[user_id]'");

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('email_check', '{field} ini sudah dipakai, silahkan diganti');
            return false;
        } else {
            return true;
        }
    }

    public function delete()
    {
        $id = $this->input->post('user_id');
        $this->Model_user->delete($id);

        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Berhasil hapus data');</script>";
            echo "<script>window.location = '" . site_url('user/list') . "';</script>";
        }
    }
}
