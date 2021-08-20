@extends('layout.master')

@section('content')
    
  <h1>Student</h1>

  
  <h1><Vue.js></h1>


  <input id="ord_date" type="text">

@endsection


@section('page-script')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


<script>
    $(document).ready(function() {
      flatpickr("#ord_date", {});
    });

</script>


@endsection
