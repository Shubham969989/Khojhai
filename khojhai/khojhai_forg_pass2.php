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
if(!($_GET['e']))
{
header("Location: khojhai_login.php?error");
exit();	
}

if(empty($_GET['e']))
{
header("Location: khojhai_login.php?error");
exit();	
}

if($_GET['e'] == '')
{
header("Location: khojhai_login.php?error");
exit();		
}

if(!isset($_GET['e']))
{
header("Location: khojhai_login.php?error");
exit();		
}

if(preg_match('/^[\s]{1,500}$/', $_GET['e'])) 
{
header("Location: khojhai_login.php?error");
exit();	
}



if(!($_GET['p']))
{
header("Location: khojhai_login.php?error");
exit();	
}

if(empty($_GET['p']))
{
header("Location: khojhai_login.php?error");
exit();	
}

if($_GET['p'] == '')
{
header("Location: khojhai_login.php?error");
exit();	
}

if(!isset($_GET['p']))
{
header("Location: index.php");
exit();	
}

if(preg_match('/^[\s]{1,500}$/', $_GET['p'])) 
{
header("Location: khojhai_login.php?error");
exit();	
}



if(isset($_GET['e']) && ($_GET['p']))
{
	
$e = mysqli_real_escape_string($con, $_GET['e']);

$temppasshash = mysqli_real_escape_string($con, $_GET['p']);

if(strlen($temppasshash) < 10)
{
header("Location: khojhai_login.php?error");
exit();	
}

$sql = "SELECT * FROM user_art WHERE user_email = '$e' AND user_pass = '$temppasshash' LIMIT 1";

$query = mysqli_query($con, $sql);

$numrows = mysqli_num_rows($query);

if($numrows < 1)
{
header("Location: khojhai_login.php?error");
exit();	
}
 
else 
{
$row = mysqli_fetch_array($query);

$id = $row['user_id'];

$sql = "UPDATE users SET password = '$temppasshash' WHERE id = '$id' AND email = '$e' LIMIT 1";

$query = mysqli_query($con, $sql);

$sql = "UPDATE user_art SET user_pass = '' WHERE user_email = '$e' and user_id = '$id' LIMIT 1";

$query = mysqli_query($con, $sql);

header("Location: khojhai_login.php?err=3....");
exit();	
}
           
   }
	  
	  
else
{
header("Location: khojhai_login.php?error");
exit();	
}	
		 
?>