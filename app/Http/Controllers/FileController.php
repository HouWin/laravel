<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //
    public function add(Request $request){
         if(empty($request->id) or empty($request->type)){
                new \Exception('错误');
         }
        $path = $request->file('file')->store('public/goods');

         $model=new \App\Model\File();
         $model->yid=$request->id;
         $model->type=$request->type;
         $model->file_path=$path;
         $model->save();

        return $path;
    }
}
