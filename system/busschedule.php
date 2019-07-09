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
			<font face="Verdana"><b>Bus Schedules</b></font>
		</td>
		<td width="150px" align="right">
			<a href="addbusschedule.php"><img src="assets/img/add_new_button.png" alt="[+]" title="Add New Schedule"></a>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" colspan="2">
			<table width="100%" border="1" cellpadding="5" cellspacing="0">
				<thead>
					<tr bgcolor="#A7BFDE">
						<th><font face="Arial" size="2">Bus</font></th>
						<th><font face="Arial" size="2">Company</font></th>
						<th><font face="Arial" size="2">Routes</font></th>
						<th><font face="Arial" size="2">Departure</font></th>
						<th><font face="Arial" size="2">Arrival</font></th>
						<th><font face="Arial" size="2">Price Per Seat</font></th>
						<th><font face="Arial" size="2">Action</font></th>
					</tr>
				</thead>
				<tbody>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Hyundai Universe - 2019 [DHA-58109]</font></td>
						<td><font face="Arial" size="2">Manik Express</font></td>
						<td><font face="Arial" size="2">Dhaka - Bogura</font></td>
						<td><font face="Arial" size="2">07/07/2019 10:00 AM</font></td>
						<td><font face="Arial" size="2">07/07/2019 04:00 PM</font></td>
						<td align="right"><font face="Arial" size="2">1000 BDT</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Hyundai Universe - 2018 [DHA-57203]</font></td>
						<td><font face="Arial" size="2">Manik Express</font></td>
						<td><font face="Arial" size="2">Dhaka - Bogura</font></td>
						<td><font face="Arial" size="2">07/07/2019 12:00 AM</font></td>
						<td><font face="Arial" size="2">07/07/2019 06:00 PM</font></td>
						<td align="right"><font face="Arial" size="2">1000 BDT</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Scania [DHA-12501]</font></td>
						<td><font face="Arial" size="2">Nabil Paribahan</font></td>
						<td><font face="Arial" size="2">Dhaka - Bogura</font></td>
						<td><font face="Arial" size="2">07/07/2019 10:00 AM</font></td>
						<td><font face="Arial" size="2">07/07/2019 04:00 PM</font></td>
						<td align="right"><font face="Arial" size="2">1000 BDT</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">AK1J Super Plus - Hino [DHA-64808]</font></td>
						<td><font face="Arial" size="2">Nabil Paribahan</font></td>
						<td><font face="Arial" size="2">Dhaka - Bogura</font></td>
						<td><font face="Arial" size="2">07/07/2019 12:00 AM</font></td>
						<td><font face="Arial" size="2">07/07/2019 06:00 PM</font></td>
						<td align="right"><font face="Arial" size="2">350 BDT</font></td>
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
	'title' => 'BTRS - Bus Schedules',
	'area' => 'busschedule',
	'data' => $content,
	'user' => $user ? $user['name'] : '',
	'usermail' => $usermail
));
