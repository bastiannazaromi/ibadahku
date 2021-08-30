<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/admin/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>

<?php $one->get_css('js/plugins/datatables/dataTables.bootstrap4.css'); ?>
<?php $one->get_css('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css'); ?>

<?php $one->get_css('js/plugins/flatpickr/flatpickr.min.css'); ?>

<?php $one->get_css('js/plugins/select2/css/select2.min.css'); ?>

<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>
<?php $one->get_css('toastr/toastr.min.css'); ?>
<?php $one->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>
<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="content">
	<div class="row">
		<div class="col-sm-6 col-xl-6">
			<div class="form-group">
				<label for="by_kelas">Kelas</label>
				<select class="js-select2 form-control" name="by_kelas" id="by_kelas" style="width: 100%;" data-placeholder="Silakan pilih kelas..">
					<option></option>
					<?php foreach ($kelas as $data) : ?>
						<option value="<?= enkrip($data->kelas); ?>" <?= $kelas_ini == $data->kelas ? 'selected="selected"' : ''; ?>><?= $data->kelas; ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-sm-6 col-xl-6">
			<div class="form-group">
				<label for="by_tanggal">Tanggal</label>
				<input type="text" class="js-flatpickr form-control bg-white" id="by_tanggal" name="by_tanggal" placeholder="Y-m-d" value="<?= $tanggal; ?>">
			</div>
		</div>
		<div class="col-sm-12">
			<div class="block block-rounded">
				<div class="block-header block-header-default">
					<h3 class="block-title">Rekap Harian Ibadah <?= $kategori->nama_kategori . ' - ' . $hari . ', ' . tanggal($tanggal); ?></h3>
					<div class="block-options">
						<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add">
							<i class="fa fa-plus"></i>
						</button>
					</div>
				</div>
				<div class="block-content block-content-full">
					<div class="row">
						<div class="col-sm-3 col-xl-3 mb-3">
							<button type="button" class="btn btn-primary" data-toggle="tooltip" onclick="window.open('<?= base_url('admin/rekap_ibadah/excel/') . enkrip($kategori->id) . '/' . enkrip($kelas_ini) . '/' . $tanggal; ?>')">
								<i class="fa fa-fw fa-file-excel"></i> Download Excel
							</button>
						</div>
					</div>
					<form action="<?= base_url('admin/rincian_ibadah/multiple_delete'); ?>" method="post">
						<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover table-vcenter start-at-40">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">NISN</th>
										<th class="text-center">Nama Siswa</th>
										<?php foreach ($kegiatan as $dt) : ?>
											<th class="text-center"><?= str_replace(' ', '_', $dt->nama_kegiatan); ?></th>
										<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>
									<?php if (is_array($siswa) || is_object($siswa)) : ?>
										<?php foreach ($siswa as $hasil) : ?>
											<tr>
												<td class="text-center font-size-sm"><?= $i++; ?></td>
												<td class="text-center font-size-sm"><?= $hasil->nisn; ?></td>
												<td class="font-size-sm"><?= $hasil->nama; ?></td>
												<?php foreach ($kegiatan as $dt) : ?>
													<?php
													$cek = $this->universal->getOne([
														'id_kegiatan'	=> $dt->id,
														'nisn'			=> $hasil->nisn,
														'DATE(tanggal)' => $tanggal
													], 'catatan');
													?>
													<td class="text-center font-size-sm">
														<div class="btn-group">
															<?php if ($cek) : ?>
																<button type="button" class="btn btn-sm btn-info btn-view-bukti" data-toggle="modal" title="Lihat bukti upload" data-target="#view-bukti" data-nama_file="<?= base_url('upload/' . str_replace(' ', '_', $dt->nama_kegiatan) . '/' . $cek->nama_file); ?>" data-header="<?= $kategori->nama_kategori . ' - ' . $dt->nama_kegiatan; ?>" data-ket="<?= $cek->ket; ?>" data-tanggal="<?= tanggal(date('Y-m-d', strtotime($cek->tanggal))) . ' - ' . date('H:i:s', strtotime($cek->tanggal)); ?>">
																	<i class="fa fa-eye"></i>
																</button>

															<?php else : ?>
																<button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Tidak ada">
																	<i class="fa fa-times"></i>
																</button>
															<?php endif; ?>
														</div>
													</td>
												<?php endforeach; ?>
											</tr>
										<?php endforeach; ?>
									<?php endif; ?>
								</tbody>
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

<div class="modal" id="view-bukti" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright modal-lg" role="document">
		<div class="modal-content">
			<div class="block block-rounded block-themed block-transparent mb-0">
				<div class="block-header block-header-default">
					<h3 class="block-title text-center" id="view-header"></h3>
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
								<label id="tanggal-view"></label>
								<br>
								<label id="ket-view"></label>
							</div>
							<div class="text-center mb-4">
								<img src="" style="width: 60%; height: 60%;" id="img-src" class="img-fluid">
							</div>
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

<?php $one->get_js('js/plugins/flatpickr/flatpickr.min.js'); ?>

<?php $one->get_js('js/plugins/select2/js/select2.full.min.js'); ?>

<?php $one->get_js('toastr/toastr.min.js'); ?>
<?php $one->get_js('js/plugins/sweetalert2/sweetalert2.js'); ?>
<?php $one->get_js('toastr/script.js'); ?>

<!-- Page JS Helpers (BS Notify Plugin) -->
<script>
	$('#by_kelas').change(function() {
		let status = $(this).find(':selected').val();
		document.location.href = '<?php echo base_url('admin/rekap_ibadah/') . $this->u3 . '/' ?>' + status;
	});

	$('#by_tanggal').change(function() {
		let status = $('#by_kelas').find(':selected').val();
		let tanggal = $(this).val();

		document.location.href = '<?php echo base_url('admin/rekap_ibadah/') . $this->u3 . '/' ?>' + status + '/' + tanggal;
	});

	/* tombol view bukti */
	let btn_view = $('.btn-view-bukti');

	$(btn_view).each(function(i) {
		$(btn_view[i]).click(function() {
			let header = $(this).data('header');
			let nama_file = $(this).data('nama_file');
			let ket = $(this).data('ket');
			let tanggal = $(this).data('tanggal');

			$('#img-src').attr('src', nama_file);
			$('#view-header').text('Lihat bukti upload ' + header);
			$('#ket-view').text('Keterangan : ' + ket);
			$('#tanggal-view').text('Tanggal Upload : ' + tanggal);

			console.log(nama_file);
		});
	});

	$('li.nav-main-item').find('a[href*="<?= base_url('admin/rekap_ibadah/') . $this->u3 ?>"]').addClass('active');
	$('li.nav-main-item').find('a[href*="<?= base_url('admin/rekap_ibadah/') . $this->u3 ?>"]').parent().parent().parent().addClass('open');

	jQuery(function() {
		One.helpers(['select2', 'flatpickr']);
	});
</script>

<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>