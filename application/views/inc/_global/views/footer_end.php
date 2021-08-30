<script type="text/javascript" src="<?= base_url('assets/backend/js/plugins/bootstrap-notify/bootstrap-notify.min.js') ?>"></script>
<?php
if (!empty($this->session->flashdata('notify-success'))) {
    echo $this->session->flashdata('notify-success');
}
if (!empty($this->session->flashdata('notify-error'))) {
    echo $this->session->flashdata('notify-error');
}
if (!empty($this->session->flashdata('notify-warning'))) {
    echo $this->session->flashdata('notify-warning');
}
if (!empty($this->session->flashdata('notify-info'))) {
    echo $this->session->flashdata('notify-info');
}
if (!empty($this->session->flashdata('notif'))) {
    echo $this->session->flashdata('notif');
}
?>
</body>

</html>