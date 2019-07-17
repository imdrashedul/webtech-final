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
