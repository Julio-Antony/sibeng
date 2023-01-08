<?php

class Model_service extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('service');
        if ($id != null) {
            $this->db->where('service_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'service_name' => $post['service_name'],
            'price' => $post['price'],
        ];
        $this->db->insert('service', $params);
    }

    public function edit($post)
    {
        $params = [
            'service_name' => $post['service_name'],
            'price' => $post['price'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('service_id', $post['id']);
        $this->db->update('service', $params);
    }

    public function delete($id)
    {
        $this->db->where('service_id', $id);
        $this->db->delete('service');
    }
}
