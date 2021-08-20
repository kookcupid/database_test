@extends('layout.master')

@section('content')
<h1>School</h1>

<div class="container">

  <form action="{{URL::to('student/store')}}" method="POST">
    @csrf
    <div class="row">
      <div class="col-6">
        <input id="ord_date" name="ord_date" type="text">
      </div>
      <div class="col-6">
        <button id="save">submit</button>
      </div>
    </div>
    <div class="row">
      <div class="form-check">
        <input class="form-check-input" name= 'student_name' type="checkbox" id="disabledFieldsetCheck">
        <label class="form-check-label" for="disabledFieldsetCheck">
          Can't check this
        </label>
      </div>
    </div>
      
  </form>

    <div class="row">
      <table id='myTable' class="table table-striped table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>รหัสนักเรียน</th>
            <th>ชื่อ</th>
            <th>นามสกุล</th>
            <th>ระดับชั้น</th>
            <th>อายุ</th>
            <th>ปีเกิด</th>
          </tr>
        </thead>
        <tbody>
          {{-- @foreach($data as $item)
          <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->student_code}}</td>
            <td>{{$item->student_fname}}</td>
            <td>{{$item->student_lname}}</td>
            <th>{{$item->student_class}}</th>
            <th>{{$item->sex,}}</th>
            <th>{{$item->birth_year,}}</th>
          </tr>
          @endforeach --}}
        </tbody>
      </table>
    </div>
  </div>

@endsection


@section('page-script')

  <script type="text/javascript" src="{{asset('/asset/js/customer.js')}}"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  
  <script>
      $(document).ready(function() {
        flatpickr("#ord_date", {
            dateFormat: "d/m/Y",
          });
      });
  
  </script>

@endsection
