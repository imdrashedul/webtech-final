<?php 
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

require_once 'lib/function.php';

connectDatabase();
$regEmail = '';

$errors = array();

// Check For Authorization Negative
if($token = getSessionCookie())
{
	if(verifyLogin($token, false))
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
	$user = null;

	//Validation Set Of 'Email'
	if(empty($email))
	{
		$errors['email'] = 'Cannot be empty';
	}
	else if(!filter_var(filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL))
	{
		$errors['email'] = 'Must be a valid email address (i.e anything@example.com)';
	}
	else if( !($user = getUserByEmail($email)) || !isset($user['id']) )
	{
		$errors['email'] = 'Email doesn\'t match' ;
	}

	//Validation Set Of 'Password'
	if(empty($password))
	{
		$errors['password'] = 'Cannot be empty';
	}
	elseif (!$user || !verifyPassword($password, $user))
	{
		$errors['password'] = 'Password doesn\'t match';
	}

	if(empty($errors))
	{
		$token = getSessionToken();
		if(pushSession($token, $user['id']))
		{
			setSessionCookie($token);
			header('location: index.php');
			exit;
		}
	}
}
disconnectDatabase();
?>
<!DOCTYPE html>
<html>
<head>
	<title>BTRS - Login</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="shortcut icon" href="assets/img/fav.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="login">
        <h2 class="logtitle" align="center">Login to System</h2>
        <div class="container">
            <?php if(!empty($regEmail)) : ?>
                <img src="assets/img/ok.gif" alt="[+]"> <font color="darkgreen">You have Registred Successfully. Please Login Here</font>
            <?php endif; ?>
            <form method="POST">
                <gr>
                <div class="inputset<?php __errors($errors, 'email', true) ?>">
                    <label for="email">Email</label><br>
                    <input type="email" name="email" id="email" placeholder="Enter your email addresss" value="<?= htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : (!empty($regEmail) ? $regEmail : '')) ?>"><br/>
                    <?php __errors($errors, 'email') ?>
                </div>
                <div class="inputset<?php __errors($errors, 'password', true) ?>">
                    <label for="password">Password</label><br>
                    <input type="password" name="password" id="password"><br>
                    <?php __errors($errors, 'password') ?>
                </div>
                <input type="submit" name="submit" value="Login">
                <a href="javascript:void(0)" class="forgot-password">Forgot Password?</a>
            </form>
        </div>
        <div class="log-footer">
            Want to join as Company? <a href="register.php">Create an Account</a>
        </div>
    </div>
</body>
</html>