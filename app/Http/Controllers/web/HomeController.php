<?php

namespace App\Http\Controllers\web;

use App\Models\Cat;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index ()
    {
        $exams = Exam::take(8)->get();
        return view('web.home.index',['exams'=>$exams]);
    }
}
