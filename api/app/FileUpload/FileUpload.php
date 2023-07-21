<?php
namespace App\FileUpload;


class FileUpload{
    public static function handleFileUpload($FILE, $dir = 'uploads/unknown'){
       
           
        if(!file_exists($dir)){
            mkdir($dir , 0777, true);
        }
    
        $image_parts = explode(";base64,", $FILE);
        $image_type_aux = explode("image/", $image_parts[0]);
        $extension = $image_type_aux[1];
    
       
        $uri = $dir.'/'.uniqid().'.'.$extension; 
        file_put_contents($uri, base64_decode($image_parts[1]));   
        
        return $uri;
               
    }
}
