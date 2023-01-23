<?php

class Dashboard extends CI_Controller
{

	public function index()
	{
		check_not_login();
		check_admin();

		$query = $this->db->query("SELECT sales_detail.product_id, product.product_name, product.image, product.price, (SELECT SUM(sales_detail.qty)) AS sold
			FROM sales_detail
				INNER JOIN sales ON sales_detail.sales_id = sales.sales_id
				INNER JOIN product ON sales_detail.product_id = product.product_id
				AND product.category = 'sparepart'
				WHERE MID(sales.date,6,2) = DATE_FORMAT(CURDATE(),'%m')
			GROUP BY sales_detail.product_id
			ORDER BY sold DESC
			LIMIT 5");

		$data = array(
			'title' => 'POS - Dasboard',
			'row' => $query->result()
		);
		$this->template->load('template', 'admin/dashboard', $data);
	}
}
