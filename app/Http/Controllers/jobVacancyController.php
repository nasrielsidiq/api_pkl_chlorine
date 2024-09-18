<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use App\Models\Student;
use App\Models\VacancyRecommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class jobVacancyController extends Controller
{
    public function jobCreate(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>['required'],
            'description'=>['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid Field',
                'errors' => $validator->errors(),
            ]);
        }

        $job = new JobVacancy();
        $job->name = $request->name;
        $job->description = $request->description;
        $job->save();

        return response()->json([
            'message' => 'create job successfuly',
            'job' => $job,
        ]);
        
    }

    public function vacancyCreate(Request $request){
        $validator = Validator::make($request->all(),[
            'job_id' => 'required',
            'student_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid Field',
                'errors' => $validator->errors(),
            ]);
        }

        $job = JobVacancy::Where('name', $request->name)->first();
        $student = Student::Where('id', $request->id)->first();

        $vacancy = new VacancyRecommendation();
        $vacancy->job_id = $job->id;
        $vacancy->job_id = $student->id;

        return response()->json([
            'message' => 'create vacancy recommendation successfuly',
            'job' => $job,
            'user' => $student,
        ]);
    }
}
