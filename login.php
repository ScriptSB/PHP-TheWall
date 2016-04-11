<?php 
session_start();
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="author" content="Jonathan Ben-Ammi">
 	<title>The Wall</title>
 	<meta name="description" content="A PHP assignment for Coding Dojo">
 	<link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body>
 	<div id="container">
 		<img id="logolg" src="images/logo.png" alt="logo">
 		<div id="loginWhole">
	 		<div id="loginLeft">
		 		<h3>Login:</h3>
		 		<form id="loginform" action="process.php" method="post">
			 		<div class="fields">
					<?php if(isset($_SESSION['errors']['username'])){ ?>
						<p class="warning"><?= $_SESSION['errors']['username']; ?></p> 
					<?php };?>	
			 		<label for="username">Username:</label>
			 		<input type="text" placeholder="Username" name="username" />
			 		</div>
			 		<div class="fields">
					<?php if(isset($_SESSION['errors']['password'])){ ?>
						<p class="warning"><?= $_SESSION['errors']['password']; ?></p> 
					<?php };?>			 		
			 		<label for="password">Password:</label>
			 		<input type="password" placeholder="Password" name="password" />
			 		</div>
			 		<input type="hidden" name="behavior" value="login" />
			 		<input class="btn" type="submit" value="Login" />
		 		</form>
	 		</div>
			<h2 id="loginCenter">- OR -</h2>
	 		<div id="loginRight">
		 		<h3>Register:</h3>
		 		<form id="register" action="register.php" method="post">
		 			<input class="btn" type="submit" value="Register" />
		 		</form>
	 		</div>
 		</div>
 	</div>
 </body>
 </html>