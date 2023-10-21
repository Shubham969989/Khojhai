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
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(empty($_POST['submit']))
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if($_POST['submit'] == "")
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(!preg_match('/^[A-Z][a-z]{1,6}$/', $_POST['submit'])) 
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if($_POST['submit'] != 'Upload')
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(strlen($_POST['submit']) > 6)
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(strlen($_POST['submit']) < 6)
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(!(isset($_POST['submit'])))
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(preg_match('/^[\s]{1,6}$/', $_POST['submit']))
{
header("Location: khojhai_edit_profile_pic.php");
exit();	
}


//-------- 4. Missing Person Image

if(!($_FILES['avatar']))
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(empty($_FILES['avatar']))
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if($_FILES['avatar'] == "")
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(!(isset($_FILES['avatar'])))
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}



$submit = mysqli_real_escape_string($con, $_POST['submit']);

if(isset($submit))
{
                         
						 //----------- VALIDATION AGAIN FOR ADDITIONAL SECURITY, NOT REQUIRED THOUGH -------------//
	 
//-------- 1. Submit Button

if(!($_POST['submit']))
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(empty($_POST['submit']))
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if($_POST['submit'] == "")
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(!preg_match('/^[A-Z][a-z]{1,6}$/', $_POST['submit'])) 
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if($_POST['submit'] != 'Upload')
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(strlen($_POST['submit']) > 6)
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(strlen($_POST['submit']) < 6)
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(!(isset($_POST['submit'])))
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(preg_match('/^[\s]{1,6}$/', $_POST['submit']))
{
header("Location: khojhai_edit_profile_pic.php");
exit();	
}



//-------- 4. Missing Person Image

if(!($_FILES['avatar']))
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(empty($_FILES['avatar']))
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if($_FILES['avatar'] == "")
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}

if(!(isset($_FILES['avatar'])))
{
header("Location: khojhai_edit_profile_pic.php");
exit();
}



if(isset($_FILES["avatar"] ["name"]) && $_FILES["avatar"] ["tmp_name"] != "")
{
	
$fileName = $_FILES["avatar"] ["name"];
$fileTmpLoc = $_FILES["avatar"] ["tmp_name"];
$fileType = $_FILES["avatar"] ["type"];
$fileSize = $_FILES["avatar"] ["size"];
$fileErrorMsg = $_FILES["avatar"] ["error"];
$kaboom = explode(".", $fileName);

$fileExt = end($kaboom);

list($width, $height) = getimagesize($fileTmpLoc);

if($width < 10 || $height < 10)
{
header("Location: khojhai_edit_profile_pic.php?err=1");
exit();
}	
 
$db_file_name = rand(100000000000, 999999999999).".".$fileExt;

if($fileSize > 1073741824)
{
header("Location: khojhai_edit_profile_pic.php?err=2");
exit();		
}

elseif (!preg_match("/\.(gif|jpg|png|jpeg)$/i", $fileName))
{
header("Location: khojhai_edit_profile_pic.php?err=3");
exit();			
}

elseif($fileErrorMsg == 1)
{
header("Location: khojhai_edit_profile_pic.php?err=4");
exit();						
}



$qry1 = mysqli_query($con, "select id, profile_pic from users where id = '$sess_id' LIMIT 1");

$qry_count1 = mysqli_num_rows($qry1);

if($qry_count1 < 1)
{
session_destroy();
session_unset();

header("Location: khojhai_signup.php");
exit();	
}

$qry_ftch1 = mysqli_fetch_array($qry1);

$avatar_id = $qry_ftch1['id'];

$avatar = $qry_ftch1['profile_pic'];

if($avatar != "")
{
$picurl = "profile_pic/$avatar_id/$avatar";

if(file_exists($picurl))
{
unlink($picurl);	
}	
 
  }
  
$moveResult = move_uploaded_file($fileTmpLoc, "profile_pic/$avatar_id/$db_file_name");

if($moveResult != true)
{
header("Location: khojhai_edit_profile_pic.php?err=4");
exit();					
}	


$qry2 = mysqli_query($con, "UPDATE users SET profile_pic = '$db_file_name' WHERE id = '$sess_id' LIMIT 1 ");

header("Location: khojhai_edit_profile_pic.php?err=5");
exit();		

}
 
else
{
header("Location: khojhai_edit_profile_pic.php");
exit();	
} 

     }
	 
else
{
header("Location: khojhai_edit_profile_pic.php");
exit();	
} 	 

?>