<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCourseFormRequest;
use App\Http\Requests\UpdateCourseFormRequest;

use App\Http\Resources\Courses;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $courses = Course::get();
       // dd($courses);
        // $mediaItems = $courses->getMedia();
        // $publicUrl = $mediaItems[0]->getUrl();

        return Courses::collection($courses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCourseFormRequest $request)
    {
        $validated = $request->validated();


        $course = Course::create([
            'title' => $validated['title'],
            'desc' => $validated['desc'],


        ]);
        
        $course->addMediaFromRequest('img_url')->toMediaCollection('images');

        $course->translations;

        return new Courses($course);

    }
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courses = Course::findOrFail($id);

        return new Courses($courses);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseFormRequest $request,$id)
    {
        $validated = $request->validated();
        $course = Course::findOrFail($id);
        $data=$request->all();
        // if ($request->hasFile('image')) 
        //   {
        //     $course->updateMediaFromRequest('image')->toMediaCollection('images');
        //   }
        //    else
        //   {
        //       $course->update($data);
        //   }
          $course->update($data);

            if ($request->hasFile('img')) 
              {            
                $course->media()->delete();
                $course->addMediaFromRequest('img')->toMediaCollection('images');
              }

            

        // $data=$request->except('img');
        // $popup->update($data);

        // if ($request->hasFile('icon')) {
        //     $popup->addMedia($file)->toMediaCollection('popup-icons');
        // }
        
        // $course->addMediaFromRequest('image')->toMediaCollection('images');


        return new Courses($course);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return 'The course deleted';  
    }
}
