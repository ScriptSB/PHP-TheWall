<?php 
session_start();
require_once('connection.php');

// This variable regulates the registering functionality
$register = function ($data){
$username = escape_this_string($_POST['username']);
$firstname = escape_this_string($_POST['first_name']);
$lastname = escape_this_string($_POST['last_name']);
$email = escape_this_string($_POST['email']);
$password = escape_this_string($_POST['password']);
$salt = bin2hex(openssl_random_pseudo_bytes(22));
$encrypted_password = md5($password . '' . $salt);
$query = "insert into users (username, first_name, last_name, email, password, salt, created_on, updated_on) 
 values ('".$username."', '".$firstname."', '".$lastname."', '".$email."', '".$encrypted_password."', '".$salt."', NOW(), NOW())";
// $query2 = "select * from users";
$query2 = "SELECT users.email, users.id, users.username FROM users WHERE users.email = '".$_POST['email']."'";
$users = fetch_record($query2);
$errors = array();
if(empty($_POST['username']))
	{
	$errors['Username'] = "Username cannot be blank";
	}		
if(empty($_POST['first_name']))
	{
	$errors['First_Name'] = "First name cannot be blank";
	}
if(empty($_POST['last_name']))
	{
	$errors['Last_Name'] = "Last name cannot be blank";
	}
if(strlen($_POST['password']) < 8)
	{
		$errors['Password'] = "Password must be a minimum of 8 charachters";
	}
if($_POST['password'] != $_POST['confirmpass'])
	{
	$errors['ConfirmPass'] = "Does not match information entered in Password, please try again.";
	}
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
		if($users){
		$errors['Email'] = "E-Mail Address already registerd.";
		}
		else {
		$errors['Email'] = "Please use a valid E-mail Address";
		}
	}
if(count($errors) > 0){
	$_SESSION['errors'] = $errors;
	header('location: register.php');
	exit();
}
else {
 	run_mysql_query($query); // runs a sql query.
	$user = fetch_record($query2);
			if($user){
			$_SESSION['loggedin'] = array('username' => $user['username'], 'id' => $user['id']);
			unset($_SESSION['errors']);
			header('Location: wallmessages.php');
			exit();
		}
	}
};
// This variable regulates the login functionality
$login = function ($data){
$username = escape_this_string($_POST['username']);
$password = escape_this_string($_POST['password']);
$user_query = "SELECT * FROM users WHERE users.username = '".$username."'";
$user = fetch_record($user_query);
if(!empty($user))
{
$encrypted_password = md5($password . '' . $user['salt']);
if($user['password'] == $encrypted_password)
	{
	$_SESSION['loggedin'] = array('username' => $user['username'], 'id' => $user['id']);
	unset($_SESSION['errors']);
	header('Location: wallmessages.php');
	exit();	
	}
else
	{
	unset($_SESSION['errors']);
	$_SESSION['errors']['password'] = "Password does not match registered information";
	header('Location: login.php');
	exit();	
	} 
	}
	else
	{
	unset($_SESSION['errors']);
	$_SESSION['errors']['username'] = "Username mistyped or is not registered";
	header('Location: login.php');
	exit();	
	}
};
// This variable regulates the message posting functionality
$message = function ($data){
$messages = escape_this_string($_POST['message']);
$query = "insert INTO messages(message, created_on, updated_on, users_id)
VALUES('".$messages."', now(), now(), '".$_SESSION['loggedin']['id']."')";
 	
 	run_mysql_query($query);
 	header('Location: wallmessages.php');
 	exit();
};
// This variable sets the message variable information on the comments pages
$message_comment = function ($data){
$id = escape_this_string($_POST['id']);
$query = "SELECT messages.id, messages.message, messages.created_on, users.username FROM messages JOIN users ON users.id = messages.users_id WHERE messages.id = '".$id."'";
$message = fetch_record($query);
$_SESSION['author'] = array(
	'username' => $message['username'],
	'message' => $message['message'],
	'created_on' => $message['created_on'],
	'id' => $message['id']
	);
 	header('Location: comments.php');
 	exit();
};
// This variable regulates the comment posting functionality
$comment = function ($data){
$comments = escape_this_string($_POST['comment']);
$query = "insert INTO comments(comment, created_on, updated_on, messages_id, users_id)
VALUES('".$comments."', now(), now(), '".$_SESSION['author']['id']."', '".$_SESSION['loggedin']['id']."')";
 	run_mysql_query($query);
   	header('Location: comments.php');
 	exit();
};
// This variable regulates the logout function 
$logout = function ($data){
	session_destroy();
	header('Location: login.php');
	exit();
};
$action_catcher = [
	'register' => $register,
	'message' => $message,
	'comment' => $comment,
	'messagetocomment' => $message_comment,
	'login' => $login,
	'logout' => $logout
];
$action_catcher[$_POST['behavior']]($_POST);
 ?>