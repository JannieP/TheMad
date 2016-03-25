<?php

/*
* Ajax based live updating stock chart example. Based upon the Ajax Agent framework.
* Author Pierre Norraeus
* 2006-02-21
*/

  // Generate the html-table. you can, ofcourse, do this any way you want.
function printPrices() {
 
   
    $text = "<table>\n";
    $text .= "    <tr>" .
          "      <td><b>Stock</td>" .
          "      <td><b>Market</b></td>" .
          "      <td><b>Open</b></td>" .
          "      <td><b>Close</b></td>" .
          "      <td><b>Updated</b></td>" .
          "      <td><b>Trade</b></td>\n" .
          "   </tr>";
   
    $text .= "    <tr>" .
          "      <td>AAA</td>" .
          "      <td>A</td>" .
          "      <td>10</td>" .
          "      <td>13</td>" .
          "      <td>".date("Y-m-d H:i:s")."</td>" .
          "      <td><a href=# onclick=\"call_trade('1')\" >Trade</a></td>\n" .
          "   </tr>";
   $text .= "    <tr>" .
          "      <td>BBB</td>" .
          "      <td>B</td>" .
          "      <td>20</td>" .
          "      <td>23</td>" .
          "      <td>".date("Y-m-d H:i:s")."</td>" .
          "      <td><a href=# onclick=\"call_trade('2')\" >Trade</a></td>\n" .
          "   </tr>";
   $text .= "    <tr>" .
          "      <td>CCC</td>" .
          "      <td>C</td>" .
          "      <td>30</td>" .
          "      <td>33</td>" .
          "      <td>".date("Y-m-d H:i:s")."</td>" .
          "      <td><a href=# onclick=\"call_trade('3')\" >Trade</a></td>\n" .
          "   </tr>";
   $text .= "</table>\n";
   return $text; 
   }
   

 
function trade($pid) {
     $text = "trade,".$pid;
    return $text;
}

// include the framework base..
  include_once("agent.php");
 

// init the framework..
  $agent->init();

?>

<html>

<head>
<title>Quote Ajax Example</title>

<meta name="generator" content="pico">
<meta name="author" content="Norraeus">
<meta name="keywords" content="Ajax testsetup.">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
<script>
  function call_trade(str) {
    agent.call('','trade','callback_trade',str);
  }

  function callback_trade(str) {
    document.getElementById('divTrade').innerHTML = str;
  }

  function call_printPrices() {
     call_setLoading();
    agent.call('','printPrices','callback_printPrices');
   
   //Update the table every.. 2 seconds?
    setTimeout('call_printPrices()',2000);
  }

  function callback_printPrices(str) {
     call_unsetLoading();
    document.getElementById('tablePrices').innerHTML = str;
  }
 
  function call_setLoading() {
    callback_printLoading('<a>Loading...</a>');
  }
  function call_unsetLoading() {
    callback_printLoading(' ');
  }
  function callback_printLoading(str) {
    document.getElementById('showLoading').innerHTML = str;
  }
  function init()  {
     call_printPrices();
  }

</script>

<body onload="init()">
<center>
<a><b>Simple stock chart example..</b></a><br/><br/>

<h4>Current Stock Prices</h4>
<!-- you can also have a button for updates.. -->
<!-- <a href=# onclick="call_printPrices()"><b>here</b></a> to test.-->
<br/><br/>

<div id='tablePrices'></div>
<div id='divTrade'></div>
<div id='showLoading'></div>
<br><br>
<a href="http://www.ajaxtechforums.com">Ajax Tech Forums</a>
</center> 
</body>
</html> 