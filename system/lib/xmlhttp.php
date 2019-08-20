<?php
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

require_once 'function.php';

function listenXMLHttp($restriction=false)
{
    $response = array(
        'status' => false,
        'message' => 'UNKNOWN REQUEST'
    );

    $wildcard = '__BTRSXMLHttp__';
    $handshake = $restriction ? '__BTRSXMLHttp_restrict_' : $wildcard;

    connectDatabase();

    if(isset($_POST) && isset($_POST['context']) && isXMLHttp())
    {
        if($restriction && (!($token = getSessionCookie()) || !verifyLogin($token, true)))
        {
            $response['message'] = "AUTHORIZATION FAILED";
        }
        else if(function_exists($handshake.$_POST['context']))
        {
            call_user_func_array($handshake.$_POST['context'], array($_POST, &$response));
        }
        else if($restriction && function_exists($wildcard.$_POST['context']))
        {
            call_user_func_array($wildcard.$_POST['context'], array($_POST, &$response));
        }
    }

    disconnectDatabase();
    respond($response);
}

function __BTRSXMLHttp_restrict_getCounters(array $request, array &$response)
{
    if(isset($request['operator']) && getUserById($request['operator']))
    {
        $token = getSessionCookie();
        $user = getUserBySession($token);

        if(accessController($user['role'], BTRS_ROLE_ADMIN, BTRS_ROLE_SUPPORT_STAFF) || ( $user['role'] == BTRS_ROLE_BUS_MANAGER && $user['id'] == $request['operator']))
        {
            $list = listBusCounters($request['operator'], (isset($request['selected'])?$request['selected']:''));
            $response['status'] = true;
            $response['message'] = empty($list) ? "<option value=\"\">No data found</option>" : "<option value=\"\">Select</option>".$list;
        }
        else
        {
            $response['message'] = "ACCESS FORBIDDEN";
        }
    }
    else
    {
        $response['message'] = "Operator not found or Invalid";
    }
}

function __BTRSXMLHttp_restrict_getBuses(array $request, array &$response)
{
    if(isset($request['operator']) && getUserById($request['operator']))
    {
        $token = getSessionCookie();
        $user = getUserBySession($token);

        if(accessController($user['role'], BTRS_ROLE_ADMIN, BTRS_ROLE_SUPPORT_STAFF) || ( $user['role'] == BTRS_ROLE_BUS_MANAGER && $user['id'] == $request['operator']))
        {
            $list = listBuses($request['operator'], (isset($request['selected'])?$request['selected']:''));
            $response['status'] = true;
            $response['message'] = empty($list) ? "<option value=\"\">No data found</option>" : "<option value=\"\">Select</option>".$list;
        }
        else
        {
            $response['message'] = "ACCESS FORBIDDEN";
        }
    }
    else
    {
        $response['message'] = "Operator not found or Invalid";
    }
}

function __BTRSXMLHttp__getPublicBooking(array $request, array &$response)
{
    if(isset($request['schedule']) && !empty($request['schedule']) && ($schedule = getScheduleById($request['schedule'])))
    {
        $bus = getBusById($schedule['busid']);
        $booked = getBookedSeatsBySchedule($schedule['id']);

        ob_start();
        ?>
        <td colspan="5">
            <div class="booking-area-title">Choose your seat(s)</div>
            <div class="booking-area" fare="<?= $schedule['fare'] ?>">
                <div>
                    <div>Hold the cursor on seats for seat numbers, click to select or deselect</div>
                    <?= generateBusLayout($bus, $booked) ?>
                </div>
                <div>
                    <div class="seats-notation">
                        <div>
                            <span class="seat available"></span> Available Seats
                        </div>
                        <div>
                            <span class="seat booked"></span> Booked Seats
                        </div>
                        <div>
                            <span class="seat selected"></span> Selected Seats
                        </div>
                    </div>
                    <div class="selected-seats">
                        <div>
                            <table>
                                <thead>
                                <tr>
                                    <th>Seats</th>
                                    <th>Fare</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="selected-total">
                        Total: <span>00.00</span>
                    </div>
                    <div class="checkout-confirm">
                        <form action="checkout.php" method="post">
                            <input type="hidden" name="schedule" value="<?= $schedule['id'] ?>">
                            <input type="submit" name="submit_checkout" value="Continue">
                            <input type="button" name="close_area" value="Close">
                        </form>
                    </div>
                </div>
            </div>
        </td>
        <?php
        $panel = ob_get_clean();
        $response['status'] = true;
        $response['message'] = $panel;
    }
    else
    {
        $response['message'] = "Schedule not found or Invalid";
    }
}

function respond($response)
{
    header('Content-Type: application/json');
    echo json_encode($response);
}

function isXMLHttp()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
