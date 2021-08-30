<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/admin/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>

<?php $one->get_css('js/plugins/datatables/dataTables.bootstrap4.css'); ?>
<?php $one->get_css('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css'); ?>

<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>
<?php $one->get_css('toastr/toastr.min.css'); ?>
<?php $one->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>
<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="block block-rounded">
				<div class="block-header block-header-default">
					<h3 class="block-title">Kategori Ibadah</h3>
					<div class="block-options">
						<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add">
							<i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
				<div class="block-content block-content-full">
					<form action="<?= base_url('admin/kategori_ibadah/multiple_delete'); ?>" method="post">
						<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover table-vcenter start-at-40">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Nama Kategori</th>
										<th class="text-center" style="width: 120px;">Action</th>
										<th class="text-center">
											<center><input type="checkbox" id="check-all"></center>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php if (is_array($kategori) || is_object($kategori)) : ?>
										<?php foreach ($kategori as $hasil) : ?>
											<tr>
												<td class="text-center font-size-sm"><?= $i++; ?></td>
												<td class="text-center font-size-sm"><?= $hasil->nama_kategori; ?></td>
												<td class="text-center">
													<div class="btn-group">
														<button type="button" class="btn btn-sm btn-warning edit_btn" data-toggle="modal" data-target="#modal-edit" data-id="<?= enkrip($hasil->id); ?>" data-nama="<?= $hasil->nama_kategori; ?>" title="Edit">
															<i class="fa fa-fw fa-pencil-alt"></i>
														</button>
													</div>
												</td>
												<td>
													<center>
														<input type="checkbox" class="check-item" name="id_kat[]" value="<?= enkrip($hasil->id) ?>">
													</center>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php endif; ?>
								</tbody>
								<tfoot>
									<tr class="table table-warning">
										<th colspan="3"></th>
										<th>
											<center>
												<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus data-data ini ?')"><i class="fa fa-trash "></i></button>
											</center>
										</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- END Dynamic Table Full Pagination -->

</div>
<!-- END Page Content -->

<!-- Modal Add -->
<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright" role="document">
		<div class="modal-content">
			<div class="block block-rounded block-themed block-transparent mb-0">
				<div class="block-header block-header-default">
					<h3 class="block-title">Add Kategori</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-fw fa-times"></i>
						</button>
					</div>
				</div>
				<div class="block-content font-size-sm">
					<form action="<?= base_url('admin/kategori_ibadah/add'); ?>" method="post">
						<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						<div class="block-content font-size-sm">
							<div class="form-group">
								<label for="nama">Nama Ibadah <sup class="text-warning">***</sup></label>
								<input type="text" class="form-control" name="nama" required autocomplete="off">
							</div>
						</div>
						<div class="block-content block-content-full text-right border-top">
							<button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
				</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- End Modal Add -->

<!-- Modal Edit -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright" role="document">
		<div class="modal-content">
			<div class="block block-rounded block-themed block-transparent mb-0">
				<div class="block-header block-header-default">
					<h3 class="block-title">Edit Kategori</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-fw fa-times"></i>
						</button>
					</div>
				</div>
				<div class="block-content font-size-sm">
					<form action="<?= base_url('admin/kategori_ibadah/edit'); ?>" method="post">
						<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						<input type="hidden" class="form-control" id="id" name="id" required autocomplete="off">
						<div class="form-group">
							<label for="nama">Nama Kategori <sup class="text-warning">***</sup></label>
							<input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
						</div>
						<div class="block-content block-content-full text-right border-top">
							<button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require APPPATH . 'views/inc/_global/views/page_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/datatables/jquery.dataTables.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/dataTables.bootstrap4.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/dataTables.buttons.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/buttons.print.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/buttons.html5.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/buttons.flash.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/buttons.colVis.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_tables_datatables.min.js'); ?>

<?php $one->get_js('toastr/toastr.min.js'); ?>
<?php $one->get_js('js/plugins/sweetalert2/sweetalert2.js'); ?>
<?php $one->get_js('toastr/script.js'); ?>

<!-- Page JS Helpers (BS Notify Plugin) -->
<script>
	let edit_btn = $('.edit_btn');

	$(edit_btn).each(function(i) {
		$(edit_btn[i]).click(function() {
			let id = $(this).data('id');
			let nama = $(this).data('nama');

			$('#id').val(id);
			$('#nama').val(nama);
		});
	});

	$("#check-all").click(function() {
		if ($(this).is(":checked"))
			$(".check-item").prop("checked", true);
		else
			$(".check-item").prop("checked", false);
	});

	$('li.nav-main-item').find('a[href*="<?= base_url('admin/kategori') ?>"]').addClass('active');
	$('li.nav-main-item').find('a[href*="<?= base_url('admin/kategori') ?>"]').parent().parent().parent().addClass('open');
</script>

<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>