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
        <b>Add Promotion Discount</b>
        <a href="discount.php" class="btn back red" title="Cancel"><span>Cancel</span></a>
    </div>
    <div class="body">
        <table border="0" cellpadding="5" cellspacing="0">
            <tr>
                <td valign="top" align="right">
                    <label for="cupon"><font face="Arial" size="2"><b>Cupon Code</b></font></label>
                </td>
                <td valign="top">
                    <input type="text" name="cupon" id="cupon" placeholder="Enter Cupon Code" value="<?php echo isset($_POST['cupon']) ? htmlspecialchars($_POST['cupon']) : '' ?>" size="24"><br/>
                    <?php __errors($errors, 'cupon') ?>
                </td>
            </tr>
            <tr>
                <td valign="top" align="right">
                    <label for="discount"><font face="Arial" size="2"><b>Discount (%)</b></font></label>
                </td>
                <td valign="top">
                    <input type="text" name="discount" id="discount" placeholder="Enter Discount Percentage" value="<?php echo isset($_POST['discount']) ? htmlspecialchars($_POST['discount']) : '' ?>" size="24"><br/>
                    <?php __errors($errors, 'discount') ?>
                </td>
            </tr>
            <tr>
                <td valign="top" align="right">
                    <label for="discount_max"><font face="Arial" size="2"><b>Max Amount</b></font></label>
                </td>
                <td valign="top">
                    <input type="text" name="discount_max" id="discount_max" placeholder="Enter Maximum Discount Amount" value="<?php echo isset($_POST['discount_max']) ? htmlspecialchars($_POST['discount_max']) : '' ?>" size="24"><br/>
                    <?php __errors($errors, 'discount_max') ?>
                </td>
            </tr>
            <tr>
                <td valign="top" align="right">
                    <label for="valid_from"><font face="Arial" size="2"><b>Valid From</b></font></label>
                </td>
                <td valign="top">
                    <input type="text" name="valid_from" id="valid_from" placeholder="Enter Valid From Date" value="<?php echo isset($_POST['valid_from']) ? htmlspecialchars($_POST['valid_from']) : '' ?>" size="24"><br/>
                    <?php __errors($errors, 'valid_from') ?>
                </td>
            </tr>
            <tr>
                <td valign="top" align="right">
                    <label for="valid_to"><font face="Arial" size="2"><b>Valid To</b></font></label>
                </td>
                <td valign="top">
                    <input type="text" name="valid_to" id="valid_to" placeholder="Enter Valid From Date" value="<?php echo isset($_POST['valid_to']) ? htmlspecialchars($_POST['valid_to']) : '' ?>" size="24"><br/>
                    <?php __errors($errors, 'valid_to') ?>
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
                    <input type="submit" name="submit" value="Add Discount">
                </td>
            </tr>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();


__visualize_backend(array(
	'title' => 'Add Discount',
	'area' => 'discount',
	'data' => $content,
    'navigate' => array(array('discount.php', 'Promotional Discount')),
    'user' => $user,
    'validate' => $validate
));
disconnectDatabase();