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

$total = accessController($user['role'], BTRS_ROLE_ADMIN, BTRS_ROLE_SUPPORT_STAFF) ? totalBuses() : totalBuses($user['id']);
$page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) && $_REQUEST['page']>0 ? $_REQUEST['page'] : 1;
$__limit = 10;
$tpage = ceil($total/$__limit);
$page = $page>$tpage ? $tpage : $page;
$__offset = $__limit * ($page - 1);
$buses = accessController($user['role'], BTRS_ROLE_ADMIN, BTRS_ROLE_SUPPORT_STAFF) ? getBuses($__offset, $__limit) : getBuses($__offset, $__limit, $user['id']);

ob_start();
?>
<?php flushAlert('managebus') ?>
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
            <?php if(count($buses)>0)
            {
                foreach ($buses as $bus)
                {
                    echo '<tr>';
                    echo '<td>'.htmlspecialchars($bus['name']).'</td>';
                    echo '<td>'.htmlspecialchars(getUserDetails($bus['manager'], 'companyName')).'</td>';
                    echo '<td>'.htmlspecialchars($bus['registration']).'</td>';
                    echo '<td class="text-center">'.htmlspecialchars($bus['type']).'</td>';
                    echo '<td class="text-right">'.($bus['seats_row']*$bus['seats_column']+$bus['fill_last_row']).'</td>';
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
                    <?= getPagination($page, $total, 'managebus.php?page=') ?>
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
