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
if(!($_POST['submit']))
{
header("Location: khojhai_login.php?err=4");
exit();	
}

if(empty($_POST['submit']))
{
header("Location: khojhai_login.php?err=4");
exit();
}

if($_POST['submit'] != 'Submit')
{
header("Location: khojhai_login.php?err=4");
exit();
}

if(!preg_match('/^[A-Z][a-z]{5,7}$/', $_POST['submit'])) 
{
header("Location: khojhai_login.php?err=4");
exit();
}

if(!isset($_POST['submit']))
{
header("Location: khojhai_login.php?err=4");
exit();	
}

if(strlen($_POST['submit']) > 7)
{
header("Location: khojhai_login.php?err=4");
exit();	
}

if(preg_match('/^[\s]{1,7}$/', $_POST['submit']))
{
header("Location: khojhai_login.php");
exit();
}


////////////////////////      EMAIL
if(!($_POST['email']))
{
header("Location: khojhai_login.php?err=4");
exit();
}

if(empty($_POST['email']))
{
header("Location: khojhai_login.php?err=4");
exit();
}

if($_POST['email'] == '')
{
header("Location: khojhai_login.php?err=4");
exit();
}

if(!isset($_POST['email']))
{
header("Location: khojhai_login.php?err=4");
exit();
}

if(preg_match('/^[\s]{1,10}$/', $_POST['email'])) 
{
header("Location: khojhai_login.php?err=4");
exit();
}

if(strlen($_POST['email']) > 65)
{
header("Location: khojhai_login.php?err=4");
exit();	
}

if(preg_match('/^[\s]{1,65}$/', $_POST['email']))
{
header("Location: khojhai_login.php");
exit();
}


if(isset($_POST['submit']) && ($_POST['email']))
{

$email = mysqli_real_escape_string($con, $_POST['email']);
$submit = mysqli_real_escape_string($con, $_POST['submit']);

if(!($email))
{
header("Location: khojhai_login.php?err=4");
exit();	
}

if(empty($email))
{
header("Location: khojhai_login.php?err=4");
exit();	
}	

if(isset($email, $submit))
{
$email = $email;

$qry1 = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

$qry_wrap1 = mysqli_query($con, $qry1);

$qry_count1 = mysqli_num_rows($qry_wrap1);

if($qry_count1 > 0)
{
while($qry_ftch1 = mysqli_fetch_array($qry_wrap1, MYSQLI_ASSOC))
{
$id = mysqli_real_escape_string($con, $qry_ftch1["id"]);

$e = mysqli_real_escape_string($con, $qry_ftch1["email"]);

$u_n = mysqli_real_escape_string($con, $qry_ftch1['name']);
}

$qry2 = mysqli_query($con, "SELECT id FROM users WHERE email = '$e' and id = '$id' ");

$qry_count2 = mysqli_num_rows($qry2);

if($qry_count2 < 1)
{
header("Location: khojhai_login.php?err=4");
exit();		
}

$emailcut = substr($e, 0, 4);

$randNum = rand(10000,99999);

$tempPass = "$emailcut$randNum";

$hashTempPass = password_hash($tempPass, PASSWORD_BCRYPT, array('cost' => 10));

$qry3 = "UPDATE user_art SET user_pass = '$hashTempPass' WHERE user_email = '$e' and user_id = '$id' LIMIT 1";

$qry_wrap2 = mysqli_query($con, $qry3);

$to = "$e";

$from = "Khojhai.com";

$headers ="From: $from\n";

$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1 \n";

$subject ="Khojhai Temporary Password";

$name = explode(' ', $u_n);

$first_name = $name[0];
      
$msg = '<h2>Hello '.$first_name.'</h2><p>This is an automated message from Khojhai. 

If you did not recently initiate the Forgot Password process, please disregard this email.</p>

<p>Temporary Password : <b>'.$tempPass.'</b>  <br>You Can Change It Later</p>

<p><a href = "http://www.khojhai.com/khojhai_forg_pass2.php?e='.$e.'&p='.$hashTempPass.'"><b>Please Click Here To Apply The 

Temporary Password</b></a></p>

<p>If you do not click the link in this email, no changes will be made to your account. 
In order to set your login password to the temporary password you must click the link above.</p>';

if(mail($to,$subject,$msg,$headers)) 
{
header("Location: khojhai_login.php?err=5");
exit();
} 

else 
{
header("Location: khojhai_login.php?err=4");
exit();		
}
   
   } 
  
else 
{
header("Location: khojhai_login.php?err=4");
exit();	
}

   }
   
   
else
{
header("Location: khojhai_login.php?err=4");
exit();	
}	 
   
   }	 
		
else
{
header("Location: khojhai_login.php?err=4");
exit();	
}		

?>