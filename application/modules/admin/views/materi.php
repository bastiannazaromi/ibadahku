<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/admin/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>

<?php $one->get_css('js/plugins/datatables/dataTables.bootstrap4.css'); ?>
<?php $one->get_css('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css'); ?>

<?php $one->get_css('js/plugins/select2/css/select2.min.css'); ?>

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
					<h3 class="block-title">Materi</h3>
					<div class="block-options">
						<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add">
							<i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
				<div class="block-content block-content-full">
					<form action="<?= base_url('admin/materi/multiple_delete'); ?>" method="post">
						<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover table-vcenter start-at-25">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Jenis Materi</th>
										<th class="text-center">Deskripsi</th>
										<th class="text-center" style="width: 120px;">Action</th>
										<th class="text-center">
											<center><input type="checkbox" id="check-all"></center>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php if (is_array($materi) || is_object($materi)) : ?>
										<?php foreach ($materi as $hasil) : ?>
											<tr>
												<td class="text-center font-size-sm"><?= $i++; ?></td>
												<td class="text-center font-size-sm">
													<span class="badge <?= ($hasil->tipe == 1) ? 'badge-danger' : 'badge-primary'; ?>"><?= ($hasil->tipe == 1) ? 'PDF' : 'Video'; ?></span>
												</td>
												<td class="font-size-sm"><?= $hasil->deskripsi; ?></td>
												<td class="text-center">
													<div class="btn-group">
														<button type="button" class="btn btn-sm btn-info btn-view" data-toggle="modal" data-target="#modal-view" title="Lihat materi" data-nama_file="<?= base_url('upload/materi/' . $hasil->nama_file); ?>" data-tipe="<?= $hasil->tipe; ?>" data-deskrip="<?= $hasil->deskripsi; ?>">
															<i class="fa fa-eye"></i>
														</button>
													</div>
												</td>
												<td>
													<center>
														<input type="checkbox" class="check-item" name="id[]" value="<?= enkrip($hasil->id) ?>">
													</center>
												</td>
											</tr>
										<?php endforeach; ?>
									<?php endif; ?>
								</tbody>
								<tfoot>
									<tr class="table table-warning">
										<th colspan="4"></th>
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
					<h3 class="block-title">Add Materi</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-fw fa-times"></i>
						</button>
					</div>
				</div>
				<div class="block-content font-size-sm">
					<form action="<?= base_url('admin/materi/add'); ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						<div class="block-content font-size-sm">
							<div class="form-group">
								<label for="jk">Jenis Materi <sup class="text-warning">***</sup></label>
								<select class="js-select2 form-control" name="tipe" style="width: 100%;" data-placeholder="Silakan pilih jenis materi..">
									<option value="">-</option>
									<option value="<?= enkrip(1); ?>">PDF</option>
									<option value="<?= enkrip(2); ?>">Video</option>
								</select>
							</div>
							<div class="form-group">
								<label for="nama">Deskripsi <sup class="text-warning">***</sup></label>
								<textarea class="form-control" name="deskripsi" col="30" rows="3" required></textarea>
							</div>

							<div class="form-group">
								<label for="nama">File Upload</label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" data-toggle="custom-file-input" accept=".pdf, .mp4, .avi" name="file_upload">
									<label class="custom-file-label" for="one-profile-edit-avatar">Pilih file</label>
								</div>
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


<div class="modal" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright modal-xl" role="document">
		<div class="modal-content">
			<div class="block block-rounded block-themed block-transparent mb-0">
				<div class="block-header block-header-default">
					<h3 class="block-title text-center">Lihat Materi</h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-fw fa-times"></i>
						</button>
					</div>
				</div>
				<div class="block-content font-size-sm">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label id="deskripsi-view"></label>
							</div>
						</div>
						<div class="col-lg-12 text-center">
							<iframe type="application/pdf" class="d-none" src="" id="pdf" style="width: 100%;" height="600px"></iframe>
							<video style="width: 100%;" height="600px" controls id="vidio" class="d-none">
								<source src="" type="video/mp4">
								Your browser does not support HTML video.
							</video>
						</div>
					</div>
				</div>
				<div class="block-content block-content-full text-right border-top">
					<button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
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

<?php $one->get_js('js/plugins/select2/js/select2.full.min.js'); ?>

<?php $one->get_js('toastr/toastr.min.js'); ?>
<?php $one->get_js('js/plugins/sweetalert2/sweetalert2.js'); ?>
<?php $one->get_js('toastr/script.js'); ?>

<!-- Page JS Helpers (BS Notify Plugin) -->
<script>
	let btn_view = $('.btn-view');

	$(btn_view).each(function(i) {
		$(btn_view[i]).click(function() {
			let nama_file = $(this).data('nama_file');
			let deskripsi = $(this).data('deskrip');
			let tipe = $(this).data('tipe');

			if (tipe == 1) {
				$('#vidio').addClass('d-none');
				$('#pdf').removeClass("d-none");
				$('#pdf').attr('src', nama_file);
				$('#vidio').attr('src', '');
			} else {
				$('#pdf').addClass('d-none');
				$('#vidio').removeClass("d-none");
				$('#vidio').attr('src', nama_file);
				$('#pdf').attr('src', '');
			}

			$('#deskripsi-view').text(deskripsi);
		});
	});

	let edit_btn = $('.edit_btn');

	$("#check-all").click(function() {
		if ($(this).is(":checked"))
			$(".check-item").prop("checked", true);
		else
			$(".check-item").prop("checked", false);
	});

	$('li.nav-main-item').find('a[href*="<?= base_url('admin/materi') ?>"]').addClass('active');
	$('li.nav-main-item').find('a[href*="<?= base_url('admin/materi') ?>"]').parent().parent().parent().addClass('open');

	jQuery(function() {
		One.helpers(['select2']);
	});
</script>

<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>