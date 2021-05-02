<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage
      <small>Payments</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Payments</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">

      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php elseif($this->session->flashdata('error')): ?>
        <div class="alert alert-error alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
              aria-hidden="true">&times;</span></button>
          <?php echo $this->session->flashdata('error'); ?>
        </div>
        <?php endif; ?>

        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Edit Payment</h3>
          </div>
          <!-- /.box-header -->
          <form role="form" action="<?php base_url('orders/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php $errors = ''; ?>
                <?php $errors = validation_errors(); ?>
                <?php if($errors != ''): ?>
                  <div class="alert alert-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo validation_errors(); ?>
                  </div>
                <?php endif; ?>

                <div class="form-group">
                  <label for="date" class="col-sm-12 control-label">Date: <?php date_default_timezone_set("Asia/Kolkata"); echo date('Y-m-d') ?></label>
                </div>
                <div class="form-group">
                  <label for="time" class="col-sm-12 control-label">Time: <?php date_default_timezone_set("Asia/Kolkata"); echo date('h:i a') ?></label>
                </div> 
                <div class="col-md-4 col-xs-12 pull pull-left">
                  <div class="form-group">
                    <h4><label for="order_no" class="col-sm-4 control-label" style="text-align:left;">Invoice No:</label></h4>
                    <div class="col-sm-7">
                       <input type="text" class="form-control" value="<?php echo "#".$payment_data['invoice_no'];?>" readonly="true" disabled>
                    </div>
                  </div>  
                </div>
                
                <br /> <br/>
                <table class="table table-bordered" width="100px" id="product_info_table">
                  <thead>
                    <tr>
                      <th style="text-align:center">Customer Name</th>
                      <th style="text-align:center">Mobile</th>
                      <th style="text-align:center">Colony/Store Name</th>
                      <th style="text-align:center">Bill Month & Year</th>
                    </tr>
                  </thead>
                  <tbody>
                      <td style="text-align:center"><?php echo $name; ?></th>
                      <td style="text-align:center"><?php echo $user_data['phone']; ?></th>
                      <td style="text-align:center"><?php echo $store_data['name']; ?></th>
                      <td style="text-align:center"><?php echo $month.' - '.$payment_data['year']?></th>
                  </tbody>
                </table>

                <br /> <br/>

                <div class="col-md-6 col-xs-12 pull pull-right">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled value="<?php echo $payment_data['gross_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="service_charge" class="col-sm-5 control-label">Service Charge </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="service_charge" name="service_charge" disabled value="<?php echo $payment_data['service_charge_value'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled value="<?php echo $payment_data['net_amount'] ?>" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="payment_status" class="col-sm-5 control-label">Payment Status</label>
                    <div class="col-sm-7">
                      <select type="text" class="form-control" id="payment_status" name="payment_status">
                        <option value="1" <?php if($payment_data['payment_status'] == 1) { echo 'selected="selected"'; } ?>>paid</option>
                        <option value="2" <?php if($payment_data['payment_status'] == 2) { echo 'selected="selected"'; } ?>>UnPaid</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="payment_mode" class="col-sm-5 control-label">Payment Mode</label>
                    <div class="col-sm-7">
                      <select type="text" class="form-control" id="payment_mode" name="payment_mode">
                        <option value="">Select Mode of Payment</option>
                        <option value="Cash" <?php if($payment_data['payment_mode'] == 'Cash') { echo 'selected="selected"'; } ?>>Cash</option>
                        <option value="UPI/Money Transfer" <?php if($payment_data['payment_mode'] == 'UPI/Money Transfer') { echo 'selected="selected"'; } ?>>UPI / Internet Banking</option>
                        <option value="Credit/Debit Card" <?php if($payment_data['payment_mode'] == 'Credit/Debit Card') { echo 'selected="selected"'; } ?>>Credit/Debit Card</option>
                      </select>
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.box-body -->
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <a target="__blank" href="<?php echo base_url() . 'payments/invoice/'.$payment_data['invoice_no'] ?>" class="btn btn-default" >Print</a>
                <button type="submit" class="btn btn-primary">Update Payment</button>
                <a href="<?php echo base_url('payments/') ?>" class="btn btn-warning">Back</a>
              </div>
            </form>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->

      </div>
      <!-- col-md-12 -->
    </div>
    <!-- /.row -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  var manageTable;
  var base_url = "<?php echo base_url(); ?>";

  $(document).ready(function () {

    $("#PaymentsMainNav").addClass('active');
    $("#managepaymentsSubMenu").addClass('active');

  });

</script>