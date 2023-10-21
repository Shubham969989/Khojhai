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

//-------- 1. Submit Button

if(!($_POST['submit']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['submit']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['submit'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[A-Z][a-z]{1,4}$/', $_POST['submit'])) 
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['submit'] != 'Post')
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(strlen($_POST['submit']) > 4)
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(strlen($_POST['submit']) < 4)
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(!(isset($_POST['submit'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,4}$/', $_POST['submit']))
{
header("Location: khojhai_add_missing.php");
exit();	
}
	

//-------- 2. Contact Person number
if(preg_match('/^[0]{1,1}$/', $_POST['contact_p_num']))
{
header("Location: khojhai_add_missing.php?err=11");
exit();	
}

if(!($_POST['contact_p_num']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['contact_p_num']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['contact_p_num'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[0-9]{1,25}$/', $_POST['contact_p_num'])) 
{
header("Location: khojhai_add_missing.php?err=2");
exit();
}

if(strlen($_POST['contact_p_num']) > 25)
{
header("Location: khojhai_add_missing.php?err=2");
exit();	
}

if(strlen($_POST['contact_p_num']) < 1)
{
header("Location: khojhai_add_missing.php?err=2");
exit();	
}

if(!(isset($_POST['contact_p_num'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,25}$/', $_POST['contact_p_num']))
{
header("Location: khojhai_add_missing.php");
exit();	
}
	
	
//-------- 3. Contact Person name

if(!($_POST['contact_p_name']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['contact_p_name']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['contact_p_name'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[A-Za-z\s]{1,25}$/', $_POST['contact_p_name'])) 
{
header("Location: khojhai_add_missing.php?err=3");
exit();
}

if(strlen($_POST['contact_p_name']) > 25)
{
header("Location: khojhai_add_missing.php?err=3");
exit();	
}

if(strlen($_POST['contact_p_name']) < 1)
{
header("Location: khojhai_add_missing.php?err=3");
exit();	
}

if(!(isset($_POST['contact_p_name'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,25}$/', $_POST['contact_p_name']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 4. Missing Person Image

if(!($_FILES['avatar']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_FILES['avatar']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_FILES['avatar'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!(isset($_FILES['avatar'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}



//-------- 5. Description

if(preg_match('/^[0]{1,1}$/', $_POST['desc']))
{
header("Location: khojhai_add_missing.php?err=11");
exit();	
}

if(!($_POST['desc']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['desc']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['desc'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(strlen($_POST['desc']) > 300)
{
header("Location: khojhai_add_missing.php?err=4");
exit();	
}

if(strlen($_POST['desc']) < 1)
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(!(isset($_POST['desc'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,300}$/', $_POST['desc'])) 
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}


//-------- 6. Missing Year

if(!($_POST['year2']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['year2']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['year2'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[a-z0-9]{1,7}$/', $_POST['year2'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['year2']) > 6)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['year2']) < 1)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['year2'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,6}$/', $_POST['year2']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 7. Missing month

if(!($_POST['month2']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['month2']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['month2'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[0-9]{2,2}$/', $_POST['month2'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['month2']) > 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['month2']) < 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['month2'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,2}$/', $_POST['month2']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 8. Missing date

if(!($_POST['date2']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['date2']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['date2'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[0-9]{2,2}$/', $_POST['date2'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['date2']) > 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['date2']) < 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['date2'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,2}$/', $_POST['date2']))
{
header("Location: khojhai_add_missing.php");
exit();	
}

//-------- 9. State

if(!($_POST['state']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['state']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['state'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[A-Za-z\s]{1,50}$/', $_POST['state'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['state']) > 50)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['state']) < 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['state'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,50}$/', $_POST['state']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 10. Address

if(preg_match('/^[0]{1,1}$/', $_POST['adrs']))
{
header("Location: khojhai_add_missing.php?err=11");
exit();	
}

if(!($_POST['adrs']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['adrs']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['adrs'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(strlen($_POST['adrs']) > 200)
{
header("Location: khojhai_add_missing.php?err=5");
exit();	
}

if(strlen($_POST['adrs']) < 1)
{
header("Location: khojhai_add_missing.php?err=5");
exit();	
}

if(!(isset($_POST['adrs'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,200}$/', $_POST['adrs'])) 
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(preg_match('/^[\s]{1,200}$/', $_POST['adrs']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}


//-------- 11. age (Year)

if(!($_POST['year']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['year']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['year'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[0-9]{1,5}$/', $_POST['year'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['year']) > 5)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['year']) < 1)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['year'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,5}$/', $_POST['year']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 12. age (month)

if(!($_POST['month']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['month']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['month'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[0-9]{2,2}$/', $_POST['month'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['month']) > 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['month']) < 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['month'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,2}$/', $_POST['month']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 13. age (date)

if(!($_POST['date']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['date']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['date'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[0-9]{2,2}$/', $_POST['date'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['date']) > 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['date']) < 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['date'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,2}$/', $_POST['date']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 14. Gender

if(!($_POST['gender']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['gender']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['gender'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[a-z]{2,7}$/', $_POST['gender'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['gender']) > 7)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['gender']) < 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['gender'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,7}$/', $_POST['gender']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 15. Missing Person name

if(!($_POST['name']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['name']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['name'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[A-Za-z\s]{1,25}$/', $_POST['name'])) 
{
header("Location: khojhai_add_missing.php?err=3");
exit();
}

if(strlen($_POST['name']) > 25)
{
header("Location: khojhai_add_missing.php?err=3");
exit();	
}

if(strlen($_POST['name']) < 1)
{
header("Location: khojhai_add_missing.php?err=3");
exit();	
}

if(!(isset($_POST['name'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,25}$/', $_POST['name']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}



$submit = mysqli_real_escape_string($con, $_POST['submit']);

$contact_p_num = mysqli_real_escape_string($con, $_POST['contact_p_num']);

$contact_p_name = mysqli_real_escape_string($con, $_POST['contact_p_name']);

//$avatar = mysqli_real_escape_string($con, $_FILES['avatar']);

$desc = mysqli_real_escape_string($con, $_POST['desc']);

$year2 = mysqli_real_escape_string($con, $_POST['year2']);

$month2 = mysqli_real_escape_string($con, $_POST['month2']);

$date2 = mysqli_real_escape_string($con, $_POST['date2']);

$state = mysqli_real_escape_string($con, $_POST['state']);

$adrs = mysqli_real_escape_string($con, $_POST['adrs']);

$year = mysqli_real_escape_string($con, $_POST['year']);

$month = mysqli_real_escape_string($con, $_POST['month']);

$date = mysqli_real_escape_string($con, $_POST['date']);

$gender = mysqli_real_escape_string($con, $_POST['gender']);

$name = mysqli_real_escape_string($con, $_POST['name']);



if(isset($submit, $contact_p_num, $contact_p_name, $desc, $year2, $month2, $date2, $state, $adrs, $year, $month, $date, $gender, $name))
{
                         
						 //----------- VALIDATION AGAIN FOR ADDITIONAL SECURITY, NOT REQUIRED THOUGH -------------//
	 
//-------- 1. Submit Button

if(!($_POST['submit']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['submit']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['submit'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[A-Z][a-z]{1,4}$/', $_POST['submit'])) 
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!(preg_match('/^[A-Z][a-z]{1,4}$/', $_POST['submit']))) 
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['submit'] != 'Post')
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(strlen($_POST['submit']) > 4)
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(strlen($_POST['submit']) < 4)
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(!(isset($_POST['submit'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,4}$/', $_POST['submit']))
{
header("Location: khojhai_add_missing.php");
exit();	
}
	

//-------- 2. Contact Person number

if(!($_POST['contact_p_num']))
{
header("Location: khojhai_add_missing.php?err=1..");
exit();
}

if(empty($_POST['contact_p_num']))
{
header("Location: khojhai_add_missing.php?err=1..");
exit();
}

if($_POST['contact_p_num'] == "")
{
header("Location: khojhai_add_missing.php?err=1..");
exit();
}

if(!preg_match('/^[0-9]{1,25}$/', $_POST['contact_p_num'])) 
{
header("Location: khojhai_add_missing.php?err=2");
exit();
}

if(!(preg_match('/^[0-9]{1,25}$/', $_POST['contact_p_num']))) 
{
header("Location: khojhai_add_missing.php?err=2");
exit();
}

if(strlen($_POST['contact_p_num']) > 25)
{
header("Location: khojhai_add_missing.php?err=2");
exit();	
}

if(strlen($_POST['contact_p_num']) < 1)
{
header("Location: khojhai_add_missing.php?err=2");
exit();	
}

if(!(isset($_POST['contact_p_num'])))
{
header("Location: khojhai_add_missing.php?err=1....");
exit();	
}

if(preg_match('/^[\s]{1,25}$/', $_POST['contact_p_num']))
{
header("Location: khojhai_add_missing.php");
exit();	
}

	
	
//-------- 3. Contact Person name

if(!($_POST['contact_p_name']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['contact_p_name']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['contact_p_name'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[A-Za-z\s]{1,25}$/', $_POST['contact_p_name'])) 
{
header("Location: khojhai_add_missing.php?err=3");
exit();
}

if(!(preg_match('/^[A-Za-z\s]{1,25}$/', $_POST['contact_p_name']))) 
{
header("Location: khojhai_add_missing.php?err=3");
exit();
}

if(strlen($_POST['contact_p_name']) > 25)
{
header("Location: khojhai_add_missing.php?err=3");
exit();	
}

if(strlen($_POST['contact_p_name']) < 1)
{
header("Location: khojhai_add_missing.php?err=3");
exit();	
}

if(!(isset($_POST['contact_p_name'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,25}$/', $_POST['contact_p_name']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}


//-------- 4. Missing Person Image

if(!($_FILES['avatar']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_FILES['avatar']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_FILES['avatar'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!(isset($_FILES['avatar'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}



//-------- 5. Description

if(!($_POST['desc']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['desc']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['desc'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(strlen($_POST['desc']) > 300)
{
header("Location: khojhai_add_missing.php?err=4");
exit();	
}

if(strlen($_POST['desc']) < 1)
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(!(isset($_POST['desc'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,300}$/', $_POST['desc']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}


//-------- 6. Missing Year

if(!($_POST['year2']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['year2']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['year2'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[a-z0-9]{1,7}$/', $_POST['year2'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(!(preg_match('/^[a-z0-9]{1,7}$/', $_POST['year2'])))
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['year2']) > 6)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['year2']) < 1)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['year2'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,6}$/', $_POST['year2']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 7. Missing month

if(!($_POST['month2']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['month2']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['month2'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[0-9]{2,2}$/', $_POST['month2'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(!(preg_match('/^[0-9]{2,2}$/', $_POST['month2'])))
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['month2']) > 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['month2']) < 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['month2'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,2}$/', $_POST['month2']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 8. Missing date

if(!($_POST['date2']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['date2']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['date2'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[0-9]{2,2}$/', $_POST['date2'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(!(preg_match('/^[0-9]{2,2}$/', $_POST['date2'])))
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['date2']) > 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['date2']) < 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['date2'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,2}$/', $_POST['date2']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 9. State

if(!($_POST['state']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['state']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['state'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[A-Za-z\s]{1,50}$/', $_POST['state'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(!(preg_match('/^[A-Za-z\s]{1,50}$/', $_POST['state']))) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['state']) > 50)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['state']) < 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['state'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,50}$/', $_POST['state']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 10. Address

if(!($_POST['adrs']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['adrs']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['adrs'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(strlen($_POST['adrs']) > 200)
{
header("Location: khojhai_add_missing.php?err=5");
exit();	
}

if(strlen($_POST['adrs']) < 1)
{
header("Location: khojhai_add_missing.php?err=5");
exit();	
}

if(!(isset($_POST['adrs'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,200}$/', $_POST['adrs']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}


//-------- 11. age (Year)

if(!($_POST['year']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['year']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['year'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[0-9]{1,5}$/', $_POST['year'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(!(preg_match('/^[0-9]{1,5}$/', $_POST['year']))) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['year']) > 5)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['year']) < 1)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['year'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,5}$/', $_POST['year']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 12. age (month)

if(!($_POST['month']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['month']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['month'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[0-9]{2,2}$/', $_POST['month'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(!(preg_match('/^[0-9]{2,2}$/', $_POST['month'])))
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['month']) > 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['month']) < 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['month'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,2}$/', $_POST['month']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 13. age (date)

if(!($_POST['date']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['date']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['date'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[0-9]{2,2}$/', $_POST['date'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(!(preg_match('/^[0-9]{2,2}$/', $_POST['date'])))
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['date']) > 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['date']) < 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['date'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,2}$/', $_POST['date']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 14. Gender

if(!($_POST['gender']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['gender']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['gender'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[a-z]{2,7}$/', $_POST['gender'])) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(!(preg_match('/^[a-z]{2,7}$/', $_POST['gender']))) 
{
header("Location: khojhai_add_missing.php?err");
exit();
}

if(strlen($_POST['gender']) > 7)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(strlen($_POST['gender']) < 2)
{
header("Location: khojhai_add_missing.php?err");
exit();	
}

if(!(isset($_POST['gender'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,7}$/', $_POST['gender']))
{
header("Location: khojhai_add_missing.php");
exit();	
}


//-------- 15. Missing Person name

if(!($_POST['name']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(empty($_POST['name']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if($_POST['name'] == "")
{
header("Location: khojhai_add_missing.php?err=1");
exit();
}

if(!preg_match('/^[A-Za-z\s]{1,25}$/', $_POST['name'])) 
{
header("Location: khojhai_add_missing.php?err=3");
exit();
}

if(!(preg_match('/^[A-Za-z\s]{1,25}$/', $_POST['name']))) 
{
header("Location: khojhai_add_missing.php?err=3");
exit();
}

if(strlen($_POST['name']) > 25)
{
header("Location: khojhai_add_missing.php?err=3");
exit();	
}

if(strlen($_POST['name']) < 1)
{
header("Location: khojhai_add_missing.php?err=3");
exit();	
}

if(!(isset($_POST['name'])))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}

if(preg_match('/^[\s]{1,25}$/', $_POST['name']))
{
header("Location: khojhai_add_missing.php?err=1");
exit();	
}


$submit = mysqli_real_escape_string($con, $_POST['submit']);

$contact_p_num = mysqli_real_escape_string($con, $_POST['contact_p_num']);

$contact_p_name = mysqli_real_escape_string($con, $_POST['contact_p_name']);

//$avatar = mysqli_real_escape_string($con, $_FILES['avatar']);

$desc = mysqli_real_escape_string($con, $_POST['desc']);

$year2 = mysqli_real_escape_string($con, $_POST['year2']);

$month2 = mysqli_real_escape_string($con, $_POST['month2']);

$date2 = mysqli_real_escape_string($con, $_POST['date2']);

$state = mysqli_real_escape_string($con, $_POST['state']);

$adrs = mysqli_real_escape_string($con, $_POST['adrs']);

$year = mysqli_real_escape_string($con, $_POST['year']);

$month = mysqli_real_escape_string($con, $_POST['month']);

$date = mysqli_real_escape_string($con, $_POST['date']);

$gender = mysqli_real_escape_string($con, $_POST['gender']);

$name = mysqli_real_escape_string($con, $_POST['name']);


if($year2 == "before")
{
	$date_missing = "Before 1928";
}	

else
{
    $date_missing = "$year2-$month2-$date2";
}

$sess_id = $user_id;

$submit = $submit;

$contact_p_num = $contact_p_num;

$contact_p_name = ucwords($contact_p_name);

//$avatar = $avatar;

$desc = ucwords($desc);

$date_missing = $date_missing;

$state = ucwords($state);

$adrs = $adrs;

$age = "$year-$month-$date";

$gender = ucwords($gender);

$name = ucwords($name);



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
header("Location: khojhai_add_missing.php?err=6");
exit();	
}	
 
$db_file_name = rand(100000000000, 999999999999).".".$fileExt;

if($fileSize > 1073741824)
{
header("Location: khojhai_add_missing.php?err=7");
exit();		
}

elseif (!preg_match("/\.(gif|jpg|png|jpeg)$/i", $fileName))
{
header("Location: khojhai_add_missing.php?err=8");
exit();		
}

elseif($fileErrorMsg == 1)
{
header("Location: khojhai_add_missing.php?err=9");
exit();				
}



$qry1 = mysqli_query($con, "INSERT INTO cases (name, gender, age, address, state, date_missing, description, case_image, contact_person_name, contact_person_number, added_by_id, 

added_on, status) 

VALUES (N'$name', N'$gender', N'$age', N'$adrs', N'$state', N'$date_missing', N'$desc', N'$db_file_name', N'$contact_p_name', N'$contact_p_num', N'$sess_id', NOW(), 'Open') ");

$last_id = mysqli_insert_id($con);

$avatar_id = $last_id;

$picurl = "case_image/$avatar_id/$db_file_name";

$picurl2 = "case_image/$avatar_id";

if(file_exists($picurl))
{
unlink($picurl);	

rmdir($picurl2);
}

elseif(file_exists($picurl2))
{
rmdir($picurl2);	
}	
  
mkdir("case_image/$avatar_id", 0755);
  
$moveResult = move_uploaded_file($fileTmpLoc, "case_image/$avatar_id/$db_file_name");

if($moveResult != true)
{
header("Location: khojhai_add_missing.php?err=9");
exit();				
}	

header("Location: khojhai_view_missing.php?id=$avatar_id&err=1");
exit();		

 }
 
else
{
header("Location: khojhai_add_missing.php?err=1");
exit();
} 

     }
	 
else
{
header("Location: khojhai_add_missing.php?err=1");
exit();
} 	 

?>