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
        <b>General Settings</b>
    </div>
    <div class="body">
        <table border="0" cellpadding="5" cellspacing="0">
            <tr>
                <td valign="top" align="right">
                    <label for="name"><font face="Arial" size="2"><b>Site Name</b></font></label>
                </td>
                <td valign="top">
                    <input type="text" name="name" id="name" placeholder="Enter Site Name" size="24">
                </td>
            </tr>
            <tr>
                <td valign="top" align="right">
                    <label for="photograph"><font face="Arial" size="2"><b>Site Logo</b></font></label>
                </td>
                <td valign="top">
                    <input type="file" name="photograph" id="photograph">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Save">
                </td>
            </tr>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();

__visualize(array(
	'title' => 'General Settings',
	'area' => 'settings',
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));
disconnectDatabase();