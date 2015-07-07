window.onload=initPage;
var warnings={
	"name":{
		"required":"您还未填写您的真实姓名",
		"format":"只能输入汉字"
	},
	"phone":{
		"required":"您还未填写您个人的手机号码",
		"format":"您填写的手机号码格式不正确"
	},
	"email":{
		"required":"您还未填写您的个人邮箱",
		"format":"您填写的邮箱格式不正确"
	},
	"alipay":{
		"required":"您还未填写您的支付宝账号"
	}
};
function initPage(){
	addEventHandler(document.getElementById("name"),"blur",fieldIsFilled);
	addEventHandler(document.getElementById("name"),"blur",nameIsProper);
	addEventHandler(document.getElementById("phone"),"blur",fieldIsFilled);
	addEventHandler(document.getElementById("phone"),"blur",phoneIsProper);
	addEventHandler(document.getElementById("email"),"blur",fieldIsFilled);
	addEventHandler(document.getElementById("email"),"blur",emailIsProper);
	addEventHandler(document.getElementById("alipay"),"blur",fieldIsFilled);
	//addEventHandler(document.getElementById("submitBtn"),"click",fieldIsFull);
}
//验证每个输入是否填写
function fieldIsFilled(e){
	var me=getActivatedObject(e);
	if(me.value==""){
		warn(me,"required");
	}else{
		unwarn(me,"required");
	}
}
//验证姓名格式是否正确
/*
验证规则：只能输入汉字
*/
function nameIsProper(e){
	var me=getActivatedObject(e);
	var nameRegExp=/[^\u4E00-\u9FA5]/;
	if((nameRegExp.test(me.value))&&(me.value!="")){
		warn(me,"format");
	}else{
		unwarn(me,"format");
	}
}
//验证手机格式是否正确
/*
验证规则：以1开头，共11位数字
*/
function phoneIsProper(e){
	var me=getActivatedObject(e);
	var phoneRegExp=/^1+\d{10}$/;
	if((!phoneRegExp.test(me.value))&&(me.value!="")){
		warn(me,"format");
	}else{
		unwarn(me,"format");
	}
}
//验证邮箱格式是否正确
/*
验证规则：姑且把邮箱地址分成“第一部分@第二部分”这样
第一部分：由字母、数字、下划线、短线“-”、点号“.”组成，
第二部分：为一个域名，域名由字母、数字、短线“-”、域名后缀组成，
而域名后缀一般为.xxx或.xxx.xx，一区的域名后缀一般为2-4位，如cn,com,net，现在域名有的也会大于4位
*/
function emailIsProper(e){
	var me=getActivatedObject(e);
	var emailRegExp=/^(\w-*\.*)+@(\w-?)+(\.\w{2,})$/;
	if((!emailRegExp.test(me.value))&&(me.value!="")){
		warn(me,"format");
	}else{
		unwarn(me,"format");
	}
}
function warn(field,warnType){
	var parentNode=field.parentNode;
	var warning=eval("warnings."+field.id+"."+warnType);
	if(parentNode.getElementsByTagName("p").length==0){
		var p=document.createElement("p");
		p.appendChild(document.createTextNode(warning));
		parentNode.appendChild(p);
	}else{
		var p=parentNode.getElementsByTagName("p")[0];
		p.firstChild.nodeValue=warning;
	}
}
function unwarn(field,warnType){
	var parentNode=field.parentNode;	
	if(parentNode.getElementsByTagName("p").length>0){
		var p=parentNode.getElementsByTagName("p")[0];
		var warning=eval("warnings."+field.id+"."+warnType);
		if(p.firstChild.nodeValue==warning){
			parentNode.removeChild(p);
		}
	}

}
//验证表单是否填写完整
function fieldIsFull(){
	//验证除了单选框和下拉框之外的
	var fieldsets=document.getElementsByTagName("td");
	for(var i=1;i<fieldsets.length;i+=2){
		var fieldWarnings=fieldsets[i].getElementsByTagName("p");
		if(fieldWarnings.length>0){
			alert("请将基本信息填写完整");
			return false;
		}
	}
	//验证下拉框
	var ageField=document.getElementById("age");
	if(ageField.value=="--"){
		alert("请将基本信息填写完整");
		return false;
	}
	//验证单选框
	var radios=document.getElementsByName("info2");
	if(!(radios[0].checked||radios[1].checked)){
		alert("请将基本信息填写完整");
		return false;
	}

	return true;
}


