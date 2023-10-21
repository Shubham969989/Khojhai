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


<!DOCTYPE html>

<html lang="en">

<head>

<title>Create New Account | KhojHai.com</title>

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
background-color : #e5e4e4;	
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
padding-top : 10.5px;
padding-bottom : 10px;
border-bottom : 0.2px solid #b3b3b3;
border-top : 0.1px solid #000;
margin-top : 25px;
padding-left : 0px;
}
.vl{
margin-left : 16px;	
word-spacing : 50px;
}
.link_headr:visited{
color : #000;
background-color:#fff;
text-decoration : underline;
}
.link_headr{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 15.5px;
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
.content{
margin-top : 65px;
text-align : center;
}
.label_head{
font-size : 16px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.signup_form{
margin-top : 17px;
}
.label{
color : #000;
background-color : #e5e4e4;
font-size:15px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl{
width : 85%;
height : 31px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 11px;
margin-top : 2.5px;
}
.form-cntrl-birth{
width : 27%;
height : 31px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 11.5px;
margin-top : 2.5px;
}
.btn{
margin-top : 3.5px;	
width : 84%;
height : 31px;
border : 0.4px solid #1a1a00;
border-radius : 2px;
font-size : 13px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #000;
background-color : #FFD700;
margin-bottom : 18px;
}
.btn:hover{
color : #000;
background-color : #FFD700;
}
.form_login {
display: none;
position: fixed;
margin-top : 0px;
right: 22px;
border: 0.6px solid #1a1a00;
z-index: 9;
top : 0;
width : 150px;
}
.form-container {
padding-top : 10px;		
max-width: 100%;
background-color: white;
}
.log-head-div{
margin-bottom : 8px;	
}
.label_head-login{
font-size : 16px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.label-login{
color : #000;
background-color : #fff;
font-size:12px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl-login{
width : 90%;
height : 25px;;
border : 0.4px solid green;
border-radius : 1.5px;
font-size : 13px;
padding-left : 4px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 3px;
}
.wrap-login{
margin-top : 2px;
margin-bottom : 3px;
}
.btn-login{
margin-top : 0px;	
width : 86.5%;
height : 25px;
border : 0.4px solid #1a1a00;
border-radius : 0.7px;
font-size : 9.5px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : #008000;
margin-bottom : 0.4px;
opacity : 0.8;
}
.btn-login:hover{
color : #fff;
background-color : #008000;
opacity : 1;
}
.btn-login-cancel{
margin-top : 6px;	
width : 86.5%;
height : 25px;
border : 0.4px solid #1a1a00;
border-radius : 0.7px;
font-size : 9.5px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : red;
margin-bottom : 15px;
opacity : 0.8;
}
.btn-login-cancel:hover{
color : #fff;
background-color : red;
opacity : 1;
}
.link_jscript:visited{
color : blue;
background-color:#e5e4e4;
text-decoration : underline;
}
.link_jscript{
color : blue;
background-color:#e5e4e4;
font-family : "Times New Roman", Times, Serif;
font-size : 15px;
font-weight : bold;
text-decoration : underline;
}
.link_jscript:hover{
color: #000033;
text-decoration:underline;	
background-color:#e5e4e4;
}
.link_jscript:active {
color: #000033;
background-color:#e5e4e4;
text-decoration : underline;
}
.footr{
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 27px;
padding-top : 10px;
margin-top : 12px;
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
width : 80%;
background-color : #e60000;
align-content : center;
margin-top :5px;
padding-top : 5px;
padding-bottom : 8px;
margin-bottom : -12px;
border-radius : 5px;
padding-left : 4px;
padding-right : 4px;
}
.err{
color : #fff;
font-size : 16px;
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
}
/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {
*{margin:0px; padding:0px;}	
html, body{
overflow-x : hidden;	
}
.bdy{
background-color : #e5e4e4;	
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
padding-top : 10.5px;
padding-bottom : 10px;
border-bottom : 0.2px solid #b3b3b3;
border-top : 0.1px solid #000;
margin-top : 25px;
padding-left : 45px;
}
.vl{
margin-left : 16px;	
word-spacing : 50px;
}
.link_headr:visited{
color : #000;
background-color:#fff;
text-decoration : underline;
}
.link_headr{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 15.5px;
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
.content{
margin-top : 65px;
text-align : center;
}
.label_head{
font-size : 16px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.signup_form{
margin-top : 17px;
}
.label{
color : #000;
background-color : #e5e4e4;
font-size:15px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl{
width : 85%;
height : 31px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 11px;
margin-top : 2.5px;
}
.form-cntrl-birth{
width : 27%;
height : 31px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 11.5px;
margin-top : 2.5px;
}
.btn{
margin-top : 3.5px;	
width : 84%;
height : 31px;
border : 0.4px solid #1a1a00;
border-radius : 2px;
font-size : 13px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #000;
background-color : #FFD700;
margin-bottom : 18px;
}
.btn:hover{
color : #000;
background-color : #FFD700;
}
.form_login {
display: none;
position: fixed;
margin-top : 42px;
right: 40px;
border: 1px solid #1a1a00;
z-index: 9;
top : 0;
width : 220px;
}
.form-container {
padding-top : 10px;	
max-width: 100%;
background-color: white;
}
.label_head-login{
font-size : 16px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.log-head-div{
margin-bottom : 8px;	
}
.label-login{
color : #000;
background-color : #fff;
font-size:14px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl-login{
width : 88%;
height : 28px;;
border : 0.4px solid green;
border-radius : 1.5px;
font-size : 14px;
padding-left : 4px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 3px;
}
.wrap-login{
margin-top : 2px;
margin-bottom : 3px;
}
.btn-login{
margin-top : 3px;	
width : 86.5%;
height : 29px;
border : 0.4px solid #1a1a00;
border-radius : 0.7px;
font-size : 12px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : #008000;
margin-bottom : 5px;
opacity : 0.8;
}
.btn-login:hover{
color : #fff;
background-color : #008000;
opacity : 1;
}
.btn-login-cancel{
margin-top : 6px;	
width : 86.5%;
height : 29px;
border : 0.4px solid #1a1a00;
border-radius : 0.7px;
font-size : 12px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : red;
margin-bottom : 15px;
opacity : 0.8;
}
.btn-login-cancel:hover{
color : #fff;
background-color : red;
opacity : 1;
}
.link_jscript:visited{
color : blue;
background-color:#e5e4e4;
text-decoration : underline;
}
.link_jscript{
color : blue;
background-color:#e5e4e4;
font-family : "Times New Roman", Times, Serif;
font-size : 15px;
font-weight : bold;
text-decoration : underline;
}
.link_jscript:hover{
color: #000033;
text-decoration:underline;	
background-color:#e5e4e4;
}
.link_jscript:active {
color: #000033;
background-color:#e5e4e4;
text-decoration : underline;
}
.footr{
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 27px;
padding-top : 10px;
margin-top : 12px;
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
width : 80%;
background-color : #e60000;
align-content : center;
margin-top :5px;
padding-top : 5px;
padding-bottom : 8px;
margin-bottom : -12px;
border-radius : 5px;
padding-left : 4px;
padding-right : 4px;
}
.err{
color : #fff;
font-size : 16px;
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
}
/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
*{margin:0px; padding:0px;}	
html, body{
overflow-x : hidden;	
}
.bdy{
background-color : #e5e4e4;	
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
padding-top : 12.5px;
padding-bottom : 12px;
border-bottom : 0.2px solid #b3b3b3;
border-top : 0.1px solid #000;
margin-top : 28.8px;
padding-left : 45px;
}
.vl{
margin-left : 17px;	
word-spacing : 50px;
}
.link_headr:visited{
color : #000;
background-color:#fff;
text-decoration : underline;
}
.link_headr{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 15.5px;
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
.content{
margin-top : 75px;
text-align : center;
}
.label_head{
font-size : 16px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.signup_form{
margin-top : 17px;
}
.label{
color : #000;
background-color : #e5e4e4;
font-size:16px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl{
width : 85%;
height : 31px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 13px;
margin-top : 2.5px;
}
.form-cntrl-birth{
width : 27%;
height : 31px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 14.5px;
margin-top : 5px;
}
.btn{
margin-top : 3.5px;	
width : 84%;
height : 33px;
border : 0.4px solid #1a1a00;
border-radius : 2px;
font-size : 13px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #000;
background-color : #FFD700;
margin-bottom : 20px;
}
.btn:hover{
color : #000;
background-color : #FFD700;
}
.form_login {
display: none;
position: fixed;
margin-top : 46px;
right: 50px;
border: 1px solid #1a1a00;
z-index: 9;
top : 0;
width : 260px;
}
.form-container {
padding-top : 10px;	
max-width: 100%;
background-color: white;
}
.label_head-login{
font-size : 16px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.log-head-div{
margin-bottom : 8px;	
}
.label-login{
color : #000;
background-color : #fff;
font-size:14px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl-login{
width : 88%;
height : 30px;;
border : 0.4px solid green;
border-radius : 1.5px;
font-size : 14px;
padding-left : 4px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 3px;
}
.wrap-login{
margin-top : 2px;
margin-bottom : 3px;
}
.btn-login{
margin-top : 3px;	
width : 86.5%;
height : 31px;
border : 0.4px solid #1a1a00;
border-radius : 0.7px;
font-size : 12px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : #008000;
margin-bottom : 5px;
opacity : 0.8;
}
.btn-login:hover{
color : #fff;
background-color : #008000;
opacity : 1;
}
.btn-login-cancel{
margin-top : 6px;	
width : 86.5%;
height : 29px;
border : 0.4px solid #1a1a00;
border-radius : 0.7px;
font-size : 12px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : red;
margin-bottom : 15px;
opacity : 0.8;
}
.btn-login-cancel:hover{
color : #fff;
background-color : red;
opacity : 1;
}
.link_jscript:visited{
color : blue;
background-color:#e5e4e4;
text-decoration : underline;
}
.link_jscript{
color : blue;
background-color:#e5e4e4;
font-family : "Times New Roman", Times, Serif;
font-size : 15px;
font-weight : bold;
text-decoration : underline;
}
.link_jscript:hover{
color: #000033;
text-decoration:underline;	
background-color:#e5e4e4;
}
.link_jscript:active {
color: #000033;
background-color:#e5e4e4;
text-decoration : underline;
}
.footr{
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 30px;
padding-top : 10px;
margin-top : 15px;
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
.copyrt{
color : #fff;
background-color : #686464;	
font-family : arial, tahoma;
font-size : 10.5px;
font-weight : bold;
}
.cpy2{
margin-top : 15px;
}
.vl{
}
.err-wrap{
width : 80%;
background-color : #e60000;
align-content : center;
margin-top :5px;
padding-top : 5px;
padding-bottom : 8px;
margin-bottom : -12px;
border-radius : 5px;
padding-left : 4px;
padding-right : 4px;
}
.err{
color : #fff;
font-size : 16px;
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
}
/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {
*{margin:0px; padding:0px;}	
html, body{
overflow-x : hidden;	
}
.bdy{
background-color : #e5e4e4;	
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
padding-top : 12.5px;
padding-bottom : 12px;
border-bottom : 0.2px solid #b3b3b3;
border-top : 0.1px solid #000;
margin-top : 29.5px;
padding-left : 45px;
}
.vl{
margin-left : 17px;	
word-spacing : 50px;
}
.link_headr:visited{
color : #000;
background-color:#fff;
text-decoration : underline;
}
.link_headr{
color : #000;
background-color:#fff;
font-family : arial, tahoma;
font-size : 15.5px;
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
.content{
margin-top : 78px;
text-align : center;
}
.label_head{
font-size : 18px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.signup_form{
margin-top : 20px;
}
.label{
color : #000;
background-color : #e5e4e4;
font-size:16px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl{
width : 85%;
height : 33px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 14px;
margin-top : 2.5px;
}
.form-cntrl-birth{
width : 27%;
height : 33px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 15.5px;
margin-top : 5px;
}
.btn{
margin-top : 3.5px;	
width : 84%;
height : 35px;
border : 0.4px solid #1a1a00;
border-radius : 2px;
font-size : 14px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #000;
background-color : #FFD700;
margin-bottom : 20px;
}
.btn:hover{
color : #000;
background-color : #FFD700;
}
.form_login {
display: none;
position: fixed;
margin-top : 46px;
right: 75px;
border: 1px solid #1a1a00;
z-index: 9;
top : 0;
width : 285px;
}
.form-container {
padding-top : 10px;	
max-width: 100%;
background-color: white;
}
.label_head-login{
font-size : 16px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.log-head-div{
margin-bottom : 8px;	
}
.label-login{
color : #000;
background-color : #fff;
font-size:14px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl-login{
width : 88%;
height : 30px;;
border : 0.4px solid green;
border-radius : 1.5px;
font-size : 14px;
padding-left : 4px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 3px;
}
.wrap-login{
margin-top : 2px;
margin-bottom : 3px;
}
.btn-login{
margin-top : 3px;	
width : 86.5%;
height : 31px;
border : 0.4px solid #1a1a00;
border-radius : 0.7px;
font-size : 12px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : #008000;
margin-bottom : 5px;
opacity : 0.8;
}
.btn-login:hover{
color : #fff;
background-color : #008000;
opacity : 1;
}
.btn-login-cancel{
margin-top : 6px;	
width : 86.5%;
height : 31px;
border : 0.4px solid #1a1a00;
border-radius : 0.7px;
font-size : 12px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : red;
margin-bottom : 15px;
opacity : 0.8;
}
.btn-login-cancel:hover{
color : #fff;
background-color : red;
opacity : 1;
}
.link_jscript:visited{
color : blue;
background-color:#e5e4e4;
text-decoration : underline;
}
.link_jscript{
color : blue;
background-color:#e5e4e4;
font-family : "Times New Roman", Times, Serif;
font-size : 16px;
font-weight : bold;
text-decoration : underline;
}
.link_jscript:hover{
color: #000033;
text-decoration:underline;	
background-color:#e5e4e4;
}
.link_jscript:active {
color: #000033;
background-color:#e5e4e4;
text-decoration : underline;
}
.footr{
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 25px;
padding-top : 10px;
margin-top : 20px;
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
.copyrt{
color : #fff;
background-color : #686464;	
font-family : arial, tahoma;
font-size : 10.5px;
font-weight : bold;
}
.cpy2{
margin-top : 20px;
}
.vl{
}
.err-wrap{
width : 80%;
background-color : #e60000;
align-content : center;
margin-top :5px;
padding-top : 5px;
padding-bottom : 8px;
margin-bottom : -12px;
border-radius : 5px;
padding-left : 4px;
padding-right : 4px;
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
font-size : 19px;
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
}
/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {
*{margin:0px; padding:0px;}	
html, body{
overflow-x : hidden;	
}
.bdy{
background-color : #e5e4e4;	
}
.headr1{
position:fixed;
background-color : #151515;
width:100%;
max-width:100%;
padding-top : 12px;
padding-bottom : 8px;
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
padding-top : 12px;
padding-bottom : 12px;
border-bottom : 0.2px solid #b3b3b3;
border-top : 1.7px solid #000;
margin-top : 29px;
padding-left : 67px;
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
.content{
width : 65%;
max-width : 1300px;	
margin-top : 85px;
text-align : center;
}
.label_head{
font-size : 20px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.signup_form{
margin-top : 22px;
}
.label{
color : #000;
background-color : #e5e4e4;
font-size:18px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl{
width : 85%;
height : 35px;
border : thin solid green;
border-radius : 3px;
font-size : 18px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 16px;
margin-top : 2.5px;
}
.form-cntrl-birth{
width : 27%;
height : 35px;
border : thin solid green;
border-radius : 3px;
font-size : 18px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 17.5px;
margin-top : 5px;
}
.btn{
margin-top : 0px;	
width : 84%;
height : 37px;
border : thin solid #1a1a00;
border-radius : 2px;
font-size : 16px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #000;
background-color : #FFD700;
margin-bottom : 20px;
}
.btn:hover{
color : #000;
background-color : #FFD700;
}
.form_login {
display: none;
position: fixed;
margin-top : 50px;
right: 20px;
border: thin solid #1a1a00;
z-index: 9;
top : 0;
width : 450px;
}
.form-container {
padding-top : 10px;	
max-width: 100%;
background-color: white;
}
.label_head-login{
font-size : 20px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.log-head-div{
margin-bottom : 15px;	
}
.label-login{
color : #000;
background-color : #fff;
font-size:18px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl-login{
width : 88%;
height : 35px;;
border : thin solid green;
border-radius : 1.5px;
font-size : 17px;
padding-left : 4px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 5px;
}
.wrap-login{
margin-top : 2px;
margin-bottom : 8px;
}
.btn-login{
margin-top : 3px;	
width : 86.5%;
height : 36px;
border : thin solid #1a1a00;
border-radius : 0.7px;
font-size : 16px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : #008000;
margin-bottom : 5px;
opacity : 0.8;
}
.btn-login:hover{
color : #fff;
background-color : #008000;
opacity : 1;
}
.btn-login-cancel{
margin-top : 4px;	
width : 86.5%;
height : 36px;
border : thin solid #1a1a00;
border-radius : 0.7px;
font-size : 16px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : red;
margin-bottom : 20px;
opacity : 0.8;
}
.btn-login-cancel:hover{
color : #fff;
background-color : red;
opacity : 1;
}
.link_jscript:visited{
color : blue;
background-color:#e5e4e4;
text-decoration : underline;
}
.link_jscript{
color : blue;
background-color:#e5e4e4;
font-family : "Times New Roman", Times, Serif;
font-size : 18px;
font-weight : bold;
text-decoration : underline;
}
.link_jscript:hover{
color: #000033;
text-decoration:underline;	
background-color:#e5e4e4;
}
.link_jscript:active {
color: #000033;
background-color:#e5e4e4;
text-decoration : underline;
}
.footr{
background-color : #686464;	
text-align : center;
padding-bottom : 30px;
padding-top : 10px;
margin-top : 30px;
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
width : 80%;
background-color : #e60000;
align-content : center;
margin-top :5px;
padding-top : 5px;
padding-bottom : 8px;
margin-bottom : -12px;
border-radius : 5px;
padding-left : 200px;
padding-right : 200px;
}
.err{
color : #fff;
font-size : 18px;
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
font-size : 20px;
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

<a href="index.php" class="logo">KhojHai.com</a>

<span class='pr_logo'><span class="call">Helpline : xxxx-xx-xxxx</span></span>

</div>

<br>

<div class="headr2">

<span class='pr_vl'><span class="vl"></span></span>

<a href='index.php' class='link_headr' title='Go to home'>Home</a>

<span class='pr_vl'><span class="vl"></span></span>

<a href='khojhai_search_offline.php' class='link_headr' title='Search'>Search</a>

<span class='pr_vl'><span class="vl"></span></span>

<a href='khojhai_login.php' class='link_headr' title='Login' >LogIn</a>

<span class='pr_vl'><span class="vl"></span></span>

<a href='khojhai_signup.php' class='link_headr' title='Create Account'><u>SignUp</u></a>

</div><br>

<center>

<div class='content'>	

<!---------------- SIGNUP FORM -------------------->

<div class = "form_signup">

<span class="label_head">Create Account Now !!</span>

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

//--------------------------- Error No. 1 : For All, if empty -----------------------------//
if($r == 1)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>All Fields Are Required.<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

//------------------------- Error No 2 To 3 : For Name ---------------------------//
if($r == 2)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Name Can Contain English Letters and space without any Special Characters. It Cannot Be More Than 20 Characters.
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

if($r == 3)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Choose Another Name.
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

//------------------------- Error No 4 To 5 : For Email ---------------------------//
if($r == 4)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Email ID Already Exists !!
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

if($r == 5)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Invalid Email Address.
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

//------------------------- Error No 6 To 7 : For Password ---------------------------//
if($r == 6)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Password Cannot Be Less Than 6 Or More Than 35 Characters, It Should Contain Only English Letters Or Digits Or Both, Without Any Spaces Or Special Characters.
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

if($r == 7)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Your Password is Too Obvious, Please Choose Another. 
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

//--------------------------- Error No. 8 : If Something went wrong  +  Email-----------------------------//
if($r == 8)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Oops ! Something Went Wrong.<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

if($r == 9)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Email Length Should Be Within 1 To 65 Characters.<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}
?>
<!--- Error Ends ------->

<form action= "khojhai_signup2.php" method="POST" role="form" class="signup_form">

<!------------ Name -------------->

<span class="label">Your Name</span><br> 

<input type = "text" id = "name" name = "name" class = "form-cntrl" placeholder = "Your name" required = "required" pattern="[A-Za-z\s]{1,20}$" maxlength = "20" /><br> 

<!------------ Gender -------------->

<span class="label">Your Gender</span><br> 

<select id="gender" name="gender" class="form-cntrl">

  <option value="male">Male</option>
  <option value="female">Female</option>
  <option value="other">Other</option>
  
</select><br>

<!------------ birthday -------------->

<span class="label">BirthDay</span><br> 

<select id="year" name="year" class="form-cntrl-birth">

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

<!-------------- Email ------------->
<span class="label">Your Email</span><br>

<input type = "email" id = "email" name = "email" class = "form-cntrl" placeholder = "Your Email Address" required = "required" minlength = "1" maxlength = "80" /><br>

<!-------------- Password ------------->
<span class="label">Password</span><br>

<input type = "text" id = "password" name = "password" class = "form-cntrl" placeholder = "Between 6 To 35 Characters" required = "required" pattern = "[A-Za-z0-9]{6,35}$" 

required title = "Password Cannot Be Less Than 6 Or More Than 35 Characters, It Should Contain Only English Letters Or Digits Or Both, Without Any Spaces Or Special Characters" 
autocomplete = "off" autocorrect = "off" spellcheck = "false" minlength = "6" maxlength = "35" /><br>

<!-------------- Submit Button ------------->

<input class = "btn" type = "submit" id = "submit" name = "submit" value = "Sign Up Now !" title = "Click To Create Account" /><br>

</form>

<a href='#' class='link_jscript' onclick='openForm()' title='You Can Login Here'>Click Here To LogIn</a>

</div>

<!------------------ LOGIN FORM (POPUP) -------------------->

<div class="form_login" id="loginForm">

<form action="khojhai_login2.php" method='POST' class="form-container">
  
<div class='log-head-div'><span class='label_head-login'>Login</span></div>



<span class="label-login">Your Email</span><br>

<div class='wrap-login'>
<input type = "email" id = "email" name = "email" class = "form-cntrl-login" placeholder = "Your Email Address" required = "required" minlength = "1" maxlength = "80" /><br>
</div>


<span class="label-login">Password</span><br>

<div class='wrap-login'>
<input type = "password" id = "password" name = "password" class = "form-cntrl-login" placeholder = "Between 6 To 35 Characters" required = "required" pattern = "[A-Za-z0-9]{6,35}$" 

required title = "Password Cannot Be Less Than 6 Or More Than 35 Characters, It Should Contain Only English Letters Or Digits Or Both, Without Any Spaces Or Special Characters" 

autocomplete = "off" autocorrect = "off" spellcheck = "false" minlength = "6" maxlength = "35" /><br>
</div>


<input class = "btn-login" type = "submit" id = "submit" name = "submit" value = "Login Now" title = "Click here to login" /><br>

<input class = "btn-login-cancel" type = "submit" value = "Cancel" title = "Click here to close" onclick="closeForm()"/><br>

</form>

</div>

<!------------------ LOGIN FORM (POPUP) ENDS-------------------->

</div>

<br>

<!----------------------- Footer ----------------------->
<div class='footr'>

<a href='khojhai_about_offline.php' class='link_footr' title='know more about us'>About Us</a>

<span class="vl"></span>

<a href='khojhai_contact_offline.php' class='link_footr' title='Contact Us'>Contact Us</a>

<span class="vl"></span>

<a href='khojhai_press_offline.php' class='link_footr' title='Latest News About Us'>Press</a>

<span class="vl"></span>

<a href='khojhai_fund_offline.php' class='link_footr' title='Who Supports Us'>Funding</a><br>

<div class='cpy2'><span class='copyrt'>&copy; Copyright 450 BC - 2020</span></div>

</div>

</center>

</body>

</html>