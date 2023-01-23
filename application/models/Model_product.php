<?php

class Model_product extends CI_Model
{
    public function get_sparepart($id = null)
    {
        $this->db->from('product');
        $this->db->where('category', 'sparepart');
        if ($id != null) {
            $this->db->where('product_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add_sparepart($post)
    {
        $params = [
            'image' => $post['image'],
            'part_number' => $post['part_number'],
            'category' => 'sparepart',
            'product_name' => $post['product_name'],
            'price' => $post['price'],
            'stock' => 0,
        ];
        $this->db->insert('product', $params);
    }

    public function edit_sparepart($post)
    {
        $params = [
            'part_number' => $post['part_number'],
            'product_name' => $post['product_name'],
            'price' => $post['price'],
            'updated' => date('Y-m-d H:i:s')
        ];
        if ($post['image'] != null) {
            $params['image'] = $post['image'];
        }
        $this->db->where('product_id', $post['id']);
        $this->db->update('product', $params);
    }

    public function delete_sparepart($id)
    {
        $this->db->where('product_id', $id);
        $this->db->delete('product');
    }

    function check_partnumber($code, $id = null)
    {
        $this->db->from('product');
        $this->db->where('part_number', $code);
        if ($id != null) {
            $this->db->where('product_id !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    function update_stock_in($data)
    {
        $qty = $data['qty'];
        $id = $data['product_id'];
        $sql = "UPDATE product SET stock = stock + '$qty' WHERE product_id = '$id'";
        $this->db->query($sql);
    }

    function update_stock_out($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];
        $sql = "UPDATE product SET stock = stock - '$qty' WHERE product_id = '$id'";
        $this->db->query($sql);
    }

    public function get_service($id = null)
    {
        $this->db->from('product');
        $this->db->where('category', 'service');
        if ($id != null) {
            $this->db->where('product_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add_service($post)
    {
        $params = [
            'category' => 'service',
            'product_name' => $post['product_name'],
            'price' => $post['price'],
        ];
        $this->db->insert('product', $params);
    }

    public function edit_service($post)
    {
        $params = [
            'product_name' => $post['product_name'],
            'price' => $post['price'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('product_id', $post['id']);
        $this->db->update('product', $params);
    }

    public function delete_service($id)
    {
        $this->db->where('product_id', $id);
        $this->db->delete('product');
    }
}
