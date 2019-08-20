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

if(isset($_POST['submit']))
{
    $method = isset($_POST['method']) ? trim($_POST['method']) : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    if(empty($method))
    {
        $errors['method'] = 'Cannot be empty';
    }
    else if(strlen($method)<=2)
    {
        $errors['method'] = 'Contains at least two words';
    }

    if (empty($error))
    {
        if(empty($errors))
        {
            if(addPaymentMethod(array(
                'method' => $method,
                'description' => $description,
                'created' => date('Y-m-d H:i:s')
            ))) {
                addAlert([
                    't' => 'success',
                    'm' => 'Method '.$method.' Added Successfully',
                    'a' => 6000
                ], 'paymethod');
                header('location: paymethod.php');
                exit;
            }
        }
    }
}


ob_start();
?>
<div class="block">
        <div class="header">
            <b>Add Payment Method</b>
            <a href="paymethod.php" class="btn back red" title="Cancel"><span>Cancel</span></a>
        </div>
        <div class="body">
            <form action="addpaymethod.php" method="POST">
                <div class="grid">
                    <div class="row">
                        <div class="column-12">
                            <div class="inputset<?php __errors($errors,'method',true) ?>">
                                <label for="method">Method Name</label><br>
                                <input type="text" name="method" id="method" placeholder="Enter Method Name" value="<?php echo isset($_POST['method']) ? htmlspecialchars($_POST['method']) : '' ?>">
                                <?php __errors($errors, 'method') ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid">
                    <div class="row">
                        <div class="column-12">
                            <div class="inputset">
                                <label for="description">Description</label><br>
                                <textarea name="description" id="description" rows="4" cols="25"><?= htmlspecialchars(isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '') ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" class="btn submit" value="Add Method">
            </form>
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
