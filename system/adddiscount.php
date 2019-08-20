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
    $cupon = isset($_POST['cupon']) ? trim($_POST['cupon']) : '';
    $discount = isset($_POST['discount']) ? $_POST['discount'] : '';
    $discountMax = isset($_POST['discount_max']) ? $_POST['discount_max'] : '';
    $validFrom = isset($_POST['valid_from']) ? trim($_POST['valid_from']) : '';
    $validTo = isset($_POST['valid_to']) ? $_POST['valid_to'] : '';

    if(empty($cupon))
    {
        $errors['cupon'] = "Cannot be empty";
    }
    else if(strlen($cupon)<=2)
    {
        $errors['cupon'] = 'Contains at least two words';
    }
    else if(getValidCupon($cupon))
    {
        $errors['cupon'] = 'Another discount exists with same code';
    }

    if(empty($discount))
    {
        $errors['discount'] = "Cannot be empty";
    }
    else if(!($discount>0 && $discount<=100))
    {
        $errors['discount'] = 'Must be in between 0 to 100';
    }

    if(empty($discountMax))
    {
        $errors['discount_max'] = "Cannot be empty";
    }
    else if(!($discountMax>0))
    {
        $errors['discount_max'] = 'Must be greater than 0';
    }

    if(empty($validFrom))
    {
        $errors['valid_from'] = 'Cannot be empty';
    }
    else if (!__validDate($validFrom))
    {
        $errors['valid_from'] = 'Invalid Date/Time ';
    }

    if(empty($validTo))
    {
        $errors['valid_to'] = 'Cannot be empty';
    }
    else if (!__validDate($validTo))
    {
        $errors['valid_to'] = 'Invalid Date/Time';
    }

    if(empty($errors))
    {
        if(addDiscount(array(
            'code' => $cupon,
            'discount' => $discount,
            'max' => $discountMax,
            'valid_from' => $validFrom,
            'valid_to' => $validTo,
            'created' => date('Y-m-d H:i:s')
        ))) {
            addAlert([
                't' => 'success',
                'm' => 'Cupon '.htmlspecialchars($cupon).' Added Successfully',
                'a' => 6000
            ], 'discount');
            header('location: discount.php');
            exit;
        }
    }
}

ob_start();
?>

<div class="block">
    <div class="header">
        <b>Add Promotion Discount</b>
        <a href="discount.php" class="btn back red" title="Cancel"><span>Cancel</span></a>
    </div>
    <div class="body">
        <form action="adddiscount.php" method="POST">
            <div class="grid">
                <div class="row">
                    <div class="column-12">
                        <div class="inputset<?php __errors($errors,'cupon',true) ?>">
                            <label for="cupon">Cupon Code</label><br>
                            <input type="text" name="cupon" id="cupon" placeholder="Enter Cupon Code" value="<?php echo isset($_POST['cupon']) ? htmlspecialchars($_POST['cupon']) : '' ?>">
                            <?php __errors($errors, 'route') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid">
                <div class="row">
                    <div class="column-6">
                        <div class="inputset<?php __errors($errors,'discount',true) ?>">
                            <label for="discount">Discount (%)</label><br>
                            <input type="text" name="discount" id="discount" placeholder="Enter Discount Percentage" value="<?php echo isset($_POST['discount']) ? htmlspecialchars($_POST['discount']) : '' ?>">
                            <?php __errors($errors, 'discount') ?>
                        </div>
                    </div>
                    <div class="column-6">
                        <div class="inputset<?php __errors($errors,'discount_max',true) ?>">
                            <label for="discount_max">Max Amount</label><br>
                            <input type="text" name="discount_max" id="discount_max" placeholder="Max Amount" value="<?php echo isset($_POST['discount_max']) ? htmlspecialchars($_POST['discount_max']) : '' ?>"><br/>
                            <?php __errors($errors, 'discount_max') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid">
                <div class="row">
                    <div class="column-6">
                        <div class="inputset<?php __errors($errors,'valid_from',true) ?>">
                            <label for="valid_from">Valid From</label><br>
                            <input type="text" name="valid_from" id="valid_from" placeholder="Enter Valid From Date" value="<?php echo isset($_POST['valid_from']) ? htmlspecialchars($_POST['valid_from']) : '' ?>">
                            <?php __errors($errors, 'valid_from') ?>
                        </div>
                    </div>
                    <div class="column-6">
                        <div class="inputset<?php __errors($errors,'valid_to',true) ?>">
                            <label for="valid_to">Valid To</label><br>
                            <input type="text" name="valid_to" id="valid_to" placeholder="Enter Valid To Date" value="<?php echo isset($_POST['valid_to']) ? htmlspecialchars($_POST['valid_to']) : '' ?>"><br/>
                            <?php __errors($errors, 'valid_to') ?>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" class="btn submit" value="Add Discount">
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
ob_start();
?>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr(document.querySelector('input[type="text"][name="valid_from"]'), {
                altInput: true,
                enableTime: true,
                altFormat: "d/m/Y h:i K",
                dateFormat: "Y-m-d H:i:S",
                minDate: "today"
            });
            flatpickr(document.querySelector('input[type="text"][name="valid_to"]'), {
                altInput: true,
                enableTime: true,
                altFormat: "d/m/Y h:i K",
                dateFormat: "Y-m-d H:i:S",
                minDate: "today"
            });
        });
    </script>
<?php
$script = ob_get_clean();

__visualize_backend(array(
	'title' => 'Add Discount',
	'area' => 'discount',
	'data' => $content,
    'navigate' => array(array('discount.php', 'Promotional Discount')),
    'user' => $user,
    'validate' => $validate,
    'javascript' => $script
));
disconnectDatabase();