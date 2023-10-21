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
if(!($_GET['id']))
{
header("Location: khojhai_home.php");
exit();
}

if(empty($_GET['id']))
{
header("Location: khojhai_home.php");
exit();
}

if($_GET['id'] == "")
{
header("Location: khojhai_home.php");
exit();
}

if(!preg_match('/^[0-9]{1,200}$/', $_GET['id'])) 
{
header("Location: khojhai_home.php");
exit();
}

if(!(preg_match('/^[0-9]{1,200}$/', $_GET['id']))) 
{
header("Location: khojhai_home.php");
exit();
}

if(!(isset($_GET['id'])))
{
header("Location: khojhai_home.php");
exit();
}

if(preg_match('/^[\s]{1,200}$/', $_GET['id']))
{
header("Location: khojhai_home.php");
exit();	
}

if(preg_match('/^[0][0-9]{1,200}$/', $_GET['id']))
{
header("Location: khojhai_home.php?go_back");
exit();	
}



$get_id = preg_replace('#[^0-9]#', '', $_GET['id']);

$get_id = mysqli_real_escape_string($con, $get_id);

if(isset($get_id))
{

if(!($get_id))
{
header("Location: khojhai_home.php");
exit();
}

if(empty($get_id))
{
header("Location: khojhai_home.php");
exit();
}

if($get_id == "")
{
header("Location: khojhai_home.php");
exit();
}

if(!preg_match('/^[0-9]{1,200}$/', $get_id)) 
{
header("Location: khojhai_home.php");
exit();
}

if(!(preg_match('/^[0-9]{1,200}$/', $get_id))) 
{
header("Location: khojhai_home.php");
exit();
}

if(!(isset($get_id)))
{
header("Location: khojhai_home.php");
exit();
}

if(preg_match('/^[\s]{1,200}$/', $get_id))
{
header("Location: khojhai_home.php");
exit();	
}


	
$qry0 = mysqli_query($con, "select * from cases where id = '$get_id' ");

$qry_count0 = mysqli_num_rows($qry0);

if($qry_count0 < 1)
{
header("Location: khojhai_home.php");
exit();
}

$qry_ftch0 = mysqli_fetch_array($qry0);

//case id
$case_id = $qry_ftch0['id'];

$case_id = mysqli_real_escape_string($con, $case_id);


//case_image name and folders/files
$case_img_name = $qry_ftch0['case_image'];

$picurl = "case_image/$case_id/$case_img_name";

$picurl2 = "case_image/$case_id";


//added by id 
$added_by = $qry_ftch0['added_by_id'];

$added_by = mysqli_real_escape_string($con, $added_by);


//follower_id
$sess_id = $sess_id;



$qry1 = mysqli_query($con, "SELECT * FROM cases WHERE id = '$case_id' AND added_by_id = '$sess_id'");
	
$qry_count1 = mysqli_num_rows($qry1);
	
	if($qry_count1 < 1)
	{
		header("Location: khojhai_home.php?error");
		exit();				
	}	
	
	else
	{
		if(file_exists($picurl))
        {
            unlink($picurl);	
            rmdir($picurl2);
        }

        elseif(file_exists($picurl2))
        {
            rmdir($picurl2);	
        }	
        
		else
		{
		    unlink($picurl);	
            rmdir($picurl2);
		}

        mysqli_query($con, "DELETE FROM case_reports WHERE case_id = '$case_id' ");
        
		mysqli_query($con, "DELETE FROM case_followers WHERE case_id = '$case_id' ");
		
		mysqli_query($con, "DELETE FROM cases WHERE id = '$case_id' ");
		
		header("Location: khojhai_add_missing.php?err=10....");
		exit();
	}			
}

else
{
header("Location: khojhai_home.php");
exit();
}

?>