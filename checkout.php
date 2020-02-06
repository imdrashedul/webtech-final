<?php
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

require_once 'system/lib/function.php';

connectDatabase();

$errors = array();

$fatal = true;

$message = "System Error";

if(isset($_POST['submit_checkout']))
{
    
    $scheduleid = isset($_POST['schedule']) ? $_POST['schedule'] : '';
    $seats = isset($_POST['checkout_seats']) ? $_POST['checkout_seats'] : array();

    $schedule = null;

    if(empty($scheduleid))
    {
        $message = "Schedule Required";
    }
    else if(!($schedule = getScheduleById($scheduleid)))
    {
        $message = "Schedule Not Found";
    }
    else if(!is_array($seats) || empty($seats))
    {
        $message = "No Seats Selected";
    }
    else if(count($seats)>4)
    {
        $message = "Maximum 4 Seats are allowed";
    }
    else if(!verifyAvailableSeats($seats, $schedule))
    {
        $message = "Selected Seat(s) are not available";
    }
    else if($temporary = bookTemporaryTicket($seats, $schedule))
    {
        setTemporaryBooking($temporary);
        header('location: checkout.php');
        exit;
    }
    
}

if($booking = getTemporaryBooking())
{
    if($booking = getBookingById($booking))
    {
        $fatal = false;
    }
}

if(isset($_POST['checkout_confirm']))
{
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $mobile = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
    $method = isset($_POST['method']) ? $_POST['method'] : '';
    $trxid = isset($_POST['trxid']) ? trim($_POST['trxid']) : '';
    $promo = isset($_POST['promo']) ? trim($_POST['promo']) : '';

    if(empty($name))
    {
        $errors['name'] = 'Cannot be empty';
    }
    else if(strlen($name)<=2)
    {
        $error['name'] = 'Contains at least two words';
    }

    if(!empty($email) && !filter_var(filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL))
    {
        $errors['email'] = 'Must be a valid email address (i.e anything@example.com)';
    }

    if(empty($mobile))
    {
        $errors['mobile'] = 'Cannot be empty';
    }
    else if(!verifyBDMobile($mobile))
    {
        $errors['mobile'] = 'Invalid mobile number. we allowed bd operators only';
    }

    if(empty($method))
    {
        $errors['method'] = 'Cannot be empty';
    }
    else if(!getPayMethodById($method))
    {
        $errors['method'] = 'Method not found';  
    }

    if(empty($trxid))
    {
        $errors['trxid'] = 'Cannot be empty';
    }

    if(empty($trxid))
    {
        $errors['trxid'] = 'Cannot be empty';
    }
    else if (!empty($method) && getTransactionByTrxidMethod($trxid, $method)) 
    {
        $errors['trxid'] = 'Trasaction already exists';
    }

    if(!empty($promo) && !($cuponDetails = getValidCupon($promo)))
    {
        $errors['promo'] = 'Invalid Code';
    }

    if(empty($errors))
    {
        $fare = $booking['total_fare'];
        $promo = null;

        if(isset($cuponDetails) && $cuponDetails)
        {
            $promo = $cuponDetails['id'];
            $discount = ($fare/100)*$cuponDetails['discount'];
            $discount = $discount>$cuponDetails['max']?$cuponDetails['max']:$discount;
            $fare -= $discount;
        }

        if(addTransaction(array(
            'trxid' => $trxid,
            'method' => $method, 
            'amount' => $fare, 
            'promo' => $promo, 
            'created' => date('Y-m-d H:i:s')
        )))
        {
            if(completeBooking($booking['id'], array(
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile
            )))
            {
                $_SESSION['checkout_complete'] = $booking['id'];
                clearTemporaryBooking();
                header('location: checkout.php');
                exit;
            }

        }

    }
}
ob_start();
?>
<div class="page-area">
    <?php if(isset($_SESSION['checkout_complete'])) : ?>
    <?php unset($_SESSION['checkout_complete']) ?>
    <div class="block success">
        Ticket Succesfully Booked
    </div>
    <?php elseif($fatal) : ?>
    <div class="block fatal">
        <?= htmlspecialchars($message) ?>
    </div>
    <?php else : ?>
    <div class="block">
        <div class="departure">
            <?php
                $schedule = getScheduleById($booking['schedule']);
                $bus = getBusById($schedule['busid']);
            ?>
            <p><?= htmlspecialchars($schedule['route']) ?>, <?= __formatDate($schedule['departure'], 'd/m/Y') ?>, <?= htmlspecialchars(getUserDetails($bus['manager'], 'companyName')) ?>, <?= htmlspecialchars($bus['name']) ?>, [<?= implode('][', getBookedSeatsByBooking($booking['id'])) ?>], <?= htmlspecialchars($booking['total_fare']) ?> BDT </p>
        </div>
    </div>
    <form method="POST" action="checkout.php">
        <div class="block wrapped">
            <div class="label">Passenger Information</div>
            <div class="body">
                <div class="input<?php __errors($errors,'name', true) ?>">
                    <label class="input" for="name">Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Full Name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>"><br/>
                    <?php __errors($errors, 'name') ?>
                </div>
                <div class="divideblock">
                    <div>
                        <div class="input<?php __errors($errors,'email', true) ?>">
                            <label class="input" for="email">Email Address</label>
                            <input type="email" name="email" id="email" placeholder="Enter Email Address" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"><br/>
                            <?php __errors($errors, 'email') ?>
                        </div>
                    </div>
                    <div>
                        <div class="input<?php __errors($errors,'mobile', true) ?>">
                            <label class="input" for="mobile">Mobile</label>
                            <input type="text" name="mobile" id="mobile" placeholder="Enter Mobile Number" value="<?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : '' ?>"><br/>
                            <?php __errors($errors, 'mobile') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block wrapped">
            <div class="label">Payment Information</div>
            <div class="body">
                <div class="input<?php __errors($errors,'method', true) ?>">
                    <label class="input" for="method">Payment Method</label><br>
                    <select name="method" id="method">
                        <option value="">Select</option>
                        <?= listPaymentMethod((isset($_POST['method']) ? $_POST['method'] : '')) ?>
                    </select><br>
                    <?php __errors($errors, 'method') ?>
                </div>
                <div class="divideblock">
                    <div>
                        <div class="input<?php __errors($errors,'trxid', true) ?>">
                            <label class="input" for="trxid">TrxID</label>
                            <input type="text" name="trxid" id="trxid" placeholder="Enter Transaction ID" value="<?php echo isset($_POST['trxid']) ? htmlspecialchars($_POST['trxid']) : '' ?>"><br/>
                            <?php __errors($errors, 'trxid') ?>
                        </div>
                    </div>
                    <div>
                        <div class="input<?php __errors($errors,'promo', true) ?>">
                            <label class="input" for="promo">Promo Code (If Any)</label>
                            <input type="text" name="promo" id="promo" placeholder="Enter Promotion Code" value="<?php echo isset($_POST['promo']) ? htmlspecialchars($_POST['promo']) : '' ?>"><br/>
                            <?php __errors($errors, 'promo') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block">
            <input type="submit" class="btn checkout_confirm" name="checkout_confirm" value="Confirm Booking">
        </div>
    </form>
    <?php endif; ?>
</div>
<?php
$content = ob_get_clean();

disconnectDatabase();
__visualize_fontend(array(
    'data' => $content,
));
