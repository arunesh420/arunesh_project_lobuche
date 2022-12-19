<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PagesController extends Controller
{
    function home() {
        $data=[
            'name'=>'Arunesh',
            'age'=>'17'
        ];
        return view('welcome')->with($data);
    }
    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'age'=>'required',
            'address'=>'required'
        ]);

        $student = new Student();
        $student->name = $request->name;
        $student->address = $request->address;
        $student->age = $request->age;

        $filenameWithExt = $request->file('image')->getClientOriginalName(); //Image ko name taneko like .png, .jpg etc.
        $img = Image::make($request->file('image'));  //Image load gareko
        $img->save('storage/image/'.$filenameWithExt);
        $student->image = $filenameWithExt;
        $student->save();
        return redirect('/list');

    }

    public function list() {
        $students = Student::orderBy('name','asc')->get();
        return view('list')->with('students',$students);
    }

    public function edit($id) {
        $student = Student::where('id',$id)->first();
        return view('update')->with('student',$student);
//        $student = Student::find($id);
    }

    public function update(Request $request) {
        $student = Student::where('id',$request->id)->first();
        $student->name = $request->name;
        $student->address = $request->address;
        $student->age = $request->age;
        $student->save();
        return redirect('/list');
    }

    public function delete($id) {
        $student=Student::where('id', $id)->first();
        if (File::exists('storage/image/' .$student->image)){
            File::delete('storage/image/' .$student->image);
        }
        $student->delete();
        return redirect('/list');
    }
    public function index(){
        return view(('index'));
    }
    public function register(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        return redirect('/login');

    }


    public function login(){
        return view('login');
    }

    public function loginform(Request $request){
        $credentials =[
            'email'=>$request->email,
            'password'=>$request->password
        ];
        if (Auth::attempt($credentials)){
            return redirect('/list');
        }
        else{
            return'wrong credentials';
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
