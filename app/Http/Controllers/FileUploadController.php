<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Models\UploadFile;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Http\File;

class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    public function store(FileUploadRequest $request)
    {
        foreach ($request->files as $file) {

            $fileFolder = 'files';

            if (!Storage::exists($fileFolder)) {
                Storage::makeDirectory($fileFolder);
            }
            $fileUrl = Storage::putFile($fileFolder, new File($file[0]));

            $file = new UploadFile;
            $file->file_url = $fileUrl;
            $file->save();

            return response()->json([
                'status' => 1,
                'success'=>'File Uploaded Successfully',
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UploadFile  $image
     * @return \Illuminate\Http\Response
     */
    public function show(UploadFile $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UploadFile  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(UploadFile $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UploadFile  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UploadFile $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UploadFile  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(UploadFile $file)
    {
        //
    }
}
