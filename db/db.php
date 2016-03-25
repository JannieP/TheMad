<?php

include($phpbb_root_path . 'db/mysql.php');

$dbhost = 'localhost';
$dbname = 'themad';
$dbuser = 'root';
$dbpasswd = 'root';
$db = new sql_db($dbhost, $dbuser, $dbpasswd, $dbname, false);    
if(!$db->db_connect_id)
{
  echo "Could not connect to the database";
}

?>

