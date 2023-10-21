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

<title>Saved Cases | KhojHai.com</title>

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
@media only screen and (max-width: 599.9px) {
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
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 580px;
background-color : #fff;
border-radius : 10px;
padding-top : 17px;
padding-bottom : 0px;
margin-top : -20px;
border : thin solid #c2bcbc;
padding-left : 15px;
padding-right : 18px;
margin-bottom : -25px;
}
.footr{
margin : 0 auto;	
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
.signup_form{
margin-top : -12px;	
}
.options{
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 580px;
background-color : #fff;
border-radius : 10px;
margin-top : 55px;
padding-top : 13px;
padding-bottom : 15px;
border : thin solid #c2bcbc;
}
.options2{
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 580px;
background-color : #fff;
border-radius : 10px;
margin-top : -15px;
padding-top : 12px;
padding-bottom : 15px;
border : thin solid #c2bcbc;
margin-bottom : -57px;
}
.link_option1:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.link_option1{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16.5px;
text-decoration : none;
border-bottom : thin solid blue;
}
.link_option1:hover{
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option1:active {
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option2:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.link_option2{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16.5px;
text-decoration : none;
border-bottom : thin solid blue;
}
.link_option2:hover{
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option2:active {
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.slideshow-container{
display : none;	
}
.hr{
width : 100%;
border : thin solid #804200;
margin-bottom : 12px;
margin-top : -20px;
}
.div_missing_img1{
margin : 0 auto;	
border : thin solid #e7e4e4;	
width : 100%;
max-width : 550px;
border-radius : 10px;
text-align : center;
padding-top : 7px;
padding-bottom : 11px;
padding-left : 10px;
padding-right : 10px;
margin-bottom : -10px;
overflow : hidden;
}
.missing_label{
font-family : "Times New Roman", Times, Serif;
font-size : 18px; 	
line-height : 1.6;
}
.missing_label_link:visited{
color : blue;
background-color:#fff;
text-decoration : underline;
}
.missing_label_link{
color : blue;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16px;
font-weight : bold;
text-decoration : underline;
line-height : 2.2;
}
.missing_label_link:hover{
color: #000080;
background-color:#fff;
text-decoration : underline;
}
.missing_label_link:active {
color: #000080;
background-color:#fff;
text-decoration : underline;
}
.missing_image2{
height:auto; 
max-height : 42vw;
width : 40vw; 
max-width:40vw; 
}
.miss_link:visited{
color : #000;
background-color:#fff;
text-decoration : underline;
}
.miss_link{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 17px;
font-weight : bold;
text-decoration : underline;
line-height : 2;
}
.miss_link:hover{
color: blue;
background-color:#fff;
text-decoration : underline;
}
.miss_link:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination:visited{
color : blue;
background-color:#fff;
text-decoration : none;
}
.pagination{
color : blue;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : none;
padding-left : 25px;
}
.pagination:hover{
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination_active:visited{
color : black;
background-color:#fff;
text-decoration : underline;
}
.pagination_active{
color : black;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : underline;
padding-left : 25px;
}
.pagination_active:hover{
color: black;
background-color:#fff;
text-decoration : underline;
}
.pagination_active:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.div_pagination{
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 580px;
background-color : #fff;
border-radius : 10px;
padding-top : 15px;
padding-bottom : 15px;
margin-top : 30px;
border : thin solid #c2bcbc;
padding-left : 0px;
padding-right : 5px;
margin-bottom : -20px;	
}
.user_profile2{
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 580px;
background-color : #fff;
border-radius : 10px;
padding-top : 10px;
padding-bottom : 12px;
margin-top : -20px;
border : thin solid #c2bcbc;
padding-left : 20px;
padding-right : 20px;
margin-bottom : -25px;	
overflow : hidden;
}
.profile_image2{
height:80px; 
max-height : 80px;
width : 80px; 
max-width:80px;
border-radius : 50%; 
border : thin solid #c2bcbc;
padding : 0px;
margin-bottom : 3px;
overflow : hidden;
}
.profile_label_name{
font-size : 18px;
color : #000;
background-color : #fff;
font-weight : bold;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
}
.profile_label{
font-size : 17px;
color : #000;
background-color : #fff;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
line-height : 1.5;
}
.name_remove{
margin-bottom : -13px;
}
.edit_profile_pic_link{
margin-top : 8px;	
margin-bottom : 10px;
}
.profile_pic_link:visited{
color : blue;
background-color:#fff;
text-decoration : underline;
}
.profile_pic_link{
color : blue;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 16px;
font-weight : bold;
text-decoration : underline;
}
.profile_pic_link:hover{
color: #ff4040;
background-color:#fff;
text-decoration : underline;
}
.profile_pic_link:active {
color: #ff4040;
background-color:#fff;
text-decoration : underline;
}
.user_profile_nav{
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 580px;
background-color : #fff;
border-radius : 10px;
padding-top : 16px;
padding-bottom : 18px;
margin-top : 10px;
border : thin solid #c2bcbc;
padding-left : 20px;
padding-right : 20px;
margin-bottom : 6px;	
overflow : hidden;
}
.profile_nav_link:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.profile_nav_link{
color : #000;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 16px;
font-weight : bold;
text-decoration : none;
}
.profile_nav_link:hover{
color: #4d4d4d;
background-color:#fff;
text-decoration : none;
border-bottom : medium solid #ff4040! important;
}
.profile_nav_link:active {
color: #4d4d4d;
background-color:#fff;
text-decoration : none;
}
.nav_link_space{
margin-left : 25px;	
}
}
/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) and (max-width: 767.9px) {
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
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 735px;
background-color : #fff;
border-radius : 10px;
padding-top : 17px;
padding-bottom : 0px;
margin-top : -20px;
border : thin solid #c2bcbc;
padding-left : 20px;
padding-right : 20px;
margin-bottom : -25px;
}
.footr{
margin : 0 auto;	
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
.signup_form{
margin-top : -12px;	
}
.label{
background-color : #fff;
color : #000;
font-size : 17px;
font-family : "Times New Roman", Times, Serif;	
}
.options{
margin : 0 auto;
text-align:center;
width : 97%;
max-width : 735px;
background-color : #fff;
border-radius : 10px;
margin-top : 58px;
padding-top : 13px;
padding-bottom : 15px;
border : thin solid #c2bcbc;
}
.options2{
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 735px;
background-color : #fff;
border-radius : 10px;
margin-top : -15px;
padding-top : 13px;
padding-bottom : 15.5px;
border : thin solid #c2bcbc;
margin-bottom : -57px;
}
.link_option1:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.link_option1{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16.5px;
text-decoration : none;
border-bottom : thin solid blue;
}
.link_option1:hover{
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option1:active {
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option2:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.link_option2{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16.5px;
text-decoration : none;
border-bottom : thin solid blue;
}
.link_option2:hover{
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option2:active {
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.slideshow-container{
display : none;	
}
.hr{
width : 100%;
border : thin solid #804200;
margin-bottom : 12px;
margin-top : -20px;
}
.div_missing_img1{
margin : 0 auto;	
border : thin solid #e7e4e4;	
width : 100%;
max-width : 700px;
border-radius : 10px;
text-align : center;
padding-top : 7px;
padding-bottom : 11px;
padding-left : 10px;
padding-right : 10px;
margin-bottom : -10px;
overflow : hidden;
}
.missing_label{
font-family : "Times New Roman", Times, Serif;
font-size : 18px; 	
line-height : 1.6;
}
.missing_label_link:visited{
color : blue;
background-color:#fff;
text-decoration : underline;
}
.missing_label_link{
color : blue;
background-color:#fff;
font-family : arial, tahoma;
font-size : 17px;
font-weight : bold;
text-decoration : underline;
line-height : 2.2;
}
.missing_label_link:hover{
color: #000080;
background-color:#fff;
text-decoration : underline;
}
.missing_label_link:active {
color: #000080;
background-color:#fff;
text-decoration : underline;
}
.missing_image2{
height:auto; 
max-height : 43vw;
width : 40vw; 
max-width:40vw; 
}
.miss_link:visited{
color : #000;
background-color:#fff;
text-decoration : underline;
}
.miss_link{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 18px;
font-weight : bold;
text-decoration : underline;
line-height : 2;
}
.miss_link:hover{
color: blue;
background-color:#fff;
text-decoration : underline;
}
.miss_link:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination:visited{
color : blue;
background-color:#fff;
text-decoration : none;
}
.pagination{
color : blue;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : none;
padding-left : 25px;
}
.pagination:hover{
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination_active:visited{
color : black;
background-color:#fff;
text-decoration : underline;
}
.pagination_active{
color : black;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : underline;
padding-left : 25px;
}
.pagination_active:hover{
color: black;
background-color:#fff;
text-decoration : underline;
}
.pagination_active:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.div_pagination{
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 735px;
background-color : #fff;
border-radius : 10px;
padding-top : 15px;
padding-bottom : 15px;
margin-top : 30px;
border : thin solid #c2bcbc;
padding-left : 5px;
padding-right : 5px;
margin-bottom : -20px;	
}
.user_profile2{
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 735px;
background-color : #fff;
border-radius : 10px;
padding-top : 10px;
padding-bottom : 15px;
margin-top : -20px;
border : thin solid #c2bcbc;
padding-left : 20px;
padding-right : 20px;
margin-bottom : -25px;	
overflow : hidden;
}
.profile_image2{
height:80px; 
max-height : 80px;
width : 80px; 
max-width:80px;
border-radius : 50%; 
border : thin solid #c2bcbc;
padding : 0px;
margin-bottom : 3px;
overflow : hidden;
}
.profile_label_name{
font-size : 18px;
color : #000;
background-color : #fff;
font-weight : bold;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
}
.profile_label{
font-size : 17px;
color : #000;
background-color : #fff;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
line-height : 1.5;
}
.name_remove{
margin-bottom : -13px;
}
.edit_profile_pic_link{
margin-top : 8px;	
margin-bottom : 10px;
}
.profile_pic_link:visited{
color : blue;
background-color:#fff;
text-decoration : underline;
}
.profile_pic_link{
color : blue;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 16px;
font-weight : bold;
text-decoration : underline;
}
.profile_pic_link:hover{
color: #ff4040;
background-color:#fff;
text-decoration : underline;
}
.profile_pic_link:active {
color: #ff4040;
background-color:#fff;
text-decoration : underline;
}
.user_profile_nav{
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 735px;
background-color : #fff;
border-radius : 10px;
padding-top : 18px;
padding-bottom : 21px;
margin-top : 10px;
border : thin solid #c2bcbc;
padding-left : 20px;
padding-right : 20px;
margin-bottom : 6px;	
overflow : hidden;
}
.profile_nav_link:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.profile_nav_link{
color : #000;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : none;
}
.profile_nav_link:hover{
color: #4d4d4d;
background-color:#fff;
text-decoration : none;
border-bottom : medium solid #ff4040! important;
}
.profile_nav_link:active {
color: #4d4d4d;
background-color:#fff;
text-decoration : none;
}
.nav_link_space{
margin-left : 28px;	
}
}
/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) and (max-width: 991.9px){
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
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 945px;
background-color : #fff;
border-radius : 10px;
padding-top : 17px;
padding-bottom : 0px;
margin-top : -20px;
border : thin solid #c2bcbc;
padding-left : 100px;
padding-right : 100px;
margin-bottom : -25px;
}
.footr{
margin : 0 auto;	
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
.signup_form{
margin-top : 5px;	
}
.label{
background-color : #fff;
color : #000;
font-size : 18px;
font-family : "Times New Roman", Times, Serif;	
}
.options{
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 945px;
background-color : #fff;
border-radius : 10px;
margin-top : 61px;
padding-top : 13px;
padding-bottom : 15px;
border : thin solid #c2bcbc;
}
.options2{
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 945px;
background-color : #fff;
border-radius : 10px;
margin-top : -15px;
padding-top : 13px;
padding-bottom : 15.5px;
border : thin solid #c2bcbc;
margin-bottom : -57px;
}
.link_option1:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.link_option1{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16.5px;
text-decoration : none;
border-bottom : thin solid blue;
}
.link_option1:hover{
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option1:active {
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option2:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.link_option2{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16.5px;
text-decoration : none;
border-bottom : thin solid blue;
}
.link_option2:hover{
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option2:active {
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.slideshow-container{
display : none;	
}
.hr{
width : 100%;
border : thin solid #804200;
margin-bottom : 16px;
margin-top : -20px;
}
.div_missing_img1{
margin : 0 auto;	
border : thin solid #e7e4e4;	
width : 100%;
max-width : 770px;
border-radius : 10px;
text-align : center;
padding-top : 7px;
padding-bottom : 11px;
padding-left : 10px;
padding-right : 10px;
margin-bottom : -10px;
overflow : hidden;
}
.missing_label{
font-family : "Times New Roman", Times, Serif;
font-size : 18px; 	
line-height : 1.6;
}
.missing_label_link:visited{
color : blue;
background-color:#fff;
text-decoration : underline;
}
.missing_label_link{
color : blue;
background-color:#fff;
font-family : arial, tahoma;
font-size : 17px;
font-weight : bold;
text-decoration : underline;
line-height : 2.2;
}
.missing_label_link:hover{
color: #000080;
background-color:#fff;
text-decoration : underline;
}
.missing_label_link:active {
color: #000080;
background-color:#fff;
text-decoration : underline;
}
.missing_image2{
height:auto; 
max-height : 35vw;
width : 32vw; 
max-width:300px; 
}
.miss_link:visited{
color : #000;
background-color:#fff;
text-decoration : underline;
}
.miss_link{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 18px;
font-weight : bold;
text-decoration : underline;
line-height : 2;
}
.miss_link:hover{
color: blue;
background-color:#fff;
text-decoration : underline;
}
.miss_link:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination:visited{
color : blue;
background-color:#fff;
text-decoration : none;
}
.pagination{
color : blue;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : none;
padding-left : 25px;
}
.pagination:hover{
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination_active:visited{
color : black;
background-color:#fff;
text-decoration : underline;
}
.pagination_active{
color : black;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : underline;
padding-left : 25px;
}
.pagination_active:hover{
color: black;
background-color:#fff;
text-decoration : underline;
}
.pagination_active:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.div_pagination{
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 945px;
background-color : #fff;
border-radius : 10px;
padding-top : 15px;
padding-bottom : 15px;
margin-top : 30px;
border : thin solid #c2bcbc;
padding-left : 5px;
padding-right : 5px;
margin-bottom : -20px;	
}
.user_profile2{
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 945px;
background-color : #fff;
border-radius : 10px;
padding-top : 12px;
padding-bottom : 16px;
margin-top : -20px;
border : thin solid #c2bcbc;
padding-left : 20px;
padding-right : 20px;
margin-bottom : -25px;	
overflow : hidden;
}
.profile_image2{
height:80px; 
max-height : 80px;
width : 80px; 
max-width:80px;
border-radius : 50%; 
border : thin solid #c2bcbc;
padding : 0px;
margin-bottom : 3px;
overflow : hidden;
}
.profile_label_name{
font-size : 18px;
color : #000;
background-color : #fff;
font-weight : bold;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
}
.profile_label{
font-size : 17px;
color : #000;
background-color : #fff;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
line-height : 1.5;
}
.name_remove{
margin-bottom : -13px;
}
.edit_profile_pic_link{
margin-top : 8px;	
margin-bottom : 10px;
}
.profile_pic_link:visited{
color : blue;
background-color:#fff;
text-decoration : underline;
}
.profile_pic_link{
color : blue;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 16px;
font-weight : bold;
text-decoration : underline;
}
.profile_pic_link:hover{
color: #ff4040;
background-color:#fff;
text-decoration : underline;
}
.profile_pic_link:active {
color: #ff4040;
background-color:#fff;
text-decoration : underline;
}
.user_profile_nav{
margin : 0 auto;	
text-align:center;
width : 97%;
max-width : 945px;
background-color : #fff;
border-radius : 10px;
padding-top : 18px;
padding-bottom : 21px;
margin-top : 10px;
border : thin solid #c2bcbc;
padding-left : 20px;
padding-right : 20px;
margin-bottom : 6px;	
overflow : hidden;
}
.profile_nav_link:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.profile_nav_link{
color : #000;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : none;
}
.profile_nav_link:hover{
color: #4d4d4d;
background-color:#fff;
text-decoration : none;
border-bottom : medium solid #ff4040! important;
}
.profile_nav_link:active {
color: #4d4d4d;
background-color:#fff;
text-decoration : none;
}
.nav_link_space{
margin-left : 28px;	
}
}
/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) and (max-width: 1199.9px){
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
max-width : 70%;
background-color : #fff;
border-radius : 10px;
padding-top : 20px;
padding-bottom : 0px;
margin-top : -20px;
border : thin solid #808080;
padding-left : 20px;
padding-right : 20px;
margin-bottom : -25px;
margin-left : 15px;
}
.footr{
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 30px;
padding-top : 18px;
margin-top : 12px;
width : 70%;
max-width : 70%;
border-radius : 10px;
margin-left : 15px;
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
.signup_form{
margin-top : -15px;	
}
.label{
background-color : #fff;
color : #000;
font-size : 19px;
font-family : "Times New Roman", Times, Serif;	
}
.options{
text-align:center;
width : 70%;
max-width : 70%;
background-color : #fff;
border-radius : 10px;
margin-top : 65px;
padding-top : 8px;
padding-bottom : 8px;
border : thin solid #808080;
margin-left : 15px;
}
.options2{
text-align:center;
width : 70%;
max-width : 70%;
background-color : #fff;
border-radius : 10px;
margin-top : -10px;
padding-top : 8px;
padding-bottom : 8px;
border : thin solid #808080;
margin-bottom : -70px;
margin-left : 15px;
}
.link_option1:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.link_option1{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16px;
font-weight : bold;
text-decoration : none;
}
.link_option1:hover{
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option1:active {
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option2:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.link_option2{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16px;
text-decoration : none;
font-weight : bold;
}
.link_option2:hover{
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option2:active {
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.slideshow-container{
text-align : center;	
background-color : #fff;	
margin-top : -20px;	
width : 27%;
max-width: 27%;
height : 300px;
border-radius : 5px;
padding-left : 10px;
padding-right : 10px;
padding-top : 40px;
padding-bottom : 50px;
position: fixed;
margin-left : 72%;
border : thin solid #c2bcbc;
line-height : 1.4;
overflow : hidden;
}
.text {
font-family : "Times New Roman", Times, Serif;
font-weight : bold;
font-size : 22px;
}
.feed_name{
color : #ff4040;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 18px;
line-height : 3;
}
.dot {
height: 10px;
width: 10px;
margin: 0 2px;
background-color: #bbb;
border-radius: 50%;
display: inline-block;
transition: background-color 0.6s ease;
}
.active {
background-color: #717171;
}
.hr{
width : 100%;
border : thin solid #804200;
margin-bottom : 17px;
margin-top : -21px;
}
.div_missing_img1{
margin : 0 auto;	
border : thin solid #e7e4e4;	
width : 100%;
max-width : 800px;
border-radius : 10px;
text-align : center;
padding-top : 7px;
padding-bottom : 11px;
padding-left : 10px;
padding-right : 10px;
margin-bottom : -10px;
overflow : hidden;
}
.missing_label{
font-family : "Times New Roman", Times, Serif;
font-size : 18px; 	
line-height : 1.6;
}
.missing_label_link:visited{
color : blue;
background-color:#fff;
text-decoration : underline;
}
.missing_label_link{
color : blue;
background-color:#fff;
font-family : arial, tahoma;
font-size : 17px;
font-weight : bold;
text-decoration : underline;
line-height : 2.2;
}
.missing_label_link:hover{
color: #000080;
background-color:#fff;
text-decoration : underline;
}
.missing_label_link:active {
color: #000080;
background-color:#fff;
text-decoration : underline;
}
.missing_image2{
height:auto; 
max-height : 30vw;
width : auto; 
max-width:30vw; 
}
.miss_link:visited{
color : #000;
background-color:#fff;
text-decoration : underline;
}
.miss_link{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 18px;
font-weight : bold;
text-decoration : underline;
line-height : 2;
}
.miss_link:hover{
color: blue;
background-color:#fff;
text-decoration : underline;
}
.miss_link:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination:visited{
color : blue;
background-color:#fff;
text-decoration : none;
}
.pagination{
color : blue;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : none;
padding-left : 25px;
}
.pagination:hover{
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination_active:visited{
color : black;
background-color:#fff;
text-decoration : underline;
}
.pagination_active{
color : black;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : underline;
padding-left : 25px;
}
.pagination_active:hover{
color: black;
background-color:#fff;
text-decoration : underline;
}
.pagination_active:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.div_pagination{	
text-align:center;
width : 70%;
max-width : 70%;
background-color : #fff;
border-radius : 10px;
padding-top : 15px;
padding-bottom : 15px;
margin-top : 30px;
border : thin solid #808080;
padding-left : 5px;
padding-right : 5px;
margin-bottom : -20px;
margin-left : 15px;	
}
.user_profile2{
text-align:center;
width : 70%;
max-width : 70%;
background-color : #fff;
border-radius : 10px;
padding-top : 12px;
padding-bottom : 16px;
margin-top : -13px;
border : thin solid #808080;
padding-left : 20px;
padding-right : 20px;
margin-bottom : -25px;	
overflow : hidden;
margin-left : 15px;	
}
.profile_image2{
height:110px; 
max-height : 110px;
width : 110px; 
max-width:110px;
border-radius : 50%; 
border : thin solid #c2bcbc;
padding : 0px;
margin-bottom : 5px;
overflow : hidden;
}
.profile_label_name{
font-size : 18px;
color : #000;
background-color : #fff;
font-weight : bold;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
}
.profile_label{
font-size : 17px;
color : #000;
background-color : #fff;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
line-height : 1.5;
}
.name_remove{
margin-bottom : -13px;
}
.edit_profile_pic_link{
margin-top : 8px;	
margin-bottom : 10px;
}
.profile_pic_link:visited{
color : blue;
background-color:#fff;
text-decoration : underline;
}
.profile_pic_link{
color : blue;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 16px;
font-weight : bold;
text-decoration : underline;
}
.profile_pic_link:hover{
color: #ff4040;
background-color:#fff;
text-decoration : underline;
}
.profile_pic_link:active {
color: #ff4040;
background-color:#fff;
text-decoration : underline;
}
.user_profile_nav{
text-align:center;
width : 70%;
max-width : 70%;
background-color : #fff;
border-radius : 10px;
padding-top : 18px;
padding-bottom : 21px;
margin-top : 10px;
border : thin solid #808080;
padding-left : 20px;
padding-right : 20px;
margin-bottom : 6px;	
overflow : hidden;
margin-left : 15px;	
}
.profile_nav_link:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.profile_nav_link{
color : #000;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : none;
}
.profile_nav_link:hover{
color: #4d4d4d;
background-color:#fff;
text-decoration : none;
border-bottom : medium solid #ff4040! important;
}
.profile_nav_link:active {
color: #4d4d4d;
background-color:#fff;
text-decoration : none;
}
.nav_link_space{
margin-left : 28px;	
}
}

/* this is additional (large laptops and desktops, 1200px-1450px) */
@media only screen and (min-width: 1200px) and (max-width: 1449.9px) {
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
width : 70%;
max-width : 852px;
background-color : #fff;
border-radius : 10px;
padding-top : 20px;
padding-bottom : 10px;
margin-top : -20px;
border : thin solid #808080;
padding-left : 30px;
padding-right : 30px;
margin-bottom : -25px;
margin-left : 20px;
overflow : auto;
}
.footr{
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 30px;
padding-top : 18px;
margin-top : 12px;
width : 70%;
max-width : 852px;
border-radius : 10px;
margin-left : 20px;
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
.signup_form{
margin-top : -30px;	
}
.label{
background-color : #fff;
color : #000;
font-size : 20px;
font-family : "Times New Roman", Times, Serif;	
}
.options{
text-align:center;
width : 70%;
max-width : 852px;
background-color : #fff;
border-radius : 10px;
margin-top : 76px;
padding-top : 8px;
padding-bottom : 8px;
border : thin solid #808080;
margin-left : 20px;
}
.options2{
text-align:center;
width : 70%;
max-width : 852px;
background-color : #fff;
border-radius : 10px;
margin-top : -9px;
padding-top : 8px;
padding-bottom : 8px;
border : thin solid #808080;
margin-bottom : -81px;
margin-left : 20px;
}
.link_option1:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.link_option1{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16.5px;
text-decoration : none;
font-weight : bold;
}
.link_option1:hover{
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option1:active {
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option2:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.link_option2{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16.5px;
text-decoration : none;
font-weight : bold;
}
.link_option2:hover{
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option2:active {
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.slideshow-container{
text-align : center;	
background-color : #fff;	
margin-top : -20px;	
width : 26%;
max-width: 500px;
height : 300px;
border-radius : 5px;
padding-left : 10px;
padding-right : 15px;
padding-top : 40px;
padding-bottom : 50px;
position: fixed;
left : 880px;
border : thin solid #c2bcbc;
line-height : 1.4;
overflow : hidden;
}
.text {
font-family : "Times New Roman", Times, Serif;
font-weight : bold;
font-size : 22px;
}
.feed_name{
color : #ff4040;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 18px;
line-height : 3;
}
.dot {
height: 10px;
width: 10px;
margin: 0 2px;
background-color: #bbb;
border-radius: 50%;
display: inline-block;
transition: background-color 0.6s ease;
}
.active {
background-color: #717171;
}
.hr{
width : 100%;
border : thin solid #804200;
margin-bottom : 17px;
margin-top : -21px;
}
.remove{
display : none;	
}
.div_missing_img1{	
border : thin solid #cfc9c9;	
width : 47%;
max-width : 400px;
border-radius : 10px;
text-align : center;
padding-top : 11px;
padding-bottom : 11px;
padding-left : 5px;
padding-right : 5px;
float : left;
margin-left : 15px;
margin-bottom : 10px;
overflow : hidden;
}
.missing_label{
font-family : "Times New Roman", Times, Serif;
font-size : 18px; 	
line-height : 1.6;
}
.missing_label_link:visited{
color : blue;
background-color:#fff;
text-decoration : underline;
}
.missing_label_link{
color : blue;
background-color:#fff;
font-family : arial, tahoma;
font-size : 17px;
font-weight : bold;
text-decoration : underline;
line-height : 2.2;
}
.missing_label_link:hover{
color: #000080;
background-color:#fff;
text-decoration : underline;
}
.missing_label_link:active {
color: #000080;
background-color:#fff;
text-decoration : underline;
}
.missing_image2{
height:15vw; 
max-height : 20vw;
width : auto; 
max-width:20vw; 
}
.miss_link:visited{
color : #000;
background-color:#fff;
text-decoration : underline;
}
.miss_link{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 19px;
font-weight : bold;
text-decoration : underline;
line-height : 2;
}
.miss_link:hover{
color: blue;
background-color:#fff;
text-decoration : underline;
}
.miss_link:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination:visited{
color : blue;
background-color:#fff;
text-decoration : none;
}
.pagination{
color : blue;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : none;
padding-left : 25px;
}
.pagination:hover{
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination_active:visited{
color : black;
background-color:#fff;
text-decoration : underline;
}
.pagination_active{
color : black;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : underline;
padding-left : 25px;
}
.pagination_active:hover{
color: black;
background-color:#fff;
text-decoration : underline;
}
.pagination_active:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.div_pagination{	
text-align:center;
width : 70%;
max-width : 852px;
background-color : #fff;
border-radius : 10px;
padding-top : 15px;
padding-bottom : 15px;
margin-top : 30px;
border : thin solid #c2bcbc;
padding-left : 5px;
padding-right : 5px;
margin-bottom : -20px;
margin-left : 20px;	
}
.user_profile2{
text-align:center;
width : 70%;
max-width : 852px;
background-color : #fff;
border-radius : 10px;
padding-top : 12px;
padding-bottom : 16px;
margin-top : -13px;
border : thin solid #808080;
padding-left : 20px;
padding-right : 20px;
margin-bottom : -25px;	
overflow : hidden;
margin-left : 20px;	
}
.profile_image2{
height:120px; 
max-height : 120px;
width : 120px; 
max-width:120px;
border-radius : 50%; 
border : thin solid #c2bcbc;
padding : 0px;
margin-bottom : 5px;
overflow : hidden;
}
.profile_label_name{
font-size : 19px;
color : #000;
background-color : #fff;
font-weight : bold;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
}
.profile_label{
font-size : 18px;
color : #000;
background-color : #fff;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
line-height : 1.7;
}
.name_remove{
margin-bottom : -13px;
}
.edit_profile_pic_link{
margin-top : 10px;	
margin-bottom : 10px;
}
.profile_pic_link:visited{
color : blue;
background-color:#fff;
text-decoration : underline;
}
.profile_pic_link{
color : blue;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : underline;
}
.profile_pic_link:hover{
color: #ff4040;
background-color:#fff;
text-decoration : underline;
}
.profile_pic_link:active {
color: #ff4040;
background-color:#fff;
text-decoration : underline;
}
.user_profile_nav{
text-align:center;
width : 70%;
max-width : 852px;
background-color : #fff;
border-radius : 10px;
padding-top : 18px;
padding-bottom : 21px;
margin-top : 10px;
border : thin solid #808080;
padding-left : 20px;
padding-right : 20px;
margin-bottom : 6px;	
overflow : hidden;
margin-left : 20px;	
}
.profile_nav_link:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.profile_nav_link{
color : #000;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : none;
}
.profile_nav_link:hover{
color: #4d4d4d;
background-color:#fff;
text-decoration : none;
border-bottom : medium solid #ff4040! important;
}
.profile_nav_link:active {
color: #4d4d4d;
background-color:#fff;
text-decoration : none;
}
.nav_link_space{
margin-left : 28px;	
}
#div_missing_img2{
width : 90%;
overflow : hidden;
max-width : 600px;	
margin-left : 12%;
}	
}

/* Extra large devices (large laptops and desktops, 1450px and up) */
@media only screen and (min-width: 1450px) {
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
width : 70%;
max-width : 975px;
background-color : #fff;
border-radius : 10px;
padding-top : 20px;
padding-bottom : 10px;
margin-top : -20px;
border : thin solid #808080;
padding-left : 30px;
padding-right : 30px;
margin-bottom : -25px;
margin-left : 35px;
overflow : auto;
}
.footr{
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 30px;
padding-top : 18px;
margin-top : 12px;
width : 70%;
max-width : 975px;
border-radius : 10px;
margin-left : 35px;
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
.signup_form{
margin-top : -35px;	
}
.label{
background-color : #fff;
color : #000;
font-size : 20px;
font-family : "Times New Roman", Times, Serif;	
}
.options{
text-align:center;
width : 70%;
max-width : 975px;
background-color : #fff;
border-radius : 10px;
margin-top : 76px;
padding-top : 9px;
padding-bottom : 9px;
border : thin solid #808080;
margin-left : 35px;
}
.options2{
text-align:center;
width : 70%;
max-width : 975px;
background-color : #fff;
border-radius : 10px;
margin-top : -9px;
padding-top : 9px;
padding-bottom : 9px;
border : thin solid #808080;
margin-bottom : -83px;
margin-left : 35px;
}
.link_option1:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.link_option1{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16.5px;
text-decoration : none;
font-weight : bold;
}
.link_option1:hover{
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option1:active {
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option2:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.link_option2{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 16.5px;
text-decoration : none;
font-weight : bold;
}
.link_option2:hover{
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.link_option2:active {
color: blue;
background-color:#fff;
border-bottom : thin solid #000;
text-decoration : none;
}
.slideshow-container{
text-align : center;	
background-color : #fff;	
margin-top : -22px;	
width : 27%;
max-width: 390px;
height : 300px;
border-radius : 5px;
padding-left : 10px;
padding-right : 10px;
padding-top : 40px;
padding-bottom : 50px;
position: fixed;
left : 1030px;
border : thin solid #c2bcbc;
line-height : 1.4;
overflow : hidden;
}
.text {
font-family : "Times New Roman", Times, Serif;
font-weight : bold;
font-size : 22px;
}
.feed_name{
color : #ff4040;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 18px;
line-height : 3;
}
.dot {
height: 10px;
width: 10px;
margin: 0 2px;
background-color: #bbb;
border-radius: 50%;
display: inline-block;
transition: background-color 0.6s ease;
}
.active {
background-color: #717171;
}
.hr{
width : 100%;
border : thin solid #804200;
margin-bottom : 15px;
margin-top : -21px;
}
.remove{
display : none;	
}
.div_missing_case_wrap{
margin-left : 5px;	
margin-right : -20px;
}
.div_missing_img1{	
border : thin solid #cfc9c9;	
width : 46%;
max-width : 440px;
border-radius : 10px;
text-align : center;
padding-top : 11px;
padding-bottom : 11px;
padding-left : 5px;
padding-right : 5px;
float : left;
margin-left : 15px;
margin-bottom : 10px;
overflow : hidden;
}
.missing_label{
font-family : "Times New Roman", Times, Serif;
font-size : 18px; 	
line-height : 1.6;
}
.missing_label_link:visited{
color : blue;
background-color:#fff;
text-decoration : underline;
}
.missing_label_link{
color : blue;
background-color:#fff;
font-family : arial, tahoma;
font-size : 17px;
font-weight : bold;
text-decoration : underline;
line-height : 2.2;
}
.missing_label_link:hover{
color: #000080;
background-color:#fff;
text-decoration : underline;
}
.missing_label_link:active {
color: #000080;
background-color:#fff;
text-decoration : underline;
}
.missing_image2{
height:15vw; 
max-height : 300px;
width : auto; 
max-width:370px; 
}
.miss_link:visited{
color : #000;
background-color:#fff;
text-decoration : underline;
}
.miss_link{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 19px;
font-weight : bold;
text-decoration : underline;
line-height : 2;
}
.miss_link:hover{
color: blue;
background-color:#fff;
text-decoration : underline;
}
.miss_link:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination:visited{
color : blue;
background-color:#fff;
text-decoration : none;
}
.pagination{
color : blue;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : none;
padding-left : 25px;
}
.pagination:hover{
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.pagination_active:visited{
color : black;
background-color:#fff;
text-decoration : underline;
}
.pagination_active{
color : black;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : underline;
padding-left : 25px;
}
.pagination_active:hover{
color: black;
background-color:#fff;
text-decoration : underline;
}
.pagination_active:active {
color: blue;
background-color:#fff;
text-decoration : underline;
}
.div_pagination{	
text-align:center;
width : 70%;
max-width : 975px;
background-color : #fff;
border-radius : 10px;
padding-top : 15px;
padding-bottom : 15px;
margin-top : 30px;
border : thin solid #c2bcbc;
padding-left : 5px;
padding-right : 5px;
margin-bottom : -20px;
margin-left : 35px;	
}
.user_profile2{
text-align:center;
width : 70%;
max-width : 975px;
background-color : #fff;
border-radius : 10px;
padding-top : 12px;
padding-bottom : 16px;
margin-top : -13px;
border : thin solid #808080;
padding-left : 20px;
padding-right : 20px;
margin-bottom : -25px;	
overflow : hidden;
margin-left : 35px;	
}
.profile_image2{
height:120px; 
max-height : 120px;
width : 120px; 
max-width:120px;
border-radius : 50%; 
border : thin solid #c2bcbc;
padding : 0px;
margin-bottom : 5px;
overflow : hidden;
}
.profile_label_name{
font-size : 19px;
color : #000;
background-color : #fff;
font-weight : bold;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
}
.profile_label{
font-size : 18px;
color : #000;
background-color : #fff;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
line-height : 1.7;
}
.name_remove{
margin-bottom : -13px;
}
.edit_profile_pic_link{
margin-top : 10px;	
margin-bottom : 10px;
}
.profile_pic_link:visited{
color : blue;
background-color:#fff;
text-decoration : underline;
}
.profile_pic_link{
color : blue;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : underline;
}
.profile_pic_link:hover{
color: #ff4040;
background-color:#fff;
text-decoration : underline;
}
.profile_pic_link:active {
color: #ff4040;
background-color:#fff;
text-decoration : underline;
}
.user_profile_nav{
text-align:center;
width : 70%;
max-width : 975px;
background-color : #fff;
border-radius : 10px;
padding-top : 18px;
padding-bottom : 21px;
margin-top : 10px;
border : thin solid #808080;
padding-left : 20px;
padding-right : 20px;
margin-bottom : 6px;	
overflow : hidden;
margin-left : 35px;	
}
.profile_nav_link:visited{
color : #000;
background-color:#fff;
text-decoration : none;
}
.profile_nav_link{
color : #000;
background-color:#fff;
font-family : Arial, Tahoma, "Times New Roman", Times, Serif;
font-size : 17px;
font-weight : bold;
text-decoration : none;
}
.profile_nav_link:hover{
color: #4d4d4d;
background-color:#fff;
text-decoration : none;
border-bottom : medium solid #ff4040! important;
}
.profile_nav_link:active {
color: #4d4d4d;
background-color:#fff;
text-decoration : none;
}
.nav_link_space{
margin-left : 28px;	
}
#div_missing_img2{
width : 90%;
overflow : hidden;
max-width : 600px;	
margin-left : 15%;
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

echo '<a href="khojhai_profile.php?id='.$sess_id.'" class="link_headr" title="'.$tmp_name.'"><u>Profile</u></a>';

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



<div class = 'options'>

<a href='khojhai_add_missing.php' class='link_option1' title='Add Missing Person'>Add Missing Person</a>

</div>

<br>

<div class = 'options2'>

<a href='khojhai_search.php' class='link_option2' title='Search Missing Person'>Search Missing Person</a>

</div>

<br>



<div class="slideshow-container">

  <div class="text"><i>"I have found my brother Zelenskyy with their Help. Thank you Khojhai team" </i><br><label class='feed_name'>~ Vladamir Putin</label></div>

  <div class="text"><i>"I waited for more than a decade and already lost hope but with the help of this website I found my wife Amber heard." </i><br><label class='feed_name'>~ Johnny Depp</label></div>

  <div class="text"><i>"Without their help it would have been impossible to find my brother Narendra Modi" </i><br><label class='feed_name'>~ Xi Jinping</label></div>
  
  <div class="text"><i>"I found my only sibling Benjamin whom I had lost in war. Thanks Khojhai Team" </i><br><label class='feed_name'>~ Mohammed bin Salman</label></div>
  
  <br>
  
  <div class='img-dot'>
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  </div>

</div>



<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("text");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 6000); // Change image every 3.6 seconds
}
</script>



<center>

<div class='content'>	

<?php 

///division for profile or details of the user
echo "<div class='user_profile'>";

echo "<div class='user_profile2'>";

$user_profile_qry = mysqli_query($con, "select * from users where id = '$sess_id' LIMIT 1");

$user_profile_qry_count1 = mysqli_num_rows($user_profile_qry);

if($user_profile_qry_count1 < 1)
{
header("Location: khojhai_home.php");
exit();	
}

$user_profile_qry_ftch1 = mysqli_fetch_array($user_profile_qry);

$user_profile_id = $user_profile_qry_ftch1['id'];

$user_profile_name = $user_profile_qry_ftch1['name'];

$user_profile_gender = ucwords($user_profile_qry_ftch1['gender']);

$user_profile_age = $user_profile_qry_ftch1['age'];

$user_profile_pic = $user_profile_qry_ftch1['profile_pic'];



$user_profile_today = date("Y-m-d");

$user_profile_diff = date_diff(date_create($user_profile_age), date_create($user_profile_today));

$user_profile_age = $user_profile_diff->format('%y');



if($user_profile_pic == '')
{
$user_profile_picurl = "default_profile_pic/user.png";			
}	

elseif($user_profile_pic == ' ')
{
$user_profile_picurl = "default_profile_pic/user.png";	
}

else
{
$user_profile_picurl = "profile_pic/$user_profile_id/$user_profile_pic";
}

echo "<img border='0' src='$user_profile_picurl' class='profile_image2' title='$user_profile_name'/><br>";

echo "<div class='name_remove'><label class='profile_label_name'>$user_profile_name</label></div><br>";

echo "<label class='profile_label'>Gender : </label><label class='profile_label'>$user_profile_gender</label><br>";

echo "<label class='profile_label'>Age : </label><label class='profile_label'>$user_profile_age</label><br>";

echo "<div class='edit_profile_pic_link'><a href='khojhai_edit_profile_pic.php' class='profile_pic_link'>Edit Profile Photo</a></div>";	

echo "</div>";

echo "</div><br class='profile_remove'>";  



echo "<div class = 'user_profile_nav'>";



echo "<center>";	

echo "<a href='khojhai_profile.php?id=$sess_id' class='profile_nav_link' style='border-bottom:medium solid #000; text-decoration:none;'>Posted Cases</a>";

echo "<span class='nav_link_space'></span>";

echo "<a href='khojhai_profile_saved.php' class='profile_nav_link' style='border-bottom:medium solid #ff4040; text-decoration:none;'>Saved Cases</a>";

echo "</center>";

echo "</div><br class='profile_remove'>";  
//// user profile division ends here


echo '<div class = "all_content">';

echo '<div class = "form_signup">';

	
$qry2 = "SELECT * FROM case_followers WHERE follower_id = '$sess_id' ORDER BY followed_on DESC";

$qry_wrap2 = mysqli_query($con, $qry2);

// Total row count 
$qry_count2 = mysqli_num_rows($qry_wrap2);

// Number of records to display per page 
$page_rows = 10;

// The page number of our last page
$last = ceil($qry_count2/$page_rows);

// make sure $last cannot be less than 1
if($last < 1)
{
	$last = 1;
}

// Create the $pagenum variable
$pagenum = 1;

// Get pagenum from URL variables, else it will be 1
if(isset($_GET['pg']))
{
	$pagenum = preg_replace('#[^0-9]#', '', $_GET['pg']);
}

// Page number Can not be less than 1, or more than our $last page

//  condition 1....
if($pagenum < 1)
{ 
    $pagenum = 1; 
} 

//  condition 2....
elseif($pagenum > $last) 
{ 
    $pagenum = $last; 
}

// The range of rows to query for the chosen $pagenum
$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;

// This Is Query, it will grab only one page worth of rows by applying $limit variable
$qry3 =  " $qry2 $limit ";

// Make it query
$qry_wrap3 = mysqli_query($con, $qry3);

$qry_count3 = mysqli_num_rows($qry_wrap3);

if($qry_count3 < 1)
{
echo "<div class='div_missing_case_wrap'>";	
	
echo "<br><br><br><div class='div_missing_img1' id='div_missing_img2'>";

echo "<label style='font-size : 19px; font-family : Times New Roman, Times, Serif; color : #262626; background-color:#fff;'>You Have Not Saved Any Case.</label><br>";	

echo "</div>";

echo "</div><br class='remove'><br><br><br><br><br><br>";

echo "<br></div></div></div></center><br>";

//----------------------- Footer ----------------------->
echo "<div class='footr'>

<!--- test -->
<div class='dis_none'>

<a href='khojhai_setting.php' class='link_footr2' title='Settings'>Setting</a>

<span class='vl'></span>

<a href='khojhai_logout.php' class='link_footr2' title='SignOut'>Logout</a>

<span class='vl'></span><br>

</div>
<!-- test pass/fail -->

<a href='khojhai_about.php' class='link_footr' title='Know more about us'>About Us</a>

<span class='vl'></span>

<a href='khojhai_contact.php' class='link_footr' title='Contact Us'>Contact Us</a>

<span class='vl'></span>

<a href='khojhai_press.php' class='link_footr' title='Latest News About Us'>Press</a>

<span class='vl'></span>

<a href='khojhai_fund.php' class='link_footr' title='Who Supports Us'>Funding</a><br>

<div class='cpy2'><span class='copyrt'>&copy; Copyright 450 BC - 2020</span></div>

</div>

</body>

</html>";

exit();
}

// Create New variable ($PageControl) to tell the user on which page they are... and total records.................
$PageControl = '';

// Condition, if there is more than one page........
if($last != 1)
{

if ($pagenum > 1)
{
$previous = $pagenum - 1;

$PageControl .= '<a href="'.$_SERVER['PHP_SELF'].'?pg='.$previous.'" class = "pagination">Previous</a>&nbsp; ';

//Clickable number links that should appear on the left of the target page.....
for($i = $pagenum-2; $i < $pagenum; $i++)
{

if($i > 0)
{
$PageControl .= '<a href="'.$_SERVER['PHP_SELF'].'?pg='.$i.'" class = "pagination">'.$i.'</a>&nbsp; ';
}
	}
         }
		
//Target Page Should Not Be clickable......
$PageControl .= '<a href="'.$_SERVER['PHP_SELF'].'?pg='.$pagenum.'" class = "pagination_active">'.$pagenum.'</a>&nbsp;';

//Clickable number links that should appear on the right of the target page....
for($i = $pagenum+1; $i <= $last; $i++)
{
$PageControl .= '<a href="'.$_SERVER['PHP_SELF'].'?pg='.$i.'" class = "pagination">'.$i.'</a>&nbsp;';

if($i >= $pagenum+1)
{
break;
}
	}
		
// Check if we are on last page and then create link..............
if($pagenum != $last) 
{
        $next = $pagenum + 1;
		
        $PageControl .= '<a href="'.$_SERVER['PHP_SELF'].'?pg='.$next.'" class = "pagination">Next</a>';
}
     }

// Fetch The records to be shown to the user, Here our while loop starts to fetch the records and to be echoed......................

// While Loop For Records Starts Here............
while($qry_ftch3 = mysqli_fetch_array($qry_wrap3, MYSQLI_ASSOC))
{
$followed_case_id = $qry_ftch3['case_id'];

$followed_case_qry = mysqli_query($con, "select * from cases where id = '$followed_case_id' ");

$followed_case_qry_ftch = mysqli_fetch_array($followed_case_qry);
	
$missing_id = $followed_case_qry_ftch['id'];
	
$missing_image = $followed_case_qry_ftch['case_image'];

/* 1.*/ $missing_image_dir = "case_image/$missing_id/$missing_image";	

/* 2.*/ $missing_name = $followed_case_qry_ftch['name'];

$dateOfBirth = $followed_case_qry_ftch['age'];

$today = date("Y-m-d");

$diff = date_diff(date_create($dateOfBirth), date_create($today));

/* 3.*/ $missing_age = $diff->format('%y');

/* 4.*/ $missing_contact_person = $followed_case_qry_ftch['contact_person_name'];

/* 5.*/ $missing_contact_number = $followed_case_qry_ftch['contact_person_number'];

/* 6.*/ $missing_status = $followed_case_qry_ftch['status'];
	
echo "<div class='div_missing_case_wrap'>";	
	
echo "<div class='div_missing_img1'>";

echo "<a href='khojhai_view_missing.php?id=$missing_id'>
<img border='0' src='$missing_image_dir' class='missing_image2' title='$missing_name'/></a><br>";

echo "<a href='khojhai_view_missing.php?id=$missing_id' class='miss_link'>
<label class='missing_label_name'>$missing_name</label></a><br>";

echo "<label class='missing_label'>Age : </label><label class='missing_label'>$missing_age</label><br>";

echo "<label class='missing_label'>Contact Person : </label><label class='missing_label'>$missing_contact_person</label><br>";

echo "<label class='missing_label'>Contact Number : </label><label class='missing_label'>$missing_contact_number</label><br>";

if($missing_status == 'Open')
{
echo "<label class='missing_label'>Case Status : </label><label class='missing_label' style='color:red'>$missing_status</label><br>";
}

else
{
echo "<label class='missing_label'>Case Status : </label><label class='missing_label' style='color:green'>$missing_status</label><br>";	
}

echo "<a href='khojhai_view_missing.php?id=$missing_id' class='missing_label_link'><u>View More</u></a><br>";

echo "</div>";

echo "</div><br class='remove'>";

}

?>

<br>

</div></div></div></center>

<!-- Pagination links --->

<?php 
if($PageControl)
{
echo "<div class='div_pagination'>";
	
echo $PageControl;

echo "</div><br>";    
}
// If There is no records, then this action will performed..........
if(!($PageControl))
{
echo "<div class='pagination' style='display:none;'></div><br>";
}

?>
<!--- pagination links end -->



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

</body>

</html>