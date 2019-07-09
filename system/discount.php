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
			<font face="Verdana"><b>Promotional Discount</b></font>
		</td>
		<td width="150px" align="right">
			<a href="adddiscount.php"><img src="assets/img/add_new_button.png" alt="[+]" title="Add New Discount"></a>
		</td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" colspan="2">
			<table width="100%" border="1" cellpadding="5" cellspacing="0">
				<thead>
					<tr bgcolor="#A7BFDE">
						<th><font face="Arial" size="2">Code</font></th>
						<th><font face="Arial" size="2">Discount</font></th>
						<th><font face="Arial" size="2">Max</font></th>
						<th><font face="Arial" size="2">Valid From</font></th>
						<th><font face="Arial" size="2">Valid To</font></th>
						<th><font face="Arial" size="2">Action</font></th>
					</tr>
				</thead>
				<tbody>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">BIJOY71</font></td>
						<td><font face="Arial" size="2">30%</font></td>
						<td align="right"><font face="Arial" size="2">200 BDT</font></td>
						<td align="center"><font face="Arial" size="2">31/01/2019</font></td>
						<td align="center"><font face="Arial" size="2">28/04/2019</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">DOEL54</font></td>
						<td><font face="Arial" size="2">50%</font></td>
						<td align="right"><font face="Arial" size="2">150 BDT</font></td>
						<td align="center"><font face="Arial" size="2">05/02/2019</font></td>
						<td align="center"><font face="Arial" size="2">15/08/2019</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">UTHSASH60</font></td>
						<td><font face="Arial" size="2">70%</font></td>
						<td align="right"><font face="Arial" size="2">100 BDT</font></td>
						<td align="center"><font face="Arial" size="2">10/03/2019</font></td>
						<td align="center"><font face="Arial" size="2">05/07/2019</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">ROMONI43</font></td>
						<td><font face="Arial" size="2">20%</font></td>
						<td align="right"><font face="Arial" size="2">300 BDT</font></td>
						<td align="center"><font face="Arial" size="2">05/02/2019</font></td>
						<td align="center"><font face="Arial" size="2">09/07/2019</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">PADMA11</font></td>
						<td><font face="Arial" size="2">70%</font></td>
						<td align="right"><font face="Arial" size="2">200 BDT</font></td>
						<td align="center"><font face="Arial" size="2">15/06/2019</font></td>
						<td align="center"><font face="Arial" size="2">22/08/2019</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">SHAPLA13</font></td>
						<td><font face="Arial" size="2">45%</font></td>
						<td align="right"><font face="Arial" size="2">300 BDT</font></td>
						<td align="center"><font face="Arial" size="2">19/02/2019</font></td>
						<td align="center"><font face="Arial" size="2">05/08/2019</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">JAGO26</font></td>
						<td><font face="Arial" size="2">35%</font></td>
						<td align="right"><font face="Arial" size="2">250 BDT</font></td>
						<td align="center"><font face="Arial" size="2">15/03/2019</font></td>
						<td align="center"><font face="Arial" size="2">22/04/2019</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">NIRBAS80</font></td>
						<td><font face="Arial" size="2">15%</font></td>
						<td align="right"><font face="Arial" size="2">150 BDT</font></td>
						<td align="center"><font face="Arial" size="2">04/01/2019</font></td>
						<td align="center"><font face="Arial" size="2">04/05/2019</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">ACHOL04</font></td>
						<td><font face="Arial" size="2">60%</font></td>
						<td align="right"><font face="Arial" size="2">400 BDT</font></td>
						<td align="center"><font face="Arial" size="2">03/03/2019</font></td>
						<td align="center"><font face="Arial" size="2">03/04/2019</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">BILASH75</font></td>
						<td><font face="Arial" size="2">30%</font></td>
						<td align="right"><font face="Arial" size="2">200 BDT</font></td>
						<td align="center"><font face="Arial" size="2">04/04/2019</font></td>
						<td align="center"><font face="Arial" size="2">04/05/2019</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">CYBER75</font></td>
						<td><font face="Arial" size="2">10%</font></td>
						<td align="right"><font face="Arial" size="2">200 BDT</font></td>
						<td align="center"><font face="Arial" size="2">11/01/2019</font></td>
						<td align="center"><font face="Arial" size="2">11/04/2019</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">CYCLONE55</font></td>
						<td><font face="Arial" size="2">25%</font></td>
						<td align="right"><font face="Arial" size="2">100 BDT</font></td>
						<td align="center"><font face="Arial" size="2">01/06/2019</font></td>
						<td align="center"><font face="Arial" size="2">01/07/2019</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#D3DFEE">
						<td><font face="Arial" size="2">HUMBA30</font></td>
						<td><font face="Arial" size="2">30%</font></td>
						<td align="right"><font face="Arial" size="2">300 BDT</font></td>
						<td align="center"><font face="Arial" size="2">01/07/2019</font></td>
						<td align="center"><font face="Arial" size="2">01/10/2019</font></td>
						<td align="center">
							<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
							<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
						</td>
					</tr>
					<tr bgcolor="#B7C5D6">
						<td><font face="Arial" size="2">BTRS007</font></td>
						<td><font face="Arial" size="2">70%</font></td>
						<td align="right"><font face="Arial" size="2">250 BDT</font></td>
						<td align="center"><font face="Arial" size="2">01/01/2019</font></td>
						<td align="center"><font face="Arial" size="2">01/07/2019</font></td>
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
	'title' => 'BTRS - Promotional Discount',
	'area' => 'discount',
	'data' => $content,
	'user' => $user ? $user['name'] : '',
	'usermail' => $usermail
));
