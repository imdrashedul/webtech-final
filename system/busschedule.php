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
        <b>Bus Schedules List</b>
        <a href="addbusschedule.php" class="btn target blue" title="Add New Schedule"><span>Add New</span></a>
    </div>
    <div class="body">
        <table class="datatable">
            <thead>
            <tr>
                <th>Bus</th>
                <th>Company</th>
                <th>Routes</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Price Per Seat</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Hyundai Universe - 2019 [DHA-58109]</td>
                <td>Manik Express</td>
                <td>Dhaka - Bogura</td>
                <td>07/07/2019 10:00 AM</td>
                <td>07/07/2019 04:00 PM</td>
                <td align="right">1000 BDT</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#B7C5D6">
                <td>Hyundai Universe - 2018 [DHA-57203]</td>
                <td>Manik Express</td>
                <td>Dhaka - Bogura</td>
                <td>07/07/2019 12:00 AM</td>
                <td>07/07/2019 06:00 PM</td>
                <td align="right">1000 BDT</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Scania [DHA-12501]</td>
                <td>Nabil Paribahan</td>
                <td>Dhaka - Bogura</td>
                <td>07/07/2019 10:00 AM</td>
                <td>07/07/2019 04:00 PM</td>
                <td align="right">1000 BDT</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#B7C5D6">
                <td>AK1J Super Plus - Hino [DHA-64808]</td>
                <td>Nabil Paribahan</td>
                <td>Dhaka - Bogura</td>
                <td>07/07/2019 12:00 AM</td>
                <td>07/07/2019 06:00 PM</td>
                <td align="right">350 BDT</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
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

__visualize(array(
	'title' => 'Bus Schedules',
	'area' => 'busschedule',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));

disconnectDatabase();
