<?php 
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

require_once 'lib/function.php';

connectDatabase();

// Check For Authorization Positive

if(!($token = getSessionCookie()) || !verifyLogin($token, true))
{
    header('location: login.php');
    die();
}

ob_start();
?>

<table width="100%" border="0" cellspacing="0" cellpadding="10">
	<tr bgcolor="#C7CBD1">
		<td>
			<font face="Verdana"><b>Bus Managers</b></font>
		</td>
		<td width="150px" align="right">
			<a href="addbusmanager.php"><img src="assets/img/add_new_button.png" alt="[+]" title="Add New Bus Manager"></a>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" colspan="2">
			<table width="100%" border="1" cellpadding="5" cellspacing="0">
				<thead>
					<tr bgcolor="#A7BFDE">
						<th><font face="Arial" size="2">Name</font></th>
						<th><font face="Arial" size="2">Email</font></th>
						<th><font face="Arial" size="2">Company</font></th>
						<th><font face="Arial" size="2">Register Date</font></th>
						<th><font face="Arial" size="2">Total Busses</font></th>
						<th><font face="Arial" size="2">Action</font></th>
					</tr>
				</thead>
				<tbody>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Thane Hooper</font></td>
						<td><font face="Arial" size="2">lacus.Etiam.bibendum@sodales.org</font></td>
						<td><font face="Arial" size="2">Arcu PC</font></td>
						<td align="center"><font face="Arial" size="2">4 Mar 2019</font></td>
						<td align="right"><font face="Arial" size="2">80</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Alvin Vang</font></td>
						<td><font face="Arial" size="2">et@cubiliaCuraeDonec.com</font></td>
						<td><font face="Arial" size="2">Nullam Feugiat Placerat PC</font></td>
						<td align="center"><font face="Arial" size="2">26 Jul 2019</font></td>
						<td align="right"><font face="Arial" size="2">93</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Erich Stevens</font></td>
						<td><font face="Arial" size="2">Pellentesque@libero.com</font></td>
						<td><font face="Arial" size="2">Orci Quis Lectus LLC</font></td>
						<td align="center"><font face="Arial" size="2">21 Oct 2018</font></td>
						<td align="right"><font face="Arial" size="2">72</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Brent Mathis</font></td>
						<td><font face="Arial" size="2">eu@Sedauctor.org</font></td>
						<td><font face="Arial" size="2">Cum Sociis Natoque Corp.</font></td>
						<td align="center"><font face="Arial" size="2">28 Oct 2018</font></td>
						<td align="right"><font face="Arial" size="2">84</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Ferdinand Woods</font></td>
						<td><font face="Arial" size="2">Quisque@tempusmauriserat.ca</font></td>
						<td><font face="Arial" size="2">Primis In Faucibus Limited</font></td>
						<td align="center"><font face="Arial" size="2">9 Aug 2018</font></td>
						<td align="right"><font face="Arial" size="2">84</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Gavin Ferrell</font></td>
						<td><font face="Arial" size="2">ut.nulla.Cras@et.org</font></td>
						<td><font face="Arial" size="2">Tristique Inc.</font></td>
						<td align="center"><font face="Arial" size="2">16 Feb 2019</font></td>
						<td align="right"><font face="Arial" size="2">67</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Joshua Raymond</font></td>
						<td><font face="Arial" size="2">Proin@eget.net</font></td>
						<td><font face="Arial" size="2">Cras Vulputate LLP</font></td>
						<td align="center"><font face="Arial" size="2">4 Aug 2019</font></td>
						<td align="right"><font face="Arial" size="2">83</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Zachary Crosby</font></td>
						<td><font face="Arial" size="2">In.at.pede@nullaDonec.co.uk</font></td>
						<td><font face="Arial" size="2">Vitae Posuere Industries</font></td>
						<td align="center"><font face="Arial" size="2">24 Aug 2019</font></td>
						<td align="right"><font face="Arial" size="2">95</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Samuel Alston</font></td>
						<td><font face="Arial" size="2">consectetuer@apurus.net</font></td>
						<td><font face="Arial" size="2">Dictum Ultricies Limited</font></td>
						<td align="center"><font face="Arial" size="2">16 Aug 2018</font></td>
						<td align="right"><font face="Arial" size="2">85</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Basil Noble</font></td>
						<td><font face="Arial" size="2">elit.erat@accumsanneque.net</font></td>
						<td><font face="Arial" size="2">Egestas Blandit Nam Incorporated</font></td>
						<td align="center"><font face="Arial" size="2">9 Aug 2018</font></td>
						<td align="right"><font face="Arial" size="2">100</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Odysseus Macdonald</font></td>
						<td><font face="Arial" size="2">arcu@erosnectellus.net</font></td>
						<td><font face="Arial" size="2">Nunc Quis Inc.</font></td>
						<td align="center"><font face="Arial" size="2">8 Sep 2018</font></td>
						<td align="right"><font face="Arial" size="2">52</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Zeus Tyson</font></td>
						<td><font face="Arial" size="2">Sed.malesuada@nisiCum.com</font></td>
						<td><font face="Arial" size="2">Sem Pellentesque Associates</font></td>
						<td align="center"><font face="Arial" size="2">9 Feb 2019</font></td>
						<td align="right"><font face="Arial" size="2">76</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Jerry Vaughn</font></td>
						<td><font face="Arial" size="2">nulla@massaMauris.net</font></td>
						<td><font face="Arial" size="2">Sed PC</font></td>
						<td align="center"><font face="Arial" size="2">20 Sep 2018</font></td>
						<td align="right"><font face="Arial" size="2">62</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Declan Walter</font></td>
						<td><font face="Arial" size="2">tellus@sem.ca</font></td>
						<td><font face="Arial" size="2">Lacus Aliquam Rutrum Incorporated</font></td>
						<td align="center"><font face="Arial" size="2">30 Oct 2019</font></td>
						<td align="right"><font face="Arial" size="2">70</font></td>
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
$user = getUserBySession($token);
disconnectDatabase();
__visualize(array(
	'title' => 'Bus Managers',
	'area' => 'busmanager',
	'data' => $content,
    'fname' => '',
    'lname' => '',
    'email' => isset($user['email']) ? $user['email'] : '',
));
