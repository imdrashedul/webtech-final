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

$total = totalDiscount();
$page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) && $_REQUEST['page']>0 ? $_REQUEST['page'] : 1;
$__limit = 10;
$tpage = ceil($total/$__limit);
$page = $page>$tpage ? $tpage : $page;
$__offset = $__limit * ($page - 1);
$discounts = getDiscount($__offset, $__limit);

ob_start();
?>
<?php flushAlert('discount') ?>
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
            <?php if(count($discounts)>0)
            {
                foreach ($discounts as $discount)
                {
                    echo '<tr>';
                    echo '<td>'.htmlspecialchars($discount['code']).'</td>';
                    echo '<td class="text-center">'.htmlspecialchars($discount['discount']).'</td>';
                    echo '<td class="text-right">'.htmlspecialchars($discount['max'].' BDT').'</td>';
                    echo '<td class="text-center">'.__formatDate($discount['valid_from'], "d/m/Y h:i a").'</td>';
                    echo '<td class="text-center">'.__formatDate($discount['valid_to'], "d/m/Y h:i a").'</td>';
                    echo '<td class="text-center">';
                    echo '<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;';
                    echo '<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            else
            {
                echo '<tr><td class="text-center" colspan="6">No Data Found</td></tr>';
            }
            ?>
            </tbody>
        </table>
        <div class="grid">
            <div class="row">
                <div class="column-4 ">
                    <?= getPaginationInfo($page, $total) ?>
                </div>
                <div class="column-8 text-right">
                    <?= getPagination($page, $total, 'discount.php?page=') ?>
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
