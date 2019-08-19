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
        <b>Add New Bus</b>
        <a href="managebus.php" class="btn back red" title="Cancel"><span>Cancel</span></a>
    </div>
    <div class="body">
        <div class="grid">
            <div class="row">
                <div class="column-12">
                    <div class="inputset<?php __errors($errors,'bus_manager',true) ?>">
                        <label for="bus_manager">Bus Manager</label><br>
                        <select name="bus_manager" id="bus_manager">
                            <option value="">Select</option>
                            <option value="1"<?php __selected("1", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Thane Hooper</option>
                            <option value="2"<?php __selected("2", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Alvin Vang</option>
                            <option value="3"<?php __selected("3", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Erich Stevens</option>
                            <option value="4"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Brent Mathis</option>
                            <option value="5"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Ferdinand Woods</option>
                            <option value="6"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Gavin Ferrell</option>
                            <option value="7"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Joshua Raymond</option>
                            <option value="8"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Zachary Crosby</option>
                            <option value="9"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Samuel Alston</option>
                            <option value="10"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Basil Noble</option>
                        </select><br>
                        <?php __errors($errors, 'bus_manager') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid">
            <div class="row">
                <div class="column-6">
                    <div class="inputset<?php __errors($errors,'name',true) ?>">
                        <label for="name">Name/Model</label>
                        <input type="text" name="name" id="name" placeholder="Enter Bus Name/Model" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" size="24"><br/>
                        <?php __errors($errors, 'name') ?>
                    </div>
                </div>
                <div class="column-6">
                    <div class="inputset<?php __errors($errors,'reg_no',true) ?>">
                        <label for="reg_no">Registration No.</label>
                        <input type="text" name="reg_no" id="reg_no" placeholder="Enter full registration number" value="<?php echo isset($_POST['reg_no']) ? htmlspecialchars($_POST['reg_no']) : '' ?>" size="24"><br/>
                        <?php __errors($errors, 'reg_no') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid">
            <div class="row">
                <div class="column-6">
                    <div class="inputset<?php __errors($errors,'reg_no',true) ?>">
                        <label for="seats_col">Seats</label><br>
                        <input type="text" name="seats_col" id="seats_col" placeholder="Column" value="<?php echo isset($_POST['seats_col']) ? htmlspecialchars($_POST['seats_col']) : '' ?>" style="width:30%"> x
                        <input type="text" name="seats_row" id="seats_row" placeholder="Row" value="<?php echo isset($_POST['reg_no']) ? htmlspecialchars($_POST['reg_no']) : '' ?>" style="width:30%">
                        <label class="checkbox m-l-10">
                            <input type="checkbox" name="seats_last_fill" id="seats_last_fill" value="last_row_filled"<?php isset($_POST['seats_last_fill']) ? __selected('last_row_filled', $_POST['seats_last_fill'], 'radio') : '' ?>> Fill Last Row
                            <span class="check"></span>
                        </label>
                        <br>
                        <?php __errors($errors, 'reg_no') ?>
                    </div>
                </div>
                <div class="column-6">
                    <div class="inputset<?php __errors($errors,'bus_type',true) ?>">
                        <label for="bus_ac">Bus Class</label><br>
                        <label class="radio m-r-45">
                            <input type="radio" name="bus_type" id="bus_ac" value="Ac"<?php if(isset($_POST['bus_type'])) { __selected('Ac', $_POST['bus_type'], 'radio'); } ?>> Ac
                            <span class="check"></span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="bus_type" id="bus_normal" value="Non-Ac"<?php if(isset($_POST['bus_type'])) { __selected('Non-Ac', $_POST['bus_type'], 'radio'); } ?>> Non-Ac
                            <span class="check"></span>
                        </label><br>
                        <?php __errors($errors, 'bus_type') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid">
            <div class="row">
                <div class="column-12">
                    <div class="inputset<?php __errors($errors,'description',true) ?>">
                        <label for="description">Description</label><br>
                        <textarea name="description" id="description" rows="4" cols="25"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <input type="submit" name="submit" class="btn submit" value="Add Bus">
    </div>
</div>

<?php
$content = ob_get_clean();


__visualize_backend(array(
	'title' => 'Add New Bus',
	'area' => 'managebus',
	'data' => $content,
    'navigate'=> array(array('managebus.php', 'Manage Bus')),
    'user' => $user,
    'validate' => $validate
));
disconnectDatabase();