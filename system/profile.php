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

$username = getUserDetails($user['id'], 'firstName') . ' ' . getUserDetails($user['id'], 'lastName');
$userDob = getUserDetails($user['id'], 'birthDate');

ob_start();
?>

<div class="block">
    <div class="header">
        <b>Basic Profile</b>
        <?php if($validate==true) : ?>
        <a href="updateprofile.php" class="btn target blue" title="Update Profile"><span>Update</span></a>
        <?php endif; ?>
    </div>
    <div class="body">
        <table width="100%">
            <tr>
                <td width="170px" valign="top">
                    <img src="<?= getUserPhotograph($user['id'], 'assets/img/default_avatar.png') ?>" width="150px" height="150px">
                </td>
                <td valign="top">
                    <font face="Arial" size="2"><b>Personal Information</b></font><hr>
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><font face="Arial" size="2"><b>Name</b></font></td>
                            <td width="15px" align="center">:</td>
                            <td><font face="Arial" size="2"><?= htmlspecialchars($username) ?></font></td>
                        </tr>
                        <tr>
                            <td><font face="Arial" size="2"><b>Gender</b></font></td>
                            <td width="15px" align="center">:</td>
                            <td><font face="Arial" size="2"><?= $user['gender'] ? decodeGender($user['gender']) : ''?></font></td>
                        </tr>
                        <tr>
                            <td><font face="Arial" size="2"><b>Date of Birth</b></font></td>
                            <td width="15px" align="center">:</td>
                            <td><font face="Arial" size="2"><?= $user ? __formatDate($userDob, 'j F Y', 'Y-m-d') : ''?></font></td>
                        </tr>
                    </table>
                    <br>
                    <font face="Arial" size="2"><b>Login Information</b></font><hr>
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td><font face="Arial" size="2"><b>Email Address</b></font></td>
                            <td width="15px" align="center">:</td>
                            <td><font face="Arial" size="2"><?= htmlspecialchars($user['email']) ?></font></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();

__visualize_backend(array(
	'title' => 'Profile',
	'area' => 'profile',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));

disconnectDatabase();
