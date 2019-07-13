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
			<font face="Verdana"><b>Manage Bus</b></font>
		</td>
		<td width="150px" align="right">
			<a href="addbus.php"><img src="assets/img/add_new_button.png" alt="[+]" title="Add New Bus"></a>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" colspan="2">
			<table width="100%" border="1" cellpadding="5" cellspacing="0">
				<thead>
					<tr bgcolor="#A7BFDE">
						<th><font face="Arial" size="2">Name/Model</font></th>
						<th><font face="Arial" size="2">Company</font></th>
						<th><font face="Arial" size="2">Registration No</font></th>
						<th><font face="Arial" size="2">Type</font></th>
						<th><font face="Arial" size="2">Seats</font></th>
						<th><font face="Arial" size="2">Action</font></th>
					</tr>
				</thead>
				<tbody>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Hyundai Universe - 2019</font></td>
						<td><font face="Arial" size="2">Manik Express</font></td>
						<td><font face="Arial" size="2">DHA-58109</font></td>
						<td align="center"><font face="Arial" size="2">Ac</font></td>
						<td align="right"><font face="Arial" size="2">28</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Hyundai Universe - 2018</font></td>
						<td><font face="Arial" size="2">Manik Express</font></td>
						<td><font face="Arial" size="2">DHA-57203</font></td>
						<td align="center"><font face="Arial" size="2">Ac</font></td>
						<td align="right"><font face="Arial" size="2">28</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Scania</font></td>
						<td><font face="Arial" size="2">Nabil Paribahan</font></td>
						<td><font face="Arial" size="2">DHA-12501</font></td>
						<td align="center"><font face="Arial" size="2">Ac</font></td>
						<td align="right"><font face="Arial" size="2">34</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">AK1J Super Plus - Hino</font></td>
						<td><font face="Arial" size="2">Nabil Paribahan</font></td>
						<td><font face="Arial" size="2">DHA-64808</font></td>
						<td align="center"><font face="Arial" size="2">Non-Ac</font></td>
						<td align="right"><font face="Arial" size="2">40</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">AK1J - Hino</font></td>
						<td><font face="Arial" size="2">Dipjol Enterprise</font></td>
						<td><font face="Arial" size="2">DHA-14101</font></td>
						<td align="center"><font face="Arial" size="2">Non-Ac</font></td>
						<td align="right"><font face="Arial" size="2">40</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Hyundai Universe</font></td>
						<td><font face="Arial" size="2">S.R Travels (Pvt) Ltd</font></td>
						<td><font face="Arial" size="2">DHA-53725</font></td>
						<td align="center"><font face="Arial" size="2">Ac</font></td>
						<td align="right"><font face="Arial" size="2">28</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">AK1J - Hino</font></td>
						<td><font face="Arial" size="2">S.R Travels (Pvt) Ltd</font></td>
						<td><font face="Arial" size="2">DHA-35781</font></td>
						<td align="center"><font face="Arial" size="2">Non-Ac</font></td>
						<td align="right"><font face="Arial" size="2">40</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Hino RN</font></td>
						<td><font face="Arial" size="2">Hanif Enterprise</font></td>
						<td><font face="Arial" size="2">DHA-15881</font></td>
						<td align="center"><font face="Arial" size="2">Ac</font></td>
						<td align="right"><font face="Arial" size="2">28</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">RM-2</font></td>
						<td><font face="Arial" size="2">Manik Express</font></td>
						<td><font face="Arial" size="2">DHA-25545</font></td>
						<td align="center"><font face="Arial" size="2">Ac</font></td>
						<td align="right"><font face="Arial" size="2">28</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">Hino RN</font></td>
						<td><font face="Arial" size="2">Alhamra Paribahan</font></td>
						<td><font face="Arial" size="2">DHA-37713</font></td>
						<td align="center"><font face="Arial" size="2">Ac</font></td>
						<td align="right"><font face="Arial" size="2">31</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">Scania</font></td>
						<td><font face="Arial" size="2">Agomony Express</font></td>
						<td><font face="Arial" size="2">DHA-91040</font></td>
						<td align="center"><font face="Arial" size="2">Ac</font></td>
						<td align="right"><font face="Arial" size="2">28</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">ISUZU</font></td>
						<td><font face="Arial" size="2">S.R Travels (Pvt) Ltd</font></td>
						<td><font face="Arial" size="2">DHA-73001</font></td>
						<td align="center"><font face="Arial" size="2">Non-Ac</font></td>
						<td align="right"><font face="Arial" size="2">40</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">VOLVO</font></td>
						<td><font face="Arial" size="2">Hanif Enterprise</font></td>
						<td><font face="Arial" size="2">DHA-35107</font></td>
						<td align="center"><font face="Arial" size="2">Ac</font></td>
						<td align="right"><font face="Arial" size="2">33</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">RM-2</font></td>
						<td><font face="Arial" size="2">Manik Express</font></td>
						<td><font face="Arial" size="2">DHA-17403</font></td>
						<td align="center"><font face="Arial" size="2">Ac</font></td>
						<td align="right"><font face="Arial" size="2">28</font></td>
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
	'title' => 'Manage Bus',
	'area' => 'managebus',
	'data' => $content,
    'fname' => '',
    'lname' => '',
    'email' => isset($user['email']) ? $user['email'] : '',
));
