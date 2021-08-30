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
        <div class="col-sm-6 col-xl-6">
            <div class="form-group">
                <label for="by_status">Status</label>
                <select class="js-select2 form-control" name="by_status" id="by_status" style="width: 100%;" data-placeholder="Silakan pilih status..">
                    <option></option>
                    <?php foreach ($status as $data) : ?>
                        <option value="<?= enkrip($data->id); ?>" <?= $status_ini == $data->id ? 'selected="selected"' : ''; ?>><?= $data->nama_status; ?>
                        </option>
                    <?php endforeach; ?>
                    <option value="<?= enkrip('Semua'); ?>" <?= $status_ini == 'Semua' ? 'selected="selected"' : ''; ?>>Semua
                    </option>
                </select>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Daftar Siswa</h3>
                    <div class="block-options">
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" title="Download Format" onclick="window.location='<?= base_url('assets/backend/excel/Format_siswa.xlsx'); ?>'">
                            <i class="fa fa-download"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-import" title="Import Excel">
                            <i class="fa fa-upload"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-add">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <form action="<?= base_url('admin/siswa/multiple_delete'); ?>" method="post">
                        <input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-vcenter start-at-40">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">NISN</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">JK</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" style="width: 120px;">Action</th>
                                        <th class="text-center">
                                            <center><input type="checkbox" id="check-all"></center>
                                        </th>
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
                                                <td class="text-center font-size-sm"><?= $hasil->kelas; ?></td>
                                                <td class="text-center font-size-sm"><?= ($hasil->jk == 'L') ? 'Laki - laki' : 'Perempuan'; ?></td>
                                                <td class="font-size-sm">
                                                    <span class="badge <?php if ($hasil->status == '1') echo 'badge-success';
                                                                        elseif ($hasil->status == '3') echo 'badge-danger';
                                                                        elseif ($hasil->status == '2') echo 'badge-dark'; ?>"><?= $hasil->nama_status; ?></span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-info tombol-confirm" data-href="<?= base_url('admin/siswa/reset/') . enkrip($hasil->nim); ?>" data-text="Password siswa dengan nisn <?= $hasil->nisn; ?> akan direset sesuai dengan nisnnya" data-toggle="tooltip" title="Reset Password">
                                                            <i class="fa fa-key"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-warning edit_btn" data-toggle="modal" data-target="#modal-edit" data-id="<?= enkrip($hasil->id); ?>" title="Edit">
                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <center>
                                                        <input type="checkbox" class="check-item" name="id_siswa[]" value="<?= enkrip($hasil->id) ?>">
                                                    </center>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                                <tfoot>
                                    <tr class="table table-warning">
                                        <th colspan="7"></th>
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
                    <h3 class="block-title">Add Siswa</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    <form action="<?= base_url('admin/siswa/add'); ?>" method="post">
                        <input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="block-content font-size-sm">
                            <div class="form-group">
                                <label for="nim">NISN <sup class="text-warning">***</sup></label>
                                <input type="text" class="js-maxlength form-control" maxlength="10" name="nisn" required autocomplete="off" data-always-show="true" data-placement="bottom-right">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Lengkap <sup class="text-warning">***</sup></label>
                                <input type="text" class="form-control" name="nama" required autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="kelas">Kelas <sup class="text-warning">***</sup></label>
                                <select class="form-control" name="kelas">
                                    <option value="">-- Pilih Kelas --</option>
                                    <?php foreach (range('1', '6') as $elements) : ?>
                                        <option value="<?= $elements; ?>"><?= $elements; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jk">Jenis Kelamin <sup class="text-warning">***</sup></label>
                                <select class="form-control" name="jk">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="<?= enkrip('L'); ?>">Laki - laki</option>
                                    <option value="<?= enkrip('P'); ?>">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status Siswa <sup class="text-warning">***</sup></label>
                                <select class="form-control" name="status">
                                    <option value="">-- Pilih Status --</option>
                                    <?php foreach ($status as $hasil) : ?>
                                        <option value="<?= enkrip($hasil->id); ?>"><?= $hasil->nama_status; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
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
                    <h3 class="block-title">Edit Siswa</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    <form action="<?= base_url('admin/siswa/edit'); ?>" method="post">
                        <input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <input type="hidden" class="form-control" id="id" name="id" required autocomplete="off">
                        <div class="form-group">
                            <label for="nim">NISN <sup class="text-warning">***</sup></label>
                            <input type="text" class="js-maxlength form-control" maxlength="10" name="nisn" id="nisn" required autocomplete="off" data-always-show="true" data-placement="bottom-right">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap <sup class="text-warning">***</sup></label>
                            <input type="text" class="form-control" id="nama" name="nama" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas <sup class="text-warning">***</sup></label>
                            <select class="form-control" name="kelas" id="kelas">
                                <option value="">-- Pilih Kelas --</option>
                                <?php foreach (range('1', '6') as $elements) : ?>
                                    <option value="<?= $elements; ?>"><?= $elements; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin <sup class="text-warning">***</sup></label>
                            <select class="form-control" name="jk" id="jk">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="<?= enkrip('L'); ?>">Laki - laki</option>
                                <option value="<?= enkrip('P'); ?>">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status Siswa <sup class="text-warning">***</sup></label>
                            <select class="form-control" name="status" id="status">
                                <option value="">-- Pilih Status --</option>
                                <?php foreach ($status as $hasil) : ?>
                                    <option value="<?= enkrip($hasil->id); ?>"><?= $hasil->nama_status; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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

<!-- Modal Import -->
<div class="modal fade" id="modal-import" tabindex="-1" role="dialog" aria-labelledby="modal-block-fromright" aria-hidden="true">
    <div class="modal-dialog modal-dialog-fromright" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-themed block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Import Siswa</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content font-size-sm">
                    <form action="<?= base_url('admin/siswa/import'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="block-content">
                                    <div class="form-group">
                                        <label for="nama">File Upload</label>
                                        <!-- <input type="file" class="form-control" accept=".xlsx" name="file_excel" required autocomplete="off"> -->
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" data-toggle="custom-file-input" accept=".xlsx" name="file_excel">
                                            <label class="custom-file-label" for="one-profile-edit-avatar">Pilih file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content block-content-full text-right border-top">
                                <button type="button" class="btn btn-alt-primary mr-1" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- MEnd Modal Import -->

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
<?php $one->get_js('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js'); ?>

<?php $one->get_js('js/plugins/select2/js/select2.full.min.js'); ?>

<?php $one->get_js('toastr/toastr.min.js'); ?>
<?php $one->get_js('js/plugins/sweetalert2/sweetalert2.js'); ?>
<?php $one->get_js('toastr/script.js'); ?>

<!-- Page JS Helpers (BS Notify Plugin) -->
<script>
    $('#by_status').change(function() {
        let status = $(this).find(':selected').val();
        document.location.href = '<?php echo base_url('admin/siswa/') ?>' + status;
    });

    let edit_btn = $('.edit_btn');

    $(edit_btn).each(function(i) {
        $(edit_btn[i]).click(function() {
            let id = $(this).data('id');

            $.ajax({
                url: "<?= base_url('admin/siswa/getOne/'); ?>" + id,
                type: 'get',
                dataType: 'json',
                success: function(result) {
                    $('#id').val(id);
                    $('#nisn').val(result.nisn);
                    $('#nama').val(result.nama);
                    $('#kelas').val(result.kelas);
                    $('#jk').val(result.jk);
                    $('#status').val(result.status);
                }
            });
        });
    });

    $("#check-all").click(function() {
        if ($(this).is(":checked"))
            $(".check-item").prop("checked", true);
        else
            $(".check-item").prop("checked", false);
    });

    $('li.nav-main-item').find('a[href*="<?= base_url('admin/siswa') ?>"]').addClass('active');
    $('li.nav-main-item').find('a[href*="<?= base_url('admin/siswa') ?>"]').parent().parent().parent().addClass('open');

    jQuery(function() {
        One.helpers(['select2', 'maxlength']);
    });
</script>

<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>