<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index()
    {
        $studentRole = Role::where('name','student')->first();
        $data['students'] = User::where('role_id', $studentRole->id )
                                ->orderBy('id','DESC')
                                ->paginate(10);
        return view('admin.students.index')->with($data);
    }

    public function showScores($id)
    {

        $student = User::findOrFail($id);
        if($student->role->name !== 'student'){
            return back();
        } else {
            $data['student'] = $student;
            $data['exams'] = $student->exams;
            return view("admin.students.show-scores")->with($data);
        }
    }

    public function openExam($studentId,$examId)
    {
        try{
            $student = User::findOrFail($studentId);
            $student->exams()->updateExistingPivot($examId,[
                'status'=>'open',
            ]);

            return back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function closeExam($studentId, $examId)
    {
        $student = User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId, [
            'status' => 'closed',
        ]);

        return back();
    }
}
