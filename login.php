<?php
  session_start();
  session_register("UserIsOK_session");
  include($phpbb_root_path . 'db/db.php');
?>

<html>
<head>

<?php 

function login()
{
  extract($GLOBALS);

  if ($_POST["uname"]=="" || $_POST["upwd"]=="")
  {
    print "Login Failed";
  }
    else
  {

    $vsql="select * from users where upper(user_short)=";
    $vsql=$vsql."'".strtoupper($_POST["uname"])."' ";
    $vsql=$vsql."and pwd = '".$_POST["upwd"]."'";

   // echo "Test1<br>".$vsql;

	if( !($result = $db->sql_query($vsql)) )
	{
		echo "Failed to connect";
	}

	$row = $db->sql_fetchrow($result);
	$afrow = $db->sql_affectedrows();
	if($afrow>0)
	{
      $_SESSION['UserIsOK']=true;
      header("Location: "."menu.php");
	}
	else
	{
      print "Login Failed";
	}
    
  } 

  return $function_ret;
} 
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Thinker</title>
</head>
<body>

<?php

$vOperation=htmlspecialchars($_GET["voperation"]);
if ($vOperation.""=="login")
{

 Login();
  //print "Test 1";

}
elseif ($vOperation.""=="getdata")
{
  print "Test get data";
} 
else
{
  print "Test else";
}
?>

</body>
</html>

