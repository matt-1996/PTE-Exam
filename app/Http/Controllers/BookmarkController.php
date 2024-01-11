<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function create($id,$color)
    {
        if($color == "gray"){
            Bookmark::where('practice_id',$id)
            ->where('user_id', auth()->user()->id)
            ->delete();
        }else{

            auth()->user()->bookmarks()->updateOrCreate([
                "practice_id" => $id,
                'user_id' => auth()->user()->id
            ],
            [
                'color'=> $color,
            ]);   
        }
        return response()->json(["status" => "success"],200);
    }
}
