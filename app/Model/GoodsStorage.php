<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsStorage extends Model
{
    //
    public $guarded=[];

    public $fillable=['goods_name',
        'goods_price',
        'desc',
        'image',
        'weight',
        'packaging'];

    public function images(){
        return $this->hasMany(File::class,'yid','id');
    }
}
