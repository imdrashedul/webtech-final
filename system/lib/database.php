<?php
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

$connection = null;

function connectDatabase()
{
    global $connection;

    //SERVER CONFIG
    $host = 'localhost';
    $port = '3306';
    $sock = '';

    //DATABASE CONFIG
    $database = 'webtech_final';
    $username = 'root';
    $password = '';

    if($connection = mysqli_connect($host, $username, $password, $database, $port, $sock))
    {
        return $connection;
    }

    execConnectionError();
    die();
}

function disconnectDatabase()
{
    global $connection;

    if($connection)
    {
        mysqli_close($connection);
    }
}

function execConnectionError()
{
    ?>
    <h3>WE COULDN'T ESTABLISH DATABASE CONNECTION</h3>
    <?php
}

//
function verifyEmailAssigned($email)
{
    global $connection;

    $query = "SELECT COUNT(*) FROM ".BTRS_DB_PREFIX.BTRS_TB_USERS." WHERE `email` = ?";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        if($response = mysqli_stmt_get_result($stmt))
        {
            if($row = mysqli_fetch_row($response))
            {
                return (isset($row[0]) && $row[0]>0);
            }
        }
    }
    return false;
}

// Fetch User By Email
function getUserById($id)
{
    global $connection;

    $query = "SELECT * FROM ".BTRS_DB_PREFIX.BTRS_TB_USERS." WHERE `id` = ? ORDER BY `id` DESC";

    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        if($response = mysqli_stmt_get_result($stmt))
        {
            if($row = mysqli_fetch_assoc($response))
            {
                if(is_array($row) && !empty($row))
                {
                    return $row;
                }
            }
        }
    }

    return null;
}

function getUserByEmail($email)
{
    global $connection;

    $query = "SELECT * FROM ".BTRS_DB_PREFIX.BTRS_TB_USERS." WHERE `email` = ? ORDER BY `id` DESC";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        if($response = mysqli_stmt_get_result($stmt))
        {
            if($row = mysqli_fetch_assoc($response))
            {
                if(is_array($row) && !empty($row))
                {
                    return $row;
                }
            }
        }
    }

    return null;
}

// Fetch Session Data
function getSession($token)
{
    global $connection;

    $query = "SELECT * FROM ".BTRS_DB_PREFIX.BTRS_TB_AUTHSESSION." WHERE `token` = ? ORDER BY `id` DESC LIMIT 0, 1";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 's', $token);
        mysqli_stmt_execute($stmt);
        if($response = mysqli_stmt_get_result($stmt))
        {
            if($row = mysqli_fetch_assoc($response))
            {
                if(is_array($row) && !empty($row))
                {
                    return $row;
                }
            }
        }
    }

    return null;
}

// Add New Session Data
function pushSession($token, $userid)
{
    global $connection;

    $expire = date('Y-m-d H:i:s', time()+BTRS_SESSION_ALIVE);
    $query = "INSERT INTO ".BTRS_DB_PREFIX.BTRS_TB_AUTHSESSION."( `userid`, `token`, `expire` ) VALUES ( ?, ?, ? )";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'iss', $userid, $token, $expire);
        mysqli_stmt_execute($stmt);
        return mysqli_affected_rows($connection);
    }
    return false;
}


// Remove Session Data
function popSession($token)
{
    global $connection;

    $query = "DELETE FROM ".BTRS_DB_PREFIX.BTRS_TB_AUTHSESSION." WHERE `token` = ?";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 's', $token);
        mysqli_stmt_execute($stmt);
        return mysqli_affected_rows($connection);
    }

    return false;
}

// Update Session Data
function modifySessionValidity($token)
{
    global $connection;

    $time = date('Y-m-d H:i:s', time()+BTRS_SESSION_ALIVE);
    $query = "UPDATE ".BTRS_DB_PREFIX.BTRS_TB_AUTHSESSION." SET `expire` = ? WHERE `token` = ? ORDER BY `id` DESC";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'ss', $time, $token);
        mysqli_stmt_execute($stmt);
        return mysqli_affected_rows($connection);
    }
    return false;
}

function cleanExpiredSession()
{
    global $connection;

    $time = date('Y-m-d H:i:s', time());
    $query = "DELETE FROM ".BTRS_DB_PREFIX.BTRS_TB_AUTHSESSION." WHERE `expire` < ?";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 's', $time);
        mysqli_stmt_execute($stmt);
        return mysqli_affected_rows($connection);
    }

    return false;
}

