<?php 
session_start();
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="author" content="Jonathan Ben-Ammi">
 	<title>The Wall Registration</title>
 	<meta name="description" content="A PHP assignment for Coding Dojo">
 	<link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body>
 	<div id="container">
 		<img id="logolg" src="images/logo.png" alt="logo">
 		<div id="registerWhole">
 			<h3>New User Registration:</h3>
	 		<form id="regform" action="process.php" method="post">
		 		<div class="fields">
				<?php if(isset($_SESSION['errors']['Username'])){ ?>
					<p class="warning"><?= $_SESSION['errors']['Username']; ?></p> 
				<?php };?>
				<label for="username">Username:</label>
		 		<input type="text" id="username" placeholder="Username" name="username" />
		 		</div>
		 		<div class="fields">
				<?php if(isset($_SESSION['errors']['First_Name'])){ ?>
					<p class="warning"><?= $_SESSION['errors']['First_Name']; ?></p> 
				<?php };?>
				<label for="first_name">First Name:</label>
		 		<input type="text" placeholder="First Name" name="first_name" />
		 		</div>			 		
		 		<div class="fields">
				<?php if(isset($_SESSION['errors']['Last_Name'])){ ?>
					<p class="warning"><?= $_SESSION['errors']['Last_Name']; ?></p> 
				<?php };?>		 		
		 		<label for="last_name">Last Name:</label>
		 		<input type="text" id="last_name" placeholder="Last Name" name="last_name" />
		 		</div>				 		
		 		<div class="fields">
				<?php if(isset($_SESSION['errors']['Email'])){ ?>
					<p class="warning"><?= $_SESSION['errors']['Email']; ?></p> 
				<?php };?>		 		
		 		<label for="email">E-Mail:</label>
		 		<input type="text" id="email" placeholder="E-Mail Address" name="email" />
		 		</div>	
		 		<div class="fields">
				<?php if(isset($_SESSION['errors']['Password'])){ ?>
					<p class="warning"><?= $_SESSION['errors']['Password']; ?></p> 
				<?php };?>		 		
		 		<label for="password">Password:</label>
		 		<input type="password" id="password" placeholder="must be at lease 8 characters" name="password" />
		 		</div>
		 		<div class="fields">
				<?php if(isset($_SESSION['errors']['ConfirmPass'])){ ?>
					<p class="warning"><?= $_SESSION['errors']['ConfirmPass']; ?></p> 
				<?php };?>		 		
		 		<label for="confirmpass">Confirm Password:</label>
		 		<input type="password" id="confrimpass" placeholder="Re-type password" name="confirmpass" />
		 		</div>
		 		<input type="hidden" name="behavior" value="register" />
		 		<input class="btn" type="submit" value="Register" />
	 		</form>
		</div>
 	</div>
 </body>
 </html>