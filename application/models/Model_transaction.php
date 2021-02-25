<?php

class Model_transaction extends CI_Model
{
    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(invoice,9,4)) AS invoice_no FROM sales WHERE MID(invoice,3,6) = DATE_FORMAT(CURDATE(),'%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "MP" . date('ymd') . $no;
        return $invoice;
    }

    public function get_cart($params = null)
    {
        $this->db->select('*, product_item.item_name, cart.price as cart_price');
        $this->db->from('cart');
        $this->db->join('product_item', 'cart.item_id = product_item.item_id');
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->where('user_id', $this->session->userdata('userid'));
        $query = $this->db->get();
        return $query;
    }

    public function add_cart($post)
    {
        $query = $this->db->query("SELECT MAX(cart_id)AS cart_no FROM cart");
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $cart_no = ((int)$row->cart_no) + 1;
        } else {
            $cart_no = "1";
        }

        $params = array(
            'cart_id' => $cart_no,
            'item_id' => $post['item_id'],
            'price' => $post['price'],
            'qty' => $post['qty'],
            'total' => ($post['price'] * $post['qty']),
            'user_id' => $this->session->userdata('userid')
        );
        $this->db->insert('cart', $params);
    }

    function update_cart_qty($post)
    {
        $sql = "UPDATE cart SET price = '$post[price]',
                qty = qty + '$post[qty]',
                total = '$post[price]'  * qty
                WHERE item_id = '$post[item_id]'";
        $this->db->query($sql);
    }

    public function delete_cart($params = null)
    {
        if ($params != null) {
            $this->db->where($params);
        }
        $this->db->delete('cart');
    }

    public function edit_cart($post)
    {
        $params = array(
            'price' => $post['price'],
            'qty' => $post['qty'],
            'discount_item' => $post['discount'],
            'total' => $post['total'],
        );
        $this->db->where('cart_id', $post['cart_id']);
        $this->db->update('cart', $params);
    }

    public function add_sale($post)
    {
        $params = array(
            'invoice' => $this->invoice_no(),
            'customer_id' => $post['customer_id'] == "" ? null : $post['customer_id'],
            'total_price' => $post['subtotal'],
            'discount' => $post['discount'],
            'final_price' => $post['grand_total'],
            'cash' => $post['cash'],
            'remaining' => $post['change'],
            'note' => $post['note'],
            'date' => $post['date'],
            'user_id' => $this->session->userdata('userid')
        );
        $this->db->insert('sales', $params);
        return $this->db->insert_id();
    }

    function add_sale_detail($params)
    {
        $this->db->insert_batch('sales_detail', $params);
    }

    public function get_sale($id = null)
    {
        $this->db->select('*, customer.customer_name as customer_name, user.username as username, sales.created as sales_created');
        $this->db->from('sales');
        $this->db->join('customer', 'sales.customer_id = customer.customer_id', 'left');
        $this->db->join('user', 'sales.user_id = user.user_id');

        if ($id != null) {
            $this->db->where('sales_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_sale_detail($sales_id = null)
    {
        $this->db->from('sales_detail');
        $this->db->join('product_item', 'sales_detail.item_id = product_item.item_id');
        if ($sales_id != null) {
            $this->db->where('sales_detail.sales_id', $sales_id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function delete_sales($id)
    {
        $this->db->where('sales_id', $id);
        $this->db->delete('sales');
    }
}
