@extends('layouts.admin')

@section('content')
<up-goods-component suburl="{{route('goodsUpdate',['id'=>$id])}}" uploadurl="{{route('upload')}}" filetodb="{{route('createDbData')}}" csrf-token="{{csrf_token()}}" goodinfo="{{route('goodsShow',['id'=>$id])}}" images_path="{{asset('')}}"></up-goods-component>
@endsection

