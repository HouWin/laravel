<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use mysql_xdevapi\Exception;

class FileController extends Controller
{
    //
    public function add(Request $request){
         $path = $request->file('file')->store('goods','public');
         return $path;
    }

    public function createDbData(Request $request){

        $yid=$request->id;
        $type=$request->type;
        foreach ($request->fileList as $val){
            $data[]= array(
                'yid'=>$yid,
                'type'=>$type,
                'file_path'=>$val
            );
        }

        $file=new \App\Model\File();
        $relust=$file->insertAll($data);
        if($relust)
        {
            return ['msg'=>'success'];
        }else
        {
            throw  new Exception('建立关系失败');
        }

    }

    public function delete($id){
        $file=\App\Model\File::find($id);
        Storage::disk('public')->delete($file->file_path);
        $file->delete();
        
    }
}
