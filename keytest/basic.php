<?php
      error_reporting(0);
      session_start();
      require_once 'db.php';
	  $formid = 1;
	  if($_REQUEST['submitForm']){
		  	$error=false;
			$_SESSION['studentname'] ="keyTest2".htmlspecialchars($_REQUEST['info4'],ENT_QUOTES);
			$result=executeQuery("select name from keyTest1 where name ='".$_SESSION['studentname']."';");
			$r=mysql_fetch_array($result);
			if(is_null($r['name'])){
				$query="insert keyTest1 (name) value('".$_SESSION['studentname']."');";
				if(!executeQuery($query))
				{
				$error=true;
				$_GLOBALS['message']="Can't access database1.".' Because '. mysql_error();
				goto end;
				}
				$query="CREATE TABLE ".$_SESSION['studentname']."(like test);";
				if(!executeQuery($query))
				{
				$error=true;
				$_GLOBALS['message']="Can't create table.".' Because '. mysql_error();
				goto end;
				}
				for($i=1; $i<=6; $i++)
				{
					$query = "INSERT ".$_SESSION['studentname']." (formid, questionid, answer) value('".$formid."','".$i."','null');";
					if(!executeQuery($query))
					{	
					$error=true;
					$_GLOBALS['message']="Your previous answer is not updated.Please answer once again1.".' Because '.mysql_error();
					break;
					}
				}				
			}			 			
			for($i=1; $i<=6; $i++)
			{
				$iname = 'info'.$i;
				$query="update ".$_SESSION['studentname']." set answer='".htmlspecialchars($_REQUEST[$iname],ENT_QUOTES)."' where formid=1 and questionid=".$i.";";
				if(!executeQuery($query))
				{	
				$error=true;
				$_GLOBALS['message']="Your previous answer is not updated.Please answer once again2.".' Because '.mysql_error();
				break;
				}
			}
			closedb();
			if(!$error){
				header('Location:exercise.php');
			}
			end:
					unset($_REQUEST['submitform']);		
					echo '<font style="color:white;">'.$_GLOBALS['message'].'</font>';	
		}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>基本信息</title>
<link rel="stylesheet" href="style/indexCss.css" type="text/css">
<script src="scripts/jquery-1.11.2.js"></script>
<script src="scripts/utils.js"></script>
<script src="scripts/validate.js"></script>
</head>
<body>
<form action="" method="post" onSubmit="return fieldIsFull();">
<table>
<caption>请先填写基本信息</caption>
<tr>
<td class="left">姓  名：</td>
<td><input type="text" name="info1" id="name"></td>
</tr>
<tr>
<td class="left">性 别：</td>
<td><input type="radio" value="男" name="info2" id="man"><label for="man" class="sexLabel">男</label><input type="radio" value="女" name="info2" id="woman"><label for="woman" class="sexLabel">女</label></td>
</tr>
<tr>
<td class="left">年 龄：</td>
<td>
<select name="info3" id="age">
	<option value="--">--</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
	<option value="13">13</option>
	<option value="14">14</option>
	<option value="15">15</option>
	<option value="16">16</option>
	<option value="17">17</option>
	<option value="18">18</option>
	<option value="19">19</option>
	<option value="20">20</option>
	<option value="21">21</option>
	<option value="22">22</option>
	<option value="23">23</option>
	<option value="24">24</option>
	<option value="25">25</option>
	<option value="26">26</option>
	<option value="27">27</option>
	<option value="28">28</option>
	<option value="29">29</option>
	<option value="30">30</option>
	<option value="31">31</option>
	<option value="32">32</option>
	<option value="33">33</option>
	<option value="34">34</option>
	<option value="35">35</option>
	<option value="36">36</option>
	<option value="37">37</option>
	<option value="38">38</option>
	<option value="39">39</option>
	<option value="40">40</option>
</select><span id="ageSpan">（周岁）</span>
</td>
</tr>
<tr>
<td class="left">手 机：</td>
<td><input type="text" name="info4" maxLength="11" id="phone"></td>
</tr>
<tr>
<td class="left">邮 箱：</td>
<td><input type="text" name="info5" id="email"></td>
</tr>
<tr>
<td class="left">支付宝：</td>
<td><input type="text" name="info6" id="alipay"></td>
</tr>
<tr>
<td colspan="2" class="submit"><input type="submit" value="下一页" name="submitForm" id="submitBtn" ></td>
</tr>
</table>
</form>
</body>
</html>