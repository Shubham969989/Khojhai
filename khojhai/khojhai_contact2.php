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

$see_mail = $dbemail;

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
header("Location: khojhai_contact.php?err=1");
exit();
}

if(empty($_POST['submit']))
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if($_POST['submit'] == "")
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if(!preg_match('/^[A-Z][a-z]{1,4}$/', $_POST['submit'])) 
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if(!(preg_match('/^[A-Z][a-z]{1,4}$/', $_POST['submit'])))
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if($_POST['submit'] != 'Send')
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if(strlen($_POST['submit']) > 4)
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if(strlen($_POST['submit']) < 4)
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if(!(isset($_POST['submit'])))
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if(preg_match('/^[\s]{1,4}$/', $_POST['submit']))
{
header("Location: khojhai_contact.php?err=1");
exit();
}



//-------- 2.desc

if(preg_match('/^[0]{1,1}$/', $_POST['desc']))
{
header("Location: khojhai_contact.php?err=7");
exit();
}

if(!($_POST['desc']))
{
header("Location: khojhai_contact.php?err=5");
exit();
}

if(empty($_POST['desc']))
{
header("Location: khojhai_contact.php?err=5");
exit();
}

if($_POST['desc'] == "")
{
header("Location: khojhai_contact.php?err=5");
exit();
}

if(!(isset($_POST['desc'])))
{
header("Location: khojhai_contact.php?err=5");
exit();
}

if(preg_match('/^[\s]{1,300}$/', $_POST['desc']))
{
header("Location: khojhai_contact.php?err=5");
exit();
}

if(strlen($_POST['desc']) > 300)
{
header("Location: khojhai_contact.php?err=5");
exit();
}

if(strlen($_POST['desc']) < 1)
{
header("Location: khojhai_contact.php?err=5");
exit();
}



//-------- 3.email

if(!($_POST['email']))
{
header("Location: khojhai_contact.php?err=4");
exit();
}

if(empty($_POST['email']))
{
header("Location: khojhai_contact.php?err=4");
exit();
}

if($_POST['email'] == "")
{
header("Location: khojhai_contact.php?err=4");
exit();
}

if(!(isset($_POST['email'])))
{
header("Location: khojhai_contact.php?err=4");
exit();
}

if(preg_match('/^[\s]{1,65}$/', $_POST['email']))
{
header("Location: khojhai_contact.php?err=4");
exit();
}

if(strlen($_POST['email']) > 65)
{
header("Location: khojhai_contact.php?err=4");
exit();
}

if(strlen($_POST['email']) < 1)
{
header("Location: khojhai_contact.php?err=4");
exit();
}




//-------- 4.name

if(preg_match('/^[0]{1,1}$/', $_POST['name']))
{
header("Location: khojhai_contact.php?err=7");
exit();
}

if(!($_POST['name']))
{
header("Location: khojhai_contact.php?err=3");
exit();
}

if(empty($_POST['name']))
{
header("Location: khojhai_contact.php?err=3");
exit();
}

if($_POST['name'] == "")
{
header("Location: khojhai_contact.php?err=3");
exit();
}

if(!(isset($_POST['name'])))
{
header("Location: khojhai_contact.php?err=3");
exit();
}

if(preg_match('/^[\s]{1,25}$/', $_POST['name']))
{
header("Location: khojhai_contact.php?err=3");
exit();
}

if(strlen($_POST['name']) > 25)
{
header("Location: khojhai_contact.php?err=3");
exit();
}

if(strlen($_POST['name']) < 1)
{
header("Location: khojhai_contact.php?err=3");
exit();
}

if(!preg_match('/^[A-Za-z\s]{1,25}$/', $_POST['name'])) 
{
header("Location: khojhai_contact.php?err=2");
exit();
}

if(!(preg_match('/^[A-Za-z\s]{1,25}$/', $_POST['name'])))
{
header("Location: khojhai_contact.php?err=2");
exit();
}



$name = mysqli_real_escape_string($con, $_POST['name']);

$email = mysqli_real_escape_string($con, $_POST['email']);

$desc = mysqli_real_escape_string($con, $_POST['desc']);

$submit = mysqli_real_escape_string($con, $_POST['submit']);



if(isset($submit, $desc, $email, $name))
{

//------------------ Validation Again, Not Required Though

//-------- 1. Submit Button

if(!($_POST['submit']))
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if(empty($_POST['submit']))
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if($_POST['submit'] == "")
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if(!preg_match('/^[A-Z][a-z]{1,4}$/', $_POST['submit'])) 
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if(!(preg_match('/^[A-Z][a-z]{1,4}$/', $_POST['submit'])))
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if($_POST['submit'] != 'Send')
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if(strlen($_POST['submit']) > 4)
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if(strlen($_POST['submit']) < 4)
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if(!(isset($_POST['submit'])))
{
header("Location: khojhai_contact.php?err=1");
exit();
}

if(preg_match('/^[\s]{1,4}$/', $_POST['submit']))
{
header("Location: khojhai_contact.php?err=1");
exit();
}



//-------- 2.desc

if(preg_match('/^[0]{1,1}$/', $_POST['desc']))
{
header("Location: khojhai_contact.php?err=7");
exit();
}

if(!($_POST['desc']))
{
header("Location: khojhai_contact.php?err=5");
exit();
}

if(empty($_POST['desc']))
{
header("Location: khojhai_contact.php?err=5");
exit();
}

if($_POST['desc'] == "")
{
header("Location: khojhai_contact.php?err=5");
exit();
}

if(!(isset($_POST['desc'])))
{
header("Location: khojhai_contact.php?err=5");
exit();
}

if(preg_match('/^[\s]{1,300}$/', $_POST['desc']))
{
header("Location: khojhai_contact.php?err=5");
exit();
}

if(strlen($_POST['desc']) > 300)
{
header("Location: khojhai_contact.php?err=5");
exit();
}

if(strlen($_POST['desc']) < 1)
{
header("Location: khojhai_contact.php?err=5");
exit();
}



//-------- 3.email

if(!($_POST['email']))
{
header("Location: khojhai_contact.php?err=4");
exit();
}

if(empty($_POST['email']))
{
header("Location: khojhai_contact.php?err=4");
exit();
}

if($_POST['email'] == "")
{
header("Location: khojhai_contact.php?err=4");
exit();
}

if(!(isset($_POST['email'])))
{
header("Location: khojhai_contact.php?err=4");
exit();
}

if(preg_match('/^[\s]{1,65}$/', $_POST['email']))
{
header("Location: khojhai_contact.php?err=4");
exit();
}

if(strlen($_POST['email']) > 65)
{
header("Location: khojhai_contact.php?err=4");
exit();
}

if(strlen($_POST['email']) < 1)
{
header("Location: khojhai_contact.php?err=4");
exit();
}




//-------- 4.name

if(!($_POST['name']))
{
header("Location: khojhai_contact.php?err=3");
exit();
}

if(empty($_POST['name']))
{
header("Location: khojhai_contact.php?err=3");
exit();
}

if($_POST['name'] == "")
{
header("Location: khojhai_contact.php?err=3");
exit();
}

if(!(isset($_POST['name'])))
{
header("Location: khojhai_contact.php?err=3");
exit();
}

if(preg_match('/^[\s]{1,25}$/', $_POST['name']))
{
header("Location: khojhai_contact.php?err=3");
exit();
}

if(strlen($_POST['name']) > 25)
{
header("Location: khojhai_contact.php?err=3");
exit();
}

if(strlen($_POST['name']) < 1)
{
header("Location: khojhai_contact.php?err=3");
exit();
}

if(!preg_match('/^[A-Za-z\s]{1,25}$/', $_POST['name'])) 
{
header("Location: khojhai_contact.php?err=2");
exit();
}

if(!(preg_match('/^[A-Za-z\s]{1,25}$/', $_POST['name'])))
{
header("Location: khojhai_contact.php?err=2");
exit();
}



$name = mysqli_real_escape_string($con, $_POST['name']);

$email = mysqli_real_escape_string($con, $_POST['email']);

$desc = mysqli_real_escape_string($con, $_POST['desc']);

$submit = mysqli_real_escape_string($con, $_POST['submit']);



$qry1 = mysqli_query($con, "INSERT INTO contact_us (name, email, description, sent_on) VALUES ('$name', '$email', '$desc', NOW())");

header("Location: khojhai_contact.php?err=6");
exit();		

}
 
 
else
{
header("Location: khojhai_contact.php");
exit();
} 

?>