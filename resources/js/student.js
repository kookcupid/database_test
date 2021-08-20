function fn_init_datatable() {
  
  $('#myTable').DataTable({
    ajax: "/home/listall",
    "paging":  true,
    "ordering": true,
    "info":     false,
    "searching": true,
    "responsive": false,
    dom: "fti<'row'<'col-md-12 dt-footer'lp>>",
    "columnDefs": [ 
            {"targets": 0,"orderable": true},
            {"targets": 1,"orderable": true},
            {"targets": 2,"orderable": true},
            {"targets": 3,"orderable": true},
            {"targets": 4,"orderable": true},
            {"targets": 5,"orderable": true},
            {"targets": 6,"orderable": true},
        ],
        "order": [[ 2, "asc" ]],
  });
}