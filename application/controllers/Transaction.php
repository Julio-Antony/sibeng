<?php

class Transaction extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['model_transaction', 'model_customer', 'model_product', 'model_service']);
    }

    public function sale()
    {
        $item   = $this->model_product->get_sparepart()->result();
        $service = $this->model_product->get_service()->result();
        $cart = $this->model_transaction->get_cart();
        $data = array(
            'item' => $item,
            'service' => $service,
            'cart' => $cart,
            'invoice' => $this->model_transaction->invoice_no(),
            'title' => 'SIBENG - Transaksi'
        );
        $this->template->load('template', 'transaction/sale_form', $data);
    }

    public function process()
    {
        $data = $this->input->post(null, TRUE);

        if (isset($_POST['add_cart'])) {

            $product_id = $this->input->post('product_id');
            $check_cart = $this->model_transaction->get_cart(['cart.product_id' => $product_id])->num_rows();
            if ($check_cart > 0) {
                $this->model_transaction->update_cart_qty($data);
            } else {
                $this->model_transaction->add_cart($data);
            }

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => TRUE);
            } else {
                $params = array("success" => FALSE);
            }
            echo json_encode($params);
        }

        if (isset($_POST['add_service'])) {

            $service_id = $this->input->post('service_id');
            $check_cart = $this->model_transaction->get_cart(['cart.service_id' => $service_id])->num_rows();
            if ($check_cart > 0) {
                echo "<script>alert('Biaya service sudah diinput !');</script>";
            } else {
            }
            $this->model_transaction->add_service($data);

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => TRUE);
            } else {
                $params = array("success" => FALSE);
            }
            echo json_encode($params);
        }

        if (isset($_POST['edit_cart'])) {
            $this->model_transaction->edit_cart($data);

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => TRUE);
            } else {
                $params = array("success" => FALSE);
            }
            echo json_encode($params);
        }

        if (isset($_POST['process_payment'])) {

            $sales_id = $this->model_transaction->add_sale($data);
            $cart = $this->model_transaction->get_cart()->result();
            $row = [];

            foreach ($cart as $c => $value) {
                array_push(
                    $row,
                    array(
                        'sales_id' => $sales_id,
                        'product_id' => $value->product_id,
                        'price' => $value->price,
                        'qty' => $value->qty,
                        // 'discount_item' => $value->discount_item,
                        'total' => $value->total,
                    )
                );
            }
            $this->model_transaction->add_sale_detail($row);
            $this->model_transaction->delete_cart(['user_id' => $this->session->userdata('userid')]);

            if ($this->db->affected_rows() > 0) {
                $params = array("success" => TRUE, "sales_id" => $sales_id);
            } else {
                $params = array("success" => FALSE);
            }
            echo json_encode($params);
        }
    }

    function cart_data()
    {
        $cart = $this->model_transaction->get_cart();
        $data['cart'] = $cart;
        $this->load->view('transaction/cart_data', $data);
    }

    public function cart_delete()
    {
        if (isset($_POST['cancel_payment'])) {
            $this->model_transaction->delete_cart(['user_id' => $this->session->userdata('userid')]);
        } else {
            $cart_id = $this->input->post('cart_id');
            $this->model_transaction->delete_cart(['cart_id' => $cart_id]);
        }

        if ($this->db->affected_rows() > 0) {
            $params = array("success" => TRUE);
        } else {
            $params = array("success" => FALSE);
        }
        echo json_encode($params);
    }

    public function print($id)
    {
        $data = array(
            'sales' => $this->model_transaction->get_sale($id)->row(),
            'sales_detail' => $this->model_transaction->get_sale_detail($id)->result(),
        );
        $this->load->view('transaction/receipt_print', $data);
    }

    public function delete_sales($id)
    {
        $this->model_transaction->delete_sales($id);
        if ($this->db->affected_rows() > 0) {
            echo "<script>alert('Data penjualan berhasil dihapus');
            window.location='" . site_url('report/sales_report') . "';
            </script>";
        } else {
            echo "<script>alert('Data penjualan gagal dihapus');
            window.location='" . site_url('report/sales_report') . "';
            </script>";
        }
    }
}
