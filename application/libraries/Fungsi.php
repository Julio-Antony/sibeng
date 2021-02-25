<?php

class Fungsi
{

    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('Model_user');
        $user_id = $this->ci->session->userdata('userid');
        $user_data = $this->ci->Model_user->get($user_id)->row();
        return $user_data;
    }

    function pdf_generator($html, $filename, $paper, $orientation)
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper($paper, $orientation);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($filename, array('Attachment' => 0));
    }

    public function count_item()
    {
        $this->ci->load->model('model_product');
        return $this->ci->model_product->get_item()->num_rows();
    }

    public function count_supplier()
    {
        $this->ci->load->model('model_supplier');
        return $this->ci->model_supplier->get()->num_rows();
    }

    public function count_customer()
    {
        $this->ci->load->model('model_customer');
        return $this->ci->model_customer->get()->num_rows();
    }

    public function count_user()
    {
        $this->ci->load->model('model_user');
        return $this->ci->model_user->get()->num_rows();
    }
}
