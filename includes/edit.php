<?php
include("config/config.php");
$connection=mysql_connect(dbhost,dbuser,dbpass);
	if(!$connection){die("Cant connect the sql: ". mysql_error());}
$select=mysql_select_db(dbname,$connection);
	if(!$select){die("Cant select db: ". mysql_error());}

$numquery="SELECT * FROM number WHERE id=1";
$numrez=mysql_query($numquery);

$num_clear=mysql_fetch_array($numrez);
$enginenumber=$num_clear["num"];
echo "Total $enginenumber Engines! </br>";

$enginequery="SELECT * FROM engine ORDER BY id DESC LIMIT $enginenumber";
$engrez=mysql_query($enginequery);

//tables
echo "<form id='edit' name='form1' method='post' action=''><table width='750' border='0'><tr><td width='4%' align='center'>ID</td><td width='88%'> Url</td><td width='8%' align='center' valign='middle'>&nbsp;</td></tr>";	

while($urls=mysql_fetch_array($engrez)){
	echo "<tr><td align='center'>".$urls["id"]."</td><td><input name='url".$urls["id"]."' type='text' id='url".$urls["id"]."' value='".$urls["url"]."' size='100' />
	</td><td align='center' valign='middle'><label for='delate'><input type='submit' name='del' id='del' value='Delete' /></label></td></tr>";
	}

echo "<tr><td align='center'>&nbsp;</td><td align='center'><input type='submit' name='savechanges' id='savechanges' value='Save changes' /></td>
<td align='center' valign='middle'>&nbsp;</td></tr></table></form>";




?>