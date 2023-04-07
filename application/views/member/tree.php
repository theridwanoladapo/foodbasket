<style>
/*Now the CSS*/
.tree ul {
	padding-top: 20px;
	position: relative;
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

.tree li {
	float: left; text-align: center;
	list-style-type: none;
	position: relative;
	padding: 20px 5px 0 5px;
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*We will use ::before and ::after to draw the connectors*/

.tree li::before, .tree li::after{
	content: '';
	position: absolute; top: 0; right: 50%;
	border-top: 1px solid #ccc;
	width: 50%; height: 20px;
}
.tree li::after{
	right: auto; left: 50%;
	border-left: 1px solid #ccc;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
	display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child{ padding-top: 0;}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after{
	border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before{
	border-right: 1px solid #ccc;
	border-radius: 0 5px 0 0;
	-webkit-border-radius: 0 5px 0 0;
	-moz-border-radius: 0 5px 0 0;
}
.tree li:first-child::after{
	border-radius: 5px 0 0 0;
	-webkit-border-radius: 5px 0 0 0;
	-moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before{
	content: '';
	position: absolute; top: 0; left: 50%;
	border-left: 1px solid #ccc;
	width: 0; height: 20px;
}

.tree li a{
	background: #FFFFFF;
	border: 1px solid #132FD1;
	padding: 10px 15px;
	text-decoration: none;
	font-family: arial, verdana, tahoma;
	font-size: 11px;
	display: inline-block;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	transition: all 0.5s;
	-webkit-transition: all 0.5s;
	-moz-transition: all 0.5s;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li a:hover, .tree li a:hover+ul li a {
	background: #0024D1;
	color: #FFFFFF;
	border: 1px solid #0024D1;
}
.tree li a:hover h4, .tree li a:hover h5 {
	color: #FFFFFF;
}
/*Connector styles on hover*/
.tree li a:hover+ul li::after, 
.tree li a:hover+ul li::before, 
.tree li a:hover+ul::before, 
.tree li a:hover+ul ul::before{
	border-color:  #94a0b4;
}

/*Thats all. I hope you enjoyed it.
Thanks :)*/
</style>
<!--
We will create a family tree using just CSS(3)
The markup will be simple nested lists
-->

<div class="app-main" id="main">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin row -->
		<div class="row">
			<div class="col-md-12 m-b-30">
				<!-- begin page title -->
				<div class="tree">
					<ul>
						<li>
							<a href="javascript:void">
								<h4>Grand Parent</h4>
								<h5>Level 1 Stage 4</h5>
							</a>
							<ul>
								<li>
									<a href="#">Child 1</a>
									<ul>
										<li>
											<a href="#">Child 1.1</a>
											<ul>
												<li>
													<a href="#">Child 1.1.1</a>
												</li>
												<li>
													<a href="#">Child 1.1.2</a>
												</li>
											</ul>
										</li>
										<li>
											<a href="#">Child 1.2</a>
											<ul>
												<li>
													<a href="#">Child 1.2.1</a>
												</li>
												<li>
													<a href="#">Child 1.2.2</a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<a href="#">Child 2</a>
									<ul>
										<li>
											<a href="#">Child 2.1</a>
											<ul>
												<li>
													<a href="#">Child 2.1.1</a>
												</li>
												<li>
													<a href="#">Child 2.1.2</a>
												</li>
											</ul>
										</li>
										<li>
											<a href="#">Child 2.2</a>
											<ul>
												<li>
													<a href="#">Child 2.2.1</a>
												</li>
												<li>
													<a href="#">Child 2.2.2</a>
												</li>
											</ul>
										</li>
									</ul>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>