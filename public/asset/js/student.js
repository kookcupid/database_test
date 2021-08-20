$(document).ready(function() {

  initEvent();

});

function initEvent() {


  $('#info').hide();

  $('#student_code').blur(function() {
    var student_code = $('#student_code').val();

    fn_getStockQty(student_code);
    console.log(student_code);

  });

  $('#option_student').change(function() {
    var student_code = $('#option_student').val();
    fn_getStockQty(student_code);
    console.log(student_code);
  });
  
  

  $('#code').focus(function() {
    console.log('code focus');
  });

  $('#code').blur(function() {
    console.log('code blur');
  });

  $('#add').click(function() {
    add();
  });

  
  $('#save').click(function() {
    fn_save();
  });


  fn_init_datatable();

}

function fn_init_datatable() {
  
  $('#myTable').DataTable({
    ajax: "/student/listall",
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
            {"targets": 7,"orderable": false},
            {"targets": 8,"orderable": false},
        ],
        "order": [[ 2, "asc" ]],
  });
}


function fn_form_validate() {
  let code = $('#code').val();
  let name = $('#name').val();
  let address = $('#address').val();

  error_msg = '';
  if (code == '') {
    error_msg = 'กรุณาใส่รหัสลูกค้า';
  } else if (name == '') {
    error_msg = 'กรุณาใส่ชื่อลูกค้า';
  } else if (address == '') {
    error_msg = 'กรุณาใส่ที่อยู่';
  }

  if (error_msg != '') {

    event.preventDefault();
    swal({
      title: "",
      text: error_msg,
      icon: "error",
    });
  }

}

function add() {

  $('#edit_mode').val('insert');

  fn_blankform();
  $('#exampleModalLabel').text('เพิ่มข้อมูลลูกค้า');
  $('#exampleModal').modal('show');

}

function edit(id) {


  $('#edit_mode').val('edit');
  $('#edit_id').val(id);

  $('#load').css('visibility', 'show');
  $('#save').hide();

  fn_blankform();

  $('#exampleModalLabel').text('แก้ไขข้อมูลลูกค้า');
  $('#exampleModal').modal('show');

  $.ajax({
    type: "GET",
    dataType: 'json',
    url: "student/get/" + id,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(callback) {
      
      // $('#load').hide();
      $('#load').css('visibility', 'hidden');

      console.log(callback.data.customer_code);
      console.log(callback.data.customer_name);
      console.log(callback.data.address);
      
      $('#code').val(callback.data.customer_code);
      $('#name').val(callback.data.customer_name);
      $('#address').val(callback.data.address);

      $('#save').show();


    },
  });


}

function fn_getStockQty(code) {
  
  $.ajax({
    type: "POST",
    dataType: 'json',
    url: "/student/getstock",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
      code: code
    },
    success: function(callback) {
      console.log(callback);
      $('#stock_qty').val(callback.stock_qty);
    },
  });
}

function confirm_deldata(id) {

  swal({
    title: "Are you sure",
    text: "ยืนยันการลบข้อมูล ?",
    icon: "warning",
    buttons: true,
    dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        //swal("Poof! Your imaginary file has been deleted!", {icon: "success",});
        deldata(id);
    } else {
      //swal("Your imaginary file is safe!");
    }
  });

}

function deldata(id) {
  
  $.ajax({
    type: "GET",
    dataType: 'json',
    url: "/student/delete/" + id,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(callback) {
      console.log(callback);
      //location.reload();
      var table = $('#myTable').DataTable();
      table.ajax.reload(null,false);

    },
  });

}

function fn_blankform() {
  $('#code').val('');
  $('#name').val('');
  $('#address').val('');
  
}

function fn_save() {


  var post_data = $('#Form1').serializeArray();
  
  let code = $('#code').val();
  let name = $('#name').val();
  let address = $('#address').val();

  error_msg = '';
  if (code == '') {
    error_msg = 'กรุณาใส่รหัสลูกค้า';
  } else if (name == '') {
    error_msg = 'กรุณาใส่ชื่อ';
  } else if (address == '') {
    error_msg = 'กรุณาใส่ที่อยู่';
  }

  if (error_msg != '') {
    swal({
      title: "",
      text: error_msg,
      icon: "error",
    });
  }
  else {
    $.ajax({
      type: "POST",
      dataType: 'json',
      url: "/student/store",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: {
        data: post_data,
      },
      success: function(callback) {
        console.log(callback);

        $('#exampleModal').modal('hide');

        var table = $('#myTable').DataTable();
        table.ajax.reload(null, false);


      },
    });

  }


}