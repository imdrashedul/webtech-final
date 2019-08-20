<?php
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

require_once 'system/lib/function.php';

$errors = array();
connectDatabase();
if(isset($_POST['submit_checkout']))
{

}

ob_start();
?>
<div class="page-area">
    <div class="block wrapped">
        <div class="label">Passenger Information</div>
        <div class="body">
            <div class="input<?php __errors($errors,'name',true) ?>">
                <label class="input" for="name">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter Full Name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>"><br/>
                <?php __errors($errors, 'name') ?>
            </div>
            <div class="divideblock">
                <div>
                    <div class="input<?php __errors($errors,'email',true) ?>">
                        <label class="input" for="email">Email Address</label>
                        <input type="email" name="email" id="email" placeholder="Enter Email Address" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>"><br/>
                        <?php __errors($errors, 'email') ?>
                    </div>
                </div>
                <div>
                    <div class="input<?php __errors($errors,'mobile',true) ?>">
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
            <div class="input<?php __errors($errors,'method',true) ?>">
                <label class="input" for="method">Payment Method</label><br>
                <select name="method" id="method">
                    <option value="">Select</option>
                    <?= listPaymentMethod((isset($_POST['method']) ? $_POST['method'] : '')) ?>
                </select><br>
                <?php __errors($errors, 'name') ?>
            </div>
            <div class="divideblock">
                <div>
                    <div class="input<?php __errors($errors,'trxid',true) ?>">
                        <label class="input" for="trxid">TrxID</label>
                        <input type="text" name="trxid" id="trxid" placeholder="Enter Transaction ID" value="<?php echo isset($_POST['trxid']) ? htmlspecialchars($_POST['trxid']) : '' ?>"><br/>
                        <?php __errors($errors, 'name') ?>
                    </div>
                </div>
                <div>
                    <div class="input<?php __errors($errors,'promo',true) ?>">
                        <label class="input" for="promo">Promo Code (If Any)</label>
                        <input type="text" name="promo" id="promo" placeholder="Enter Promotion Code" value="<?php echo isset($_POST['promo']) ? htmlspecialchars($_POST['promo']) : '' ?>"><br/>
                        <?php __errors($errors, 'promo') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
disconnectDatabase();
__visualize_fontend(array(
    'data' => $content
));
