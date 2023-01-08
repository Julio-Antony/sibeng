<?php

class Model_sparepart extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('sparepart');
        if ($id != null) {
            $this->db->where('sparepart_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'image' => $post['image'],
            'part_number' => $post['part_number'],
            'sparepart_name' => $post['sparepart_name'],
            'price' => $post['price'],
            'stock' => 0,
        ];
        $this->db->insert('sparepart', $params);
    }

    public function edit($post)
    {
        $params = [
            'part_number' => $post['part_number'],
            'sparepart_name' => $post['sparepart_name'],
            'price' => $post['price'],
            'updated' => date('Y-m-d H:i:s')
        ];
        if ($post['image'] != null) {
            $params['image'] = $post['image'];
        }
        $this->db->where('sparepart_id', $post['id']);
        $this->db->update('sparepart', $params);
    }

    public function delete($id)
    {
        $this->db->where('sparepart_id', $id);
        $this->db->delete('sparepart');
    }

    function check_partnumber($code, $id = null)
    {
        $this->db->from('sparepart');
        $this->db->where('part_number', $code);
        if ($id != null) {
            $this->db->where('sparepart_id !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    function update_stock_in($data)
    {
        $qty = $data['qty'];
        $id = $data['sparepart_id'];
        $sql = "UPDATE sparepart SET stock = stock + '$qty' WHERE sparepart_id = '$id'";
        $this->db->query($sql);
    }
}
