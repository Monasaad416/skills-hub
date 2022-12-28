<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CatController as AdminCatController;
use App\Http\Controllers\admin\ExamController as AdminExamController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\MessageController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\admin\SkillController as AdminSkillController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\web\CatController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\ExamController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LangController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\SkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('lang')->group(function(){
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/categories/show/{id}', [CatController::class, 'show']);
    Route::get('/skills/show/{id}', [SkillController::class, 'show']);
    Route::get('/exams', [ExamController::class, 'index']);
    Route::get('/exams/show/{id}', [ExamController::class, 'show']);
    Route::get('/exams/questions/{id}', [ExamController::class, 'questions'])->middleware(['auth', 'verified', 'student']);
    Route::get('/contact', [ContactController::class, 'index']);
    Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth', 'verified', 'student']);
});

Route::post('/exams/start/{id}', [ExamController::class, 'start'])->middleware(['auth', 'verified', 'student','canEnterExam']);
Route::post('/exams/submit/{id}', [ExamController::class, 'submit']);

Route::post('/contact/message/send', [ContactController::class, 'send']);
Route::get('/lang/set/{lang}', [LangController::class, 'set']);

Route::prefix('/dashboard')->middleware(['auth','verified','canEnterDashboard'])->group(function(){
    Route::get("/" , [AdminHomeController::class,'index']);
    Route::get("/edit-profile/{profile}", [AdminProfileController::class, 'editProfile']);
    Route::post("/update-profile/{profile}", [AdminProfileController::class, 'updateProfile']);
    Route::get("/edit-password/{profile}", [AdminProfileController::class, 'editPassword']);
    Route::post("/change-password/{profile}", [AdminProfileController::class, 'changePassword']);
    Route::get("/categories", [AdminCatController::class, 'index']);
    Route::post("/categories/store", [AdminCatController::class, 'store']);
    Route::post("/categories/update", [AdminCatController::class, 'update']);
    Route::get("/categories/toggle/{cat}", [AdminCatController::class, 'toggle']);
    Route::get("/categories/delete/{cat}", [AdminCatController::class, 'delete']);

    Route::get("/skills", [AdminSkillController::class, 'index']);
    Route::post("/skills/store", [AdminSkillController::class, 'store']);
    Route::post("/skills/update", [AdminSkillController::class, 'update']);
    Route::get("/skills/toggle/{skill}", [AdminSkillController::class, 'toggle']);
    Route::get("/skills/delete/{skill}", [AdminSkillController::class, 'delete']);

    Route::get("/exams", [AdminExamController::class, 'index']);
    Route::get("/exams/show/{exam}", [AdminExamController::class, 'show']);
    Route::get("/exams/show-questions/{exam}", [AdminExamController::class, 'showQuestions']);
    Route::get("/exams/create", [AdminExamController::class, 'create']);
    Route::post("/exams/store", [AdminExamController::class, 'store']);
    Route::get("/exams/create-questions/{exam}", [AdminExamController::class, 'createQuestions']);
    Route::post("/exams/store-questions/{exam}", [AdminExamController::class, 'storeQuestions']);
    Route::get("/exams/edit/{exam}", [AdminExamController::class, 'edit']);
    Route::post("/exams/update/{exam}", [AdminExamController::class, 'update']);
    Route::get("/exams/edit-question/{exam}/{question}", [AdminExamController::class, 'editQuestion']);//$exam->id,$ques->id
    Route::post("/exams/update-question/{exam}/{question}", [AdminExamController::class, 'updateQuestion']);
    Route::get("/exams/toggle/{exam}", [AdminSkillController::class, 'toggle']);
    Route::get("/exams/delete/{exam}", [AdminSkillController::class, 'delete']);

    Route::get("/students", [StudentController::class, 'index']);
    Route::get("/students/show-student/{id}", [StudentController::class, 'showScores']);
    Route::get("/students/open-exam/{studentId}/{examId}", [StudentController::class, 'openExam']);
    Route::get("/students/close-exam/{studentId}/{examId}", [StudentController::class, 'closeExam']);


    Route::get("/admins", [AdminController::class, 'index']);
    Route::get("/admins/create", [AdminController::class, 'create']);
    Route::post("/admins/store", [AdminController::class, 'store']);
    Route::get("/admins/promote/{id}", [AdminController::class, 'promote']);
    Route::get("/admins/demote/{id}", [AdminController::class, 'demote']);

    Route::get("/messages", [MessageController::class, 'index']);
    Route::get("/messages/show/{message}", [MessageController::class,'show']);
    Route::post("/messages/response/{message}", [MessageController::class,'response']);


});

