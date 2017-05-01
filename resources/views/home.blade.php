@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">哈?</div>
                <div class="panel-body">
                    你已经登录了 ~ 可以看到游记了
                </div>
            </div>
        </div>
    </div>

    @foreach ($posts as $post)

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $post->title }}</div>
                    <div class="panel-body">
                        {{ $post->content }}
                    </div>
                </div>
            </div>
        </div>

    @endforeach
   
</div>
@endsection

