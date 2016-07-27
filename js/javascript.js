function scroll(){
		var objDiv = document.getElementById("chat");
		objDiv.scrollTop = objDiv.scrollHeight;
}
window.onload = function request(){
	setInterval(function requestDB(){
		var xmlhttp;
		if(window.XMLHttpRequest){
			xmlhttp=new XMLHttpRequest();
		}else{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("chat").innerHTML= xmlhttp.responseText;
			}
		}
		xmlhttp.open("POST","../ajax/requestDB.php",true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send("limit="+document.getElementById("limit").value);
	},2000);
}
function sendmessage(){
	var xmlhttp;
	if(window.XMLHttpRequest){
		xmlhttp=new XMLHttpRequest();
	}else{
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("message").value='';
		}
	}
	xmlhttp.open("POST","../ajax/sendmessage.php",true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send("message="+document.getElementById("message").value);
}

/*Show/Hide messages*/
function setlimit(){
	if(document.getElementById('limit_button').innerHTML=='Hiển thi thêm tin nhắn'){
		document.getElementById('limit').value=0;
	}else{
		document.getElementById('limit').value=25;
	}
}

/*TEXT EDITOR*/
	var tagO = ['<b>','<i>','<u>'];
	var tagE = ['</b>','</i>','</u>'];
    function addTag(num) {
		var obj = document.getElementById('message');
		var pos = obj.scrollTop;
        var st = obj.selectionStart;
        var en = obj.selectionEnd;
        var before = obj.value.substring(0,st);
        var after  = obj.value.substring(en,obj.value.length);
        var str = obj.value.substring(st,en);
		var result = before + tagO[num] + str + tagE[num] + after;
		obj.value = result; 
        obj.setSelectionRange(st,(en + tagE[num].length + tagO[num].length));
        obj.focus();
    }
