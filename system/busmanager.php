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
        <b>Bus Managers List</b>
        <a href="addbusmanager.php" class="btn target blue" title="Add New Bus Manager"><span>Add New</span></a>
    </div>
    <div class="body">
        <table class="datatable">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Register Date</th>
                <th>Total Busses</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Thane Hooper</td>
                <td>lacus.Etiam.bibendum@sodales.org</td>
                <td>Arcu PC</td>
                <td align="center">4 Mar 2019</td>
                <td align="right">80</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Alvin Vang</td>
                <td>et@cubiliaCuraeDonec.com</td>
                <td>Nullam Feugiat Placerat PC</td>
                <td align="center">26 Jul 2019</td>
                <td align="right">93</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Erich Stevens</td>
                <td>Pellentesque@libero.com</td>
                <td>Orci Quis Lectus LLC</td>
                <td align="center">21 Oct 2018</td>
                <td align="right">72</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Brent Mathis</td>
                <td>eu@Sedauctor.org</td>
                <td>Cum Sociis Natoque Corp.</td>
                <td align="center">28 Oct 2018</td>
                <td align="right">84</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Ferdinand Woods</td>
                <td>Quisque@tempusmauriserat.ca</td>
                <td>Primis In Faucibus Limited</td>
                <td align="center">9 Aug 2018</td>
                <td align="right">84</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Gavin Ferrell</td>
                <td>ut.nulla.Cras@et.org</td>
                <td>Tristique Inc.</td>
                <td align="center">16 Feb 2019</td>
                <td align="right">67</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Joshua Raymond</td>
                <td>Proin@eget.net</td>
                <td>Cras Vulputate LLP</td>
                <td align="center">4 Aug 2019</td>
                <td align="right">83</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Zachary Crosby</td>
                <td>In.at.pede@nullaDonec.co.uk</td>
                <td>Vitae Posuere Industries</td>
                <td align="center">24 Aug 2019</td>
                <td align="right">95</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Samuel Alston</td>
                <td>consectetuer@apurus.net</td>
                <td>Dictum Ultricies Limited</td>
                <td align="center">16 Aug 2018</td>
                <td align="right">85</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Basil Noble</td>
                <td>elit.erat@accumsanneque.net</td>
                <td>Egestas Blandit Nam Incorporated</td>
                <td align="center">9 Aug 2018</td>
                <td align="right">100</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Odysseus Macdonald</td>
                <td>arcu@erosnectellus.net</td>
                <td>Nunc Quis Inc.</td>
                <td align="center">8 Sep 2018</td>
                <td align="right">52</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Zeus Tyson</td>
                <td>Sed.malesuada@nisiCum.com</td>
                <td>Sem Pellentesque Associates</td>
                <td align="center">9 Feb 2019</td>
                <td align="right">76</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Jerry Vaughn</td>
                <td>nulla@massaMauris.net</td>
                <td>Sed PC</td>
                <td align="center">20 Sep 2018</td>
                <td align="right">62</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Declan Walter</td>
                <td>tellus@sem.ca</td>
                <td>Lacus Aliquam Rutrum Incorporated</td>
                <td align="center">30 Oct 2019</td>
                <td align="right">70</td>
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
	'title' => 'Bus Managers',
	'area' => 'busmanager',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));

disconnectDatabase();
