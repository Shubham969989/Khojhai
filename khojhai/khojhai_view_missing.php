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

<title>Missing Person Details | KhojHai.com</title>

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
.err-wrap{
width : 100%;
background-color : #00b300;
align-content : center;
margin-top :-15px;
padding-top : 5px;
padding-bottom : 8px;
margin-bottom : 17px;
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
background-color:#00b300;
text-decoration : none;
}
.err-close{
color : #ffffff;
background-color:#00b300;
font-family : arial, tahoma;
font-size : 18px;
font-weight : bold;
text-decoration : none;
}
.err-close:hover{
color: #0d0d0d;
text-decoration:none;	
background-color:#00b300;
transition: all 0.2s ease-in;
}
.err-close:active {
color: #ffffff;
background-color:#00b300;
text-decoration : none;
}
.missing_img{
text-align:center;
width : 80%;
max-width : 80%;
background-color : #fff;
border-radius : 0px;
border : 0.0px solid #404040;
margin-top : -15px;
align-content : center;
margin-bottom : -24px;
}
.missing_img2{
width: 100%;
max-width : 370px;
height: auto;
max-height : 650px;
border-radius : 0px;	
}
.missing_detail_title{
background-color : #e6e6e6;
padding-bottom : 5px;
padding-top : 6px;
font-size : 14px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -14px;
margin-right : -17px;
margin-bottom : 3px;
margin-top : -14px;	
}
.signup_form{
margin-top : 0px;	
}
.details{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
margin-top : 15px;
}
.sub-details{
color : #000;
background-color:#fff;	
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;	
margin-top : 3px;
}
.added_by_link{
font-size : 17px;	
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;	
}
.contact_detail_title{
background-color : #e6e6e6;
padding-bottom : 5px;
padding-top : 6px;
font-size : 14px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -14px;
margin-right : -17px;
margin-bottom : -22px;
margin-top : -8px;	
}
.line{
width : 100%;
border : thin solid #804200;
margin-bottom : 8px;
margin-top : 15px;
}
.bottom_links:visited{
color : blue;
background-color:#fff;
}
.bottom_links{
color : blue;
background-color:#fff;
font-size : 15px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
border-bottom : thin solid #000;
text-decoration : none;
line-height : 3;
}
.bottom_links:hover{
color: #000;
border-bottom : thin solid blue;
text-decoration : none;
background-color:#fff;
}
.bottom_links:active {
color: #000;
border-bottom : thin solid blue;
text-decoration : none;
background-color:#fff;
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
width : 100%;
background-color : #00b300;
align-content : center;
margin-top :-15px;
padding-top : 5px;
padding-bottom : 8px;
margin-bottom : 17px;
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
background-color:#00b300;
text-decoration : none;
}
.err-close{
color : #ffffff;
background-color:#00b300;
font-family : arial, tahoma;
font-size : 18px;
font-weight : bold;
text-decoration : none;
}
.err-close:hover{
color: #0d0d0d;
text-decoration:none;	
background-color:#00b300;
transition: all 0.2s ease-in;
}
.err-close:active {
color: #ffffff;
background-color:#00b300;
text-decoration : none;
}
.missing_img{
text-align:center;
width : 80%;
max-width : 80%;
background-color : #fff;
border-radius : 0px;
border : 0.0px solid #404040;
margin-top : -15px;
align-content : center;
margin-bottom : -24px;
}
.missing_img2{
width: 100%;
max-width : 400px;
height: auto;
max-height : 650px;
border-radius : 0px;	
}
.missing_detail_title{
background-color : #e6e6e6;
padding-bottom : 5px;
padding-top : 5px;
font-size : 15px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -19.5px;
margin-right : -19.5px;
margin-bottom : 3px;
margin-top : -14px;	
}
.signup_form{
margin-top : 0px;	
}
.details{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;	
margin-top : 15px;
}
.sub-details{
color : #000;
background-color:#fff;	
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;	
margin-top : 3px;
}
.added_by_link{
font-size : 17px;	
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;	
}
.contact_detail_title{
background-color : #e6e6e6;
padding-bottom : 5px;
padding-top : 5px;
font-size : 15px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -19.5px;
margin-right : -19.5px;
margin-bottom : -22px;
margin-top : -8px;	
}
.line{
width : 100%;
border : thin solid #804200;
margin-bottom : 8px;
margin-top : 15px;
}
.bottom_links:visited{
color : blue;
background-color:#fff;
}
.bottom_links{
color : blue;
background-color:#fff;
font-size : 15px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
border-bottom : thin solid #000;
text-decoration : none;
line-height : 3;
}
.bottom_links:hover{
color: #000;
border-bottom : thin solid blue;
text-decoration : none;
background-color:#fff;
}
.bottom_links:active {
color: #000;
border-bottom : thin solid blue;
text-decoration : none;
background-color:#fff;
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
background-color : #00b300;
align-content : center;
margin-top :-15px;
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
background-color:#00b300;
text-decoration : none;
}
.err-close{
color : #ffffff;
background-color:#00b300;
font-family : arial, tahoma;
font-size : 18px;
font-weight : bold;
text-decoration : none;
}
.err-close:hover{
color: #0d0d0d;
text-decoration:none;	
background-color:#00b300;
transition: all 0.2s ease-in;
}
.err-close:active {
color: #ffffff;
background-color:#00b300;
text-decoration : none;
}
.missing_img{
text-align:center;
width : 80%;
max-width : 80%;
background-color : #fff;
border-radius : 0px;
border : 0.0px solid #404040;
margin-top : -15px;
align-content : center;
margin-bottom : -24px;
}
.missing_img2{
width: 100%;
max-width : 400px;
height: auto;
max-height : 680px;
border-radius : 0px;	
}
.missing_detail_title{
background-color : #e6e6e6;
padding-bottom : 5px;
padding-top : 5px;
font-size : 15px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -99.5px;
margin-right : -99.5px;
margin-bottom : 3px;
margin-top : -14px;	
}
.signup_form{
margin-top : 0px;	
}
.details{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;	
margin-top : 18px;
}
.sub-details{
color : #000;
background-color:#fff;	
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;	
margin-top : 3px;
}
.added_by_link{
font-size : 17px;	
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
}
.contact_detail_title{
background-color : #e6e6e6;
padding-bottom : 5px;
padding-top : 5px;
font-size : 15px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -99.5px;
margin-right : -99.5px;
margin-bottom : -22px;
margin-top : -2px;	
}
.line{
width : 100%;
border : thin solid #804200;
margin-bottom : 8px;
margin-top : 15px;
}
.bottom_links:visited{
color : blue;
background-color:#fff;
}
.bottom_links{
color : blue;
background-color:#fff;
font-size : 15px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
border-bottom : thin solid #000;
text-decoration : none;
line-height : 3;
}
.bottom_links:hover{
color: #000;
border-bottom : thin solid blue;
text-decoration : none;
background-color:#fff;
}
.bottom_links:active {
color: #000;
border-bottom : thin solid blue;
text-decoration : none;
background-color:#fff;
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
background-color : #00b300;
align-content : center;
margin-top :-21px;
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
background-color:#00b300;
text-decoration : none;
}
.err-close{
color : #ffffff;
background-color:#00b300;
font-family : arial, tahoma;
font-size : 18px;
font-weight : bold;
text-decoration : none;
}
.err-close:hover{
color: #0d0d0d;
text-decoration:none;	
background-color:#00b300;
transition: all 0.2s ease-in;
}
.err-close:active {
color: #ffffff;
background-color:#00b300;
text-decoration : none;
}
.missing_img{
text-align:center;
width : 80%;
max-width : 80%;
background-color : #fff;
border-radius : 0px;
border : 0.0px solid #404040;
margin-top : -15px;
align-content : center;
margin-bottom : -24px;
}
.missing_img2{
width: 100%;
max-width : 350px;
height: auto;
max-height : 550px;
border-radius : 0px;	
}
.missing_detail_title{
background-color : #e6e6e6;
padding-bottom : 5px;
padding-top : 5px;
font-size : 15px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -149px;
margin-right : -149px;
margin-bottom : 5px;
margin-top : -14px;	
}
.signup_form{
margin-top : 0px;	
}
.details{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;	
margin-top : 18px;
}
.sub-details{
color : #000;
background-color:#fff;	
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;	
margin-top : 3px;
}
.added_by_link{
font-size : 17px;	
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;	
}
.contact_detail_title{
background-color : #e6e6e6;
padding-bottom : 5px;
padding-top : 5px;
font-size : 15px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
margin-left : -149px;
margin-right : -149px;
margin-bottom : -22px;
margin-top : 0px;	
}
.line{
width : 100%;
border : thin solid #804200;
margin-bottom : 8px;
margin-top : 15px;
}
.bottom_links:visited{
color : blue;
background-color:#fff;
}
.bottom_links{
color : blue;
background-color:#fff;
font-size : 15px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
border-bottom : thin solid #000;
text-decoration : none;
line-height : 2.8;
}
.bottom_links:hover{
color: #000;
border-bottom : thin solid blue;
text-decoration : none;
background-color:#fff;
}
.bottom_links:active {
color: #000;
border-bottom : thin solid blue;
text-decoration : none;
background-color:#fff;
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
background-color : #00b300;
align-content : center;
margin-top :-25px;
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
background-color:#00b300;
text-decoration : none;
}
.err-close{
color : #ffffff;
background-color:#00b300;
font-family : arial, tahoma;
font-size : 18px;
font-weight : bold;
text-decoration : none;
}
.err-close:hover{
color: #0d0d0d;
text-decoration:none;	
background-color:#00b300;
transition: all 0.2s ease-in;
}
.err-close:active {
color: #ffffff;
background-color:#00b300;
text-decoration : none;
}
.missing_img{
text-align:center;
width : 80%;
max-width : 80%;
background-color : #fff;
border-radius : 0px;
border : 0.0px solid #404040;
margin-top : -17px;
align-content : center;
margin-bottom : -25px;
}
.missing_img2{
width: 100%;
max-width : 350px;
height: auto;
max-height : 550px;
border-radius : 0px;	
}
.missing_detail_title{
background-color : #e6e6e6;
padding-bottom : 6px;
padding-top : 6px;
font-size : 16px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
width : 100%;
max-width : 100%;
margin-left : 1px;
margin-bottom : 5px;
margin-top : -18px;
}
.contact_detail_title{
background-color : #e6e6e6;
padding-bottom : 6px;
padding-top : 6px;
font-size : 16px;
font-weight : bold;
font-family : Arial, Tahoma;
border : 1px solid #e6e6e6;
border-radius : 0px;
width : 100%;
max-width : 100%;
margin-left : 1px;
margin-bottom : -23px;
margin-top : 0px;	
}
.signup_form{
margin-top : 0px;	
}
.details{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;	
margin-top : 19px;
}
.sub-details{
color : #000;
background-color:#fff;	
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;	
margin-top : 3px;
}
.added_by_link{
font-size : 17px;	
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;	
}
.line{
width : 100%;
border : thin solid #804200;
margin-bottom : 8px;
margin-top : 15px;
}
.bottom_links:visited{
color : blue;
background-color:#fff;
}
.bottom_links{
color : blue;
background-color:#fff;
font-size : 15px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
border-bottom : thin solid #000;
text-decoration : none;
line-height : 2.8;
}
.bottom_links:hover{
color: #000;
border-bottom : thin solid blue;
text-decoration : none;
background-color:#fff;
}
.bottom_links:active {
color: #000;
border-bottom : thin solid blue;
text-decoration : none;
background-color:#fff;
}
}
</style>		
<!-- Required header files -->
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
	
echo "<p class='err'>Posted Successfully.<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

//------------------------- Error No 2 : For contact number ---------------------------//
if($r == 2)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Case Status Changed Successfully.
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

//------------------------- Error No 3 : For name ---------------------------//
if($r == 3)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Reported Successfully.
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}



if($r == 4)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Unsaved Successfully.
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}



if($r == 5)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Saved Successfully.
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}
?>
<!--- Error Ends ------->

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

$get_id = $get_id;

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


	
$qry3 = mysqli_query($con, "select * from cases where id = '$get_id' ");

$qry_count3 = mysqli_num_rows($qry3);

if($qry_count3 < 1)
{
header("Location: khojhai_home.php");
exit();
}

$qry_ftch3 = mysqli_fetch_array($qry3);

//1.
$case_id = $qry_ftch3['id'];

//2.
$case_name = $qry_ftch3['name'];

//3.
$case_gender = $qry_ftch3['gender'];

//4.
$case_age = $qry_ftch3['age'];

//5.
$case_adrs = $qry_ftch3['address'];

//6.
$case_state = $qry_ftch3['state'];

//7.
$case_date_missing = $qry_ftch3['date_missing'];

//8.
$case_desc = $qry_ftch3['description'];

//9(a).
$case_image_name = $qry_ftch3['case_image'];

//9(b).
$case_image_loc = 'case_image/'.$case_id.'/'.$case_image_name.'';

//10.
$contact_p_name = $qry_ftch3['contact_person_name'];

//11.
$contact_p_number = $qry_ftch3['contact_person_number'];

//12.
$case_added_by = $qry_ftch3['added_by_id'];

//13.
$case_added_on = $qry_ftch3['added_on'];

//14.
$case_status = $qry_ftch3['status'];

$qry2 = mysqli_query($con, "SELECT name FROM users WHERE id = '$case_added_by' LIMIT 1");

$qry_ftch4 = mysqli_fetch_array($qry2);

$case_added_by_name = $qry_ftch4['name'];



//4(B)---- For Age
$dateOfBirth = $case_age;

$today = date("Y-m-d");

$diff = date_diff(date_create($dateOfBirth), date_create($today));

$case_age = $diff->format('%y');



//7(B)
if($case_date_missing == 'Before 1928')
{
$case_date_missing = "Before 1928";
}

else 
{
$case_missing_month = substr($case_date_missing, 5,2);

//january
if($case_missing_month == '01')
{
$missing_month = 'January';

$missing_date = substr($case_date_missing, 8,2);

$missing_year = substr($case_date_missing, 0,4);

$case_date_missing = "$missing_date $missing_month $missing_year";
}

//february
elseif($case_missing_month == '02')
{
$missing_month = 'February';

$missing_date = substr($case_date_missing, 8,2);

$missing_year = substr($case_date_missing, 0,4);

$case_date_missing = "$missing_date $missing_month $missing_year";
}

//march
elseif($case_missing_month == '03')
{
$missing_month = 'March';

$missing_date = substr($case_date_missing, 8,2);

$missing_year = substr($case_date_missing, 0,4);

$case_date_missing = "$missing_date $missing_month $missing_year";
}

//april
elseif($case_missing_month == '04')
{
$missing_month = 'April';

$missing_date = substr($case_date_missing, 8,2);

$missing_year = substr($case_date_missing, 0,4);

$case_date_missing = "$missing_date $missing_month $missing_year";
}

//may
elseif($case_missing_month == '05')
{
$missing_month = 'May';

$missing_date = substr($case_date_missing, 8,2);

$missing_year = substr($case_date_missing, 0,4);

$case_date_missing = "$missing_date $missing_month $missing_year";
}

//june
elseif($case_missing_month == '06')
{
$missing_month = 'June';

$missing_date = substr($case_date_missing, 8,2);

$missing_year = substr($case_date_missing, 0,4);

$case_date_missing = "$missing_date $missing_month $missing_year";
}

//july
elseif($case_missing_month == '07')
{
$missing_month = 'July';

$missing_date = substr($case_date_missing, 8,2);

$missing_year = substr($case_date_missing, 0,4);

$case_date_missing = "$missing_date $missing_month $missing_year";
}

//august
elseif($case_missing_month == '08')
{
$missing_month = 'August';

$missing_date = substr($case_date_missing, 8,2);

$missing_year = substr($case_date_missing, 0,4);

$case_date_missing = "$missing_date $missing_month $missing_year";
}

//september
elseif($case_missing_month == '09')
{
$missing_month = 'September';

$missing_date = substr($case_date_missing, 8,2);

$missing_year = substr($case_date_missing, 0,4);

$case_date_missing = "$missing_date $missing_month $missing_year";
}

//october
elseif($case_missing_month == '10')
{
$missing_month = 'October';

$missing_date = substr($case_date_missing, 8,2);

$missing_year = substr($case_date_missing, 0,4);

$case_date_missing = "$missing_date $missing_month $missing_year";
}

//november
elseif($case_missing_month == '11')
{
$missing_month = 'November';

$missing_date = substr($case_date_missing, 8,2);

$missing_year = substr($case_date_missing, 0,4);

$case_date_missing = "$missing_date $missing_month $missing_year";
}

//december
elseif($case_missing_month == '12')
{
$missing_month = 'December';

$missing_date = substr($case_date_missing, 8,2);

$missing_year = substr($case_date_missing, 0,4);

$case_date_missing = "$missing_date $missing_month $missing_year";
}

//none
else
{
$case_date_missing = 'NA';
}

    }


echo "<div class='missing_detail_title'>Missing Person</div><br>";

echo "<center><div class='missing_img'>

      <img src=".$case_image_loc." alt=".$case_name." class='missing_img2' />
	  
	  </div></center><br>";

echo "<div class='details'>Case ID<div class='sub-details' style='margin-bottom:-4px;'>$case_id</div></div>";
	  
echo "<div class='details'>Name<div class='sub-details'>$case_name</div></div>";

echo "<div class='details'>Gender<div class='sub-details'>$case_gender</div></div>";	

echo "<div class='details'>Age<div class='sub-details'>$case_age Years Old</div></div>";

echo "<div class='details'>Address<div class='sub-details' style='padding-left:28px; padding-right:28px; line-height:1.4; margin-bottom:-2px; margin-top:2px;'>$case_adrs</div></div>";

echo "<div class='details'>State<div class='sub-details'>$case_state</div></div>";

echo "<div class='details'>Missing Date<div class='sub-details'>$case_date_missing</div></div>";

echo "<div class='details'>Description<div class='sub-details' style='padding-left:28px; padding-right:28px; line-height:1.5; margin-bottom:-2px; margin-top:2px;'>$case_desc</div></div>";

if($case_status == 'Open')
{
echo "<div class='details'>Case Status<div class='sub-details' style='color:red;'>$case_status</div></div>";
}

else
{
echo "<div class='details'>Case Status<div class='sub-details' style='color:green;'>$case_status</div></div>";	
}

echo "<div class='details'>Added By<div class='sub-details'><a href='khojhai_profile.php?id=$case_added_by' class='added_by_link'>$case_added_by_name</a></div></div>";

echo "<div class='details'>Added On<div class='sub-details'>$case_added_on</div></div><br>";

echo "<div class='contact_detail_title'>Contact Person</div><br>";

echo "<div class='details'>Name Of Contact Person<div class='sub-details'>$contact_p_name</div></div>";

echo "<div class='details'>Number Of Contact Person<div class='sub-details'>$contact_p_number</div></div>";

echo "<hr class='line' />";

if($case_added_by == $sess_id)
{
$qry5 = mysqli_query($con, "SELECT status FROM cases WHERE id = '$case_id' ");

$qry_ftch5 = mysqli_fetch_array($qry5); 

$final_case_status = $qry_ftch5['status'];

if($final_case_status == 'Open')
{
echo "<a href='khojhai_found_case.php?id=$case_id' class='bottom_links' title='This Case Is Solved !!'>Case Solved</a><br>";	
}	

else
{
echo "<a href='khojhai_found_case.php?id=$case_id' class='bottom_links' title='This Case Is Not Solved Yet !!'>Case Open</a><br>";	
}

echo "<a href='khojhai_delete_case.php?id=$case_id' class='bottom_links' title='Delete This Case'>Delete This Case</a><br>";

$qry6 = mysqli_query($con, "SELECT * FROM case_followers WHERE case_id = '$case_id' AND follower_id = '$sess_id' ");

$qry_count6 = mysqli_num_rows($qry6);	

if($qry_count6 > 0)
{
echo "<a href='khojhai_save_case.php?id=$case_id' class='bottom_links' title='Unsave This Case'>Unsave This Case</a><br>";
}

else
{
echo "<a href='khojhai_save_case.php?id=$case_id' class='bottom_links' title='Save This Case'>Save This Case</a><br>";
}
     }

else
{
echo "<a href='khojhai_report_case.php?id=$case_id' class='bottom_links' title='Report This Case'>Report This Case</a><br>";
	
$qry6 = mysqli_query($con, "SELECT * FROM case_followers WHERE case_id = '$case_id' AND follower_id = '$sess_id' ");

$qry_count6 = mysqli_num_rows($qry6);	

if($qry_count6 > 0)
{
echo "<a href='khojhai_save_case.php?id=$case_id' class='bottom_links' title='Unsave This Case'>Unsave This Case</a><br>";
}

else
{
echo "<a href='khojhai_save_case.php?id=$case_id' class='bottom_links' title='Save This Case'>Save This Case</a><br>";
}
    }
        }


else
{
header("Location: khojhai_home.php");
exit();
}

?>

</div>

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