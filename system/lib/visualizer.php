<?php

function __visualize(array $data=array())
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>BTRS<?= isset($data['title']) ? ' - '.$data['title'] : '' ?> </title>
        <link rel="stylesheet" href="assets/css/styles.css">
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
                            <img src="assets/img/demo_profile_pic_large.png" class="icon" alt="userimg" width="36px" height="36px">
                            <b class="username">Rashed Islam</b>
                            <span class="caret"></span>
                        </div>
                        <div class="content">
                            <div class="userdetails">
                                <div class="userimage">
                                    <img src="assets/img/demo_profile_pic_large.png" alt="user">
                                </div>
                                <div class="usertext">
                                    <h4>Rashed Islam</h4>
                                    <p class="text-muted"> hedmid420@gmail.com</p>
                                    <a href="profile.php">View Profile</a>
                                </div>
                            </div>
                            <div class="separator"></div>
                            <div class="menu">
                                <a href="#home">Home</a>
                                <a href="#about">About</a>
                                <a href="#contact">Contact</a>
                            </div>
                            <div class="separator"></div>
                            <div class="menu">
                                <a href="logout.php">Logout</a>
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

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelector('.preloader').classList.add('hidden');
                document.querySelector('.drop .toggle').addEventListener('click', function(e){
                    this.parentNode.classList.toggle("open");
                });

                window.onclick = function(e) {
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
                    height = height<1 ? 1 : height;

                    if(height > offset) {
                        document.querySelector('.system .wrapper').style = 'min-height: '+height+'px;';
                    }
                };

                resizeWrapper();

                if(window.attachEvent) {
                    window.attachEvent('onresize', resizeWrapper);
                } else if(window.addEventListener) {
                    window.addEventListener('resize', resizeWrapper);
                }
            });
        </script>
    </body>
    </html>
    <?php
}