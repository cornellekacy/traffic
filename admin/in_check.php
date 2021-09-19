<?php
session_start();
if(!session_is_registered(myusername)){
header("location:index.php");
}
?>
<html>
<body>
<table width="750" border="0" align="center">
  <tr>
    <td height="43" colspan="2" align="center" valign="middle"><p><a href="index.php?action=insert">INSERT ENGINES</a></p></td>
    <td colspan="2" align="center" valign="middle">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4"><p><?php
    if($_GET["number"]>0){
	include("../config/config.php");
	$connection=mysql_connect(dbhost,dbuser,dbpass);
		if(!$connection){die("Cant connect the sql: ". mysql_error());}
	$select=mysql_select_db(dbname,$connection);
		if(!$select){die("Cant select db: ". mysql_error());}

	
	$num=$_GET["number"];
	$num_urls="UPDATE  number SET  `num` =  '$num' WHERE id=1";
	$update_num=mysql_query($num_urls);
		if(!$update_num){die("Cant update number: ". mysql_error());}
	
	for($i=1;$i<=$num;$i++){
		$query="INSERT INTO engine (url) VALUES  ('".$_POST["EngineBroj".$i]."')";
		$add=mysql_query($query);
		if($add){
		echo "New engine is added: " . $_POST["EngineBroj".$i] ."</br>";
			}else{
				die("Following engine isnt added: " . $_POST["EngineBroj".$i] . mysql_error()."</br>");
				};
		}
		echo "</br>Total engines: $num";
		
}	
	?></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
