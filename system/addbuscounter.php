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
    $operator = isset($_POST['bus_operator']) ? trim($_POST['bus_operator']) : '';
    $counter = isset($_POST['name']) ? trim($_POST['name']) : '';
    $location = isset($_POST['counter_location']) ? trim($_POST['counter_location']) : '';
    $type = isset($_POST['counter_type']) ? trim($_POST['counter_type']) : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    //Validation Set Of 'Bus Operator'
    if(empty($operator))
    {
        $errors['bus_operator'] = 'Cannot be empty';
    }
    else if(!getUserById($operator, 1))
    {
        $errors['bus_operator'] = 'Operator not found';
    }

    //Validation Set Of 'Counter Name'
    if(empty($counter))
    {
        $errors['name'] = 'Cannot be empty';
    }
    else if(strlen($counter)<=2)
    {
        $errors['name'] = 'Contains at least two words';
    }

    //Validation Set Of 'Counter Location'
    if(empty($location))
    {
        $errors['counter_location'] = 'Cannot be empty';
    }

    if(empty($errors))
    {
        if(addBusCounter(array(
                'manager' => $operator,
                'name' => $counter,
                'location' => $location,
                'type' => $type,
                'description' => $description
        ))) {
            addAlert([
                't' => 'success',
                'm' => $counter . ' Counter Added Successfully',
                'a' => 6000
            ], 'buscounter');
            header('location: buscounter.php');
            exit;
        }
    }
}

ob_start();
?>

<div class="block">
    <div class="header">
        <b>Add Bus Counter</b>
        <a href="buscounter.php" class="btn back red" title="Cancel"><span>Cancel</span></a>
    </div>
    <div class="body">
        <form action="addbuscounter.php" method="POST">
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
            <div class="grid">
                <div class="row">
                    <div class="column-6">
                        <div class="inputset<?php __errors($errors,'name',true) ?>">
                            <label for="name">Counter Name</label>
                            <input type="text" name="name" id="name" placeholder="Enter Counter Name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" size="24"><br/>
                            <?php __errors($errors, 'name') ?>
                        </div>
                    </div>
                    <div class="column-6">
                        <div class="inputset<?php __errors($errors,'counter_location',true) ?>">
                            <label for="counter_location">Counter Location</label>
                            <input type="text" name="counter_location" id="counter_location" placeholder="Enter full location" value="<?php echo isset($_POST['counter_location']) ? htmlspecialchars($_POST['counter_location']) : '' ?>" size="24"><br/>
                            <?php __errors($errors, 'counter_location') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid">
                <div class="row">
                    <div class="column-6">
                        <div class="inputset<?php __errors($errors,'counter_type',true) ?>">
                            <label for="counter_type">Counter Type</label>
                            <input type="text" name="counter_type" id="counter_type" placeholder="Enter Cunter Type" value="<?php echo isset($_POST['counter_type']) ? htmlspecialchars($_POST['counter_type']) : '' ?>" size="24"><br/>
                            <?php __errors($errors, 'counter_type') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid">
                <div class="row">
                    <div class="column-12">
                        <div class="inputset<?php __errors($errors,'description',true) ?>">
                            <label for="description">Description</label><br>
                            <textarea name="description" id="description" rows="4" cols="20"></textarea>
                            <?php __errors($errors, 'description') ?>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" class="btn submit" value="Add Counter">
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();

__visualize_backend(array(
	'title' => 'Add Bus Counter',
	'area' => 'buscounter',
	'data' => $content,
    'navigate'=> array(array('buscounter.php', 'Bus Counters')),
    'user' => $user,
    'validate' => $validate
));
disconnectDatabase();