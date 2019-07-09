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
$usermail = getEmailBySession($sessionCookie);
$user = getUser($usermail);
ob_start();
?>

<table width="100%" border="0" cellspacing="0" cellpadding="10">
	<tr bgcolor="#C7CBD1">
		<td>
			<font face="Verdana"><b>Basic Profile</b></font>
		</td>
		<td width="150px" align="right">
			<a href="updateprofile.php"><img src="assets/img/update_button.png" alt="[+]" title="Update Profile"></a>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" colspan="2">
			<table width="100%">
				<tr>
					<td width="170px" valign="top">
						<img src="assets/img/demo_profile_pic_large.png" width="150px" height="150px">
					</td>
					<td valign="top">
						<font face="Arial" size="2"><b>Personal Information</b></font><hr>
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td><font face="Arial" size="2"><b>Name</b></font></td>
								<td width="15px" align="center">:</td>
								<td><font face="Arial" size="2"><?= $user ? htmlspecialchars($user['name']) : ''?></font></td>
							</tr>
							<tr>
								<td><font face="Arial" size="2"><b>Gender</b></font></td>
								<td width="15px" align="center">:</td>
								<td><font face="Arial" size="2"><?= $user ? htmlspecialchars($user['gender']) : ''?></font></td>
							</tr>
							<tr>
								<td><font face="Arial" size="2"><b>Date of Birth</b></font></td>
								<td width="15px" align="center">:</td>
								<td><font face="Arial" size="2"><?= $user ? __formatDate($user['dob'], 'j F Y', 'Y-m-d') : ''?></font></td>
							</tr>
						</table>
						<br>
						<font face="Arial" size="2"><b>Login Information</b></font><hr>
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td><font face="Arial" size="2"><b>Email Address</b></font></td>
								<td width="15px" align="center">:</td>
								<td><font face="Arial" size="2"><?= htmlspecialchars($usermail) ?></font></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?php
$content = ob_get_clean();
__visualize(array(
	'title' => 'BTRS - Admin Profile',
	'area' => 'profile',
	'data' => $content,
	'user' => $user ? $user['name'] : '',
	'usermail' => $usermail
));
