@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">hotmap</div>
                <div class="panel-body">
                    {{-- baiduap --}}
                 
                    <div id="map"></div>
                                                         
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
