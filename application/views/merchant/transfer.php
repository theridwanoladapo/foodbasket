<?php $usr_id = $this->session->userdata('merchant_login_id');?>
	<div class="app-main" id="main">
		<!-- begin container-fluid -->
		<div class="container-fluid">
			<!-- begin row -->
			<div class="row">
				<div class="col-md-12 m-b-30">
					<!-- begin page title -->
					<div class="d-block d-lg-flex flex-nowrap align-items-center">
						<div class="page-title mr-4 pr-4 border-right">
							<h1>Transfer</h1>
						</div>
						<div class="breadcrumb-bar align-items-center">
							<nav>
								<ol class="breadcrumb p-0 m-b-0">
									<li class="breadcrumb-item">
										<a href><i class="ti ti-home"></i></a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Transfer</li>
								</ol>
							</nav>
						</div>
					</div>
					<!-- end page title -->
				</div>
			</div>
			<!-- end row -->

			<!-- begin row -->
			<div class="row">
				<div class="col-xs-8 offset-xs-2 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-5 offset-lg-3">
					<div class="card rounded">
						<div class="card-header">
							<div class="card-heading">
								<h4 class="card-title">Transfer Fund</h4>
							</div>
						</div>
						<div class="card-body">
							<form method="post" action="<?php echo base_url().'index.php?merchant/do_trans/'.$usr_id;?>" id="transferfund" class="mb-2">
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
											<label class="control-label">Recipient's Account Number</label>
											<input type="text" name="recipient" id="recipient" class="form-control" placeholder="20XXXXXXXX" inputmode="numeric" pattern="[0-9]{10}" maxlength="10" tabindex="1" onKeyPress="return onlyNumberKey(event)" autocomplete="off" required>
										</div>
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
										<button type="button" class="btn btn-success btn-lg btn-block text-uppercase" id="send">Send</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- end row -->
		</div>
		<!-- end container-fluid -->
	</div>


	<script> 
		function onlyNumberKey(evt) { 
			// Only ASCII charactar in that range allowed 
			var ASCIICode = (evt.which) ? evt.which : evt.keyCode 
			if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57)) 
				return false;

			return true; 
		}

		$('#send').click(function(){
			var rec = $('#recipient').val();
			var amt = $('#amount').val();
			if( rec != '' && amt != '')
			{
				$.ajax(
				{
					url: "<?php echo base_url().'index.php?merchant/chk_trans/'.$usr_id;?>",
					type: 'POST',
					data: $('#transferfund').serialize(),
					cache: false,
					success: function(response)
					{
						var res = JSON.parse(response);
						if(res.type == 'warning')
						{
							swal({
								type: 'warning',
								title: 'Are you sure?',
								html: '<p>Are you sure you want to send <strong>&#x20A6;&nbsp;' + res.amount + '</strong> to <strong>' + res.username + '</strong>?</p>',
								showCancelButton: true,
								confirmButtonColor: '#3085d6',
								cancelButtonColor: '#d33',
								confirmButtonText: 'Yes, Send',
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
										'Transfer Cancelled',
										'You have cancel tranfer process.',
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
				url: "<?php echo base_url().'index.php?merchant/do_trans/'.$usr_id;?>",
				type: 'POST',
				data: $('#transferfund').serialize(),
				cache: false,
				success: function(data)
				{
					var val = JSON.parse(data);
					if(val.type == 'success')
					{
						swal({
							type: 'success',
							title: 'Transfer Successful',
							html: '<p>You have successfully transfer an amount of <strong>&#x20A6;&nbsp;' + val.amount + '</strong> to <strong>' + val.username + '</strong></p>',
							allowOutsideClick: false
						}).then((result) => {
							window.location = "<?php echo base_url().'index.php?merchant/transfer';?>";
						});
					}
				}
			});
		}
	</script>