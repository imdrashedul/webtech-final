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

// File Upload Config
if(!defined('BTRS_UPLOAD_LIMIT')) define('BTRS_UPLOAD_LIMIT', 2048);
if(!defined('BTRS_UPLOAD_PATH')) define('BTRS_UPLOAD_PATH', realpath(dirname(__DIR__) . '/uploads/'));
if(!defined('BTRS_UPLOAD_URI')) define('BTRS_UPLOAD_URI', getUrlDir(BTRS_UPLOAD_PATH));

// User Roles Constants
if(!defined('BTRS_ROLE_ADMIN')) define('BTRS_ROLE_ADMIN', 4);
if(!defined('BTRS_ROLE_SUPPORT_STAFF')) define('BTRS_ROLE_SUPPORT_STAFF', 3);
if(!defined('BTRS_ROLE_BUS_MANAGER')) define('BTRS_ROLE_BUS_MANAGER', 2);
if(!defined('BTRS_ROLE_COUNTER_STAFF')) define('BTRS_ROLE_COUNTER_STAFF', 1);

// Default Validation
if(!defined('BTRS_VALIDATION')) define('BTRS_VALIDATION', 0); // 0 Manual //1 Auto

$__userLib = 'lib/users.lib';
$__sessionLib = 'lib/sessions.lib';
$__sessionCookie = 'BTRSSID';