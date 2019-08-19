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
            $response['status'] = true;
            $response['message'] = "<option value=\"\">Select</option>".listBusCounters($request['operator'], (isset($request['selected'])?$request['selected']:''));
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

function respond($response)
{
    header('Content-Type: application/json');
    echo json_encode($response);
}

function isXMLHttp()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}
