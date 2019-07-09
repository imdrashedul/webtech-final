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
			<font face="Verdana"><b>Add Payment Method</b></font>
		</td>
		<td width="150px" align="right">
			<a href="paymethod.php"><img src="assets/img/cancel_button.png" alt="[+]" title="Cancel"></a>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" colspan="2">
			<table border="0" cellpadding="5" cellspacing="0">
				<tr>
					<td valign="top" align="right">
						<label for="method"><font face="Arial" size="2"><b>Method Name</b></font></label>
					</td>
					<td valign="top">
						<input type="text" name="method" id="method" placeholder="Enter Method Name" value="<?php echo isset($_POST['method']) ? htmlspecialchars($_POST['method']) : '' ?>" size="24"><br/>
						<?php __errors($errors, 'method') ?>
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="gateway"><font face="Arial" size="2"><b>Gateway</b></font></label>
					</td>
					<td valign="top">
						<input type="text" name="gateway" id="gateway" placeholder="Enter Method Gateway" value="<?php echo isset($_POST['gateway']) ? htmlspecialchars($_POST['gateway']) : '' ?>" size="24"><br/>
						<?php __errors($errors, 'gateway') ?>
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
						<input type="submit" name="submit" value="Add Method">
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
	'title' => 'BTRS - Add Payment Method',
	'area' => 'paymethod',
	'data' => $content,
	'user' => $user ? $user['name'] : '',
	'usermail' => $usermail
));
