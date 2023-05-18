<?php

function fileUpload($file){
    $file_name = uniqid().'_'.$file->getClientOriginalName();
    //file type
    $mime = $file->getMimeType();
    $file_type = explode('/',$mime)[0];
    //store image file
    if($file_type == 'image'){
        $file->storeAs('public/image',$file_name);
    }
   
    //return file name
    return $file_name;
}

function fileDelete($file_name){
    $file = explode('.',$file_name);
    $file_type = end($file);
    if($file_type == 'png' || $file_type == 'jpeg' || $file_type == 'jpg' || $file_type == 'webp'){
        Storage::delete('public/image/'.$file_name);
    }

}
?>