<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/siswa/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>
<?php include APPPATH . 'views/inc/siswa/views/inc_navigation.php'; ?>

<div class="content">
    <div class="row">
        <div class="col-sm-6 col-xl-8">
            <a class="block block-rounded block-link-pop" href="<?php echo base_url('siswa/profil') ?>">
                <div class="block block-rounded">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Informasi Siswa</h3>
                    </div>
                    <div class="block-content">
                        <div class="row">
                            <div class="col-sm-3 text-center">
                                <div class="mb-3 py-1">
                                    <img class="img-thumbnail" style="width: 120px;" src="
                                            <?= ($this->user->foto == 'default.jpg' || $this->user->foto == '') ? base_url('upload/default.jpg') :
                                                base_url('upload/siswa/' . $this->user->foto)
                                            ?>
                                            " alt="<?= $this->user->nama; ?>">
                                </div>
                            </div>
                            <div class="col-sm-9 py-2">
                                <div class="font-size-h3 font-w600">
                                    <?= $this->user->nama; ?> <sup><span class="badge badge-success"><?= $this->user->nama_status ?></span></sup>
                                </div>
                                <address class="font-size-sm">
                                    <p class="font-size-h6"><b>NISN :</b> <?= $this->user->nisn; ?>
                                        <br>
                                        <b>Kelas : <?= $this->user->kelas ?></b>
                                    </p>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php require APPPATH . 'views/inc/_global/views/page_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/footer_start.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>