<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
if (!isset($CI)) {
  $CI = new CI_Controller();
}
$CI->load->helper('url');
$title = '500'
?>
<?php require APPPATH . 'views/inc/_global/config.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_start.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/head_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="hero">
    <div class="hero-inner text-center">
        <div class="bg-white">
            <div class="content content-full overflow-hidden">
                <div class="py-4">
                    <!-- Error Header -->
                    <h1 class="display-1 font-w600 text-modern">500</h1>
                    <h2 class="h4 font-w400 text-muted mb-5">We are sorry but our server encountered an internal error..</h2>
                    <!-- END Error Header -->
                </div>
            </div>
        </div>
        <div class="content content-full text-muted">
            <!-- Error Footer -->
            <p class="mb-1">
                Would you like to let us know about it?
            </p>
            <a class="link-fx" href="javascript:void(0)">Report it</a> or <a class="link-fx" href="<?= base_url('') ?>">Go Back to Dashboard</a>
            <!-- END Error Footer -->
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require APPPATH . 'views/inc/_global/views/page_end.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/footer_start.php'; ?>
<?php require APPPATH . 'views/inc/_global/views/footer_end.php'; ?>