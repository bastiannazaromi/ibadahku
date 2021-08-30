<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/admin/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo8@2x.jpg');">
    <div class="bg-black-75">
        <div class="content content-full text-center">
            <div class="my-3">
                <img class="img-avatar img-avatar128" src="<?= base_url('upload/admin/') . $this->user->foto; ?>" alt="Profile">
            </div>
            <h1 class="h2 text-white mb-5"><?= $this->user->nama; ?></h1>
            <a class="btn btn-light" href="<?= base_url('admin'); ?>">
                <i class="fa fa-fw fa-arrow-left text-danger"></i> Back to Dashboard
            </a>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-boxed">
    <!-- User Profile -->
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">User Profile</h3>
        </div>
        <div class="block-content">
            <form action="<?= base_url('admin/profile/updateFoto'); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">
                            Your account’s vital info. Your username will be publicly visible.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?= $this->user->nama; ?>" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="one-profile-ediusername">Username</label>
                            <input type="text" class="form-control" readonly name="username" required autocomplete="off" value="<?= $this->user->username; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" name="email" required autocomplete="off" value="<?= $this->user->email; ?>">
                        </div>
                        <div class="form-group">
                            <label>Your Avatar</label>
                            <div class="push">
                                <img class="img-avatar img-avatar64" id="gambar_nodin" src="<?= base_url('upload/admin/') . $this->user->foto; ?>" alt="Profile">
                            </div>
                            <div class="custom-file">
                                <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                <input type="file" class="custom-file-input" id="image" accept="image/jpg,image/jpeg,image/png" data-toggle="custom-file-input" name="foto">
                                <label class="custom-file-label" for="one-profile-edit-avatar">Choose a new
                                    avatar</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END User Profile -->

    <!-- Change Password -->
    <div class="block block-rounded">
        <div class="block-header">
            <h3 class="block-title">Change Password</h3>
        </div>
        <div class="block-content">
            <form action="<?= base_url('admin/profile/updatePass'); ?>" method="POST">
                <input type="hidden" class="csrf_token" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                <div class="row push">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">
                            Changing your sign in password is an easy way to keep your account secure.
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="oldPass">Current Password</label>
                            <input type="password" class="form-control" required autocomplete="off" name="oldPass">
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="newPass">New Password</label>
                                <input type="password" class="form-control" required autocomplete="off" name="newPass">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="confirPass">Confirm New Password</label>
                                <input type="password" class="form-control" required autocomplete="off" name="confirPass">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-primary">
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Change Password -->

</div>
<!-- END Page Content -->

<?php require APPPATH . 'views/inc/_global/views/page_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/footer_start.php'; ?>
<?php $one->get_js('toastr/script.js'); ?>

<script>
    $("#image").change(function() {
        bacaGambar(this);
    });

    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#gambar_nodin').attr('src', e.target.result);
            }, reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>