<?php

namespace App\Http\Controllers\web;

use Exception;
use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::paginate(32);
        return view('web.exams.index', ['exams' => $exams]);
    }
    public function show($id)
    {
        $data['exam'] = Exam::findOrFail($id);
        $user = Auth::user();
        $data['canViewStartBtn'] = true;

        //check if user already authenticated(logged in)
        if($user !== null){
            $pivotRow = $user->exams()->where('exam_id', $id)->first();

        // dd($pivotRow->pivot->status);
            //if user already solve exam or status = closed
            if ($pivotRow !== null and $pivotRow->pivot->status == 'closed') {
                $data['canViewStartBtn'] = false;
            }
        }

        return view ('web.exams.show')->with($data);
    }

    public function start($examId,Request $request)
    {
        try{
            $user = Auth::user();
            if(! $user->exams->contains($examId)){
                $user->exams()->attach($examId);
            } else {
                $user->exams()->updateExistingPivot($examId,[
                    'status' => 'closed',
                ]);
            }

            //save page as prev page in session
            $request->session()->flash('prev',"start/$examId");
            return redirect( url("/exams/questions/$examId") );
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function questions($examId, Request $request)
    {
        try{
            if(session('prev') !== "start/$examId"){
                return redirect(url("exams/show/$examId"));
            }

            $data['exam'] = Exam::findOrFail($examId);
            //save page as prev page in session
            $request->session()->flash('prev', "questions/$examId");
            return view('web.exams.questions')->with($data);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function submit($examId, Request $request){
        try{
            if (session('prev') !== "questions/$examId") {
                return redirect(url("exams/show/$examId"));
            }
            // dd($request->all());
            $request->validate([
                'answers' => 'required|array|',
                'answers.*' => 'required|in:1,2,3,4'
            ]);

            //calculating score
            $exam = Exam::findOrFail($examId);
            $points = 0;

            $totalNoOfques = $exam->questions->count();

            foreach ($exam->questions as $question) {
                if (isset($request->answers[$question->id])){
                    $userAns = $request->answers[$question->id];
                    $rightAns = $question->right_ans;
                    if($userAns == $rightAns){
                        $points += 1;
                    }
                }
            }
            $score =($points / $totalNoOfques) * 100 ;
            //calculating time mins

            $user = Auth::user();

            $pivotRow = $user->exams()->where('exam_id', $examId)->first();
            //dd($pivotRow);
            $startTime = $pivotRow->pivot->created_at;

            $submitTime = Carbon::now();
            $timeMins = $submitTime->diffInMinutes($startTime);
            if($timeMins > $pivotRow->duration_mins){
                $score = 0;
            }
            //update pivot row
            $user->exams()->updateExistingPivot($examId, [
                'score'=>$score,
                'time_mins'=>$timeMins
            ]);
            $request->session()->flash("success","you finished exam successfully with score = $score%");
            return redirect( url("exams/show/$examId"));
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


}
