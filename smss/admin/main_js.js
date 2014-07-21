function callfrm(dest)
	{
		frm1.target = "_self"
		frm1.action = dest
		frm1.method = "POST"
		frm1.submit()
	}	
	
function integerOnly() {
	//เอาเหตุการนี้ไปใช้onKeyPress='intergerOnly()'
	//alert(event.keyCode);
	if ((event.keyCode>=96)&&(event.keyCode<=105))		
		return;
	if ((event.keyCode>=48)&&(event.keyCode<=57))	
		return;
	if (event.keyCode==8 || event.keyCode==9)
		return;
	if ((event.keyCode==37)||(event.keyCode==39)||(event.keyCode==46))
		return;
	if(event.keyCode==13)
		return;
	event.returnValue=false;	
	alert("อนุญาตให้พิมพ์เฉพาะจำนวนเต็มเท่านั้น");
}
	
function digitOnly() {
	//เอาเหตุการนี้ไปใช้onKeyPress='digitOnly()'
	//alert(event.keyCode);
	if ((event.keyCode>=96)&&(event.keyCode<=105))		
		return;
	if (event.keyCode==190)
		return;	
	if ((event.keyCode>=48)&&(event.keyCode<=57))	
		return;
	if (event.keyCode==8 || event.keyCode==9)
		return;
	if ((event.keyCode==37)||(event.keyCode==39)||(event.keyCode==46))
		return;
	if(event.keyCode==13)
		return;
	event.returnValue=false;	
	alert("อนุญาตให้พิมพ์เฉพาะตัวเลขและจุดทศนิยมเท่านั้น");
}

function checkbrowser() {
	var mybrowser=navigator.userAgent;
	if(mybrowser.indexOf('MSIE')>0){
		alert("IE");
	}
	if(mybrowser.indexOf('Firefox')>0){
		alert("Firefox");
	}	
	if(mybrowser.indexOf('Presto')>0){
		alert("Opera");
	}			
	if(mybrowser.indexOf('Chrome')>0){
		alert("Chrome");
	}		
}
