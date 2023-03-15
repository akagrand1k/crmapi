<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait Uploadable
{
  public function upload($file, $special_folder = '', $folder = 'uploads', $storage = 'public')
  {
    if ($special_folder == '' && isset($this->upload_path)) {
      $special_folder = $this->upload_path;
    }

    $filename = uniqid() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
    $path = Storage::disk($storage)->putFileAs($folder.$special_folder, $file, $filename);

    if (Storage::disk($storage)->exists($path)) {
        return $path;
    }

    return null;
  }
}
