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

ob_start();
?>

    <div class="block">
        <div class="header">
            <b>Add Payment Method</b>
            <a href="paymethod.php" class="btn back red" title="Cancel"><span>Cancel</span></a>
        </div>
        <div class="body">
            <table border="0" cellpadding="5" cellspacing="0">
                <tr>
                    <td valign="top" align="right">
                        <label for="method"><font face="Arial" size="2"><b>Method Name</b></font></label>
                    </td>
                    <td valign="top">
                        <input type="text" name="method" id="method" placeholder="Enter Method Name" value="<?php echo isset($_POST['method']) ? htmlspecialchars($_POST['method']) : '' ?>" size="24"><br/>
                        <?php __errors($errors, 'method') ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top" align="right">
                        <label for="gateway"><font face="Arial" size="2"><b>Gateway</b></font></label>
                    </td>
                    <td valign="top">
                        <input type="text" name="gateway" id="gateway" placeholder="Enter Method Gateway" value="<?php echo isset($_POST['gateway']) ? htmlspecialchars($_POST['gateway']) : '' ?>" size="24"><br/>
                        <?php __errors($errors, 'gateway') ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top" align="right">
                        <label for="description"><font face="Arial" size="2"><b>Description</b></font></label>
                    </td>
                    <td valign="top">
                        <textarea name="description" rows="4" cols="25"></textarea>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Add Method">
                    </td>
                </tr>
            </table>
        </div>
    </div>


<?php
$content = ob_get_clean();

__visualize_backend(array(
	'title' => 'Add Payment Method',
	'area' => 'paymethod',
	'navigate' => array(array('paymethod.php', 'Payment Methods')),
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));

disconnectDatabase();
