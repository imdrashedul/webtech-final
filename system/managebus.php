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
        <b>Lis of All Buses</b>
        <a href="addbus.php" class="btn target blue" title="Add New Bus"><span>Add New</span></a>
    </div>
    <div class="body">
        <table class="datatable">
            <thead>
            <tr>
                <th>Name/Model</th>
                <th>Company</th>
                <th>Registration No</th>
                <th>Type</th>
                <th>Seats</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Hyundai Universe - 2019</td>
                <td>Manik Express</td>
                <td>DHA-58109</td>
                <td align="center">Ac</td>
                <td align="right">28</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Hyundai Universe - 2018</td>
                <td>Manik Express</td>
                <td>DHA-57203</td>
                <td align="center">Ac</td>
                <td align="right">28</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Scania</td>
                <td>Nabil Paribahan</td>
                <td>DHA-12501</td>
                <td align="center">Ac</td>
                <td align="right">34</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>AK1J Super Plus - Hino</td>
                <td>Nabil Paribahan</td>
                <td>DHA-64808</td>
                <td align="center">Non-Ac</td>
                <td align="right">40</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>AK1J - Hino</td>
                <td>Dipjol Enterprise</td>
                <td>DHA-14101</td>
                <td align="center">Non-Ac</td>
                <td align="right">40</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Hyundai Universe</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td>DHA-53725</td>
                <td align="center">Ac</td>
                <td align="right">28</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>AK1J - Hino</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td>DHA-35781</td>
                <td align="center">Non-Ac</td>
                <td align="right">40</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Hino RN</td>
                <td>Hanif Enterprise</td>
                <td>DHA-15881</td>
                <td align="center">Ac</td>
                <td align="right">28</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>RM-2</td>
                <td>Manik Express</td>
                <td>DHA-25545</td>
                <td align="center">Ac</td>
                <td align="right">28</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Hino RN</td>
                <td>Alhamra Paribahan</td>
                <td>DHA-37713</td>
                <td align="center">Ac</td>
                <td align="right">31</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>Scania</td>
                <td>Agomony Express</td>
                <td>DHA-91040</td>
                <td align="center">Ac</td>
                <td align="right">28</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>ISUZU</td>
                <td>S.R Travels (Pvt) Ltd</td>
                <td>DHA-73001</td>
                <td align="center">Non-Ac</td>
                <td align="right">40</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>VOLVO</td>
                <td>Hanif Enterprise</td>
                <td>DHA-35107</td>
                <td align="center">Ac</td>
                <td align="right">33</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>RM-2</td>
                <td>Manik Express</td>
                <td>DHA-17403</td>
                <td align="center">Ac</td>
                <td align="right">28</td>
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

__visualize_backend(array(
	'title' => 'Manage Bus',
	'area' => 'managebus',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));

disconnectDatabase();
