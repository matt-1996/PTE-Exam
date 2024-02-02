<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class FileController extends Controller
{
    public function saveAudio(Request $request)
    {

        Storage::disk('public')->put("recorded_files", $request->files_file);
    }
}
