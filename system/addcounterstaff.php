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

$errors = array();

$user = getUserBySession($token);
$validate = isset($user['id']) ? isValidUser($user['id']) : false;

if($validate!=true)
{
    header('location: index.php');
    die();
}

ob_start();
?>
<div class="block">
    <div class="header">
        <b>Add Counter Staff</b>
        <a href="counterstaff.php" class="btn back red" title="Cancel"><span>Cancel</span></a>
    </div>
    <div class="body">
        <h4 class="block divider left"><span>Personal Information</span></h4>
        <div class="grid">
            <div class="row">
                <div class="column-6">
                    <div class="inputset<?php __errors($errors, 'first_name', true) ?>">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" placeholder="Enter First Name" value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : '' ?>"><br/>
                        <?php __errors($errors, 'first_name') ?>
                    </div>
                </div>
                <div class="column-6">
                    <div class="inputset<?php __errors($errors, 'last_name', true) ?>">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" placeholder="Enter Last Name" value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : '' ?>"><br/>
                        <?php __errors($errors, 'last_name') ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="column-6">
                    <div class="inputset<?php __errors($errors, 'dob', true) ?>">
                        <label for="dob_day">Date of Birth</label><br>
                        <select name="dob_day" id="dob_day" style="width:30%">
                            <option value=''>Day</option>
                            <?php dmyProvider('day', true, (isset($_POST['dob_day']) ? $_POST['dob_day'] : '')) ?>
                        </select>
                        <select name="dob_month" style="width:40%">
                            <option value=''>Month</option>
                            <?php dmyProvider('month', true, (isset($_POST['dob_month']) ? $_POST['dob_month'] : '')) ?>
                        </select>
                        <select name="dob_year" style="width:26.77%">
                            <option value=''>Year</option>
                            <?php dmyProvider('year', true, (isset($_POST['dob_year']) ? $_POST['dob_year'] : '')) ?>
                        </select>
                        <br><?php __errors($errors, 'dob') ?>
                    </div>
                </div>
                <div class="column-6">
                    <div class="inputset<?php __errors($errors, 'gender', true) ?>">
                        <label for="gender_male">Gender</label><br>
                        <label class="radio m-r-45">
                            <input type="radio" name="gender" id="gender_male" value="m"<?php if(isset($_POST['gender'])) { __selected('m', $_POST['gender'], 'radio'); } ?>> Male
                            <span class="check"></span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="gender" id="gender_female" value="f"<?php if(isset($_POST['gender'])) { __selected('f', $_POST['gender'], 'radio'); } ?>> Female
                            <span class="check"></span>
                        </label>
                        <br>
                        <?php __errors($errors, 'gender') ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="column-6">
                    <div class="inputset<?php __errors($errors, 'marital_status', true) ?>">
                        <label for="marital_status">Marital Status</label><br>
                        <select name="marital_status" id="marital_status">
                            <option value="">Select</option>
                            <option value="Unmarried"<?php __selected("Unmarried", (isset($_POST['marital_status']) ? $_POST['marital_status'] : '')) ?>>Unmarried</option>
                            <option value="Married"<?php __selected("Married", (isset($_POST['marital_status']) ? $_POST['marital_status'] : '')) ?>>Married</option>
                            <option value="Divorced"<?php __selected("Divorced", (isset($_POST['marital_status']) ? $_POST['marital_status'] : '')) ?>>Divorced</option>
                            <option value="Widowed"<?php __selected("Widowed", (isset($_POST['marital_status']) ? $_POST['marital_status'] : '')) ?>>Widowed</option>
                        </select><br>
                        <?php __errors($errors, 'marital_status') ?>
                    </div>
                </div>
                <div class="column-6">
                    <div class="inputset<?php __errors($errors, 'nid_passport', true) ?>">
                        <label for="nid_passport">NID / Passport</label><br>
                        <input type="text" name="nid_passport" id="nid_passport" placeholder="Enter NID or Passport No" value="<?php echo isset($_POST['nid_passport']) ? htmlspecialchars($_POST['nid_passport']) : '' ?>"><br/>
                        <?php __errors($errors, 'nid_passport') ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="column-6">
                    <div class="inputset<?php __errors($errors, 'photograph', true) ?>">
                        <label for="photograph">Photograph</label><br>
                        <div class="grid">
                            <div class="row">
                                <div class="column-3">
                                    <img class="upload-preview photograph m-t-5" src="assets/img/gentelman_avatar.jpg" width="80px" height="80px" defaultpreview="assets/img/gentelman_avatar.jpg">
                                </div>
                                <div class="column-9" style="padding-right: 10px; vertical-align: top">
                                    <input type="text" class="upload-name photograph" value="" readonly style="margin-top: 9px">
                                    <button type="button" class="file-clear photograph" filetarget="photograph">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="174.239" height="174.239" viewBox="0 0 174.239 174.239">
                                            <path d="M146.537,1.047c-1.396-1.396-3.681-1.396-5.077,0L89.658,52.849c-1.396,1.396-3.681,1.396-5.077,0L32.78,1.047 c-1.396-1.396-3.681-1.396-5.077,0L1.047,27.702c-1.396,1.396-1.396,3.681,0,5.077l51.802,51.802c1.396,1.396,1.396,3.681,0,5.077L1.047,141.46c-1.396,1.396-1.396,3.681,0,5.077l26.655,26.655c1.396,1.396,3.681,1.396,5.077,0l51.802-51.802c1.396-1.396,3.681-1.396,5.077,0l51.801,51.801c1.396,1.396,3.681,1.396,5.077,0l26.655-26.655c1.396-1.396,1.396-3.681,0-5.077l-51.801-51.801c-1.396-1.396-1.396-3.681,0-5.077l51.801-51.801c1.396-1.396,1.396-3.681,0-5.077L146.537,1.047z"/>
                                        </svg>
                                        Clear
                                    </button>
                                    <label class="file-input photograph">
                                        <input type="file" accept="image/jpeg,image/png,image/gif" name="photograph" id="photograph">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                            <path d="M480,80h-96c-17.688,0-32,14.313-32,32H96v32h288h88.969l-43.094,215.5L384,176H0l64,256h384l64-320l0,0C512,94.313,497.688,80,480,80z"/>
                                        </svg>
                                        <span class="m-l-5">Browse..</span>
                                    </label>
                                </div>
                            </div>
                            <?php if(isset($errors['photograph'])) : ?>
                                <div class="row">
                                    <div class="column-3"></div>
                                    <div class="column-9">
                                        <?php __errors($errors, 'photograph') ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <font face="Arial" size="2"><b>Contact Information</b></font><hr>
        <table border="0" cellpadding="5" cellspacing="0">
            <tr>
                <td valign="top" align="right">
                    <label for="mobile"><font face="Arial" size="2"><b>Mobile Number</b></font></label>
                </td>
                <td valign="top">
                    <input type="text" name="mobile" id="mobile" placeholder="(+88) 0XXXX-XXXXXX" value="<?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : '' ?>" size="24"><br/>
                    <?php __errors($errors, 'mobile') ?>
                </td>
            </tr>
            <tr>
                <td valign="top" align="right">
                    <label for="street"><font face="Arial" size="2"><b>Street Address</b></font></label>
                </td>
                <td valign="top">
                    <input type="text" name="street" id="street" placeholder="Enter Street Address" value="<?php echo isset($_POST['street']) ? htmlspecialchars($_POST['street']) : '' ?>" size="24"><br/>
                    <?php __errors($errors, 'street') ?>
                </td>
            </tr>
            <tr>
                <td valign="top" align="right">
                    <label for="city"><font face="Arial" size="2"><b>City</b></font></label>
                </td>
                <td valign="top">
                    <input type="text" name="city" id="city" placeholder="Enter City Name" value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '' ?>" size="24"><br/>
                    <?php __errors($errors, 'city') ?>
                </td>
            </tr>
            <tr>
                <td valign="top" align="right">
                    <label for="country"><font face="Arial" size="2"><b>Country</b></font></label>
                </td>
                <td valign="top">
                    <select name="country" id="country">
                        <option value="">Select</option>
                        <option value="Bangladesh"<?php __selected("Bangladesh", (isset($_POST['country']) ? $_POST['country'] : '')) ?>>Bangladesh</option>
                    </select><br>
                    <?php __errors($errors, 'country') ?>
                </td>
            </tr>
            <tr>
                <td valign="top" align="right">
                    <label for="zip"><font face="Arial" size="2"><b>Zip Code</b></font></label>
                </td>
                <td valign="top">
                    <input type="text" name="zip" id="zip" placeholder="Enter Zip/Postal Code" value="<?php echo isset($_POST['zip']) ? htmlspecialchars($_POST['zip']) : '' ?>" size="24"><br/>
                    <?php __errors($errors, 'zip') ?>
                </td>
            </tr>
        </table>
        <br>
        <font face="Arial" size="2"><b>Official Information</b></font><hr>
        <table border="0" cellpadding="5" cellspacing="0">
            <tr>
                <td valign="top" align="right">
                    <label for="bus_manager"><font face="Arial" size="2"><b>Bus Manager</b></font></label>
                </td>
                <td valign="top">
                    <select name="bus_manager" id="bus_manager">
                        <option value="">Select</option>
                        <option value="1"<?php __selected("1", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Thane Hooper</option>
                        <option value="2"<?php __selected("2", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Alvin Vang</option>
                        <option value="3"<?php __selected("3", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Erich Stevens</option>
                        <option value="4"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Brent Mathis</option>
                        <option value="5"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Ferdinand Woods</option>
                        <option value="6"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Gavin Ferrell</option>
                        <option value="7"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Joshua Raymond</option>
                        <option value="8"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Zachary Crosby</option>
                        <option value="9"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Samuel Alston</option>
                        <option value="10"<?php __selected("4", (isset($_POST['bus_manager']) ? $_POST['bus_manager'] : '')) ?>>Basil Noble</option>
                    </select><br>
                    <?php __errors($errors, 'bus_manager') ?>
                </td>
            </tr>
            <tr>
                <td valign="top" align="right">
                    <label for="bus_counter"><font face="Arial" size="2"><b>Counter</b></font></label>
                </td>
                <td valign="top">
                    <select name="bus_counter" id="bus_counter">
                        <option value="">Select</option>
                        <option value="">Kallayanpur Counter</option>
                        <option value="">Gabtoli Counter</option>
                        <option value="">Mohakhali Counter</option>
                        <option value="">Gazipur Counter</option>
                        <option value="">Technical More Counter</option>
                        <option value="">Savar Counter</option>
                    </select><br>
                    <?php __errors($errors, 'bus_counter') ?>
                </td>
            </tr>
        </table>
        <br>
        <font face="Arial" size="2"><b>Login Information</b></font><hr>
        <table border="0" cellpadding="5" cellspacing="0">
            <tr>
                <td valign="top" align="right">
                    <label for="email"><font face="Arial" size="2"><b>Email Address</b></font></label>
                </td>
                <td valign="top">
                    <input type="email" name="email" id="email" placeholder="Enter email address" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" size="24"><br/>
                    <?php __errors($errors, 'email') ?>
                </td>
            </tr>
            <tr>
                <td valign="top" align="right">
                    <label for="password"><font face="Arial" size="2"><b>Password</b></font></label>
                </td>
                <td valign="top">
                    <input type="password" name="password" id="password" size="24"><br/>
                    <?php __errors($errors, 'password') ?>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" value="Add Staff">
                </td>
            </tr>
        </table>
    </div>
</div>
<?php
$content = ob_get_clean();
ob_start();
?>
<script type="text/javascript">
        var fileInput = null,
            imagePreview = null,
            namePreview = null,
            clearInput = null,
            browseBtn = null;

        document.querySelectorAll('.file-input>input[type="file"]').forEach(function (inputField) {

            document.querySelector('img.upload-preview.'+inputField.id).addEventListener('click', function (e) {
                inputField.click();
            });

            inputField.addEventListener('click', function (e) {
                fileInput = this;
                imagePreview = document.querySelector('img.upload-preview.'+this.id);
                namePreview = document.querySelector('input.upload-name.'+this.id);
                clearInput = document.querySelector('button.file-clear.'+this.id);
                browseBtn = document.querySelector('label.file-input.'+this.id);
            });

            inputField.addEventListener('change', function (e) {
                fileHandler(this);
            });

        });

    </script>
<?php
$script = ob_get_clean();
__visualize_backend(array(
	'title' => 'Add Counter Staff',
	'area' => 'counterstaff',
    'navigate' => array(array('counterstaff.php', 'Counter Staffs')),
	'data' => $content,
    'user' => $user,
    'validate' => $validate,
	'javascript' => $script
));

disconnectDatabase();
