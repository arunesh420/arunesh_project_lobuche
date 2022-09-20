<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
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
       $Student = new Student();
       $Student->name = $request->name;
       $Student->address = $request->address;
       $Student->age = $request->age;
       $img = Image::make ($request->file('image'));
       $filename = $request->file('image')->getClientOriginalName();
       $img->save('storage/image/'.$filename);
       $Student -> image = $filename;
       $Student->save();
       return 'saved';
    }
}
