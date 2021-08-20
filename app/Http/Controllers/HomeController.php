<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Student;


class HomeController extends Controller
{
    public function index() {
        return view('home');
    }

    public function home() {

        $student_data = student::all();

        return view('home', array(
            "data" => $student_data
        ));
    
    }

    public function student() {

        $student_data = student::all();

        return view('home', array(
            "data" => $student_data
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
            );

        }

        echo json_encode($data);
    }

    public function decodeFormArray($form) {
        $data = array();
        foreach ($form as $key => $val) {
            $data[$val['name']] = $val['value'];
        }
        return $data;
    }

}