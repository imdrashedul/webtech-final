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
ob_start();
?>

<table width="100%" border="0" cellspacing="0" cellpadding="10">
	<tr>
		<td bgcolor="#C7CBD1">
			<font face="Verdana"><b>General Settings</b></font>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">
			<table border="0" cellpadding="5" cellspacing="0">
				<tr>
					<td valign="top" align="right">
						<label for="name"><font face="Arial" size="2"><b>Site Name</b></font></label>
					</td>
					<td valign="top">
						<input type="text" name="name" id="name" placeholder="Enter Site Name" size="24">
					</td>
				</tr>
				<tr>
					<td valign="top" align="right">
						<label for="photograph"><font face="Arial" size="2"><b>Site Logo</b></font></label>
					</td>
					<td valign="top">
						<input type="file" name="photograph" id="photograph">
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" name="submit" value="Save">
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
	'title' => 'BTRS - General Settings',
	'area' => 'settings',
	'data' => $content,
	'user' => $user ? $user['name'] : '',
	'usermail' => $usermail
));
