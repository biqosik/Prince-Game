<?php
	include "connection.php";
	if(isset($_SESSION['login'])){
		header("Location:index.php");
	}
	if(isset($_POST['signup'])){
		if(!empty($_POST['name']) && !empty($_POST['email'])){
		
			if($_POST['pwd'] != $_POST['c_pwd']){
				$_SESSION['error'] = "password and confirm password does not match";	
			}
			else{
				$query = "SELECT * FROM user WHERE `Email` = '".$_POST['email']."'";
				$result = $db->query($query);
				if($result->num_rows >0){
					$_SESSION['error'] = "Email alredy Exist";
				}
				else{
					$password = hash('sha512',$_POST['pwd']);
					$name  = $_POST['name'];
					$email = $_POST['email'];
					$query = "INSERT INTO `user`( `name`, `email`, `password`) VALUES ('$name', '$email', '$password')";
					$result = $db->query($query);
					if($result){
						$_SESSION['sucess'] = "sucessfully registerd";
					}
					else{
							$_SESSION['error'] = "Unable to  registerd";
					}
				}
			}
		}
		else{
			$_SESSION['error'] = "Name and email requied";
		}
	}

	if(isset($_POST['login'])){

		if(!empty($_POST['pwd']) && !empty($_POST['email'])){
			
		
				
					$password = hash('sha512',$_POST['pwd']);

					$email = $_POST['email'];
					
				$query = "SELECT * FROM user WHERE `Email` = '".$_POST['email']."' and `password` = '".$password."'";
				
					$result = $db->query($query);

					if($result->num_rows <= 0){
				
							$_SESSION['error'] = "Unable to  login username or password is incorrect";
					}
					else{
						$row = $result->fetch_object();
						$_SESSION['login']  = true;
						$_SESSION['id']  = $row->id;
						header("Location:index.php");
					}
			
		}
		else{
			$_SESSION['error'] = "Name and email requied";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<title></title>
</head>
<body>

  <div class="login-box">
  	<span style="color:red"><?php if(isset($_SESSION['error'])) echo $_SESSION['error']; unset($_SESSION['error']) ?></sapn>
  		<span style="color:green"><?php if(isset($_SESSION['sucess'])) echo $_SESSION['sucess']; unset($_SESSION['sucess']) ?></sapn>
    <div class="lb-header">
      <a href="#" class="active" id="login-box-link">Login</a>
      <a href="#" id="signup-box-link">Sign Up</a>
    </div>
    
    <form class="email-login" action="" method="post">
      <div class="u-form-group">
        <input type="email" name="email" placeholder="Email" required />
      </div>
      <div class="u-form-group">
        <input type="password" name="pwd" placeholder="Password" required />
      </div>
      <div class="u-form-group">
        <button class= "button login" name="login" type="submit">Log in</button>
      </div>
     
    </form>
    <form class="email-signup" method="post" action="">
    	<div class="u-form-group">
        <input type="text" name="name" placeholder="Name"required/>
      </div>
      <div class="u-form-group">
        <input type="email" name="email" placeholder="Email" required/>
      </div>
      <div class="u-form-group">
        <input type="password" name="pwd" placeholder="Password" required/>
      </div>
      <div class="u-form-group">
        <input type="password" name="c_pwd" placeholder="Confirm Password" required/>
      </div>
      <div class="u-form-group">
        <button class="button login" type="submit" name="signup">Sign Up</button>
      </div>
    </form>
  </div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script type="text/javascript">
  	$(".email-signup").hide();
$("#signup-box-link").click(function(){
  $(".email-login").fadeOut(100);
  $(".email-signup").delay(100).fadeIn(100);
  $("#login-box-link").removeClass("active");
  $("#signup-box-link").addClass("active");
});
$("#login-box-link").click(function(){
  $(".email-login").delay(100).fadeIn(100);;
  $(".email-signup").fadeOut(100);
  $("#login-box-link").addClass("active");
  $("#signup-box-link").removeClass("active");
});
  </script>
</body>
</html>