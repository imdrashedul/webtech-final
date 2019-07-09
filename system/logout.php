<?php
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */
require_once 'lib/function.php';

$sessionCookie = false;

if(($sessionCookie = getSessionCookie()) && verifyLogin($sessionCookie, false))
{
	popSession($sessionCookie);
	destroySessionCookie();
}

header('location: login.php');
