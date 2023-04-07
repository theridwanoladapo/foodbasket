		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
						<h5 class="m-0 text-dark"> <?php echo $page_title; ?> </h5>
						</div>
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>index.php?admin/dashboard">Dashboard</a></li>
								<li class="breadcrumb-item active"> Library </li>
							</ol>
						</div>
					</div>
				</div><!-- /.container-fluid -->
			</section>
			
			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-12">
							<!-- Default box -->
							<div class="card card-primary card-outline">
								<div class="card-body">
									<ul class="nav nav-tabs" id="book-tab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="book-list-tab" data-toggle="pill" href="#book-list" role="tab" aria-controls="book-list" aria-selected="true">
											<i class="fa fa-list"></i> &nbsp; Book List
											</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="add-book-tab" data-toggle="pill" href="#add-book" role="tab" aria-controls="add-book" aria-selected="false">
											<i class="fa fa-plus-circle"></i> &nbsp; Add Book
											</a>
										</li>
									</ul>
									
									<div class="tab-content" id="book-tabContent">
										<div class="tab-pane fade show active" id="book-list" role="tabpanel" aria-labelledby="book-list-tab">
											<div class="card-body table-responsive pl-0 pr-0">
												<table id="book" class="table table-bordered table-striped">
													<thead>
														<tr>
															<th> # </th>
															<th> Book Name </th>
															<th> Author </th>
															<th> Description </th>
															<th> Copies </th>
															<th> Class </th>
															<th> Options </th>
														</tr>
													</thead>
													
													<tbody>
														<?php
															$count = 1;
															foreach($books as $row):
														?>
														<tr>
															<td><?php echo $count++;?></td>
															<td><?php echo ucwords($row['name']); ?></td>
															<td><?php echo ucwords($row['author']); ?></td>
															<td><?php echo ucfirst($row['description']); ?></td>
															<td><?php echo $row['total_copies']; ?></td>
															<td>
																<?php echo ucwords($this->db->get_where('class',
																array('class_id' => $row['class_id']))->row()->name);?> 
															</td>
															<td>
																<div class="btn-group">
																	<button type="button" class="btn btn-info btn-sm">Action</button>
																	<button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
																		<span class="caret"></span>
																		<span class="sr-only">Toggle Dropdown</span>
																	</button>
																	
																	<div class="dropdown-menu" role="menu">
																		<a class="dropdown-item" href="<?php echo base_url();?>index.php?librarian/download_book/<?php echo $row['book_id'];?>">
																			<i class="fas fa-download"></i>
																			&nbsp; Download
																		</a>
																		
																		<a class="dropdown-item" href="javascript:;" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/modal_edit_book/<?php echo $row['book_id'];?>');">
																			<i class="fas fa-pencil-alt"></i>
																			&nbsp; Edit
																		</a>
																		
																		<div class="dropdown-divider"></div>
																		
																		<a class="dropdown-item" href="javascript:;" onclick="confirm_modal('<?php echo base_url();?>index.php?librarian/book/delete/<?php echo $row['book_id'];?>');">
																			<i class="fas fa-trash"></i>
																			&nbsp; Delete
																		</a>
																	</div>
																</div>
															</td>
														</tr>
														<?php
															endforeach;
														?>
													</tbody>
												</table>
											</div>
											<!-- /.card-body -->
										</div>
										<div class="tab-pane fade" id="add-book" role="tabpanel" aria-labelledby="add-book-tab">
											<div class="row">
												<div class="col-lg-8">
													<!-- form start -->
													<form class="form-horizontal" method="post" autocomplete="off" action="<?php echo base_url();?>index.php?admin/book/create" enctype="multipart/form-data">
														<div class="card-body">
															<div class="form-group row">
																<label for="inputName" class="col-sm-4 control-label"> &nbsp; Name </label>
																<div class="col-sm-8">
																	<input type="text" name="name" class="form-control text-capitalize" id="inputName" autofocus required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputAuthor" class="col-sm-4 control-label"> &nbsp; Author </label>
																<div class="col-sm-8">
																	<input type="text" name="author" class="form-control text-capitalize" id="inputAuthor" required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputDes" class="col-sm-4 control-label"> &nbsp; Description </label>
																<div class="col-sm-8">
																	<textarea class="form-control" name="description" id="inputDes" style="height:100px"></textarea>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputCopy" class="col-sm-4 control-label"> &nbsp; Copies </label>
																<div class="col-sm-8">
																	<input type="number" name="copies" class="form-control" id="inputCopy" required>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputClass" class="col-sm-4 control-label"> &nbsp; Class </label>
																<div class="col-sm-8">
																	<select name="class_id" class="form-control select2" style="width: 100%;" required>
																		<option value="">Select</option>
																		<?php
																			$classes = $this->db->get('class')->result_array();
																			foreach($classes as $row):
																		?>
																		<option value="<?php echo $row['class_id'];?>">
																			<?php echo ucwords($row['name']);?>
																		</option>
																		<?php
																			endforeach;
																		?>
																	</select>
																</div>
															</div>
															<div class="form-group row">
																<label for="inputFile" class="col-sm-4 control-label"> &nbsp; File </label>
																<div class="col-sm-8">
																	<input type="file" name="file_name" class="form-control" id="inputFile" accept="application/pdf" required>		
																</div>
															</div>
															<div class="form-group row">
																<div class="offset-sm-4 col-sm-8">
																	<button type="submit" class="btn btn-primary"> &nbsp; Add Book &nbsp; </button>
																</div>
															</div>
														</div>
														<!-- /.card-body -->
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /.card-body -->
							</div>
							<!-- /.card -->
						</div>
					</div>
				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		
		<!-- page script -->
		<script type="text/javascript">
			$(function () {
				// Initialize DataTable Elements
				$('#book').DataTable();
				
				// Initialize Select2 Elements
				$('.select2').select2({
					theme: 'bootstrap4'
				})
			});
		</script>