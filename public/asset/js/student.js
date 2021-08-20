$(document).ready(function() {

  initEvent();

});

function initEvent() {


  $('#info').hide();

  $('#student_code').blur(function() {
    var student_code = $('#student_code').val();
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
  let student_code = $('#student_code').val();
  let student_fname = $('#student_fname').val();
  let student_lname = $('#student_lname').val();
  let student_class = $('#student_class').val();
  let sex = $('#sex').val();
  let birth_year = $('#birth_year').val();

  error_msg = '';
  if (student_code == '') {
    error_msg = 'กรุณาใส่รหัสนักเรียน';
  } 
    else if (student_fname == '') {
    error_msg = 'กรุณาใส่ชื่อ';
  } 
    else if (student_lname == '') {
    error_msg = 'กรุณาใส่นามสกุล';
  }
    else if (student_class == '') {
    error_msg = 'กรุณาใส่ระดับชั้น';
  }
    else if (sex == '') {
    error_msg = 'กรุณาใส่เพศ';
  }
    else if (birth_year == '') {
    error_msg = 'กรุณาใส่ปีเกิด';
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
  $('#exampleModalLabel').text('เพิ่มข้อมูลนักเรียน');
  $('#exampleModal').modal('show');

}

function edit(id) {


  $('#edit_mode').val('edit');
  $('#edit_id').val(id);

  $('#load').css('visibility', 'show');
  $('#save').hide();

  fn_blankform();

  $('#exampleModalLabel').text('แก้ไขข้อมูลนักเรียน');
  $('#exampleModal').modal('show');

  $.ajax({
    type: "GET",
    dataType: 'json',
    url: "student/get/" + id,
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function(callback) {
      
      $('#load').css('visibility', 'hidden');

      console.log(callback.data.student_code);
      console.log(callback.data.student_fname);
      console.log(callback.data.student_lname);
      console.log(callback.data.student_class);
      console.log(callback.data.sex);
      console.log(callback.data.birth_year);
      
      $('#student_code').val(callback.student_code);
      $('#student_fname').val(callback.student_fname);
      $('#student_lname').val(callback.student_lname);
      $('#student_class').val(callback.student_class);
      $('#sex').val(callback.sex);
      $('#birth_year').val(callback.birth_year);

      $('#save').show();

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
        deldata(id);
    } else {
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
  $('#student_code').val('');
  $('#student_fname').val('');
  $('#student_lname').val('');
  $('#student_class').val();
  $('#sex').val();
  $('#birth_year').val();
}

function fn_save() {

  var post_data = $('#Form1').serializeArray();
  
  let student_code = $('#student_code').val();
  let student_fname = $('#student_fname').val();
  let student_lname = $('#student_lname').val();
  let student_class = $('#student_class').val();
  let sex = $('#sex').val();
  let birth_year = $('#birth_year').val();

  error_msg = '';
  if (student_code == '') {
    error_msg = 'กรุณาใส่รหัสนักเรียน';
  } 
    else if (student_fname == '') {
    error_msg = 'กรุณาใส่ชื่อ';
  } 
    else if (student_lname == '') {
    error_msg = 'กรุณาใส่นามสกุล';
  }
    else if (student_class == '') {
    error_msg = 'กรุณาใส่ระดับชั้น';
  }
    else if (sex == '') {
    error_msg = 'กรุณาใส่เพศ';
  }
    else if (birth_year == '') {
    error_msg = 'กรุณาใส่ปีเกิด';
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