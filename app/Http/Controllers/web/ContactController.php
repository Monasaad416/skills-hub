<?php

namespace App\Http\Controllers\web;

use Exception;
use App\Models\Message;
use App\Models\Setting;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

;

class ContactController extends Controller
{
    public function index()
    {
        $data['sett'] = Setting::select('email','phone')->first();
        return view('web.contact.index')->with($data);
    }


    public function send(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'nullable|string|max:255',
                'body' => 'required|string|max:255',
            ]);
            Message::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'body' => $request->body,
            ]);
            //normal request
            $request->session()->flash('success','Your message sent successfully');
            return back();
            //ajax
            // $data = ['success','Your message sent successfully'];
            //return Respons::json($data);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}

