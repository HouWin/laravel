@extends('layouts.admin')

@section('content')
    <up-shop-component suburl="{{route('upShop',['shop'=>$id])}}" myshop="{{route('myshop')}}" shopinfo="{{route('shopInfo',['shop'=>$id])}}"></up-shop-component>
@endsection
