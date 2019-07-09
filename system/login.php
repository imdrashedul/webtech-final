<?php 
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */
require_once 'lib/function.php';

session_start();

$regEmail = '';

$errors = array();

// Check For Authorization Negative
if($sessionCookie = getSessionCookie())
{
	if(verifyLogin($sessionCookie, false))
	{
		header('location: index.php');
		die();
	}
}

if(isset($_SESSION['register']))
{
	$regEmail = $_SESSION['register'];
	unset($_SESSION['register']);
}

if(isset($_POST['submit']))
{
	$email = trim($_POST['email']);
	$password = $_POST['password'];
	$user = false;

	//Validation Set Of 'Email'
	if(empty($email))
	{
		$errors['email'] = 'Cannot be empty';
	}
	else if(!filter_var(filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL))
	{
		$errors['email'] = 'Must be a valid email address (i.e anything@example.com)';
	}
	else if(($user = getUser($email))==false)
	{
		$errors['email'] = 'Email doesn\'t match' ;
	}

	//Validation Set Of 'Password'
	if(empty($password))
	{
		$errors['password'] = 'Cannot be empty';
	}
	elseif ($user!=false && !verifyPassword($password, $user)) 
	{
		$errors['password'] = 'Password doesn\'t match';
	}

	if(empty($errors))
	{
		$session = getSessionKey();
		if(pushSession($session, $email))
		{
			setSessionCookie($session);
			header('location: index.php');
			exit;
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bus Ticket Reservation System - Login</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<div class="logreg">
    <h2 class="logtitle" align="center">Login to System</h2>
    <div class="container">
        <form method="POST">
            <div class="inputset<?php __errors($errors, 'email', true) ?>">
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" placeholder="Enter your email addresss" value="<?= htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : (!empty($regEmail) ? $regEmail : '')) ?>"> <br/><?php __errors($errors, 'email') ?>
            </div>
            <div class="inputset<?php __errors($errors, 'password', true) ?>">
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password"> <br><?php __errors($errors, 'password') ?>
            </div>
            <input type="submit" name="submit" value="Login">
            <a href="javascript:void(0)" class="forgot-password">Forgot Password?</a>
        </form>
    </div>
    <div class="log-footer">
        Don't have an Account? <a href="register.php">Create an Account</a>
    </div>
</div>
<!--	<table align="center" width="353" border="0" bgcolor="#C7CBD1">-->
<!--		<tr>-->
<!--			<td>-->
<!--				<fieldset>-->
<!--					<legend>-->
<!--						<img src="assets/img/lock_color.png" width="16px" height="16px" alt="[+]"> <b>Login Here</b>-->
<!--					</legend>-->
<!--					-->
<!--					<br>-->
<!--					--><?php //if(!empty($regEmail)) : ?>
<!--					<img src="assets/img/ok.gif" alt="[+]"> <font color="darkgreen">You have Registred Successfully. Please Login Here</font>-->
<!--					--><?php //else: ?>
<!--					Not Registered Yet? <img src="assets/img/point.gif" alt="[+]"> <a href="register.php">Register Now!!</a>-->
<!--					--><?php //endif; ?>
<!--				</fieldset>-->
<!--			</td>-->
<!--		</tr>-->
<!--	</table>-->
</body>
</html>