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
        <table class="datatable">
            <thead>
            <tr >
                <th>Name</th>
                <th>Location</th>
                <th>Company</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr >
                <td>Kallayanpur Counter</td>
                <td>Kallyanpur Foot Over Bridge, Dhaka</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td align="center">Plus Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Gabtoli Counter</td>
                <td>Gabtali Bus Terminal</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td align="center">Common Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr >
                <td>Mohakhali Counter</td>
                <td>Mohakhali Bus Terminal</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td align="center">Common Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr >
                <td>Gazipur Counter</td>
                <td>Gazipur Bypass (Delwar Hossain Market)</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td align="center">Sub Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr >
                <td>Technical More Counter</td>
                <td>Shahnaz CNG Filling Station (west of technical curve)</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td align="center">Sub Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr >
                <td>Savar Counter</td>
                <td>Savar Kacha Bazar</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td align="center">Sub Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr >
                <td>Kallayanpur Counter</td>
                <td>Kallyanpur Foot Over Bridge, Dhaka</td>
                <td>Manik Express</td>
                <td align="center">Plus Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr >
                <td>Gabtoli Counter</td>
                <td>Gabtali Bus Terminal</td>
                <td>Manik Express</td>
                <td align="center">Common Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr >
                <td>Mohakhali Counter</td>
                <td>Mohakhali Bus Terminal</td>
                <td>Manik Express</td>
                <td align="center">Common Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr >
                <td>Gazipur Counter</td>
                <td>Gazipur Bypass (Delwar Hossain Market)</td>
                <td>Manik Express</td>
                <td align="center">Sub Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr >
                <td>Technical More Counter</td>
                <td>Shahnaz CNG Filling Station (west of technical curve)</td>
                <td>Manik Express</td>
                <td align="center">Sub Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr >
                <td>Savar Counter</td>
                <td>Savar Kacha Bazar</td>
                <td>Manik Express</td>
                <td align="center">Sub Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr >
                <td>Kallayanpur Counter</td>
                <td>Kallyanpur Foot Over Bridge, Dhaka</td>
                <td>Hanif Enterprise</td>
                <td align="center">Plus Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr >
                <td>Gabtoli Counter</td>
                <td>Gabtali Bus Terminal</td>
                <td>Hanif Enterprise</td>
                <td align="center">Common Counter</td>
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
	'title' => 'Bus Counters',
	'area' => 'buscounter',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));
disconnectDatabase();

