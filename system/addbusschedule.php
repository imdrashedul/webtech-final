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
    $bus = isset($_POST['bus']) ? $_POST['bus'] : '';
    $boarding = isset($_POST['bus_counter']) ? $_POST['bus_counter'] : '';
    $rfrom = isset($_POST['route_from']) ? trim($_POST['route_from']) : '';
    $rto = isset($_POST['route_to']) ? trim($_POST['route_to']) : '';
    $fare = isset($_POST['seat_price']) ? trim($_POST['seat_price']) : '';
    $departure = isset($_POST['departure']) ? $_POST['departure'] : '';
    $arrival = isset($_POST['arrival']) ? $_POST['arrival'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';

    // Validation Set Of 'Bus'
    if(empty($bus))
    {
        $errors['bus'] = 'Cannot be empty';
    }
    else if (!($__b =getBusById($bus)) || $__b['manager']!=$operator)
    {
        $errors['bus'] = 'Bus not Found';
    }

    // Validation Set Of 'Boarding Point'
    if(empty($boarding))
    {
        $errors['bus_counter'] = 'Cannot be empty';
    }
    else if (!($__c = getCounterById($boarding)) || $__c['manager']!=$operator)
    {
        $errors['bus_counter'] = 'Counter not Found';
    }

    // Validation Set Of 'Routes'
    if(empty($rfrom) || empty($rto))
    {
        $errors['route'] = 'Cannot be empty';
    }

    // Validation Set of Fare
    if(empty($fare))
    {
        $errors['seat_price'] = 'Cannot be empty';
    }
    else if(!($fare>=50))
    {
        $errors['seat_price'] = 'Fare must be greater tha 50 BDT';
    }

    // Validation Set Of 'Departure'
    if(empty($departure))
    {
        $errors['departure'] = 'Cannot be empty';
    }
    else if (!__validDate($departure))
    {
        $errors['departure'] = 'Invalid Date/Time ';
    }

    // Validation Set Of 'Arrival'
    if(empty($arrival))
    {
        $errors['arrival'] = 'Cannot be empty';
    }
    else if (!__validDate($arrival))
    {
        $errors['arrival'] = 'Invalid Date/Time';
    }

    if(empty($errors))
    {
        if(validScheduleSlot($departure, $arrival))
        {
            $route = $rfrom . ' - ' . $rto;

            if(!isConflictSchedule($bus, $departure, $route))
            {
                if(addSchedule(array(
                    'busid' => $bus,
                    'departure' => $departure,
                    'arrival' => $arrival,
                    'route' => $route,
                    'fare' => $fare,
                    'boarding' => $boarding,
                    'created' => date('Y-m-d H:i:s'),
                    'description' => $description
                ))) {
                    addAlert([
                        't' => 'success',
                        'm' => 'Schedule Added Successfully ['.$route.']',
                        'a' => 6000
                    ], 'busschedule');
                    header('location: busschedule.php');
                    exit;
                }
            }
            else
            {
                addAlert([
                    't' => 'danger',
                    'm' => 'Schedule Conflict Occurred',
                    'a' => 6000
                ], 'addbusschedule');
            }
        }
        else
        {
            addAlert([
                't' => 'danger',
                'm' => 'Schedule Slot Invalid. At least 1 Hour Interval is required',
                'a' => 6000
            ], 'addbusschedule');
        }

    }
}

ob_start();
?>
<?php flushAlert('addbusschedule') ?>
<div class="block">
    <div class="header">
        <b>Add Bus Schedule</b>
        <a href="busschedule.php" class="btn back red" title="Cancel"><span>Cancel</span></a>
    </div>
    <div class="body">
        <form action="addbusschedule.php" method="POST">
            <?php if(accessController($user['role'], BTRS_ROLE_SUPPORT_STAFF, BTRS_ROLE_ADMIN)) : ?>
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
                        <div class="inputset<?php __errors($errors,'bus',true) ?>">
                            <label for="bus">Bus</label>
                            <select name="bus" id="bus">
                                <?php if(accessController($user['role'], BTRS_ROLE_BUS_MANAGER)) : ?>
                                <option value="">Select</option>
                                <?= listBuses($user['id'], (isset($_POST['bus']) ? $_POST['bus'] : '')) ?>
                                <?php elseif(isset($_POST['bus_operator']) && !empty($_POST['bus_operator'])) : ?>
                                <option value="">Select</option>
                                <?= listBuses($_POST['bus_operator'], (isset($_POST['bus']) ? $_POST['bus'] : '')) ?>
                                <?php else: ?>
                                <option value="">Select Operator First</option>
                                <?php endif; ?>
                            </select><br>
                            <?php __errors($errors, 'bus') ?>
                        </div>
                    </div>
                    <div class="column-6">
                        <div class="inputset<?php __errors($errors,'bus_counter',true) ?>">
                            <label for="bus_counter">Boarding</label><br>
                            <select name="bus_counter" id="bus_counter">
                                <?php if(accessController($user['role'], BTRS_ROLE_BUS_MANAGER)) : ?>
                                    <option value="">Select</option>
                                    <?= listBusCounters($user['id'], (isset($_POST['bus_counter']) ? $_POST['bus_counter'] : '')) ?>
                                <?php elseif(isset($_POST['bus_operator']) && !empty($_POST['bus_operator'])) : ?>
                                    <option value="">Select</option>
                                    <?= listBusCounters($_POST['bus_operator'], (isset($_POST['bus_counter']) ? $_POST['bus_counter'] : '')) ?>
                                <?php else: ?>
                                    <option value="">Select Operator First</option>
                                <?php endif; ?>
                            </select><br>
                            <?php __errors($errors, 'bus_counter') ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid">
                <div class="row">
                    <div class="column-6">
                        <div class="inputset<?php __errors($errors,'route',true) ?>">
                            <label for="route">Route</label><br>
                            <div style="width: 48.5%">
                            <input type="text" name="route_from" id="route_from" placeholder="From" value="<?php echo isset($_POST['route_from']) ? htmlspecialchars($_POST['route_from']) : '' ?>">
                            </div>
                            <div style="width: 48.5%; float: right">
                                <input type="text" name="route_to" id="route" placeholder="To" value="<?php echo isset($_POST['route_to']) ? htmlspecialchars($_POST['route_to']) : '' ?>">
                            </div>
                            <?php __errors($errors, 'route') ?>
                        </div>
                    </div>
                    <div class="column-6">
                        <div class="inputset<?php __errors($errors,'seat_price',true) ?>">
                            <label for="seat_price">Fare</label><br>
                            <input type="text" name="seat_price" id="seat_price" placeholder="Enter Per Seat Price" value="<?php echo isset($_POST['seat_price']) ? htmlspecialchars($_POST['seat_price']) : '' ?>"><br/>
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
                            <input type="text" name="departure" id="departure" placeholder="Enter Departure Time/Date" value="<?php echo isset($_POST['departure']) ? htmlspecialchars($_POST['departure']) : '' ?>"><br/>
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
                            <textarea name="description" id="description" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" name="submit" class="btn submit" value="Add Schedule">
        </form>
	</div>
</div>

<?php
$content = ob_get_clean();
ob_start();
?>
<script type="text/javascript">
var __routes = <?= json_encode(__getRoutesSuggesion()) ?>;
document.addEventListener('DOMContentLoaded', function() {
    <?php if(accessController($user['role'], BTRS_ROLE_SUPPORT_STAFF, BTRS_ROLE_ADMIN)) : ?>
    document.querySelector('select[name="bus_operator"]').addEventListener('change', function (e) {
        var bus = document.querySelector('select[name="bus"]');
        var counter = document.querySelector('select[name="bus_counter"]');
        if(this.value)
        {
            getBuses(bus, {
                'operator' : this.value
            });

            getCounters(counter, {
                'operator' : this.value
            });
        }
        else
        {
            bus.innerHTML = '<option value="">Select Operator First</option>';
            counter.innerHTML = '<option value="">Select Operator First</option>';
        }
    });
    <?php endif; ?>
    __autocomplete(document.querySelector('input[type="text"][name="route_from"]'), __routes);

    __autocomplete(document.querySelector('input[type="text"][name="route_to"]'), __routes);

    flatpickr(document.querySelector('input[type="text"][name="departure"]'), {
        altInput: true,
        enableTime: true,
        altFormat: "d/m/Y h:i K",
        dateFormat: "Y-m-d H:i:S",
        minDate: "today"
    });
    flatpickr(document.querySelector('input[type="text"][name="arrival"]'), {
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
	'title' => 'Add Bus Schedule',
	'area' => 'busschedule',
    'navigate'=> array(array('busschedule.php', 'Bus Schedules')),
	'data' => $content,
    'user' => $user,
    'validate' => $validate,
	'javascript' => $script
));

disconnectDatabase();
