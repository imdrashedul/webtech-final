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
if(!defined('BTRS_DB_SERV')) define('BTRS_DB_SERV', 'webtech-final');
if(!defined('BTRS_DB_NAME')) define('BTRS_DB_NAME', 'webtech-final');
if(!defined('BTRS_DB_USER')) define('BTRS_DB_USER', 'root');
if(!defined('BTRS_DB_PASS')) define('BTRS_DB_PASS', 'root');

$__userLib = 'lib/users.lib';
$__sessionLib = 'lib/sessions.lib';
$__sessionCookie = 'BTRSSID';