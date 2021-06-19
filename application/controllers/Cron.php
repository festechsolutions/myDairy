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
        }

	public function index()
	{
        /*if(!$this->input->is_cli_request())
  		{
      		echo "This script can only be accessed via the command line" . PHP_EOL;
      		return;
  		}else
  		{*/
	  		$store_data = $this->model_stores->getStoresData();
	  		$company_data = $this->model_company->getCompanyData(1);
	  		//echo json_encode($store_data);

	  		foreach ($store_data as $key => $value) {
	  			echo "Printing ".$value['name']." data.";
	  			echo "<br>";
	  			$store_id = $value['id'];
	  			$users_data = $this->model_users->getSubscribedUsersData($value['id']);
	  			//echo json_encode($users_data);

	  			foreach ($users_data as $k => $v) {
	  				$month = date('m')-1;
	  				$year = date('Y');
	  				$orders_data = $this->model_orders->getUserDeliveriesData($value['id'],$v['id'],$month,$year);
	  				echo "Printing ".$v['firstname']." data.";
	  				echo "<br>";
	  				//echo json_encode($orders_data);

	  				$gross_amount = 0;
	  				foreach ($orders_data as $a => $b) {
	  					$gross_amount += $b['amount'];
	  				}

	  				$user_id = $v['id'];
	  				$service_charge_value = $company_data['service_charge_value'];
			  		$total_amount = $gross_amount + $company_data['service_charge_value'];
	  				$create = $this->model_payments->create($store_id,$user_id,$gross_amount,$service_charge_value,$total_amount);

	  				if($create == true) {
	        			echo "User " .$v['firstname']. " Bill Generated.";
	        			echo "<br>";
	        		}
	        		else {
		        		echo "User " .$v['firstname']. " Bill Generation Failed.";
		        		echo "<br>";
		        	}
	  			}
	  		}		
  		//}
	}

	function pdf()
	{
		$html = '<!-- Main content -->
  				<!DOCTYPE html>
  				<html>
				<head>
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<title>Payments</title>
					<!-- Tell the browser to be responsive to screen width -->
					<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
					<!-- Bootstrap 3.3.7 -->  
					<link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
					<!-- Font Awesome -->  
					<link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
					<!-- Ionicons -->
					<link rel="stylesheet" href="'.base_url('assets/bower_components/Ionicons/css/ionicons.min.css').'">
					<!-- Theme style -->
					<link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
				</head>
				<body>
				  <div class="col-md-12 col-xs-12">
		        	<br>
		        	<div class="box">
		          		<div class="box-header">
		            		<h3 class="box-title">Products Delivered for the Selected Month</h3>
		          		</div>
		          		<!-- /.box-header -->
				        <div class="box-body">
				          <table id="datatables" class="table table-bordered table-striped">
				            <thead>
				                <tr style="text-align: center">
				                  <th style="text-align: center">Date</th>
				                  <th style="text-align: center">Product Name</th>
				                  <th style="text-align: center">Quantity</th>
				                  <th style="text-align: center">Amount</th>
				                </tr>
							</thead>
							<tbody id="tabledata" style="text-align: center">';
							$exis_date = '';
							foreach ($orders_data as $k => $v) {
								$html .= '<tr>';
								
								if($exis_date == $v['date']){
									$html .= '
						  				<td></td>
						  				<td>'.$v['product_name'].'</td>
						  				<td>'.$v['qty'].'</td>
						  				<td>₹'.$v['amount'].'</td>';
						  			$exis_date = $v['date'];
								}else{
						  			$html .= '
						  				<td>'.$v['date'].'</td>
						  				<td>'.$v['product_name'].'</td>
						  				<td>'.$v['qty'].'</td>
						  				<td>₹'.$v['amount'].'</td>';
						  			$exis_date = $v['date'];
						  		}
						  		$html .= '</tr>';
						  	}
						  	$html.='<tr>
						  				<th colspan="3" style="text-align: center">Gross Amount</th>
						  				<th style="text-align: center">₹'.$amount.'.00</th>
						  			</tr>
						  			<tr>
						  				<th colspan="3" style="text-align: center">Service Charge</th>
						  				<th style="text-align: center">₹'.$company_data['service_charge_value'].'</th>
						  			</tr>';
						  			$total = $amount + $company_data['service_charge_value'];
						  	$html.='<tr>
						  				<th colspan="3" style="text-align: center">Total Amount</th>
						  				<th style="text-align: center">₹'.$total.'.00</th>
						  			</tr>
						  		</tbody>
		            
						  </table>
		          		</div>
		          		<!-- /.box-body -->
		        	</div>
		        	<!-- /.box -->
		          </div>
				</body>
				</html>';
				echo $html;
    	
	}


}
