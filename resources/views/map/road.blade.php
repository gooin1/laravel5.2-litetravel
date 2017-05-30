
@extends('layouts.app')

@section('content')

    <div class="container">
        <label for="start">请输入起点(默认位置可能不准确)</label>
        <input id="start" class="form-control" type="text" placeholder="起点" name="start" value={{ old('start') }}>

        <label for="start">请输入目的地</label>
        <input id="end" type="text" class="form-control required" placeholder="请输入目的地" name="end" {{ old('end') }}>
    
        <label for="start">选择出行方式</label>
        <div class="row">
            <div class="col-md-4">
                <div id="select-way" class="form-group">
                <select class="selectpicker form-control">
                    <option value="bus">公交</option>
                    <option value="drive">驾车</option>
                    <option value="walk">步行</option>
                </select>
                </div>
            </div>
            <div class="col-md-4">
                <div id="select-op" class="form-group">
                <select class="selectpicker form-control">
                    <div id="options">
                        <option value="0">最少时间</option>
                        <option value="1">最少换乘</option>
                        <option value="2">最少步行</option>
                        <option value="3">不乘地铁</option>
                    </div>
                    {{-- <div id="op-drive">
                        <option value="0">最少时间</option>
                        <option value="1">最短距离</option>
                        <option value="2">避开高速</option>
                    </div>
                    <div id="op-walk">
                        <option value="0">最少时间</option>  
                    </div> --}}
                    
                </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                <input type="button" class="btn btn-success" value="查询" id="findway"></button>
                </div>
            </div>
         </div>

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

    $("#select-way").change(function() {
        var way=$("#select-way select").val();
        if (way === "bus"){
            $("#options").html(
                "<option value="0">最少时间</option><option value="1">最少换乘</option><option value="2">最少步行</option><option value="3">不乘地铁</option>"
            ); 
            
        }
        if (way === "drive"){
            $("#op-bus").hide(); 
            $("#op-drive").hide(); 
            $("#op-drive").show(); 
            $("#op-walk").hide(); 
            console.log("11");
        }
        if (way === "bus"){
            $("#op-bus").hide(); 
            $("#op-drive").hide(); 
            $("#op-walk").hide(); 
            $("#op-walk").show(); 
        }

    });
        
    
    

    $("#findway").click(function(){
        //var end = document.getElementById('end').value; 
        //if (end === null){
        //    alert("不能为空");
        //}
        var way=$("#select-way select").val();
        if (way === "bus"){
            var i=$("#select-op select").val();
            // 路线方案
            var routePolicy = [BMAP_TRANSIT_POLICY_LEAST_TIME,BMAP_TRANSIT_POLICY_LEAST_TRANSFER,BMAP_TRANSIT_POLICY_LEAST_WALKING,BMAP_TRANSIT_POLICY_AVOID_SUBWAYS];
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
            console.log("bus-here");
            search(start,end,routePolicy[i]); 

		    function search(start,end,route){ 
                transit.setPolicy(route);
                transit.search(start,end);
            }
        }
        if (way === "drive"){
            alert("drive");
            $("#message").empty();          
            $("#message").hide();          
            map.clearOverlays();
            //获取起点,终点的值
            var start = document.getElementById('start').value;  
            var end = document.getElementById('end').value;  
            //三种驾车策略：最少时间，最短距离，避开高速
            var routePolicy = [BMAP_DRIVING_POLICY_LEAST_TIME,BMAP_DRIVING_POLICY_LEAST_DISTANCE,BMAP_DRIVING_POLICY_AVOID_HIGHWAYS];
            //console.log("目的地: " + end);
            var i=$("#select-op select").val();
            search(start,end,routePolicy[i]); 
            function search(start,end,route){ 
                var driving = new BMap.DrivingRoute(map, {renderOptions:{map: map, panel: "r-result",  autoViewport: true}, 
                onSearchComplete: searchDriveComplete, policy: route});
                driving.search(start,end);
            }
        }
        if (way === "walk"){
            alert("walk");
            $("#message").empty();
            $("#message").hide();  
            map.clearOverlays();
            //获取起点,终点的值
            var start = document.getElementById('start').value;  
            var end = document.getElementById('end').value;  
            //console.log("目的地: " + end);
            var walking = new BMap.WalkingRoute(map, 
                {renderOptions:{map: map, panel: "r-result", autoViewport: true},
                onSearchComplete: searchWalkComplete});
            walking.search(start, end);
        }
        
    });
    
    var way=$("#select-way select").val();
    var i=$("#select-op select").val();
    console.log(way + "," + i);
    /**
    *   公交查询
    */
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
    // 查找完成后回调函数
        var searchBusComplete = function (results){
            var start = document.getElementById('start').value;  
            var end = document.getElementById('end').value; 
            var output = "从<b>"+ start +"</b>到<b>"+ end +"</b>坐公交需要 <b>";
			var plan = results.getPlan(0);
			output += plan.getDuration(true) + "</b>,\n";  //获取时间
            output += "总路程为：<b>" ;
			output += plan.getDistance(true) + "</b>\n";  //获取距离
            console.log(output);
            $("#message").show().html(output);
	}
   /**
    *   驾驶查询
    */
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
			var driving = new BMap.DrivingRoute(map, {renderOptions:{map: map, panel: "r-result",  autoViewport: true}, 
            onSearchComplete: searchDriveComplete, policy: route});
			driving.search(start,end);
		}
    });

    var searchDriveComplete = function (results){
        var start = document.getElementById('start').value;  
        var end = document.getElementById('end').value; 
        var output = "从<b>"+ start +"</b>到<b>"+ end +"</b>驾车需要 <b>";
        var plan = results.getPlan(0);
        output += plan.getDuration(true) + "</b>,\n";                //获取时间
        output += "总路程为：<b>" ;
        output += plan.getDistance(true) + "</b>\n";             //获取距离        
        //output += plan.taxiFare.day.totalFare + "元";
        console.log(output);
        $("#message").show().html(output);
	}

   /**
    *   步行查询
    */
      $("#walk").click(function(){
        $("#message").empty();
         $("#message").hide();  
        map.clearOverlays();
        
        //获取起点,终点的值
        var start = document.getElementById('start').value;  
        var end = document.getElementById('end').value;  
        //console.log("目的地: " + end);
	    var walking = new BMap.WalkingRoute(map, 
            {renderOptions:{map: map, panel: "r-result", autoViewport: true},
            onSearchComplete: searchWalkComplete});
	    walking.search(start, end);
    });

        var searchWalkComplete = function (results){
            var start = document.getElementById('start').value;  
            var end = document.getElementById('end').value; 
            var output = "从<b>"+ start +"</b>到<b>"+ end +"</b>步行需要 <b>";
            var plan = results.getPlan(0);
            output += plan.getDuration(true) + "</b>,\n";                //获取时间
            output += "总路程为：<b>" ;
            output += plan.getDistance(true) + "</b>\n";             //获取距离
            console.log(output);
            $("#message").show().html(output);
	    }


</script>

@endsection