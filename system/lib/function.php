<?php
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

require_once 'config.php';
require_once 'visualizer.php';
require_once 'database.php';

// HTML Select/Radio/Checkbox Selection Provider
function __selected($fixed, $variable, $type='select', $print=true, $strict=false)
{
	$flaq = $fixed==$variable?($strict?($fixed===$variable?true:false):true):false;
	
	if($print){
		if($type=='select')
		{
			echo $flaq?' selected':'';
		}
		else if($type=='checkbox' || $type=='radio')
		{
			echo $flaq?' checked':'';
		}
	}
	
	return $flaq;
}

// Form Errors Print Provider

function __errors(array $set, $hook, $label = false, $addon = ' field-error')
{
	if(isset($set[$hook]))
	{
		echo $label ? ' error' : '<img src="assets/img/danger.png" width="12px" height="12px" alt="[+]"> <span class="text-red'.$addon.'">' . $set[$hook] .'</span>';
	}
}

// Menu Visualizer
function __renderMenu($fixed, $variable, $ref, $title, $icon='assets/img/it.png')
{
    $c = '<li>';
	$c .= '<a href="'.$ref.'"'.($fixed==$variable?' class="active"':'').'>';
    $c .= '<img src="'.$icon.'"> ';
	$c .= $title;
	$c .= '</a>';
	$c .= '</li>';
	return $c;
}

// DateTime Formatter
function __formatDate($date, $output = "Y-m-d H:i:s", $input = 'Y-m-d H:i:s')
{
    $dObject = DateTime::createFromFormat($input, $date);
    return $dObject->format($output);
}


// Day - Month - Year Dropdown/Raw Serviece Provider
function dmyProvider($target='day', $option=false, $selected='')
{
	if($target=='day')
	{
		$days = array();

		for($i = 1; $i<=31; $i++)
		{
			$var = str_pad($i, 2, '0', STR_PAD_LEFT);

			if($option)
			{
				echo '<option value="'.$var.'"';  __selected($selected, $var); echo '>'.$i.'</option>';
			}
			else
			{
				array_push($days, $i);
			}
		}

		return !$option ? $days : array();
	}

	if($target=='month')
	{

		$months = array(
		    1 => 'January',
		    'February',
		    'March',
		    'April',
		    'May',
		    'June',
		    'July ',
		    'August',
		    'September',
		    'October',
		    'November',
		    'December',
		);

		foreach($months as $numeric => $alpha)
		{
			$var = str_pad($numeric, 2, '0', STR_PAD_LEFT);

			if($option)
			{
				echo '<option value="'.str_pad($var, 2, '0', STR_PAD_LEFT).'"';  __selected($selected, $var); echo '>'.$alpha.'</option>';
			}
		}

		return !$option ? $months : array();
	}

	if($target=='year')
	{
		$years = array();
		$currentYear = date("Y");
		$limit = 0;
		while($limit<100)
		{
			$var = $currentYear-$limit++;

			if($option)
			{
				echo '<option value="'.$var.'"';  __selected($selected, $var); echo '>'.$var.'</option>';
			}
			else
			{
				array_push($years, $var);
			}

		}


		return !$option ? $years : array();
	}
}

// Verify Does String Contains Allowed Characters
function verifyCharecter($str)
{
	$allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.- ';
	
	for($i = 0; $i<strlen($str); $i++)
	{
		if(strpos($allowed, $str[$i]) === false)
		{
			return false;
		}
	}
	
	return !empty($str) ? true : false;
}

// Generate Random String 
function randString($length = 10) 
{
    $charSet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $generated = '';
    for ($i = 0; $i < $length; $i++) {
        $generated .= $charSet[rand(0, strlen($charSet) - 1)];
    }
    return $generated;
}

//Day - Month - Year Verification Serviece Provider
function verifyDob($day, $month, $year)
{
	$max = date('Y');
	$min = $max-99;
	if( strlen($day)==2 && strlen($month)==2 && strlen($year)==4 )
	{
		if( is_numeric($day) && is_numeric($month) && is_numeric($year) )
		{
			if($day>=1 && $day<=31 && $month>=1 && $month<=12 && $year>=$min && $year<=$max)
			{
				return true;
			}
		}
	}
		
	return false;
}

// Alpha - Numeric String Verification Service Provider
function verifyAlphaNumeric($str)
{
	$alpha = 0; $numeric = 0;
	for($i=0; $i<strlen($str); $i++)
	{
		if(ctype_alpha($str[$i])) $alpha++;
		if(is_numeric($str[$i])) $numeric++;
	}

	return $alpha > 0 && $numeric > 0;
}

// File Read/Write Helper
function fileHandler($file, $type='read', $content='')
{
	if($lg = @fopen($file, 'x')) fclose($lg);

	$data = false;
	
	if($type=='read')
	{
		if($fStream = @fopen($file, 'r'))
		{
			$data = @fread($fStream, filesize($file));
			fclose($fStream);
		}
	}
	else if($type=='write')
	{
		if($fStream = @fopen($file, 'w'))
		{
			$data = fwrite($fStream, $content);
			fclose($fStream);
		}
	}

	return $data;
}

// Fetch All User From Lib File
function getAllUsers()
{
	global $__userLib;

	return (array) @json_decode(fileHandler($__userLib, 'read'), true);
}

// Fetch User By Email
function getUser($email)
{
	$users = getAllUsers();
	return isset($users[$email]) ? $users[$email] : false;
}

// Verify User Password
function verifyPassword($password, array $user)
{
	if(isset($user['password']))
	{
		return $user['password']==$password;
	}

	return false;
}

// Registration Service Provider
function registerUser(array $data)
{
	global $__userLib;
	return fileHandler($__userLib, 'write', @json_encode(array_merge(getAllUsers(), $data)));
}

// Fetch All User From Lib File
function getAllSession()
{
	global $__sessionLib;
	return (array) @json_decode(fileHandler($__sessionLib, 'read'), true);
}

// Fetch User Email By Session
function getEmailBySession($session)
{
	$sessions = getAllSession();
	return isset($sessions[$session]) ? $sessions[$session] : false;
}

// Add New Session Data
function pushSession($session, $email)
{
	global $__sessionLib;
	return fileHandler($__sessionLib, 'write', @json_encode(array_merge(getAllSession(), array($session => $email))));
}

// Remove Single Session Data
function popSession($session)
{
	global $__sessionLib;

	$sessions = getAllSession();
	if(isset($sessions[$session]))
	{
		unset($sessions[$session]);
		return fileHandler($__sessionLib, 'write', @json_encode($sessions));
	}
	return false;
}

// Generate New Session
function getSessionKey()
{
	return md5(randString().time());
}

//Update SSID (Session Cookie)
function setSessionCookie($session)
{
	// Keep Alive For Next 6 Hours
	setcookie(SESSION_COOKIE, $session, time()+21600);
}

//Destroy SSID (Session Cookie)
function destroySessionCookie()
{
	setcookie(SESSION_COOKIE, '', time()-300);
}

//
function verifyEmailAssigned($email)
{
	$users = getAllUsers();
	return isset($users[$email]);
}

//Verification Profider for Valid Authorization
function verifyLogin($session, $flaq = true)
{
	$sessions = getAllSession();
	if(!empty($session) && isset($sessions[$session]))
	{

		if(getUser($sessions[$session])!=false)
		{
			if($flaq)
			{
				setSessionCookie($session);
			}
			return true;
		} 
		else
		{
			popSession($session);
		}
	}

	if($flaq)
	{
		destroySessionCookie();
	}

	return false;
}

//Fetch Session Cookie
function getSessionCookie()
{
	return isset($_COOKIE[SESSION_COOKIE]) ? $_COOKIE[SESSION_COOKIE] : false;
}