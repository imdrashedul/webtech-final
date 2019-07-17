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
        <b>Support Tickets</b>
    </div>
    <div class="body">
        <table class="datatable">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Created</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Thane Hooper</td>
                <td>lacus.Etiam.bibendum@sodales.org</td>
                <td><a href="viewsupportticket.php">vehicula risus. Nulla eget metus<a href="viewsupportticket.php"></a></td>
                <td align="center">4 Mar 2019</td>
                <td align="right">Closed</td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Alvin Vang</td>
                <td>et@cubiliaCuraeDonec.com</td>
                <td><a href="viewsupportticket.php">congue. In scelerisque scelerisque dui.</a></td>
                <td align="center">26 Jul 2019</td>
                <td align="right">Open</td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Erich Stevens</td>
                <td>Pellentesque@libero.com</td>
                <td><a href="viewsupportticket.php">eu, placerat eget, venenatis a</a></td>
                <td align="center">21 Oct 2018</td>
                <td align="right">Open</td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Brent Mathis</td>
                <td>eu@Sedauctor.org</td>
                <td><a href="viewsupportticket.php">dignissim pharetra. Nam ac nulla.</a></td>
                <td align="center">28 Oct 2018</td>
                <td align="right">Open</td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Ferdinand Woods</td>
                <td>Quisque@tempusmauriserat.ca</td>
                <td><a href="viewsupportticket.php">Duis risus odio, auctor vitae</a></td>
                <td align="center">9 Aug 2018</td>
                <td align="right">Closed</td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Gavin Ferrell</td>
                <td>ut.nulla.Cras@et.org</td>
                <td><a href="viewsupportticket.php">magna a tortor. Nunc commodo</a></td>
                <td align="center">16 Feb 2019</td>
                <td align="right">Open</td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Joshua Raymond</td>
                <td>Proin@eget.net</td>
                <td><a href="viewsupportticket.php">elit, pretium et, rutrum non</a></td>
                <td align="center">4 Aug 2019</td>
                <td align="right">Closed</td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Zachary Crosby</td>
                <td>In.at.pede@nullaDonec.co.uk</td>
                <td><a href="viewsupportticket.php">Ut semper pretium neque. Morbi</a></td>
                <td align="center">24 Aug 2019</td>
                <td align="right">Open</td>
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

__visualize(array(
	'title' => 'Support Tickets',
	'area' => 'supportticket',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));

disconnectDatabase();
