<?php

namespace App\Http\Controllers\Api;

use App\Models\Page\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userBackend = auth()->user();
        $levels = Level::with('user', 'company')->where('company_id', $userBackend->company_id)->latest()->get();
        
        return ['levels' => $levels, 'userBackend' => $userBackend];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->name);
        // Guardar la imagen
        // if ($request->hasFile('new_image')) {
            // dd($request->all(), $request->file('new_image'), $request->file(), json_decode($request), json_encode($request));
            // $image = $request->file('new_image');
            // $imageName = time() . '.jpg';
            // $path = $image->storeAs('uploads', $imageName, 'public'); // Guardar en storage/app/public/uploads
            
            //Puedes guardar la URL de la imagen en la base de datos si lo necesitas
            // $imageUrl = Storage::url($path);
        // }
        $fields = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required',
            'description' => 'required',
            'company_id' => 'required',
            'user_id' => 'required',
            'new_image' => 'nullable|image',
        ]);

        $level = Level::create($fields);    
        // $level = Level::create([
        //     'name' => $request->name,
        //     'slug' => $request->slug,
        //     'description' => $request->description,
        //     'company_id' => $request->company_id,
        //     'user_id' => $request->user_id,
        // ]);    
        // dd('no imagen');

        // $post = $request->user()->posts()->create($fields);

        return ['level' => $level, 'user' => auth()->user()];
        // return $post;
    }

    /**
     * Display the specified resource.
     */
    public function show($levelId)
    {
        $userBackend = auth()->user();
        $level = Level::where('id', $levelId)->with('user', 'company')->where('company_id', $userBackend->company_id)->first();
        
        return ['level' => $level, 'userBackend' => $userBackend];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
