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
                        <h3>Atur Password Baru</h3>
                        <p>Silakan untuk mengatur ulang password baru, mohon untuk mengingat password dengan baik agar tidak dilupakan :)</p>
                        <form autocomplete="off">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                            <input class="form-control" autocomplete="off" type="password" name="newpass" id="newpass" placeholder="Password Baru" required>
                            <input class="form-control" autocomplete="off" type="password" name="confpass" id="confpass" placeholder="Ketik Ulang Password Baru" required>
                            <input type="checkbox" class="form-check-input" id="showfull">
                            <label class="form-check-label font-weight-light" for="showfull">Show Password</label>
                            <div class="form-button">
                                <button id="submit" type="submit" class="ibtn">Simpan Password Baru</button>
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