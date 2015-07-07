<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<link rel="stylesheet" href="style/indexCss.css" type="text/css">
</head>
<body>
	<div class="result">
	<?php
		$csb=$_REQUEST['csb'];  
		if($csb>=0.75){
			echo "恭喜您完成正式实验！</br>您的正确率为".round($csb*100)."%,此次报酬会在3-5个工作日后发放到您的支付宝账户！";
		}else{
			echo "对不起！您的正确率为".round($csb*100)."%,由于您的正确率过低，不能达到我们的要求，所以此次实验无效！</br>若您希望重新完成本实验，请于至少24小时之后再次进行实验！"; 
		}
	?>
	</div>
	<div class="thank">感谢您的参与，祝您生活愉快！</div>
</body>
</html>