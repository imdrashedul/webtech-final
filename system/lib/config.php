<?php
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

// Cookie Name
if(!defined('SESSION_COOKIE')) define('SESSION_COOKIE', 'BTRSSID');

// Database Config
if(!defined('BTRS_DB_PREFIX')) define('BTRS_DB_PREFIX', 'webtech_');
if(!defined('BTRS_TB_USERS')) define('BTRS_TB_USERS', 'users');
if(!defined('BTRS_TB_USERDETAILS')) define('BTRS_TB_USERDETAILS', 'userdetails');
if(!defined('BTRS_TB_AUTHSESSION')) define('BTRS_TB_AUTHSESSION', 'authsession');

// Session Alive For Next * Minutes
if(!defined('BTRS_SESSION_ALIVE')) define('BTRS_SESSION_ALIVE', 21600);

$__userLib = 'lib/users.lib';
$__sessionLib = 'lib/sessions.lib';
$__sessionCookie = 'BTRSSID';