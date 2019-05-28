<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //

    public function insertAll(array $data ){
        $list= \DB::table($this->getTable())->insert($data);
        return $list;
    }
}
