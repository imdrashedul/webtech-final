<?php
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

$connection = null;

/**
 * @return mysqli|null
 */
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
/**
 * @param $email
 * @return bool
 */
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
/**
 * @param $id
 * @return array|null
 */
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

/**
 * @param $email
 * @return array|null
 */
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
/**
 * @param $token
 * @return array|null
 */
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
/**
 * @param $token
 * @param $userid
 * @return bool|int
 */
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
/**
 * @param $token
 * @return bool|int
 */
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
/**
 * @param $token
 * @return bool|int
 */
function modifySessionValidity($token)
{
    global $connection;

    $time = date('Y-m-d H:i:s', time()+BTRS_SESSION_ALIVE);
    $query = "UPDATE ".BTRS_DB_PREFIX.BTRS_TB_AUTHSESSION." SET `expire` = ? WHERE `token` = ?";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'ss', $time, $token);
        mysqli_stmt_execute($stmt);
        return mysqli_affected_rows($connection);
    }
    return false;
}

/**
 * @return bool|int
 */
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

/**
 * @param array $data
 * @return bool|int|string
 */
function addUser(array $data)
{
    global $connection;

    $query = "INSERT INTO ".BTRS_DB_PREFIX.BTRS_TB_USERS."( `email`, `password`, `gender`, `role`, `validate`, `registered` ) VALUES ( ?, ?, ?, ?, ?, ? )";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param(
                $stmt,
                'sssiis',
                $data['email'],
                $data['password'],
                $data['gender'],
                $data['role'],
                $data['validate'],
                $data['registered']
        );

        if(mysqli_stmt_execute($stmt))
        {
            if(mysqli_affected_rows($connection))
            {
                return mysqli_insert_id($connection);
            }
        }

    }
    return false;

}

/**
 * @param array $details
 * @return bool
 */
function addUserDetails(array $details)
{
    global $connection;

    $query = "INSERT INTO ".BTRS_DB_PREFIX.BTRS_TB_USERDETAILS."(`userid`, `type`, `data`) VALUES ( ?, ?, ? )";
    if($stmt = mysqli_prepare($connection, $query))
    {
        $insert = 0;
        foreach ($details as $detail)
        {
            mysqli_stmt_bind_param( $stmt, 'iss', $detail[0], $detail[1], $detail[2]);
            if(mysqli_stmt_execute($stmt))
            {
                if(mysqli_affected_rows($connection))
                {
                   $insert++;
                }
            }
        }
        return ($insert==count($details));
    }
    return false;
}

/**
 * @param $id
 * @return bool
 */
function isValidUser($id)
{
    global $connection;

    $query = "SELECT * FROM ".BTRS_DB_PREFIX.BTRS_TB_USERS." WHERE `id` = ? ORDER BY `id` DESC LIMIT 0, 1";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        if(mysqli_stmt_execute($stmt))
        {
            if($response = mysqli_stmt_get_result($stmt))
            {
                if($row = mysqli_fetch_assoc($response))
                {
                    if(is_array($row) && !empty($row))
                    {
                        return $row['validate']==1;
                    }
                }
            }
        }
    }
    return false;
}

/**
 * @param $userid
 * @param $type
 * @param bool $flaq
 * @return bool|mixed|string
 */
function getUserDetails($userid, $type, $flaq=false)
{
    global $connection;

    $query = "SELECT * FROM ".BTRS_DB_PREFIX.BTRS_TB_USERDETAILS." WHERE `userid` = ? AND `type` = ? ORDER BY `id` DESC LIMIT 0, 1";
    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'is', $userid, $type);
        if(mysqli_stmt_execute($stmt))
        {
            if($response = mysqli_stmt_get_result($stmt))
            {
                if($row = mysqli_fetch_assoc($response))
                {
                    if(is_array($row) && !empty($row))
                    {
                        return $flaq ? true : $row['data'];
                    }
                }
            }
        }
    }
    return $flaq ? false : '';
}

/**
 * @param $userid
 * @param $type
 * @param $data
 * @return bool|int
 */
function updateUSerDetails($userid, $type, $data)
{
    if(getUserDetails($userid, $type, true))
    {
        global $connection;

        $query = "UPDATE ".BTRS_DB_PREFIX.BTRS_TB_USERDETAILS." SET `data` = ? WHERE `userid` = ? AND `type` = ?";

        if($stmt = mysqli_prepare($connection, $query))
        {
            mysqli_stmt_bind_param($stmt, 'ss', $time, $token);
            if(mysqli_stmt_execute($stmt))
            {
                return mysqli_affected_rows($connection);
            }
        }

        return false;
    }
    else return addUserDetails(array($userid, $type, $data));
}

function totalElement($table)
{
    global $connection;

    $query = "SELECT COUNT(*) FROM ".BTRS_DB_PREFIX.$table;

    if($result = mysqli_query($connection, $query))
    {
        if($row = mysqli_fetch_row($result))
        {
            return isset($row[0]) ? $row[0] : 0;
        }
    }
    return 0;
}

function totalUsersByRole($role)
{
    global $connection;

    $query = "SELECT COUNT(*) FROM ".BTRS_DB_PREFIX.BTRS_TB_USERS." WHERE `role` = ?";

    if($stmt = mysqli_prepare($connection, $query))
    {
        mysqli_stmt_bind_param($stmt, 'i', $role);
        if(mysqli_stmt_execute($stmt))
        {
            if($response = mysqli_stmt_get_result($stmt))
            {
                if($row = mysqli_fetch_row($response))
                {
                    return (isset($row[0]) && $row[0]>0);
                }
            }
        }

    }

    return 0;
}

function getAllBusManager($offset=0, $limit=0)
{
    global $connection;

    $query = "SELECT * FROM " . BTRS_DB_PREFIX.BTRS_TB_USERS . " WHERE `role` = ? ORDER BY `id` DESC ".( $limit>0 ? "LIMIT ?, ?" : "" );
    $role = BTRS_ROLE_BUS_MANAGER;
    $users = array();

    if($stmt = mysqli_prepare($connection, $query))
    {

        if($limit>0)
        {
            mysqli_stmt_bind_param($stmt, 'iii', $role, $offset, $limit);
        }
        else
        {
            mysqli_stmt_bind_param($stmt, 'i', $role);
        }

        if(mysqli_stmt_execute($stmt))
        {
            if($response = mysqli_stmt_get_result($stmt))
            {
                if(mysqli_num_rows($response)>0)
                {
                    while ($row = mysqli_fetch_assoc($response))
                    {
                        $users[] = $row;
                    }
                }
            }
        }
    }

    return $users;
}


