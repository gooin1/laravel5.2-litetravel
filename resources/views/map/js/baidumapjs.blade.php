<script type="text/javascript">  
function initialize() {  
  var mp = new BMap.Map('map');  
  mp.centerAndZoom(new BMap.Point(121.491, 31.233), 11);  
}  
   
function loadScript() {  
  var script = document.createElement("script");  
  script.src = "http://api.map.baidu.com/api?v=2.0&ak=OjDVDaIyfqZGehQG2moe8nb9xvgoBWPp&callback=initialize";//此为v2.0版本的引用方式    
  document.body.appendChild(script);  
}  
   
window.onload = loadScript;  
</script>