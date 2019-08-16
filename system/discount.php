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
        <b>Manage Promotional Discounts</b>
        <a href="adddiscount.php" class="btn target blue" title="Add New Discount"><span>Add New</span></a>
    </div>
    <div class="body">
        <table class="datatable">
            <thead>
            <tr>
                <th>Code</th>
                <th>Discount</th>
                <th>Max</th>
                <th>Valid From</th>
                <th>Valid To</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>BIJOY71</td>
                <td>30%</td>
                <td align="right">200 BDT</td>
                <td align="center">31/01/2019</td>
                <td align="center">28/04/2019</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>DOEL54</td>
                <td>50%</td>
                <td align="right">150 BDT</td>
                <td align="center">05/02/2019</td>
                <td align="center">15/08/2019</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>UTHSASH60</td>
                <td>70%</td>
                <td align="right">100 BDT</td>
                <td align="center">10/03/2019</td>
                <td align="center">05/07/2019</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>ROMONI43</td>
                <td>20%</td>
                <td align="right">300 BDT</td>
                <td align="center">05/02/2019</td>
                <td align="center">09/07/2019</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>PADMA11</td>
                <td>70%</td>
                <td align="right">200 BDT</td>
                <td align="center">15/06/2019</td>
                <td align="center">22/08/2019</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>SHAPLA13</td>
                <td>45%</td>
                <td align="right">300 BDT</td>
                <td align="center">19/02/2019</td>
                <td align="center">05/08/2019</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>JAGO26</td>
                <td>35%</td>
                <td align="right">250 BDT</td>
                <td align="center">15/03/2019</td>
                <td align="center">22/04/2019</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>NIRBAS80</td>
                <td>15%</td>
                <td align="right">150 BDT</td>
                <td align="center">04/01/2019</td>
                <td align="center">04/05/2019</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>ACHOL04</td>
                <td>60%</td>
                <td align="right">400 BDT</td>
                <td align="center">03/03/2019</td>
                <td align="center">03/04/2019</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>BILASH75</td>
                <td>30%</td>
                <td align="right">200 BDT</td>
                <td align="center">04/04/2019</td>
                <td align="center">04/05/2019</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>CYBER75</td>
                <td>10%</td>
                <td align="right">200 BDT</td>
                <td align="center">11/01/2019</td>
                <td align="center">11/04/2019</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>CYCLONE55</td>
                <td>25%</td>
                <td align="right">100 BDT</td>
                <td align="center">01/06/2019</td>
                <td align="center">01/07/2019</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>HUMBA30</td>
                <td>30%</td>
                <td align="right">300 BDT</td>
                <td align="center">01/07/2019</td>
                <td align="center">01/10/2019</td>
                <td align="center">
                    <a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>BTRS007</td>
                <td>70%</td>
                <td align="right">250 BDT</td>
                <td align="center">01/01/2019</td>
                <td align="center">01/07/2019</td>
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
	'title' => 'Promotional Discount',
	'area' => 'discount',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));

disconnectDatabase();
