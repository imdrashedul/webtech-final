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
        <b>Manage Counter Staffs</b>
        <a href="addcounterstaff.php" class="btn target blue" title="Add New Counter Staff"><span>Add New</span></a>
    </div>
    <div class="body">
        <table class="datatable">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Hire Date</th>
                <th>Company</th>
                <th>Counter</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Thane Hooper</td>
                <td>lacus.Etiam.bibendum@sodales.org</td>
                <td align="center">4 Mar 2019</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td>Kallayanpur Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Alvin Vang</td>
                <td>et@cubiliaCuraeDonec.com</td>
                <td align="center">26 Jul 2019</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td>Gabtoli Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Erich Stevens</td>
                <td>Pellentesque@libero.com</td>
                <td align="center">21 Oct 2018</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td>Mohakhali Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Brent Mathis</td>
                <td>eu@Sedauctor.org</td>
                <td align="center">28 Oct 2018</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td>Technical More Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Ferdinand Woods</td>
                <td>Quisque@tempusmauriserat.ca</td>
                <td align="center">9 Aug 2018</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td>Gazipur Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Gavin Ferrell</td>
                <td>ut.nulla.Cras@et.org</td>
                <td align="center">16 Feb 2019</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td>Savar Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Joshua Raymond</td>
                <td>Proin@eget.net</td>
                <td align="center">4 Aug 2019</td>
                <td>Manik Express</td>
                <td>Kallayanpur Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Zachary Crosby</td>
                <td>In.at.pede@nullaDonec.co.uk</td>
                <td align="center">24 Aug 2019</td>
                <td>Manik Express</td>
                <td>Gabtoli Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Samuel Alston</td>
                <td>consectetuer@apurus.net</td>
                <td align="center">16 Aug 2018</td>
                <td>Manik Express</td>
                <td>Mohakhali Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Basil Noble</td>
                <td>elit.erat@accumsanneque.net</td>
                <td align="center">9 Aug 2018</td>
                <td>Manik Express</td>
                <td>Gazipur Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Odysseus Macdonald</td>
                <td>arcu@erosnectellus.net</td>
                <td align="center">8 Sep 2018</td>
                <td>Manik Express</td>
                <td>Technical More Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Zeus Tyson</td>
                <td>Sed.malesuada@nisiCum.com</td>
                <td align="center">9 Feb 2019</td>
                <td>Manik Express</td>
                <td>Savar Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Jerry Vaughn</td>
                <td>nulla@massaMauris.net</td>
                <td align="center">20 Sep 2018</td>
                <td>Hanif Enterprise</td>
                <td>Kallayanpur Counter</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Declan Walter</td>
                <td>tellus@sem.ca</td>
                <td align="center">30 Oct 2019</td>
                <td>Hanif Enterprise</td>
                <td>Gabtoli Counter</td>
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
	'title' => 'Counter Staffs',
	'area' => 'counterstaff',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));

disconnectDatabase();