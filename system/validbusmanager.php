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

$errors = array();

$user = getUserBySession($token);
$validate = isset($user['id']) ? isValidUser($user['id']) : false;

if($validate!=true)
{
    header('location: index.php');
    die();
}

$total = totalUsersByRole(BTRS_ROLE_BUS_MANAGER, 0);
$page = isset($_REQUEST['page']) && !empty($_REQUEST['page']) && $_REQUEST['page']>0 ? $_REQUEST['page'] : 1;
$__limit = 10;
$tpage = ceil($total/$__limit);
$page = $page>$tpage ? $tpage : $page;
$__offset = $__limit * ($page - 1);
$managers = getAllBusManager($__offset, $__limit, 0);
ob_start();

ob_start();
?>
    <div class="alert success" id="ashdkjTEjkd">
        M. Monirul Islam Validated Successfully
        <script>
            setTimeout(function(){ document.getElementById('ashdkjTEjkd').remove() }, 6000);
        </script>
    </div>
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
                <?php if(count($managers)>0)
                {
                    foreach ($managers as $manager)
                    {
                        echo '<tr>';
                        echo '<td><a href="profile.php?user='.urlencode($manager['id']).'">'.htmlspecialchars(getUserDetails($manager['id'], 'firstName').' '.getUserDetails($manager['id'], 'lastName')).'</td>';
                        echo '<td>'.htmlspecialchars($manager['email']).'</td>';
                        echo '<td class="text-center">'.htmlspecialchars(getUserDetails($manager['id'], 'companyName')).'</td>';
                        echo '<td class="text-center">'.__formatDate($manager['registered'], 'j M Y').'</td>';
                        echo '<td class="text-right">0</td>';
                        echo '<td class="text-center">';
                        echo '<a href="validbusmanager.php?valid='.urlencode($manager['id']).'"><img src="assets/img/approve.png" width="24px" height="20px" alt="[+]" title="Valid Manager" /></a>';
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
                        <?= getPagination($page, $total) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php
$content = ob_get_clean();

__visualize_backend(array(
    'title' => 'Validation List',
    'area' => 'busmanager',
    'navigate'=> array(array('busmanager.php', 'Bus Managers')),
    'data' => $content,
    'user' => $user,
    'validate' => $validate
));
disconnectDatabase();