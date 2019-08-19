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
        <b>Add Bus Schedule</b>
        <a href="busschedule.php" class="btn back red" title="Cancel"><span>Cancel</span></a>
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
				<div class="column-12">
					<div class="inputset<?php __errors($errors,'bus',true) ?>">
                        <label for="bus">Bus</label>
                        <select name="bus" id="bus">
                            <option value="">Select</option>
                            <option value="DHA-58109">Hyundai Universe [DHA-58109]</option>
                            <option value="DHA-57203">Hyundai Universe [DHA-57203]</option>
                            <option value="DHA-12501">Scania [DHA-12501]</option>
                            <option value="DHA-64808">AK1J Super Plus [DHA-64808]</option>
                        </select><br>
                        <?php __errors($errors, 'bus') ?>
					</div>
				</div>
			</div>
		</div>
		<div class="grid">
            <div class="row">
				<div class="column-6">
					<div class="inputset<?php __errors($errors,'route',true) ?>">
                        <label for="route">Route</label><br>
                        <input type="text" name="route" id="route" placeholder="Enter Route" value="<?php echo isset($_POST['route']) ? htmlspecialchars($_POST['route']) : '' ?>" size="24"><br/>
                        <?php __errors($errors, 'route') ?>
					</div>
				</div>
				<div class="column-6">
					<div class="inputset<?php __errors($errors,'seat_price',true) ?>">
                        <label for="seat_price">Price Per Seat</label><br>
                        <input type="text" name="seat_price" id="seat_price" placeholder="Enter Per Seat Price" value="<?php echo isset($_POST['seat_price']) ? htmlspecialchars($_POST['seat_price']) : '' ?>" size="24"><br/>
                        <?php __errors($errors, 'seat_price') ?>
                    </div>
				</div>
			</div>
		</div>
        <div class="grid">
            <div class="row">
				<div class="column-6">
				    <div class="inputset<?php __errors($errors,'departure',true) ?>">
                        <label for="departure">Departure</label><br>
                        <input type="text" name="departure" id="departure" placeholder="Enter Departure Time/Date" value="<?php echo isset($_POST['departure']) ? htmlspecialchars($_POST['departure']) : '' ?>" size="24"><br/>
                        <?php __errors($errors, 'departure') ?>
					</div>
				</div>
				<div class="column-6">
				    <div class="inputset<?php __errors($errors,'arrival',true) ?>">
                        <label for="arrival">Arrival</label><br>
                        <input type="text" name="arrival" id="arrival" placeholder="Enter Arrival Time/Date" value="<?php echo isset($_POST['arrival']) ? htmlspecialchars($_POST['arrival']) : '' ?>" size="24"><br/>
                        <?php __errors($errors, 'arrival') ?>
					</div>
				</div>
			</div>
		</div>
		<div class="grid">
            <div class="row">
				<div class="column-12">
					<div class="inputset<?php __errors($errors,'description',true) ?>">
                        <label for="description">Description</label><br>
                        <textarea name="description" rows="5"></textarea>
                    </div>
				</div>
			</div>
		</div>
        <input type="submit" name="submit" class="btn submit" value="Add Schedule">
	</div>
</div>

<?php
$content = ob_get_clean();
ob_start();
?>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    flatpickr(document.querySelector('input[type="text"][name="departure"]'), {});
    flatpickr(document.querySelector('input[type="text"][name="arrival"]'), {});
});
</script>
<?php
$script = ob_get_clean();


__visualize_backend(array(
	'title' => 'Add Bus Schedule',
	'area' => 'busschedule',
    'navigate'=> array(array('busschedule.php', 'Bus Schedules')),
	'data' => $content,
    'user' => $user,
    'validate' => $validate,
	'javascript' => $script
));

disconnectDatabase();
