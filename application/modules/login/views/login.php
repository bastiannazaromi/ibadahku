<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <meta name="description" content="Catatan Ibadah">
    <meta name="author" content="sisfo360">
    <meta name="robots" content="noindex, nofollow">

    <meta property="og:title" content="Login | IBADAHKU">
    <meta property="og:site_name" content="CatatanIbasah">
    <meta property="og:description" content="Catatan Ibadah">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="shortcut icon" href="<?= base_url('assets/backend/media/favicons/favicon.png') ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('assets/backend/media/favicons/favicon-192x192.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/backend/media/favicons/apple-touch-icon-180x180.png') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/css/fontawesome-all.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/css/style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/frontend/css/theme.css') ?>">
</head>

<body>
    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Aplikasi Catatan Ibadah Harian Siswa</h3>
                        <p>Sekolah Dasar Negeri Kupu 02</p>
                        <form autocomplete="off" method="POST" action="<?= base_url('login/proses') ?>">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <?php
                            if (!empty($this->session->flashdata('error'))) { ?>
                                <div class="alert alert-danger" id="error">
                                    <?= $this->session->flashdata('error') ?>

                                </div>
                            <?php } ?>
                            <input class="form-control" type="text" name="username" autocomplete="off" placeholder="Username" required>
                            <input class="form-control" type="password" name="password" id="password" autocomplete="off" placeholder="Password" required>
                            <input type="checkbox" class="form-check-input" id="showpw">
                            <label class="form-check-label font-weight-light" for="showpw">Show Password</label>
                            <div class="form-button">
                                <button id="submit" type="submit" class="btn btn-warning">Login</button>
                            </div>
                        </form>
                        <div class="other-links">
                            <a href="#">Copyright © 2021 | CATATAN IBADAH HARIAN SISWA</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?= base_url('assets/frontend/js/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/frontend/js/popper.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/frontend/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/frontend/js/main.js') ?>"></script>
</body>

</html>