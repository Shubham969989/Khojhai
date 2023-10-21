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
// CHECK FOR SESSIONS HERE //
if(!($_SESSION['user_id']))
{
session_destroy();
session_unset();

header("Location: khojhai_signup.php");
exit();
}

if(!($_SESSION['user_email']))
{
session_destroy();
session_unset();

header("Location: khojhai_signup.php");
exit();
}

if(!($_SESSION['user_password']))
{
session_destroy();
session_unset();

header("Location: khojhai_signup.php");
exit();
}



if(empty($_SESSION['user_id']))
{
session_destroy();
session_unset();

header("Location: khojhai_signup.php");
exit();
}

if(empty($_SESSION['user_email']))
{
session_destroy();
session_unset();

header("Location: khojhai_signup.php");
exit();
}

if(empty($_SESSION['user_password']))
{
session_destroy();
session_unset();

header("Location: khojhai_signup.php");
exit();
}



if(!(isset($_SESSION['user_id'])))
{
session_destroy();
session_unset();

header("Location: khojhai_signup.php");
exit();
}

if(!(isset($_SESSION['user_email'])))
{
session_destroy();
session_unset();

header("Location: khojhai_signup.php");
exit();
}

if(!(isset($_SESSION['user_password'])))
{
session_destroy();
session_unset();

header("Location: khojhai_signup.php");
exit();
}



if(!preg_match('/^[0-9]{1,20}$/', $_SESSION['user_id'])) 
{
session_destroy();
session_unset();

header("Location: khojhai_signup.php");
exit();
}

$email = mysqli_real_escape_string($con, $_SESSION['user_email']);

$pass = mysqli_real_escape_string($con, $_SESSION['user_password']);

$id = mysqli_real_escape_string($con, $_SESSION['user_id']);


if($email && $pass && $id)
{
$sel = "select * from users where email = '$email' and id = '$id' ";

$login = mysqli_query($con, $sel);

$yolo = mysqli_num_rows($login);

if($yolo < 1)
{
session_destroy();
session_unset();

header("Location: khojhai_signup.php");
exit();
}

while($log = mysqli_fetch_assoc($login))
{
$dbemail = $log['email'] ;
$dbpassword = $log['password'];
$user_id = $log['id'];
}

// Check if the pass or email exists in database
$sel_query = "select * from users where email = '$dbemail' and password = '$dbpassword' and id = '$user_id' ";

$login2 = mysqli_query($con, $sel_query);

$result = mysqli_num_rows($login2);

if($result > 0)
{
	$trpg1 = "good";
}

else
{
session_destroy();
session_unset();

header("Location: khojhai_signup.php");
exit();
}

     }
	 
else
{
session_destroy();
session_unset();	
	
header("Location: khojhai_signup.php");
exit();
}	 

?>



<?php 
$email = mysqli_real_escape_string($con, $_SESSION['user_email']);

$pass = mysqli_real_escape_string($con, $_SESSION['user_password']);

$id = mysqli_real_escape_string($con, $_SESSION['user_id']);


if($email && $pass && $id)
{
$sel = "select * from users where email = '$email' and id = '$id' ";

$login = mysqli_query($con, $sel);

while($log = mysqli_fetch_assoc($login))
{
$dbemail = $log['email'] ;
$dbpassword = $log['password'];
$user_id = $log['id'];
$tmp_name = $log['name'];
}

$sess_id = mysqli_real_escape_string($con, $user_id);

$sess_mail = $dbemail;

$sess_pass = $dbpassword;
}
	 
else
{
session_destroy();
session_unset();	
	
header("Location: khojhai_signup.php");
exit();
}	 
?>



<?php 

//-------- 1. Submit Button

if(!($_POST['submit']))
{
header("Location: khojhai_pass_setting.php");
exit();
}

if(empty($_POST['submit']))
{
header("Location: khojhai_pass_setting.php");
exit();
}

if($_POST['submit'] == "")
{
header("Location: khojhai_pass_setting.php");
exit();
}

if(!preg_match('/^[A-Z][a-z]{1,5}$/', $_POST['submit'])) 
{
header("Location: khojhai_pass_setting.php");
exit();
}

if(!(preg_match('/^[A-Z][a-z]{1,5}$/', $_POST['submit'])))
{
header("Location: khojhai_pass_setting.php");
exit();
}

if($_POST['submit'] != 'Update')
{
header("Location: khojhai_pass_setting.php");
exit();
}

if(strlen($_POST['submit']) > 6)
{
header("Location: khojhai_pass_setting.php");
exit();
}

if(strlen($_POST['submit']) < 6)
{
header("Location: khojhai_pass_setting.php");
exit();
}

if(!(isset($_POST['submit'])))
{
header("Location: khojhai_pass_setting.php");
exit();
}

if(preg_match('/^[\s]{1,6}$/', $_POST['submit']))
{
header("Location: khojhai_pass_setting.php");
exit();
}



// old password
if(!($_POST['pass']))
{
header("Location: khojhai_pass_setting.php");
exit();
}

if(empty($_POST['pass']))
{
header("Location: khojhai_pass_setting.php");
exit();
}

if($_POST['pass'] == "")
{
header("Location: khojhai_pass_setting.php");
exit();
}

if(strlen($_POST['pass']) > 35)
{
header("Location: khojhai_pass_setting.php?err=2");
exit();
}

if(strlen($_POST['pass']) < 6)
{
header("Location: khojhai_pass_setting.php?err=2");
exit();
}

if(!preg_match('/^[0-9A-Za-z]{6,35}$/', $_POST['pass'])) 
{
header("Location: khojhai_pass_setting.php?err=2");
exit();
}

if(!(preg_match('/^[0-9A-Za-z]{6,35}$/', $_POST['pass'])))
{
header("Location: khojhai_pass_setting.php?err=2");
exit();
}

if(preg_match('/^[\s]{1,35}$/', $_POST['pass']))
{
header("Location: khojhai_pass_setting.php?err=2");
exit();
}

if(!isset($_POST['pass']))
{
header("Location: khojhai_pass_setting.php?err=2");
exit();
}

// old password END



/// NEW PASSWORD

if(!($_POST['pass2']))
{
header("Location: khojhai_pass_setting.php?err=1");
exit();
}

if(empty($_POST['pass2']))
{
header("Location: khojhai_pass_setting.php?err=1");
exit();
}

if($_POST['pass2'] == "")
{
header("Location: khojhai_pass_setting.php?err=1");
exit();
}

if(strlen($_POST['pass2']) > 35)
{
header("Location: khojhai_pass_setting.php?err=1");
exit();
}

if(strlen($_POST['pass2']) < 6)
{
header("Location: khojhai_pass_setting.php?err=1");
exit();
}

if(!preg_match('/^[0-9A-Za-z]{6,35}$/', $_POST['pass2'])) 
{
header("Location: khojhai_pass_setting.php?err=3");
exit();
}

if(!(preg_match('/^[0-9A-Za-z]{6,35}$/', $_POST['pass2'])))
{
header("Location: khojhai_pass_setting.php?err=3");
exit();
}

if(preg_match('/^[\s]{1,35}$/', $_POST['pass2']))
{
header("Location: khojhai_pass_setting.php?err=1");
exit();
}

if(!isset($_POST['pass2']))
{
header("Location: khojhai_pass_setting.php?err=1");
exit();
}

///  NEW PASSWORD END



$pass1 = preg_replace('#[^a-zA-Z0-9]#i', '', $_POST['pass']);

$pass2 = preg_replace('#[^a-zA-Z0-9]#i', '', $_POST['pass2']);



$pass1 = mysqli_real_escape_string($con, $pass1);

$pass2 = mysqli_real_escape_string($con, $pass2);

$submit = mysqli_real_escape_string($con, $_POST['submit']);



if(isset($pass1, $pass2, $submit))
{

$pass1 = $pass1;

$pass2 = $pass2;

$sess_id = $sess_id;



$qry1 = "SELECT * FROM users WHERE id = '$sess_id' ";

$qry_wrap1  = mysqli_query($con, $qry1);

$qry_count1 = mysqli_num_rows($qry_wrap1);

if($qry_count1 < 1)
{
session_destroy();
session_unset();	
	
header("Location: khojhai_login.php");
exit();
}


while($qry_ftch1 = mysqli_fetch_assoc($qry_wrap1))
{
$current_db_pass = mysqli_real_escape_string($con, $qry_ftch1['password']);

$sess_email = mysqli_real_escape_string($con, $qry_ftch1['email']);
}


if(password_verify($pass1, $current_db_pass))
{
$passOK = 'ok';
}

else 
{
header("Location: khojhai_pass_setting.php?err=2");
exit();
}


// Check if the pass or email exists in database
$qry_wrap2 = mysqli_query($con, "SELECT * FROM users WHERE (id = '$sess_id' AND password = '$current_db_pass' AND email = '$sess_email') ");

$qry_count2 = mysqli_num_rows($qry_wrap2);

if($qry_count2 < 1)
{
header("Location: khojhai_pass_setting.php?err=2");
exit();
}



if($passOK == 'ok')
{
$pass_hash = $pass2;

$final_pass = password_hash($pass_hash, PASSWORD_BCRYPT, array('cost' => 10));
	
mysqli_query($con, "UPDATE users SET password = '$final_pass' WHERE (id = '$sess_id' and email = '$sess_email' and password = '$current_db_pass') ");

header("Location: khojhai_pass_setting.php?err=4");
exit();
}


else
{
header("Location: khojhai_pass_setting.php?err=2");
exit();	
}

   
    }
   
    
else
{
header("Location: khojhai_home.php");
exit();	
}
				     
?>	