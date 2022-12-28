<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\CodeUnit\Exception;

class ProfileController extends Controller
{
    public function editProfile($id)
    {
        $data['user'] = Auth::user();
        return view('admin.profile.profile')->with($data);
    }

    public function updateProfile(Request $request)
    {
        try{
        $user = User::findOrFail($request->id);

        $this->validate($request, [
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($request->id, 'id')
            ],
        ]);

            $user->update([
                'name' => $request->name,
                'email' =>$request->email,
            ]);
        $request->session()->flash("msg", "Profile updated successfully");
        return back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function editPassword($id)
    {
        $user = Auth::user();
        return view('admin.profile.edit-password',['user'=>$user]);
    }

    public function changePassword(Request $request)
    {
        try {
            $request->validate(([
                'password' => 'required|string|min:5|max:25|confirmed',
            ]));
            $user = User::where('id',$request->id)->first();
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            $request->session()->flash("msg", "Password updated successfully");
            return back();
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}


