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
			<font face="Verdana"><b>Transaction</b></font>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">
			<table width="100%" border="1" cellpadding="5" cellspacing="0">
				<thead>
					<tr bgcolor="#A7BFDE">
						<th><font face="Arial" size="2">Transaction ID</font></th>
						<th><font face="Arial" size="2">Reservation ID</font></th>
						<th><font face="Arial" size="2">Method</font></th>
						<th><font face="Arial" size="2">Deatis</font></th>
						<th><font face="Arial" size="2">Amount</font></th>
						<th><font face="Arial" size="2">Action</font></th>
					</tr>
				</thead>
				<tbody>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">ABC-1A5KL</font></td>
						<td><font face="Arial" size="2">ABC-1A5KL</font></td>
						<td><font face="Arial" size="2">bKash</font></td>
						<td align="center"><font face="Arial" size="2">12KFHJ1224112</font></td>
						<td align="right"><font face="Arial" size="2"> 3000 BDT</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">ABC-G15DM</font></td>
						<td><font face="Arial" size="2">ABC-G15DM</font></td>
						<td><font face="Arial" size="2">bKash</font></td>
						<td align="center"><font face="Arial" size="2">12KF2JLK24112</font></td>
						<td align="right"><font face="Arial" size="2"> 700 BDT</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">ABC-9TV1D</font></td>
						<td><font face="Arial" size="2">ABC-9TV1D</font></td>
						<td><font face="Arial" size="2">bKash</font></td>
						<td align="center"><font face="Arial" size="2">12KFHJ1224112</font></td>
						<td align="right"><font face="Arial" size="2"> 3000 BDT</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">ABC-5B2GL</font></td>
						<td><font face="Arial" size="2">ABC-5B2GL</font></td>
						<td><font face="Arial" size="2">bKash</font></td>
						<td align="center"><font face="Arial" size="2">12KFHJ1224112</font></td>
						<td align="right"><font face="Arial" size="2"> 3000 BDT</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">ABC-1A5KL</font></td>
						<td><font face="Arial" size="2">ABC-1A5KL</font></td>
						<td><font face="Arial" size="2">bKash</font></td>
						<td align="center"><font face="Arial" size="2">12KFHJ1224112</font></td>
						<td align="right"><font face="Arial" size="2"> 3000 BDT</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">ABC-1A5KL</font></td>
						<td><font face="Arial" size="2">ABC-1A5KL</font></td>
						<td><font face="Arial" size="2">bKash</font></td>
						<td align="center"><font face="Arial" size="2">12KFHJ1224112</font></td>
						<td align="right"><font face="Arial" size="2"> 3000 BDT</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">ABC-1A5KL</font></td>
						<td><font face="Arial" size="2">ABC-1A5KL</font></td>
						<td><font face="Arial" size="2">bKash</font></td>
						<td align="center"><font face="Arial" size="2">12KFHJ1224112</font></td>
						<td align="right"><font face="Arial" size="2"> 3000 BDT</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">ABC-1A5KL</font></td>
						<td><font face="Arial" size="2">ABC-1A5KL</font></td>
						<td><font face="Arial" size="2">bKash</font></td>
						<td align="center"><font face="Arial" size="2">12KFHJ1224112</font></td>
						<td align="right"><font face="Arial" size="2"> 3000 BDT</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">ABC-1A5KL</font></td>
						<td><font face="Arial" size="2">ABC-1A5KL</font></td>
						<td><font face="Arial" size="2">bKash</font></td>
						<td align="center"><font face="Arial" size="2">12KFHJ1224112</font></td>
						<td align="right"><font face="Arial" size="2"> 3000 BDT</font></td>
						<td align="center"> 
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
	'title' => 'BTRS - Transaction',
	'area' => 'transaction',
	'data' => $content,
	'user' => $user ? $user['name'] : '',
	'usermail' => $usermail
));
