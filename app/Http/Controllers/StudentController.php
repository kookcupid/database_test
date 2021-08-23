<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

use App\Models\student;

class StudentController extends Controller
{

    public function student() {

        $student_data = student::all();

        return view('student.index', array(
            "data" => $student_data,
        
        ));
    }

     public function listData() {

        $brow_item = student::all();

        $data = new \stdClass();
        $data->data = array();
        foreach($brow_item as $item) {
            $data->data[] = array(
                $item->id,
                $item->student_code,
                $item->student_fname,
                $item->student_lname,
                $item->student_class,
                $item->sex,
                $item->birth_year,
                '<a href="javascript:edit('.$item->id.');" class="btn btn-primary">แก้ไขข้อมูล</a>',
                '<a href="javascript:confirm_deldata('.$item->id.');" class="btn btn-danger">ลบข้อมูล</a>'
            );

        }

        echo json_encode($data);
    }

    public function edit_student($id) {
        $student_update = student::find($id);
        return view('student.edit');
    }

    public function get_student($id) {
       
        $student_data = student::find($id);
       
        $response = array(
            'status' => '00',
            'msg' => 'complete',
            'data' => $student_data,
        );
        echo json_encode($response);
    }

    public function delete_student($id) {
       
        $student_data = student::find($id);
       
        $student_data->delete();

        $response = array(
            'status' => '00',
            'msg' => 'complete',
        );
        echo json_encode($response);
    }

    public function update(Request $request ,$id){
        dd($id);

    }

    public function add_student(Request $request) {

        $Input = $request->input();

        $edit_mode = $request->get('edit_mode');
        $edit_id = $request->get('edit_id');

        if ($edit_mode == 'insert')
        {
            $save_data = new student();
        }
        else {
            $save_data = student::find($edit_id);
        }

        if (isset($save_data)) {
            $save_data->student_code = $request->get('student_code');
            $save_data->student_fname = $request->get('student_fname');
            $save_data->student_lname = $request->get('student_lname');
            $save_data->student_class = $request->get('student_class');
            $save_data->sex = $request->get('sex');
            $save_data->birth_year = $request->get('birth_year');
            $save_data->save();
        }

        $student_data = student::all();

        return redirect(URL::to('/student'));


    }

    public function store(Request $request) {

        $input = $this->decodeFormArray($request->input('data'));

        $edit_id = $input['edit_id'];
        $edit_mode = $input['edit_mode'];
        $student_code = $input['student_code'];
        $student_fname = $input['student_fname'];
        $student_lname = $input['student_lname'];
        $student_class = $input['student_class'];
        $sex = $input['sex'];
        $birth_year = $input['birth_year'];

        if ($edit_mode == 'insert') {
            $save_data = new student();
        }
        else {
            $save_data = student::find($edit_id);
        }

        if (isset($save_data)) {
            $save_data->student_code = $student_code;
            $save_data->student_fname = $student_fname;
            $save_data->student_lname = $student_lname;
            $save_data->student_class = $student_class;
            $save_data->sex = $sex;
            $save_data->birth_year = $birth_year;
            $save_data->save();
        }

        $response = array(
            'status' => '00',
            'msg' => 'complete',

        );
        echo json_encode($response);


    }

   public function decodeFormArray($form) {
        $data = array();
        foreach ($form as $key => $val) {
            $data[$val['student_fname']] = $val['value'];
        }
        return $data;
    }


    // public function api_student() {

    //     $student_data = student::all();

    //     $response = array(
    //         'status' => '00',
    //         'msg' => 'complete',
    //         'data' => $student_data,
    //     );
    //     echo json_encode($response);
    // }

    //     $student_data = DB::table('order as ord')
    //      ->leftJoin('student as cus', 'cus.id', '=', 'ord.student_id')
    //     ->select('ord.order_id' ,'ord.order_no','ord.order_date' ,'ord.student_id','cus.student_code','cus.student_fname' )
    //      ->get();

    //     $response = array(
    //     'status' => '00',
    //     'msg' => 'complete',
    //     'data' => $product_data,
    //     );
    //     echo json_encode($response);
    // }



    // public function api_student_id($id) {

    //     $student_data = student::where('student_code', '=', $id)->get();

    //     if (isset($student_data) && count($student_data) > 0)
    //     {
    //         $response = array(
    //             'status' => '00',
    //             'msg' => 'complete',
    //             'data' => $student_data,
    //         );
    //     } else { 
    //         $response = array(
    //             'status' => '-1',
    //             'msg' => 'not found data',
    //             'data' => null,
    //         );
    
    //     }
    //     echo json_encode($response);
    // }

}
