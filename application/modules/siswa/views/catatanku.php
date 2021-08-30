<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/siswa/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>

<?php $one->get_css('js/plugins/flatpickr/flatpickr.min.css'); ?>

<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>

<?php $one->get_css('js/plugins/sweetalert2/sweetalert2.min.css'); ?>

<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>
<?php include APPPATH . 'views/inc/siswa/views/inc_navigation.php'; ?>

<div class="content">
	<div class="row">
		<div class="col-sm-6 col-xl-4">
			<div class="form-group">
				<label for="by_tanggal">Tanggal</label>
				<input type="text" class="js-flatpickr form-control bg-white" id="by_tanggal" name="by_tanggal" placeholder="Y-m-d" value="<?= $tanggal; ?>">
			</div>
		</div>
		<div class="col-sm-12">
			<a class="block block-rounded js-appear-enabled animated fadeIn block-link-pop" href="javascript:void(0)">
				<div class="block-header block-header-default">
					<h3 class="block-title"><?= 'Catatan ' . $nama_kegiatan; ?></h3>
				</div>
				<div class="block-content">
					<div class="table-responsive push font-size-sm">
						<table class="table table-bordered table-striped table-hover table-vcenter start-at-40">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Nama Kegiatan</th>
									<th class="text-center">Waktu</th>
									<th class="text-center"><?= $hari . ', ' . tanggal($tanggal); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1; ?>
								<?php if (is_array($kegiatan) || is_object($kegiatan)) : ?>
									<?php foreach ($kegiatan as $hasil) : ?>
										<?php

										$cek = $this->universal->getOne([
											'id_kegiatan'	=> $hasil->id,
											'nisn'			=> $this->user->nisn,
											'DATE(tanggal)' => $tanggal
										], 'catatan');

										$current_time = date('H:i:s');
										$sunrise = $hasil->mulai;
										$sunset = $hasil->akhir;
										$date1 = DateTime::createFromFormat('H:i:s', $current_time);
										$date2 = DateTime::createFromFormat('H:i:s', $sunrise);
										$date3 = DateTime::createFromFormat('H:i:s', $sunset);
										?>

										<tr>
											<td class="text-center font-size-sm"><?= $i++; ?></td>
											<td class="font-size-sm"><?= $hasil->nama_kegiatan; ?></td>
											<td class="text-center font-size-sm"><?= $hasil->mulai . ' - ' . $hasil->akhir; ?></td>
											<td class="text-center font-size-sm">
												<div class="btn-group">
													<?php if ($cek) : ?>
														<?php if ($date1 > $date2 && $date1 < $date3) : ?>
															<button type="button" class="btn btn-sm btn-danger tombol-hapus" data-href="<?= base_url('siswa/catatanku/delete/') . enkrip($cek->id) . '/' . enkrip(str_replace(' ', '_', $hasil->nama_kegiatan)); ?>" data-text="data akan dihapus" data-toggle="tooltip" title="Hapus bukti upload">
																<i class="fa fa-trash"></i>
															</button>
														<?php endif; ?>
														<button type="button" class="btn btn-sm btn-info btn-view-bukti" data-toggle="modal" title="Lihat bukti upload" data-target="#view-bukti" data-nama_file="<?= base_url('upload/' . str_replace(' ', '_', $hasil->nama_kegiatan) . '/' . $cek->nama_file); ?>" data-header="<?= $nama_kategori . ' - ' . $hasil->nama_kegiatan; ?>" data-ket="<?= $cek->ket; ?>" data-tanggal="<?= tanggal(date('Y-m-d', strtotime($cek->tanggal))) . ' - ' . date('H:i:s', strtotime($cek->tanggal)); ?>">
															<i class="fa fa-eye"></i>
														</button>
													<?php endif; ?>

													<?php if ($tanggal != date('Y-m-d')) : ?>
														<button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Sudah terlewat atau belum waktunya">
															<i class="fa fa-times"></i>
														</button>
													<?php else : ?>
														<?php if ($date1 > $date2 && $date1 < $date3) : ?>
															<button type="button" class="btn btn-sm btn-success btn-add" data-toggle="modal" title="Upload bukti" data-target="#modal-add" data-id_kegiatan="<?= enkrip($hasil->id); ?>" data-nm_kat="<?= enkrip($hasil->nama_kegiatan); ?>" data-header="<?= $nama_kategori . ' - ' . $hasil->nama_kegiatan; ?>" data-tgl="<?= ($cek) ? enkrip($cek->tanggal) : ''; ?>" data-ket="<?= ($cek) ? $cek->ket : ''; ?>">
																<i class="fa fa-upload"></i>
															</button>
														<?php else : ?>
															<?php if (!$cek) : ?>
																<button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Sudah terlewat atau belum waktunya">
																	<i class="fa fa-times"></i>
																</button>
															<?php endif; ?>
														<?php endif; ?>

													<?php endif; ?>


												</div>
											</td>
										</tr>
									<?php endforeach; ?>
								<?php else : ?>
									<tr>
										<td colspan="7" class="text-center">Data tidak ditemukan.</td>
									</tr>
								<?php endif; ?>
							</tbody>
							</tfoot>
						</table>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromright" aria-hidden="true">
	<div class="modal-dialog modal-dialog-fromright" role="document">
		<div class="modal-content">
			<div class="block block-rounded block-themed block-transparent mb-0">
				<div class="block-header block-header-default">
					<h3 class="block-title" id="header"></h3>
					<div class="block-options">
						<button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
							<i class="fa fa-fw fa-times"></i>
						</button>
					</div>
				</div>
				<div class="block-content font-size-sm">
					<form action="<?= base_url('siswa/catatanku/add_bukti'); ?>" method="post" enctype="multipart/form-data">
						<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						<div class="row">
							<div class="block-content font-size-sm">
								<div class="form-group">
									<input type="hidden" name="nm_kat" class="form-control" id="nm_kat" readonly>
									<input type="hidden" name="id_kegiatan" class="form-control" id="id_kegiatan" readonly>
									<input type="hidden" name="tgl" class="form-control" id="tgl" readonly>
									<label for="ket">Keterangan</label>
									<textarea name="ket" cols="30" rows="3" id="ket" class="form-control"></textarea>
								</div>
								<div class="form-group">
									<label for="nama">File Upload</label>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="image" data-toggle="custom-file-input" accept=".jpg, .png, .jpeg" name="file_bukti">
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
</div>

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

<script>
	$('#by_tanggal').change(function() {
		let tanggal = $(this).val();

		document.location.href = '<?php echo base_url('siswa/catatanku/') . $this->u3 . '/' ?>' + tanggal;
	});

	let btn_add = $('.btn-add');

	$(btn_add).each(function(i) {
		$(btn_add[i]).click(function() {
			let id_kegiatan = $(this).data('id_kegiatan');
			let header = $(this).data('header');
			let nm_kat = $(this).data('nm_kat');
			let tgl = $(this).data('tgl');
			let ket = $(this).data('ket');

			$('#header').html('<i class="fa fa-upload"></i> ' + header);
			$('#id_kegiatan').val(id_kegiatan);
			$('#nm_kat').val(nm_kat);
			$('#tgl').val(tgl);
			$('#ket').val(ket);
		});
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

	$('li.nav-main-item').find('a[href*="<?= base_url('siswa/catatanku/') . $this->u3 ?>"]').addClass('active');

	jQuery(function() {
		One.helpers(['flatpickr']);
	});
</script>

<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>