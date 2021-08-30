<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/siswa/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>
<?php include APPPATH . 'views/inc/siswa/views/inc_navigation.php'; ?>

<!-- Page Content -->
<div class="content">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Data Diri</h3>
            <div class="block-options">
                <button type="button" onclick="window.location.href='<?= base_url('siswa/profil/edit') ?>'" class="btn btn-sm btn-alt-light"><i class="fa fa-edit"></i> Perbarui Data Diri</button>
            </div>
        </div>
        <div class="block-content">
            <div class="row push">
                <div class="col-sm-3 text-center">
                    <div class="mb-3 py-1">
                        <img class="img-thumbnail" style="width: 200px;" src="<?=
                                                                                ($this->user->foto == 'default.jpg' || $this->user->foto == '') ?
                                                                                    base_url('upload/default.jpg') :
                                                                                    base_url('upload/siswa/' . $this->user->foto)
                                                                                ?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Upload foto dalam format JPEG/PNG/JPG. Usahakan menggunakan skala 1x1 agar foto menjadi lebih rapi. Klik foto untuk merubah foto saat ini. Maksimal 2MB" alt="<?= $this->user->nama ?>">
                        <br>
                        <span class="mt-3 badge badge-success">Siswa <?= $this->user->nama_status ?></span>
                        <address class="font-size-sm">
                            Kelas <?= $this->user->kelas ?>
                        </address>
                    </div>
                </div>
                <div class="col-sm-9 py-2 d-none d-sm-block">
                    <table>
                        <tbody>
                            <tr>
                                <td style="width:240px;"><b>NISN</b></td>
                                <td><b>:</b>&nbsp;<?= $this->user->nisn ?></td>
                            </tr>
                            <tr>
                                <td><b>Status Siswa</b></td>
                                <td><b>:</b>&nbsp;<?= $this->user->nama_status ?></td>
                            </tr>
                            <tr>
                                <td><b>Nama Lengkap</b></td>
                                <td><b>:</b>&nbsp;<?= $this->user->nama ?></td>
                            </tr>
                            <tr>
                                <td><b>Kelas</b></td>
                                <td><b>:</b>&nbsp;<?= $this->user->kelas ?></td>
                            </tr>
                            <tr>
                                <td><b>Jenis Kelamin</b></td>
                                <td><b>:</b>&nbsp;<?= ($this->user->jk == 'L') ? 'Laki - laki' : 'Perempuan' ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require APPPATH . 'views/inc/_global/views/page_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/footer_start.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>