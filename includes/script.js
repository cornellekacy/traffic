var termof=document.getElementById("termsofuse");
var nextstep=document.getElementById("installstep2");

var installbutton = document.forms["dbsett"];
var dbhost=document.forms["dbsett"]["dbhost"];
var dbuser=document.forms["dbsett"]["dbuser"];
var dbname=document.forms["dbsett"]["dbname"];

nextstep.style.display="none";

function TermMustAgree(){
	var checkbox=document.getElementById("terms").checked;
	var next1=document.getElementById("next");
	if(checkbox){
		next1.disabled=false;
		}else{
			next1.disabled=true;
			}
}

function step2(){
	termof.style.display="none";
	nextstep.style.display="block";
	}



var dbhost=document.getElementById("dbhost");
var dbuser=document.getElementById("dbuser");
var dbname=document.getElementById("dbname");

dbhost.value="please enter your db host here...";
dbname.value="please enter name for db...";


dbhost.onfocus=function(){
	if(dbhost.value=="please enter your db host here..."){
		dbhost.value="";
		}
	}
dbhost.onblur=function(){
	if(dbhost.value==""){
		dbhost.value="please enter your db host here...";
		}
	}

dbname.onfocus=function(){
	if(dbname.value=="please enter name for db..."){
		dbname.value="";
		}
	}
dbname.onblur =function(){
	if(dbname.value==""){
		dbname.value="please enter name for db...";
		}
	}


function installcheck(){
	if(dbhost.value=="please enter your db host here..."){
		alert ("DB Host is not valid, please fill all form to contiue...");
		return false;		
		}
	if(dbname.value=="please enter name for db..."){
		alert ("DB Name is not valid, please fill all form to contiue...");
		return false;		
		}
	
	if(dbhost.value.length<4){
		alert ("DB Host isnt filled up, please fill all form to contiue...");
		return false;
		}  
	if(dbuser.value.length<4){
		alert ("DB User isnt filled up, please fill all form to contiue...");
		return false;
		}
	if(dbname.value.length<3){
		alert ("DATABASE Name isnt ok, please fill all form to contiue...");
		return false;
		};
	
	}

function checkvalues(){
	var forma=document.getElementById("insertenginess");
	var polje=forma.getElementsByTagName("input");
	var brojpolja=polje.length;
	var o=0;
	while(o<brojpolja){
		
		nowpolje=polje[o].value;
		broj=o+1;
		poljehttp=nowpolje.indexOf("http://");
		if(nowpolje == ""){
			alert("URL of Engine "+broj+" is empty, please fill the form in Engine "+broj);
			polje[o].focus();
			return false;
					}else if(poljehttp != -1){
				alert("Your Engine address contains http:// in Engine "+ broj +" ! Please remove http:// !");
				polje[o].focus();
				return false;
				};
		o++;
		
		}
}