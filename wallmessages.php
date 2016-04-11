<?php 
session_start();
require_once('connection.php');
$query = "SELECT messages.id, messages.message, messages.created_on, users.username FROM messages JOIN users ON users.id = messages.users_id ORDER BY created_on desc";
$messages = fetch_all($query);
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
 		<div id="header">
	 		<div id="logosm">
	 		</div>
	 		<!-- loged in username php will go between h5 tags -->
	 		<h5><?= $_SESSION['loggedin']['username']; ?></h5>
	 		<form id="logoutForm" action="process.php" method="post">
	 			<input type="hidden" value="logout" name="behavior" />
	 			<input class="btn" type="submit" value="Logout" />
	 		</form>
 		</div>
 		<div id="messagesTop">
 			<form action="process.php" method="post">
	 			<input type="hidden" name='behavior' value="message" />
 				<textarea id="messageBox" name="message" placeholder="What's on your mind?"></textarea>
 				<input class="btn" type="submit" value="Create New Message" />
 			</form>
 		</div>	
 		<div id="messagesMain">
				<?php 	
	 				for ($i = 0; $i < count($messages); $i++){ 
					$d = strtotime($messages[$i]["created_on"]); ?>
	 		<div class="message">
				 			<h3><?= $messages[$i]['username'];?></h3><p><?= date('g:ia F jS, Y', $d); ?></p>
				 			<div><?= $messages[$i]['message'];?></div>
	 			<form action="process.php" method="post">
	 				<input type="hidden" value="messagetocomment" name="behavior" />	
	 				<input type="hidden" value="<?= $messages[$i]['id']; ?>" name="id" />
	 				<input class="btn" type="submit" value="Comments" />
	 			</form>
	 		</div>	
	 			<?php };
	 			?>
 		</div>
 	</div>
 </body>
 </html>