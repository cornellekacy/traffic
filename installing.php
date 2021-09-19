<?php
if(!isset($_GET["step"])){
require("includes/functions.php");
$startinstall=welcome();
echo $startinstall;
};
// STEP 1  /////////////////////////////////////////////////////////////////////////////////////////////////////////////
if((isset($_GET['step']))&&($_GET["step"]==1)){

$dbhost=$_POST["dbhost"];
$dbname=$_POST["dbname"];
$dbuser=$_POST["dbuser"];
$dbpass=$_POST["dbpass"];
$status="";

$connection=mysql_connect($dbhost,$dbuser,$dbpass);
	if(!$connection){die("Cant connect the sql: ". mysql_error());}
require("includes/functions.php");

// Creating DATABASE
if (mysql_query("CREATE DATABASE IF NOT EXISTS {$dbname}",$connection))
  {
  $status.="Database created </br>";
  }
else
  {
  die("Error creating database: " . mysql_error());
}	
$select=mysql_select_db($dbname,$connection);
	if(!$select){die("Cant select the database: ".$mysql_error());}

// Create table
$status.=create_db_tables();

// CREATING NEW FILES AND ALL OTHER!!!
$configfile=createconfig();
$dbconfile=dbconfig();

if(!is_dir("config")){
	if(mkdir("config",755)){
	$status.="Config created... </br>";};
	}else{
		$status.="Config alredy exist! </br>";
		}

	$filemaker=fopen("config/config.php", "w") or die("can't open file");
		if($filemaker){	
			fwrite($filemaker,$configfile);
			$status.="config.php created... </br>";
			
			$dbconmaker=fopen("config/db_con.php", "w") or die("can't open file");
			if($dbconmaker){
				fwrite($dbconmaker,$dbconfile);
				$status.="db_con.php created... </br>";
				}else{
					$status.="db_con.php isn't created... </br>";
					fclose();
					};
			
			}

// Display STEP 1
step1();

//delating old index file and creating new one
$new_index_file=newindex();

$indexFileName = "index.php";
$filehandle = fopen($indexFileName, 'w') or die("can't open file");
fwrite($filehandle, $new_index_file);
fclose($filehandle);

} 

// STEP 2  /////////////////////////////////////////////////////////////////////////////////////////////////////////////

if((isset($_GET['step']))&&($_GET["step"]==2)){
	require('config/config.php');
	require("includes/functions.php");
	if((isset($_POST["username"]))&&(isset($_POST["passwrd"]))){
		
		$konekcija=mysql_connect(dbhost,dbuser,dbpass);
			if(!$konekcija){die("nece konekcija : ". mysql_error());}
		$selecttabelu=mysql_select_db(dbname,$konekcija);
			if(!$selecttabelu){die("nece konekcija : ". mysql_error());}
		$username=$_POST["username"];
		$password=$_POST["passwrd"];
		
		//da stavi bazu -- number -- i zauzme id 1,,, kasnije ce se samo updejtovati
		$default_no1="INSERT INTO number (id, num) VALUES (1, 0);";
		$default_num=mysql_query($default_no1);
		
		$insert_user="INSERT INTO users (username,password) VALUES ('$username','$password')";
		$insertonly=mysql_query($insert_user,$konekcija);
			if(!$insertonly){die("Cant create new user :" . mysql_query());}else{
				$finalstep=step3();
				echo $finalstep;
				}
		};	
	};


?>