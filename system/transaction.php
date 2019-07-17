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
        <b>All Transactions List</b>
    </div>
    <div class="body">
        <table class="datatable">
            <thead>
            <tr>
                <th>Transaction ID</font></th>
                <th>Reservation ID</font></th>
                <th>Method</font></th>
                <th>Deatis</font></th>
                <th>Amount</font></th>
                <th>Action</font></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>ABC-1A5KL</font></td>
                <td>ABC-1A5KL</font></td>
                <td>bKash</font></td>
                <td align="center">12KFHJ1224112</font></td>
                <td align="right"> 3000 BDT</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>ABC-G15DM</font></td>
                <td>ABC-G15DM</font></td>
                <td>bKash</font></td>
                <td align="center">12KF2JLK24112</font></td>
                <td align="right"> 700 BDT</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>ABC-9TV1D</font></td>
                <td>ABC-9TV1D</font></td>
                <td>bKash</font></td>
                <td align="center">12KFHJ1224112</font></td>
                <td align="right"> 3000 BDT</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>ABC-5B2GL</font></td>
                <td>ABC-5B2GL</font></td>
                <td>bKash</font></td>
                <td align="center">12KFHJ1224112</font></td>
                <td align="right"> 3000 BDT</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>ABC-1A5KL</font></td>
                <td>ABC-1A5KL</font></td>
                <td>bKash</font></td>
                <td align="center">12KFHJ1224112</font></td>
                <td align="right"> 3000 BDT</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>ABC-1A5KL</font></td>
                <td>ABC-1A5KL</font></td>
                <td>bKash</font></td>
                <td align="center">12KFHJ1224112</font></td>
                <td align="right"> 3000 BDT</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>ABC-1A5KL</font></td>
                <td>ABC-1A5KL</font></td>
                <td>bKash</font></td>
                <td align="center">12KFHJ1224112</font></td>
                <td align="right"> 3000 BDT</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>ABC-1A5KL</font></td>
                <td>ABC-1A5KL</font></td>
                <td>bKash</font></td>
                <td align="center">12KFHJ1224112</font></td>
                <td align="right"> 3000 BDT</font></td>
                <td align="center">
                    <a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>
                </td>
            </tr>
            <tr>
                <td>ABC-1A5KL</font></td>
                <td>ABC-1A5KL</font></td>
                <td>bKash</font></td>
                <td align="center">12KFHJ1224112</font></td>
                <td align="right"> 3000 BDT</font></td>
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
	'title' => 'Transactions',
	'area' => 'transaction',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));

disconnectDatabase();
