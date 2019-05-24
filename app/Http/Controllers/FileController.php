<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    public function add(Request $request){
        $path = $request->file('file')->store('avatars');

        return $path;
    }
}
