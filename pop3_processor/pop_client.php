<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>AJAX-BASED POP3 CLIENT</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script language="javascript">
var index=0;
function sendHttpRequest(url,callbackFunc,respXml){
    var xmlobj=null;
    try{
        xmlobj=new XMLHttpRequest();
    }
    catch(e){
        try{
            xmlobj=new ActiveXObject("Microsoft.XMLHTTP");
        }
        catch(e){
            alert('AJAX isn\'t supported by your browser!');
            return false;
        }
   }
   xmlobj.onreadystatechange=function(){
        if(xmlobj.readyState==4){
            if(xmlobj.status==200){
                respXml?eval(callbackFunc+'(xmlobj.responseXML)'):eval(callbackFunc+'(xmlobj.responseText)');
            }
        }
   }
   // open socket connection
   xmlobj.open('POST',url,true);
   // send http header
   xmlobj.setRequestHeader('Content-Type','application/x-www-form-urlencoded; charset=UTF-8');
   // get form values and send http request
   xmlobj.send(getFormValues(document.getElementsByTagName('form')[0]));
}
// get form values
function getFormValues(fobj){
    var str='';
    for(var i=0;i< fobj.elements.length;i++){
        str+=fobj.elements[i].name+'='+ escape(fobj.elements[i].value)+'&';
    }
    str=str.substr(0,(str.length-1));
    return str;
}
// fetch messages from POP3 server
function fetchMessages(messages){
    // build messages array
    var messages=messages.split('||||');
    var mdiv=document.getElementById('mailcontainer');
	if(!mdiv){return};
	// display mail server response
    mdiv.innerHTML=messages[0];
	// get 'previous' button
    var prev=document.getElementsByTagName('form')[1].elements['prev'];
	if(!prev){return};
	// get 'next' button
	var next=document.getElementsByTagName('form')[1].elements['next'];
	if(!next){return};
	// get 'clear' button
	var clear=document.getElementsByTagName('form')[1].elements['clear'];
	if(!clear){return};
	// move messages pointer back
	prev.onclick=function(){
		index--;
		if(index<0){index=0};
		mdiv.innerHTML=messages[index];
	}
	// move messages pointer forward
	next.onclick=function(){
		index++;
		if(index==messages.length){index=messages.length-1};
		mdiv.innerHTML=messages[index];
	}
	// clear mail container
	clear.onclick=function(){mdiv.innerHTML=''};
}
// initialize user panel
function initializeUserPanel(){
    // get 'connect' button
    var sendbtn=document.getElementsByTagName('form')[0].elements['connect'];
	// send http request when button is clicked on
	sendbtn.onclick=function(){
        // send request & fetch messages from POP3 server
        sendHttpRequest('http://localhost/pop_processor.php','fetchMessages');
        // display 'Retrieving...' message
        var mdiv=document.getElementById('mailcontainer');
        if(!mdiv){return};
        mdiv.innerHTML='Retrieving messages from the server...';
    }
}
// initialize user panel when page is loaded
window.onload=function(){
    // check if broswer is DOM compatible
    if(document.createElement&&document.getElementById&&document.getElementsByTagName){
		// initialize user panel
		initializeUserPanel();
    }
}
</script>
<style type="text/css">
body {
	margin: 10px 0 0 0;
}
#userinfo {
	width: 700px;
	height: 22px;
	padding: 2px 5px 2px 5px;
	border-top: 2px solid #000;
	border-left: 2px solid #000;
	border-right: 2px solid #000;
	background: #9cf;
	margin-left: auto;
	margin-right: auto;
	font: bold 11px Verdana, Arial, Helvetica, sans-serif;
	color: #000;
}
#mailcontainer {
	width: 700px;
	height: 520px;
	padding: 2px 5px 2px 5px;
	border: 2px solid #000;
	background: #eee;
	margin-left: auto;
	margin-right: auto;
	font: 12px normal Arial, Helvetica, sans-serif;
	color: #000;
	overflow: auto;
}
#navbar {
	width: 700px;
	height: 22px;
	padding: 2px 5px 2px 5px;
	border-left: 2px solid #000;
	border-right: 2px solid #000;
	border-bottom: 2px solid #000;
	background: #9cf;
	margin-left: auto;
	margin-right: auto;
}
form {
	display: inline;
}
.inputbox {
	width: 150px;
	border: 1px solid #000;
	background: #eee;
}
.formbutton {
	width: 70px;
	height: 20px;
	font: bold 11px Verdana, Arial, Helvetica, sans-serif;
	color: #000;
}
</style>
</head>
<body>
<div id="userinfo">
<form>
HOST <input name="host" type="text" class="inputbox" title="Enter mail hostname" />
USER <input name="user" type="text" class="inputbox" title="Enter username" />
PASSWORD <input name="pass" type="password" class="inputbox" title="Enter password" />
<input name="connect" type="button" value="Connect" class="formbutton" />
</form>
</div>
<div id="mailcontainer">
</div>
<div id="navbar">
<form>
<input name="prev" type="button" value="&lt;&lt Prev" class="formbutton" title="Previous message" />
<input name="next" type="button" value="Next &gt;&gt;" class="formbutton" title="Next message" />
<input name="clear" type="button" value="Clear" class="formbutton" title="Clear all messages" />
</form>
</div>
</body>
</html>