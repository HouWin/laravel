@extends('layouts.admin')

@section('content')
<add-goods-component suburl="{{route('createGoodsResult')}}" uploadurl="{{route('upload')}}" filetodb="{{route('createDbData')}}" csrf-token="{{csrf_token()}}"></add-goods-component>
@endsection

