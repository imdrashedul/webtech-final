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

$total = accessController($user['role'], BTRS_ROLE_ADMIN, BTRS_ROLE_SUPPORT_STAFF) ? totalUsersByRole(BTRS_ROLE_COUNTER_STAFF) : totalCounterStaff($user['id']);
$page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) && $_REQUEST['page']>0 ? $_REQUEST['page'] : 1;
$__limit = 10;
$tpage = ceil($total/$__limit);
$page = $page>$tpage ? $tpage : $page;
$__offset = $__limit * ($page - 1);
$users = accessController($user['role'], BTRS_ROLE_ADMIN, BTRS_ROLE_SUPPORT_STAFF) ? getUsersByRole(BTRS_ROLE_COUNTER_STAFF, $__offset, $__limit) : getCounterStaff($user['id'], $__offset, $__limit);

ob_start();
?>
<?php flushAlert('counterstaff') ?>
<div class="block">
    <div class="header">
        <b>Manage Counter Staffs</b>
        <a href="addcounterstaff.php" class="btn target blue" title="Add New Counter Staff"><span>Add New</span></a>
    </div>
    <div class="body">
        <table class="datatable">
            <thead>
            <tr>
                <th style="width: 60px">Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Hire Date</th>
                <th>Company</th>
                <th>Counter</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if(count($users)>0)
            {
                foreach ($users as $counterstaff)
                {
                    $name = htmlspecialchars(getUserDetails($counterstaff['id'], 'firstName').' '.getUserDetails($counterstaff['id'], 'lastName'));
                    $counter = getCounterById(getUserDetails($counterstaff['id'], 'busCounter'));
                    $manager = $counter['manager'];

                    echo '<tr>';
                    echo '<td><img class="rounded" src="uploads/'.getUserDetails($counterstaff['id'], 'photograph').'" alt="'.$name.'" title="'.$name.'" width="50px" height="50px"></td>';
                    echo '<td>'.$name.'</td>';
                    echo '<td>'.htmlspecialchars($counterstaff['email']).'</td>';
                    echo '<td class="text-center">'.__formatDate($counterstaff['registered'], 'j M Y').'</td>';
                    echo '<td class="text-center">'.htmlspecialchars(getUserDetails($manager, 'companyName')).'</td>';
                    echo '<td class="text-center">'.htmlspecialchars($counter['name']).'</td>';
                    echo '<td class="text-center">';
                    echo '<a href="#"><img src="assets/img/edit_user.png" width="18px" height="18px" alt="[+]" title="Edit Information" /></a> &#183;';
                    echo '<a href="#"><img src="assets/img/sq_remove.png" width="18px" height="18px" title="Remove Information"/></a>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            else
            {
                echo '<tr><td class="text-center" colspan="7">No Data Found</td></tr>';
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
                    <?= getPagination($page, $total, 'counterstaff.php?page=') ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();

__visualize_backend(array(
	'title' => 'Counter Staffs',
	'area' => 'counterstaff',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));

disconnectDatabase();