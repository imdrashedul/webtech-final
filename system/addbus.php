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
    $operator = accessController($user['role'], BTRS_ROLE_ADMIN, BTRS_ROLE_SUPPORT_STAFF) ? ( isset($_POST['bus_operator']) ? trim($_POST['bus_operator']) : '') : (accessController($user['role'], BTRS_ROLE_BUS_MANAGER)?$user['id']:'');
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $registration = isset($_POST['reg_no']) ? trim($_POST['reg_no']) : '';
    $col = isset($_POST['seats_col']) ? $_POST['seats_col'] : '';
    $row = isset($_POST['seats_row']) ? $_POST['seats_row'] : '';
    $filllast = isset($_POST['seats_last_fill']) ? 1 : 0 ;
    $type = isset($_POST['bus_type']) ? $_POST['bus_type'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    // Validation Set of 'Bus Operator'
    if(empty($operator))
    {
        $errors['bus_operator'] = 'Cannot be empty';
    }
    else if(!getUserById($operator))
    {
        $errors['bus_operator'] = 'Operator not found';
    }

    // Validation Set of 'Bus Name/Model'
    if(empty($name))
    {
        $errors['name'] = 'Cannot be empty';
    }
    else if(strlen($name)<=2)
    {
        $errors['name'] = 'Contains at least two words';
    }

    if(empty($registration))
    {
        $errors['reg_no'] = 'Cannot be empty';
    }
    if(getBusByReg($registration))
    {
        $errors['reg_no'] = 'Already Exists';
    }

    // Validation Set of 'Bus Seats'
    if(empty($col) || empty($row) || !($col>0) || !($row>0))
    {
        $errors['seats'] = 'Column and Row cannot be empty';
    }
    else if ($col>4 || $col<3)
    {
        $errors['seats'] = 'Column cannot be more than 4 or less than 3';
    }

    // Validation Set of 'Bus Type'
    if(empty($type))
    {
        $errors['bus_type'] = 'Cannot be empty';
    }

    if(empty($errors))
    {
        if(addBus(array(
            'manager' => $operator,
            'name' => $name,
            'registration' => $registration,
            'type' => $type,
            'seats_row' => $row,
            'seats_column' => $col,
            'fill_last_row' => $filllast,
            'description' => $description
        ))) {
            addAlert([
                't' => 'success',
                'm' => $name . ' ['.$registration.'] Added Successfully',
                'a' => 6000
            ], 'managebus');
            header('location: managebus.php');
            exit;
        }
    }

}

ob_start();
?>

<div class="block">
    <div class="header">
        <b>Add New Bus</b>
        <a href="managebus.php" class="btn back red" title="Cancel"><span>Cancel</span></a>
    </div>
    <div class="body">
        <form action="addbus.php" method="POST">
            <?php if(accessController($user['role'], BTRS_ROLE_ADMIN, BTRS_ROLE_SUPPORT_STAFF)) : ?>
            <div class="grid">
                <div class="row">
                    <div class="column-12">
                        <div class="inputset<?php __errors($errors,'bus_operator',true) ?>">
                            <label for="bus_operator">Bus Operator</label><br>
                            <select name="bus_operator" id="bus_operator">
                                <option value="">Select</option>
                                <?= listBusCompany((isset($_POST['bus_operator']) ? $_POST['bus_operator'] : '')) ?>
                            </select><br>
                            <?php __errors($errors, 'bus_operator') ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
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
                        <div class="inputset<?php __errors($errors,'seats',true) ?>">
                            <label for="seats_col">Seats</label><br>
                            <input type="text" name="seats_col" id="seats_col" placeholder="Column" value="<?php echo isset($_POST['seats_col']) ? htmlspecialchars($_POST['seats_col']) : '' ?>" style="width:30%"> x
                            <input type="text" name="seats_row" id="seats_row" placeholder="Row" value="<?php echo isset($_POST['seats_row']) ? htmlspecialchars($_POST['seats_row']) : '' ?>" style="width:30%">
                            <label class="checkbox m-l-10">
                                <input type="checkbox" name="seats_last_fill" id="seats_last_fill" value="last_row_filled"<?php isset($_POST['seats_last_fill']) ? __selected('last_row_filled', $_POST['seats_last_fill'], 'radio') : '' ?>> Fill Last Row
                                <span class="check"></span>
                            </label>
                            <br>
                            <?php __errors($errors, 'seats') ?>
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
                            <textarea name="description" id="description" rows="4" cols="25"><?= htmlspecialchars(isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" class="btn submit" value="Add Bus">
        </form>
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