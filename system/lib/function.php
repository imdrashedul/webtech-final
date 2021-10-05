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

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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

function __validDate($date, $format="Y-m-d H:i:s")
{
    $dObject = DateTime::createFromFormat($format, $date);
    return $dObject && $dObject->format($format) === $date;
}

function __getRoutesSuggesion()
{
    $default = array(
        'Dhaka', 'Bogura', 'Rangpur', 'Dinajpur', 'Thakurgaon', 'Satkhira', 'Hili', 'Bandarban', 'Rangamati', 'Kushtia', 'Panchagor',
        'Cox\'s Bazar', 'Chittagong', 'Teknaf', 'Gaibandha', 'Nilphamari', 'Khulna', 'Noagaon', 'Feni', 'Khagrachari', 'Rajshahi',
        'Jhenaidah', 'Kurigram', 'Darshana', 'Chapai Nawabganj', 'Sylhet', 'Moulvibazar', 'Nazir Hat', 'Brahmanbaria', 'Joypurhat', 'Gopalganj',
        'Barisal', 'Sreemangal', 'Jessore'
    );

    $routes = getBusRoutes();

    foreach ($routes as $route)
    {
        $r = explode('-', $route);

        if(isset($r[0]))
        {
            $f = ltrim($r[0]);
            $f = rtrim($f);
            $f = ucwords($f);
            if(!in_array($f, $default)) $default[] = $f;
        }

        if(isset($r[1]))
        {
            $t = ltrim($r[1]);
            $t = rtrim($t);
            $t = ucwords($t);
            if(!in_array($t, $default)) $default[] = $t;
        }
    }

    return $default;
}

// __DIR__ to URL Converter
function getUrlDir($dir)
{
    $dir = str_replace('\\', '/', $dir);
    $dir = str_replace($_SERVER["DOCUMENT_ROOT"], '', $dir);
    return attachDomain(rtrim($dir, '/') . '/');
}

function attachDomain($path)
{
    $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}";
    return $url .'/'. ltrim($path, '/');
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

	return '';
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
function registerCompany(array $data, $force=false)
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
        'validate' => $force ? 1 : BTRS_VALIDATION,
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

// Counter Staff Registration Service Provider
function registerCounterStaff(array $data)
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

    //Official Information
    $counter = isset($data['bus_counter']) ? $data['bus_counter'] : 0;

    // Login Information
    $email = isset($data['usermail']) ? trim($data['usermail']) : '';
    $password = isset($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : '';

    if($userid = addUser(array(
        'email' => $email,
        'password' => $password,
        'gender' => $gender,
        'role' => BTRS_ROLE_COUNTER_STAFF,
        'validate' => 1,
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
            array($userid, 'busCounter', $counter)
        )))
        {
            return true;
        }
    }

    return false;
}

// Support Staff Registration Service Provider
function registerSupportStaff(array $data)
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

    //Official Information
    $hourlyRate = isset($data['hourlyrate']) ? $data['hourlyrate'] : 0;
    $activeHours = isset($data['activehours']) ? $data['activehours'] : 0;

    // Login Information
    $email = isset($data['usermail']) ? trim($data['usermail']) : '';
    $password = isset($data['password']) ? password_hash($data['password'], PASSWORD_DEFAULT) : '';

    if($userid = addUser(array(
        'email' => $email,
        'password' => $password,
        'gender' => $gender,
        'role' => BTRS_ROLE_SUPPORT_STAFF,
        'validate' => 1,
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
            array($userid, 'hourlyRate', $hourlyRate),
            array($userid, 'activeHours', $activeHours),
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

function getPaginationInfo($current=1, $items=1, $perpage=10)
{
    $items = (int) $items;
    $end = $perpage*$current;
    $start = ($end-$perpage)+1;
    $end = $end>$items || $items<$end ? $items:$end;
    $info = '<span class="pagination">';
    $info .= 'Showing ';
    $info .= $items>0 ? ( $end==$items && $current==1 ? $end:$start ) : 0;
    $info .= $end!=$items || $current!=1 ? ' to '.$end:'';
    $info .= ' of '.$items.' entries';
    $info .= '</span>';

    return $info;
}

function getPagination($current=1, $items=1, $link='', $perpage=10, $limit=6 )
{

    $pagination = '<div class="pagination">';
    $total = $perpage>0 && $items>$perpage? ceil($items/$perpage):1;
    $current = $current>$total?$total:$current;
    $link = (empty($link) ? attachDomain($_SERVER['PHP_SELF']) . '?page=' : $link);
    $start = 1;
    $end = $total;

    if($total>$limit && $items>0)
    {
        if($current>$limit)
        {
            $start = ceil($current/$limit)*$limit;
            $start = $current>$start?$start:($start-$limit);
            $end = $start+$limit;

            if($end>$total)
            {
                $start = $total-$limit;
                $end = $total;
            }
            else if ($end==$current)
            {
                $start++;
                $end++;
            }
        }
        else
        {
            $end = $limit+1;
        }
    }

    $pagination .= '<a href="'.($current>1?$link.($current-1):'javascript:void(0)').'"'.(!($current>1) || !($items>0) ? ' class="disabled"':'').'>Previous</a>';

    if($items>0)
    {
        foreach (range($start, $end) as $page)
        {
            $pagination .= '<a href="'.($current==$page?'javascript:void(0)':$link.$page).'"'.($current==$page ? ' class="active"':'').'>'.$page.'</a>';
        }
    }


    $pagination .= '<a href="'.($current<$total && $items>0 ?$link.($current+1):'javascript:void(0)').'"'.(!($current<$total) || !($items>0) ? ' class="disabled"':'').'>Next</a>';
    $pagination .= '</div>';

    return $pagination;
}

function addAlert(array $alert, $key = "")
{
    if(!isset($_SESSION[SESSION_ALERT]))
    {
        $_SESSION[SESSION_ALERT] = array();
    }

    if(!empty($key))
    {
        if(!isset($_SESSION[SESSION_ALERT][$key]))
        {
            $_SESSION[SESSION_ALERT][$key] = array();
        }

        $_SESSION[SESSION_ALERT][$key][] = $alert;
    }
    else
    {
        if(!isset($_SESSION[SESSION_ALERT]['__GLOBAL__']))
        {
            $_SESSION[SESSION_ALERT]['__GLOBAL__'] = array();
        }

        $_SESSION[SESSION_ALERT]['__GLOBAL__'][] = $alert;
    }

}

function flushAlert($key = "")
{
    if(isset($_SESSION[SESSION_ALERT]) && is_array($_SESSION[SESSION_ALERT]) && !empty($_SESSION[SESSION_ALERT]))
    {
        if( isset($_SESSION[SESSION_ALERT]['__GLOBAL__']) && is_array($_SESSION[SESSION_ALERT]['__GLOBAL__']))
        {
            foreach ($_SESSION[SESSION_ALERT]['__GLOBAL__'] as $alert)
            {
                if(is_array($alert))
                {
                    renderAlert($alert);
                }
            }
            unset($_SESSION[SESSION_ALERT]['__GLOBAL__']);
        }

        if(!empty($key))
        {
            if( isset($_SESSION[SESSION_ALERT][$key]) && is_array($_SESSION[SESSION_ALERT][$key]))
            {
                foreach ($_SESSION[SESSION_ALERT][$key] as $alert)
                {
                    if(is_array($alert))
                    {
                        renderAlert($alert);
                    }
                }
                unset($_SESSION[SESSION_ALERT][$key]);
            }
        }

        if(isset($_SESSION[SESSION_ALERT]) && empty($_SESSION[SESSION_ALERT])) unset($_SESSION[SESSION_ALERT]);
    }
}

function renderAlert(array $alert)
{
    if(isset($alert['m']) && isset($alert['t']))
    {
        $id = '__acl' . md5(time());
        ?>
        <div class="alert <?= $alert['t'] ?>" id="<?= $id ?>">
            <?= htmlspecialchars($alert['m']) ?>
            <?php if(isset($alert['a'])) : ?>
            <script>
                setTimeout(function(){ document.getElementById('<?= $id ?>').remove() }, 6000);
            </script>
            <?php endif; ?>
        </div>
        <?php
    }
}

function listBusCompany($selected="")
{
    $users = getUsersByRole(BTRS_ROLE_BUS_MANAGER, 0, totalUsersByRole(BTRS_ROLE_BUS_MANAGER));

    $list = "";

    foreach ($users as $user)
    {
        $list .= '<option value="'.$user['id'].'"'.(__selected($user['id'], $selected, 'select', false)?' selected':'').'>'.htmlspecialchars(getUserDetails($user['id'], 'companyName') ) . '</option>';
    }

    return $list;
}

function listBusCounters($manager, $selected="")
{
    $counters = getBusCounters(0, totalBusCounters($manager), $manager);

    $list = "";

    foreach ($counters as $counter)
    {
        $list .= '<option value="'.$counter['id'].'"'.(__selected($counter['id'], $selected, 'select', false)?' selected':'').'>'.htmlspecialchars( $counter['name'] ) . '</option>';
    }

    return $list;
}

function listBuses($manager, $selected="")
{
    $buses = getBuses(0, totalBuses($manager), $manager);

    $list = "";

    foreach ($buses as $bus)
    {
        $list .= '<option value="'.$bus['id'].'"'.(__selected($bus['id'], $selected, 'select', false)?' selected':'').'>'.htmlspecialchars( $bus['name'] .' ['.$bus['registration'].']') . '</option>';
    }

    return $list;
}

function accessController($role, ...$allowed)
{
    return in_array($role, $allowed);
}

function validScheduleSlot($departure, $arrival)
{
    if($departure<$arrival)
    {
        $departure = new DateTime($departure);
        $arrival = new DateTime($arrival);
        $interval = $departure->diff($arrival);
        return $interval->h >= 1 || $interval->d >= 1;
    }

    return false;
}

function seatsAvailable($schedule, array $bus)
{
    $booked = getBookedSeatsBySchedule($schedule);
    $total = $bus['seats_row']*$bus['seats_column']+$bus['fill_last_row'];

    return $total - count($booked);
}

function getAvailableSeats(array $schedule, $all = false)
{
    removeExpiredBooking();

    $available = array();

    $bus = getBusById($schedule['busid']);
    $booked = getBookedSeatsBySchedule($schedule['id']);

    $col = $bus['seats_column'];
    $row = $bus['seats_row'];
    $lastfill = $bus['fill_last_row'];
    $nCol = $col + $lastfill;
    $pattern = "ABCDE";


    for ($i=0; $i<$nCol; $i++)
    {
        $letCol = $pattern[$i];
        $range = range(1, $row);

        foreach ($range as $curr)
        {
            switch ($col) {
                case 3 :
                    if(!($i==1 && $lastfill==1 && $curr!=$row) && ($all || !in_array($letCol.$curr, $booked)) && !in_array($letCol.$curr, $available))
                    {
                        $available[] = $letCol.$curr;
                    }
                    break;
                case 4 :
                    if(!($i==2 && $lastfill==1 && $curr!=$row) && ($all || !in_array($letCol.$curr, $booked)) && !in_array($letCol.$curr, $available))
                    {
                        $available[] = $letCol.$curr;
                    }
                    break;
            }
        }
    }

    return $available;
}

function generateBusLayout(array $bus, array $booked)
{
    removeExpiredBooking();
    $col = $bus['seats_column'];
    $row = $bus['seats_row'];
    $lastfill = $bus['fill_last_row'];
    $nCol = $col + $lastfill;
    $pattern = "ABCDE";
    $seats = array();

    for ($i=0; $i<$nCol; $i++)
    {
        $letCol = $pattern[$i];
        $colSeats = array();
        $range = range(1, $row);

        foreach ($range as $curr)
        {
            $data = array();
            switch ($col) {
                case 3 :
                    if($i==1 && $lastfill==1 && $curr!=$row)
                    {
                        $data['t'] = '';
                        $data['b'] = true;
                        $data['d'] = false;
                    }
                    else
                    {
                        $data['t'] = $letCol.$curr;
                        $data['b'] = in_array($letCol.$curr, $booked) ? true : false;
                        $data['d'] = true;
                    }
                    break;
                case 4 :
                    if($i==2 && $lastfill==1 && $curr!=$row)
                    {
                        $data['t'] = '';
                        $data['b'] = true;
                        $data['d'] = false;
                    }
                    else
                    {
                        $data['t'] = $letCol.$curr;
                        $data['b'] = in_array($letCol.$curr, $booked) ? true : false;
                        $data['d'] = true;
                    }
                    break;
            }
            if(!empty($data))
            {
                $colSeats[] = $data;
            }
        }
        if(!empty($colSeats))
        {
            $seats[$letCol] = $colSeats;
        }
    }

    $totalcol = count($seats);
    $blocks = array();

    if($totalcol==3)
    {
        for ($i=0; $i<$row; $i++)
        {
            $blocks[$pattern[0]][$i][] = $seats[$pattern[0]][$i];
            $blocks[$pattern[1].$pattern[2]][$i][] = $seats[$pattern[1]][$i];
            $blocks[$pattern[1].$pattern[2]][$i][] = $seats[$pattern[2]][$i];
        }
    }
    else if($totalcol>3)
    {
        for ($i=0; $i<$row; $i++)
        {
            $blocks[$pattern[0].$pattern[1]][$i][] = $seats[$pattern[0]][$i];
            $blocks[$pattern[0].$pattern[1]][$i][] = $seats[$pattern[1]][$i];

            $nOther = "";

            for ($k=2; $k<$totalcol; $k++)
            {
                $nOther .= $pattern[$k];
            }

            if(!empty($nOther))
            {
                for ($k=2; $k<$totalcol; $k++)
                {
                    $blocks[$nOther][$i][] = $seats[$pattern[$k]][$i];
                }
            }
        }
    }

    ob_start();
    $totalBlocks = count($blocks);
    $currBlock = 1;
    ?>
    <div class="bus-layout">
        <div class="stearing"></div>
        <div class="seats">
            <?php ?>
            <div>
            <?php foreach ($blocks as $block) :?>
                <?php foreach ($block as $bRow) : ?>
                    <?php $totalSeatinBlock = count($bRow); $currSeatinBlock = 1; ?>
                    <?php foreach($bRow as $bSeat) :?>
                    <span title="<?= !empty($bSeat['t']) ? $bSeat['t']:'' ?>"<?= !$bSeat['d'] ? ' style="visibility:hidden"':'' ?><?= $bSeat['b'] ? ' class="booked"':'' ?>></span>
                    <?php if($currSeatinBlock++==$totalSeatinBlock) : ?>
                    <br>
                    <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            <?php if($currBlock++<$totalBlocks) : ?>
            </div>
            <div<?= $lastfill!=1 && $col<5 ? ' style="margin-left:30px"':'' ?>>
            <?php endif; ?>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

function listPaymentMethod($selected="")
{
    $methods = getPayMethod( 0, totalPayMethod());

    $list = "";

    foreach ($methods as $method)
    {
        $list .= '<option value="'.$method['id'].'"'.(__selected($method['id'], $selected, 'select', false)?' selected':'').'>'.htmlspecialchars( $method['method'] ) . '</option>';
    }

    return $list;
}

function verifyAvailableSeats(array $seats, array $schedule)
{
    $return = array();
    $available = getAvailableSeats($schedule);

    foreach ($seats as $seat) {
        if(!in_array($seat, $available))
        {
            $return[$seat] = false;

        }
    }
    return empty($return);
}

function bookTemporaryTicket(array $seats, array $schedule)
{
    $fare = count($seats)*$schedule['fare'];
    $temporary = date('Y-m-d H:i:s', time()+1800);
    if($booking = addBooking(array(
        'schedule' => $schedule['id'],
        'total_fare' => $fare,
        'status' => 'temporary',
        'temp' => $temporary,
        'booked' => date('Y-m-d H:i:s')
    )))
    {
        $seatBooked = 0;

        foreach ($seats as $seat) {
            if(addSeatBooking($booking, $seat)) $seatBooked++;
        }

        if($seatBooked==count($seats))
        {
            return $booking;
        }
    }

    return false;
}

function setTemporaryBooking($booking)
{
    $_SESSION[SESSION_TEMP_BOOKING] = $booking;
}

function clearTemporaryBooking()
{
    if(isset($_SESSION[SESSION_TEMP_BOOKING]))
    {
        unset($_SESSION[SESSION_TEMP_BOOKING]);
    }
}

function getTemporaryBooking()
{
    if(isset($_SESSION[SESSION_TEMP_BOOKING]))
    {
        return $_SESSION[SESSION_TEMP_BOOKING];
    }

    return null;
}
