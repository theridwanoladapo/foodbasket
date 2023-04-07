<hr>
<?php
	$running_year = $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;
?>
			<div class="card-body table-responsive pl-0 pr-0">
				<table id="specific_payments" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th> # </th>
							<th> Title </th>
							<th> Description </th>
							<th> Method </th>
							<th> Amount </th>
							<th> Date </th>
							<th>&nbsp;</th>
						</tr>
					</thead>
					
					<tbody>
						<?php
							$count = 1;
							$where = array('student_id' => $student_id, 'year' => $running_year);
							$orderby = array('timestamp', 'DESC');
							$invoices = $this->db->get_where('payment', $where, $orderby)->result_array();
							foreach($invoices as $row):
						?>
						<tr>
							<td><?php echo $count++;?></td>
							<td><?php echo ucwords($row['title']); ?></td>
							<td><?php echo ucfirst($row['description']); ?></td>
							<td>
								<?php
									if($row['method'] == 1)
										echo 'Cash';
									if($row['method'] == 2)
										echo 'Check';
									if($row['method'] == 3)
										echo 'Card';
								?>
							</td>
							<td><?php echo $row['amount']; ?></td>
							<td><?php echo date('m/d/Y', $row['timestamp']); ?></td>
							<td>
								<a class="btn btn-info btn-sm" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_view_invoice/<?php echo $row['invoice_id'];?>');">
									<i class="fas fa-eye"></i> &nbsp; View Invoice
								</a>
							</td>
						</tr>
						<?php
							endforeach;
						?>
					</tbody>
				</table>
			</div>
			<!-- /.card-body -->
			
			<!-- page script -->
			<script type="text/javascript">
				$(function () {
					// Initialize DataTable Elements
					$('#specific_payments').DataTable({
						"paging": true,
						"lengthChange": false,
						"searching": false,
						"ordering": true,
						"info": true,
						"autoWidth": false
					});
				});
			</script>