<?php 
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

require_once 'lib/function.php';

// Check For Authorization Positive

if(!($sessionCookie = getSessionCookie()) || !verifyLogin($sessionCookie, true))
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
			<font face="Verdana"><b>Add Counter Staff</b></font>
		</td>
		<td width="150px" align="right">
			<a href="counterstaff.php"><img src="assets/img/cancel_button.png" alt="[+]" title="Cancel"></a>
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
						<label for="marital_status"><font face="Arial" size="2"><b>Marital Status</b></font></label>
					</td>
					<td valign="top">
						<select name="marital_status" id="marital_status">
							<option value="">Select</option>
							<option value="Unmarried"<?php __selected("Unmarried", (isset($_POST['marital_status']) ? $_POST['marital_status'] : '')) ?>>Unmarried</option>
							<option value="Married"<?php __selected("Married", (isset($_POST['marital_status']) ? $_POST['marital_status'] : '')) ?>>Married</option>
							<option value="Divorced"<?php __selected("Divorced", (isset($_POST['marital_status']) ? $_POST['marital_status'] : '')) ?>>Divorced</option>
							<option value="Widowed"<?php __selected("Widowed", (isset($_POST['marital_status']) ? $_POST['marital_status'] : '')) ?>>Widowed</option>
						</select><br>
						<?php __errors($errors, 'marital_status') ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="nid_passport"><font face="Arial" size="2"><b>NID / Passport</b></font></label>
					</td>
					<td valign="top">
						<input type="text" name="nid_passport" id="nid_passport" placeholder="Enter NID or Passport No" value="<?php echo isset($_POST['nid_passport']) ? htmlspecialchars($_POST['nid_passport']) : '' ?>" size="24"><br/>
						<?php __errors($errors, 'nid_passport') ?>
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
			<font face="Arial" size="2"><b>Contact Information</b></font><hr>
			<table border="0" cellpadding="5" cellspacing="0">
				<tr>
					<td valign="top" align="right">
						<label for="mobile"><font face="Arial" size="2"><b>Mobile Number</b></font></label>
					</td>
					<td valign="top">
						<input type="text" name="mobile" id="mobile" placeholder="(+88) 0XXXX-XXXXXX" value="<?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : '' ?>" size="24"><br/>
						<?php __errors($errors, 'mobile') ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="street"><font face="Arial" size="2"><b>Street Address</b></font></label>
					</td>
					<td valign="top">
						<input type="text" name="street" id="street" placeholder="Enter Street Address" value="<?php echo isset($_POST['street']) ? htmlspecialchars($_POST['street']) : '' ?>" size="24"><br/>
						<?php __errors($errors, 'street') ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="city"><font face="Arial" size="2"><b>City</b></font></label>
					</td>
					<td valign="top">
						<input type="text" name="city" id="city" placeholder="Enter City Name" value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '' ?>" size="24"><br/>
						<?php __errors($errors, 'city') ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="country"><font face="Arial" size="2"><b>Country</b></font></label>
					</td>
					<td valign="top">
						<select name="country" id="country">
							<option value="">Select</option>
							<option value="Bangladesh"<?php __selected("Bangladesh", (isset($_POST['country']) ? $_POST['country'] : '')) ?>>Bangladesh</option>
						</select><br>
						<?php __errors($errors, 'country') ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="zip"><font face="Arial" size="2"><b>Zip Code</b></font></label>
					</td>
					<td valign="top">
						<input type="text" name="zip" id="zip" placeholder="Enter Zip/Postal Code" value="<?php echo isset($_POST['zip']) ? htmlspecialchars($_POST['zip']) : '' ?>" size="24"><br/>
						<?php __errors($errors, 'zip') ?>
					</td>
				</tr>
			</table>
			<br>
			<font face="Arial" size="2"><b>Official Information</b></font><hr>
			<table border="0" cellpadding="5" cellspacing="0">
				<tr>
					<td valign="top" align="right">
						<label for="bus_manager"><font face="Arial" size="2"><b>Bus Manager</b></font></label>
					</td>
					<td valign="top">
						<select name="bus_manager" id="bus_manager">
							<option value="">Select</option>
							<option value="1"<?php __selected("1", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Thane Hooper</option>
							<option value="2"<?php __selected("2", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Alvin Vang</option>
							<option value="3"<?php __selected("3", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Erich Stevens</option>
							<option value="4"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Brent Mathis</option>
							<option value="5"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Ferdinand Woods</option>
							<option value="6"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Gavin Ferrell</option>
							<option value="7"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Joshua Raymond</option>
							<option value="8"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Zachary Crosby</option>
							<option value="9"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Samuel Alston</option>
							<option value="10"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Basil Noble</option>
						</select><br>
						<?php __errors($errors, 'bus_manager') ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="bus_counter"><font face="Arial" size="2"><b>Counter</b></font></label>
					</td>
					<td valign="top">
						<select name="bus_counter" id="bus_counter">
							<option value="">Select</option>
							<option value="">Kallayanpur Counter</option>
							<option value="">Gabtoli Counter</option>
							<option value="">Mohakhali Counter</option>
							<option value="">Gazipur Counter</option>
							<option value="">Technical More Counter</option>
							<option value="">Savar Counter</option>
						</select><br>
						<?php __errors($errors, 'bus_counter') ?>
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
						<input type="submit" name="submit" value="Add Staff">
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php
$content = ob_get_clean();
$usermail = getEmailBySession($sessionCookie);
$user = getUser($usermail);
__visualize(array(
	'title' => 'Add Counter Staff',
	'area' => 'counterstaff',
    'navigate' => array(array('counterstaff.php', 'Counter Staffs')),
	'data' => $content,
	'user' => $user ? $user['name'] : '',
	'usermail' => $usermail
));
