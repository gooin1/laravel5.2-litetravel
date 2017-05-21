
@extends('layouts.app')

@section('content')

    <div class="container">
        <label for="start">请输入起点(默认位置可能不准确)</label>
        <input id="start" class="form-control" type="text" placeholder="起点" name="start">
        <label for="start">请输入目的地</label>
        <div class="input-group">
            <input id="end" type="text" class="form-control required" placeholder="请输入目的地" name="end">
            <div class="input-group-btn">
                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">选择出行方式 <span class="caret"></span>
    
                </button>
                <ul class="dropdown-menu pull-right">
                    <li> <a id="bus">公交</a>
    
                    </li>
                    <li> <a id="drive">驾车</a>
    
                    </li>
                    <li> <a id="walk">步行</a>
    
                    </li>
                </ul>
            </div>
        </div>
        <br>
        {{-- 提示信息 --}}
        <div class="alert alert-warning" id="message"></div>
        {{-- 面板 --}}
        <div class="col-md-7">
            <div class="row">
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-heading">路线规划</div>
                        <div class="panel-body">{{-- baiduap --}}
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-md-offset-1">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">路线规划结果</div>
                    <div class="panel-body">
                        <div id="r-result"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection


@section('js')
<script src="/js/ip2lnglat.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=OjDVDaIyfqZGehQG2moe8nb9xvgoBWPp"></script>
<script type="text/javascript">
    var map = new BMap.Map("map");       // 创建地图实例
    var point = new BMap.Point(user_lng, user_lat);
    var marker = new BMap.Marker(point); // 在当前位置显示marker
    map.centerAndZoom(point, 13);             // 初始化地图，设置中心点坐标和地图级别
    map.enableScrollWheelZoom(); // 允许滚轮缩放
    map.addOverlay(marker);    // 添加位置的标记
    // 在起点填入基于浏览器获取的位置
    document.getElementById('start').value = user_address;  
    $("#message").hide();
   
    
    var searchBusComplete = function (results){
            var start = document.getElementById('start').value;  
            var end = document.getElementById('end').value; 
            var output = "从"+ start +"到"+ end +"坐公交需要";
			var plan = results.getPlan(0);
			output += plan.getDuration(true) + "\n";  //获取时间
			output += plan.getDistance(true) + "\n";  //获取距离
            console.log(output);
            $("#message").show().html(output);
	}

    
      var searchDriveComplete = function (results){

            var start = document.getElementById('start').value;  
            var end = document.getElementById('end').value; 
            var output = "从"+ start +"到"+ end +"驾车需要";
			var plan = results.getPlan(0);
			output += plan.getDuration(true) + "\n";                //获取时间
            output += "总路程为：" ;
            output += plan.getDistance(true) + "\n";             //获取距离
            console.log(output);
            $("#message").show().html(output);
	}

    $("#bus").click(function(){
        $("#message").empty();        
        $("#message").hide();        
       map.clearOverlays();
        //获取起点,终点的值
        var start = document.getElementById('start').value;  
        var end = document.getElementById('end').value;  
        //console.log("目的地: " + end);
	    var transit = new BMap.TransitRoute(map, {
		    renderOptions: {map: map ,panel: "r-result"},
            onSearchComplete: searchBusComplete,
            policy: 0
	    });
        transit.search(start,end);
    });
        $("#drive").click(function(){
        $("#message").empty();          
        $("#message").hide();          
        map.clearOverlays();
        //获取起点,终点的值
        var start = document.getElementById('start').value;  
        var end = document.getElementById('end').value;  
        //console.log("目的地: " + end);
	   search(start,end); 
		function search(start,end,route){ 
			var driving = new BMap.DrivingRoute(map, {renderOptions:{map: map, panel: "r-result",  autoViewport: true}, onSearchComplete: searchDriveComplete, policy: route});
			driving.search(start,end);
		}
    });

      $("#walk").click(function(){
        $("#message").empty();
         $("#message").hide();  
        map.clearOverlays();
        //获取起点,终点的值
        var start = document.getElementById('start').value;  
        var end = document.getElementById('end').value;  
        //console.log("目的地: " + end);
	    var walking = new BMap.WalkingRoute(map, {renderOptions:{map: map, panel: "r-result", autoViewport: true}});
	    walking.search(start, end);
    });


</script>

@endsection