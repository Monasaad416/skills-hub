<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\ApiResponseTrait;

class AuthController extends Controller
{
    use ApiResponseTrait;
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 422);
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id'=>3
        ]);
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('api_token');

        return $this->apiResponse('200', 'user Added Successfully', [
            'api_token' => $token->plainTextToken,
            'user' => $user,
        ]);
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:5|max:25',
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 422);
        }

        $user = user::where('email', $request->email)->first();
        if ($user) {
            $correctPassword = Hash::check($request->password, $user->password);
            if ($correctPassword) {
                $token = $user->createToken('api_token');

                return $this->apiResponse('200', 'user logged Successfully', [
                    'api_token' => $token->plainTextToken,
                    'user' => $user,
                ]);
            } else {
                return $this->apiResponse('422', 'Incorrect Password');
            }
        } else {
            return $this->apiResponse('422', 'email dose not exist');
        }
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->apiResponse('200', 'user logged out successfully');
    }


    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors(), 409
            ]);
        }
        $user = user::where('email', $request->email)->first();

        if ($user) {
            $pinCode = rand(1111, 9999);

            $updateduser = $user->update([
                'pin_code' => $pinCode,
            ]);

            if ($updateduser !== null) {
                //send sms with pincode
                //send email with pincode
                Mail::to($user->email)
                    ->send(new ResetPassword($pinCode));
            } else {
                return $this->apiResponse('0', 'Try again');
            }
        } else {
            return $this->apiResponse('0', 'There is no account related to this email');
        }
    }

    public function sendNewPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pin_code' => 'required',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 422);
        }
        $user = user::where('pin_code', $request->pin_code)->where('pin_code', '!=', 0)->first();


        if ($user) {
            $updateduser = $user->update([
                'password' => Hash::make($request->password),
                'pin_code' => null,
            ]);

            if ($updateduser !== null) {
                return $this->apiResponse('200', 'Password updated successfully');
            } else {
                return $this->apiResponse('0', 'Try again');
            }
        } else {
            return $this->apiResponse('0', 'Invalid pin code');
        }
    }


    public function profile(Request $request)
    {
        $loggeduser = $request->user();
        return $this->apiResponse('200', 'Display profile successfully', [
            'profile' => [
                'name' => $loggeduser->name,
                'email' => $loggeduser->email,
                'phone' => $loggeduser->phone,
                'region_id' => $loggeduser->region_id
            ]
        ]);
    }



    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'email' => [Rule::unique('users')->ignore($request->user()->id)],
            'phone' => 'nullable|string', [Rule::unique('users')->ignore($request->user()->id)],
            'city_id' => 'nullable|exists:cities,id',
            'region_id' => 'nullable|exists:users,id'
        ]);
        if ($validator->fails()) {
            return response()->json([
                $validator->errors()
            ], 422);
        };

        $loggeduser = $request->user();
        $loggeduser->update($request->all());

        if ($request->has('password')) {
            $newPassword = Hash::make($request->password);
            $loggeduser->update(['password' => $newPassword]);
        };
        return $this->apiResponse('200', 'Profile updated successfully', ['user' => $request->user()]);
    }



    public function registerDeviceToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string', // device token
            'type' => 'required|string|min:5|max:25',
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors(), 409
            ]);
        }
        //remove old token
        NotificationToken::where('token', $request->token)->delete();
        $request->user()->notification_tokens()->create(
            $request->all(),
        );
        return $this->apiResponse('200', 'Notification token created successfully');
    }
    public function removeDeviceToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                $validator->errors(), 409
            ]);
        }
        NotificationToken::where('token', $request->token)->delete();
    }
}
