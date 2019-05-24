<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    public $fillable=['shop_name','site','up_to_send','user_id','tel','community','business_hours_start','business_hours_end','desc','timely'];
}
