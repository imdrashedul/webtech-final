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
	<tr bgcolor="#C7CBD1">
		<td>
			<font face="Verdana"><b>Payment Methods</b></font>
		</td>
		<td width="150px" align="right">
			<a href="addpaymethod.php"><img src="assets/img/add_new_button.png" alt="[+]" title="Add New Method"></a>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" colspan="2">
			<table width="100%" border="1" cellpadding="5" cellspacing="0">
				<thead>
					<tr bgcolor="#A7BFDE">
						<th><font face="Arial" size="2">Method</font></th>
						<th><font face="Arial" size="2">Gateway</font></th>
						<th><font face="Arial" size="2">Status</font></th>
						<th><font face="Arial" size="2">Action</font></th>
					</tr>
				</thead>
				<tbody>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">bKash</font></td>
						<td><font face="Arial" size="2">https://www.bkash.com</font></td>
						<td><font face="Arial" size="2">Active</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Rocket</font></td>
						<td><font face="Arial" size="2">https://www.dutchbanglabank.com/rocket</font></td>
						<td><font face="Arial" size="2">Active</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Bank Transfer</font></td>
						<td><font face="Arial" size="2">N/A</font></td>
						<td><font face="Arial" size="2">Suspend</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
</table>

<?php
$content = ob_get_clean();
$usermail = getEmailBySession($sessionCookie);
$user = getUser($usermail);
__visualize(array(
	'title' => 'BTRS - Payment Methods',
	'area' => 'paymethod',
	'data' => $content,
	'user' => $user ? $user['name'] : '',
	'usermail' => $usermail
));
