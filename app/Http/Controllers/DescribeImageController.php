<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DescribeImage;
use Inertia\Inertia;
class DescribeImageController extends Controller
{
    public function index()
    {
        $describeImage = DescribeImage::paginate(15);

        return response()->json(['message' => $describeImage]);
    }

    public function show($id)
    {
        $describeImage = DescribeImage::find($id);

        return Inertia::render('practice/speaking/describeImage', [
            'DescribeImage'=> $describeImage
        ]);
    }
}
