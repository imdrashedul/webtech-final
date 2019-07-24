<?php
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Bus Ticket Reservation System</title>
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="stylesheet" href="assets/css/flatpickr.min.css">
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
                <div class="search">
                    <div class="block">
                        <div class="moto">
                            <h1>More Routes, More Tickets</h1>
                            <h2>No. 1 online Ticketing Network</h2>
                        </div>
                        <div class="oval">
                            <form method="post" action="search.php">
                                <div class="inputset" style="width: 27%">
                                    <label for="from">From</label>
                                    <input type="text" name="from" id="from">
                                </div>
                                <div class="inputset" style="width: 27%">
                                    <label for="to">To</label>
                                    <input type="text" name="to" id="to">
                                </div>
                                <div class="inputset" style="width: 27%">
                                    <label for="departure">Date of Journey</label>
                                    <input type="text" name="departure" id="departure">
                                </div>
                                <div class="inputset" style="width: 14.9%">
                                    <input type="submit" name="submit" value="Search">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="helpline">
                        <div class="label">
                            <p>For Telephone booking service</p>
                            <h2>Please Call</h2>
                        </div>
                        <div class="number">
                            <img src="assets/img/call.png" alt="icon">
                            <h2 >10210</h2>
                        </div>
                    </div>
                </div>
                <div class="block face" >
                    <h1>Buy bus tickets in 3 easy steps</h1>
                    <div class="divider"></div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="assets/js/flatpickr.js"></script>
        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', () => {
                flatpickr(document.querySelector('input[type="text"][name="departure"]'), {

                });
            });
        </script>
    </body>
</html>