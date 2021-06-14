<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Invoice</title>
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
				<tbody id="tabledata" style="text-align: center">
				<?php 
				$exis_date = '';
				foreach ($orders_data as $k => $v) { ?>
					<tr>
					<?php
					if($exis_date == $v['date']){ ?>
			  			<td></td>
			  			<td><?php echo $v['product_name']; ?></td>
			  			<td><?php echo $v['qty']; ?></td>
			  			<td>₹<?php echo $v['amount']; ?></td>
			  			<?php echo $exis_date = $v['date']; 
					}else{
					?>
			  			<td><?php echo $v['date']; ?></td>
			  			<td><?php echo $v['product_name']; ?></td>
			  			<td><?php echo $v['qty']; ?></td>
			  			<td>₹<?php echo $v['amount']; ?></td>
			  			<?php echo $exis_date = $v['date'];
			  		} ?>
			  		</tr>
		<?php  	} ?>
			  	    <tr>
			  			<th colspan="3" style="text-align: center">Gross Amount</th>
			  			<th style="text-align: center">₹ <?php echo $amount; ?>.00</th>
			  		</tr>
			  		<tr>
			  			<th colspan="3" style="text-align: center">Service Charge</th>
			  			<th style="text-align: center">₹ <?php echo $service_charge_value; ?></th>
			  		</tr>
			  	    <tr>
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
</html>