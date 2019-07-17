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

// __DIR__ to URL Converter
function getUrlDir($dir)
{
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}";
    $dir = str_replace('\\', '/', $dir);
    $dir = str_replace($_SERVER["DOCUMENT_ROOT"], '', $dir);
    return rtrim($url.$dir, '/') . '/';
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


// Verify User Password
function verifyPassword($password, array $user)
{
	if(isset($user['password']))
	{
		return password_verify($password, $user['password']);
	}

	return false;
}

// Fetch All User From Lib File
function getAllSession()
{
	global $__sessionLib;
	return (array) @json_decode(fileHandler($__sessionLib, 'read'), true);
}


// Generate New Session
function getSessionToken()
{
	return md5(randString().time());
}

//Update SSID (Session Cookie)
function setSessionCookie($session)
{
	// Keep Alive For Next 6 Hours
	setcookie(SESSION_COOKIE, $session, time()+BTRS_SESSION_ALIVE);
}

//Destroy SSID (Session Cookie)
function destroySessionCookie()
{
	setcookie(SESSION_COOKIE, '', time()-300);
}

//Fetch Session Cookie
function getSessionCookie()
{
    cleanExpiredSession();
	return isset($_COOKIE[SESSION_COOKIE]) ? $_COOKIE[SESSION_COOKIE] : false;
}

// Fetch User Email By Session
function getUserBySession($token)
{
    return ($session = getSession($token)) && $session['userid'] ? getUserById($session['userid']) : null;
}

//Verification Profider for Valid Authorization
function verifyLogin($token, $flaq = true)
{

    if(getUserBySession($token))
    {
        if($flaq)
        {
            modifySessionValidity($token);
            setSessionCookie($token);
        }
        return true;
    }
    else
    {
        popSession($token);
    }

    if($flaq)
    {
        destroySessionCookie();
    }

    return false;
}

//Clean Mobile Number
function cleanBDMobile($number)
{
    $cleaned = '';

    if(!empty($number))
    {
        //Remove all the white space from the string
        $cleaned = str_replace(' ', '', $number);

        //Remove all the - from the string
        $cleaned = str_replace('-', '', $cleaned);

        //Check for the pattern(+880)/(+88) Exists, then remove it
        $cleaned = ($pos = strpos($cleaned, ')')) ? substr($cleaned, $pos+1) : $cleaned;

        //Remove all unexpected character
        $cleaned = str_replace('(', '', $cleaned);
        $cleaned = str_replace(')', '', $cleaned);

        //Check for the pattern +88 Exists then remove it
        $cleaned = substr($cleaned, 0, 3) == '+88' ? substr($cleaned, 3) : $cleaned;

        //Remove all + character if not removed by any chance
        $cleaned = str_replace('+', '', $cleaned);

        //Check for number is less than 11 digit and there is no 0 before string, then simply add it
        $cleaned = strlen($cleaned)<11 && $cleaned[0]==0 ? '0'.$cleaned : $cleaned;
    }

    return $cleaned;
}

function verifyImageType($file)
{
    if(isset($file['tmp_name']) && !empty($file['tmp_name']))
    {
        $allowed = array(
            IMAGETYPE_JPEG,
            IMAGETYPE_PNG,
            IMAGETYPE_GIF
        );

        if($imageDetails = getimagesize($file['tmp_name']))
        {
            return (isset($imageDetails[2]) && in_array($imageDetails[2], $allowed));
        }
    }

    return false;
}

function verifyImageSize($file)
{
    if(isset($file['size']) && $file['size']>0)
    {
        return ($file['size']/1024)<BTRS_UPLOAD_LIMIT;
    }
    return false;
}


//Valid Mobile Number
function verifyBDMobile($number)
{
    if(!empty($number))
    {
        $operators = array('017', '018', '019', '015', '016', '013');
        $number = cleanBDMobile($number);
        if(strlen($number)==11)
        {
            foreach ($operators as $operator)
            {
                if($operator==substr($number, 0, 3))
                {
                    return true;
                }
            }
        }
    }

    return false;
}

function generateNewFileName($file)
{
    $filename = null;

    if(isset($file['name']) && !empty($file['name']))
    {
        if($ext = pathinfo($file['name'], PATHINFO_EXTENSION))
        {
            $filename = md5(time().randString()) . '.' . $ext;
        }
    }

    return $filename;
}

function uploadFile($file)
{
    $filename = '';

    if(isset($file['tmp_name']) && !empty($file['tmp_name']))
    {
        if($filename = generateNewFileName($file))
        {
            $path = BTRS_UPLOAD_PATH .'/'. $filename;

            if(is_dir(BTRS_UPLOAD_PATH) && !file_exists($path))
            {
                if(!move_uploaded_file($file['tmp_name'], $path))
                {
                    $filename = '';
                }
            }
        }

    }

    return $filename;
}

// Company Registration Service Provider
function registerCompany(array $data)
{
    //Personal Information
    $fname = isset($data['first_name']) ? trim($data['first_name']) : '';
    $lname = isset($data['last_name']) ? trim($data['last_name']) : '';
    $dobDay = isset($data['dob_day']) ? $data['dob_day'] : '';
    $dobMonth = isset($data['dob_month']) ? $data['dob_month'] : '';
    $dobYear = isset($data['dob_year']) ? $data['dob_year'] : '';
    $gender = isset($data['gender']) ? $data['gender'] : 'm';
    $marital = isset($data['marital_status']) ? $data['marital_status'] : '';
    $nidpassport = isset($data['nid_passport']) ? $data['nid_passport'] : '';
    $photograph = isset($data['photograph']) ? uploadFile($data['photograph']) : '';
    $dob = $dobYear . '-' . $dobMonth . '-' . $dobDay;

    //Contact Information
    $street = isset($data['street']) ? $data['street'] : '';
    $mobile = isset($data['mobile']) ? cleanBDMobile($data['mobile']) : '';
    $city = isset($data['city']) ? $data['city'] : '';
    $zip = isset($data['zip']) ? $data['zip'] : '';
    $country = isset($data['country']) ? $data['country'] : '';

    //Company Information
    $companyName = isset($data['company_name']) ? $data['company_name'] : '';
    $companyStreet = isset($data['company_street']) ? $data['company_street'] : '';
    $companyLicense = isset($data['business_license']) ? $data['business_license'] : '';
    $companyCity = isset($data['company_city']) ? $data['company_city'] : '';
    $companyZip = isset($data['company_zip']) ? $data['company_zip'] : '';
    $companyCountry = isset($data['company_country']) ? $data['company_country'] : '';
    $companylogo = isset($data['company_logo']) ? uploadFile($data['company_logo']) : '';


    $email = isset($data['usermail']) ? trim($data['usermail']) : '';
    $password = isset($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : '';

    if($userid = addUser(array(
        'email' => $email,
        'password' => $password,
        'gender' => $gender,
        'role' => BTRS_ROLE_BUS_MANAGER,
        'validate' => BTRS_VALIDATION,
        'registered' => date('Y-m-d H:i:s')
    )))
    {
        if(addUserDetails(array(
            array($userid, 'firstName', $fname),
            array($userid, 'lastName', $lname),
            array($userid, 'birthDate', $dob),
            array($userid, 'maritalStatus', $marital),
            array($userid, 'nidPassport', $nidpassport),
            array($userid, 'photograph', $photograph),
            array($userid, 'street', $street),
            array($userid, 'mobile', $mobile),
            array($userid, 'city', $city),
            array($userid, 'zip', $zip),
            array($userid, 'country', $country),
            array($userid, 'companyName', $companyName),
            array($userid, 'companyStreet', $companyStreet),
            array($userid, 'companyLicense', $companyLicense),
            array($userid, 'companyCity', $companyCity),
            array($userid, 'companyZip', $companyZip),
            array($userid, 'companyCountry', $companyCountry),
            array($userid, 'companyLogo', $companylogo)
        )))
        {
            return true;
        }
    }

    return false;
}

function getUserPhotograph($userid, $default)
{
    if(!empty($photograph = getUserDetails($userid, 'photograph')))
    {
        return BTRS_UPLOAD_URI . $photograph;
    }

    return $default;
}

function decodeGender($gender)
{
    $genders = array('m'=>'Male', 'f'=>'Female');
    return isset($genders[$gender]) ? $genders[$gender] : '';
}
