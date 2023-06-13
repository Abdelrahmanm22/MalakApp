<?php
namespace App\Traits;
trait files{
    function saveFile($file,$folderPath){
        $avatar_file_extension = $file->getClientOriginalExtension();
        $avatar_file_name = time().'.'.$avatar_file_extension;
        $avatar_path = $folderPath;
        $file->move($avatar_path,$avatar_file_name);
        return $avatar_file_name;
    }
}
?>