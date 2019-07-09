<?php 
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

require_once 'lib/function.php';

session_start();

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

if(isset($_POST['submit']))
{
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$dobDay = $_POST['dob_day']; 
	$dobMonth = $_POST['dob_month']; 
	$dobYear = $_POST['dob_year']; 
	$gender = isset($_POST['gender']) ? $_POST['gender'] : '';

	//Validation Set Of 'Name' 
	if(empty($name))
	{
		$errors['name'] = 'Cannot be empty';
	}
	else if(strlen($name)<=2)
	{
		$errors['name'] = 'Contains at least two words';
	}
	else if(!verifyCharecter($name))
	{
		$errors['name'] = 'Can contain a-z or A-Z or dot(.) or dash(-)';
	}
	else if(!isset($name[0]) || !ctype_alpha($name[0]))
	{
		$errors['name'] = 'Must start with a letter';
	}

	//Validation Set Of 'Email'
	if(empty($email))
	{
		$errors['email'] = 'Cannot be empty';
	}
	else if(!filter_var(filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL))
	{
		$errors['email'] = 'Must be a valid email address (i.e anything@example.com)';
	}
	else if(verifyEmailAssigned($email))
	{
		$errors['email'] = 'Email is already used. Please provide a new one';
	}

	//Validation Set Of 'Gender'
	if(!isset($_POST['gender']))
	{
		$errors['gender'] = 'At least one of them has to be selected';
	}

	//Validation Set Of 'DOB'
	if(empty($dobDay) || empty($dobMonth) || empty($dobYear))
	{
		$errors['dob'] = 'Cannot be empty';
	}
	else if(!verifyDob($dobDay, $dobMonth, $dobYear))
	{
		$errors['dob'] = 'Must be a valid number (dd: 1-31, mm: 1-12, yyyy: 1900-2019)';
	}

	//Validation Set Of 'Password'
	if(empty($password))
	{
		$errors['password'] = 'Cannot be empty';
	}
	else if(strlen($password)<=4 || strlen($password)>16)
	{
		$errors['password'] = 'Must be 4 to 16 characters long';
	}
	else if(!verifyAlphaNumeric($password))
	{
		$errors['password'] = 'Must be alpha-numeric. Combination of Alphabet and Number';
	}

	//Validation Set Of 'Re-Type Password'
	if(empty($repassword))
	{
		$errors['repassword'] = 'Cannot be empty';
	}
	else if($password!=$repassword)
	{
		$errors['repassword'] = 'Password doesn\'t match';
	}

	if(empty($errors))
	{
		if(registerUser(array(
			$email => array(
				'name' => $name,
				'dob' => $dobYear . '-' . $dobMonth . '-' . $dobDay,
				'gender' => $gender,
				'password' => $password
			)
		))) {
			$_SESSION['register'] = $email;
			header('location: login.php');
			exit;
		}
	}

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Bus Ticket Reservation System - Register</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
	<table align="center" width="353" border="0" bgcolor="#C7CBD1">
		<tr>
			<td>
				<fieldset>
					<legend>
						<img src="assets/img/add_user.png" width="16px" height="16px" alt="[+]"> <b>Register as an User</b>
					</legend>
					<form method="POST">
						<label for="name"><b>Name</b></label><br>
						<input type="text" name="name" id="name" placeholder="Enter your full name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" size="40"> <br/><?php __errors($errors, 'name') ?><hr/>
						<label for="email"><b>Email</b></label><br>
						<input type="email" name="email" id="email" placeholder="Enter your email addresss" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" size="40"> <br/><?php __errors($errors, 'email') ?><hr/>
						<label for="gender_male"><b>Gender</b></label><br>
						<input type="radio" name="gender" id="gender_male" value="Male"<?php isset($_POST['gender']) ? __selected('Male', $_POST['gender'], 'radio') : '' ?>> <label for="gender_male">Male</label>
						<input type="radio" name="gender" id="gender_female" value="Female"<?php isset($_POST['gender']) ? __selected('Female', $_POST['gender'], 'radio') : '' ?>> <label for="gender_female">Female</label>
						<br><?php __errors($errors, 'gender') ?><hr>
						<label for="dob_day"><b>Date of Birth</b></label><br>
						<select name="dob_day" id="dob_day">
							<option value=''>Day</option>
							<?php dmyProvider('day', true, (isset($_POST['dob_day']) ? $_POST['dob_day'] : '')) ?>
						</select>
						<select name="dob_month">
							<option value=''>Month</option>
							<?php dmyProvider('month', true, (isset($_POST['dob_month']) ? $_POST['dob_month'] : '')) ?>
						</select>
						<select name="dob_year">
							<option value=''>Year</option>
							<?php dmyProvider('year', true, (isset($_POST['dob_year']) ? $_POST['dob_year'] : '')) ?>
						</select>
						<br><?php __errors($errors, 'dob') ?><hr>
						<label for="password"><b>Password</b></label><br>
						<input type="password" name="password" id="password" size="40"> <br><?php __errors($errors, 'password') ?><hr>
						<label for="repassword"><b>Re-Type Password</b></label><br>
						<input type="password" name="repassword" id="repassword" size="40"> <br><?php __errors($errors, 'repassword') ?><hr>
						<input type="submit" name="submit" value="Register">
					</form>
					<br>
					<img src="assets/img/alert.png" alt="[+]" width="12px" height="12px"> Already Registered ? <a href="login.php">Please Login Here!!</a>
				</fieldset>
			</td>
		</tr>
	</table>
</body>
</html>