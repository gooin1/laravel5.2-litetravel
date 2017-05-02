
/*
*   根据 ip 显示经纬度 
*/
  var user_lng;
  var user_lat;
  var apiStaus;
        // 根据浏览器定位移动地图至当前位置
        $.ajax({
            dataType: "json",
            async: false,
            url: "https://api.prprpr.me/location/",
            }).done(function ( data ) {
            // 大致信息
            user_lng = data.result.location.lng;
            user_lat = data.result.location.lat; 
            apiStaus = data.status;
        }); 
        if(apiStaus !== 0){
          console.log("定位api挂了");
        }  
         if(apiStaus === 0){
          console.log("定位api ok");
         }    

// json sample
// {
// "status": 0,
// "result": {
// "location": {
// "lng": 103.70361699999994,
// "lat": 36.097875891785215
// },
// "formatted_address": "甘肃省兰州市安宁区街坊路",
// "business": "西津西路",
// "addressComponent": {
// "country": "中国",
// "country_code": 0,
// "province": "甘肃省",
// "city": "兰州市",
// "district": "安宁区",
// "adcode": "620105",
// "street": "街坊路",
// "street_number": "",
// "direction": "",
// "distance": ""
// },
// "pois": [],
// "poiRegions": [
// {
// "direction_desc": "内",
// "name": "甘肃农业大学",
// "tag": "教育培训"
// }
// ],
// "sematic_description": "甘肃农业大学内",
// "cityCode": 36
// }
// }



