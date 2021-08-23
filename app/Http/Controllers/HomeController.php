<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\home;

class HomeController extends Controller
{

    // public function index() 
    // {

    //     $home = home::all();
    //         return response()->json($home);
    // }

    public function home() {

        $home_data = home::all();

        return view('home', array(
            "data" => $home_data,
        
        ));
    }

    public function listData() {

        $brow_item = home::all();

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
            );

        }

        echo json_encode($data);
    }

    // public function get_home($id) {
       
    //     $home_data = home::find($id);
       
    //     $response = array(
    //         'status' => '00',
    //         'msg' => 'complete',
    //         'data' => $home_data,
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