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


<!-- PHP START -->
<?php 
if(!($_POST['submit']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(!(isset($_POST['submit'])))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(empty($_POST['submit']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}



if(isset($_POST['submit']))
{

if(!($_POST['name']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(!($_POST['gender']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(!($_POST['year']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(!($_POST['month']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(!($_POST['date']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(!($_POST['email']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(!($_POST['password']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(!($_POST['submit']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}



if(empty($_POST['name']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(empty($_POST['gender']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(empty($_POST['year']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(empty($_POST['month']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(empty($_POST['date']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(empty($_POST['email']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(empty($_POST['password']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if(empty($_POST['submit']))
{
header("Location: khojhai_signup.php?err=1");
exit();
}



if($_POST['name'] == '')
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if($_POST['gender'] == '')
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if($_POST['year'] == '')
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if($_POST['month'] == '')
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if($_POST['date'] == '')
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if($_POST['email'] == '')
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if($_POST['password'] == '')
{
header("Location: khojhai_signup.php?err=1");
exit();
}

if($_POST['submit'] == '')
{
header("Location: khojhai_signup.php?err=1");
exit();
}



if(!(preg_match('/^[a-zA-Z\s]{1,20}$/', $_POST['name'])))
{
header("Location: khojhai_signup.php?err=2");
exit();
}

if(!preg_match('/^[a-zA-Z\s]{1,20}$/', $_POST['name']))
{
header("Location: khojhai_signup.php?err=2");
exit();
}

if(preg_match('/^[\s]{1,20}$/', $_POST['name']))
{
header("Location: khojhai_signup.php?err=3.....");
exit();
}

if(!(preg_match('/^[A-Za-z]{3,7}$/', $_POST['gender'])))
{
header("Location: khojhai_signup.php?err=8");
exit();
}

if(!(preg_match('/^[0-9]{1,5}$/', $_POST['year'])))
{
header("Location: khojhai_signup.php?err=8");
exit();
}

if(!(preg_match('/^[0-9]{1,10}$/', $_POST['month'])))
{
header("Location: khojhai_signup.php?err=8");
exit();
}

if(!(preg_match('/^[0-9]{1,5}$/', $_POST['date'])))
{
header("Location: khojhai_signup.php?err=8");
exit();
}

if(!preg_match('/^[0-9A-Za-z]{6,35}$/', $_POST['password']))
{
header("Location: khojhai_signup.php?err=6");
exit();
}

if(!(preg_match('/^[0-9A-Za-z]{6,35}$/', $_POST['password'])))
{
header("Location: khojhai_signup.php?err=6");
exit();
}

if(preg_match('/^[\s]{1,35}$/', $_POST['password']))
{
header("Location: khojhai_signup.php");
exit();
}


if(strlen($_POST['email']) > 65)
{
header("Location: khojhai_signup.php?err=9");
exit();
}

if(strlen($_POST['email']) < 1)
{
header("Location: khojhai_signup.php?err=9");
exit();
}



if(preg_match('/^[\s]{1,1}$/', $_POST['password']))
{
header("Location: khojhai_signup.php?err=6");
exit();
}

if(!preg_match('/^[A-Za-z\!\s]{1,15}$/', $_POST['submit'])) 
{
header("Location: khojhai_signup.php?err=8");
exit();
}

if(!(preg_match('/^[A-Za-z\!\s]{1,15}$/', $_POST['submit']))) 
{
header("Location: khojhai_signup.php?err=8");
exit();
}



if($_POST['password'] == "123123")
{
header("Location: khojhai_signup.php?err=7");
exit();
}

if($_POST['password'] == "123456")
{
header("Location: khojhai_signup.php?err=7");
exit();
}

if($_POST['password'] == "111111")
{
header("Location: khojhai_signup.php?err=7");
exit();
}

if($_POST['password'] == "222222")
{
header("Location: khojhai_signup.php?err=7");
exit();
}

if($_POST['password'] == "333333")
{
header("Location: khojhai_signup.php?err=7");
exit();
}

if($_POST['password'] == "444444")
{
header("Location: khojhai_signup.php?err=7");
exit();
}

if($_POST['password'] == "555555")
{
header("Location: khojhai_signup.php?err=7");
exit();
}

if($_POST['password'] == "666666")
{
header("Location: khojhai_signup.php?err=7");
exit();
}

if($_POST['password'] == "777777")
{
header("Location: khojhai_signup.php?err=7");
exit();
}

if($_POST['password'] == "888888")
{
header("Location: khojhai_signup.php?err=7");
exit();
}

if($_POST['password'] == "999999")
{
header("Location: khojhai_signup.php?err=7");
exit();
}

if($_POST['password'] == "000000")
{
header("Location: khojhai_signup.php?err=7");
exit();
}

if($_POST['password'] == "abcdef")
{
header("Location: khojhai_signup.php?err=7");
exit();
}

if($_POST['password'] == "ABCDEF")
{
header("Location: khojhai_signup.php?err=7");
exit();
}

if($_POST['password'] == "121212")
{
header("Location: khojhai_signup.php?err=7");
exit();
}



$name = mysqli_real_escape_string($con, $_POST['name']);

$gender = mysqli_real_escape_string($con, $_POST['gender']);

$year = mysqli_real_escape_string($con, $_POST['year']);

$month = mysqli_real_escape_string($con, $_POST['month']);

$date = mysqli_real_escape_string($con, $_POST['date']);

$email = mysqli_real_escape_string($con, $_POST['email']);

$pass1 = mysqli_real_escape_string($con, $_POST['password']);

$submit = mysqli_real_escape_string($con, $_POST['submit']);



if($name && $gender && $year && $month && $date && $email && $pass1 && $submit)
{

//--------------- Declaration again ----------------//
$name = ucwords($name);

$gender = ucwords($gender);

$bdate = "$year-$month-$date";

$e1 = strtolower($email);

$e2 = strtoupper($email);

$login = mysqli_query($con, "SELECT * FROM users WHERE (email = '$email' OR email = '$e1' OR email = '$e2') ");

$result = mysqli_num_rows($login);

if($result > 0)
{
header("Location: khojhai_signup.php?err=4");
exit();
}

//----------- PASSWORD ENCRYPTION STARTS -------------////
$pass_hs1 = password_hash($pass1, PASSWORD_BCRYPT, array('cost' => 10));

//$join_on = NOW();

//------- name validation -------------//
if(strlen($name) < 1 || strlen($name) > 20) 
{
header("Location: khojhai_signup.php?err=2");
exit();
} 

if(is_numeric($name[0])) 
{
header("Location: khojhai_signup.php?err=2");
exit();
} 


//---------- Email Validation ----------------//
if(strlen($email) > 65)
{
header("Location: khojhai_signup.php?err=9");
exit();
}

if(strlen($email) < 1)
{
header("Location: khojhai_signup.php?err=9");
exit();
}


//----------------- Main query to insert the data in the users --------------/////////
$sql = mysqli_query($con, "insert into users (name, gender, age, email, password, profile_pic, join_on) 

values ('$name', '$gender', '$bdate', '$email', '$pass_hs1', '', NOW() );");

$ro_id = mysqli_insert_id($con);

if(!file_exists("profile_pic/$ro_id"))
{
	mkdir("profile_pic/$ro_id", 0755);
}

//below query will be used for "forgot password" logic...... currently commented.......///
$roi = mysqli_query($con, "insert into user_art (user_id, user_email, user_pass) values ('$ro_id', '$email', '');");	
	
   } 
		   
		else 
		{
	    header("Location: khojhai_signup.php?err=8");
        exit();
	    } 
		   }	               
      
	  
// Check email and password 
if(isset($_POST['submit']))
{
$email = mysqli_real_escape_string($con, $_POST['email']);
$pass1 = mysqli_real_escape_string($con, $_POST['password']);


if($email && $pass1)
{
$login = mysqli_query($con, "select * from users where email = '$email' ");

while ($log = mysqli_fetch_assoc($login))
{
$dbemail = $log['email'];
$dbpassword = $log['password'];
$user_id = $log['id'];
}
   }
	  }
	  
// After check Start Sessions	 
if(isset($_POST['submit']))
{
$email = mysqli_real_escape_string($con, $_POST['email']);
$pass1 = mysqli_real_escape_string($con, $_POST['password']);

if(password_verify($pass1, $dbpassword))
{
$pass_ver = 'ok';
}

else 
{
header("Location: khojhai_signup.php?err=8");
exit();
}

if($email == $dbemail)
{
$_SESSION['user_email'] = $dbemail;
$_SESSION['user_id'] = $user_id;
$_SESSION['user_password'] = $dbpassword;
}

else 
{
session_destroy();
session_unset();
	
header("Location: khojhai_signup.php?err=8");
exit();
}
  }
	 
	 
//Do this to redirect the user and start sessions after signup
if(isset($_POST['submit']))
{
$email = mysqli_real_escape_string($con, $_POST['email']);
$pass1 = mysqli_real_escape_string($con, $_POST['password']);

if($email == $dbemail)
{
$_SESSION['user_email'] = $dbemail;
$_SESSION['user_id'] = $user_id;
$_SESSION['user_password'] = $dbpassword;

if($_SESSION['user_email'] || $_SESSION['user_password'])
{

$sess = $_SESSION['user_id'];

$sql = "select * from users where id = '$sess' ";

$r = mysqli_query($con, $sql);

while ($row = mysqli_fetch_array($r))
{
	/**************
//send mail 
$email = mysqli_real_escape_string($con, $row['email']);

$naam = mysqli_real_escape_string($con, $row['name']);

$to = "$email";

$from = "Khojhai.com";

$headers ="From: $from\n";


$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1 \n";


$subject ="Thank You For Joining Khojhai.com";

//yyyyyyyyyyyy
$n2 = ucfirst($naam);
$n3 = explode(' ', $n2);
$n4 = $n3[0];
//yyyyyyyyyyyyy

$msg = '<h2>Hello '.$n4.'</h2>

<p>Thank you so much for joining us. Here you can ask questions to anyone, post your questions, publish your story or notes, make new friends, 

chat with friends and much more.</p>';

$mail = mail($to,$subject,$msg,$headers); 

if(!($mail))
{
session_destroy();
session_unset();

header("Location: khojhai_signup.php");
exit();	
}
//send mail		 
 *////////
header("Location: khojhai_signup3.php");
exit();
  
}
  } 
     }
        } 
		   
?>