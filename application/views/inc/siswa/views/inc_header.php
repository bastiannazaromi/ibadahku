<header id="page-header">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <a class="font-w600 font-size-h5 tracking-wider text-dual mr-3" href="<?php echo base_url() ?>">
                IBADAHKU<span class="font-w400"></span>
            </a>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn btn-sm btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
                    <span class="text-primary">•</span>
                </button>
            </div>
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded" src="
                    <?=
                    ($this->user->foto == 'default.jpg' || $this->user->foto == '') ?
                        base_url('upload/default.jpg') : base_url('upload/siswa/' . $this->user->foto)
                    ?>
                    " alt="<?= $this->user->nama; ?>" style="width: 21px;">
                    <span class="d-none d-sm-inline-block ml-1"><?= $this->user->nama; ?></span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0" aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-primary-dark rounded-top">
                        <img class="rounded" src="
                        <?=
                        ($this->user->foto == 'default.jpg' || $this->user->foto == '') ?
                            base_url('upload/default.jpg') : base_url('upload/siswa/' . $this->user->foto)
                        ?>
                        " alt="<?= $this->user->nama_lengkap; ?>" style="width: 48px;">
                        <p class="mt-2 mb-0 text-white font-w500"><?= $this->user->nama; ?></p>
                        <p class="mb-0 text-white-50 font-size-sm"><?= $this->user->nim; ?></p>
                    </div>
                    <div class="p-2">
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="<?= base_url('siswa/profil') ?>">
                            <span class="font-size-sm font-w500">Data Diri</span>
                        </a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="<?= $this->logout ?>">
                            <span class="font-size-sm font-w500">Keluar</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="page-header-loader" class="overlay-header bg-primary-lighter">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-circle-notch fa-spin text-primary"></i>
            </div>
        </div>
    </div>
</header>