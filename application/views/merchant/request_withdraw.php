<?php
	$usr_id = $param2;
?>

<form method="post" action="<?php echo base_url().'index.php?merchant/make_request/'.$usr_id;?>" id="requestwithdraw" class="mb-2">
	<div class="row">
		<div class="col-12 mb-3">
			<p class="alert alert-inverse-info text-center">
				Your account balance is 
				<?php 
					$balance = $this->db->get_where('user_accounts', array('user_id' => $usr_id))->row()->balance;
					echo '<span class="font-18"> &#x20A6;&nbsp;'.number_format($balance).'</span>';
				?>
			</p>
		</div>
		<div class="col-12">
			<div class="form-group">
				<label class="control-label">Amount</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text"> &#x20A6; </span>
					</div>
					<input type="text" name="amount" id="amount" class="form-control" placeholder="123,456" tabindex="2" autocomplete="off" required>
				</div>
			</div>
		</div>
		<div class="col-12 mt-3">
			<button type="button" class="btn btn-primary btn-lg btn-block text-uppercase" id="req">Request</button>
		</div>
	</div>
</form>


<script>
	$('#req').click(function(){
		var amt = $('#amount').val();
		if(amt != '')
		{
			$.ajax(
			{
				url: "<?php echo base_url().'index.php?merchant/check_request/'.$usr_id;?>",
				type: 'POST',
				data: $('#requestwithdraw').serialize(),
				cache: false,
				success: function(response)
				{
					var res = JSON.parse(response);
					if(res.type == 'warning')
					{
						swal({
							type: 'warning',
							title: 'Are you sure?',
							html: '<p>Are you sure you want to request for <strong>&#x20A6;&nbsp;' + res.amount + '</strong>?</p>',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Yes',
							cancelButtonText: 'No, Cancel',
							confirmButtonClass: 'btn btn-success',
							cancelButtonClass: 'btn btn-danger',
							closeOnConfirm: false,
							showLoaderOnConfirm: true,
							allowOutsideClick: false
						}).then((result) => {
							if (result.value) {
								submit();
							} else if (result.dismiss === swal.DismissReason.cancel) {
								swal(
									'Process Cancelled',
									'You have cancel the request process.',
									'error'
								)
							}
						})
					}
					if(res.type == 'error')
					{
						swal({
							type: res.type,
							title: res.title,
							html: res.text,
							footer: res.footer,
							allowOutsideClick: false
						});
					}
				}
			})
		}
	});

	function submit()
	{
		$.ajax(
		{
			url: "<?php echo base_url().'index.php?merchant/make_request/'.$usr_id;?>",
			type: 'POST',
			data: $('#requestwithdraw').serialize(),
			cache: false,
			success: function(data)
			{
				var val = JSON.parse(data);
				if(val.type == 'success')
				{
					swal({
						type: 'success',
						title: 'Request Successful',
						html: '<p>Your request has been sent successfully </p> <p>Amount: <strong>&#x20A6;&nbsp;' + val.amount + '</strong></p>',
						allowOutsideClick: false
					}).then((result) => {
						window.location = "<?php echo base_url().'index.php?merchant/request';?>";
					});
				}
			}
		});
	}
</script>