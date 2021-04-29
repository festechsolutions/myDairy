<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Cron';

		$this->load->model('model_payments');
		$this->load->model('model_products');
		$this->load->model('model_category');
        $this->load->model('model_orders');
		$this->load->model('model_stores');
        $this->load->model('model_company');
        $this->load->helper('pdf_helper');
	}

	public function index()
	{
        /*if(!$this->input->is_cli_request())
  		{
      		echo "This script can only be accessed via the command line" . PHP_EOL;
      		return;
  		}*/

  		date_default_timezone_set("Asia/Kolkata");
		$year = date('Y');
		$month = date('m', strtotime ('-1 month'));
		if (!is_dir('uploads/invoice/'.$year.'/'.$month)) {
			mkdir('./uploads/invoice/' . $year.'/'.$month, 0777, TRUE);
		}
  		$store_data = $this->model_stores->getStoresData();
  		//echo json_encode($store_data);
  		foreach ($store_data as $key => $value) {
  			echo "Printing ".$value['name']." data.";
  			echo "<br>";
  			$users_data = $this->model_users->getSubscribedUsersData($value['id']);
  			//echo json_encode($users_data);
  			foreach ($users_data as $k => $v) {
  				$month = date('m')-1;
  				$year = date('Y');
  				$orders_data = $this->model_orders->getUserDeliveriesData($value['id'],$v['id'],$month,$year);
  				echo "Printing ".$v['firstname']." data.";
  				echo json_encode($orders_data);
  				$amount = 0;
  				foreach ($orders_data as $a => $b) {
  					$amount += $b['amount'];
  				}
  				echo "Total Amount is = ".$amount;
  				echo "<br>";
  			}
  		}
	}

	function pdf()
	{
	    $this->load->helper('pdf_helper');
	    $data = "Print Data";
    	$this->load->view('pdfreport', $data);
    	/*
    	$data = "Print Data";
	    $this->$data['orders_data'] = $orders_data;
  		$this->render_template('pdfreport', $this->$data);
    	*/
	}

}