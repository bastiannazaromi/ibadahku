<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/siswa/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>

<?php $one->get_css('js/plugins/datatables/dataTables.bootstrap4.css'); ?>
<?php $one->get_css('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css'); ?>

<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>

<?php $one->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>

<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>
<?php include APPPATH . 'views/inc/siswa/views/inc_navigation.php'; ?>

<!-- Page Content -->
<div class="content">
	<div class="row">
		<div class="col-sm-12">
			<div class="block block-rounded">
				<div class="block-header block-header-default">
					<h3 class="block-title">Daftar Materi</h3>
				</div>
				<div class="block-content block-content-full">
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-hover table-vcenter start-at-25">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Deskripsi</th>
									<th class="text-center" style="width: 120px;">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								$kegiatan = ''; ?>
								<?php if (is_array($materi) || is_object($materi)) : ?>
									<?php foreach ($materi as $hasil) : ?>
										<tr>
											<td class="text-center font-size-sm"><?= $i++; ?></td>
											<td class="font-size-sm"><?= $hasil->deskripsi; ?></td>
											<td class="text-center">
												<div class="btn-group">
													<button type="button" class="btn btn-sm btn-info btn-view" data-toggle="tooltip" title="Lihat materi" data-nama_file="<?= base_url('upload/materi/' . $hasil->nama_file); ?>" data-tipe="<?= $hasil->tipe; ?>" data-deskrip="<?= $hasil->deskripsi; ?>">
														<i class="fa fa-eye"></i>
													</button>
												</div>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="block block-rounded">
				<div class="block-header block-header-default">
					<h3 class="block-title text-center">Preview Materi</h3>
				</div>
				<div class="block-content block-content-full">
					<iframe type="application/pdf" class="d-none" src="" id="pdf" style="width: 100%;" height="600px"></iframe>
					<video style="width: 100%;" height="600px" controls id="vidio" class="d-none">
						<source src="" type="video/mp4">
						Your browser does not support HTML video.
					</video>
				</div>
			</div>
		</div>
	</div>
	<!-- END Dynamic Table Full Pagination -->
</div>
<!-- END Page Content -->

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


	$('li.nav-main-item').find('a[href*="<?= base_url('siswa/materi') ?>"]').addClass('active');
</script>

<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>