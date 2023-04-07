	<aside class="app-navbar">
		<!-- begin sidebar-nav -->
		<div class="sidebar-nav scrollbar scroll_dark">
			<ul class="metismenu " id="sidebarNav">
				<li class="nav-static-title">Personal</li>
				<li <?php if($page_name == 'dashboard') echo 'class="active"'?>>
					<a href="<?php echo base_url().'?admin/dashboard';?>" aria-expanded="false">
						<i class="nav-icon ti ti-rocket"></i><span class="nav-title">Dashboard</span>
					</a>
				</li>
				<!--<li>
					<a href="javascript:void(0)" aria-expanded="false">
						<i class="nav-icon ti ti-user"></i><span class="nav-title">Profile</span>
					</a>
				</li>-->
				<li <?php if($page_name == 'members' || $page_name == 'agents' || $page_name == 'merchants') echo 'class="active"'?>>
					<a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-key"></i><span class="nav-title">Users</span></a>
					<ul aria-expanded="false">
						<li <?php if($page_name == 'members') echo 'class="active"'?>>
							<a href="<?php echo base_url().'?admin/members';?>">Members</a>
						</li>
						<li <?php if($page_name == 'agents') echo 'class="active"'?>>
							<a href="<?php echo base_url().'?admin/agents';?>">Agents</a>
						</li>
						<li <?php if($page_name == 'merchants') echo 'class="active"'?>>
							<a href="<?php echo base_url().'?admin/merchants';?>">Merchants</a>
						</li>
					</ul>
				</li>
				<li <?php if($page_name == 'credits' || $page_name == 'debits' || $page_name == 'credit' || $page_name == 'debit') echo 'class="active"'?>>
					<a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon fa fa-exchange"></i><span class="nav-title">Admin Transactions</span></a>
					<ul aria-expanded="false">
						<li <?php if($page_name == 'credits' || $page_name == 'credit') echo 'class="active"'?>>
							<a href="<?php echo base_url().'?admin/credits';?>">Credits</a>
						</li>
						<li <?php if($page_name == 'debits' || $page_name == 'debit') echo 'class="active"'?>>
							<a href="<?php echo base_url().'?admin/debits';?>">Debits</a>
						</li>
					</ul>
				</li>
				<!--<li>
					<a class="has-arrow" href="javascript:void(0)" aria-expanded="false"><i class="nav-icon ti ti-list"></i><span class="nav-title">Multi Level</span></a>
					<ul aria-expanded="false">
						<li> <a href="javascript: void(0);">Level 1.1</a> </li>
						<li class="scoop-hasmenu">
							<a class="has-arrow" href="javascript: void(0);">Level 1.2</a>
							<ul aria-expanded="false">
								<li> <a href="javascript: void(0);">Level 2.1</a> </li>
								<li> <a href="javascript: void(0);">Level 2.2</a> </li>
							</ul>
						</li>
						<li class="scoop-hasmenu">
							<a class="has-arrow" href="javascript: void(0);">Level 1.3</a>
							<ul aria-expanded="false">
								<li> <a href="javascript: void(0);">Level 3.1</a> </li>
								<li> <a href="javascript: void(0);">Level 3.2</a> </li>
							</ul>
						</li>
					</ul>
				</li>-->
				<li <?php if($page_name == 'requests') echo 'class="active"'?>>
					<a href="<?php echo base_url().'?admin/requests';?>" aria-expanded="false">
						<i class="nav-icon ti ti-rocket"></i><span class="nav-title">Withdraw Requests</span>
					</a>
				</li>
				<!--<li <?php //if($page_name == 'settings') echo 'class="active"'?>>
					<a href="<?php //echo base_url().'?admin/settings';?>" aria-expanded="false">
						<i class="nav-icon ti ti-settings"></i><span class="nav-title">Settings</span>
					</a>
				</li>-->
			</ul>
		</div>
		<!-- end sidebar-nav -->
	</aside>
