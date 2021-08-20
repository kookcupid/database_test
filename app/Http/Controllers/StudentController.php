<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Student;

class StudentController extends Controller
{

    public function index() 
    {

        $student = Student::all();
            return response()->json($student);
         //   return new StudentResource($student);
    }

    public function home()
    {
        $student_data = student::all();

        return view('home', array(
            "data" => $student_data
        ));
    }

    public function student() {

        $student_data = student::all();

        return view('student.index', array(
            "data" => $student_data,
            "student_data" => $student_data,
        ));
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
       // $student['name'] = student['first_name'] . ' ' . $tudent[]
       // return response()-> json($customer);
      //  return new StudentResource($student);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function ($each){
                $each->name = $each->first_name . ' ' . $each->last_name;
                return $each;
            }),
            'link' => [
                'foo' => url('api/students/foo')
            ]
        ];
        
    }

    public function with($request)
    {
        return['verton' => '1.0'];
    }
}
