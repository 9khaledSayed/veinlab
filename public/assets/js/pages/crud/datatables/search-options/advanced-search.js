"use strict";
var KTDatatablesSearchOptionsAdvancedSearch = function() {

	$.fn.dataTable.Api.register('column().title()', function() {
		return $(this.header()).text().trim();
	});

	var initTable1 = function() {

		// begin first table
		var table = $('.kt-datatable').DataTable({
			responsive: true,
			// Pagination settings
			dom: `<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
			// read more: https://datatables.net/examples/basic_init/dom.html

			lengthMenu: [5, 10, 25, 50],

			pageLength: 10,

			language: {
				'lengthMenu': 'Display _MENU_',
			},

			searchDelay: 500,
			processing: true,
			serverSide: true,
			ajax: {
				url: '/dashboard/hr/memos',
				type: 'GET',
				data: {
					// parameters for custom backend script demo
					columnsDef: [
						'title_ar', 'title_en', 'text_ar', 'text_en', 'created_at',],
				},
			},
			columns: [
				{data: 'title_ar'},
				{data: 'title_en'},
				{data: 'text_ar'},
				{data: 'text_en'},
				{data: 'created_at'},
				{data: 'Actions', responsivePriority: -1},
			],

			initComplete: function() {
				this.api().columns().every(function() {
					var column = this;

					switch (column.title()) {
						case 'title_ar':
							column.data().unique().sort().each(function(d, j) {
								$('.kt-input[data-col-index="0"]').append('<option value="' + d + '">' + d + '</option>');
							});
							break;

					}
				});
			},

			columnDefs: [
				{
					targets: -1,
					title: 'Actions',
					orderable: false,
					render: function(data, type, full, meta) {
						return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
					},
				},
			],
		});

		var filter = function() {
			var val = $.fn.dataTable.util.escapeRegex($(this).val());
			table.column($(this).data('col-index')).search(val ? val : '', false, false).draw();
		};

		var asdasd = function(value, index) {
			var val = $.fn.dataTable.util.escapeRegex(value);
			table.column(index).search(val ? val : '', false, true);
		};

		$('#kt_search').on('click', function(e) {

			e.preventDefault();
			var params = {};

			$('.kt-input').each(function() {
				var i = $(this).data('col-index');



				if (params[i]) {

					params[i] += '|' + $(this).val();
				}
				else {

					params[i] = $(this).val();
				}


			});
            var x = 0;
			$.each(params, function(i, val) {
				// apply search params to datatable

                console.log(val)
				table.column(i).search(val ? val : '', false, false);
			});
			table.table().draw();

		});

		$('#kt_reset').on('click', function(e) {
			e.preventDefault();
			$('.kt-input').each(function() {
				$(this).val('');
				table.column($(this).data('col-index')).search('', false, false);
			});
			table.table().draw();
		});

		$('#kt_datepicker').datepicker({
			todayHighlight: true,
			templates: {
				leftArrow: '<i class="la la-angle-left"></i>',
				rightArrow: '<i class="la la-angle-right"></i>',
			},
		});

	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesSearchOptionsAdvancedSearch.init();
});
