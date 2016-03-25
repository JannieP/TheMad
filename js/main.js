var xmlHttp
var g_elementid

var v_last = "item_0";
var vn_last = "0";
var next_elm = "titems"

function addItem(p_last)
{
//   alert ('TEST1');
   var v_html = "";
   var v_str1 = "";
   var v_str2 = "";
   var v_len = 0;
   var v_len1 = 0;
   var v_counter = 0;

   v_counter = p_last.substring(5);
   v_str2 = p_last.substr(5);
   v_len = p_last.length;
   v_len1 = v_str2.length;
   v_str1 = p_last.substr(0,(v_len - v_len1));
   v_counter++;
   v_str1 += v_counter;
   v_last = v_str1;
   vn_last = v_counter;

//   v_html =  "<table width='100%' style='border:medium'>";
   v_html =  "";
   
     v_html += "Test1</td>";
     v_html += "</tr>";

//if (next_elm=='titems')
//   {
//     v_html += "&nbsp;</td>";
//     v_html += "</tr>";
//   }

//   v_html += "<tr><td align='right'>"+vn_last+"</td></tr>";

//   v_html += "<tr>";
//   v_html += "<td>";
//   v_html +=    "<input name='textfield' type='text' size='5'></td>";
//   v_html +=    "<td colspan='2'><select name='menu1' style='border:none'>";
//   v_html +=      "<option value=''>&nbsp;</option>";
//   v_html +=      "<option value='Value1'>Option1</option>";
//   v_html +=      "<option value='Value2'>Option2</option>";
//   v_html +=      "<option value='Value3'>Option3</option>";
//   v_html +=    "</select></td>";
//   v_html +=    "<td><a href='#'><img border='0' src='images/c.gif' alt='Save' width='21' height='28'></a>";
//   v_html +=        "<a href='#'><img border='0' src='images/x.gif' alt='Dele' width='21' height='28'></a></td>";
//   v_html +=    "<td width='51'><input name='textfield' type='text' size='6' disabled='disabled' style='border:none'></td>";
//   v_html +=    "<td width='51'><input name='textfield2' type='text' size='6' disabled='disabled' style='border:none'>";
//   v_html += "</td>";
//   v_html += "</tr>";
//   v_html += "<span id='item_"+vn_last+"'></span>";

	   v_html += "<tr>";
	   v_html += "<td>Test2";

//if (next_elm=='titems')
//   {
//	   v_html += "<tr>";
//	   v_html += "<td>&nbsp;";
//   }
   
   //v_html = document.getElementById(next_elm).innerHTML + v_html;
   
   alert(v_html);
   
   document.getElementById(next_elm).innerHTML = v_html;

   alert(document.getElementById(next_elm).innerHTML);
next_elm = v_last;

}


function load_menu(p_elementid)
{
g_elementid = p_elementid;
alert ("TEST 1");
//if (!check_AJAX()){return;}
xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="main.php";
url=url+"?voperation=showmenu";
url=url+"&sid="+Math.random();

alert ("TEST 2");

xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}


function shownew(p_tbl,p_elementid)
{
	if (p_tbl.length ==0)
	{
    document.getElementById(p_elementid).innerHTML="";
    return;
	}
g_elementid = p_elementid;

xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="main.php";
url=url+"?voperation=shownew";
url=url+"&tbl="+p_tbl;
url=url+"&sid="+Math.random();

xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}


function showsub(p_tbl,p_elementid)
{
	if (p_tbl.length ==0)
	{
    document.getElementById(p_elementid).innerHTML="";
    return;
	}
g_elementid = p_elementid;

xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="main.php";
url=url+"?voperation=showsub";
url=url+"&tbl="+p_tbl;
url=url+"&sid="+Math.random();

xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

}


function showforedit(p_tbl,p_str,p_elementid)
{
	if (p_tbl.length ==0)
	{
    document.getElementById(p_elementid).innerHTML="";
    return;
	}
g_elementid = p_elementid;

xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="main.php";
url=url+"?voperation=showforedit";
url=url+"&tbl="+p_tbl;
url=url+"&crit="+p_str;
url=url+"&sid="+Math.random();

xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

}

function showdata(p_tbl,p_str,p_elementid)
{
	if (p_tbl.length ==0)
	{
    document.getElementById(p_elementid).innerHTML="";
    return;
	}
g_elementid = p_elementid;

xmlHttp=GetXmlHttpObject()
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="main.php";
url=url+"?voperation=getdata";
url=url+"&tbl="+p_tbl;
url=url+"&crit="+p_str;
url=url+"&sid="+Math.random();

xmlHttp.onreadystatechange=stateChanged;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);

}

function stateChanged()
{ 
if (xmlHttp.readyState==4)
{ 
document.getElementById(g_elementid).innerHTML=xmlHttp.responseText;
//alert (xmlHttp.responseText);
}
}

function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
}