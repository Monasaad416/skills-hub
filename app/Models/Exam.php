<?php

namespace App\Models;

use App\Models\Skill;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    protected $guarded  = ['id', 'created_at', 'updated_at'];
    use HasFactory;

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
        ->withPivot('score','time_mins','status')
        ->withTimeStamps();
    }

    public function name($lang = null)
    {
        $lang = $lang ?? App::getLocale();
        return json_decode($this->name)->$lang;
    }

    public function desc($lang = null)
    {
        $lang = $lang ?? App::getLocale();
        return json_decode($this->desc)->$lang;
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
