	<aside class="app-navbar">
		<!-- begin sidebar-nav -->
		<div class="sidebar-nav scrollbar scroll_dark">
			<ul class="metismenu " id="sidebarNav">
				<li class="nav-static-title">Personal</li>
				<li <?php if($page_name == 'dashboard') echo 'class="active"'?>>
					<a href="<?php echo base_url().'?member/dashboard';?>" aria-expanded="false">
						<i class="nav-icon ti ti-rocket"></i><span class="nav-title">Dashboard</span>
					</a>
				</li>
				<li <?php if($page_name == 'profile') echo 'class="active"'?>>
					<a href="<?php echo base_url().'?member/profile';?>" aria-expanded="false">
						<i class="nav-icon ti ti-user"></i><span class="nav-title">Profile</span>
					</a>
				</li>
				<li <?php if($page_name == 'referral') echo 'class="active"'?>>
					<a href="<?php echo base_url().'?member/referral';?>" aria-expanded="false">
						<i class="nav-icon fa fa-bullhorn"></i><span class="nav-title">Referral List</span>
					</a>
				</li>
				<li <?php if($page_name == 'transactions' || $page_name == 'transfer') echo 'class="active"'?>>
					<a href="<?php echo base_url().'?member/transactions';?>" aria-expanded="false">
						<i class="nav-icon fa fa-exchange"></i><span class="nav-title">Transactions</span>
					</a>
				</li>
			</ul>
		</div>
		<!-- end sidebar-nav -->
	</aside>
