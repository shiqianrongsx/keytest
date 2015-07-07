<?php
      error_reporting(0);
      session_start();
      require_once 'db.php';
if(isset($_REQUEST['result1']))
{
	$formid = 2;
    for($i=1; $i<=5; $i++)
	{
		$iname = 'result'.$i;
		$query = "INSERT ".$_SESSION['studentname']." (formid, questionid, answer) value('".$formid."','".$i."','".htmlspecialchars($_REQUEST[$iname],ENT_QUOTES)."');";
		if(!executeQuery($query))
		{
		$error = true;		
		$_GLOBALS['message']="实验数据没有存储成功". mysql_error();
		break;
		}
	}
	closedb();
	if(!$error)
	{
		header('Location:finish.php?csb='.$_REQUEST['result4']);
	}
	end:
		unset($_REQUEST['result']);
		echo $_GLOBALS['message'];
}
?>
<html>
  <head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8"/>
    <title>按键测试</title> 
  </head>
  <body bgcolor="#000000">
    <table height="100%"  width="100%">
	  <tr>
	    <td align="center" valign="middle" style="font-family:'宋体'"><font color="#FFFFFF" size="+3"  id="ha">实验即将开始，请将该网页全屏！<br/>此过程需要耗费您20分钟左右的时间，请不要离开，认真操作即可！<br/>我们的实验非常简单，但若您不正常操作，而造成实验数据不理想，我们将有权不给予报酬！<br/>按任意键进入实验！</font></td>
	  </tr>
	</table>
	<form action="" method="post">
		<input type="hidden" name="result1" value=" ">
		<input type="hidden" name="result2" value=" ">
		<input type="hidden" name="result3" value=" ">
		<!--result4存储正确率-->
		<input type="hidden" name="result4" value=" ">
		<!--result5存储提交时间-->
		<input type="hidden" name="result5" value=" ">
	</form>

<script type="text/javascript">
	var success=0;
	var lable = document.getElementById("ha");//定义lable
	
	//各数组定义
	var arr1=[2134,4132,4213,1432,2431,4321,3142,4231,1324,2341,2143,3214,4123,2413,1423,1342,3241,1234,3124,1243,4312,3412,3421,2314];//数字组的数组，24个
	
	var arr2=new Array();
	arr2[0]=[3,2,2,4,3,3,4,1,1,1,4,2,4,3,1,1,2,4,3,1,4,3,2,2,3,2,4,1,4,4,4,2,2,3,3,1,1,2,1,3];//单个数字的数组，40个
	arr2[1]=[2,2,1,3,4,3,4,3,1,3,2,1,1,3,2,1,1,3,2,4,2,2,1,4,2,1,1,4,4,4,2,4,3,4,2,3,3,3,4,1];
	arr2[2]=[1,4,1,4,2,1,4,1,4,2,1,4,1,4,1,3,3,1,4,3,2,2,2,3,2,4,2,3,2,3,3,4,2,3,1,3,3,1,4,2];
	arr2[3]=[4,1,2,3,2,1,3,4,3,1,1,2,3,4,2,4,4,3,1,3,2,3,1,2,4,3,4,3,2,1,2,4,2,1,2,4,1,3,4,1];
	var arr3=new Array();var arr3ic01=new Array();var arr3xl=new Array();
	arr3[0]=[22222,44344,11411,33233,44444,33333,22122,11111];//练习试次数组，8个
	arr3ic01[0]=[1,0,0,0,1,1,0,1];//i0.c1
	arr3xl[0]=[3,2,0,0,1,3,2,1];//ii0,ic1,ci2,cc3
	arr3[1]=[11411,22222,44444,44344,11111,33333,33233,22122];
	arr3ic01[1]=[0,1,1,0,1,1,0,0];
	arr3xl[1]=[2,1,3,2,1,3,2,0];
	arr3[2]=[44444,33233,22122,33333,11111,11411,44344,22222];
	arr3ic01[2]=[1,0,0,1,1,0,0,1];
	arr3xl[2]=[3,2,0,1,3,2,0,1];
	arr3[3]=[22122,44444,33333,44344,11111,22222,11411,33233];
	arr3ic01[3]=[0,1,1,0,1,1,0,0];
	arr3xl[3]=[2,1,3,2,1,3,2,0];
	arr3[4]=[33333,11111,22222,11411,22122,44344,44444,33233];
	arr3ic01[4]=[1,1,1,0,0,0,1,0];
	arr3xl[4]=[3,3,3,2,0,0,1,2];
    var timem=[2000,1500,2500,1200,2800,2000,1000,3000];//给定+持续时间，8个
	
    var arr=[22222,11411,33233,11411,33333,11411,33233,44444,33233,11411,33333,11411,22222,44444,22222,11111,44344,11111,33333,22222,11111,33233,11111,33233,44444,22122,44344,11111,44344,22122,44344,22122,44444,22222,33333,22122,44344,22122,33333,44444,22222,44444,33233,11111,44344,11111,33233,11111,22222,44444,22222,11411,33233,11411,33333,22122,44344,22122,44344,22222,33333,11411,33333,22222,11411,33233,11411,33333,11111,44344,22122,44444,22122,44344,22122,33333,44444,11111,33233,44444,11111,44344,22122,44344,22122,33333,22222,11411,33333,22122,44444,33333,11411,33233,11411,33233,11111,44444,22222,11111,33233,44444,33233,11411,22222,11111,44344,22222,44344,22222,11411,33233,44444,11111,44444,33333,22122,44344,22122,33333,33233,11411,33233,11411,22222,44444,33333,11411,22222,33333,11111,22222,44344,22122,44344,11111,44344,11111,33233,11111,44344,22122,44444,22122,33333,22222,44444,33233,11411,33233,11411,33333,22122,44344,11111,44444,22122,44444,22222,33333];//给定试次数组，160个
	var arric01=[1,0,0,0,1,0,0,1,0,0,1,0,1,1,1,1,0,1,1,1,1,0,1,0,1,0,0,1,0,0,0,0,1,1,1,0,0,0,1,1,1,1,0,1,0,1,0,1,1,1,1,0,0,0,1,0,0,0,0,1,1,0,1,1,0,0,0,1,1,0,0,1,0,0,0,1,1,1,0,1,1,0,0,0,0,1,1,0,1,0,1,1,0,0,0,0,1,1,1,1,0,1,0,0,1,1,0,1,0,1,0,0,1,1,1,1,0,0,0,1,0,0,0,0,1,1,1,0,1,1,1,1,0,0,0,1,0,1,0,1,0,0,1,0,1,1,1,0,0,0,0,1,0,0,1,1,0,1,1,1];
	var arrxl=[3,2,0,0,1,2,0,1,2,0,1,2,1,3,3,3,2,1,3,3,3,2,1,2,1,2,0,1,2,0,0,0,1,3,3,2,0,0,1,3,3,3,2,1,2,1,2,1,3,3,3,2,0,0,1,2,0,0,0,1,3,2,1,3,2,0,0,1,3,2,0,1,2,0,0,1,3,3,2,1,3,2,0,0,0,1,3,2,1,2,1,3,2,0,0,0,1,3,3,3,2,1,2,0,1,3,2,1,2,1,2,0,1,3,3,3,2,0,0,1,2,0,0,0,1,3,3,2,1,3,3,3,2,0,0,1,2,1,2,1,2,0,1,2,1,3,3,2,0,0,0,1,2,0,1,3,2,1,3,3];
	var time=[2800,1200,2500,2000,1400,2000,1300,1100,2000,3000,1200,3000,2600,3000,2900,2100,3000,1500,2000,2000,2000,1600,2400,1500,1900,2400,1400,2100,1800,2600,1300,2300,1600,1700,2000,2200,1600,1000,2600,1400,2600,2500,1600,1300,3000,2600,2000,1700,1500,2200,1200,2400,1400,2800,2200,1000,2700,1200,1400,1700,1400,2400,1200,2700,2400,1600,2500,2700,1500,2100,1000,2500,3000,3000,2300,1800,1000,1700,2400,1800,2000,1100,2400,1100,2600,2300,1800,1300,2300,2700,1200,2500,1400,2400,2300,1400,2100,1900,2200,1300,2600,1600,1100,2200,1500,2400,2900,2500,2100,2800,2500,2000,2200,2800,1000,1200,1200,1900,2700,2500,2200,1600,1000,3000,1400,2500,2600,2200,1300,1300,1700,2400,1000,1300,3000,3000,1700,1600,2200,2000,2100,2900,2300,2600,1500,1300,2700,1100,1200,1600,2100,1900,2900,3000,2200,2700,2700,1100,1400,1700];//给定+持续时间，160个
	var size3="+3";var size4="+3";
	//练习
	//1.数组练习
	  //初始定义
	var s1x=0;	
	var strings = ["欢迎您进入实验部分！</br>按任意键开始！","第一部分：实验练习！</br>按任意键继续！","step1：指法练习</br>当屏幕出现数组时，从左到右依次按下数字对应字母</br>（Z--1、X--2、N--3、M--4），要求又快又准！</br>按任意键开始！","恭喜您完成数组按键练习！</br>按任意键继续！","恭喜你！回答正确！</br>加油，可以更好哒~~","亲~~~不许乱按键啊！重新练习这个！"];
	  //
	  document.onkeydown = function()//按键后，空白1秒后进入数组练习
	  {lable.innerHTML = strings[s1x];s1x+=1;if(s1x>2) document.onkeydown = function(){document.onkeydown = function(){};s1x = 0; lable.innerHTML = ""; setTimeout(step3,1000)};}
	  
	  var step3 = function()//首先显示数组，直到按完四个键
	  {if(s1x == arr1.length){setTimeout(final,1000); return;}    window.keey = arr1[s1x].toString();window.userKey ="";lable.innerHTML=keey;document.onkeydown = keyDown;}

	  var final= function()//练习完成后，1秒后显示实验完成，
	  {lable.innerHTML = strings[3];document.onkeydown =step4;}
	
	  var keyDown = function()//当完成4次按键后，判断正误，正确的话，指针加一，提示1100毫秒后，空白500毫秒进行下一次数组练习；错误的话，提示1400毫秒后，重新这组练习
	  {k=keyvalue();userKey+=k.toString();
	   if(userKey.length == 4){document.onkeydown = function(){};
	          if(userKey == keey){lable.innerHTML=strings[4];s1x++;setTimeout(hehe,1100);}else{lable.innerHTML=strings[5];setTimeout(hehe,1400);}
	          function hehe(){lable.innerHTML = "";setTimeout(step3,500);}
                              }
      }
	//2.数字练习
	  //初始定义
	var s2x;
	var shuzitime=-1;
	var shuzitimes=0;
	var arr2keydown=new Array();//记录真实按键数组
	var rtd=new Array();//反应时数组
	var rightd=new Array();//正确错误数组，0正确，1错误
	  //
	  var step4=function()//反应时与正误初始定义【1200,0】，按键后，延迟1秒空白后进入数字练习
      {s2x=-1;shuzitimes+=1;shuzitime+=1;if(shuzitime==4){shuzitime=0;}    for(md=0;md<arr2[0].length;md++){rtd[md]=1200;rightd[md]=0;arr2keydown[md]=0;}  
	   document.getElementById("ha").innerHTML="step2：指法练习</br>当屏幕出现数字时，按下数字对应字母</br>（Z--1、X--2、N--3、M--4），要求又快又准！</br>按任意键开始！";
	   document.onkeydown=function(){document.onkeydown = function(){};document.getElementById("ha").innerHTML="";setTimeout("s2a()",1000);}
      }
	  
      function s2a()//每次数字出现，同时获取此时时间，400毫秒后消失成“+”。最后，1秒后判断。
	  {s2x+=1;td=0;
	   if(s2x<arr2[0].length){document.getElementById("ha").innerHTML=arr2[shuzitime][s2x]; window.startTimed=(new Date).getTime();document.onkeydown=one;setTimeout("s2c()",400);}
	   else{setTimeout("s2b()",1000);}
	  }	 
	  
	  function s2c()//800毫秒的“+”，下一次数字练习
	  {var sss="+";var html=sss.fontsize(size3).fontcolor("red").bold();document.getElementById("ha").innerHTML=html;document.onkeydown=one;setTimeout("s2a()",800); }
	  
	  function one()//按键记录正误与反应时间
	  {  document.onkeydown=function(){};
	     if(rtd[x]==0)
	     {var stopTimed = (new Date).getTime();
		 var timedelyd = stopTimed - startTimed; 
		 arr2keydown[s2x]=keyvalue();
		 if(keyvalue()==arr2[shuzitime][s2x]){ rightd[s2x]=1;}else{ rightd[s2x]=2;}  //需返回的01数组
		 rtd[s2x]=timedelyd;//需返回的反应时数组
		 }
	   }
		 
	    function s2b()//判断正确率和平均反应速度	
	  { var arry=0;var rtds=0;
	    for(var s2y=0;s2y<arr2[0].length;s2y++){if(rightd[s2y]==1){arry+=1;}rtds+=rtd[s2y];}
		var arrs=(arry/arr2[0].length);
		var rtdss=(rtds/arr2[0].length);
		if(arrs>=0.90){if(rtdss<=800){document.getElementById("ha").innerHTML="恭喜您完成数字按键练习！</br>按任意键继续！";document.onkeydown=step5;}
		               else{document.getElementById("ha").innerHTML="对不起！您的准确率已达要求，但是反应速度未达要求，请重新完成该组练习！</br>按任意键重新开始step2！";document.onkeydown=step4;}}
		else{if(rtdss<=800){document.getElementById("ha").innerHTML="对不起！您的反应速度已达要求，但是准确率未达要求，请重新完成该组练习！</br>按任意键重新开始step2！";document.onkeydown=step4;}
	         else{document.getElementById("ha").innerHTML="对不起！您的反应速度以及准确率都未达要求，请重新完成该组练习！</br>按任意键重新开始step2！";document.onkeydown=step4;}}
	  }	
	  
  // 3.正式实验练习
    //初始定义
	var xx;//指针
	var lianxitime=-1;
	var lianxitimes=0;
	var arr3keydown=new Array();
	var arr3real=new Array();
	var tim=new Array();//反应时大数组
	var rtm=new Array();//反应时数组
	var tfm=new Array(); //正确错误大数组
	var rightm=new Array();//正确错误数组，0正确，1错误
	//
		 var step5=function()
        {xx=-1;lianxitimes+=1;lianxitime+=1;if(lianxitime==5){lianxitime=0;}
         for(mm=0;mm<arr3[0].length;mm++){rtm[mm]=0;rightm[mm]=0;arr3keydown[mm]=0;} 
         document.getElementById("ha").innerHTML="step3：正式实验练习</br>当屏幕出现五个字母时，按下中间数字对应的字母</br>（Z--1、X--2、N--3、M--4），要求又快又准！</br>按任意键开始！";
	     document.onkeydown=function(){document.onkeydown = function(){};document.getElementById("ha").innerHTML="";setTimeout("b0()",1000);}
        }

	    function b0()//开始时5秒持续的“+”
		{var sss="+"; var html=sss.fontsize(size3).fontcolor("red").bold();document.getElementById("ha").innerHTML=html; 
		 setTimeout("b1()",5000);
		}
		
	    function b1()//判断实验是否结束，未结束则250ms的“11 11”，进入a2（）；实验进行结束则5秒持续+
	    { xx += 1;if(xx< arr3[0].length){var number = new Number(arr3[lianxitime][xx]);var str=number.toString();var a=str.charAt(0);aam=str.charAt(2);arr3real[xx]=aam;
		                                 document.getElementById("ha").innerHTML=a+a+" "+a+a;setTimeout("b2()",250);
		                                 }
		         else{var sss="+";var html=sss.fontsize(size3).fontcolor("red").bold();document.getElementById("ha").innerHTML=html;setTimeout("b5()",5000);} 
	    }
		
		function b2()//持续400ms的“11211”，且若有反应按键，则记录下第一次按键的反应时和正确错误
		{  document.getElementById("ha").innerHTML=arr3[lianxitime][xx];window.startTimem=(new Date).getTime();document.onkeydown=bb;setTimeout("b3()",400);}
		   
		 function b3() //持续800ms空白，若有反应按键，则记录下第一次按键的反应时和正确错误
		{  document.getElementById("ha").innerHTML="";document.onkeydown=bb;setTimeout("b4()",850);	} 
		
		function b4()//持续time数组对应的反应时的“+”
		{var sss="+";var html=sss.fontsize(size3).fontcolor("red").bold();document.getElementById("ha").innerHTML=html;setTimeout("b1()",timem[xx]);}
		
		function b5()//判断
		{var cs=0; for(var cishu=0;cishu<rightm.length;cishu++){if(rightm[cishu]==1)cs+=1;}
		 var csb=(cs/rightm.length);
		 if(csb>=0.8){document.getElementById("ha").innerHTML="恭喜您完成正式实验按键练习！</br>按任意键开始正式实验！";document.onkeydown=step6;}
         else{document.getElementById("ha").innerHTML="对不起！未达要求，请重新完成该组练习！</br>按任意键重新开始step3！";document.onkeydown=step5;}
	    }	
		
		function bb()//可以记录该试次内每次按键的反应时和正确错误，并取第一次按键的反应时和正确错误，记录在rt数组和tf数组
	    {document.onkeydown = function(){};
		if(rtm[x]==0)
		{ var stopTime = (new Date).getTime();var timedely = stopTime - startTimem;arr3keydown[xx]=keyvalue();
	     if(keyvalue()==aam){rightm[xx]=1;}else{rightm[xx]=2;}  
		 rtm[xx]=timedely;}
	    }

  //正式实验部分
    //初始定义
  	var x = -1;//指针
	var arrreal=new Array();
	var arrkeydown=new Array();
	var rt=new Array();//反应时数组
	var right=new Array();//正确错误数组，0正确，1错误
	for(m=0;m<arr.length;m++){rt[m]=0;right[m]=0;arrkeydown[m]=0;}  
    //
    var step6=function()//1s空白后开始实验
   {document.getElementById("ha").innerHTML="第二部分：正式实验</br>当屏幕出现五个字母时，按下中间数字对应的字母</br>（Z--1、X--2、N--3、M--4），要求又快又准！</br>按任意键开始！";
	document.onkeydown=function()
     {document.onkeydown = function(){};document.getElementById("ha").innerHTML="";setTimeout("a00()",1000);}
   }


    function a00()//开始时5秒持续的“+”
	{var sss="+";var html=sss.fontsize(size3).fontcolor("red").bold();
	 document.getElementById("ha").innerHTML=html;setTimeout("a1()",5000);
	}

	function a0()//开始时5秒持续的“+”
	{var sss="+";var html=sss.fontsize(size3).fontcolor("red").bold();
	 document.getElementById("ha").innerHTML=html;setTimeout("a11()",5000);
	}
		
	function a1()//判断实验完成四分之一，二分之一，四分之三，若是则停留十秒后开始五秒的“+”
	{ x += 1;
	  if(x==40){document.getElementById("ha").innerHTML="该实验部分已经完成四分之一，休息十秒哈！";setTimeout("a0()",10000);}
	  else{
	   if(x==80){document.getElementById("ha").innerHTML="该实验部分已经完成二分之一休息十秒哈！";setTimeout("a0()",10000);}
	   else{if(x==120){document.getElementById("ha").innerHTML="该实验已经部分完成四分之三，休息十秒哈！";
	                   setTimeout("a0()",10000);}
		    else{setTimeout("a11()",0);}
	       }
	      }
	}
		
    function a11()//未完成则出现250毫秒的11 11，否则持续五秒“+”后结束
    {if(x< arr.length){var number = new Number(arr[x]);var str=number.toString();var a=str.charAt(0);aa=str.charAt(2);arrreal[x]=aa;
     document.getElementById("ha").innerHTML=a+a+" "+a+a;setTimeout("a2()",250);}
     else{var sss="+";var html=sss.fontsize(size3).fontcolor("red").bold();
		 document.getElementById("ha").innerHTML=html;setTimeout("a55()",5000);
	     } 
	 } 
		
	function a55()//空白1s后结束
{document.onkeydown=function(){};document.getElementById("ha").innerHTML="正式实验部分结束啦！";setTimeout("a5()",1000);}
		
	function a2()//持续400ms的“11211”，且若有反应按键，则记录下第一次按键的反应时和正确错误
	{document.getElementById("ha").innerHTML=arr[x];window.startTime=(new Date).getTime();
	 document.onkeydown=b;setTimeout("a3()",400);
    }
		   
	function a3() //持续800ms空白，若有反应按键，则记录下第一次按键的反应时和正确错误
	{document.getElementById("ha").innerHTML="";document.onkeydown=b;setTimeout("a4()",850);} 
		
	function a4()//持续time数组对应的反应时的“+”
	{document.onkeydown=function(){};
	 var sss="+";var html=sss.fontsize(size3).fontcolor("red").bold();document.getElementById("ha").innerHTML=html; 
	 setTimeout("a1()",time[x]);
	}
	
	

	
		
	function a5()//完成
	{ 
	
		 var cs=0; for(var cishu=0;cishu<right.length;cishu++){if(right[cishu]==1)cs+=1;}
		 var csb=(cs/right.length);
		 if(csb>=0.75){document.getElementById("ha").innerHTML="恭喜您完成正式实验！</br>您的正确率为"+Math.round(csb*100)+"%,此次报酬会在3-5个工作日后发放到您的支付宝账户！";success=1;}
         else{document.getElementById("ha").innerHTML="对不起！您的正确率为"+Math.round(csb*100)+"%,由于您的正确率过低，不能达到我们的要求，所以此次实验无效！</br>若您希望重新完成本实验，请于至少24小时之后再次进行实验！";success=2;}  

	
	
	
	  var srr3="";//Target,IC01,Sequenceii0.ic1.ci2,cc3,Targetcenter,Targetresponse0空,1234,5其他,Rightor0空,1对2错,RT;
	  for(m=0;m<arr.length;m++){var num= new Number(rt[m]);var numn= new Number(right[m]);srr3=srr3+arr[m]+","+arric01[m]+","+arrxl[m]+","+arrreal[m]+","+arrkeydown[m]+","+numn.toString()+","+num.toString()+","+success+";"}
		  
	  var srr1="";//sTarget,sTargetresponse,sRightor,sRT,stimes;
	  for(m=0;m<arr2[0].length;m++){var num= new Number(rtd[m]);var numn= new Number(rightd[m]);srr1=srr1+arr2[shuzitime][m]+","+arr2keydown[m]+","+numn.toString()+","+num.toString()+","+shuzitimes+";"}

	  var srr2="";//lTarget,lIC,lSequence,lTargetcenter,lTargetresponse,lRightor,lRT,ltimes;
		  for(m=0;m<rtm.length;m++){var num= new Number(rtm[m]);var numn= new Number(rightm[m]);srr2=srr2+arr3[lianxitime][m]+","+arr3ic01[lianxitime][m]+","+arr3xl[lianxitime][m]+","+arr3real[m]+","+arr3keydown[m]+","+numn.toString()+","+num.toString()+","+lianxitimes+";"}
		  document.getElementById("ha").innerHTML="恭喜您顺利完成实验<br/><span style=\"color:red;\">请按任意键提交实验结果,否则您的实验数据将会丢失</span>"; //此处返回数据
		  document.onkeydown=function()
		  {document.onkeydown = function(){};
		  var subTime=new Date();
		  var subYear=subTime.getFullYear();
		  var subMonth=subTime.getMonth();
		  var subDate=subTime.getDate();
		  var subHour=subTime.getHours();
		  var subMinute=subTime.getMinutes();
		  var subTimeNew=subYear+"/"+(subMonth+1)+"/"+subDate+"--"+subHour+":"+subMinute;
		  //document.getElementById("ha").innerHTML="单数字练习：</br>"+srr1+"</br>正式实验练习：</br>"+srr2+"</br>正式实验：</br>"+srr3;
			formElement1=document.forms[0];
		   formElement1.elements[0].value=srr1;
		   formElement1.elements[1].value=srr2;
		   formElement1.elements[2].value=srr3;		  
		   formElement1.elements[3].value=csb;
		   formElement1.elements[4].value=subTimeNew;
		   formElement1.submit();

		  }
      }

	function b()//可以记录该试次内每次按键的反应时和正确错误，并取第一次按键的反应时和正确错误，记录在rt数组和tf数组
    { document.onkeydown = function(){};
	  if(rt[x]==0)
	    { var stopTime = (new Date).getTime();var timedely = stopTime - startTime;arrkeydown[x]=keyvalue();
		 if(keyvalue()==aa){right[x]=1;}else{right[x]=2;}   rt[x]=timedely;}
    }

    function keyvalue()
	{var keycode;if(event.keyCode){keycode=event.keyCode;}else {keycode=event.which;}
	 key= String.fromCharCode(keycode); 
	 switch(key){case"Z":key=1;break;case"X":key=2;break;case"N":key=3;break;case"M":key=4;break;default:key=5;break;}
	 return(key);
     }  
</script>	
  </body>
</html>
