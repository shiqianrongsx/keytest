function getActivatedObject(e){
	var obj;
	if(!e){
		// early version of IE
		obj=window.event.srcElement
	}else if(e.srcElement){
		// IE 7 or later
		obj=event.srcElement;
	}else{
		// DOM Level 2 browser
		obj=e.target;
	}
	return obj;
}
function addEventHandler(obj,eventName,handler){
	if(document.addEventListener){
		obj.addEventListener(eventName,handler,false);
	}else if(document.attachEvent){
		obj.attachEvent("on"+eventName,handler);
	}
}