<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProfileController extends Controller
{
    public function createProfile(Request $request){
        // Check if the user is authenticated
        if (!Auth::guard('api')->check()) {
            return response()->json([
                'message' => 'User is not authenticated',
            ], 401);
        }

        // Create profile validator
        $validator = Validator::make($request->all(), [
            'nisn' => 'required',
            'full_name' => 'required',
            'birth_day' => 'required',
            'adress' => 'required',
            'npsn' => 'required',
        ]);

        // Return if create profile fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = Auth::guard('api')->user();
        // Create profile
        $student = new Student();
        $student->nisn = $request->nisn;
        $student->full_name = $request->full_name;
        $student->user_id = $user->id;
        $student->birth_day = $request->birth_day;
        $student->adress = $request->adress;
        $student->npsn = $request->npsn;

        // Get the authenticated user's nisn
        // $user = JWTAuth::user();

      

        // if ($user && $user->nisn) {
        //     $student->nisn = $user->nisn;
        // } else {
        //     return response()->json([
        //         'message' => 'User does not have a nisn',
        //     ], 422);
        // }

        // $student->save();

        // Return create profile success
        return response()->json([
            'message' => 'Create Profile success',
            'student' => $student,
            // 'user' => $user
        ], 200);
    }

    public function updateProfile(Request $request){
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'birth_day' => 'required',
            'adress' => 'required',
            'npsn' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors(),
            ], 422);
        }

        $student = Student::find($request->id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->full_name = $request->input('full_name');
        $student->birth_day = $request->input('birth_day');
        $student->adress = $request->input('adress');
        $student->npsn = $request->input('npsn');
        $student->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'student' => $student
        ], 200);
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = user::find($request->id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return response()->json([
            'message' => 'Profile updated successfully',
            'student' => $user,
        ], 200);
    }
}
