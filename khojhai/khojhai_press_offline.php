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
header("Location: khojhai_press.php");
exit();
}

if(!(empty($_SESSION['user_id'])))
{
header("Location: khojhai_press.php");
exit();
}	

if(!(empty($_SESSION['user_password'])))
{
header("Location: khojhai_press.php");
exit();
}


//------------------ LEVEL 02 of session checking ----------------//
if(isset($_SESSION['user_email']))
{
header("Location: khojhai_press.php");
exit();
}

if(isset($_SESSION['user_id']))
{
header("Location: khojhai_press.php");
exit();
}	

if(isset($_SESSION['user_password']))
{
header("Location: khojhai_press.php");
exit();
}

//session checking ends here 
?>



<!DOCTYPE html>

<html lang="en">

<head>

<title>News & Media Coverage | KhojHai.com</title>

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
padding-top : 12px;
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
.div_missing_img1_2{
margin : 0 auto;	
border : thin solid #b1a8bd;	
background-color : #f2f0f4;
width : 100%;
max-width : 545px;
border-radius : 10px;
text-align : center;
padding-top : 20px;
padding-bottom : 5px;
padding-left : 30px;
padding-right : 40px;
margin-bottom : -11px;
overflow : hidden;
}
.news_heading:visited{
color : #000;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_heading{
color : #000;
background-color:#f2f0f4;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
font-size : 20px;
text-decoration : underline;
line-height : 1.6;
}
.news_heading:hover{
color: #000066;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_heading:active{
color: #000066;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_by{
font-size : 19px;	
}
.div_publisher{
margin-top : 30px;
margin-bottom : -5px;	
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
padding-top : 12px;
padding-bottom : 0px;
margin-top : -13px;
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
.div_missing_img1_2{
margin : 0 auto;	
border : thin solid #b1a8bd;	
background-color : #f2f0f4;
width : 100%;
max-width : 700px;
border-radius : 10px;
text-align : center;
padding-top : 20px;
padding-bottom : 5px;
padding-left : 35px;
padding-right : 40px;
margin-bottom : -11px;
overflow : hidden;
}
.news_heading:visited{
color : #000;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_heading{
color : #000;
background-color:#f2f0f4;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
font-size : 20px;
text-decoration : underline;
line-height : 1.7;
}
.news_heading:hover{
color: #000066;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_heading:active{
color: #000066;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_by{
font-size : 19px;	
}
.div_publisher{
margin-top : 30px;
margin-bottom : -5px;	
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
padding-top : 13px;
padding-bottom : 0px;
margin-top : -13px;
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
.div_missing_img1_2{
margin : 0 auto;	
border : thin solid #b1a8bd;	
background-color : #f2f0f4;
width : 100%;
max-width : 770px;
border-radius : 10px;
text-align : center;
padding-top : 20px;
padding-bottom : 5px;
padding-left : 45px;
padding-right : 45px;
margin-bottom : -11px;
overflow : hidden;
}
.news_heading:visited{
color : #000;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_heading{
color : #000;
background-color:#f2f0f4;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
font-size : 20px;
text-decoration : underline;
line-height : 1.7;
}
.news_heading:hover{
color: #000066;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_heading:active{
color: #000066;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_by{
font-size : 19px;	
}
.div_publisher{
margin-top : 30px;
margin-bottom : -5px;	
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
margin-left : 19px;	
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
padding-top : 15px;
padding-bottom : 0px;
margin-top : -13px;
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
.div_missing_img1_2{
margin : 0 auto;	
border : thin solid #b1a8bd;	
background-color : #f2f0f4;
width : 100%;
max-width : 800px;
border-radius : 10px;
text-align : center;
padding-top : 20px;
padding-bottom : 5px;
padding-left : 50px;
padding-right : 50px;
margin-bottom : -11px;
overflow : hidden;
}
.news_heading:visited{
color : #000;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_heading{
color : #000;
background-color:#f2f0f4;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
font-size : 21px;
text-decoration : underline;
line-height : 1.7;
}
.news_heading:hover{
color: #000066;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_heading:active{
color: #000066;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_by{
font-size : 20px;	
}
.div_publisher{
margin-top : 30px;
margin-bottom : -3px;	
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
margin-left : 19px;	
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
margin-top : -14.5px;
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
.div_missing_img1_2{
margin : 0 auto;	
border : thin solid #b1a8bd;	
background-color : #f2f0f4;
width : 100%;
max-width : 800px;
border-radius : 10px;
text-align : center;
padding-top : 20px;
padding-bottom : 5px;
padding-left : 50px;
padding-right : 50px;
margin-bottom : -11px;
overflow : hidden;
}
.news_heading:visited{
color : #000;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_heading{
color : #000;
background-color:#f2f0f4;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
font-size : 21px;
text-decoration : underline;
line-height : 1.7;
}
.news_heading:hover{
color: #000066;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_heading:active{
color: #000066;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_by{
font-size : 20px;	
}
.div_publisher{
margin-top : 30px;
margin-bottom : -3px;	
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
margin-left : 19px;	
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
margin-top : -14.5px;
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
.div_missing_img1_2{
margin : 0 auto;	
border : thin solid #b1a8bd;	
background-color : #f2f0f4;
width : 100%;
max-width : 900px;
border-radius : 10px;
text-align : center;
padding-top : 20px;
padding-bottom : 5px;
padding-left : 65px;
padding-right : 65px;
margin-bottom : -11px;
overflow : hidden;
}
.news_heading:visited{
color : #000;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_heading{
color : #000;
background-color:#f2f0f4;
font-family : arial, tahoma, "Times New Roman", Times, Serif;
font-size : 21px;
text-decoration : underline;
line-height : 1.7;
}
.news_heading:hover{
color: #000066;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_heading:active{
color: #000066;
background-color:#f2f0f4;
text-decoration : underline;
}
.news_by{
font-size : 20px;	
}
.div_publisher{
margin-top : 30px;
margin-bottom : -3px;	
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

<a href='index.php' class='link_headr' title='Home'>Home</a>

<span class='pr_vl'><span class="vl"></span></span>

<a href='khojhai_search_offline.php' class='link_headr' title='Search'>Search</a>

<span class='pr_vl'><span class="vl"></span></span>

<a href='khojhai_login.php' class='link_headr' title='SignIn'>LogIn</a>

<span class='pr_vl'><span class="vl"></span></span>

<a href='khojhai_signup.php' class='link_headr' title='Create Account'>SignUp</a>

</div><br>



<div class = 'options'>

<a href='khojhai_login.php?err=6' class='link_option1' title='Add Missing Person'>Add Missing Person</a>

</div>

<br>

<div class = 'options2'>

<a href='khojhai_search_offline.php' class='link_option2' title='Search Missing Person'>Search Missing Person</a>

</div>

<br>



<div class="slideshow-container">

  <div class="text"><i>"You Guys Are Doing Great Job." </i><br><label class='feed_name'>~ Ritan Tota</label></div>
  
  <div class="text"><i>"I Found My Son, With Their Help. Thank You" </i><br><label class='feed_name'>~ N.D. Tiworry</label></div>

  <div class="text"><i>"I Found My Wife With The Help Of This Organization." </i><br><label class='feed_name'>~ Jeph Bajaj</label></div>

  <div class="text"><i>"Maine Apne Pitaji Ko Khoja, Iss Organization Ki Madad Se." </i><br><label class='feed_name'>~ Okhilesh Aadav</label></div>
  
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
  setTimeout(showSlides, 3600); // Change image every 3.6 seconds
}
</script>



<center>

<div class='content'>	

<div class = "all_content">

<div class = "form_signup">


<?php 


echo "<div class='div_missing_case_wrap'>";	

echo "<div class='div_missing_img1_2'>";
	
echo "<a href='https://timesofindia.indiatimes.com/entertainment/hindi/bollywood/news/karan-johar-honoured-to-receive-padma-shri-alongside-kangana/articleshow/73735587.cms' 

class='news_heading'>";
	
echo ucwords("<b><i>KhojHai.com along with Karan Johar and others, will receive an Rashtrapati Award from President 

Shri. Ramnath kovind, for its contribution towards society</i></b><br>");

echo "</a>";

echo "<center><div class='div_publisher'><p class='news_by'><i>&quot;Times Of India&quot;</i></p></div></center><br>";



echo "</div>";

echo "</div><br>";



echo "<div class='div_missing_case_wrap'>";	

echo "<div class='div_missing_img1_2'>";
	
echo "<a href='https://www.indiatoday.in/india/story/who-is-rohit-shekhar-the-man-who-fought-paternity-battle-with-father-nd-tiwari-1503476-2019-04-16' 

class='news_heading'>";
	
echo ucwords("<b><i>Mumbai Based organization called &quot;KhojHai.com&quot; helped N.D. Tiwari To find his son after decades-long.</i></b><br>");

echo "</a>";

echo "<center><div class='div_publisher'><p class='news_by'><i>&quot;India Today&quot;</i></p></div></center><br>";



echo "</div>";

echo "</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";

?>

</div><br class='remove'>

<br>

</div></div></center><br>



<!----------------------- Footer ----------------------->
<div class='footr'>

<a href='khojhai_about_offline.php' class='link_footr' title='Know more about us'>About Us</a>

<span class="vl"></span>

<a href='khojhai_contact_offline.php' class='link_footr' title='Contact Us'>Contact Us</a>

<span class="vl"></span>

<a href='khojhai_press_offline.php' class='link_footr' title='Latest News About Us'>Press</a>

<span class="vl"></span>

<a href='khojhai_fund_offline.php' class='link_footr' title='Who Supports Us'>Funding</a><br>

<div class='cpy2'><span class='copyrt'>&copy; Copyright 450 BC - 2020</span></div>

</div>

</body>

</html>