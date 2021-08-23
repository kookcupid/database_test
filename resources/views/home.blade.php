@extends('layout.master')

@section('content')
<h1>หน้าแรก School</h1>
<br>

<form>
@csrf
<div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>

            <h3><button type="button" id="save" class="btn btn-primary">Login</button></h3>
            
</form>

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
            <tbody>
          </tr>
        </thead>
      </table>
    </div>
  </div>


  
@endsection


@section('page-script')

  <script type="text/javascript" src="{{asset('/asset/js/home.js')}}"></script>

@endsection
