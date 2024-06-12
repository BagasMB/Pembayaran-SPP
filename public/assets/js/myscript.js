// DataTable Biasa
$(function () {
	$("#myTable").DataTable();
});

$(function () {
	var table = $("#example").DataTable({
		dom: "Bfrtip",
		// stateSave: true,
		// lengthChange: false,
		buttons: [
			{
				extend: "pdfHtml5",
				text: '<i class="fa fa-file-pdf"></i>',
				title: "Data Laporan Transaksi",
				titleAttr: "PDF",
				exportOptions: {
					columns: ":visible",
				},
			},
			{
				extend: "print",
				text: '<i class="fa fa-print"></i>',
				title:
					"<h2 style='text-align: center;margin-bottom: 2rem;'>Data Laporan Transaksi</h2>",
				titleAttr: "Print",
				// autoPrint: false,
				exportOptions: {
					columns: ":visible",
				},
			},
			{
				extend: "colvis",
			},
		],

		language: {
			buttons: {
				colvis: "Change columns",
			},
		},
		columnDefs: [
			{
				targets: 1,
				visible: false,
			},
		],
	});
	table;
	// .buttons()
	// .container()
	// .appendTo($("div.column.is-half", table.table().container()).eq(0));
	table.buttons().container().appendTo("#example_wrapper .col-md-6:eq(0)");
});

const flashData = $("#flash-data").data("flashdata"),
	flash = $("#type-error").data("flashdata");

if (flashData) {
	swal.fire({
		icon: "success",
		title: "Data",
		text: flashData,
		type: "success",
	});
}
if (flash) {
	swal.fire({
		icon: "error",
		title: "Data",
		text: flash,
	});
}

$(document).on("click", "#btn-hapus", function (e) {
	e.preventDefault();
	const href = $(this).attr("href");

	Swal.fire({
		title: "Apakah Anda Yakin?",
		text: "Data Akan DiHapus!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus Data!",
	}).then((result) => {
		if (result.isConfirmed) {
			document.location = href;
		}
	});
});
