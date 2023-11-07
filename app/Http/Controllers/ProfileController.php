<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Profile;
use Intervention\Image\ImageManagerStatic as Image;
class ProfileController extends Controller
{
    public function index()
    {
        //
        return view("profiles/edit");
    }

    public function store(Request $request)
    {
        // Validación de la entrada
        $request->validate([
            'imageUpload' => 'required|image|max:200',
            // Reemplaza 'imageUpload' por el nombre del campo en tu formulario
        ]);


        $requestImage = $request->file('imageUpload');
        $img = Image::make($requestImage);

        $img->resize(null, 400, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $name = $requestImage->hashName();
        $path = 'images/' . $name;
        $img->save(storage_path('app/public/' . $path));
        
        
        if ($request->imageUpload) {
            // $path = $request->file('imageUpload')->store('images', 'public');


            Profile::updateOrCreate(
                ['user_id' => Auth::id()],
                ['imageUpload' => $path]
            );

            return back()->with('success', "Your image has been updated.");
        }
    }

    public function edit(Profile $profile)
    {
        // Recupera el perfil del usuario actual, suponiendo que esté autenticado.
        $profile = auth()->user()->profile;

        return view('profiles.edit', compact('profile'));
    }


}
