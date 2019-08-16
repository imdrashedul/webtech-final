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
            <table class="datatable">
                <thead>
                <tr>
                    <th>Passenger</th>
                    <th>Email</th>
                    <th>Schedule</th>
                    <th>Seats</th>
                    <th>Payment</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Thane Hooper</td>
                    <td>lacus.Etiam.bibendum@sodales.org</td>
                    <td>Scania [Nabil Paribahan] [DHA-12501] [Dhaka-Bogura] [07/07/2019 10:00 AM]</td>
                    <td align="center">[A1] [B1] [C1]</td>
                    <td align="right"> [bKash] [ABC-1A5KL] 3000 BDT</td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr>
                    <td>Alvin Vang</td>
                    <td>et@cubiliaCuraeDonec.com</td>
                    <td>Hyundai Universe - 2018 [Manik Express] [DHA-57203] [Dhaka-Bogura] [07/07/2019 12:00 AM]</td>
                    <td align="center">[A5]</td>
                    <td align="right">[Unpaid] 1000 BDT</td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr>
                    <td>Erich Stevens</td>
                    <td>Pellentesque@libero.com</td>
                    <td>AK1J Super Plus - Hino [Nabil Paribahan] [DHA-64808] [Dhaka-Bogura] [07/07/2019 12:00 AM]</td>
                    <td align="center">[A1] [B1]</td>
                    <td align="right">[Rocket] [ABC-G15DM] 700 BDT</td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr>
                    <td>Brent Mathis</td>
                    <td>eu@Sedauctor.org</td>
                    <td>Hyundai Universe - 2018 [Manik Express] [DHA-57203] [Dhaka-Bogura] [07/07/2019 12:00 AM]</td>
                    <td align="center">[A7] [B7] [C7]</td>
                    <td align="right">[Rocket] [ABC-9TV1D] 3000 BDT</td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr>
                    <td>Ferdinand Woods</td>
                    <td>Quisque@tempusmauriserat.ca</td>
                    <td>Scania [Nabil Paribahan] [DHA-12501] [Dhaka-Bogura] [07/07/2019 10:00 AM]</td>
                    <td align="center">[A2] [B2] [C2]</td>
                    <td align="right">[bKash] [ABC-5B2GL] 3000 BDT</td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr>
                    <td>Gavin Ferrell</td>
                    <td>ut.nulla.Cras@et.org</td>
                    <td>AK1J Super Plus - Hino [Nabil Paribahan] [DHA-64808] [Dhaka-Bogura] [07/07/2019 12:00 AM]</td>
                    <td align="center">[C4] [D4]</td>
                    <td align="right">[unpaid] 700 BDT</td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr>
                    <td>Joshua Raymond</td>
                    <td>Proin@eget.net</td>
                    <td>AK1J Super Plus - Hino [Nabil Paribahan] [DHA-64808] [Dhaka-Bogura] [07/07/2019 12:00 AM]</td>
                    <td align="center">[A6] [B6]</td>
                    <td align="right">[bKash] [ABC-88KZ1] 700 BDT </td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr>
                    <td>Zachary Crosby</td>
                    <td>In.at.pede@nullaDonec.co.uk</td>
                    <td>Hyundai Universe - 2018 [Manik Express] [DHA-57203] [Dhaka-Bogura] [07/07/2019 12:00 AM]</td>
                    <td align="center">[A1] [B1] [C1]</td>
                    <td align="right">[bKash] [ABC-7KO1P] 3000 BDT</td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                <tr>
                    <td>Samuel Alston</td>
                    <td>consectetuer@apurus.net</td>
                    <td>Scania [Nabil Paribahan] [DHA-12501] [Dhaka-Bogura] [07/07/2019 10:00 AM]</td>
                    <td align="center">[A3] [B3] [C3]</td>
                    <td align="right">[unpaid] 3000 BDT</td>
                    <td align="center">
                        <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="grid">
                <div class="row">
                    <div class="column-4 ">
                    <span class="pagination">
                        Showing 1 to 10 of 100 entries
                    </span>
                    </div>
                    <div class="column-8 text-right">
                        <div class="pagination">
                            <a href="#">Previous</a>
                            <a href="#">1</a>
                            <a class="active" href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                            <a href="javascript:void(0)" class="disabled">Next</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$content = ob_get_clean();

__visualize_backend(array(
	'title' => 'Manage Tickets',
	'area' => 'tickets',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));

disconnectDatabase();
