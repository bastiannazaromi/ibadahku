<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/siswa/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>
<?php include APPPATH . 'views/inc/siswa/views/inc_navigation.php'; ?>

<div class="content">
	<div class="block block-rounded">
		<div class="block-header block-header-default">
			<h3 class="block-title">Edit Data Diri</h3>
			<div class="block-options">
				<button type="button" onclick="window.location.href='<?php echo base_url('siswa/profil') ?>'" class="btn btn-sm btn-alt-light"><i class="fa fa-times"></i> Batalkan</button>
			</div>
		</div>
		<div class="block-content block-content-full">
			<form action="<?= base_url('siswa/profil/update') ?>" method="POST" enctype="multipart/form-data">
				<input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="example-text-input">NISN</label>
								<input type="text" class="form-control" id="nisn" name="nisn" value="<?= $this->user->nisn ?>" disabled>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label for="example-text-input">Nama Lengkap</label>
								<input type="text" readonly class="form-control" id="nama" name="nama" value="<?= $this->user->nama ?>" required>
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Kelas</label>
								<input type="number" class="form-control" name="kelas" value="<?= $this->user->kelas ?>" required readonly>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Jenis Kelamin</label>
								<input type="text" class="form-control" readonly name="jk" value="<?= ($this->user->jk == 'L') ? 'Laki - laki' : 'Perempuan' ?>">
							</div>
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								<label>Foto Anda</label>
								<div class="push">
									<img class="img-avatar img-avatar128" id="gambar_nodin" src="
                                <?=
								($this->user->foto == 'default.jpg' || $this->user->foto == '') ?
									base_url('upload/default.jpg') :
									base_url('upload/siswa/' . $this->user->foto)
								?>
                                " alt="Profile">
								</div>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="image" data-toggle="custom-file-input" name="foto" accept="image/*">
									<label class="custom-file-label" for="one-profile-edit-avatar">Ubah Foto Anda</label>
								</div>
							</div>
						</div>
					</div>
					<hr>
					<button type="submit" class="btn btn-alt-secondary mb-2">Simpan Data</button>
				</div>
			</form>
		</div>
	</div>
</div>

<?php require APPPATH . 'views/inc/_global/views/page_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/footer_start.php'; ?>
<script>
	function bacaGambar(a) {
		if (a.files && a.files[0]) {
			var e = new FileReader;
			e.onload = function(a) {
				$("#gambar_nodin").attr("src", a.target.result)
			}, e.readAsDataURL(a.files[0])
		}
	}
	$("#image").change(function() {
		bacaGambar(this)
	})
</script>
<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>