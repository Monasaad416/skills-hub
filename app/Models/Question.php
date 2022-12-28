<?php

namespace App\Models;

use App\Models\Exam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    protected $guarded  = ['id', 'created_at', 'updated_at'];
    use HasFactory;


    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
