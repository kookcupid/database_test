@extends('layout.master')

@section('content')
<h1>School</h1>

<div class="container">
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
            <th>แก้ไข</th>
            <th>ลบ</th>
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
            <th>{{$item->sex}}</th>
            <th>{{$item->birth_year}}</th>
            <td><a href="javascript:edit({{$item->id}});" class="btn btn-primary">แก้ไข</a></td>
            <td><a href="javascript:confirm_deldata({{$item->id}});" class="btn btn-danger">ลบข้อมูล</a></td>
          </tr>
          @endforeach --}}
        </tbody>
      </table>
    </div>
  </div>

@endsection


@section('page-script')

  <script type="text/javascript" src="{{asset('/asset/js/student.js')}}"></script>

@endsection