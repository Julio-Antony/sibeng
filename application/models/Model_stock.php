<?php

class Model_stock extends CI_Model
{
    public function get($id = null)
    {
        $this->db->from('stock');
        if ($id != null) {
            $this->db->where('stock_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_stock_in()
    {
        $this->db->select('stock.stock_id, product_item.barcode, product_item.image, product_item.item_name as item_name,
        qty, date, detail, supplier.supplier_name as supplier_name, product_item.item_id');
        $this->db->from('stock');
        $this->db->join('product_item', 'stock.item_id = product_item.item_id');
        $this->db->join('supplier', 'stock.supplier_id = supplier.supplier_id', 'left');
        $this->db->where('type', 'in');
        $this->db->order_by('stock_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function add_stock_in($post)
    {
        $params = [
            'item_id' => $post['item_id'],
            'type' => 'in',
            'detail' => $post['detail'],
            'supplier_id' => $post['supplier'] == '' ? null : $post['supplier'],
            'qty' => $post['qty'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('userid')
        ];
        $this->db->insert('stock', $params);
    }

    public function edit_stock($post)
    {
        $params = [
            'stock_name' => $post['stock_name'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('stock_id', $post['id']);
        $this->db->update('stock', $params);
    }

    public function delete_stock($id)
    {
        $this->db->where('stock_id', $id);
        $this->db->delete('stock');
    }

    public function get_stock_out()
    {
        $this->db->select('stock.stock_id, product_item.barcode, product_item.image, product_item.item_name as item_name,
        qty, date, detail, supplier.supplier_name as supplier_name, product_item.item_id');
        $this->db->from('stock');
        $this->db->join('product_item', 'stock.item_id = product_item.item_id');
        $this->db->join('supplier', 'stock.supplier_id = supplier.supplier_id', 'left');
        $this->db->where('type', 'out');
        $this->db->order_by('stock_id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    public function add_stock_out($post)
    {
        $params = [
            'item_id' => $post['item_id'],
            'type' => 'out',
            'detail' => $post['detail'],
            'supplier_id' => $post['supplier'] == '' ? null : $post['supplier'],
            'qty' => $post['qty'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('userid')
        ];
        $this->db->insert('stock', $params);
    }

    public function edit_stock_out($post)
    {
        $params = [
            'stock_name' => $post['stock_name'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('stock_id', $post['id']);
        $this->db->update('stock', $params);
    }

    public function delete_stock_out($id)
    {
        $this->db->where('stock_id', $id);
        $this->db->delete('stock');
    }
}
