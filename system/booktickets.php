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

ob_start();
?>
<?php if(!$validate) : ?>
<div class="block">
    <div class="header warning">
        <b>Pending Validation !!</b>
    </div>
    <div class="body">
        
    </div>
</div>
<?php endif; ?>
<?php
$content = ob_get_clean();
__visualize_backend(array(
	'title' => 'Book Ticket',
	'area' => 'bookticket',
	'data' => $content,
	'user' => $user,
    'validate' => $validate
));

disconnectDatabase();
