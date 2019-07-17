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
        <b>Manage Bus Counters</b>
        <a href="addbuscounter.php" class="btn target blue" title="Add New Bus Manager"><span>Add New</span></a>
    </div>
    <div class="body">
        <table width="100%" border="1" cellpadding="5" cellspacing="0">
            <thead>
            <tr bgcolor="#A7BFDE">
                <th><font face="Arial" size="2">Name</font></th>
                <th><font face="Arial" size="2">Location</font></th>
                <th><font face="Arial" size="2">Company</font></th>
                <th><font face="Arial" size="2">Type</font></th>
                <th><font face="Arial" size="2">Action</font></th>
            </tr>
            </thead>
            <tbody>
            <tr bgcolor="#D3DFEE">
                <td><font face="Arial" size="2">Kallayanpur Counter</font></td>
                <td><font face="Arial" size="2">Kallyanpur Foot Over Bridge, Dhaka</font></td>
                <td><font face="Arial" size="2">S.R Travels (Pvt) Ltd</font></td>
                <td align="center"><font face="Arial" size="2">Plus Counter</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#B7C5D6">
                <td><font face="Arial" size="2">Gabtoli Counter</font></td>
                <td><font face="Arial" size="2">Gabtali Bus Terminal</font></td>
                <td><font face="Arial" size="2">S.R Travels (Pvt) Ltd</font></td>
                <td align="center"><font face="Arial" size="2">Common Counter</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#D3DFEE">
                <td><font face="Arial" size="2">Mohakhali Counter</font></td>
                <td><font face="Arial" size="2">Mohakhali Bus Terminal</font></td>
                <td><font face="Arial" size="2">S.R Travels (Pvt) Ltd</font></td>
                <td align="center"><font face="Arial" size="2">Common Counter</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#B7C5D6">
                <td><font face="Arial" size="2">Gazipur Counter</font></td>
                <td><font face="Arial" size="2">Gazipur Bypass (Delwar Hossain Market)</font></td>
                <td><font face="Arial" size="2">S.R Travels (Pvt) Ltd</font></td>
                <td align="center"><font face="Arial" size="2">Sub Counter</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#D3DFEE">
                <td><font face="Arial" size="2">Technical More Counter</font></td>
                <td><font face="Arial" size="2">Shahnaz CNG Filling Station (west of technical curve)</font></td>
                <td><font face="Arial" size="2">S.R Travels (Pvt) Ltd</font></td>
                <td align="center"><font face="Arial" size="2">Sub Counter</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#B7C5D6">
                <td><font face="Arial" size="2">Savar Counter</font></td>
                <td><font face="Arial" size="2">Savar Kacha Bazar</font></td>
                <td><font face="Arial" size="2">S.R Travels (Pvt) Ltd</font></td>
                <td align="center"><font face="Arial" size="2">Sub Counter</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#D3DFEE">
                <td><font face="Arial" size="2">Kallayanpur Counter</font></td>
                <td><font face="Arial" size="2">Kallyanpur Foot Over Bridge, Dhaka</font></td>
                <td><font face="Arial" size="2">Manik Express</font></td>
                <td align="center"><font face="Arial" size="2">Plus Counter</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#B7C5D6">
                <td><font face="Arial" size="2">Gabtoli Counter</font></td>
                <td><font face="Arial" size="2">Gabtali Bus Terminal</font></td>
                <td><font face="Arial" size="2">Manik Express</font></td>
                <td align="center"><font face="Arial" size="2">Common Counter</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#D3DFEE">
                <td><font face="Arial" size="2">Mohakhali Counter</font></td>
                <td><font face="Arial" size="2">Mohakhali Bus Terminal</font></td>
                <td><font face="Arial" size="2">Manik Express</font></td>
                <td align="center"><font face="Arial" size="2">Common Counter</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#B7C5D6">
                <td><font face="Arial" size="2">Gazipur Counter</font></td>
                <td><font face="Arial" size="2">Gazipur Bypass (Delwar Hossain Market)</font></td>
                <td><font face="Arial" size="2">Manik Express</font></td>
                <td align="center"><font face="Arial" size="2">Sub Counter</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#D3DFEE">
                <td><font face="Arial" size="2">Technical More Counter</font></td>
                <td><font face="Arial" size="2">Shahnaz CNG Filling Station (west of technical curve)</font></td>
                <td><font face="Arial" size="2">Manik Express</font></td>
                <td align="center"><font face="Arial" size="2">Sub Counter</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#B7C5D6">
                <td><font face="Arial" size="2">Savar Counter</font></td>
                <td><font face="Arial" size="2">Savar Kacha Bazar</font></td>
                <td><font face="Arial" size="2">Manik Express</font></td>
                <td align="center"><font face="Arial" size="2">Sub Counter</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#D3DFEE">
                <td><font face="Arial" size="2">Kallayanpur Counter</font></td>
                <td><font face="Arial" size="2">Kallyanpur Foot Over Bridge, Dhaka</font></td>
                <td><font face="Arial" size="2">Hanif Enterprise</font></td>
                <td align="center"><font face="Arial" size="2">Plus Counter</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr bgcolor="#B7C5D6">
                <td><font face="Arial" size="2">Gabtoli Counter</font></td>
                <td><font face="Arial" size="2">Gabtali Bus Terminal</font></td>
                <td><font face="Arial" size="2">Hanif Enterprise</font></td>
                <td align="center"><font face="Arial" size="2">Common Counter</font></td>
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
	'title' => 'Bus Counters',
	'area' => 'buscounter',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));
disconnectDatabase();

