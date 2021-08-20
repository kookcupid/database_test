
$(document).ready(function() {

    initEvent();
  
});

  function initEvent() {


    $('#info').hide();

    $('#p_code').blur(function() {
      var p_code = $('#p_code').val();

      fn_getStockQty(p_code);
      console.log(p_code);

    });

    $('#option_product').change(function() {
      var p_code = $('#option_product').val();
      fn_getStockQty(p_code);
      console.log(p_code);
    });
    
    

    $('#qty').blur(function() {
      var qty = $('#qty').val();
      console.log(qty);

      let stock_qty = $('#stock_qty').val();

      
      $('#pinfo').text('ไม่สามารถจองเกิน '+stock_qty+' ชิ้น');

      if (parseFloat(qty) > stock_qty) {

        $('#info').show();
        $('#save').prop('disabled', true);

      }
      else {
        $('#info').hide();
        $('#save').prop('disabled', false);
      }

      console.log(qty);
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

    // $('#Form1').submit(function() {
    //     console.log('on submit...');
    //     window.scrollTo(0, 0);
    //     fn_form_validate();
    // });

    fn_init_datatable();

  }

  function fn_init_datatable() {
    
    $('#myTable').DataTable({
      ajax: "/kook/customer/listall",
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
              {"targets": 4,"orderable": false},
              {"targets": 5,"orderable": false},
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
      url: "/kook/customer/get/" + id,
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
      url: "/kook/customer/getstock",
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
      url: "/kook/customer/delete/" + id,
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
        url: "/kook/customer/store",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          data: post_data,
          //data: new FormData(form),
          // edit_id: $('#edit_id').val(),
          // edit_mode: $('#edit_mode').val(),
          // code: $('#code').val(),
          // name: $('#name').val(),
          // address: $('#address').val(),
        },
        // contentType: false,
        // cache: false,
        // processData:false,
        success: function(callback) {
          console.log(callback);
  
          $('#exampleModal').modal('hide');
  
          var table = $('#myTable').DataTable();
          table.ajax.reload(null, false);
  
  
        },
      });

    }


  }
