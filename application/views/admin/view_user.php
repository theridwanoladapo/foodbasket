<?php
	$user_id = $param2;
	$user = $this->db->get_where('user', array('user_id' => $user_id))->row();
?>

<div class="page-account-profil">
	<div class="profile-img text-center rounded-circle">
		<div class="pt-2">
			<div class="bg-img m-auto">
				<img src="assets/img/avtar/01.jpg" class="img-fluid" alt="users-avatar">
			</div>
			<div class="profile pt-4">
				<h4 class="mb-1"><?php echo ucwords($user->firstname.' '.$user->lastname);?> <span class="text-muted">(<?php echo $user->username;?>)</span></h4>
				<p>ID: <span class="ml-2"><?php echo $user->referral_code;?></span></p>
			</div>
		</div>
	</div>

	<div class="pt-2 profile-counter">
		<ul class="nav justify-content-center text-center">
			<li class="nav-item border-right px-3">
				<div>
					<p>Level: <span class="ml-2"><?php echo $user->level;?></span></p>
				</div>
			</li>
			<li class="nav-item px-3">
				<div>
					<p>Stage: <span class="ml-2"><?php echo $user->stage;?></span></p>
				</div>
			</li>
		</ul>
		<div class="text-center pt-2">
			<p>Category: <span class="ml-2"><?php echo $user->category;?></span></p>
		</div>
	</div>
	
	<div class="my-3 py-2 px-4 border rounded">
		<?php $referral = $this->db->get_where('user', array('referrer' => $user->referral_code))->num_rows(); ?>
		<div class="d-flex justify-content-between mb-2">
			<span>Referral:</span>
			<span><strong><?php echo $referral;?></strong></span>
		</div>
		<?php $account = $this->db->get_where('user_accounts', array('user_id' => $user_id))->row(); ?>
		<div class="d-flex justify-content-between mb-2">
			<span>Account No.:</span>
			<span><strong><?php echo $account->account_no;?></strong></span>
		</div>
		<div class="d-flex justify-content-between mb-2">
			<span>Account Balance:</span>
			<span><strong><?php echo '&#x20A6; '.number_format($account->balance);?></strong></span>
		</div>
	</div>
	
	<?php if($user->category == 'merchant'): ?>
	<div class="my-3 py-2 px-4 border rounded">
		<?php $store = $this->db->get_where('stores', array('user_id' => $user_id))->row();?>
		<div class="d-flex justify-content-between mb-2">
			<span>Store Name:</span>
			<span><strong><?php echo ucwords($store->name);?></strong></span>
		</div>
		<div class="d-flex justify-content-between mb-2">
			<span>Store Location:</span>
			<span><strong><?php echo ucwords($store->location);?></strong></span>
		</div>
	</div>
	<?php endif; ?>
	
	<div class="profile-btn text-center">
		<?php if ($user->status == 1):?>
		<div><button class="btn btn-inverse-success btn-sm">Active</button></div>
		<?php elseif ($user->status == 0):?>
		<div>
			<button class="btn btn-inverse-danger btn-sm mb-2">Inactive</button>
			<button class="btn btn-success btn-sm mb-2" value="1" onClick="action_modal('<?php echo base_url().'index.php?admin/activate/'.$user_id;?>')">Activate</button>
		</div>
		<?php endif;?>
	</div>
</div>