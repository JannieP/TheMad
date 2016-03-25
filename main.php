<?php

session_start();
session_register("UserIsOK_session");
include($phpbb_root_path . 'db/db.php');

function shownew($p_tbl)
{
	extract($GLOBALS);
	/*$vsql="select * from ".$p_tbl." where 1 = 2";
	if( !($result = $db->sql_query($vsql)) )
	{
		echo "Failed to connect";
	}*/
	print "test2";
/*	print "<table border='1'>";
	while ($line = @mysql_fetch_array($result,MYSQL_ASSOC))
	{
		print "<tr>";
		$i = 0;
		foreach ($line as $vx)
		{
			$meta = mysql_fetch_field($result, $i);
			print "<td bgcolor='#CCCCCC'>";
			print $meta->name;
			print "</td>";
			print "<td>";
			print "<input class='' type='text' name='".$meta->name."' />";
			print "&nbsp;</td>";
		  }
		  $i++;
		  print "</tr>";
		}
	}*/
}

function showformview($p_tbl,$p_str)
{
 extract($GLOBALS);

  $vsql="select * from ".$p_tbl." ";
  if ($p_str!="")
  {
    $vsql=$vsql."where ".str_replace("~","=",$p_str)." ";
	//$vsql=$vsql."where ".str_replace("#"," like ",$p_str)." ";
  } 


  if (1==2)
  {
    print $vsql;
  }
    else
  {
    if( !($result = $db->sql_query($vsql)) )
    {
      echo "Failed to connect";
    }

    print "<table border='1'>";
 
	while ($line = @mysql_fetch_array($result,MYSQL_ASSOC))
	{
		$i = 0;
		foreach ($line as $vx)
		{
		  print "<tr>";
		  $meta = mysql_fetch_field($result, $i);
		  print "<td class='menuhdr'>";
		  print $meta->name;
		  print "</td>";
		  if($meta->primary_key ==1)
		  {
			print "<td>";
			print "<input readonly='true' class='frmfld' type='text' name='".$meta->name."' value='".$vx."' />";
			print "&nbsp;</td>";
		  }
		  else
		  {
			print "<td>";
			print "<input class='frmfld' type='text' name='".$meta->name."' value='".$vx."' />";
			print "&nbsp;</td>";
		  }
		  $i++;
		  print "</tr>";
		}
	}
	print 
	"
	<tr>
	  <td colspan='2'><input class='' type='button' name='...' value='...' onClick='' /><input class='' type='button' name='...' value='...' onClick='' /></td>
	</tr>
	
	";
	print "</table>";
  }
}
function getData($p_tbl,$p_str)
{
  extract($GLOBALS);

  $vsql="select * from ".$p_tbl." ";
  if ($p_str!="")
  {
    $vsql=$vsql."where ".str_replace("~","=",$p_str)." ";
	//$vsql=$vsql."where ".str_replace("#"," like ",$p_str)." ";
  } 


  if (1==2)
  {
    print $vsql;
  }
    else
  {
    if( !($result = $db->sql_query($vsql)) )
    {
      echo "Failed to connect";
    }

    if (mysql_num_rows($result)==1)
	{
	   showformview($p_tbl,$p_str);
	}
	else
	{
	    
	    print "<table border='1'>";
		print "<tr class='menuhdr' >";
		
		/* get column metadata */
		$i = 0;
		while ($i < mysql_num_fields($result)) {
			$meta = mysql_fetch_field($result, $i);
			if (!$meta) {
				echo "No information available<br />\n";
			}
			echo "<td><b>".$meta->name."</b></td>";
			$i++;
		}
		print "</tr>";

		print "<tr>";
		$i=0;
		while ($i < mysql_num_fields($result)) {
			$meta = mysql_fetch_field($result, $i);
			if (!$meta) {
				echo "No information available<br />\n";
			}
			print "<td>";
			$v_str3="`".$meta->name."`#'%".$vx."%'";
			$v_str2="\"showforedit('".$p_tbl."','".$v_str3."','data1')\"";
			//$v_str1="onClick=".$v_str2."";
			//print $v_str1.$vx;		  

			//print "<input class='' size='5' type='text' name='".$meta->name."_f' /><input class='' type='button' name='".$meta->name."_b' value='...' onClick=".$v_str2." />";
			//print "";
			print "</td>";
			$i++;
		}
		print "</tr>";
    
		while ($line = @mysql_fetch_array($result,MYSQL_ASSOC))
		{
			print "<tr>";
			$i = 0;
			foreach ($line as $vx)
			{
			  if($vx == "")
			  {
				print "<td>&nbsp;</td>";
			  }
			  else
			  {
				  $meta = mysql_fetch_field($result, $i);
				  if($meta->primary_key ==1)
				  {
					print "<td>";
					$v_str3="`".$meta->name."`~".$vx."";
					$v_str2="\"showforedit('".$p_tbl."','".$v_str3."','data1')\"";
					$v_str1="<a class='primarytxt' href='#' onClick=".$v_str2.">";
					print $v_str1.$vx;		  
				  }
				  else
				  {
					print "<td class='lsttxt' >".$vx."";
				  }
				  print "&nbsp;</td>";
				  $i++;
			  }
			}
			print "</tr>";
		}
		
	}

    print "</table>";
  } 
  return $function_ret;
} 

$vOperation=htmlspecialchars($_GET["voperation"]);
if ($vOperation.""=="getdata")
{

  $v_tbl=htmlspecialchars($_GET["tbl"]);
  $v_crit=htmlspecialchars($_GET["crit"]);

  getData($v_tbl,$v_crit);
} 
elseif ($vOperation.""=="showforedit")
{
  $v_tbl=htmlspecialchars($_GET["tbl"]);
  $v_crit=htmlspecialchars($_GET["crit"]);
   
  getdata($v_tbl,$v_crit);
}
elseif ($vOperation.""=="showsub")
{
  $v_tbl=htmlspecialchars($_GET["tbl"]);
  //showsub($v_tbl,$v_crit);
  $v_str2="\"showforedit('".$v_tbl."','','data1')\"";
  $v_str1="<a class='menutxt' href='#' onClick=".$v_str2.">";

  $v_str2="\"shownew('".$v_tbl."','','data1')\"";
  $v_str3="<a class='menutxt' href='#' onClick=".$v_str2.">";

  print $v_tbl.":".$v_str1."List</a>|".$v_str3."New</a>";		  
}
elseif ($vOperation.""=="shownew")
{
  $v_tbl=htmlspecialchars($_GET["tbl"]);
  print "test2";
  //shownew($v_tbl);
}
elseif ($vOperation.""=="showmenu")
{
  $v_str2="\"showdata('client','','header2')\"";
  $v_str1="<a class='menutxt' href='#' onClick=".$v_str2.">Clients|</a>";
  echo $v_str1;
  $v_str2="\"showdata('supplier','','data1')\"";
  $v_str1="<a class='menutxt' href='#' onClick=".$v_str2.">Suppliers|</a>";
  echo $v_str1;
//	<a class="menutxt" href="#" onClick="showdata('quote','','data1')">Qoutes</a>|
//	<a class="menutxt" href="#" onClick="showdata('invoice','','data1')">Invoices</a>|
//	<a class="menutxt" href="#" onClick="showdata('`order`','','data1')">Orders</a>|	
//	<a class="menutxt" href="#" onClick="showdata('product','','data1')">Products</a>|	
//	<a class="menutxt" href="#" onClick="showdata('users','','data1')">Users</a>|	
//	<a class="menutxt" href="#" onClick="showdata('invoice','','data1')">Invoices</a>|	
}

?>

