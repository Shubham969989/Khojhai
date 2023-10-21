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

<title>Delete This Case | KhojHai.com</title>

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
background-color:#000;
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
background-color : #fff;
padding-bottom : 5px;
padding-top : 6px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
margin-bottom : 3px;
margin-top : -7px;
padding-left : 12px;	
padding-right : 12px;
line-height : 1.3;	
}
.warn{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
margin-top : 15px;
margin-left : 35px;
padding-left : 15px;
padding-right : 15px;
}
.warn2{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
margin-left : -20px;
padding-right : 15px;
line-height : 1.5;
}
.div_btn{
	
}
.cancel{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #000;
background-color : #e7e7e7;	
border : thin solid #363030;
margin-top : 3px;
margin-bottom : 13px;
padding-top : 12px;
padding-bottom : 12px;
padding-left : 60px;
padding-right : 60px;
border-radius : 5px;
}
.cancel:hover{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #000;	
border : thin solid #363030;	
}
.cancel:active{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #000;	
border : thin solid #363030;	
}
.cancel:visited{
text-decoration: none;
display: inline-block;	
color : #000;
background-color : #e7e7e7;	
}
.dlt{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #ff0000;	
border : thin solid #363030;
margin-top : 5px;
margin-bottom : 13px;
padding-top : 12px;
padding-bottom : 12px;
padding-left : 60px;
padding-right : 60px;
border-radius : 5px;
}
.dlt:hover{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #cc0000;	
border : thin solid #363030;	
}
.dlt:active{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #cc0000;	
border : thin solid #363030;	
}
.dlt:visited{
text-decoration: none;
display: inline-block;	
color : #fff;
background-color : #ff0000;	
}
.bottom_links:visited{
color : #000;
text-decoration : none;
}
.bottom_links{
color : #000;
text-decoration : none;
}
.bottom_links:hover{
color: #000;
text-decoration : none;
}
.bottom_links:active {
color: #000;
text-decoration : none;
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
background-color:#000;
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
.missing_detail_title{
background-color : #fff;
padding-bottom : 5px;
padding-top : 6px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
margin-bottom : 3px;
margin-top : -1px;
padding-left : 12px;	
padding-right : 12px;
line-height : 1.3;	
}
.warn{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
margin-top : 15px;
margin-left : 80px;
padding-left : 20px;
padding-right : 15px;
}
.warn2{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
margin-left : -20px
padding-right : 20px;
padding-right : 70px;
line-height : 1.5;
}
.div_btn{
padding-bottom : 20px;	
}
.cancel{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #000;
background-color : #e7e7e7;	
border : thin solid #363030;
margin-top : 3px;
margin-bottom : 13px;
padding-top : 12px;
padding-bottom : 12px;
padding-left : 70px;
padding-right : 70px;
border-radius : 5px;
}
.cancel:hover{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #000;	
border : thin solid #363030;	
}
.cancel:active{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #000;	
border : thin solid #363030;	
}
.cancel:visited{
text-decoration: none;
display: inline-block;	
color : #000;
background-color : #e7e7e7;	
}
.dlt{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #ff0000;	
border : thin solid #363030;
margin-top : 5px;
margin-bottom : 13px;
padding-top : 12px;
padding-bottom : 12px;
padding-left : 70px;
padding-right : 70px;
border-radius : 5px;
}
.dlt:hover{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #cc0000;	
border : thin solid #363030;	
}
.dlt:active{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #cc0000;	
border : thin solid #363030;	
}
.dlt:visited{
text-decoration: none;
display: inline-block;	
color : #fff;
background-color : #ff0000;	
}
.bottom_links:visited{
color : #000;
text-decoration : none;
}
.bottom_links{
color : #000;
text-decoration : none;
}
.bottom_links:hover{
color: #000;
text-decoration : none;
}
.bottom_links:active {
color: #000;
text-decoration : none;
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
background-color:#000;
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
.missing_detail_title{
background-color : #fff;
padding-bottom : 5px;
padding-top : 6px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
margin-bottom : 3px;
margin-top : -1px;
padding-left : 12px;	
padding-right : 12px;
line-height : 1.3;	
}
.warn{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
margin-top : 15px;
margin-left : 80px;
padding-left : 20px;
padding-right : 15px;
}
.warn2{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
margin-left : -20px
padding-right : 20px;
padding-right : 70px;
line-height : 1.5;
}
.div_btn{
padding-bottom : 20px;	
}
.cancel{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #000;
background-color : #e7e7e7;	
border : thin solid #363030;
margin-top : 3px;
margin-bottom : 13px;
padding-top : 12px;
padding-bottom : 12px;
padding-left : 70px;
padding-right : 70px;
border-radius : 5px;
}
.cancel:hover{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #000;	
border : thin solid #363030;	
}
.cancel:active{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #000;	
border : thin solid #363030;	
}
.cancel:visited{
text-decoration: none;
display: inline-block;	
color : #000;
background-color : #e7e7e7;	
}
.dlt{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #ff0000;	
border : thin solid #363030;
margin-top : 5px;
margin-bottom : 13px;
padding-top : 12px;
padding-bottom : 12px;
padding-left : 70px;
padding-right : 70px;
border-radius : 5px;
}
.dlt:hover{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #cc0000;	
border : thin solid #363030;	
}
.dlt:active{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #cc0000;	
border : thin solid #363030;	
}
.dlt:visited{
text-decoration: none;
display: inline-block;	
color : #fff;
background-color : #ff0000;	
}
.bottom_links:visited{
color : #000;
text-decoration : none;
}
.bottom_links{
color : #000;
text-decoration : none;
}
.bottom_links:hover{
color: #000;
text-decoration : none;
}
.bottom_links:active {
color: #000;
text-decoration : none;
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
background-color:#000;
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
.missing_detail_title{
background-color : #fff;
padding-bottom : 5px;
padding-top : 6px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
margin-bottom : 3px;
margin-top : -1px;
padding-left : 12px;	
padding-right : 12px;
line-height : 1.3;	
}
.warn{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
margin-top : 15px;
margin-left : 80px;
padding-left : 20px;
padding-right : 15px;
}
.warn2{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
margin-left : -20px
padding-right : 20px;
padding-right : 70px;
line-height : 1.5;
}
.div_btn{
padding-bottom : 20px;	
}
.cancel{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #000;
background-color : #e7e7e7;	
border : thin solid #363030;
margin-top : 3px;
margin-bottom : 13px;
padding-top : 12px;
padding-bottom : 12px;
padding-left : 70px;
padding-right : 70px;
border-radius : 5px;
}
.cancel:hover{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #000;	
border : thin solid #363030;	
}
.cancel:active{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #000;	
border : thin solid #363030;	
}
.cancel:visited{
text-decoration: none;
display: inline-block;	
color : #000;
background-color : #e7e7e7;	
}
.dlt{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #ff0000;	
border : thin solid #363030;
margin-top : 5px;
margin-bottom : 13px;
padding-top : 12px;
padding-bottom : 12px;
padding-left : 70px;
padding-right : 70px;
border-radius : 5px;
}
.dlt:hover{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #cc0000;	
border : thin solid #363030;	
}
.dlt:active{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #cc0000;	
border : thin solid #363030;	
}
.dlt:visited{
text-decoration: none;
display: inline-block;	
color : #fff;
background-color : #ff0000;	
}
.bottom_links:visited{
color : #000;
text-decoration : none;
}
.bottom_links{
color : #000;
text-decoration : none;
}
.bottom_links:hover{
color: #000;
text-decoration : none;
}
.bottom_links:active {
color: #000;
text-decoration : none;
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
background-color:#000;
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
.missing_detail_title{
background-color : #fff;
padding-bottom : 5px;
padding-top : 6px;
font-size : 17px;
font-weight : bold;
font-family : Arial, Tahoma;
margin-bottom : 3px;
margin-top : -1px;
padding-left : 12px;	
padding-right : 12px;
line-height : 1.3;	
}
.warn{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
margin-top : 15px;
margin-left : 80px;
padding-left : 20px;
padding-right : 15px;
}
.warn2{
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
margin-left : -20px
padding-right : 20px;
padding-right : 70px;
line-height : 1.5;
}
.div_btn{
padding-bottom : 20px;	
}
.cancel{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #000;
background-color : #e7e7e7;	
border : thin solid #363030;
margin-top : 3px;
margin-bottom : 13px;
padding-top : 12px;
padding-bottom : 12px;
padding-left : 70px;
padding-right : 70px;
border-radius : 5px;
}
.cancel:hover{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #000;	
border : thin solid #363030;	
}
.cancel:active{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #000;	
border : thin solid #363030;	
}
.cancel:visited{
text-decoration: none;
display: inline-block;	
color : #000;
background-color : #e7e7e7;	
}
.dlt{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #ff0000;	
border : thin solid #363030;
margin-top : 5px;
margin-bottom : 13px;
padding-top : 12px;
padding-bottom : 12px;
padding-left : 70px;
padding-right : 70px;
border-radius : 5px;
}
.dlt:hover{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #cc0000;	
border : thin solid #363030;	
}
.dlt:active{
text-align: center;
text-decoration: none;
display: inline-block;
font-size : 17px;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-weight : bold;
cursor: pointer;	
color : #fff;
background-color : #cc0000;	
border : thin solid #363030;	
}
.dlt:visited{
text-decoration: none;
display: inline-block;	
color : #fff;
background-color : #ff0000;	
}
.bottom_links:visited{
color : #000;
text-decoration : none;
}
.bottom_links{
color : #000;
text-decoration : none;
}
.bottom_links:hover{
color: #000;
text-decoration : none;
}
.bottom_links:active {
color: #000;
text-decoration : none;
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


//added by id 
$added_by = $qry_ftch0['added_by_id'];

$added_by = mysqli_real_escape_string($con, $added_by);


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
		echo "<h4 class = 'missing_detail_title'>Are You Sure You Want To Delete This Case ?</h4>";
		
		echo "<ul><li class='warn'><p class='warn2'>This Case Will Be Permanently Deleted, This Cannot Be Undone.</p></li>";
		
		echo "<li class='warn'><p class='warn2'>This Case Will No Longer Appear On This Site, Nobody Can Search This Case.</p></li></ul><br>";
		
		echo "<div class='div_btn'>";
		
		echo "<a href='khojhai_view_missing.php?id=$case_id' class='bottom_links'><button class='cancel'>Cancel</button></a><br>";
		
		echo "<a href='khojhai_delete_case2.php?id=$case_id' class='bottom_links'><button class='dlt'>Delete</button></a><br>";
		
		echo "</div>";
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