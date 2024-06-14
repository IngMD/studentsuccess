<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function descargarArchivo($file)
    {
        $rutaArchivo = storage_path('app/uploads/' . $file);

        if (file_exists($rutaArchivo)) {
            return response()->download($rutaArchivo);
        } else {
            abort(404);
        }
    }
}
