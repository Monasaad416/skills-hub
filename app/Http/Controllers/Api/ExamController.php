<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;

class ExamController extends Controller
    {
    use ApiResponseTrait;
    public function show($id)
    {
        $exam = Exam::find($id);
        return new ExamResource($exam);
    }

    public function showQuestions($id)
    {
        $exam = Exam::with('questions')->find($id);
        return new ExamResource($exam);
    }

    public function start($examId, Request $request)
    {
        $user = $request->user();
        if (!$user->exams->contains($examId)) {
            $user->exams()->attach($examId);
        } else {
            $user->exams()->updateExistingPivot($examId, [
                'status' => 'closed',
            ]);
        }

        //save page as prev page in session
        return $this->apiResponse('200',[
            'Status is closed now ,exam cannot be solved again'
        ]);
    }


    public function submit($examId, Request $request)
    {
        $validator = Validator::make($request->all(),[
            'answers' => 'required|array|',
            'answers.*' => 'required|in:1,2,3,4'
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 422);
        }

        //calculating score
        $exam = Exam::find($examId);
        $points = 0;

        $totalNoOfques = $exam->questions->count();

        foreach ($exam->questions as $question) {
            if (isset($request->answers[$question->id])) {
                $userAns = $request->answers[$question->id];
                $rightAns = $question->right_ans;
                if ($userAns == $rightAns) {
                    $points += 1;
                }
            }
        }
        $score = ($points / $totalNoOfques) * 100;

        //calculating time mins
        $user = $request->user();


        $pivotRow = $user->exams()->where('exam_id', $examId)->first();
       
        $startTime = $pivotRow->pivot->created_at;

        $submitTime = Carbon::now();
        $timeMins = $submitTime->diffInMinutes($startTime);
        if ($timeMins > $pivotRow->duration_mins) {
            $score = 0;
        }
        //update pivot row
        $user->exams()->updateExistingPivot($examId, [
            'score' => $score,
            'time_mins' => $timeMins
        ]);
        return $this->apiResponse('200', 'Exam submitted Successfully', [
            'score' => $score,
            'user' => $user,
        ]);
    }
    }
