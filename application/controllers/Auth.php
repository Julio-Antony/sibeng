<?php

class Auth extends CI_Controller
{

    public function index()
    {
        check_already_login();
        $this->load->view('auth/login');
    }

    public function login()
    {
        $post = $this->input->post(null, TRUE);
        if (isset($post['login'])) {
            $this->load->model('Model_user');
            $query = $this->Model_user->login($post);
            if ($query->num_rows() > 0) {
                $row = $query->row();
                $params = array(
                    'userid' => $row->user_id,
                    'level' => $row->level
                );
                $this->session->set_userdata($params);
                echo "<script>
                    alert('selamat,anda berhasil login');
                    window.location= '" . site_url('dashboard') . "';
                </script>";
            } else {
                echo "<script>
                    alert('login gagal');
                    window.location= '" . site_url('auth') . "';
                </script>";
            }
        }
    }

    public function logout()
    {
        $params = array('userid', 'level');
        $this->session->unset_userdata($params);
        redirect('auth');
    }
}
