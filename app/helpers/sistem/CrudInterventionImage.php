<?php

namespace App\helpers\sistem;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CrudInterventionImage
{
    public static function deleteImage($imageString, $pathFolder){
        if($imageString != ''){
            $path = 'archives/images/' . $pathFolder;
            if(File::exists($path . $imageString)){
                File::delete($path . $imageString);

                File::delete($path . 'tumb_' . $imageString);
            }
        }
    }
    public static function uploadImage($imageString, $pathFolder, $imageNew){
        $path = 'archives/images/' . $pathFolder;

        // Verificar si la carpeta existe, si no, crearla
        if (!file_exists($path)) {
            // Crear la carpeta con permisos 0755 (puedes ajustar esto según tus necesidades)
            mkdir($path, 0755, true);
        }

        // crear o reemplazar imagen
        CrudInterventionImage::deleteImage($imageString, $pathFolder);

        // crear nombres
        $name = auth()->user()->company_id.'_'.auth()->user()->id.'_'.time().'_'.Str::random(7);
        $extension = '.jpg';

        $filename = $name.$extension;
        $filename_tumb = 'tumb_' . $name . $extension;

        // tomar imagenes a editar
        $image_hero = Image::make($imageNew);
        $image_hero_tumb = Image::make($imageNew);

        // editar imagenes
        $image_hero->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $image_hero_tumb->resize(128, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        // guardar imagenes
        $image_hero->save($path . $filename, 80);
        $image_hero_tumb->save($path . $filename_tumb, 95);
        
        // retornar el nombre sin el tumb
        return [$filename, $path];
    }
}