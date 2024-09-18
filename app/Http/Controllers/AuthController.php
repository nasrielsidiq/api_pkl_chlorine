<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

// use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request){
        //Login validator
        //Validasi jika login gagal
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        //Return jika login gagal
        if($validator->fails()){
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validator->errors()
            ],422);
        }

        //Login dengan email username dan nisn
        // $key_field = $this->getLoginType($request->key_field);

        //Auth
        //Auth api login dengan email password
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'message' => 'Email, NISN, username or password incorrect'
            ],401);
        }

        //Return hasil login
        $user = JWTAuth::user();
        return response()->json([
            'message' => 'Login success',
            // $credentials,
            'token' => $token,
            'user' => $user,
        ], 200);
    }
    public function register(Request $request,){
        //Register validator
        //Validasi jika register gagal
        $validator = Validator::make($request->all(), [
            'username' => ['required','unique:users'],
            'email' => ['required', 'unique:users'],
            'nisn' => ['required','unique:users'],
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
        $user->nisn = $request->nisn;
        $user->password = bcrypt($request->password);
        $user->save();

        //Auth
        //Auth api login dengan email password
        $credentials = $request->only('email', 'password');
        if (!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json([
                'message' => 'Email, NISN, username or password incorrect'
            ],401);
        }

        //Return hasil register
        return response()->json([
            'message' => 'Register success',
            'token' => $token,
            'user' => $user,
        ], 200);
    }
}
