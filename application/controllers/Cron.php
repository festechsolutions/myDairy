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
        $this->load->model('model_subscribe');
	}

	public function index()
	{
        /*if(!$this->input->is_cli_request())
  		{
      		echo "This script can only be accessed via the command line" . PHP_EOL;
      		return;
  		}*/

  		$store_data = $this->model_stores->getStoresData();
  		//echo json_encode($store_data);
  		foreach ($store_data as $key => $value) {
  			echo "Printing ".$value['name']." data.";
  			echo "<br>";
  			$users_data = $this->model_users->getSubscribedUsersData($value['id']);
  			//echo json_encode($users_data);
  			foreach ($users_data as $k => $v) {

  				$month = date('m');
  				$year = date('Y');
  				$orders_data = $this->model_orders->getUserDeliveriesData($value['id'],$v['id'],$month,$year);
  				echo "Printing ".$v['firstname']." data.";
  				echo json_encode($orders_data);
  				echo "<br>";

  			}
  		}
	}

	function pdf()
	{
	    $this->load->helper('pdf_helper');
	    
	    echo "Printing Data in PDF";
	    $data = "Printing Data in PDF";
	    $this->load->view('pdfreport', $data);
	}

}