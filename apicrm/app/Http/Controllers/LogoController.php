<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Storage;

class LogoController extends Controller
{
  public function user(Request $request)
  {
    /*
    if ($request->hasFile('file_path')) {

      $data = [
        'path' => $this->upload($request->file('file_path'))
      ];

      $original_filename = $request->file('file_path')->getClientOriginalName();
      $original_filename_arr = explode('.', $original_filename);
      $file_ext = end($original_filename_arr);
      $destination_path = './uploads/imgs/user/';
      $file_path_name = 'c-' . time() . '.' . $file_ext;

      if ($request->file('file_path')->move($destination_path, $file_path_name )) {

          $uploadPath = '/uploads/imgs/user/'.$file_path_name ;
          return response() -> json(['path'=>$uploadPath, 'message' => 'File has been Successfully Uploaded'], 201);
      } else {
          return response() -> json('Cannot upload file');
      }
    }
    // $request->file->storeAs('uploads', uniqid('img_') . $request->file->getClientOriginalName());
    */
  }

  public function upload($file, $storage = 'public', $folder = 'uploads')
    {
        $filename = uniqid() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        $path = Storage::disk($storage)->putFileAs($folder, $file, $filename);

        if (Storage::disk($storage)->exists($path)) {
            return $path;
        }

        return null;
    }
}
