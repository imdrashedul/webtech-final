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

$total = totalPayMethod();
$page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) && $_REQUEST['page']>0 ? $_REQUEST['page'] : 1;
$__limit = 10;
$tpage = ceil($total/$__limit);
$page = $page>$tpage ? $tpage : $page;
$__offset = $__limit * ($page - 1);
$paymethods = getPayMethod($__offset, $__limit);

ob_start();
?>
<?php flushAlert('paymethod') ?>
<div class="block">
    <div class="header">
        <b>Payment Methods List</b>
        <a href="addpaymethod.php" class="btn target blue" title="Add New Method"><span>Add New</span></a>
    </div>
    <div class="body">
        <table class="datatable">
            <thead>
            <tr>
                <th>Method</th>
                <th>Description</th>
                <th>Added</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if(count($paymethods)>0)
            {
                foreach ($paymethods as $paymethod)
                {
                    echo '<tr>';
                    echo '<td>'.htmlspecialchars($paymethod['method']).'</td>';
                    echo '<td>'.htmlspecialchars($paymethod['description']).'</td>';
                    echo '<td class="text-center">'.__formatDate($paymethod['created'], "d/m/Y h:i a").'</td>';
                    echo '<td class="text-center">';
                    echo '<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;';
                    echo '<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            else
            {
                echo '<tr><td class="text-center" colspan="4">No Data Found</td></tr>';
            }
            ?>
            </tbody>
        </table>

    </div>
</div>

<?php
$content = ob_get_clean();

__visualize_backend(array(
	'title' => 'Payment Methods',
	'area' => 'paymethod',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));

disconnectDatabase();
