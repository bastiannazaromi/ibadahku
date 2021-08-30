<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/siswa/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>

<?php $one->get_css('js/plugins/flatpickr/flatpickr.min.css'); ?>

<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>

<?php $one->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>

<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>
<?php include APPPATH . 'views/inc/siswa/views/inc_navigation.php'; ?>

<!-- Page Content -->
<div class="content">
	<div class="row">
		<div class="col-sm-4 col-xl-4">
			<div class="form-group">
				<label for="by_tanggal_awal">Tanggal Awal</label>
				<input type="text" class="js-flatpickr form-control bg-white" id="by_tanggal_awal" name="by_tanggal_awal" placeholder="Y-m-d" value="<?= $tanggal_awal; ?>">
			</div>
		</div>
		<div class="col-sm-4 col-xl-4">
			<div class="form-group">
				<label for="by_tanggal_akhir">Tanggal Akhir</label>
				<input type="text" class="form-control bg-white" id="by_tanggal_akhir" name="by_tanggal_akhir" placeholder="Y-m-d" value="<?= $tanggal_akhir; ?>">
			</div>
		</div>
		<div class="col-sm-12">
			<div class="block block-rounded">
				<div class="block-header block-header-default">
					<h3 class="block-title">Rekap Harian Ibadah - <?= $hari_awal . ', ' . tanggal($tanggal_awal) . ' s/d ' . $hari_akhir . ', ' . tanggal($tanggal_akhir); ?></h3>
				</div>
				<div class="block-content block-content-full">
					<form action="<?= base_url('siswa/rincian_ibadah/multiple_delete'); ?>" method="post">
						<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						<div class="table-responsive">
							<?php
							$begin = new DateTime($tanggal_awal);
							$end = new DateTime($tanggal_akhir);
							$end->modify('+1 day');

							$interval = DateInterval::createFromDateString('1 day');
							$period = new DatePeriod($begin, $interval, $end);

							?>
							<table class="table table-bordered table-striped table-hover table-vcenter">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="text-center">Kategori</th>
										<th class="text-center">No</th>
										<th class="text-center">Kegiatan</th>
										<?php foreach ($period as $per) : ?>
											<th class="text-center"><?= $per->format("d_m_Y"); ?></th>
										<?php endforeach; ?>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;
									$kegiatan = ''; ?>
									<?php if (is_array($kategori) || is_object($kategori)) : ?>
										<?php foreach ($kategori as $hasil) : ?>
											<?php
											$kegiatan = $this->universal->getMulti(['id_kategori' => $hasil->id], 'kegiatan');
											$row_keg = count($kegiatan) + 1;
											?>
											<tr>
												<td class="font-size-sm text-center h6" rowspan="<?= $row_keg; ?>"><?= $i++; ?></td>
												<td class="font-size-sm h6" rowspan="<?= $row_keg; ?>"><?= $hasil->nama_kategori; ?></td>
											</tr>
											<?php foreach ($kegiatan as $c => $dt) : ?>
												<tr>
													<td class="font-size-sm"><?= $c + 1; ?></td>
													<td class="font-size-sm"><?= $dt->nama_kegiatan; ?></td>
													<?php foreach ($period as $per) : ?>
														<?php
														$cek = $this->universal->getOne([
															'id_kegiatan'	=> $dt->id,
															'nisn'			=> $this->user->nisn,
															'DATE(tanggal)' => $per->format("Y-m-d")
														], 'catatan');
														?>
														<td class="text-center font-size-sm">
															<div class="btn-group">
																<?php if ($cek) : ?>
																	<button type="button" class="btn btn-sm btn-info btn-view-bukti" data-toggle="modal" title="Lihat bukti upload" data-target="#view-bukti" data-nama_file="<?= base_url('upload/' . str_replace(' ', '_', $dt->nama_kegiatan) . '/' . $cek->nama_file); ?>" data-header="<?= $hasil->nama_kategori . ' - ' . $dt->nama_kegiatan; ?>" data-ket="<?= $cek->ket; ?>" data-tanggal="<?= tanggal(date('Y-m-d', strtotime($cek->tanggal))) . ' - ' . date('H:i:s', strtotime($cek->tanggal)); ?>">
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

<?php $one->get_js('js/plugins/flatpickr/flatpickr.min.js'); ?>

<?php $one->get_js('toastr/toastr.min.js'); ?>
<?php $one->get_js('js/plugins/sweetalert2/sweetalert2.js'); ?>
<?php $one->get_js('toastr/script.js'); ?>

<!-- Page JS Helpers (BS Notify Plugin) -->
<script>
	$('#by_tanggal_awal').change(function() {
		$('#by_tanggal_akhir').flatpickr({
			minDate: $(this).val(),
			maxDate: new Date($(this).val()).fp_incr(6)
		});
	});

	$('#by_tanggal_akhir').change(function() {
		let tanggal_awal = $('#by_tanggal_awal').val();
		let tanggal_akhir = $(this).val();

		document.location.href = '<?php echo base_url('siswa/rekap/'); ?>' + tanggal_awal + '/' + tanggal_akhir;
	});

	$('#by_tanggal_akhir').flatpickr({
		dateFormat: 'Y-m-d',
		minDate: '<?= $tanggal_awal; ?>',
		maxDate: new Date('<?= $tanggal_awal; ?>').fp_incr(6)
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

	$('li.nav-main-item').find('a[href*="<?= base_url('siswa/rekap') ?>"]').addClass('active');

	jQuery(function() {
		One.helpers(['select2', 'flatpickr']);
	});
</script>

<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>