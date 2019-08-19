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

$total = totalBusSchedules();
$page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) && $_REQUEST['page']>0 ? $_REQUEST['page'] : 1;
$__limit = 10;
$tpage = ceil($total/$__limit);
$page = $page>$tpage ? $tpage : $page;
$__offset = $__limit * ($page - 1);
$schedules = getBusSchedules($__offset, $__limit);

ob_start();
?>

<div class="block">
    <div class="header">
        <b>Bus Schedules List</b>
        <a href="addbusschedule.php" class="btn target blue" title="Add New Schedule"><span>Add New</span></a>
    </div>
    <div class="body">
        <table class="datatable">
            <thead>
            <tr>
                <th>Bus</th>
                <th>Company</th>
                <th>Routes</th>
                <th>Departure</th>
                <th>Arrival</th>
                <th>Fare</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if(count($schedules)>0)
            {
                foreach ($schedules as $schedule)
                {
                    echo '<tr>';
                    echo '<td>'.htmlspecialchars($schedule['name'] . " [".$schedule['registration']."]").'</td>';
                    echo '<td>'.htmlspecialchars(getUserDetails($schedule['manager'], 'companyName')).'</td>';
                    echo '<td>'.htmlspecialchars($schedule['route']).'</td>';
                    echo '<td>'.__formatDate($schedule['departure'], "d/m/Y h:i a").'</td>';
                    echo '<td>'.__formatDate($schedule['arrival'], "d/m/Y h:i a").'</td>';
                    echo '<td class="text-right">'.htmlspecialchars($schedule['fare'] . " BDT").'</td>';
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
                    <?= getPagination($page, $total, 'busschedule.php?page=') ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();

__visualize_backend(array(
	'title' => 'Bus Schedules',
	'area' => 'busschedule',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));

disconnectDatabase();
