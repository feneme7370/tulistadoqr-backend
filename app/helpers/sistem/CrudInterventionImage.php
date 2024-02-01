<?php

namespace App\helpers\sistem;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CrudInterventionImage
{
    public static function deleteImage($imageString, $pathFolder){
        if($imageString != ''){
            $path = $pathFolder.$imageString;
            if(File::exists($path)){
                File::delete($path);
            }
        }
    }
    public static function uploadImage($imageString, $pathFolder, $imageNew){

        // Verificar si la carpeta existe, si no, crearla
        if (!file_exists($pathFolder)) {
            // Crear la carpeta con permisos 0755 (puedes ajustar esto según tus necesidades)
            mkdir($pathFolder, 0755, true);
        }

        // crear o reemplazar imagen
        CrudInterventionImage::deleteImage($imageString, $pathFolder);
        $name = auth()->user()->company_id.'_'.auth()->user()->id.'_'.time().'_'.Str::random(7);
        $extension = '.jpg';
        $filename = $name.$extension;

        $image_hero = Image::make($imageNew);
        $image_hero->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $image_hero->save($pathFolder. $filename, 70);
        return $filename;
    }
}