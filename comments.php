<?php 
session_start();
require_once('connection.php');
$query = "select comments.id, comments.comment, comments.created_on, users.username FROM comments JOIN users ON users.id = comments.users_id WHERE comments.messages_id = '".$_SESSION['author']['id']."'";
$comments = fetch_all($query);
$d = strtotime($_SESSION['author']['created_on']);
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
	 		<form id="bktomsg" action="wallmessages.php" method="post">
	 			<input class="btn" type="submit" value="Message Wall" />
	 		</form>
 		</div>
 		<div id="messagesMain">
 	 		<div class="message">
	 		<!-- username from messages posted will go between h3 tags -->
	 			<h3><?= $_SESSION['author']['username'];?></h3><p><?= date('g:ia F jS, Y', $d); ?></p>
	 			<div><?= $_SESSION['author']['message'];?></div>
			<!-- message comments will come from comments query -->
			</div>
			<?php for ($j = 0; $j < count($comments); $j++){ 
				$da = strtotime($comments[$j]["created_on"]); ?>
				<div class="comment">
					<h3><?= $comments[$j]['username']; ?></h3><p><?= date('g:ia F jS, Y', $da); ?></p>
					<div><?= $comments[$j]['comment']; ?></div>
				</div>
				<?php 
			}; ?>
 		</div>
 		<div id="commentsBtm">
 			<form action="process.php" method="post">
	 			<input type="hidden" name='behavior' value="comment" />
 				<textarea id="messageBox" name="comment" placeholder="What's on your mind?"></textarea>
 				<input class="btn" type="submit" value="Comment on message" />
 			</form>
 		</div>
 	</div>
 </body>
 </html>
