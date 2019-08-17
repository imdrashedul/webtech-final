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
        <b>Add Bus Manager</b>
        <a href="busmanager.php" class="btn back red" title="Cancel"><span>Cancel</span></a>
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
                    <h4 class="block divider left"><span>Contact Information</span></h4>
                    <div class="grid">
                        <div class="row">
                            <div class="column-6">
                                <div class="inputset<?php __errors($errors, 'street', true) ?>">
                                    <label for="street">Street Address</label><br>
                                    <input type="text" name="street" id="street" placeholder="Enter Street Address" value="<?php echo isset($_POST['street']) ? htmlspecialchars($_POST['street']) : '' ?>"><br/>
                                    <?php __errors($errors, 'street') ?>
                                </div>
                            </div>
                            <div class="column-6">
                                <div class="inputset<?php __errors($errors, 'mobile', true) ?>">
                                    <label for="mobile">Mobile Number</label><br>
                                    <input type="text" name="mobile" id="mobile" placeholder="(+88) 0XXXX-XXXXXX" value="<?php echo isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : '' ?>"><br/>
                                    <?php __errors($errors, 'mobile') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column-6">
                                <div class="inputset<?php __errors($errors, 'city', true) ?>">
                                    <label for="city">City</label><br>
                                    <input type="text" name="city" id="city" placeholder="Enter City Name" value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '' ?>"><br/>
                                    <?php __errors($errors, 'city') ?>
                                </div>
                            </div>
                            <div class="column-6">
                                <div class="inputset<?php __errors($errors, 'zip', true) ?>">
                                    <label for="zip">Zip Code</label><br>
                                    <input type="text" name="zip" id="zip" placeholder="Enter Zip/Postal Code" value="<?php echo isset($_POST['zip']) ? htmlspecialchars($_POST['zip']) : '' ?>"><br/>
                                    <?php __errors($errors, 'zip') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column-6">
                                <div class="inputset<?php __errors($errors, 'country', true) ?>" style="padding-right: 10px">
                                    <label for="country">Country</label><br>
                                    <select name="country" id="country" >
                                        <option value="">Select</option>
                                        <option value="bd"<?php __selected("bd", (isset($_POST['country']) ? $_POST['country'] : '')) ?>>Bangladesh</option>
                                    </select><br>
                                    <?php __errors($errors, 'country') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="block divider left"><span>Company Information</span></h4>
                    <div class="grid">
                        <div class="row">
                            <div class="column-6">
                                <div class="inputset<?php __errors($errors, 'company_name', true) ?>">
                                    <label for="company_name">Company Name</label><br>
                                    <input type="text" name="company_name" id="company_name" placeholder="Enter Company Name" value="<?php echo isset($_POST['company_name']) ? htmlspecialchars($_POST['company_name']) : '' ?>"><br/>
                                    <?php __errors($errors, 'company_name') ?>
                                </div>
                            </div>
                            <div class="column-6">
                                <div class="inputset<?php __errors($errors, 'company_street', true) ?>">
                                    <label for="company_street">Street Address</label><br>
                                    <input type="text" name="company_street" id="company_street" placeholder="Enter Compnay Street Address" value="<?php echo isset($_POST['company_street']) ? htmlspecialchars($_POST['company_street']) : '' ?>"><br/>
                                    <?php __errors($errors, 'company_street') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column-6">
                                <div class="inputset<?php __errors($errors, 'business_license', true) ?>">
                                    <label for="business_license">License</label><br>
                                    <input type="text" name="business_license" id="business_license" placeholder="Enter Business/Trade License" value="<?php echo isset($_POST['business_license']) ? htmlspecialchars($_POST['business_license']) : '' ?>"><br/>
                                    <?php __errors($errors, 'business_license') ?>
                                </div>
                            </div>
                            <div class="column-6">
                                <div class="inputset<?php __errors($errors, 'company_city', true) ?>">
                                    <label for="company_city">City</label><br>
                                    <input type="text" name="company_city" id="company_city" placeholder="Enter Company City Name" value="<?php echo isset($_POST['company_city']) ? htmlspecialchars($_POST['company_city']) : '' ?>"><br/>
                                    <?php __errors($errors, 'company_city') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column-6">
                                <div class="inputset<?php __errors($errors, 'company_zip', true) ?>">
                                    <label for="company_zip">Zip Code</label><br>
                                    <input type="text" name="company_zip" id="company_zip" placeholder="Enter Company Zip/Postal Code" value="<?php echo isset($_POST['company_zip']) ? htmlspecialchars($_POST['company_zip']) : '' ?>"><br/>
                                    <?php __errors($errors, 'company_zip') ?>
                                </div>
                            </div>
                            <div class="column-6">
                                <div class="inputset<?php __errors($errors, 'company_country', true) ?>">
                                    <label for="company_country">Country</label><br>
                                    <select name="company_country" id="company_country">
                                        <option value="">Select</option>
                                        <option value="bd"<?php __selected("bd", (isset($_POST['company_country']) ? $_POST['company_country'] : '')) ?>>Bangladesh</option>
                                    </select><br>
                                    <?php __errors($errors, 'company_country') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column-6">
                                <div class="inputset<?php __errors($errors, 'company_logo', true) ?>">
                                    <label for="company_logo">Logo</label><br>
                                    <div class="grid">
                                        <div class="row">
                                            <div class="column-3">
                                                <img class="upload-preview company_logo m-t-5" src="assets/img/logo_avatar.png" width="80px" height="80px" defaultpreview="assets/img/logo_avatar.png">
                                            </div>
                                            <div class="column-9" style="padding-right: 10px; vertical-align: top">
                                                <input type="text" class="upload-name company_logo" value="" readonly style="margin-top: 9px">
                                                <button type="button" class="file-clear company_logo" filetarget="company_logo">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="174.239" height="174.239" viewBox="0 0 174.239 174.239">
                                                        <path d="M146.537,1.047c-1.396-1.396-3.681-1.396-5.077,0L89.658,52.849c-1.396,1.396-3.681,1.396-5.077,0L32.78,1.047 c-1.396-1.396-3.681-1.396-5.077,0L1.047,27.702c-1.396,1.396-1.396,3.681,0,5.077l51.802,51.802c1.396,1.396,1.396,3.681,0,5.077L1.047,141.46c-1.396,1.396-1.396,3.681,0,5.077l26.655,26.655c1.396,1.396,3.681,1.396,5.077,0l51.802-51.802c1.396-1.396,3.681-1.396,5.077,0l51.801,51.801c1.396,1.396,3.681,1.396,5.077,0l26.655-26.655c1.396-1.396,1.396-3.681,0-5.077l-51.801-51.801c-1.396-1.396-1.396-3.681,0-5.077l51.801-51.801c1.396-1.396,1.396-3.681,0-5.077L146.537,1.047z"/>
                                                    </svg>
                                                    Clear
                                                </button>
                                                <label class="file-input company_logo">
                                                    <input type="file" accept="image/jpeg,image/png,image/gif" id="company_logo" name="company_logo">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512">
                                                        <path d="M480,80h-96c-17.688,0-32,14.313-32,32H96v32h288h88.969l-43.094,215.5L384,176H0l64,256h384l64-320l0,0C512,94.313,497.688,80,480,80z"/>
                                                    </svg>
                                                    <span class="m-l-5">Browse..</span>
                                                </label>
                                            </div>
                                        </div>
                                        <?php if(isset($errors['company_logo'])) : ?>
                                        <div class="row">
                                            <div class="column-3"></div>
                                            <div class="column-9">
                                                <?php __errors($errors, 'company_logo') ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="block divider left"><span>Login Information</span></h4>
                    <div class="grid">
                        <div class="row">
                            <div class="column-12">
                                <div class="inputset<?php __errors($errors, 'usermail', true) ?>">
                                    <label for="usermail">Email Address</label><br>
                                    <input type="email" name="usermail" id="usermail" placeholder="Enter email address" value="<?php echo isset($_POST['usermail']) ? htmlspecialchars($_POST['usermail']) : '' ?>"><br/>
                                    <?php __errors($errors, 'usermail') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="row">
                            <div class="column-6">
                                <div class="inputset<?php __errors($errors, 'password', true) ?>">
                                    <label for="password">Password</label><br>
                                    <input type="password" name="password" id="password"><br/>
                                    <?php __errors($errors, 'password') ?>
                                </div>
                            </div>
                            <div class="column-6">
                                <div class="inputset<?php __errors($errors, 'repassword', true) ?>">
                                    <label for="repassword">Confirm Password</label><br>
                                    <input type="password" name="repassword" id="repassword"><br/>
                                    <?php __errors($errors, 'repassword') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Add Manager">
                
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
document.addEventListener('DOMContentLoaded', function() {
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
});
</script>
<?php
$script = ob_get_clean();
__visualize_backend(array(
	'title' => 'Add Bus Manager',
	'area' => 'busmanager',
    'navigate'=> array(array('busmanager.php', 'Bus Managers')),
	'data' => $content,
    'user' => $user,
    'validate' => $validate,
	'javascript' => $script
));
disconnectDatabase();