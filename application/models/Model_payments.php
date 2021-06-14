<?php 

class Model_payments extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_users');
	}

	public function getPaymentsData($id = null)
	{
		date_default_timezone_set("Asia/Kolkata");
		if($id) {
			$sql = "SELECT * FROM payments WHERE id = ? ORDER BY id";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$user_id = $this->session->userdata('id');
		if($user_id == 1) {
			$sql = "SELECT * FROM payments ORDER BY id";
			$query = $this->db->query($sql);
			return $query->result_array();
		}
		else {
			$user_data = $this->model_users->getUserData($user_id);
			$sql = "SELECT * FROM payments ORDER BY id";
			$query = $this->db->query($sql, array($user_data['store_id']));
			return $query->result_array();	
		}
	}

	public function getPaymentData($invoice_no)
	{
		date_default_timezone_set("Asia/Kolkata");
		if($invoice_no) {
			$sql = "SELECT * FROM payments WHERE invoice_no = ?";
			$query = $this->db->query($sql, array($invoice_no));
			return $query->row_array();
		}
	}

	public function create($store_id,$user_id,$gross_amount,$service_charge_value,$total_amount)
	{
		date_default_timezone_set("Asia/Kolkata");
		$invoice_date = date('d-m-Y');
		$year = date('Y');
		$month = date('m')-1;
		$random = rand(10,1000);
		$invoice_no = $random.$year.$month.$user_id;

		$gross_amount = number_format($gross_amount, 2);
		$service_charge_value = number_format($service_charge_value, 2);
		$total_amount = number_format($total_amount, 2);
		
		$data = array(
    		'invoice_no' => $invoice_no,
			'invoice_date' => $invoice_date,
			'year' => $year,
			'month' => $month,
			'gross_amount' => $gross_amount,
			'service_charge_value' => $service_charge_value,
			'net_amount' => $total_amount,
    		'user_id' => $user_id,
			'store_id' => $store_id,
			'payment_status' => 2,
    	);

		$insert = $this->db->insert('payments', $data);

		return ($insert) ? $insert : false;
	}

	public function update($invoice_no,$payment_mode,$payment_status)
	{
		date_default_timezone_set("Asia/Kolkata");
		$payment_date = date('d-m-Y');
		
		$data = array(
    		'payment_date' => $payment_date,
    		'payment_mode' => $payment_mode,
			'payment_status' => $payment_status,
    	);

		$this->db->where('invoice_no', $invoice_no);
		$update = $this->db->update('payments', $data);

		return ($update) ? $update : false;
	}

}