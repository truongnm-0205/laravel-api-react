<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //
    public function index(){
        $students = Student::all();
        return response()->json([
            'status'=>200,
            'students'=>$students
        ]);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|unique:students',
            'avatar' => 'mimes:jpg,png',
            
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 402,
                'errorMessage' => $validator->getMessageBag()
            ]);
        }else{
            $student= new Student();

            $student->name = $request->input('name');
            $file = $request->file('avatar');

            $avatar = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('/img/'),$avatar);

            $student->avatar = $avatar;

            $student->save();

            return response()->json([
                'status' => 200,
                'message' => 'Create Student successfully !'
            ]);
        }
    }

    public function edit($id){
        $student = Student::find($id);
        return response()->json([
            'status'=>200,
            'student'=>$student
        ]);
    }

    public function store($id,Request $request){
        $student = Student::find($id);

        $student-> name = $request->input('name');

        $file = $request->file('avatar');
        if($file != ''){
            $avatar = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('/img/'),$avatar);

            $student->avatar = $avatar;
        }
        $student->save();
        
        return response()->json([
            'status'=>200,
            'message'=>'Update Student Successfully !'
        ]);
    }

    public function destroy($id){
        
    }
}
