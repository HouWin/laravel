@extends('layouts.admin')

@section('content')
    <div>

        <el-row>
            <el-col :span="10">
                <el-card class="box-card">
                    <div slot="header" class="clearfix">
                        <span> 我的信息 <i class="el-icon-location"></i></span>
                        <el-button style="float: right; padding: 3px 0" type="text"><a href="{{route('editShop',['id'=>$shop['id']])}}">修改</a></el-button>
                    </div>
                    <dl class="dl-horizontal">
                        <dt>名称</dt>
                        <dd>{{$shop['shop_name']}}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>小区</dt>
                        <dd>{{$shop['community']}}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>电话</dt>
                        <dd>{{$shop['tel']}}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>地址</dt>
                        <dd>{{$shop['site']}}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>起始</dt>
                        <dd>{{$shop['up_to_send']}}￥</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>工作时间</dt>
                        <dd>{{$shop['business_hours_start']}} - {{$shop['business_hours_end']}}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>介绍</dt>
                        <dd>{{$shop['desc']}}</dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt>创建时间</dt>
                        <dd>{{$shop['created_at']}}</dd>
                    </dl>
                </el-card>
            </el-col>
        </el-row>

        {{--<blockquote>--}}
            {{--<p>{{$shop['desc']}}</p>--}}
            {{--<footer>所属 <cite title="Source Title">{{Auth::user()->email}}</cite></footer>--}}
        {{--</blockquote>--}}
    </div>
@endsection

@section('scripts')
    <script>
        new Vue({
            el: '#app',
            data: function() {
                return {
                    activeName: 'second'
                };
            },
            methods: {
                handleClick(tab, event) {
                    console.log(tab, event);
                }
            }
        })
    </script>
@endsection