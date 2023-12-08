<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DescribeImage;
use Inertia\Inertia;
use App\Models\Practice;
class DescribeImageController extends Controller
{
    public function index()
    {
        $describeImage = Practice::where('type', 'describe_image')->paginate(15);

        return response()->json(['message' => $describeImage]);
    }

    public function show($id)
    {
        $describeImage = Practice::find($id);

        $files = $describeImage->files;

        return Inertia::render('practice/speaking/describeImage', [
            'DescribeImage'=> $describeImage,
            'files' => $files
        ]);
    }
}
