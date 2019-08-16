<?php 
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

require_once 'lib/function.php';

connectDatabase();

// Check For Authorization Positive

if(!($token = getSessionCookie()) || !verifyLogin($token, true))
{
    header('location: login.php');
    die();
}

$user = getUserBySession($token);
$validate = isset($user['id']) ? isValidUser($user['id']) : false;

ob_start();
?>

<div class="block">
    <div class="header">
        <b>S: vehicula risus. Nulla eget metus.</b>
        <a href="supportticket.php" class="btn target red" title="Close Ticket"><span>Close</span></a>
    </div>
    <div class="body">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="52px" valign="top" rowspan="2">
                        <img src="assets/img/default_avatar.png" alt="[+]" width="42px" height="42px">
                    </td>
                    <td valign="bottom">
                        <font face="Arial"><b>Thane Hooper</b></font>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <font face="Arial" size="2">lacus.Etiam.bibendum@sodales.org</font><br>
                        <font face="Arial" size="2">4 Mar 2019</font>
                    </td>
                </tr>
            </table>
            <hr>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam iaculis dui a massa efficitur, non lobortis ligula blandit. Sed risus arcu, bibendum a vehicula ac, lobortis a justo. Duis facilisis id augue ut aliquam. Proin eget dui neque. Curabitur ac orci finibus, ultricies ligula vitae, consectetur leo. Integer hendrerit nulla ipsum, et finibus augue pharetra condimentum. Vivamus maximus bibendum mauris suscipit ultrices. Mauris a euismod risus. Nulla imperdiet finibus accumsan. Proin eget enim non lectus vehicula faucibus. Vestibulum non aliquet neque, nec aliquet sapien. Nullam ac leo ut justo laoreet fermentum at et urna. Praesent id bibendum neque, eget tincidunt eros. Proin non lorem nunc. Fusce commodo a dolor sed laoreet. Sed interdum lacus quam, ac bibendum sem viverra sed.
            </p>
            <p>
                Etiam eget dolor semper lacus tincidunt commodo quis at quam. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum tristique orci at lectus mattis, ut imperdiet dolor iaculis. Phasellus massa tortor, consequat vel orci id, hendrerit vestibulum mauris. Donec suscipit luctus felis, vitae vestibulum nulla dignissim vel. Vestibulum magna libero, tincidunt vel sodales non, scelerisque ac augue. Ut neque arcu, mollis vitae dolor et, pretium tempus lorem.
            </p>
            <p>
                Morbi in tellus id turpis dictum molestie at non odio. Duis aliquam nisi sit amet sapien consectetur, vitae cursus diam luctus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc a dignissim purus, sed mollis sapien. Nam volutpat aliquet ipsum, vel sollicitudin nisi iaculis nec. Proin at sem euismod, egestas metus a, rhoncus ligula.
            </p>
            <img src="assets/img/paper-clip.png" alt="[+]" ><a href="#">attached_reference.pdf</a>
            <br>
            <br>
            <br>
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="52px" valign="top" rowspan="2">
                        <img src="assets/img/demo_profile_pic.png" alt="[+]" width="42px" height="42px">
                    </td>
                    <td valign="bottom">
                        <font face="Arial"><b>MD. RASHEDUL ISLAM</b></font>
                    </td>
                </tr>
                <tr>
                    <td valign="top">
                        <font face="Arial" size="2">Admin</font> &#183;
                        <font face="Arial" size="2">5 Mar 2019</font>
                    </td>
                </tr>
            </table>
            <hr>
            <p>
                Fusce consectetur dignissim elementum. Sed eget fringilla nibh. Pellentesque vel leo a velit vulputate imperdiet quis eget mi. Curabitur at mi ornare, vulputate risus et, blandit nisi. Proin feugiat sem in massa auctor, sed sagittis ex aliquet. Vestibulum fringilla facilisis lorem, eu congue nulla dignissim non. Fusce pulvinar augue quam, sed cursus sem tempus eu. Etiam est arcu, facilisis id tincidunt et, vestibulum sed nisi. Sed molestie congue lacus vel hendrerit. Donec tristique ipsum id est maximus, vitae lobortis ipsum porta.
            </p>
            <br><hr>
            <labe for="replay"><b>Replay:</b></labe><br>
            <textarea name="replay" id="replay" rows="4" cols="80"></textarea><br>
            <input type="submit" name="submit" value="Replay">
    </div>
</div>

<?php
$content = ob_get_clean();


__visualize_backend(array(
	'title' => 'View Support Ticket',
	'area' => 'supportticket',
	'navigate' => array(array('supportticket.php', 'Support Ticket')),
	'data' => $content,
    'user' => $user,
    'validate' => $validate
));
disconnectDatabase();
