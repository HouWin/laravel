<?php

namespace App\Http\Controllers;

use App\Model\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class ShopController extends Controller
{
    //
    public function create(){
        $myShop= Shop::where('user_id',Auth::id())->first();
        if($myShop){
            return redirect()->route('myshop');
        }
       return view('shop.create');
    }

    public function add(Request $request){
        $shop=new Shop($request->all());
        $shop->user_id=Auth::id();
        if($shop->save()){
            return ['code'=>'200','data'=>$shop];
        }else
        {
            throw new \Exception('错误');
        }
    }


    public function my_shop(){
        $myShop= Shop::where('user_id',Auth::id())->first();
        if(!$myShop){
            return redirect()->route('createShop');
        }
        return view('shop.myshop',['shop'=>$myShop]);
    }

    public function edit($id){
        return view('shop.edit',['id'=>$id]);
    }

    public function shopInfo(Shop $shop){
        return ['code'=>'200','data'=>$shop];
    }

    public function upShop(Shop $shop,Request $request){
        $shop->update($request->all());
        return ['code'=>'200','data'=>$shop];
    }
}
