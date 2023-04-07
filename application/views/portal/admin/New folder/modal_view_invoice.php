<?php
	$system_name = $this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;
	$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
	
	if(isset($param2)) $invoice_id = $param2;
	
	$edit_data = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->result_array();
	foreach($edit_data as $row):
?>
<div id="invoice_print">
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<!-- Main content -->
					<div class="invoice p-3 mb-3">
						<!-- title row -->
						<div class="row">
							<div class="col-12">
							<h5>
								<img src="uploads/logo.png" width="80">
								<?php echo $system_name;?>
							</h5>
						</div>
						<!-- /.col -->
						</div>
						
						<!-- info row -->
						<div class="row">
							<div class="col-12 text-right">
								<h5>Invoice #<?php echo $row['invoice_id'];?></h5>
								<h6><b>Creation Date: &nbsp;</b> <?php echo date('d M, Y', $row['creation_timestamp']);?></h6>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
						<hr>
						
						<!-- info row -->
						<div class="row invoice-info">
							<div class="col-sm-5 invoice-col">
								<h5>Payment To</h5>
								<address>
									<strong><?php echo ucwords($system_name); ?></strong><br>
									<?php echo ucwords($this->db->get_where('settings', array('type' => 'address'))->row()->description); ?><br>
									<strong>Phone:</strong>
									<?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description; ?><br>
									<strong>Email:</strong>
									<?php echo $this->db->get_where('settings', array('type' => 'system_email'))->row()->description; ?>
								</address>
							</div>
							<!-- /.col -->
							<div class="offset-sm-2 col-sm-5 invoice-col text-right">
								<h5>Bill To</h5>
								<address>
									<strong>
									<?php echo ucwords($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->name); ?>
									</strong><br>
									<?php 
										$enroll = $this->db->get_where('enroll' , array(
											'student_id' => $row['student_id'], 'year' => $running_year
										))->row();
									?>
									<strong>Class: </strong> <?php echo ucwords(get_class_name($enroll->class_id))?>
									<strong>Section: </strong> <?php echo ucwords(get_section_name($enroll->section_id));?><br>
									<?php echo ucwords($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->address); ?><br>
									<strong>Phone:</strong>
									<?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->phone; ?><br>
									<strong>Email:</strong>
									<?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->email; ?>
								</address>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
						<hr>
						
						<!-- info row -->
						<div class="row">
							<div class="col-6 table-responsive">
								<p class="lead">Invoice Info</p>
								<table class="table">
									
									<tr>
										<th>Title:</th>
										<td><?php echo ucwords($row['title']);?></td>
									</tr>
									<tr>
										<th>Description:</th>
										<td><?php echo ucfirst($row['description']);?></td>
									</tr>
									<tr>
										<th>Status:</th>
										<td>
											<?php if($row['status'] == 'paid'): ?>
											<button class="btn btn-success btn-xs">&nbsp; Paid &nbsp;</button>
											<?php endif; ?>
											<?php if($row['status'] == 'unpaid'): ?>
											<button class="btn btn-danger btn-xs">&nbsp; Unpaid &nbsp;</button>
											<?php endif; ?>
										</td>
									</tr>
								</table>
							</div>
							<!-- /.col -->
							<div class="col-6 table-responsive">
								<p class="lead">Payment Info</p>
								<table class="table">
									<tr>
										<th>Total Amount:</th>
										<td><?php echo $row['amount']; ?></td>
									</tr>
									<tr>
										<th>Amount Paid:</th>
										<td><?php echo $row['amount_paid']; ?></td>
									</tr>
									<?php if($row['due'] != 0): ?>
									<tr>
										<th>Due:</th>
										<td><?php echo $row['due']; ?></td>
									</tr>
									<?php endif; ?>
								</table>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
					
						<!-- Table row -->
						<div class="row mb-5">
							<div class="col-12 table-responsive">
								<p class="lead">Payment History</p>
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Date</th>
											<th>Amount</th>
											<th>Method</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$where = array('invoice_id' => $row['invoice_id']);
											$invoices = $this->db->get_where('payment', $where)->result_array();
											foreach($invoices as $row2):
										?>
										<tr>
											<td><?php echo date('d M, Y', $row2['timestamp']); ?></td>
											<td><?php echo $row2['amount']; ?></td>
											<td>
												<?php
													if($row2['method'] == 1)
														echo 'Cash';
													if($row2['method'] == 2)
														echo 'Check';
													if($row2['method'] == 3)
														echo 'Card';
												?>
											</td>
										</tr>
										<?php
											endforeach;
										?>
									</tbody>
								</table>
							</div>
							<!-- /.col -->
						</div>
						<!-- /.row -->
						
						<!-- this row will not appear when printing -->
						<div class="row no-print">
							<div class="col-12">
								<a onClick="PrintElem('#invoice_print')" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
								<button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
									Payment
								</button>
								<button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
									<i class="fas fa-download"></i> Generate PDF
								</button>
							</div>
						</div>
					</div>
					<!-- /.invoice -->
				</div>
				<!-- /.col -->
			</div
			><!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>

<?php
	endforeach;
?>

<script type="text/javascript">

    // print invoice function
    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'invoice', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Invoice</title>');
        mywindow.document.write('<link rel="stylesheet" href="dist/css/raw.css">');
        mywindow.document.write('<link rel="stylesheet" href="plugins/fontawesome-free/css/all.css">');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        var is_chrome = Boolean(mywindow.chrome);
        if (is_chrome) {
            setTimeout(function() {
                mywindow.print();
                mywindow.close();

                return true;
            }, 250);
        }
        else {
            mywindow.print();
            mywindow.close();

            return true;
        }

        return true;
    }

</script>