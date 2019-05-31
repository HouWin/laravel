@extends('layouts.admin')

@section('content')
    <div class="title_h">
        <h1>列表</h1>
        <a href="{{route('createGoods')}}"><button type="button" class="btn btn-primary right_f">添加</button></a>
    </div>

    <div class="row">
        @foreach ($goods as $good)
        <div class="col-sm-6 col-md-2">
            <div class="thumbnail">
                <img src="{{ asset("storage/".$good->images[0]->file_path)}}" alt="{{$good->goods_name}}" style="width: 238px; height: 200px;" class="cover">
                <div class="caption">
                    <br>
                    <h4>{{$good->goods_name}}</h4>
                    <p>{{$good->goods_price}}/{{$good->packaging}}     {{$good->weight}}</p>
                    <p><a href="{{route('goodsEdit',['id'=>$good->id])}}" class="btn btn-primary" role="button">修改</a> <a href="#" class="btn btn-default" role="button">移除</a></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{$goods->links()}}

@endsection
<style type="text/css">

    .fill {
        object-fit: fill;
    }

    .contain {
        object-fit: contain;
    }

    .cover {
        object-fit: cover;
    }

    .none {
        object-fit: none;
    }

    .scale-down {
        object-fit: scale-down;
    }

    caption{ padding-top: 10px;}

    .thumbnail{

        display: block;
        padding: 4px;
        margin-bottom: 20px;
        line-height: 1.42857143;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        -webkit-transition: border .2s ease-in-out;
        -o-transition: border .2s ease-in-out;
        transition: border .2s ease-in-out;
        overflow: hidden;
    }
    .title_h{ overflow: hidden;}
    .title_h h1{ float: left;}
    .right_f{ float: right;}
</style>
