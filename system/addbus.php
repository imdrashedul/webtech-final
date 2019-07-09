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
			<font face="Verdana"><b>Add New Bus</b></font>
		</td>
		<td width="150px" align="right">
			<a href="managebus.php"><img src="assets/img/cancel_button.png" alt="[+]" title="Cancel"></a>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" colspan="2">
			<table border="0" cellpadding="5" cellspacing="0">
				<tr>
					<td valign="top" align="right">
						<label for="name"><font face="Arial" size="2"><b>Name/Model</b></font></label>
					</td>
					<td valign="top">
						<input type="text" name="name" id="name" placeholder="Enter Bus Name/Model" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" size="24"><br/>
						<?php __errors($errors, 'name') ?>
					</td>
				</tr>
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
						<label for="reg_no"><font face="Arial" size="2"><b>Registration No.</b></font></label>
					</td>
					<td valign="top">
						<input type="text" name="reg_no" id="reg_no" placeholder="Enter full registration number" value="<?php echo isset($_POST['reg_no']) ? htmlspecialchars($_POST['reg_no']) : '' ?>" size="24"><br/>
						<?php __errors($errors, 'reg_no') ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="bus_ac"><font face="Arial" size="2"><b>Bus Class</b></font></label>
					</td>
					<td valign="top">
						<input type="radio" name="bus_type" id="bus_ac" value="Ac"<?php isset($_POST['bus_type']) ? __selected('Ac', $_POST['bus_type'], 'radio') : '' ?>> <label for="bus_ac"><font face="Arial" size="2">Ac</font></label>
						<input type="radio" name="bus_type" id="bus_normal" value="Non-Ac"<?php isset($_POST['bus_type']) ? __selected('Non-Ac', $_POST['bus_type'], 'radio') : '' ?>> <label for="bus_normal"><font face="Arial" size="2">Non-Ac</font></label><br>
						<?php __errors($errors, 'bus_type') ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="seats_col"><font face="Arial" size="2"><b>Seats</b></font></label>
					</td>
					<td valign="top">
						<input type="text" name="seats_col" id="seats_col" placeholder="Column" value="<?php echo isset($_POST['seats_col']) ? htmlspecialchars($_POST['seats_col']) : '' ?>" size="9"> x
						<input type="text" name="seats_row" id="seats_row" placeholder="Row" value="<?php echo isset($_POST['reg_no']) ? htmlspecialchars($_POST['reg_no']) : '' ?>" size="8"><br/>
						<input type="checkbox" name="seats_last_fill" id="seats_last_fill" value="last_row_filled"<?php isset($_POST['seats_last_fill']) ? __selected('last_row_filled', $_POST['seats_last_fill'], 'radio') : '' ?>> <label for="seats_last_fill"><font face="Arial" size="2">Fill Last Row</font></label>
						<?php __errors($errors, 'reg_no') ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="description"><font face="Arial" size="2"><b>Description</b></font></label>
					</td>
					<td valign="top">
						<textarea name="description" rows="4" cols="25"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="submit" value="Add Bus">
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
	'title' => 'BTRS - Add New Bus',
	'area' => 'managebus',
	'data' => $content,
	'user' => $user ? $user['name'] : '',
	'usermail' => $usermail
));
