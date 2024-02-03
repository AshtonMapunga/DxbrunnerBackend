<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher; 
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;


class TeacherController extends Controller
{



    public function editteachers($id)
    {
        $student = Teacher::find($id);
        if($student){
            return response()->json([
                'status' => 200,
                'student' => $student
            ],200);

        }else{
            return response()->json([
                'status' => 404,
                'message' => "No student found"
            ],404);
        }

    }

    public function updateteachers(Request $request, int $id)
    {

        $validator =
        Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:10',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()

            ],422);
        }else{

            $student = Teacher::find($id);

            if($student){


                $student -> update([
                    "name" => $request->name,
                "address" => $request->address,
                "email" => $request->email,
                "phone" => $request->phone,
                "role" => "STUDENT",
                'password' => Hash::make($request->password)

                ]);



                return response()->json([
                    'status' => 200,
                    'message' => "Student updated successfuly"
                ],200);

            }else{

                return response()->json([
                    'status' => 404,
                    'message' => "no such Student found"
                ],404);
            }
        }




    }

    public function deleteteachers($id)
    {
        $student = Teacher::find($id);
        if($student){
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => "Teacher Deleted Successfully"
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "no such Student found"
            ],404);

        }
    }
















    public function fetchTeachers()
    {
        $students = Teacher::all();
        if($students->count() > 0){
            return response()->json([
                'status' => 200,
                'students' => $students
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No record found'
            ], 404);
        }
    }

   




    public function registerTeacher(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'phone' => 'required',
                'email' => 'required|email|unique:teachers',
                'password' => 'required|confirmed',
                'address' => 'required'
            ]);

            Teacher::create([
                "name" => $request->name,
                "address" => $request->address,
                "email" => $request->email,
                "phone" => $request->phone,
                "role" => "TEACHER",
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                "status" => true,
                "message" => "User created successfully"
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                "status" => 422,
                "message" => "Validation failed",
                "errors" => $e->errors()
            ], 422);

        } catch (QueryException $e) {
            return response()->json([
                "status" => 500,
                "message" => "Database error",
                "error" => $e->getMessage()
            ], 500);
        }
    }




    public function loginTeacher(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'

        ]);
        $token = JWTAuth::attempt(['email' => $request->email, 'password' => $request->password]);

        if(!empty($token)) {
            return response()->json([
                "status" => true,
                "message" => "Teacher logged in successfully",
                "token" => $token
            ]);

        }

        return response()->json([
            "status" => false,
            "message" => "Invalid login details",
        ]);



    }


    



}
