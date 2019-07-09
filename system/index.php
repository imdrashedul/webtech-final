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
			<b>Dashboard</b>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">
			Wellcome Admin, Manage Everything from here. All Control is Yours
		</td>
	</tr>
</table>

<?php
$content = ob_get_clean();
$usermail = getEmailBySession($sessionCookie);
$user = getUser($usermail);
__visualize(array(
	'title' => 'BTRS - Dashboard',
	'area' => 'index',
	'data' => $content,
	'user' => $user ? $user['name'] : '',
	'usermail' => $usermail
));
