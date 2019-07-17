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

$user = getUserBySession($token);
$validate = isset($user['id']) ? isValidUser($user['id']) : false;

if($validate!=true)
{
    header('location: index.php');
    die();
}

ob_start();
?>
    <div class="block">
        <div class="header">
            <b>Manage Booked Tickets</b>
        </div>
        <div class="body">
            <table width="100%" border="1" cellpadding="5" cellspacing="0">
                <thead>
                <tr bgcolor="#A7BFDE">
                    <th><font face="Arial" size="2">Passenger</font></th>
                    <th><font face="Arial" size="2">Email</font></th>
                    <th><font face="Arial" size="2">Schedule</font></th>
                    <th><font face="Arial" size="2">Seats</font></th>
                    <th><font face="Arial" size="2">Payment</font></th>
                    <th><font face="Arial" size="2">Action</font></th>
                </tr>
                </thead>
                <tbody>
                <tr bgcolor="#D3DFEE">
                    <td><font face="Arial" size="2">Thane Hooper</font></td>
                    <td><font face="Arial" size="2">lacus.Etiam.bibendum@sodales.org</font></td>
                    <td><font face="Arial" size="2">Scania [Nabil Paribahan] [DHA-12501] [Dhaka-Bogura] [07/07/2019 10:00 AM]</font></td>
                    <td align="center"><font face="Arial" size="2">[A1] [B1] [C1]</font></td>
                    <td align="right"><font face="Arial" size="2"> [bKash] [ABC-1A5KL] 3000 BDT</font></td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr bgcolor="#B7C5D6">
                    <td><font face="Arial" size="2">Alvin Vang</font></td>
                    <td><font face="Arial" size="2">et@cubiliaCuraeDonec.com</font></td>
                    <td><font face="Arial" size="2">Hyundai Universe - 2018 [Manik Express] [DHA-57203] [Dhaka-Bogura] [07/07/2019 12:00 AM]</font></td>
                    <td align="center"><font face="Arial" size="2">[A5]</font></td>
                    <td align="right"><font face="Arial" size="2">[Unpaid] 1000 BDT</font></td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr bgcolor="#D3DFEE">
                    <td><font face="Arial" size="2">Erich Stevens</font></td>
                    <td><font face="Arial" size="2">Pellentesque@libero.com</font></td>
                    <td><font face="Arial" size="2">AK1J Super Plus - Hino [Nabil Paribahan] [DHA-64808] [Dhaka-Bogura] [07/07/2019 12:00 AM]</font></td>
                    <td align="center"><font face="Arial" size="2">[A1] [B1]</font></td>
                    <td align="right"><font face="Arial" size="2">[Rocket] [ABC-G15DM] 700 BDT</font></td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr bgcolor="#B7C5D6">
                    <td><font face="Arial" size="2">Brent Mathis</font></td>
                    <td><font face="Arial" size="2">eu@Sedauctor.org</font></td>
                    <td><font face="Arial" size="2">Hyundai Universe - 2018 [Manik Express] [DHA-57203] [Dhaka-Bogura] [07/07/2019 12:00 AM]</font></td>
                    <td align="center"><font face="Arial" size="2">[A7] [B7] [C7]</font></td>
                    <td align="right"><font face="Arial" size="2">[Rocket] [ABC-9TV1D] 3000 BDT</font></td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr bgcolor="#D3DFEE">
                    <td><font face="Arial" size="2">Ferdinand Woods</font></td>
                    <td><font face="Arial" size="2">Quisque@tempusmauriserat.ca</font></td>
                    <td><font face="Arial" size="2">Scania [Nabil Paribahan] [DHA-12501] [Dhaka-Bogura] [07/07/2019 10:00 AM]</font></td>
                    <td align="center"><font face="Arial" size="2">[A2] [B2] [C2]</font></td>
                    <td align="right"><font face="Arial" size="2">[bKash] [ABC-5B2GL] 3000 BDT</font></td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr bgcolor="#B7C5D6">
                    <td><font face="Arial" size="2">Gavin Ferrell</font></td>
                    <td><font face="Arial" size="2">ut.nulla.Cras@et.org</font></td>
                    <td><font face="Arial" size="2">AK1J Super Plus - Hino [Nabil Paribahan] [DHA-64808] [Dhaka-Bogura] [07/07/2019 12:00 AM]</font></td>
                    <td align="center"><font face="Arial" size="2">[C4] [D4]</font></td>
                    <td align="right"><font face="Arial" size="2">[unpaid] 700 BDT</font></td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr bgcolor="#D3DFEE">
                    <td><font face="Arial" size="2">Joshua Raymond</font></td>
                    <td><font face="Arial" size="2">Proin@eget.net</font></td>
                    <td><font face="Arial" size="2">AK1J Super Plus - Hino [Nabil Paribahan] [DHA-64808] [Dhaka-Bogura] [07/07/2019 12:00 AM]</font></td>
                    <td align="center"><font face="Arial" size="2">[A6] [B6]</font></td>
                    <td align="right"><font face="Arial" size="2">[bKash] [ABC-88KZ1] 700 BDT </font></td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr bgcolor="#B7C5D6">
                    <td><font face="Arial" size="2">Zachary Crosby</font></td>
                    <td><font face="Arial" size="2">In.at.pede@nullaDonec.co.uk</font></td>
                    <td><font face="Arial" size="2">Hyundai Universe - 2018 [Manik Express] [DHA-57203] [Dhaka-Bogura] [07/07/2019 12:00 AM]</font></td>
                    <td align="center"><font face="Arial" size="2">[A1] [B1] [C1]</font></td>
                    <td align="right"><font face="Arial" size="2">[bKash] [ABC-7KO1P] 3000 BDT</font></td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr bgcolor="#D3DFEE">
                    <td><font face="Arial" size="2">Samuel Alston</font></td>
                    <td><font face="Arial" size="2">consectetuer@apurus.net</font></td>
                    <td><font face="Arial" size="2">Scania [Nabil Paribahan] [DHA-12501] [Dhaka-Bogura] [07/07/2019 10:00 AM]</font></td>
                    <td align="center"><font face="Arial" size="2">[A3] [B3] [C3]</font></td>
                    <td align="right"><font face="Arial" size="2">[unpaid] 3000 BDT</font></td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php
$content = ob_get_clean();

__visualize(array(
	'title' => 'Manage Tickets',
	'area' => 'tickets',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));

disconnectDatabase();
