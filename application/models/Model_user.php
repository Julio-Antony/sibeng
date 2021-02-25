<?php

class Model_user extends CI_Model
{
    public function login($post)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('email', $post['email']);
        $this->db->where('password', sha1($post['password']));
        $query = $this->db->get();
        return $query;
    }

    public function get($id = null)
    {
        $this->db->from('user');
        if ($id != null) {
            $this->db->where('user_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {

        $params['username'] = $post['name'];
        $params['email'] = $post['email'];
        $params['password'] = sha1($post['password']);
        $params['image'] = 'avatar.png';
        $params['address'] = $post['address'];
        $params['level'] = $post['level'];

        $this->db->insert('user', $params);
    }

    public function edit($post)
    {

        $params['username'] = $post['name'];
        $params['email'] = $post['email'];
        if (!empty($post['password'])) {
            $params['password'] = sha1($post['password']);
        }
        $params['address'] = $post['address'];
        $params['level'] = $post['level'];

        $this->db->where('user_id', $post['user_id']);
        $this->db->update('user', $params);
    }

    public function delete($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('user');
    }
}
