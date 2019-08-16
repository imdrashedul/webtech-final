<?php
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

function __visualize_backend(array $data=array())
{
    $fName = htmlspecialchars(getUserDetails($data['user']['id'], 'firstName'));
    $lName = htmlspecialchars(getUserDetails($data['user']['id'], 'lastName'));
    $total = totalUsersByRole(BTRS_ROLE_BUS_MANAGER, 0);
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>BTRS<?= isset($data['title']) ? ' - '.$data['title'] : '' ?> </title>
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/flatpickr.min.css">
        <link rel="shortcut icon" href="assets/img/fav.png" type="image/png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            html {
                position:relative;
                min-height:100%;
                background:#fff;
            }
        </style>
    </head>
    <body>
    <div class="system">
        <!-- SYSTEM HEADER -->
        <nav class="navbar">
            <div class="header">
                <div class="left">
                    <a class="logo" href="">
                        <b><img src="assets/img/logo-white-v2.png" alt="home" height="47px" width="200px"></b>
                    </a>
                </div>
                <div class="right">
                    <div class="usermenu drop">
                        <div class="toggle">
                            <img src="<?= getUserPhotograph($data['user']['id'], 'assets/img/default_avatar.png') ?>" class="icon" alt="userimg" width="36px" height="36px">
                            <b class="username"><?= $fName ?></b>
                            <span class="caret"></span>
                        </div>
                        <div class="content">
                            <div class="userdetails">
                                <div class="userimage">
                                    <img src="<?= getUserPhotograph($data['user']['id'], 'assets/img/default_avatar.png') ?>" alt="user">
                                </div>
                                <div class="usertext">
                                    <h4><?= $fName . ' ' . $lName ?></h4>
                                    <p class="text-muted"><?= htmlspecialchars($data['user']['email']) ?></p>
                                    <a href="profile.php" class="btn target green"><span>View Profile</span></a>
                                </div>
                            </div>
                            <div class="separator"></div>
                            <div class="menu">
                                <a href="validbusmanager.php"><img src="assets/img/validation.png"> Validation<?= $total>0?' <span class="label-validation">'.$total.'</span>' : '' ?></a>
                            </div>
                            <div class="separator"></div>
                            <div class="menu">
                                <a href="logout.php"><img src="assets/img/logout.png"> Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- SYSTEM SIDEBAR -->
        <div class="sidebar" role="navigation">
            <ul class="menu">
                <?= __renderMenu('index', (isset($data['area']) ? $data['area'] : ''), 'index.php', 'Dashboard') ?>
                <?php if(isset($data['validate']) && $data['validate']==true) : ?>
                <li class="divider"></li>
                <?= __renderMenu('supportstaff', (isset($data['area']) ? $data['area'] : ''), 'supportstaff.php', 'Support Staff') ?>
                <?= __renderMenu('busmanager', (isset($data['area']) ? $data['area'] : ''), 'busmanager.php', 'Bus Manager') ?>
                <?= __renderMenu('buscounter', (isset($data['area']) ? $data['area'] : ''), 'buscounter.php', 'Bus Counter') ?>
                <?= __renderMenu('counterstaff', (isset($data['area']) ? $data['area'] : ''), 'counterstaff.php', 'Counter Staff') ?>
                <li class="divider"></li>
                <?= __renderMenu('managebus', (isset($data['area']) ? $data['area'] : ''), 'managebus.php', 'Manage Bus') ?>
                <?= __renderMenu('busschedule', (isset($data['area']) ? $data['area'] : ''), 'busschedule.php', 'Bus Schedule') ?>
                <?= __renderMenu('tickets', (isset($data['area']) ? $data['area'] : ''), 'tickets.php', 'Tickets') ?>
                <li class="divider"></li>
                <?= __renderMenu('discount', (isset($data['area']) ? $data['area'] : ''), 'discount.php', 'Discount') ?>
                <?= __renderMenu('transaction', (isset($data['area']) ? $data['area'] : ''), 'transaction.php', 'Transactions') ?>
                <?= __renderMenu('paymethod', (isset($data['area']) ? $data['area'] : ''), 'paymethod.php', 'Payment Method') ?>
                <?= __renderMenu('supportticket', (isset($data['area']) ? $data['area'] : ''), 'supportticket.php', 'Support Tickets') ?>
                <?= __renderMenu('settings', (isset($data['area']) ? $data['area'] : ''), 'settings.php', 'General Settings') ?>
                <?php endif; ?>
            </ul>
        </div>

        <!-- SYSTEM MAIN -->
        <div class="wrapper" role="application">
            <div class="preloader">
                <svg version="1.0" width="64px" height="64px" viewBox="0 0 128 128">
                    <rect x="0" y="0" width="100%" height="100%" fill="#FFFFFF" /><g><path d="M64 9.75A54.25 54.25 0 0 0 9.75 64H0a64 64 0 0 1 128 0h-9.75A54.25 54.25 0 0 0 64 9.75z" fill="#0d8035" fill-opacity="1"/><animateTransform attributeName="transform" type="rotate" from="0 64 64" to="360 64 64" dur="1800ms" repeatCount="indefinite"></animateTransform></g>
                </svg>
            </div>
            <div class="nav-horizontal">
                <ul class="breadcrumb">
                    <?php if(isset($data['navigate']) && !empty($data['navigate'])) : ?>
                        <?php foreach ($data['navigate'] as $navigator ) : ?>
                            <li><a href="<?= $navigator[0] ?>"><?= $navigator[1] ?></a></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <li><?= isset($data['title']) ? $data['title'] : 'Unknown' ?></li>
                </ul>
            </div>
            <div class="main">
                <?= isset($data['data']) ? $data['data'] : '' ?>
            </div>
        </div>

        <footer class="footer">
            <div class="left"> &#0169; <?= date('Y') ?> BTRS - All Rights Reserved </div>
            <div class="right"> Developed By <b>M. Rashedul Islam</b> </div>
        </footer>
        <script type="text/javascript" src="assets/js/flatpickr.js"></script>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelector('.preloader').classList.add('hidden');
                document.querySelector('.drop .toggle').addEventListener('click', function (e) {
                    this.parentNode.classList.toggle("open");
                });

                window.onclick = function (e) {
                    var dropMenus = document.querySelectorAll('.drop.open');
                    dropMenus.forEach(function (menu) {
                        if (!menu.contains(e.target)) {
                            menu.classList.remove('open');
                        }
                    });
                };

                var resizeWrapper = function () {
                    var offset = 70,
                        height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
                    height -= offset;
                    height = height < 1 ? 1 : height;

                    if (height > offset) {
                        document.querySelector('.system .wrapper').style = 'min-height: ' + height + 'px;';
                    }
                };

                resizeWrapper();

                if (window.attachEvent) {
                    window.attachEvent('onresize', resizeWrapper);
                } else if (window.addEventListener) {
                    window.addEventListener('resize', resizeWrapper);
                }

                flatpickr(document.querySelector('input[type="text"][name="departure"]'), {

                });
            });
        </script>
    </body>
    </html>
    <?php
}

function __visualize_fontend(array $data=array())
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title><?= isset($data['title']) ? ' - '.$data['title'] : 'Bus Ticket Reservation System' ?></title>
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/flatpickr.min.css">
        <link rel="stylesheet" href="assets/css/autocomplete.css">
        <link rel="shortcut icon" href="assets/img/fav.png" type="image/png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
    <div class="general">
        <div class="header">
            <div class="block">
                <img class="logo" src="assets/img/logo-white-v2.png" alt="home" height="47px" width="200px">
                <a href="#">Print/Verify</a>
                <a href="#">Cancel Ticket</a>
                <a href="#">Help</a>
            </div>
        </div>
        <div class="wrapper">
            <?= isset($data['data']) ? $data['data'] : '' ?>
            <div class="payment-methods">
                <div class="block">
                    <h1> WE ACCEPT </h1>
                    <img src="assets/img/method-logo.jpg">
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="block">
                <div>
                    <img src="assets/img/logo-white-v2.png" alt="logo" width="160px" height="38px">
                    <p>BTRS is a premium booking portal which allows you to purchase tickets for various bus services across the country.</p>
                </div>
                <div>
                    <h4>Company Info</h4>
                    <ul>
                        <li>
                            <a href="javascript:void(0)">Terms &amp; Conditions</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">FAQ</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">How To Buy Tickets</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white mb-4">About BTRS</h4>
                    <ul class="pl-0">
                        <li>
                            <a href="javascript:void(0)">About Us</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <footer>&#0169; <?= date('Y') ?> BTRS. All Rights Reserved</footer>
    </div>
    <script type="text/javascript" src="assets/js/flatpickr.js"></script>
    <script type="text/javascript" src="assets/js/autocomplete.js"></script>
    <?= isset($data['javascript']) ? $data['javascript'] : '' ?>
    </body>
    </html>
    <?php
}