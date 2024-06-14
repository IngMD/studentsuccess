<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;

class UploadInfoController extends Controller
{
    public function store(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'required|string|max:255',
            'date' => 'required|date',
            'university_course' => 'required|string|max:255',
            'file' => 'required|file|max:10240', // máximo 10MB
        ]);

        // Guarda el archivo en el almacenamiento de Laravel
        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('uploads', $filename);

        // Crea un nuevo registro en la base de datos
        $asset = new Asset();
        $asset->title = $request->title;
        $asset->authors = $request->authors;
        $asset->date = $request->date;
        $asset->university_course = $request->university_course;
        $asset->file_path = $path; // guarda la ruta del archivo en la base de datos
        $asset->save();

        // Redirige de vuelta al dashboard con un mensaje de éxito
        return redirect()->back()->with('success', 'Información y archivo subidos correctamente.');
    }

     
        public function manage(Request $request)
        {
            $assets = Asset::query();

            if ($request->filled('filtroCarrera')) {
                $assets->where('university_course', $request->input('filtroCarrera'));
            }

            $assets = $assets->get();

            return view('manage', compact('assets'));
        }
}
