<?php 
//start the session here
//session_start() should be the first thing in your code, before any html tags or anything.

session_start();
?>

<?php 
//output buffering starts here : php is the interpreted language(executes statements one after another) and it sends the html to the browser in the chunks,
// and thus it reduces the performance,
//using the op buffer it stores the generated html into the buffer(memory) and then sends it to the browser and thus maximises the performance..

ob_start();
?>

<?php
//this is the connection page and it is required... means the code execution will be terminated if there is error in the connection page

require("khojhai_connect.php");
?>

<?php
//error_reporting(0) will turn off all the error reporting, there are many levels of error in php,
//for example : 1) error_reporting(E_ERROR) - this reports fatal errors(fatal error will stop the execution of the script immediately)
// 2) error_reporting(E_WARNING) - this reports non-fatal error, most of the errors fall into this category, this will give the warning but does not stop the execution of the script
// 3) error_reporting(E_PARSE) : this is the compile time error.......
// et cetera....

error_reporting(0);
?>

<?php
//specifies the default character set to be used when sending data to and from the database server.
// utf-8 stands for Unicode Transformation Format and 8 means 8-bits

mysqli_query($con, "set character_set_results='utf8'"); 
?>

<?php
//Intermediate proxies sometimes change the format of your images and files in order to improve performance. 
//The no-transform directive tells the intermediate proxies not to alter the format or your resources.

header("Cache-Control: no-transform");
?>



<?php
//this code will check if the user is logged in 

//---------------- LEVEL 01 of session checking ------------------//
if(!(empty($_SESSION['user_email'])))
{
header("Location: khojhai_home.php");
exit();
}

if(!(empty($_SESSION['user_id'])))
{
header("Location: khojhai_home.php");
exit();
}	

if(!(empty($_SESSION['user_password'])))
{
header("Location: khojhai_home.php");
exit();	
}


//------------------ LEVEL 02 of session checking ----------------//
if(isset($_SESSION['user_email']))
{
header("Location: khojhai_home.php");
exit();
}

if(isset($_SESSION['user_id']))
{
header("Location: khojhai_home.php");
exit();
}	

if(isset($_SESSION['user_password']))
{
header("Location: khojhai_home.php");
exit();	
}

//session checking ends here 
?>

<?php

//////////--------------------------------   EMAIL
if(!(isset($_POST['email'])))
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(!($_POST['email']))
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(empty($_POST['email']))
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if($_POST['email'] == '')
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(strlen($_POST['email']) > 65)
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(strlen($_POST['email']) < 1)
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(preg_match('/^[\s]{1,65}$/', $_POST['email']))
{
session_destroy();
session_unset();
	
header("Location: khojhai_login.php");
exit();
}


/////////--------------------------------------------------  PASSWORD
if(!(isset($_POST['password'])))
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(!($_POST['password']))
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(empty($_POST['password']))
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if($_POST['password'] == '')
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(!(preg_match('/^[0-9A-Za-z]{6,35}$/', $_POST['password'])))
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(strlen($_POST['password']) > 35)
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(strlen($_POST['password']) < 6)
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(preg_match('/^[\s]{1,35}$/', $_POST['password']))
{
session_destroy();
session_unset();
	
header("Location: khojhai_login.php");
exit();
}


////////------------------------------------ SUBMIT
if(!(isset($_POST['submit'])))
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(!($_POST['submit']))
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(empty($_POST['submit']))
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if($_POST['submit'] == '')
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(!(preg_match('/^[A-Za-z\s]{5,10}$/', $_POST['submit'])))
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(strlen($_POST['submit']) > 10)
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(strlen($_POST['submit']) < 5)
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

if(preg_match('/^[\s]{1,10}$/', $_POST['submit']))
{
session_destroy();
session_unset();
	
header("Location: khojhai_signup.php");
exit();
}



$email = mysqli_real_escape_string($con, $_POST['email']);

$pass = mysqli_real_escape_string($con, $_POST['password']);

$submit = mysqli_real_escape_string($con, $_POST['submit']);

if(isset($email, $pass, $submit))
{

$qry1 = "select * from users where email = '$email' ";

$qry_wrap1 = mysqli_query($con, $qry1);

$qry_count1 = mysqli_num_rows($qry_wrap1);

if($qry_count1 < 1)
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

while($qry_ftch1 = mysqli_fetch_assoc($qry_wrap1))
{
$dbemail = $qry_ftch1['email'];

$dbpassword = $qry_ftch1['password'];

$user_id = $qry_ftch1['id'];
}

if(password_verify($pass, $dbpassword))
{
$pass_ver = 'ok';
}

else 
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

$qry2 = "select * from users where id = '$user_id' and email = '$dbemail' and password = '$dbpassword' ";

$qry_wrap2 = mysqli_query($con, $qry2);

$qry_count2 = mysqli_num_rows($qry_wrap2);

if($qry_count2 < 1)
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

// Make dbemail and dbpassword to start sessions
if($pass_ver == 'ok')
{
if($dbemail && $dbpassword && $user_id)
{
	
session_start();
$_SESSION['user_email'] = $dbemail;

$_SESSION['user_password'] = $dbpassword;

$_SESSION['user_id'] = $user_id;

$sess_id = mysqli_real_escape_string($con, $_SESSION['user_id']);

$qry3 = mysqli_query($con, "SELECT id, email FROM users WHERE id = '$sess_id' ");

$qry_count3 = mysqli_num_rows($qry3);

if($qry_count3 < 1)
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}

header("Location: khojhai_home.php");
exit();

    }

else 
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}                                                                                                                                                                                   
    
    }

else 
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}		
	 
    }
	 
else 
{
session_destroy();
session_unset();

header("Location: khojhai_login.php?err=2");
exit();	
}	

?>
