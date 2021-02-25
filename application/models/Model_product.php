<?php

class Model_product extends CI_Model
{
    // start datatables
    var $column_order = array(null, 'barcode', 'item_name', 'category_name', 'unit_name', 'price', 'stock'); //set column field database for datatable orderable
    var $column_search = array('barcode', 'item_name', 'price'); //set column field database for datatable searchable
    var $order = array('item_id' => 'asc'); // default order 

    private function _get_datatables_query()
    {
        $this->db->select('product_item.*, category_name, unit_name');
        $this->db->from('product_item');
        $this->db->join('product_category', 'product_item.category_id = product_category.category_id');
        $this->db->join('product_unit', 'product_item.unit_id = product_unit.unit_id');
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if (@$_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all()
    {
        $this->db->from('product_item');
        return $this->db->count_all_results();
    }
    // end datatables

    public function get_category($id = null)
    {
        $this->db->from('product_category');
        if ($id != null) {
            $this->db->where('category_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add_category($post)
    {
        $params = [
            'category_name' => $post['category_name']
        ];
        $this->db->insert('product_category', $params);
    }

    public function edit_category($post)
    {
        $params = [
            'category_name' => $post['category_name'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('category_id', $post['id']);
        $this->db->update('product_category', $params);
    }

    public function delete_category($id)
    {
        $this->db->where('category_id', $id);
        $this->db->delete('product_category');
    }

    public function get_unit($id = null)
    {
        $this->db->from('product_unit');
        if ($id != null) {
            $this->db->where('unit_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add_unit($post)
    {
        $params = [
            'unit_name' => $post['unit_name']
        ];
        $this->db->insert('product_unit', $params);
    }

    public function edit_unit($post)
    {
        $params = [
            'unit_name' => $post['unit_name'],
            'updated' => date('Y-m-d H:i:s')
        ];
        $this->db->where('unit_id', $post['id']);
        $this->db->update('product_unit', $params);
    }

    public function delete_unit($id)
    {
        $this->db->where('unit_id', $id);
        $this->db->delete('product_unit');
    }

    public function get_item($id = null)
    {
        $this->db->select('product_item.*,category_name, unit_name');
        $this->db->from('product_item');
        $this->db->join('product_category', 'product_category.category_id = product_item.category_id');
        $this->db->join('product_unit', 'product_unit.unit_id = product_item.unit_id');
        if ($id != null) {
            $this->db->where('item_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add_item($post)
    {
        $params = [
            'barcode' => $post['barcode'],
            'item_name' => $post['item_name'],
            'category_id' => $post['category_id'],
            'unit_id' => $post['unit_id'],
            'price' => $post['price'],
            'image' => $post['image']
        ];
        $this->db->insert('product_item', $params);
    }

    public function edit_item($post)
    {
        $params = [
            'barcode' => $post['barcode'],
            'item_name' => $post['item_name'],
            'category_id' => $post['category'],
            'unit_id' => $post['unit_id'],
            'price' => $post['price'],
            'updated' => date('Y-m-d H:i:s')
        ];
        if ($post['image'] != null) {
            $params['image'] = $post['image'];
        }

        $this->db->where('item_id', $post['id']);
        $this->db->update('product_item', $params);
    }

    function check_barcode($code, $id = null)
    {
        $this->db->from('product_item');
        $this->db->where('barcode', $code);
        if ($id != null) {
            $this->db->where('item_id !=', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function delete_item($id)
    {
        $this->db->where('item_id', $id);
        $this->db->delete('product_item');
    }

    function update_stock_in($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];
        $sql = "UPDATE product_item SET stock = stock + '$qty' WHERE item_id = '$id'";
        $this->db->query($sql);
    }

    function update_stock_out($data)
    {
        $qty = $data['qty'];
        $id = $data['item_id'];
        $sql = "UPDATE product_item SET stock = stock - '$qty' WHERE item_id = '$id'";
        $this->db->query($sql);
    }
}
