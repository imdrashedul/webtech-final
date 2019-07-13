<?php 
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

require_once 'lib/function.php';

connectDatabase();

// Check For Authorization Positive

if(!($token = getSessionCookie()) || !verifyLogin($token, true))
{
    header('location: login.php');
    die();
}

$errors = array();

ob_start();
?>
<table width="100%" border="0" cellspacing="0" cellpadding="10">
	<tr bgcolor="#C7CBD1">
		<td>
			<font face="Verdana"><b>Update Profile</b></font>
		</td>
		<td width="150px" align="right">
			<a href="profile.php"><img src="assets/img/cancel_button.png" alt="[+]" title="Cancel"></a>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" colspan="2">
			<font face="Arial" size="2"><b>Personal Information</b></font><hr>
			<table border="0" cellpadding="5" cellspacing="0">
				<tr>
					<td valign="top" align="right">
						<label for="name"><font face="Arial" size="2"><b>Name</b></font></label>
					</td>
					<td valign="top">
						<input type="text" name="name" id="name" placeholder="Enter full name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" size="24"><br/>
						<?php __errors($errors, 'name') ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="gender_male"><font face="Arial" size="2"><b>Gender</b></font></label>
					</td>
					<td valign="top">
						<input type="radio" name="gender" id="gender_male" value="Male"<?php isset($_POST['gender']) ? __selected('Male', $_POST['gender'], 'radio') : '' ?>> <label for="gender_male"><font face="Arial" size="2">Male</font></label>
						<input type="radio" name="gender" id="gender_female" value="Female"<?php isset($_POST['gender']) ? __selected('Female', $_POST['gender'], 'radio') : '' ?>> <label for="gender_female"><font face="Arial" size="2">Female</font></label><br>
						<?php __errors($errors, 'gender') ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="dob_day"><font face="Arial" size="2"><b>Date of Birth</b></font></label>
					</td>
					<td valign="top">
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
						<br><?php __errors($errors, 'dob') ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="photograph"><font face="Arial" size="2"><b>Photograph</b></font></label>
					</td>
					<td valign="top">
						<input type="file" name="photograph" id="photograph">
					</td>
				</tr>	
			</table>
			<br>
			<font face="Arial" size="2"><b>Login Information</b></font><hr>
			<table border="0" cellpadding="5" cellspacing="0">
				<tr>
					<td valign="top" align="right">
						<label for="email"><font face="Arial" size="2"><b>Email Address</b></font></label>
					</td>
					<td valign="top">
						<input type="email" name="email" id="email" placeholder="Enter email address" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" size="24"><br/>
						<?php __errors($errors, 'email') ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="password"><font face="Arial" size="2"><b>Password</b></font></label>
					</td>
					<td valign="top">
						<input type="password" name="password" id="password" size="24"><br/>
						<?php __errors($errors, 'password') ?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="submit" value="Update">
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php
$content = ob_get_clean();
$user = getUserBySession($token);
disconnectDatabase();
__visualize(array(
	'title' => 'Update Profile',
	'area' => 'profile',
	'data' => $content,
	'navigate' => array(array('profile.php','Profile')),
    'fname' => '',
    'lname' => '',
    'email' => isset($user['email']) ? $user['email'] : '',
));
