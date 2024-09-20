<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;

class SchoolController extends Controller
{
    public function addSchool(Request $request){
        $validator = Validator::make($request->all(),[
            'npsn' => ['required','numeric','unique:schools'],
            'name' => ['required','unique:schools'],
            'address' => 'required',
            'icon' => ['required', 'mimes:png,jpg'],
            'headmaster' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:4']
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'error' => $validator->errors()
            ], 422);
        }
        $username = strtolower(str_replace(' ','_',$request->name));
        if ($request->file('icon')) {
            $fileName = $username.'_icon'.$request->file('icon')->getClientOriginalExtension();
            $request->file('icon')->storeAs('/image/school',$fileName);
        }
        $scholl = new School();
        $scholl->npsn = $request->npsn;
        $scholl->name = $request->name;
        $scholl->address = $request->address;
        $scholl->icon = $fileName;
        $scholl->headmaster = $request->headmaster;
        $scholl->save();

        $user = new User();
        $user->username = $username;
        $user->password = bcrypt($request->password);
        $user->role = 'school';
        $user->save();

        return response()->json([
            'message' => 'Add new school success',
            'school' => $scholl
        ], 200);
    }
}
