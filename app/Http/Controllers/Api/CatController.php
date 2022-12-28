<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CatResource;
use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function index()
    {
        $cats = Cat::get();
        return CatResource::collection($cats);
    }
    public function show($id)
    {
        $cat = Cat::with('skills')->find($id);
        return new CatResource($cat);
    }

}
