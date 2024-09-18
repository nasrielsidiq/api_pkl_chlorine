<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function taskCreate(Request $request){
        $validator = Validator::make($request->all(),[
            'student_id'=>['required'],
            'name'=>['required'],
            'description'=>['required'],
            'is_done'=>['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "Invalid Field",
                'errors' => $validator->errors(),
            ]);
        }

        $task = new Task();
        $task->student_id = $request->student_id;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->is_done = $request->is_done;
        $task->save();

        return response()->json([
            'message' => 'Create task successfuly',
            'taks' =>$task,
        ]);
    }
}
