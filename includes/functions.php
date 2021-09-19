<?php

//FUNCTIONS


// Creating DATABASE TABLES

function create_db_tables(){
	global $status;
	global $connection;
	
	$sql_engine = "CREATE TABLE IF NOT EXISTS engine (
id int NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
url varchar(55)
)";
$sql_number = "CREATE TABLE IF NOT EXISTS  number (
id int NOT NULL, 
PRIMARY KEY(id),
num int(1)
)";

$sql_users="CREATE TABLE IF NOT EXISTS  users (
id int AUTO_INCREMENT, 
username varchar(65) NOT NULL,
password varchar(65) NOT NULL,
PRIMARY KEY(id)
)";


$make_engines=mysql_query($sql_engine,$connection);
	if($make_engines){
		$status.="TABLE 'engine' created successfuly! </br>";
		}else{
			die("TABLE 'engine' failed!!! </br>". mysql_error());
			};

$make_nums=mysql_query($sql_number,$connection);
	if($make_nums){
		$status.="TABLE 'number' created successfuly! </br>";
		}else{
			die("TABLE 'number' failed!!! </br>". mysql_error());
			};

$make_users=mysql_query($sql_users,$connection);
	if($make_users){
		$status.="TABLE 'users' created successfuly! </br>";
		}else{
			die("TABLE 'users' failed!!! </br>". mysql_error());
			};
}

// Create config file
function createconfig(){
	global $dbhost;
	global $dbname;
	global $dbuser;
	global $dbpass;
		
	$configfile="<?php \n //DATABASE SETTINGS \n define('servername','".$_SERVER["SERVER_NAME"]."'); \n define('dbhost','".$dbhost."'); \n 					define('dbname','".$dbname."'); \n define('dbuser','".$dbuser."'); \n define('dbpass','".$dbpass."'); \n";
	return $configfile;
}


// Create database conffile
function dbconfig(){
	
	$dbconfile="<?php \n //DATABASE CONNECT SETTINGS \n include('config.php'); \n \n if(mysql_connect(dbhost,dbuser,dbpass)){ \n	if(!mysql_select_db(dbname)){ \n		 die('Cant select database: ' . mysql_error()); \n 		 }; \n 		}else{ \n			die('Cant connect to database: ' . mysql_error()); \n 			}; \n ?>";
	return $dbconfile;
}



// WELCOME SCREEN OF INSTALLATION ////////////////////////////////////////////////////////////////////////////////////

function welcome(){
$wel="<head>
<title>Welcome to Monster Traffic installation!</title>
<link rel='stylesheet' type='text/css' href='includes/style.css' />
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
</head>
<body>
<div id='header' align='center' class='header'><img src='source/header.png' width='259' height='300'></div>
<div id='termsofuse' class='content'>
<table width='600' height='317' border='0' align='center'>
  <tr>
    <td height='44' align='center' valign='middle'><div class='naslov'>Welcome to Monster Traffic installation!</div></td>
  </tr>
  <tr>
    <td height='154' align='left' valign='top'><div id='fullcont' style='overflow:auto; width:600px; height:180px'>
      <p>TERM OF USING!</p>
      <p>1. We don't hold any  responsibility for factors beyond our control that may interfere with our  ability to deliver visitors to your URL. Such factors include, but are not  limited to: downtime on your server, overuse of your bandwidth quota (if  applicable), errors on your site and network outages beyond our servers. Please  contact your web hosting company or network provider if you are unsure about  whether your hosting is sufficient for the traffic amount you are ordering.<br>
        2. We do not carry any duty  related to any advertisers.<br>
        3. We do not guarantee clicks  on your ads, as it would be illegal. It is up to you to make your ads relevant  and appealing to our visitors.<br>
        4. We do not provide traffic  stats, nor any 3rd party tools to monitor your traffic. It is your  responsibility to have a proper tracking code, from any of the 3rd party  counters on your website.<br>
        <br>
        5. We only guarantee the amount  of visitors which you purchase. We do not guarantee the purchase of products or  services from your site as well as visitor's interaction with your site nor the  increase of performance of your site.<br>
        6. Please allow an industry  standard of 10-15% in decay rates. This means that for every thousand you  order, 100 - 150 people are more than likely going to have javascript shut off  or some other issue, which will prevent the counter to count them. This is true  for any traffic supplier anywhere.<br>
        Also, please note, that we review claims only, if you have a StatCounter  installed in the head (header) of your site.</p>
</div></td>
  </tr>
  <tr>
    <td height='24' align='center' valign='middle'><form id='Termsofuse' onClick='TermMustAgree()' name='Termsofuse' method='post' action=''>
      <input type='checkbox' name='terms' id='terms' />
I agree to term of using! I will use this on my own risk!
<label for='terms'></label>
    </form></td>
  </tr>
  <tr>
    <td height='26' align='center' valign='top'><form id='form2' name='form2' method='post' action=''>
      <input type='button' name='next' id='next' onClick='step2()' value='I Agree' disabled='disabled' />
    </form></td>
  </tr>
</table></div>
<div id='installstep2' class='content'>
<form id='dbsett' name='dbsett' method='post' action='installing.php?step=1'>
  <table width='600' height='388' border='0' align='center'>
    <tr>
      <td height='63' colspan='2' align='center' valign='middle'><div class='naslov'>DATABASE SETTINGS</div></td>
    </tr>
    <tr>
      <td height='21' colspan='2' align='left' valign='top'><p>Please read carefull and fill form!</p></td>
    </tr>
    <tr>
      <td width='76%' height='24' align='left' valign='top'>
        <p>
          <label for='dbhost'></label>
          Database Host<br />
          <input name='dbhost' type='text' id='dbhost' size='60' />
          <br />
          DB user:<br />
          <input name='dbuser' type='text' id='dbuser' size='25' />
          <br />
          DB pass:<br />
          <input name='dbpass' type='password' id='dbpass' size='30' />
          <br />
          Database name:<br />
<input name='dbname' type='text' id='dbname' size='30' />
</p>
<p>&nbsp;</p>
      </td>
      <td width='24%' align='left' valign='top'><p>All fields are require!<br />
        Database host is usualy &quot;localhost&quot;, DB user and DB pass i dont need to explane to you :) Please create database in your phpmyadmin and provide name to install new tables.</p></td>
    </tr>
    <tr>
      <td height='21' colspan='2' align='center' valign='top'><input type='submit' onClick='JavaScript:return installcheck()' id='install' value='Install' />
      </td>
    </tr>
  </table>
   </form>
</div>
<script type='text/javascript' src='includes/script.js'></script>
</body>";
return $wel;
};




///////////////////////////////////////////////// DISPLAY STEP 1 /////////////////////////////////////////////////////

function step1(){
	global $status;
	
	$step1="<head>
<link rel='stylesheet' type='text/css' href='includes/style.css' />
</head>
<body>
<div id='header' align='center' class='header'><img src='source/header.png' alt='' width='259' height='300'></div>
<div class='content'><table width='600' height='222' border='0' align='center'>  <tr>  <td height='59' colspan='2' align='center' valign='middle'><div class='naslov'>NEW USER ACCOUNT</div></td>  </tr>  <tr>  <td width='62%' align='center' valign='top'>Account Details</td>
<td width='38%' height='9' align='left' valign='top'> <p>Status:</p></td></tr>  <tr>
  <td width='62%' align='center' valign='top'><form action='installing.php?step=2' method='post' name='form1' id='form1'>
    <table width='100%' height='110' border='0' align='center'>
      <tr>
        <td width='17%' height='24' align='center' valign='top'>Username:</td>
        <td width='83%' align='left' valign='top'><input name='username' type='text' id='username' size='40' /></td>
      </tr>
      <tr>
        <td height='24' align='center' valign='top'>Passowrd:</td>
        <td align='left' valign='top'><input name='passwrd' type='password' id='passwrd' size='40' /></td>
      </tr>
      <tr>
        <td height='54' colspan='2' align='center' valign='middle'><input type='submit' name='step2' id='step2' value='NEXT STEP' /></td>
      </tr>
    </table>
    <p><br />
      <label for='passwrd2'></label>
    </p>
  </form></td>
<td height='127' align='left' valign='top'>{$status}</td></tr></table></div></body>";
echo $step1;
}



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//delating old index file and creating new one ////// INDEX.PHP manipulation /////////

function newindex(){
$new="<?php 
if (file_exists('install.php')) {
    unlink('install.php');
	};
if (file_exists('installing.php')) {
    unlink('installing.php');
	};
?> <head>
<title>Traffic Monster: members area</title>
<link rel='stylesheet' type='text/css' href='includes/style.css' />
</head>
<body>
<div align='center' class='header'> <span><img src='source/header.png' alt='' width='259' height='300' /></span></div>
<div class='content'><table width='600' height='222' border='0' align='center'>  <tr>  <td height='59' colspan='2' align='center' valign='middle'><div class='naslov'>Members area</div></td>  </tr>  <tr>  <td colspan='2' align='center' valign='top'><form name='form1' method='post' action='admin/checklogin.php'>
          <table width='100%' height='282' border='0' class='logintable'>
            <tr>
              <td height='278' align='left' valign='top'><table width='100%' height='232' border='0'>
                <tr>
                  <td colspan='4'>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td colspan='2' rowspan='4' align='center' valign='top'><p><br>
                  </p>
                    <table width='88%' border='0' cellpadding='3' cellspacing='1' bgcolor=''>
                      <tr>
                        <td width='72'>Username</td>
                        <td width='5'>:</td>
                        <td width='144'><input name='username' type='text' id='username'></td>
                      </tr>
                      <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><input name='password' type='password' id='password'></td>
                      </tr>
                      <tr>
                        <td height='25'>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td align='center' valign='top'>&nbsp;</td>
                      </tr>
                    </table>
                    <p><img src='source/gumb.png' alt='' width='100' height='32' id='loujse'></p></td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td width='11%'>&nbsp;</td>
                  <td width='8%'>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td height='59'>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
              </table></td>
            </tr>
          </table>
        </form>
        <p>&nbsp;</p>
</tr>  </table></div>
<script type='text/javascript'>
	var Log=document.getElementById('loujse');
	Log.onclick=function(){
		document.form1.submit();
		}

</script>
</body>";
return $new;
};


// FINAL STEP 3 /////////////////////////////////////////////////////////////////////////////////////////////////////////
function step3(){
	
	$laststep="<head>
<link rel='stylesheet' type='text/css' href='includes/style.css' />
</head>
<body>
<div align='center'class='header'> <span><img src='source/header.png' alt='' width='259' height='300' /></span></div>
<div class='content'><table width='600' height='222' border='0' align='center'>  <tr>  <td height='59' colspan='2' align='center' valign='middle'><div class='naslov'>Installation is completed</div></td>  </tr>  <tr>  <td colspan='2' align='center' valign='top'> <p> Congratulations, it seems that you successfully complete the installation !!!<br>
Your next step is to login to the main page (index.php) and to start 'traffic monster' traffic share,  and enjoy a rapid increase your Alexa rank!   <br>
<div id='redirecting' class='count'> </div></p></td>
</tr>  </table></div>
<script type='text/javascript'> 
var count=5;
var counter=setInterval('timer()',1000); //1000 will  run it every 1 second

function timer()
{
  count=count-1;
  if (count <= 0)
  {
     clearInterval(counter);
	 document.location.href='index.php';
     return;
  }

 document.getElementById('redirecting').innerHTML='You will be redirected to Login page in '+count + ' secs';
}
</script></body>";

return $laststep;
};

?>