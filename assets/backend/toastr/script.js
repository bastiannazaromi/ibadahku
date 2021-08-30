var sukses = $('.toastr-sukses').data('flashdata');
var error = $('.toastr-error').data('flashdata');

if (sukses) {
    toastr.success(sukses);
}

if (error) {
    toastr.error(error);
}

$('.tombol-add').on('click', function(e) {
    /* e.preventDefault(); */

    var text = $(this).data('text');
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: text,
        html: !1,
        buttonsStyling: !1,
        icon: 'warning',
        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-info sb-add m-1",
            cancelButton: "btn btn-secondary m-1"
        },
        confirmButtonText: 'Tambahkan',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.value) {
            $('.form-add').submit();
        }
    })
});

$('.tombol-hapus').on('click', function(e) {
    e.preventDefault();

    var href = $(this).data('href');
    var text = $(this).data('text');
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: text,
        html: !1,
        buttonsStyling: !1,
        icon: 'warning',
        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-danger m-1",
            cancelButton: "btn btn-secondary m-1"
        },
        confirmButtonText: 'Hapus',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});

$('.tombol-confirm').on('click', function(e) {
    e.preventDefault();

    var href = $(this).data('href');
    var text = $(this).data('text');
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: text,
        html: !1,
        buttonsStyling: !1,
        icon: 'warning',
        showCancelButton: true,
        customClass: {
            confirmButton: "btn btn-info m-1",
            cancelButton: "btn btn-secondary m-1"
        },
        confirmButtonText: 'OK',
        cancelButtonText: 'Batalkan'
    }).then((result) => {
        if (result.value) {
            document.location.href = href;
        }
    })
});