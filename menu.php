<?php
  session_start();
  session_register("UserIsOK_session");
  include($phpbb_root_path . 'db/db.php');
  if (!$_SESSION['UserIsOK']){/*  header("Location: "."index.htm");*/} 
?>
<html>
<head>

<script language="javascript" src="js/main.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/themad.css" rel="stylesheet" type="text/css" />

<title>Thinker</title>
</head>
<body onLoad="load_menu('header1')">
Menu <br>
<p><span id="header1"></span>
<p><span id="header2"></span></p>
<p><span id="data1"></span></p>
<p><span id="data2"></span></p>
<p><span id="footer1"></span></p>
<br>
</body>
</html>
