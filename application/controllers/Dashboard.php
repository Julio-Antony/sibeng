<?php

class Dashboard extends CI_Controller
{

	public function index()
	{
		check_not_login();
		check_admin();

		$query = $this->db->query("SELECT sales_detail.item_id, product_item.item_name, product_item.image, product_item.price, (SELECT SUM(sales_detail.qty)) AS sold
			FROM sales_detail
				INNER JOIN sales ON sales_detail.sales_id = sales.sales_id
				INNER JOIN product_item ON sales_detail.item_id = product_item.item_id
				WHERE MID(sales.date,6,2) = DATE_FORMAT(CURDATE(),'%m')
			GROUP BY sales_detail.item_id
			ORDER BY sold DESC
			LIMIT 5");

		$data = array(
			'title' => 'POS - Dasboard',
			'row' => $query->result()
		);
		$this->template->load('template', 'admin/dashboard', $data);
	}
}
