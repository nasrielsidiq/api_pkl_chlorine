<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function createProfile(Request $request, $id)
    {

        // Create profile validator
        $validator = Validator::make($request->all(), [
            'nisn' => 'required',
            'full_name' => 'required',
            'birth_day' => 'required',
            'address' => 'required',
            'npsn' => 'required',
            'major' => 'required'
        ]);

        // Return if create profile fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors(),
            ], 422);
        }

        // $user = Auth::guard('api')->user();
        $school = School::where('npsn', $request->npsn)->first();
        // Create profile
        if (!$school) {
            return response()->json([
                'message' => 'School not found'
            ], 404);
        }
        $student = Student::updateOrInsert(
            ["user_id" => $id],
            [
                "user_id" => $id,
                "nisn" => $request->nisn,
                "full_name" => $request->full_name,
                "birth_day" => $request->birth_day,
                "address" => $request->address,
                "major" => $request->major,
                "npsn" => $school->npsn
            ]
        );

        $user = User::with('profile')->find($id);
        // Return create profile success
        return response()->json([
            'message' => 'Update Profile success',
            'user' => $user
        ], 200);
    }


}
