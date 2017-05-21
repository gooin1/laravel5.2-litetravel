@extends('layouts.app')

@section('content')
<html> 
 
<head> 
 
<title>在HTML中传递和引用JavaScript变量</title> 
 
<script type="text/javascript"> 
 
  var foobar; //全局变量声明 
  
  function passvar(){ 
    foobar = document.getElementById('textfield').value; 
    //document.write('传递变量成功'); 
    alert('传递变量成功!'); 
 } 
  
 //显示变量 
 function displayvar(){ 
   alert('变量值为:'+foobar); 
 } 
  
 //引用变量 
 function varpass(){ 
    document.getElementById('textdispaly').value = foobar;  
    //foobar = document.getElementById('textdispaly').value ; 
 } 
</script> 
 
</head> 

<center> 
<h1>在HTML中传递JavasScript变量</h1><hr><br> 
<h5>单击相应按钮...</h5> 
 <form name="form1" method="post" action=""> 
  <p> 
  <label> 
   <input type="text" name="textfield" id="textfield"> 
  </label> 
  <label> 
  <!--绑定 onclick事件 --> 
  <input type="button" name="button1" value="传递变量" onclick="void passvar();"< /span> 
  </label> 
  <label> 
   <!--绑定 onclick事件 --> 
  <input type="button" name="button2" value="显示变量" onclick="void displayvar();"< /span>> 
   
  </label> 
 </p> 
 <p> 
  <label> 
   <input type="text" name="display" id="textdispaly"> 
  </label> 
  <label> 
   <!--绑定 onclick事件 --> 
   <input type="button" name="button3" value="引用输入变量" onclick="void varpass();"< /span>> 
  </label> 
  </p> 
 </form> 
 
</center> 
 
</body> 
 
</html>
@endsection
