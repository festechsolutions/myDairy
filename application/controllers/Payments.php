<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Payments';

		$this->load->model('model_payments');
		$this->load->model('model_products');
		$this->load->model('model_category');
        $this->load->model('model_orders');
		$this->load->model('model_stores');
		$this->load->model('model_company');
        $this->load->model('model_subscribe');
	}

	public function index()
	{
        if(!in_array('viewPayments', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->render_template('payments/index', $this->data);	
	}

	public function fetchPaymentsData()
	{
		if(!in_array('viewPayments', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$result = array('data' => array());

		$data = $this->model_payments->getPaymentsData();

		foreach ($data as $key => $value) {

			$user_data =  $this->model_users->getUserData($value['user_id']);

			$store_data = $this->model_stores->getStoresData($value['store_id']);

			$name = $user_data['firstname'].' '.$user_data['lastname'];

			// button
			$buttons = '';

			if(in_array('updatePayments', $this->permission)) {
				$buttons .= ' <a href="'.base_url('payments/update/'.$value['invoice_no']).'" style="border: 2px solid #4CAF50" class="btn btn-default"><i class="fa fa-pencil" style="color:#4CAF50"></i></a>';
			}

			if(in_array('deletePayments', $this->permission)) {
				$buttons .= ' <button type="button" style="border: 2px solid #f44336" class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash" style="color:#f44336"></i></button>';
			}

			if($value['payment_status'] == 1) {
				$paid_status = '<span class="label label-success">Paid</span>';
			}
			else {
				$paid_status = '<span class="label label-warning">Not Paid</span>';
			}

			$invoice_no = '<u><a href="'.base_url('payments/invoice/'.$value['invoice_no']).'">#'.$value['invoice_no'].'</a></u>';

			$result['data'][$key] = array(
				$name,
				$user_data['phone'],
				$value['net_amount'],
				$store_data['name'],
				$invoice_no,
				$paid_status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function fetch()
	{

        $store_id = $this->input->post('store_name');
        $user_id = $this->input->post('user_id');
        $month = $this->input->post('month');
        $year = $this->input->post('year');

    	$orders_data = $this->model_orders->getUserDeliveriesData($store_id,$user_id,$month,$year);
    	echo json_encode($orders_data);
	}

	public function update($invoice_no)
	{
		if(!in_array('updatePayments', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$invoice_no) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Payment';

		$this->form_validation->set_rules('payment_mode', 'Payment Mode', 'trim|required');
		$this->form_validation->set_rules('payment_status', 'Payment Status', 'trim|required');
		
        if ($this->form_validation->run() == TRUE) {    

        	$payment_mode = $this->input->post('payment_mode');
        	$payment_status = $this->input->post('payment_status');	

        	$update = $this->model_payments->update($invoice_no,$payment_mode,$payment_status);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('payments/update/'.$invoice_no, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('payments/update/'.$invoice_no, 'refresh');
        	}
        }
        else {
            // false case
        	
        	$company = $this->model_company->getCompanyData(1);
        	
        	$payment_data = $this->model_payments->getPaymentData($invoice_no);
        	$user_data =  $this->model_users->getUserData($payment_data['user_id']);
        	$store_data = $this->model_stores->getStoresData($payment_data['store_id']);
        	$name = $user_data['firstname'].' '.$user_data['lastname'];

        	$monthNum = $payment_data['month'];
        	$dateObj   = DateTime::createFromFormat('!m', $monthNum);
        	$monthName = $dateObj->format('F');
        	
        	$this->data['page_title'] = 'Manage Payments';
        	$this->data['payment_data'] = $payment_data;
        	$this->data['user_data'] = $user_data;
        	$this->data['store_data'] = $store_data;
        	$this->data['month'] = $monthName;
        	$this->data['name'] = $name;
		    
            $this->render_template('payments/edit', $this->data);
        }
	}

	public function invoice($invoice_no = null)
	{
		if(!in_array('viewPayments', $this->permission)) {
          	redirect('dashboard', 'refresh');
  		}

  		if($invoice_no) {
			$payments_data = $this->model_payments->getPaymentData($invoice_no);
			$orders_data = $this->model_orders->getUserDeliveriesData($payments_data['store_id'],$payments_data['user_id'],$payments_data['month'],$payments_data['year']);
			$gross_amount = 0;
			foreach ($orders_data as $a => $b) {
				$gross_amount += $b['amount'];
			}

			$company_data = $this->model_company->getCompanyData(1);
			$service_charge_value = $company_data['service_charge_value'];
		  	$total_amount = $gross_amount + $company_data['service_charge_value'];
			
			$html = '<!-- Main content -->
  				<!DOCTYPE html>
  				<html>
				<head>
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
					<style>
					body,
					html {
						margin: 0;
						width: 100%;
					}
			
					.mainDiv {
						width: 100%;
    					max-width: 400px;
    					padding: 10px 10px;
						padding-bottom: 3px;
						margin:auto;
					}
			
					.head1 {
						width: 100%;
						/* height: 150px; */
					}
					hr{
						margin-top: 10px;
    					margin-bottom: 10px;
    					border: 0;
    					border-top: 1px solid #d1d1d1;
					}
					.hss {
						text-transform: uppercase;
						text-align: center;
						/* margin-bottom: 0px; */
						margin: 0;
						margin-top: 10px;
						font-size: 20px;
					}
			
					.hss2 {
						text-transform: capitalize;
						font-size: 18px;
						/* font-weight: 500; */
						margin-bottom: 10px;
					}
					.col-md-12{
						padding: 0px;
					}
			
					.s34hd {
						display: flex;
						justify-content: space-between;
						align-items: center;
						height: 30px;
					}
			
					.s34hd p {
						margin: 0;
						min-width: 100px;
						text-align: center;
					}
			
					.bottom {
						margin: 20px 0px;
					}
			
					.bottom p {
						text-align: center;
						margin: 0px;
						font-size: 12px;
					}
					.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
						padding: 8px 4px;
					}
				</style>
				</head>
				<body>
				<div class="mainDiv">
				<header class="head1">
					<h2 class="hss">Invoice</h2>
					<hr>
				</header>
		
				<div class="cutomerInfo">
					<h1 class="hss hss2">Customer Information</h1>
					<div class="allInfos">
						<span class="s34hd span1">
							<p>User Name</p>
							<p>mswakhil_bdp</p>
						</span>
						<span class="s34hd span2">
							<p>Invoice No</p>
							<p>411348</p>
						</span>
						<span class="s34hd span3">
							<p>Billing Date</p>
							<p>19/04/2021</p>
						</span>
						<span class="s34hd span4">
							<p>Due Date</p>
							<p>24/04/2021</p>
						</span>
					</div>
				</div>
		
				<hr>
		
			
		        	<br>

		        	<div class="box">
		          		<div class="box-header">
		            		<h3 class="box-title">Products Delivered</h3>
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
						  				<th style="text-align: center">₹'.$gross_amount.'.00</th>
						  			</tr>
						  			<tr>
						  				<th colspan="3" style="text-align: center">Service Charge</th>
						  				<th style="text-align: center">₹'.$service_charge_value.'</th>
						  			</tr>
						  			<tr>
						  				<th colspan="3" style="text-align: center">Total Amount</th>
						  				<th style="text-align: center">₹'.$total_amount.'.00</th>
						  			</tr>
						  		</tbody>
		            
						  </table>
		          		</div>
		          		<!-- /.box-body -->
		        	</div>
		        	<!-- /.box -->

		     
				  <hr>

				  <div class="bottom">
					  <p>***This is computer generated invoice. No signature required***</p>
					  <p> Thank you for your prompt payment.</p>
				  </div>
		  
			  </div>
			  
				</body>
				</html>';
				echo $html;
		}
		else{
			redirect('payments', 'refresh');
		}
  	}

}