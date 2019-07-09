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
			<font face="Verdana"><b>Support Tickets</b></font>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF">
			<table width="100%" border="1" cellpadding="5" cellspacing="0">
				<thead>
					<tr bgcolor="#A7BFDE">
						<th><font face="Arial" size="2">Name</font></th>
						<th><font face="Arial" size="2">Email</font></th>
						<th><font face="Arial" size="2">Subject</font></th>
						<th><font face="Arial" size="2">Created</font></th>
						<th><font face="Arial" size="2">Status</font></th>
						<th><font face="Arial" size="2">Action</font></th>
					</tr>
				</thead>
				<tbody>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Thane Hooper</font></td>
						<td><font face="Arial" size="2">lacus.Etiam.bibendum@sodales.org</font></td>
						<td><a href="viewsupportticket.php"><font face="Arial" size="2">vehicula risus. Nulla eget metus</font><a href="viewsupportticket.php"></a></td>
						<td align="center"><font face="Arial" size="2">4 Mar 2019</font></td>
						<td align="right"><font face="Arial" size="2">Closed</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Alvin Vang</font></td>
						<td><font face="Arial" size="2">et@cubiliaCuraeDonec.com</font></td>
						<td><a href="viewsupportticket.php"><font face="Arial" size="2">congue. In scelerisque scelerisque dui.</font></a></td>
						<td align="center"><font face="Arial" size="2">26 Jul 2019</font></td>
						<td align="right"><font face="Arial" size="2">Open</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Erich Stevens</font></td>
						<td><font face="Arial" size="2">Pellentesque@libero.com</font></td>
						<td><a href="viewsupportticket.php"><font face="Arial" size="2">eu, placerat eget, venenatis a</font></a></td>
						<td align="center"><font face="Arial" size="2">21 Oct 2018</font></td>
						<td align="right"><font face="Arial" size="2">Open</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Brent Mathis</font></td>
						<td><font face="Arial" size="2">eu@Sedauctor.org</font></td>
						<td><a href="viewsupportticket.php"><font face="Arial" size="2">dignissim pharetra. Nam ac nulla.</font></a></td>
						<td align="center"><font face="Arial" size="2">28 Oct 2018</font></td>
						<td align="right"><font face="Arial" size="2">Open</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Ferdinand Woods</font></td>
						<td><font face="Arial" size="2">Quisque@tempusmauriserat.ca</font></td>
						<td><a href="viewsupportticket.php"><font face="Arial" size="2">Duis risus odio, auctor vitae</font></a></td>
						<td align="center"><font face="Arial" size="2">9 Aug 2018</font></td>
						<td align="right"><font face="Arial" size="2">Closed</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Gavin Ferrell</font></td>
						<td><font face="Arial" size="2">ut.nulla.Cras@et.org</font></td>
						<td><a href="viewsupportticket.php"><font face="Arial" size="2">magna a tortor. Nunc commodo</font></a></td>
						<td align="center"><font face="Arial" size="2">16 Feb 2019</font></td>
						<td align="right"><font face="Arial" size="2">Open</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Joshua Raymond</font></td>
						<td><font face="Arial" size="2">Proin@eget.net</font></td>
						<td><a href="viewsupportticket.php"><font face="Arial" size="2">elit, pretium et, rutrum non</font></a></td>
						<td align="center"><font face="Arial" size="2">4 Aug 2019</font></td>
						<td align="right"><font face="Arial" size="2">Closed</font></td>
						<td align="center"> 
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Zachary Crosby</font></td>
						<td><font face="Arial" size="2">In.at.pede@nullaDonec.co.uk</font></td>
						<td><a href="viewsupportticket.php"><font face="Arial" size="2">Ut semper pretium neque. Morbi</font></a></td>
						<td align="center"><font face="Arial" size="2">24 Aug 2019</font></td>
						<td align="right"><font face="Arial" size="2">Open</font></td>
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
	'title' => 'BTRS - Support Tickets',
	'area' => 'supportticket',
	'data' => $content,
	'user' => $user ? $user['name'] : '',
	'usermail' => $usermail
));
