<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Cat extends Model
{
    protected $guarded  = ['id','created_at','updated_at'];
    use HasFactory;
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function name( $lang = null )
    {
        $lang = $lang ?? App::getLocale();
        return json_decode($this->name)->$lang;
    }

    public function scopeActive($query)
    {
        return $query->where('active',1);
    }

}

