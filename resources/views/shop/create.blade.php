@extends('layouts.admin')

@section('content')
<add-shop-component suburl="{{route('addShop')}}" myshop="{{route('myshop')}}"></add-shop-component>
@endsection
