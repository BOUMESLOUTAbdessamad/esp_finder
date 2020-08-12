<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function home() {
		access();

		$data['usersCount'] = $this->db->where('status', 'active')->count_all_results('users');


		// to be continued
		$data['newUsers'] = $this->db->where('created_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY)')
									->count_all_results('users');

		// $data['todaySeles'] = $this->db->select('SUM(amount) as todaySeles')
		// 								->from('paypal_payments')
		// 								->where('created >= DATE_SUB(CURRENT_DATE(), INTERVAL 1 DAY)')
		// 								->where('status', 'approved')
		// 								->get()->row_array();

		$data['lastUsers'] = $this->db->select("users.*")
										->from('users')
										// ->join("profiles", "profiles.user = users.id")
										->where('status', 'active')
										->limit(6)
										->order_by('users.id', 'DESC')
										->get()->result_array();

		$this->load->view('home', $data);

	}
}
