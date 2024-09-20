<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function createUser(Request $request){
        //Register validator
        //Validasi jika register gagal
        $validator = Validator::make($request->all(), [
            'username' => ['required','unique:users'],
            'email' => ['required', 'unique:users'],
            'password' => ['required','min:4']
        ]);

        //return jika tidak memenuhi syarat validasi
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors()
            ], 422);
        }

        //Create user
        //Menambahkan user ke dalam tabel
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = "student";
        $user->password = bcrypt($request->password);
        $user->save();


        //Return hasil register
        return response()->json([
            'message' => 'Create new user success',
            'user' => $user,
        ], 200);
    }
}
