<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Category;
use App\Models\Info;
use App\Models\Lesson;

class Puble extends Controller
{

    public function index()
    {
        $category =Category::all();
        return view('index', compact('category'));

    }

    public function show($id)
    {
        $lesson =Category::with('lessons')->findOrFail($id);
        return view('student.category', compact('lesson'));
    }




    public function python()
    {
        return view('student.python');
    }
    public function frontIde()
    {
        return view('student.frontIde');
    }

    public function c()
    {
        return view('student.c');
    }
    public function register()
    {
        return view('student.register');
    }

    public function setRegister(Request $request)
    {
       $validated = $request->validate([
        'name' => ['required','string','min:3','max:25'],
        'email' => ['required','email','min:5','max:100'],
       ]);
       try{

       $student = Student::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
       ]);

       Auth::guard('student')->login($student);
       $request->session()->regenerate();
      
       return redirect()->route('index')->with('success_registration','Successfull registration');
       }
       catch(\Exception $e)
       {
         logger()->error('Error during student registration: ' . $e->getMessage());
            return redirect()->back()->with('error','An error occurred while processing your registration. Please try again later.');
       }
    }

    public function info()
    {
        $info = Info::all();
        return view('student.info', compact('info'));
    }
}
