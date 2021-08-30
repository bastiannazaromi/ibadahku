var sukses = $('.toastr-sukses').data('flashdata');
var error = $('.toastr-error').data('flashdata');

if (sukses) {
    toastr.success(sukses);
}

if (error) {
    toastr.error(error);
}

$('.tombol-hapus').on('click', function (e) {
	e.preventDefault();

	var href = $(this).data('href');
	Swal.fire({
		title: 'Apakah anda yakin',
		text: "data akan dihapus",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus Data'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})
});