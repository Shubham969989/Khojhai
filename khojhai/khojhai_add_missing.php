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

<!DOCTYPE html>

<html lang="en">

<head>

<title>Add Missing Person | KhojHai.com</title>

<!--  Meta tags starts -->

<meta name= "Keywords" content="" /> 

<meta name="Description" content="" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

<!--  Meta tags ends -->

<style>
*{
  box-sizing: border-box;
}
/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
*{margin:0px; padding:0px;}	
html, body{
overflow-x : hidden;	
}
.bdy{
background-color : #fff;	
}
.headr1{
position:fixed;
background-color : #151515;
width:100%;
max-width:100%;
padding-top : 13px;
padding-bottom : 8px;
border-bottom : 0.1px solid #000;
}
.logo:visited{
color : #fff;
background-color:#151515;
}
.logo{
font-family : "Times New Roman", Times, serif;
font-size:20px;
color : #fff;
background-color:#151515;
letter-spacing : 0.2px;
text-decoration : none;
margin-left : 8px;
}
.logo:hover{
color: #fff;
text-shadow:0px 0px 5px #fff;
-moz-transition: all 0s ease-in;
-o-transition: all 0s ease-in;
-webkit-transition: all 0s ease-in;
transition: all 0.2s ease-in;
text-decoration:none;	
background-color:#151515;
}
.logo:active {
color: #fff;
background-color:#000;
text-decoration : none;
}
.pr_logo{
margin-left : 8px;
}
.call{
color : #fff;
font-size : 14px;
font-family : "Times New Roman", Times, serif;
}
.headr2{
position:fixed;
background-color : #fff;
width:100%;
max-width:100%;
padding-top : 6.5px;
padding-bottom : 6px;
border-bottom : 0.2px solid #b3b3b3;
border-top : 0.1px solid #000;
margin-top : 24.5px;
padding-left : 15px;
padding-right : 10px;
}
.vl{
margin-left : 16px;	
word-spacing : 50px;
}
.link_headr:visited{
color : #000;
background-color:#fff;
}
.link_headr{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16px;
text-decoration : none;
line-height : 1.8;
}
.link_headr:hover{
color: #000;
text-decoration:underline;	
background-color:#fff;
}
.link_headr:active {
color: #000;
background-color:#fff;
text-decoration : underline;
}
.link_headr_notify:visited{
color : #ff3300;
background-color:#fff;
}
.link_headr_notify{
color : #ff3300;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16px;
text-decoration : none;
line-height : 1.8;
}
.link_headr_notify:hover{
color: red;
text-decoration:underline;	
background-color:#fff;
}
.link_headr_notify:active {
color: #ff3300;
background-color:#fff;
text-decoration : underline;
}
.content{
margin-top : 65px;
text-align : center;
}
.link_headr2:visited{
display : none;
}
.link_headr2{
display : none;
}
.link_headr2:hover{
display : none;
}
.link_headr2:active {
display : none;
}
.vl2{
margin-left : -2.8px;
word-spacing : 0px;
}
.all_content{
text-align:center;
width : 97%;
max-width : 580px;
background-color : #fff;
border-radius : 10px;
padding-top : 25px;
padding-bottom : 25px;
margin-top : -15px;
border : thin solid #c2bcbc;
padding-left : 15px;
padding-right : 18px;
margin-bottom : -25px;
}
.footr{
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 20px;
padding-top : 15px;
margin-top : 12px;
width : 97%;
max-width : 580px;
border-radius : 10px;
}
.link_footr:visited{
color : #fff;
background-color:#686464;
}
.link_footr{
color : #fff;
background-color:#686464;
font-family : arial, tahoma;
font-size : 10px;
font-weight : bold;
text-decoration : underline;
}
.link_footr:hover{
color: #fff;
text-decoration:underline;	
background-color:#686464;
}
.link_footr:active {
color: #fff;
background-color:#686464;
}
.link_footr2:visited{
color : #fff;
background-color:#686464;
}
.link_footr2{
color : #fff;
background-color:#686464;
font-family : arial, tahoma;
font-size : 10px;
font-weight : bold;
text-decoration : underline;
margin-bottom : 50px;
}
.link_footr2:hover{
color: #fff;
text-decoration:underline;	
background-color:#686464;
}
.link_footr2:active {
color: #fff;
background-color:#686464;
}
.dis_none{
margin-bottom : 13px;
}
.copyrt{
color : #fff;
background-color : #686464;	
font-family : arial, tahoma;
font-size : 9.5px;
font-weight : bold;
}
.cpy2{
margin-top : 10px;
}
.vl{
}
.missing_detail_title{
background-color : #e6e6e6;
padding-bottom : 10px;
padding-top : 10px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -14px;
margin-right : -17px;
margin-bottom : 10px;
margin-top : -5px;	
}
.signup_form{
margin-top : 0px;	
}
.label{
background-color : #fff;
color : #000;
font-size : 17px;
font-family : "Times New Roman", Times, Serif;	
}
.form-cntrl{
width : 95%;
height : 33px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 17px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 12px;
margin-top : 2px;
}
.form-cntrl-birth{
width : 30%;
height : 33px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 17px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 17px;
margin-top : 2px;
}
.form-cntrl-desc{
resize : none;
width : 95%;
border : 0.4px solid green;
border-radius : 3px;
font-size : 17px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 12px;
margin-top : 2px;	
}
.form-cntrl-img{
width : 95%;
height : 33px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 17px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 25px;
margin-top : 2px;
}
.contact_detail_title{
background-color : #e6e6e6;
padding-bottom : 10px;
padding-top : 10px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -14px;
margin-right : -17px;
margin-bottom : 12px;
margin-top : 0px;
}
.btn{
margin-top : 1px;	
width : 94%;
height : 33px;
border : 0.4px solid #1a1a00;
border-radius : 2px;
font-size : 14px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : green;
margin-bottom : 18px;
}
.btn:hover{
background-color : #006600;
color : #fff;	
}
.err-wrap{
width : 100%;
background-color : #e60000;
align-content : center;
margin-top :-12px;
padding-top : 5px;
padding-bottom : 8px;
margin-bottom : 12px;
border-radius : 5px;
padding-left : 10px;
padding-right : 10px;
}
.err{
color : #fff;
font-size : 17px;
font-family : "Times New Roman", Times, Serif;
}
.err-close:visited{
color : #ffffff;
background-color:#e60000;
text-decoration : none;
}
.err-close{
color : #ffffff;
background-color:#e60000;
font-family : arial, tahoma;
font-size : 18px;
font-weight : bold;
text-decoration : none;
}
.err-close:hover{
color: #0d0d0d;
text-decoration:none;	
background-color:#e60000;
transition: all 0.2s ease-in;
}
.err-close:active {
color: #ffffff;
background-color:#e60000;
text-decoration : none;
}
.nt{
line-height : 1.4;	
margin-top : -4px;	
padding-left : 30px;
padding-right : 30px;
font-size : 15px;
font-family : "Times New Roman", Times, Serif;	
}
}
/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
*{margin:0px; padding:0px;}	
html, body{
overflow-x : hidden;	
}
.bdy{
background-color : #fff;	
}
.headr1{
position:fixed;
background-color : #151515;
width:100%;
max-width:100%;
padding-top : 13px;
padding-bottom : 8px;
border-bottom : 0.1px solid #000;
}
.logo:visited{
color : #fff;
background-color:#151515;
}
.logo{
font-family : "Times New Roman", Times, serif;
font-size:20px;
color : #fff;
background-color:#151515;
letter-spacing : 0.2px;
text-decoration : none;
margin-left : 40px;
}
.logo:hover{
color: #fff;
text-shadow:0px 0px 5px #fff;
-moz-transition: all 0s ease-in;
-o-transition: all 0s ease-in;
-webkit-transition: all 0s ease-in;
transition: all 0.2s ease-in;
text-decoration:none;	
background-color:#151515;
}
.logo:active {
color: #fff;
background-color:#000;
text-decoration : none;
}
.pr_logo{
margin-left : 40%;
}
.call{
color : #fff;
font-size : 16px;
font-family : "Times New Roman", Times, serif;
}
.headr2{
position:fixed;
background-color : #fff;
width:100%;
max-width:100%;
padding-top : 13px;
padding-bottom : 12px;
border-bottom : 0.2px solid #b3b3b3;
border-top : 0.1px solid #000;
margin-top : 24.5px;
padding-left : 57px;
padding-right : 10px;
}
.vl{
margin-left : 16px;	
word-spacing : 50px;
}
.link_headr:visited{
color : #000;
background-color:#fff;
}
.link_headr{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16px;
text-decoration : none;
}
.link_headr:hover{
color: #000;
text-decoration:underline;	
background-color:#fff;
}
.link_headr:active {
color: #000;
background-color:#fff;
text-decoration : underline;
}
.link_headr_notify:visited{
color : #ff3300;
background-color:#fff;
}
.link_headr_notify{
color : #ff3300;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16px;
text-decoration : none;
}
.link_headr_notify:hover{
color: red;
text-decoration:underline;	
background-color:#fff;
}
.link_headr_notify:active {
color: #ff3300;
background-color:#fff;
text-decoration : underline;
}
.content{
margin-top : 65px;
text-align : center;
}
.link_headr2:visited{
color : #000;
background-color:#fff;
}
.link_headr2{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16px;
text-decoration : none;
}
.link_headr2:hover{
color: #000;
text-decoration:underline;	
background-color:#fff;
}
.link_headr2:active {
color: #000;
background-color:#fff;
text-decoration : underline;
}
.vl2{
margin-left : 16px;	
word-spacing : 50px;
}
.all_content{
text-align:center;
width : 97%;
max-width : 735px;
background-color : #fff;
border-radius : 10px;
padding-top : 28px;
padding-bottom : 25px;
margin-top : -13px;
border : thin solid #c2bcbc;
padding-left : 20px;
padding-right : 20px;
margin-bottom : -25px;
}
.footr{
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 20px;
padding-top : 15px;
margin-top : 12px;
width : 97%;
max-width : 735px;
border-radius : 10px;
}
.link_footr:visited{
color : #fff;
background-color:#686464;
}
.link_footr{
color : #fff;
background-color:#686464;
font-family : arial, tahoma;
font-size : 10px;
font-weight : bold;
text-decoration : underline;
}
.link_footr:hover{
color: #fff;
text-decoration:underline;	
background-color:#686464;
}
.link_footr:active {
color: #fff;
background-color:#686464;
}
.link_footr2:visited{
display : none;
}
.link_footr2{
display : none;
}
.link_footr2:hover{
display : none;
}
.link_footr2:active {
display : none;
}
.dis_none{
display : none;
}
.copyrt{
color : #fff;
background-color : #686464;	
font-family : arial, tahoma;
font-size : 9.5px;
font-weight : bold;
}
.cpy2{
margin-top : 13px;
}
.vl{
}
.err-wrap{
width : 90%;
background-color : #e60000;
align-content : center;
margin-top :-12px;
padding-top : 5px;
padding-bottom : 8px;
margin-bottom : 12px;
border-radius : 5px;
padding-left : 20px;
padding-right : 20px;
}
.err{
color : #fff;
font-size : 17px;
font-family : "Times New Roman", Times, Serif;
}
.err-close:visited{
color : #ffffff;
background-color:#e60000;
text-decoration : none;
}
.err-close{
color : #ffffff;
background-color:#e60000;
font-family : arial, tahoma;
font-size : 18px;
font-weight : bold;
text-decoration : none;
}
.err-close:hover{
color: #0d0d0d;
text-decoration:none;	
background-color:#e60000;
transition: all 0.2s ease-in;
}
.err-close:active {
color: #ffffff;
background-color:#e60000;
text-decoration : none;
}
.missing_detail_title{
background-color : #e6e6e6;
padding-bottom : 10px;
padding-top : 10px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -19.5px;
margin-right : -19.5px;
margin-bottom : 10px;
margin-top : -5px;	
}
.signup_form{
margin-top : 0px;	
}
.label{
background-color : #fff;
color : #000;
font-size : 17px;
font-family : "Times New Roman", Times, Serif;	
}
.form-cntrl{
width : 95%;
height : 33px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 17px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 12px;
margin-top : 2px;
}
.form-cntrl-birth{
width : 30%;
height : 33px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 17px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 17px;
margin-top : 2px;
}
.form-cntrl-desc{
resize : none;
width : 95%;
border : 0.4px solid green;
border-radius : 3px;
font-size : 17px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 12px;
margin-top : 2px;	
}
.form-cntrl-img{
width : 95%;
height : 33px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 17px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 25px;
margin-top : 2px;
}
.contact_detail_title{
background-color : #e6e6e6;
padding-bottom : 10px;
padding-top : 10px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -19.5px;
margin-right : -19.5px;
margin-bottom : 12px;
margin-top : 0px;
}
.btn{
margin-top : 1px;	
width : 94%;
height : 33px;
border : 0.4px solid #1a1a00;
border-radius : 2px;
font-size : 14px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : green;
margin-bottom : 18px;
}
.btn:hover{
background-color : #006600;
color : #fff;	
}
.nt{
line-height : 1.4;	
margin-top : -4px;	
margin-bottom : 3px;
padding-left : 35px;
padding-right : 35px;
font-size : 16px;
font-family : "Times New Roman", Times, Serif;	
}
}
/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
*{margin:0px; padding:0px;}	
html, body{
overflow-x : hidden;	
}
.bdy{
background-color : #fff;	
}
.headr1{
position:fixed;
background-color : #151515;
width:100%;
max-width:100%;
padding-top : 13px;
padding-bottom : 8px;
border-bottom : 0.1px solid #000;
}
.logo:visited{
color : #fff;
background-color:#151515;
}
.logo{
font-family : "Times New Roman", Times, serif;
font-size:20px;
color : #fff;
background-color:#151515;
letter-spacing : 0.2px;
text-decoration : none;
margin-left : 40px;
}
.logo:hover{
color: #fff;
text-shadow:0px 0px 5px #fff;
-moz-transition: all 0s ease-in;
-o-transition: all 0s ease-in;
-webkit-transition: all 0s ease-in;
transition: all 0.2s ease-in;
text-decoration:none;	
background-color:#151515;
}
.logo:active {
color: #fff;
background-color:#000;
text-decoration : none;
}
.pr_logo{
margin-left : 50%;
}
.call{
color : #fff;
font-size : 16px;
font-family : "Times New Roman", Times, serif;
}
.headr2{
position:fixed;
background-color : #fff;
width:100%;
max-width:100%;
padding-top : 14px;
padding-bottom : 13px;
border-bottom : 0.2px solid #b3b3b3;
border-top : 0.1px solid #000;
margin-top : 24.5px;
padding-left : 57px;
padding-right : 10px;
}
.vl{
margin-left : 17px;	
word-spacing : 50px;
}
.link_headr:visited{
color : #000;
background-color:#fff;
}
.link_headr{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16px;
text-decoration : none;
}
.link_headr:hover{
color: #000;
text-decoration:underline;	
background-color:#fff;
}
.link_headr:active {
color: #000;
background-color:#fff;
text-decoration : underline;
}
.link_headr_notify:visited{
color : #ff3300;
background-color:#fff;
}
.link_headr_notify{
color : #ff3300;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16px;
text-decoration : none;
}
.link_headr_notify:hover{
color: red;
text-decoration:underline;	
background-color:#fff;
}
.link_headr_notify:active {
color: #ff3300;
background-color:#fff;
text-decoration : underline;
}
.content{
margin-top : 67px;
text-align : center;
}
.link_headr2:visited{
color : #000;
background-color:#fff;
}
.link_headr2{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16px;
text-decoration : none;
}
.link_headr2:hover{
color: #000;
text-decoration:underline;	
background-color:#fff;
}
.link_headr2:active {
color: #000;
background-color:#fff;
text-decoration : underline;
}
.vl2{
margin-left : 17px;	
word-spacing : 50px;
}
.all_content{
text-align:center;
width : 97%;
max-width : 945px;
background-color : #fff;
border-radius : 10px;
padding-top : 30px;
padding-bottom : 30px;
margin-top : -13px;
border : thin solid #c2bcbc;
padding-left : 100px;
padding-right : 100px;
margin-bottom : -25px;
}
.footr{
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 30px;
padding-top : 18px;
margin-top : 12px;
width : 97%;
max-width : 945px;
border-radius : 10px;
}
.link_footr:visited{
color : #fff;
background-color:#686464;
}
.link_footr{
color : #fff;
background-color:#686464;
font-family : arial, tahoma;
font-size : 11px;
font-weight : bold;
text-decoration : underline;
}
.link_footr:hover{
color: #fff;
text-decoration:underline;	
background-color:#686464;
}
.link_footr:active {
color: #fff;
background-color:#686464;
}
.link_footr2:visited{
display : none;
}
.link_footr2{
display : none;
}
.link_footr2:hover{
display : none;
}
.link_footr2:active {
display : none;
}
.dis_none{
display : none;
}
.copyrt{
color : #fff;
background-color : #686464;	
font-family : arial, tahoma;
font-size : 10.5px;
font-weight : bold;
}
.cpy2{
margin-top : 17px;
}
.vl{
}
.err-wrap{
width : 100%;
background-color : #e60000;
align-content : center;
margin-top :-12px;
padding-top : 5px;
padding-bottom : 8px;
margin-bottom : 12px;
border-radius : 5px;
padding-left : 20px;
padding-right : 20px;
}
.err{
color : #fff;
font-size : 17px;
font-family : "Times New Roman", Times, Serif;
}
.err-close:visited{
color : #ffffff;
background-color:#e60000;
text-decoration : none;
}
.err-close{
color : #ffffff;
background-color:#e60000;
font-family : arial, tahoma;
font-size : 18px;
font-weight : bold;
text-decoration : none;
}
.err-close:hover{
color: #0d0d0d;
text-decoration:none;	
background-color:#e60000;
transition: all 0.2s ease-in;
}
.err-close:active {
color: #ffffff;
background-color:#e60000;
text-decoration : none;
}
.missing_detail_title{
background-color : #e6e6e6;
padding-bottom : 10px;
padding-top : 10px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -99.5px;
margin-right : -99.5px;
margin-bottom : 10px;
margin-top : -5px;	
}
.signup_form{
margin-top : 0px;	
}
.label{
background-color : #fff;
color : #000;
font-size : 17px;
font-family : "Times New Roman", Times, Serif;	
}
.form-cntrl{
width : 100%;
height : 33px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 17px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 12px;
margin-top : 2px;
}
.form-cntrl-birth{
width : 32.5%;
height : 33px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 17px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 17px;
margin-top : 2px;
}
.form-cntrl-desc{
resize : none;
width : 100%;
border : 0.4px solid green;
border-radius : 3px;
font-size : 17px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 12px;
margin-top : 2px;	
}
.form-cntrl-img{
width : 100%;
height : 33px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 17px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 25px;
margin-top : 2px;
}
.contact_detail_title{
background-color : #e6e6e6;
padding-bottom : 10px;
padding-top : 10px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -99.5px;
margin-right : -99.5px;
margin-bottom : 12px;
margin-top : 0px;
}
.btn{
margin-top : 1px;	
width : 99%;
height : 33px;
border : 0.4px solid #1a1a00;
border-radius : 2px;
font-size : 15px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : green;
margin-bottom : 18px;
}
.btn:hover{
background-color : #006600;
color : #fff;	
}
.nt{
line-height : 1.5;	
margin-top : -4px;	
margin-bottom : 3px;
padding-left : 35px;
padding-right : 35px;
font-size : 17px;
font-family : "Times New Roman", Times, Serif;	
}
}
/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
*{margin:0px; padding:0px;}	
html, body{
overflow-x : hidden;	
}
.bdy{
background-color : #fff;	
}
.headr1{
position:fixed;
background-color : #151515;
width:100%;
max-width:100%;
padding-top : 14px;
padding-bottom : 12px;
border-bottom : 0.1px solid #000;
}
.logo:visited{
color : #fff;
background-color:#151515;
}
.logo{
font-family : "Times New Roman", Times, serif;
font-size:20px;
color : #fff;
background-color:#151515;
letter-spacing : 0.2px;
text-decoration : none;
margin-left : 40px;
}
.logo:hover{
color: #fff;
text-shadow:0px 0px 5px #fff;
-moz-transition: all 0s ease-in;
-o-transition: all 0s ease-in;
-webkit-transition: all 0s ease-in;
transition: all 0.2s ease-in;
text-decoration:none;	
background-color:#151515;
}
.logo:active {
color: #fff;
background-color:#000;
text-decoration : none;
}
.pr_logo{
margin-left : 61%;
}
.call{
color : #fff;
font-size : 16px;
font-family : "Times New Roman", Times, serif;
}
.headr2{
position:fixed;
background-color : #fff;
width:100%;
max-width:100%;
padding-top : 14px;
padding-bottom : 13px;
border-bottom : 0.2px solid #b3b3b3;
border-top : 0.1px solid #000;
margin-top : 29px;
padding-left : 59px;
padding-right : 10px;
}
.vl{
margin-left : 17px;	
word-spacing : 50px;
}
.link_headr:visited{
color : #000;
background-color:#fff;
}
.link_headr{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16px;
text-decoration : none;
}
.link_headr:hover{
color: #000;
text-decoration:underline;	
background-color:#fff;
}
.link_headr:active {
color: #000;
background-color:#fff;
text-decoration : underline;
}
.link_headr_notify:visited{
color : #ff3300;
background-color:#fff;
}
.link_headr_notify{
color : #ff3300;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16px;
text-decoration : none;
}
.link_headr_notify:hover{
color: red;
text-decoration:underline;	
background-color:#fff;
}
.link_headr_notify:active {
color: #ff3300;
background-color:#fff;
text-decoration : underline;
}
.content{
margin-top : 72px;
text-align : center;
}
.link_headr2:visited{
color : #000;
background-color:#fff;
}
.link_headr2{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16px;
text-decoration : none;
}
.link_headr2:hover{
color: #000;
text-decoration:underline;	
background-color:#fff;
}
.link_headr2:active {
color: #000;
background-color:#fff;
text-decoration : underline;
}
.vl2{
margin-left : 17px;	
word-spacing : 50px;
}
.all_content{
text-align:center;
width : 70%;
max-width : 830px;
background-color : #fff;
border-radius : 10px;
padding-top : 35px;
padding-bottom : 30px;
margin-top : -13px;
border : thin solid #c2bcbc;
padding-left : 150px;
padding-right : 150px;
margin-bottom : -25px;
}
.footr{
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 30px;
padding-top : 18px;
margin-top : 12px;
width : 70%;
max-width : 830px;
border-radius : 10px;
}
.link_footr:visited{
color : #fff;
background-color:#686464;
}
.link_footr{
color : #fff;
background-color:#686464;
font-family : arial, tahoma;
font-size : 11px;
font-weight : bold;
text-decoration : underline;
}
.link_footr:hover{
color: #fff;
text-decoration:underline;	
background-color:#686464;
}
.link_footr:active {
color: #fff;
background-color:#686464;
}
.link_footr2:visited{
display : none;
}
.link_footr2{
display : none;
}
.link_footr2:hover{
display : none;
}
.link_footr2:active {
display : none;
}
.dis_none{
display : none;
}
.copyrt{
color : #fff;
background-color : #686464;	
font-family : arial, tahoma;
font-size : 10.5px;
font-weight : bold;
}
.cpy2{
margin-top : 17px;
}
.vl{
}
.err-wrap{
width : 100%;
background-color : #e60000;
align-content : center;
margin-top :-12px;
padding-top : 5px;
padding-bottom : 8px;
margin-bottom : 12px;
border-radius : 5px;
padding-left : 20px;
padding-right : 20px;
}
.err{
color : #fff;
font-size : 17px;
font-family : "Times New Roman", Times, Serif;
}
.err-close:visited{
color : #ffffff;
background-color:#e60000;
text-decoration : none;
}
.err-close{
color : #ffffff;
background-color:#e60000;
font-family : arial, tahoma;
font-size : 18px;
font-weight : bold;
text-decoration : none;
}
.err-close:hover{
color: #0d0d0d;
text-decoration:none;	
background-color:#e60000;
transition: all 0.2s ease-in;
}
.err-close:active {
color: #ffffff;
background-color:#e60000;
text-decoration : none;
}
.missing_detail_title{
background-color : #e6e6e6;
padding-bottom : 10px;
padding-top : 10px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -149px;
margin-right : -149px;
margin-bottom : 10px;
margin-top : -5px;	
}
.signup_form{
margin-top : 0px;	
}
.label{
background-color : #fff;
color : #000;
font-size : 17px;
font-family : "Times New Roman", Times, Serif;	
}
.form-cntrl{
width : 100%;
height : 35px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 19px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 12px;
margin-top : 2px;
}
.form-cntrl-birth{
width : 32.5%;
height : 35px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 19px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 17px;
margin-top : 2px;
}
.form-cntrl-desc{
resize : none;
width : 100%;
border : 0.4px solid green;
border-radius : 3px;
font-size : 19px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 12px;
margin-top : 2px;	
}
.form-cntrl-img{
width : 100%;
height : 35px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 19px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 25px;
margin-top : 2px;
}
.contact_detail_title{
background-color : #e6e6e6;
padding-bottom : 10px;
padding-top : 10px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -149px;
margin-right : -149px;
margin-bottom : 12px;
margin-top : 0px;
}
.btn{
margin-top : 1px;	
width : 99%;
height : 35px;
border : 0.4px solid #1a1a00;
border-radius : 2px;
font-size : 16px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : green;
margin-bottom : 18px;
}
.btn:hover{
background-color : #006600;
color : #fff;	
}
.nt{
line-height : 1.5;	
margin-top : -4px;	
margin-bottom : 4px;
padding-left : 30px;
padding-right : 30px;
font-size : 17px;
font-family : "Times New Roman", Times, Serif;	
}
}
/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
*{margin:0px; padding:0px;}	
html, body{
overflow-x : hidden;	
}
.bdy{
background-color : #fff;	
}
.headr1{
position:fixed;
background-color : #151515;
width:100%;
max-width:100%;
padding-top : 15px;
padding-bottom : 13px;
border-bottom : 0.1px solid #000;
}
.logo:visited{
color : #fff;
background-color:#151515;
}
.logo{
font-family : "Times New Roman", Times, serif;
font-size:25px;
color : #fff;
background-color:#151515;
letter-spacing : 0.2px;
text-decoration : none;
margin-left : 55px;
}
.logo:hover{
color: #fff;
text-shadow:0px 0px 5px #fff;
-moz-transition: all 0s ease-in;
-o-transition: all 0s ease-in;
-webkit-transition: all 0s ease-in;
transition: all 0.2s ease-in;
text-decoration:none;	
background-color:#151515;
}
.logo:active {
color: #fff;
background-color:#000;
text-decoration : none;
}
.pr_logo{
margin-left : 63%;
}
.call{
color : #fff;
font-size : 17px;
font-family : "Times New Roman", Times, serif;
}
.headr2{
position:fixed;
background-color : #fff;
width:100%;
max-width:100%;
padding-top : 14px;
padding-bottom : 14.5px;
border-bottom : 0.2px solid #b3b3b3;
border-top : 1.7px solid #000;
margin-top : 36px;
padding-left : 83px;
padding-right : 10px;
}
.vl{
margin-left : 18px;	
word-spacing : 50px;
}
.link_headr:visited{
color : #000;
background-color:#fff;
}
.link_headr{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 17px;
text-decoration : none;
}
.link_headr:hover{
color: #000;
text-decoration:underline;	
background-color:#fff;
}
.link_headr:active {
color: #000;
background-color:#fff;
text-decoration : underline;
}
.link_headr_notify:visited{
color : #ff3300;
background-color:#fff;
}
.link_headr_notify{
color : #ff3300;
background-color:#fff;
font-family : arial, tahoma;
font-size : 17px;
text-decoration : none;
}
.link_headr_notify:hover{
color: red;
text-decoration:underline;	
background-color:#fff;
}
.link_headr_notify:active {
color: #ff3300;
background-color:#fff;
text-decoration : underline;
}
.content{
margin-top : 85px;
text-align : center;
}
.link_headr2:visited{
color : #000;
background-color:#fff;
}
.link_headr2{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 17px;
text-decoration : none;
}
.link_headr2:hover{
color: #000;
text-decoration:underline;	
background-color:#fff;
}
.link_headr2:active {
color: #000;
background-color:#fff;
text-decoration : underline;
}
.vl2{
margin-left : 18px;	
word-spacing : 50px;
}
.all_content{
text-align:center;
width : 55%;
max-width : 850px;
background-color : #fff;
border-radius : 10px;
padding-top : 40px;
padding-bottom : 30px;
margin-top : -14.5px;
border : thin solid #c2bcbc;
padding-left : 50px;
padding-right : 50px;
margin-bottom : -25px;
}
.footr{
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 30px;
padding-top : 18px;
margin-top : 12px;
width : 55%;
max-width : 850px;
border-radius : 10px;
}
.link_footr:visited{
color : #fff;
background-color:#686464;
}
.link_footr{
color : #fff;
background-color:#686464;
font-family : arial, tahoma;
font-size : 13px;
font-weight : bold;
text-decoration : underline;
}
.link_footr:hover{
color: #fff;
text-decoration:underline;	
background-color:#686464;
}
.link_footr:active {
color: #fff;
background-color:#686464;
}
.link_footr2:visited{
display : none;
}
.link_footr2{
display : none;
}
.link_footr2:hover{
display : none;
}
.link_footr2:active {
display : none;
}
.dis_none{
display : none;
}
.copyrt{
color : #fff;
background-color : #686464;	
font-family : arial, tahoma;
font-size : 12.5px;
font-weight : bold;
}
.cpy2{
margin-top : 25px;
}
.vl{
}
.err-wrap{
width : 90%;
background-color : #e60000;
align-content : center;
margin-top :-18px;
padding-top : 5px;
padding-bottom : 8px;
margin-bottom : 20px;
border-radius : 5px;
padding-left : 20px;
padding-right : 20px;
}
.err{
color : #fff;
font-size : 17px;
font-family : "Times New Roman", Times, Serif;
}
.err-close:visited{
color : #ffffff;
background-color:#e60000;
text-decoration : none;
}
.err-close{
color : #ffffff;
background-color:#e60000;
font-family : arial, tahoma;
font-size : 18px;
font-weight : bold;
text-decoration : none;
}
.err-close:hover{
color: #0d0d0d;
text-decoration:none;	
background-color:#e60000;
transition: all 0.2s ease-in;
}
.err-close:active {
color: #ffffff;
background-color:#e60000;
text-decoration : none;
}
.missing_detail_title{
background-color : #e6e6e6;
padding-bottom : 10px;
padding-top : 10px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
width : 100%;
max-width : 100%;
margin-left : 1px;
margin-bottom : 15px;
margin-top : -10px;	
}
.signup_form{
margin-top : 0px;	
}
.label{
background-color : #fff;
color : #000;
font-size : 20px;
font-family : "Times New Roman", Times, Serif;	
}
.form-cntrl{
width : 80%;
height : 36px;
border : thin solid green;
border-radius : 3px;
font-size : 20px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 15px;
margin-top : 2px;
}
.form-cntrl-birth{
width : 25.6%;
height : 36px;
border : thin solid green;
border-radius : 3px;
font-size : 20px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 20px;
margin-top : 2px;
}
.form-cntrl-desc{
resize : none;
width : 80%;
border : thin solid green;
border-radius : 3px;
font-size : 20px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 15px;
margin-top : 2px;	
}
.form-cntrl-img{
width : 80%;
height : 36px;
border : thin solid green;
border-radius : 3px;
font-size : 20px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 25px;
margin-top : 2px;
}
.contact_detail_title{
background-color : #e6e6e6;
padding-bottom : 10px;
padding-top : 10px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
width : 100%;
max-width : 100%;
margin-left : 1px;
margin-bottom : 17px;
margin-top : 0px;
}
.btn{
margin-top : 1px;	
width : 79%;
height : 36px;
border : thin solid #1a1a00;
border-radius : 2px;
font-size : 17px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : green;
margin-bottom : 18px;
}
.btn:hover{
background-color : #006600;
color : #fff;	
}
.nt{
line-height : 1.5;	
margin-top : 5px;	
margin-bottom : 5px;
padding-left : 130px;
padding-right : 130px;
font-size : 18px;
font-family : "Times New Roman", Times, Serif;	
}
}
</style>		

<link href="css/bootstrap.min.css" rel="stylesheet">

<link href="css/bootstrap-theme.min.css" rel="stylesheet">

<link href="js/bootstrap.min.js" rel="stylesheet">

<link href="js/bootstrap.js" rel="stylesheet">

<link href="theme.css" rel="stylesheet">

<!------------------- JAvascript to open popup login form ------->
<script>
function openForm() {
  document.getElementById("loginForm").style.display = "block";
}

function closeForm() {
  document.getElementById("loginForm").style.display = "none";
}

function errClose() {
  document.getElementById("errorClose").style.display = "none";
}
</script>

</head>

<body class="bdy">

<div class='headr1'>

<a href="khojhai_home.php" class="logo">KhojHai.com</a>

<span class='pr_logo'><span class="call">Helpline : xxxx-xx-xxxx</span></span>

</div>

<br>

<div class="headr2">

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

<!--<span class='pr_vl'><span class="vl"></span></span>-->

<a href='khojhai_home.php' class='link_headr' title='Home'>Home</a>

<span class='pr_vl'><span class="vl"></span></span>

<?php
echo '<a href="khojhai_profile.php?id='.$sess_id.'" class="link_headr" title="'.$tmp_name.'">Profile</a>';

echo '<span class="pr_vl"><span class="vl"></span></span>';

$qry1 = "select * from case_followers where added_by_id = '$sess_id' and follower_id != '$sess_id' and seen_by_adder = 'n' ";

$qry_wrap1 = mysqli_query($con, $qry1);

$qry_count1 = mysqli_num_rows($qry_wrap1);

if($qry_count1 > 0)
{
echo '<a href="khojhai_notify.php" class="link_headr_notify" title="Notifications">Notification</a>';

echo '<span class="pr_vl"><span class="vl"></span></span>';
}

else
{
echo '<a href="khojhai_notify.php" class="link_headr" title="Notifications">Notification</a>';

echo '<span class="pr_vl"><span class="vl"></span></span>';
}
?>

<a href='khojhai_setting.php' class='link_headr2' title='Settings'>Setting</a>

<span class='pr_vl'><span class="vl2"></span></span>

<a href='khojhai_search.php' class='link_headr' title='Search'>Search</a>

<span class='pr_vl'><span class="vl"></span></span>

<a href='khojhai_logout.php' class='link_headr2' title='SignOut'>Logout</a>

</div><br>

<center>

<div class='content'>	

<center>

<div class = "all_content">

<div class = "form_signup">

<!---- <span class="label_head">Add Missing Person</span><br> --->

<!--- For Errors ------->
<?php
if(isset($_GET['err']))
{
	$r = mysqli_real_escape_string($con,$_GET['err']);
} 

else 
{
	$r = "";
}

//--------------------------- Error No. 1 : all required -----------------------------//
if($r == 1)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>All Fields Are Required.*<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

//------------------------- Error No 2 : For contact number ---------------------------//
if($r == 2)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Contact Number Can Only Be Digit And Should Be Less Than 26 Digits Without Any Space And Special Characters.
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

//------------------------- Error No 3 : For name ---------------------------//
if($r == 3)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Name Must Be Only In English Letters, And It Should Not Be More Than 25 Characters.*
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

//------------------------- Error No 4-8 : For description and address and Image ---------------------------//
if($r == 4)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Description Cannot Be More Than 300 Characters.*
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

if($r == 5)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Address Cannot Be More Than 200 Characters.*
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

if($r == 6)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>That Image Has No Dimension.*
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

if($r == 7)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Image Cannot Be Larger Than 1GB.*
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

if($r == 8)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Only JPG, JPEG, PNG or GIF Type Images Are Allowed.*
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

if($r == 9)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Something Went Wrong.*
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

if($r == 10)
{
echo "<center><div class='err-wrap' id='errorClose' style='background-color:#00b300; padding-top:9px; padding-bottom:11px;'>";
	
echo "<p class='err' style='font-size : 19px'>Deleted Successfully. You Can Add New Here.
<a href='#' class='err-close' onclick='errClose()' style='background-color:#00b300; font-size : 21px'> X</a></p>";

echo "</div></center>"; 
}

if($r == 11)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Please Avoid Using Only Single Numeric Zero(0) Anywhere.
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

?>
<!--- Error Ends ------->

<form enctype = "multipart/form-data" action= "khojhai_add_missing2.php" method="POST" role="form" class="signup_form">

<div class='missing_detail_title'>Details of Missing Person</div>

<!-------------- name of missing ------------->
<span class="label">Name*</span><br>

<input type = "text" id = "name" name = "name" class = "form-cntrl" placeholder = "Name of the missing person" required = "required" minlength = "1" maxlength = "25" 

pattern = "[A-Za-z\s]{1,25}$" 

required title = "Name Must Be Only In English Letters, And It Should Not Be More Than 25 Characters.*" autocomplete = "off" autocorrect = "off" spellcheck = "false" />

<br>


<!-------------- gender of missing ------------->
<span class="label">Gender*</span><br> 

<select id="gender" name="gender" class="form-cntrl">

  <option value="male">Male</option>
  <option value="female">Female</option>
  <option value="other">Other</option>
  
</select><br>

<!-------------- age of missing ------------->
<span class="label">Age*</span><br> 

<select id="year" name="year" class="form-cntrl-birth">
 
  <option value="1928">1928</option>
  <option value="1929">1929</option>
  <option value="1930">1930</option>
  <option value="1931">1931</option>
  <option value="1932">1932</option>
  <option value="1933">1933</option>
  <option value="1934">1934</option>
  <option value="1935">1935</option>
  <option value="1936">1936</option>
  <option value="1937">1937</option>
  <option value="1938">1938</option> 
  
  <option value="1939">1939</option>
  <option value="1940">1940</option>
  <option value="1941">1941</option>
  <option value="1942">1942</option>
  <option value="1943">1943</option>
  <option value="1944">1944</option>
  <option value="1945">1945</option>
  <option value="1946">1946</option>
  <option value="1947">1947</option>
  <option value="1948">1948</option>
  <option value="1949">1949</option>
   
  <option value="1950">1950</option>
  <option value="1951">1951</option>
  <option value="1952">1952</option>
  <option value="1953">1953</option>
  <option value="1954">1954</option>
  <option value="1955">1955</option>
  <option value="1956">1956</option>
  <option value="1957">1957</option>
  <option value="1958">1958</option>
  <option value="1959">1959</option>
  <option value="1960">1960</option>
  <option value="1961">1961</option>
  <option value="1962">1962</option>
  <option value="1963">1963</option>
  <option value="1964">1964</option>
  <option value="1965">1965</option>
  <option value="1966">1966</option>
  <option value="1967">1967</option>
  <option value="1968">1968</option>
  <option value="1969">1969</option>
  <option value="1970">1970</option>
  <option value="1971">1971</option>
  <option value="1972">1972</option>
  <option value="1973">1973</option>
  <option value="1974">1974</option>
  <option value="1975">1975</option>
  <option value="1976">1976</option>
  <option value="1977">1977</option>
  <option value="1978">1978</option>
  <option value="1979">1979</option>
  <option value="1980">1980</option>
  <option value="1981">1981</option>
  <option value="1982">1982</option>
  <option value="1983">1983</option>
  <option value="1984">1984</option>
  <option value="1985">1985</option>
  <option value="1986">1986</option>
  <option value="1987">1987</option>
  <option value="1988">1988</option>
  <option value="1989">1989</option>
  <option value="1990">1990</option>
  <option value="1991">1991</option>
  <option value="1992">1992</option>
  <option value="1993">1993</option>
  <option value="1994">1994</option>
  <option value="1995">1995</option>
  <option value="1996">1996</option>
  <option value="1997">1997</option>
  <option value="1998">1998</option>
  <option value="1999">1999</option>
  <option value="2000">2000</option>
  <option value="2001">2001</option>
  <option value="2002">2002</option>
  <option value="2003">2003</option>
  <option value="2004">2004</option>
  <option value="2005">2005</option>
  <option value="2006">2006</option>
  <option value="2007">2007</option>
  <option value="2008">2008</option>
  <option value="2009">2009</option>
  <option value="2010">2010</option>
  <option value="2011">2011</option>
  <option value="2012">2012</option>
  <option value="2013">2013</option>
  <option value="2014">2014</option>
  <option value="2015">2015</option>
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
  <option value="2019">2019</option>
  <option value="2020">2020</option>
  
</select>

<select id="month" name="month" class="form-cntrl-birth">

  <option value="01">January</option>
  <option value="02">February</option>
  <option value="03">March</option>
  <option value="04">April</option>
  <option value="05">May</option>
  <option value="06">June</option>
  <option value="07">July</option>
  <option value="08">August</option>
  <option value="09">September</option>
  <option value="10">October</option>
  <option value="11">November</option>
  <option value="12">December</option>
  
</select>

<select id="date" name="date" class="form-cntrl-birth">

  <option value="01">01</option>
  <option value="02">02</option>
  <option value="03">03</option>
  <option value="04">04</option>
  <option value="05">05</option>
  <option value="06">06</option>
  <option value="07">07</option>
  <option value="08">08</option>
  <option value="09">09</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
  
</select><br>

<!---------------- Address ------------------->
<span class="label">Address (Area and/or City)*</span><br>

<input type = "text" id = "adrs" name = "adrs" class = "form-cntrl" placeholder = "E.g. SB Marg, Lower Parel, Mumbai.." required = "required" minlength = "1" maxlength = "200" 

autocomplete = "off" autocorrect = "off" spellcheck = "false" /><br>

<!---------------- state ------------------->
<span class="label">State*</span><br>

<select id="state" name="state" class="form-cntrl">

  <option value="Andhra Pradesh">Andhra Pradesh</option>
  <option value="Arunachal Pradesh">Arunachal Pradesh</option>
  <option value="Assam">Assam</option>
  <option value="Bihar">Bihar</option>
  <option value="Chhattisgarh">Chhattisgarh</option>
  <option value="Goa">Goa</option>
  <option value="Gujarat">Gujarat</option>
  <option value="Haryana">Haryana</option>
  <option value="Himachal Pradesh">Himachal Pradesh</option>
  <option value="Jharkhand">Jharkhand</option>
  <option value="Karnataka">Karnataka</option>
  <option value="Kerala">Kerala</option>
  <option value="Madhya Pradesh">Madhya Pradesh</option>
  <option value="Maharashtra">Maharashtra</option>
  <option value="Manipur">Manipur</option>
  <option value="Meghalaya">Meghalaya</option>
  <option value="Mizoram">Mizoram</option>
  <option value="Nagaland">Nagaland</option>
  <option value="Odisha">Odisha</option>
  <option value="Punjab">Punjab</option>
  <option value="Rajasthan">Rajasthan</option>
  <option value="Sikkim">Sikkim</option>
  <option value="Tamil Nadu">Tamil Nadu</option>
  <option value="Telangana">Telangana</option>
  <option value="Tripura">Tripura</option>
  <option value="Uttar Pradesh">Uttar Pradesh</option>
  <option value="Uttarakhand">Uttarakhand</option>
  <option value="West Bengal">West Bengal</option>
  <option value="Union Territory">Union Territory</option>
  
</select><br>

<!-------------- missing date ------------->
<span class="label">Date Of Missing*</span><br> 

<select id="year2" name="year2" class="form-cntrl-birth">
 
  <option value="1928">1928</option>
  <option value="1929">1929</option>
  <option value="1930">1930</option>
  <option value="1931">1931</option>
  <option value="1932">1932</option>
  <option value="1933">1933</option>
  <option value="1934">1934</option>
  <option value="1935">1935</option>
  <option value="1936">1936</option>
  <option value="1937">1937</option>
  <option value="1938">1938</option> 
  
  <option value="1939">1939</option>
  <option value="1940">1940</option>
  <option value="1941">1941</option>
  <option value="1942">1942</option>
  <option value="1943">1943</option>
  <option value="1944">1944</option>
  <option value="1945">1945</option>
  <option value="1946">1946</option>
  <option value="1947">1947</option>
  <option value="1948">1948</option>
  <option value="1949">1949</option>
   
  <option value="1950">1950</option>
  <option value="1951">1951</option>
  <option value="1952">1952</option>
  <option value="1953">1953</option>
  <option value="1954">1954</option>
  <option value="1955">1955</option>
  <option value="1956">1956</option>
  <option value="1957">1957</option>
  <option value="1958">1958</option>
  <option value="1959">1959</option>
  <option value="1960">1960</option>
  <option value="1961">1961</option>
  <option value="1962">1962</option>
  <option value="1963">1963</option>
  <option value="1964">1964</option>
  <option value="1965">1965</option>
  <option value="1966">1966</option>
  <option value="1967">1967</option>
  <option value="1968">1968</option>
  <option value="1969">1969</option>
  <option value="1970">1970</option>
  <option value="1971">1971</option>
  <option value="1972">1972</option>
  <option value="1973">1973</option>
  <option value="1974">1974</option>
  <option value="1975">1975</option>
  <option value="1976">1976</option>
  <option value="1977">1977</option>
  <option value="1978">1978</option>
  <option value="1979">1979</option>
  <option value="1980">1980</option>
  <option value="1981">1981</option>
  <option value="1982">1982</option>
  <option value="1983">1983</option>
  <option value="1984">1984</option>
  <option value="1985">1985</option>
  <option value="1986">1986</option>
  <option value="1987">1987</option>
  <option value="1988">1988</option>
  <option value="1989">1989</option>
  <option value="1990">1990</option>
  <option value="1991">1991</option>
  <option value="1992">1992</option>
  <option value="1993">1993</option>
  <option value="1994">1994</option>
  <option value="1995">1995</option>
  <option value="1996">1996</option>
  <option value="1997">1997</option>
  <option value="1998">1998</option>
  <option value="1999">1999</option>
  <option value="2000">2000</option>
  <option value="2001">2001</option>
  <option value="2002">2002</option>
  <option value="2003">2003</option>
  <option value="2004">2004</option>
  <option value="2005">2005</option>
  <option value="2006">2006</option>
  <option value="2007">2007</option>
  <option value="2008">2008</option>
  <option value="2009">2009</option>
  <option value="2010">2010</option>
  <option value="2011">2011</option>
  <option value="2012">2012</option>
  <option value="2013">2013</option>
  <option value="2014">2014</option>
  <option value="2015">2015</option>
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option>
  <option value="2019">2019</option>
  <option value="2020">2020</option>
  <option value="before">Before 1928</option>
  
</select>

<select id="month2" name="month2" class="form-cntrl-birth">

  <option value="01">January</option>
  <option value="02">February</option>
  <option value="03">March</option>
  <option value="04">April</option>
  <option value="05">May</option>
  <option value="06">June</option>
  <option value="07">July</option>
  <option value="08">August</option>
  <option value="09">September</option>
  <option value="10">October</option>
  <option value="11">November</option>
  <option value="12">December</option>
  
</select>

<select id="date2" name="date2" class="form-cntrl-birth">

  <option value="01">01</option>
  <option value="02">02</option>
  <option value="03">03</option>
  <option value="04">04</option>
  <option value="05">05</option>
  <option value="06">06</option>
  <option value="07">07</option>
  <option value="08">08</option>
  <option value="09">09</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
  
</select><br>  

<!---------------- Any Description about missing person ----->
<span class="label">Description*</span><br>

<textarea id="desc" name="desc" rows="5" cols="50" class="form-cntrl-desc" placeholder="Description length should be between 1 to 300 characters" required="required" 
minlength='1' maxlength='300' spellcheck = "false" ></textarea><br>

<!---------------- image of the missing person ----->
<span class="label">Photo Of Missing Person*</span><br>

<input type = 'file' name = 'avatar' id = 'avatar' class='form-cntrl-img' required = 'required' /><br>


<div class='contact_detail_title'>Details of Contact Person</div>

<!-------------- name of contact person ------------->
<span class="label">Name of Contact Person*</span><br>

<input type = "text" id = "contact_p_name" name = "contact_p_name" class = "form-cntrl" placeholder = "Name of the contact person" required = "required" minlength = "1" 

maxlength = "25" 

pattern = "[A-Za-z\s]{1,25}$" 

required title = "Name Must Be Only In English Letters, And It Should Not Be More Than 25 Characters.*" autocomplete = "off" autocorrect = "off" spellcheck = "false" /><br>

<!-------------- contact of contact person ------------->
<span class="label">Mobile/Phone Number of Contact Person*</span><br>

<input type = "text" id = "contact_p_num" name = "contact_p_num" class = "form-cntrl" placeholder = "Number of the contact person" required = "required" minlength = "1" 

maxlength = "25" 

pattern = "[0-9]{1,25}$" 

required title = "Contact Number Can Only Be Digit And Should Be Less Than 26 Digits Without Any Space And Special Characters.*" 

autocomplete = "off" autocorrect = "off" spellcheck = "false" /><br>

<!-------------- Submit Button ------------->

<input class = "btn" type = "submit" id = "submit" name = "submit" value = "Post" title = "Click Here To Post This Case" /><br>

</form>

</div>

<p class='nt'><b><u>Note</u> : </b>You Cannot Edit Your Case Later, However You Can Delete It. Please Check All The Details Carefully, Before You Post It.</p>

</div>

</center>

</div>

<br>

<!----------------------- Footer ----------------------->
<div class='footr'>

<!--- test -->
<div class='dis_none'>

<a href='khojhai_setting.php' class='link_footr2' title='Settings'>Setting</a>

<span class="vl"></span>

<a href='khojhai_logout.php' class='link_footr2' title='SignOut'>Logout</a>

<span class="vl"></span><br>

</div>
<!-- test pass/fail -->

<a href='khojhai_about.php' class='link_footr' title='Know more about us'>About Us</a>

<span class="vl"></span>

<a href='khojhai_contact.php' class='link_footr' title='Contact Us'>Contact Us</a>

<span class="vl"></span>

<a href='khojhai_press.php' class='link_footr' title='Latest News About Us'>Press</a>

<span class="vl"></span>

<a href='khojhai_fund.php' class='link_footr' title='Who Supports Us'>Funding</a><br>

<div class='cpy2'><span class='copyrt'>&copy; Copyright 450 BC - 2020</span></div>

</div>

</center>

</body>

</html>