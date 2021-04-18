<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CourseHasFiles;
use App\Models\Course;

class CourseHasFilesController extends Controller
{
            /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'course_id' => 'required|integer',
            'title' => 'required|string',
            'file' => 'required|mimetypes:application/pdf|max:10000'
        ]);

        $course = Course::where('id', $fields['course_id'])->first();
        if (!$course){
            return response([
            'message' => 'No course'
            ], 401);
        }

        $uploadFolder = 'courses';
        $file = $request->file('file');
        $file_uploaded_path = $file->store($uploadFolder, 'public');
        $uploadedFileResponse = [
            "file_name" => $file_uploaded_path,
            "file_url" => Storage::disk('public')->url($file_uploaded_path),
            "mime" => $file->getClientMimeType()
        ];
        CourseHasFiles::create([
            'course_id' => $fields['course_id'],
            'file' => $file_uploaded_path,
            'title' => $fields['title'],
            'email' => $fields['email']
        ]);

        return response($uploadedFileResponse, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return CourseHasFiles::where('course_id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $ad = CourseHasFiles::find($id);
       $ad->update($request->all());
       return $ad;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return CourseHasFiles::destroy($id);
    }
}
