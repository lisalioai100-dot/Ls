<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Lesson;
use App\Models\Info;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Trowable;

class Admin extends Controller
{
    public function upload(){

        $category = Category::all();

        return view('admin.uplade',compact('category'));
    }

    public function setUpload(Request $request)
    {
        $validated =$request->validate([
            'name' => ['required','string','min:3','max:40'],
            'image' => ['required','image','mimes:jpg,png,jpeg,gif','max:2048'],
        ]);
        DB::beginTransaction();
        try{
            $imagePath = $request->file('image')->store('image','public');
            $upload = Category::create([
                'name' => $validated ['name'],
                'image' => $imagePath,
            ]);
            DB::commit();
            return back()->with('success','succcessfully uploading');
        }
        catch(\Throwable $e)
        {
            if(isset($imagePath))
                {
                    Storage::disk('public')->delete($imagePath);
                }
            DB::rollback();
            logger()->error('ERROR :'.$e->getMessage());
            return back()->with('fail','try again later ');
        }
    }

    public function setLesson(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string' ,'min:5','max:1000'],
            'image' => ['required','image','mimes:jpg,png,jpeg,gif','max:2048'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ]);

        DB::beginTransaction();

        try{

            $imagePath = $request->file('image')->store('image','public');
            $lesson = Lesson:: create([
                'name' => $validated['name'],
                'image' => $imagePath,
                'category_id' => $validated['category_id'],
            ]);
            DB::commit();
            return back()->with('done','successfull published lessons');
        }
        catch(\Throwable $e)
        {
            if(isset($imagePath))
                {
                    Storage::disk('public')->delete($imagePath);
                }
        

                    DB::rollback();
                    logger()->error('Error : '.$e->getMessage());
                    return back()->with('lesson_fail','try again later');
        }
    }

    public function setInfo(Request $request)
    {
        $validated = $request->validate([

            'article' => ['nullable','string','min:3','max:100'],
            'image' => ['nullable','image','mimes:jpg,png,jpeg,gif','max:2048'],
            'video' => ['nullable', 'file', 'mimes:mp4,ogg,mov,webm', 'max:51200'],

        ]);
        
      

        try{

           $image =null;
           $video = null;

           if($request->hasFile('image'))
            {
                $image = $request->file('image')->store('image','public');
            }


            if($request->hasFile('video'))
                {
                    $video =$request->file('video')->store('image','public');
                }
         

            $info = Info :: create([
            'article' => $validated['article'],
            'image' =>$image,
            'video' =>$video,
           ]);
           return back()->with('done','successfull published news');
        }
        catch(\Throwable $e)
        {
            if(isset($image))
                {
                    Storage::disk('public')->delete($image);
                }
            if(isset($video))
                {
                    Storage::disk('public')->delete($video);
                }
            logger()->error('Error : '.$e->getMessage());
            return back()->with('lesson_fail','try again later');
        }
    }
}
