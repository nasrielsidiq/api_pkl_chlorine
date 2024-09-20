<?php

namespace App\Http\Controllers;

use App\Models\Student;
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
            // 'is_done'=>['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => "Invalid Field",
                'errors' => $validator->errors(),
            ]);
        }

        $student = Student::find($request->student_id);
        if (!$student) {
            return response()->json([
                'message' => 'Student not found'
            ],404);
        }

        $task = new Task();
        $task->student_id = $request->student_id;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->is_done = false;
        $task->save();

        return response()->json([
            'message' => 'Create task successfuly',
            'taks' =>$task,
        ]);
    }
    public function makeAsDone($id){
        $task = Task::find($id);
        if (!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }
        $task->update(['is_done' => true]);
        return response()->json(null,201);
    }
}
