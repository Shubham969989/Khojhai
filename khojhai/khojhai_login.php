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

<title>Sign In To Your Account | KhojHai.com</title>

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
.all_content{
text-align:center;
width : 97%;
max-width : 97%;
background-color : #fff;
border-radius : 10px;
padding-top : 15px;
padding-bottom : 25px;
margin-top : -15px;
border : 0.6px solid #b6afaf;
padding-left : 15px;
padding-right : 18px;
margin-bottom : -25px;
}
.label_head{
font-size : 16px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.signup_form{
margin-top : 10px;
}
.label{
color : #000;
background-color : #fff;
font-size:16px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl{
width : 90%;
height : 32px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 12px;
margin-top : 2px;
}
.btn{
margin-top : -1px;	
width : 87%;
height : 31px;
border : 0.4px solid #1a1a00;
border-radius : 2px;
font-size : 13px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : green;
margin-bottom : 18px;
}
.btn:hover{
color : #fff;
background-color : #004d00;
}
.form_login {
display: none;
position: fixed;
margin-top : 1px;
right: 0px;
border: 1px solid #1a1a00;
z-index: 9;
top : 0;
width : 90%;
margin-right : 20px;
}
.form-container {
padding-top : 10px;		
max-width: 100%;
background-color: white;
}
.log-head-div{
margin-bottom : 5px;	
}
.label_head-login{
font-size : 20px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.label-login{
color : #000;
background-color : #fff;
font-size:16px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl-login{
width : 90%;
height : 27px;;
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
margin-top : 0px;	
width : 87%;
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
width : 87%;
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
background-color:#fff;
text-decoration : underline;
}
.link_jscript{
color : blue;
background-color:#fff;
font-family : "Times New Roman", Times, Serif;
font-size : 16px;
font-weight : bold;
text-decoration : underline;
}
.link_jscript:hover{
color: #000033;
text-decoration:underline;	
background-color:#fff;
}
.link_jscript:active {
color: #000033;
background-color:#fff;
text-decoration : underline;
}
.footr{
width : 97%;	
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 27px;
padding-top : 10px;
margin-top : 12px;
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
margin-bottom : -2px;
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
.all_content{
text-align:center;
width : 97%;
max-width : 97%;
background-color : #fff;
border-radius : 10px;
padding-top : 15px;
padding-bottom : 25px;
margin-top : -15px;
border : 0.6px solid #b6afaf;
padding-left : 15px;
padding-right : 18px;
margin-bottom : -25px;
}
.label_head{
font-size : 16px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.signup_form{
margin-top : 10px;
}
.label{
color : #000;
background-color : #fff;
font-size:16px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl{
width : 90%;
height : 32px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 12px;
margin-top : 2px;
}
.btn{
margin-top : -1px;	
width : 87%;
height : 31px;
border : 0.4px solid #1a1a00;
border-radius : 2px;
font-size : 13px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : green;
margin-bottom : 18px;
}
.btn:hover{
color : #fff;
background-color : #004d00;
}
.form_login {
display: none;
position: fixed;
margin-top : 45px;
right: 0px;
border: 1px solid #1a1a00;
z-index: 9;
top : 0;
width : 90%;
margin-right : 40px;
}
.form-container {
padding-top : 20px;		
max-width: 100%;
background-color: white;
padding-bottom : 10px;
}
.log-head-div{
margin-bottom : 10px;	
}
.label_head-login{
font-size : 20px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.label-login{
color : #000;
background-color : #fff;
font-size:16px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl-login{
width : 90%;
height : 31px;;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
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
width : 88%;
height : 30px;
border : 0.4px solid #1a1a00;
border-radius : 0.7px;
font-size : 13.5px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : #008000;
margin-bottom : 0.8px;
opacity : 0.8;
}
.btn-login:hover{
color : #fff;
background-color : #008000;
opacity : 1;
}
.btn-login-cancel{
margin-top : 7.5px;	
width : 88%;
height : 30px;
border : 0.4px solid #1a1a00;
border-radius : 0.7px;
font-size : 13.5px;
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
background-color:#fff;
text-decoration : underline;
}
.link_jscript{
color : blue;
background-color:#fff;
font-family : "Times New Roman", Times, Serif;
font-size : 16px;
font-weight : bold;
text-decoration : underline;
}
.link_jscript:hover{
color: #000033;
text-decoration:underline;	
background-color:#fff;
}
.link_jscript:active {
color: #000033;
background-color:#fff;
text-decoration : underline;
}
.footr{
width : 97%;	
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 27px;
padding-top : 10px;
margin-top : 12px;
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
margin-bottom : -2px;
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
margin-top : 73px;
text-align : center;
}
.all_content{
text-align:center;
width : 97%;
max-width : 97%;
background-color : #fff;
border-radius : 10px;
padding-top : 25px;
padding-bottom : 35px;
margin-top : -15px;
border : 0.6px solid #b6afaf;
padding-left : 15px;
padding-right : 18px;
margin-bottom : -25px;
}
.label_head{
font-size : 16px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.signup_form{
margin-top : 15px;
}
.label{
color : #000;
background-color : #fff;
font-size:16px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl{
width : 90%;
height : 32px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 12px;
margin-top : 2px;
}
.btn{
margin-top : -1px;	
width : 89%;
height : 31px;
border : 0.4px solid #1a1a00;
border-radius : 2px;
font-size : 13px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : green;
margin-bottom : 18px;
}
.btn:hover{
color : #fff;
background-color : #004d00;
}
.form_login {
display: none;
position: fixed;
margin-top : 47px;
right: 110px;
border: 1px solid #1a1a00;
z-index: 9;
top : 0;
width : 60%;
margin-right : 60px;
}
.form-container {
padding-top : 10px;		
max-width: 100%;
background-color: white;
padding-bottom : 10px;
}
.log-head-div{
margin-bottom : 10px;	
}
.label_head-login{
font-size : 20px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.label-login{
color : #000;
background-color : #fff;
font-size:16px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl-login{
width : 85%;
height : 31px;;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
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
width : 83%;
height : 30px;
border : 0.4px solid #1a1a00;
border-radius : 0.7px;
font-size : 13.5px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : #008000;
margin-bottom : 0.8px;
opacity : 0.8;
}
.btn-login:hover{
color : #fff;
background-color : #008000;
opacity : 1;
}
.btn-login-cancel{
margin-top : 7.5px;	
width : 83%;
height : 30px;
border : 0.4px solid #1a1a00;
border-radius : 0.7px;
font-size : 13.5px;
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
background-color:#fff;
text-decoration : underline;
}
.link_jscript{
color : blue;
background-color:#fff;
font-family : "Times New Roman", Times, Serif;
font-size : 16px;
font-weight : bold;
text-decoration : underline;
}
.link_jscript:hover{
color: #000033;
text-decoration:underline;	
background-color:#fff;
}
.link_jscript:active {
color: #000033;
background-color:#fff;
text-decoration : underline;
}
.footr{
width : 97%;	
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 30px;
padding-top : 10px;
margin-top : 15px;
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
margin-bottom : -2px;
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
margin-top : 73px;
text-align : center;
}
.all_content{
text-align:center;
width : 70%;
max-width : 70%;
background-color : #fff;
border-radius : 10px;
padding-top : 25px;
padding-bottom : 35px;
margin-top : -15px;
border : 0.6px solid #aaa1a1;
padding-left : 15px;
padding-right : 18px;
margin-bottom : -25px;
}
.label_head{
font-size : 16px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.signup_form{
margin-top : 15px;
}
.label{
color : #000;
background-color : #fff;
font-size:16px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl{
width : 90%;
height : 32px;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 12px;
margin-top : 2px;
}
.btn{
margin-top : -1px;	
width : 89%;
height : 31px;
border : 0.4px solid #1a1a00;
border-radius : 2px;
font-size : 13px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : green;
margin-bottom : 18px;
}
.btn:hover{
color : #fff;
background-color : #004d00;
}
.form_login {
display: none;
position: fixed;
margin-top : 120px;
right: 250px;
border: 1px solid #1a1a00;
z-index: 9;
top : 0;
width : 45%;
max-width : 45%;
margin-right : 60px;
}
.form-container {
padding-top : 10px;		
max-width: 100%;
background-color: white;
padding-bottom : 10px;
}
.log-head-div{
margin-bottom : 10px;	
}
.label_head-login{
font-size : 20px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
}
.label-login{
color : #000;
background-color : #fff;
font-size:16px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl-login{
width : 85%;
height : 31px;;
border : 0.4px solid green;
border-radius : 3px;
font-size : 16px;
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
width : 83%;
height : 30px;
border : 0.4px solid #1a1a00;
border-radius : 0.7px;
font-size : 13.5px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : #008000;
margin-bottom : 0.8px;
opacity : 0.8;
}
.btn-login:hover{
color : #fff;
background-color : #008000;
opacity : 1;
}
.btn-login-cancel{
margin-top : 7.5px;	
width : 83%;
height : 30px;
border : 0.4px solid #1a1a00;
border-radius : 0.7px;
font-size : 13.5px;
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
background-color:#fff;
text-decoration : underline;
}
.link_jscript{
color : blue;
background-color:#fff;
font-family : "Times New Roman", Times, Serif;
font-size : 16px;
font-weight : bold;
text-decoration : underline;
}
.link_jscript:hover{
color: #000033;
text-decoration:underline;	
background-color:#fff;
}
.link_jscript:active {
color: #000033;
background-color:#fff;
text-decoration : underline;
}
.footr{
width : 70%;	
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 30px;
padding-top : 10px;
margin-top : 15px;
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
margin-bottom : -2px;
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
background-color : #fff;	
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
margin-top : 77px;
text-align : center;
}
.all_content{
text-align:center;
width : 45%;
max-width : 690px;
background-color : #fff;
border-radius : 10px;
padding-top : 30px;
padding-bottom : 40px;
margin-top : -15px;
border : thin solid #aaa1a1;
padding-left : 15px;
padding-right : 18px;
margin-bottom : -25px;
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
background-color : #fff;
font-size:18px;
font-family:"Times New Roman", Times, Serif;
}
.form-cntrl{
width : 90%;
height : 35px;
border : thin solid green;
border-radius : 3px;
font-size : 18px;
padding-left : 5px;
font-family : "Times New Roman", Times, Serif;
margin-bottom : 16px;
margin-top : 2.5px;
}
.btn{
margin-top : 0px;	
width : 89%;
height : 37px;
border : thin solid #1a1a00;
border-radius : 2px;
font-size : 16px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : green;
margin-bottom : 20px;
}
.btn:hover{
color : #fff;
background-color : #004d00;
}
.form_login {
display: none;
position: fixed;
margin-top : 125px;
left : 47%;
border: thin solid #1a1a00;
z-index: 9;
top : 0;
width : 23%;
max-width : 400px;
margin-right : 450px;
}
.form-container {
padding-top : 10px;		
max-width: 100%;
background-color: white;
padding-bottom : 10px;
}
.log-head-div{
margin-bottom : 10px;	
}
.label_head-login{
font-size : 20px;
font-family : "Times New Roman", Times, serif;
color : green;
background-color:e5e4e4;
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
margin-top : 0px;	
width : 87%;
height : 36px;
border : thin solid #1a1a00;
border-radius : 0.7px;
font-size : 16px;
font-weight : bold;
text-align : center;
font-family : arial, tahoma;
color : #fff;
background-color : #008000;
margin-bottom : 0.8px;
opacity : 0.8;
}
.btn-login:hover{
color : #fff;
background-color : #008000;
opacity : 1;
}
.btn-login-cancel{
margin-top : 7.5px;	
width : 87%;
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
background-color:#fff;
text-decoration : underline;
}
.link_jscript{
color : blue;
background-color:#fff;
font-family : "Times New Roman", Times, Serif;
font-size : 18px;
font-weight : bold;
text-decoration : underline;
}
.link_jscript:hover{
color: #000033;
text-decoration:underline;	
background-color:#fff;
}
.link_jscript:active {
color: #000033;
background-color:#fff;
text-decoration : underline;
}
.footr{
width : 45%;
max-width : 690px;	
background-color : #686464;	
text-align : center;
margin-top : -12px;
padding-bottom : 30px;
padding-top : 10px;
margin-top : 15px;
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
padding-left : 10px;
padding-right : 10px;
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

<a href='khojhai_login.php' class='link_headr' title='Login' ><u>LogIn</u></a>

<span class='pr_vl'><span class="vl"></span></span>

<a href='khojhai_signup.php' class='link_headr' title='Create Account'>SignUp</a>

</div><br>

<center>

<div class='content'>	

<center>

<div class='all_content'>

<!---------------- SIGNUP FORM -------------------->

<div class = "form_signup">

<span class="label_head">Login Now !!</span>

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

//--------------------------- Error No. 1 : For alert, if follow button is clicked -----------------------------//
if($r == 1)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Please Log In To Continue.<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

//------------------------- Error No 2 : For alert, invalid email or pass ---------------------------//
if($r == 2)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Invalid Email Or Password, Please Check It Again.
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

//------------------------- Error No 3 : For success alert, password changed ---------------------------//
if($r == 3)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Password Changed !!
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

//------------------------- Error No 4-5 : For forgot password ---------------------------//
if($r == 4)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Email Doesn't Exist !!
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

if($r == 5)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Link Sent To Your Email Address !!
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

if($r == 6)
{
echo "<center><div class='err-wrap' id='errorClose'>";
	
echo "<p class='err'>Please LogIn To Continue.
<a href='#' class='err-close' onclick='errClose()'> X</a></p>";

echo "</div></center>"; 
}

?>
<!--- Error Ends ------->

<form action= "khojhai_login2.php" method="POST" role="form" class="signup_form">

<!-------------- Email ------------->
<span class="label">Your Email</span><br>

<input type = "email" id = "email" name = "email" class = "form-cntrl" placeholder = "Your Email Address" required = "required" minlength = "1" maxlength = "80" /><br>

<!-------------- Password ------------->
<span class="label">Password</span><br>

<input type = "password" id = "password" name = "password" class = "form-cntrl" placeholder = "Between 6 To 35 Characters" required = "required" pattern = "[A-Za-z0-9]{6,35}$" 

required title = "Password Cannot Be Less Than 6 Or More Than 35 Characters, It Should Contain Only English Letters Or Digits Or Both, Without Any Spaces Or Special Characters" 
autocomplete = "off" autocorrect = "off" spellcheck = "false" minlength = "6" maxlength = "35" /><br>

<!-------------- Submit Button ------------->

<input class = "btn" type = "submit" id = "submit" name = "submit" value = "Login" title = "Click Here To SignIn" /><br>

</form>

<a href='#' class='link_jscript' onclick='openForm()' title='Forgot Password ?'>Forgot Password</a>

</div>

<!------------------ Forgot pass FORM (POPUP) -------------------->

<div class="form_login" id="loginForm">

<form action="khojhai_forg_pass.php" method='POST' class="form-container">
  
<div class='log-head-div'><span class='label_head-login'>Forgot Password?</span></div>



<span class="label-login">Your Email</span><br>

<div class='wrap-login'>
<input type = "email" id = "email" name = "email" class = "form-cntrl-login" placeholder = "Your Email Address" required = "required" minlength = "1" maxlength = "80" /><br>
</div>

<input class = "btn-login" type = "submit" id = "submit" name = "submit" value = "Submit" title = "Click here" /><br>

<input class = "btn-login-cancel" type = "submit" value = "Cancel" title = "Click here to close" onclick="closeForm()"/><br>

</form>

</div>

<!------------------ FORM (POPUP) ENDS-------------------->

</div>

</center>

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