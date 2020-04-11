<?php
session_start();
include("header.php");
include("dbconnection.php");
if(isset($_SESSION[doctorid]))
{
	echo "<script>window.location='doctoraccount.php';</script>";
}
if(isset($_POST[submit]))
{
	$sql = "SELECT * FROM doctor WHERE loginid='$_POST[loginid]' AND password='$_POST[password]' AND status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rslogin = mysqli_fetch_array($qsql);
		$_SESSION[doctorid]= $rslogin[doctorid] ;
		echo "<script>window.location='doctoraccount.php';</script>";
	}
	else
	{
		echo "<script>alert('Invalid login id and password entered..'); </script>";
	}
}
?>
<!DOCTYPE html>
<head>
<style>
*{
    margin: 0;
    padding: 0;
    text-decoration: none;
    font-family: montserrat;
    box-sizing: border-box;
}

body{
    min-height: 100vh;
    background-color:  #071f44;
}

.login-form{
    width: 360px;
    background: black;
    height: 580px;
    padding: 80px 40px;
    border-radius: 10px;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%,-50%);
}

.login-form h1{
    text-align: center;
    margin-bottom: 60px;
}
.txtb{
    border-bottom: 2px solid #adadad;
    position: relative;
    margin: 30px 0;
}
.txtb input{
    font-size: 15px;
    color: #333;
    border: none;
    width: 100%;
    outline: none;
    background: none;
    padding: 0 5px;
    height: 40px;
}

.txtb span::before{
    content: attr(data-placeholder);
    position: absolute;
    top: 50%;
    left: 5px;
    color: #adadad;
    transform: translateY(-50%);
    z-index: -1;
}
.txb span::after{
    content: '';
    position: absolute;
    width: 0%;
    height: 2px;
    background: linear-gradient(120deg,white,#071f44,#071f44);
    transition: .5s;
    
}
.focus + span::before{
    top: -5px;
}

.focus + span::after{
   width: 100%;
}

.logbtn{
    display: block;
    width: 100%;
    height: 50px;
    border: none;
    background: linear-gradient(120deg,white,#071f44,#071f44);
    background-size: 200%;
    color: #fff;
    outline: none;
    cursor: pointer;
    transition: .2s;
} 
.logbtn:hover{
    background-position: right;
}
.bottom-text{
    margin-top: 60px;
    text-align: center;
    font-size: 13px;
}
</style>
<body>
<form method="post"  class="login-form"  action="" name="frmdoctlogin" onSubmit="return validateform()">
        <h1>Login</h1>
        
        <div class="txtb">
        <input type="text" name="loginid" id="loginid" />
        <span data-placeholder="Doctor Id"></span>
        </div>
        
        <div class="txtb">
        <input type="password" name="password" id="password" />
        <span data-placeholder="Password"></span>
        </div>
        
		<input type="submit" name="submit" id="submit" class="logbtn" value="Submit" />
        </form>
        
        <script type="text/javascript">
        $(".txtb input").on("focus",function(){
            $(this).addClass("focus");
        });
            
        $(".txtb input").on("blur",function(){
            if($(this).val() == "")
            $(this).removeClass("focus");
        });
        </script>
        
    </body>

<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	 if(document.frmdoctlogin.loginid.value == "")
	{
		alert("Login ID should not be empty..");
		document.frmdoctlogin.loginid.focus();
		return false;
	}
	else if(!document.frmdoctlogin.loginid.value.match(alphanumericExp))
	{
		alert("Login ID not valid..");
		document.frmdoctlogin.loginid.focus();
		return false;
	}
	else if(document.frmdoctlogin.password.value == "")
	{
		alert("Password should not be empty..");
		document.frmdoctlogin.password.focus();
		return false;
	}
	else if(document.frmdoctlogin.password.value.length < 8)
	{
		alert("Password length should be more than 8 characters...");
		document.frmdoctlogin.password.focus();
		return false;
	}
	
}
</script>