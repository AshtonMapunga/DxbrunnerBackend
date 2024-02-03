<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MyClass;
use Illuminate\Support\Facades\Validator;



class ClassController extends Controller
{

   


    public function addClass(Request $request)
    {
        $validator =
        Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'description' => 'required|string|max:191',
   
          
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()

            ],422);
        }else{
            $classObj = MyClass::create([
                'name' => $request->name,
                'description' => $request->description,
             

            ]);
            if($classObj){
                return response()->json([
                    'status' => 200,
                    'message' => "class creted successfuly"
                ],200);

            }else{

                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong"
                ],500);
            }
        }

    }













    public function editClass($id)
    {
        $student = MyClass::find($id);
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

    public function updateclasses(Request $request, int $id)
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

            $student = MyClass::find($id);

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

    public function deleteclasses($id)
    {
        $student = MyClass::find($id);
        if($student){
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => "Student Deleted Successfully"
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "no such Student found"
            ],404);

        }
    }


    public function fetchClasses()
    {
        $classObj = MyClass::all();
        if($classObj->count() > 0){
            return response()->json([
                'status' => 200,
                'classes' => $classObj
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'No record found'
            ], 404);
        }
    }


}
