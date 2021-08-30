<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/fontawesome-all.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/theme.css') ?>">
</head>

<body>
    <div class="form-body" class="container-fluid">
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="<?php echo base_url('assets/frontend/images/graphic2.svg') ?>" alt="Politeknik Harapan Bersama">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Ups, Anda Lupa Password?</h3>
                        <p>#ResetAja, dengan reset aja, Anda bisa mereset password dengan sangat mudah.</p>
                        <form action="<?php echo base_url('forgot/setpw') ?>" method="POST" autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <input class="form-control" autocomplete="off" type="email" name="username" placeholder="Email akun Anda" required>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Reset Password</button>
                            </div>
                        </form>
                        <div class="other-links">
                            <a href="#">Copyright © 2021 | Politeknik Harapan Bersama - Sisfo360</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/popper.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/frontend/js/main.js') ?>"></script>
</body>

</html>