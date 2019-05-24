@extends('layouts.admin')

@section('content')
<add-goods-component suburl="{{route('createGoodsResult')}}" uploadurl="{{route('upload')}}" csrf-token="{{csrf_token()}}"></add-goods-component>
@endsection

