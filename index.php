<?php
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

require_once 'system/lib/function.php';

ob_start();
?>
    <!-- PAGE CONTENT GOES HERE -->
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
    <div class="tickets-step">
        <div class="step-find">
            <div class="step-thumb">
                <img src="assets/img/search_thumb.jpg">
            </div>
            <div class="step-description">
                <h3>Search</h3>
                Choose your origin, destination, journey dates and search for buses
            </div>
        </div>
        <div class="step-book">
            <div class="step-thumb">
                <img src="assets/img/bus_thumb.jpg">
            </div>
            <div class="step-description">
                <h3>Select</h3>
                Select your desired trip and choose your seats
            </div>
        </div>
        <div class="step-pay">
            <div class="step-thumb">
                <img src="assets/img/payment_thumb.jpg">
            </div>
            <div class="step-description">
                <h3>Pay</h3>
                Pay for the tickets via allowed payment methods
            </div>
        </div>
    </div>
    <div class="ticket-promise">
        <div>
            <img src="assets/img/lock.png"> Safe and Secure online payments
        </div>
        <div>
            <img src="assets/img/home.png"> Cash on Delivery available
        </div>
    </div>
    </div>
    <div class="stripe">
    <div class="block">
        <h2 class="system-facts">SOME FACTS</h2>
        <div class="system-facts">
            <div>
                <img src="assets/img/ticket.png" width="160px" height="160px">
                <h2>5,000+</h2>
                <h3>TICKETS AVAILABLE PER DAY</h3>
            </div>
            <div>
                <img src="assets/img/customer.png" width="160px" height="160px">
                <h2>70,000+</h2>
                <h3>HAPPY CUSTOMERS</h3>
            </div>
            <div>
                <img src="assets/img/coverage.png" width="160px" height="160px">
                <h2>30+</h2>
                <h3>DISTRICTS COVERED</h3>
            </div>
        </div>
    </div>
    </div>
    <div class="common">
    <div class="block">
        <h2>AVAILABLE BUS OPERATORS</h2>
        <div class="list">
            <div>
                <ul><li>AK Travels</li><li>Aqib Enterprise</li><li>Bablu Enterprise </li><li>Bappy Enterprise </li><li>Barkat Travels </li><li>Desh Travels </li><li>Dhaka Express </li><li>Dolphin Chair Coach Service </li><li>Econo Service </li><li>Falguni Modhumoti PVT LTD </li><li>Falguni Paribahan </li></ul>
            </div>
            <div>
                <ul><li>AK Travels</li><li>Aqib Enterprise</li><li>Bablu Enterprise </li><li>Bappy Enterprise </li><li>Barkat Travels </li><li>Desh Travels </li><li>Dhaka Express </li><li>Dolphin Chair Coach Service </li><li>Econo Service </li><li>Falguni Modhumoti PVT LTD </li><li>Falguni Paribahan </li></ul>
            </div>
            <div>
                <ul><li>AK Travels</li><li>Aqib Enterprise</li><li>Bablu Enterprise </li><li>Bappy Enterprise </li><li>Barkat Travels </li><li>Desh Travels </li><li>Dhaka Express </li><li>Dolphin Chair Coach Service </li><li>Econo Service </li><li>Falguni Modhumoti PVT LTD </li><li>Falguni Paribahan </li></ul>
            </div>
            <div>
                <ul><li>AK Travels</li><li>Aqib Enterprise</li><li>Bablu Enterprise </li><li>Bappy Enterprise </li><li>Barkat Travels </li><li>Desh Travels </li><li>Dhaka Express </li><li>Dolphin Chair Coach Service </li><li>Econo Service </li><li>Falguni Modhumoti PVT LTD </li><li>Falguni Paribahan </li></ul>
            </div>
        </div>
    </div>
    <div class="block">
        <h2>POPULAR BUS ROUTES</h2>
        <div class="list">
            <div>
                <ul class="route"><li><a>DHAKA - CHITTAGONG</a></li><li><a>DHAKA - COX'S BAZAR</a></li><li><a>DHAKA - KHAGRACHHARI</a></li><li><a>DHAKA - RANGAMATI</a></li><li><a>DHAKA - BANDARBAN</a></li><li><a>DHAKA - KOLKATA</a></li><li><a>DHAKA - SILIGURI</a></li><li><a>DHAKA - CHAPAINABABGANJ</a></li><li><a>DHAKA - RAJSHAHI</a></li><li><a>DHAKA - BARGUNA</a></li><li><a>DHAKA - BARISAL</a></li><li><a>DHAKA - KUAKATA</a></li></ul>
            </div>
            <div>
                <ul class="route"><li><a>DHAKA - CHITTAGONG</a></li><li><a>DHAKA - COX'S BAZAR</a></li><li><a>DHAKA - KHAGRACHHARI</a></li><li><a>DHAKA - RANGAMATI</a></li><li><a>DHAKA - BANDARBAN</a></li><li><a>DHAKA - KOLKATA</a></li><li><a>DHAKA - SILIGURI</a></li><li><a>DHAKA - CHAPAINABABGANJ</a></li><li><a>DHAKA - RAJSHAHI</a></li><li><a>DHAKA - BARGUNA</a></li><li><a>DHAKA - BARISAL</a></li><li><a>DHAKA - KUAKATA</a></li></ul>
            </div>
            <div>
                <ul class="route"><li><a>DHAKA - CHITTAGONG</a></li><li><a>DHAKA - COX'S BAZAR</a></li><li><a>DHAKA - KHAGRACHHARI</a></li><li><a>DHAKA - RANGAMATI</a></li><li><a>DHAKA - BANDARBAN</a></li><li><a>DHAKA - KOLKATA</a></li><li><a>DHAKA - SILIGURI</a></li><li><a>DHAKA - CHAPAINABABGANJ</a></li><li><a>DHAKA - RAJSHAHI</a></li><li><a>DHAKA - BARGUNA</a></li><li><a>DHAKA - BARISAL</a></li><li><a>DHAKA - KUAKATA</a></li></ul>
            </div>
            <div>
                <ul class="route"><li><a>DHAKA - CHITTAGONG</a></li><li><a>DHAKA - COX'S BAZAR</a></li><li><a>DHAKA - KHAGRACHHARI</a></li><li><a>DHAKA - RANGAMATI</a></li><li><a>DHAKA - BANDARBAN</a></li><li><a>DHAKA - KOLKATA</a></li><li><a>DHAKA - SILIGURI</a></li><li><a>DHAKA - CHAPAINABABGANJ</a></li><li><a>DHAKA - RAJSHAHI</a></li><li><a>DHAKA - BARGUNA</a></li><li><a>DHAKA - BARISAL</a></li><li><a>DHAKA - KUAKATA</a></li></ul>
            </div>
        </div>
    </div>
    </div>

<?php
$content = ob_get_clean();
ob_start();
?>
    <!-- CUSTOM JS GOES HERE -->
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            flatpickr(document.querySelector('input[type="text"][name="departure"]'), {
                altInput: true,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
                minDate: "today"
            });

            __autocomplete(document.querySelector('input[type="text"][name="from"]'), [
                'Bogura', 'Dhaka', 'Dhaka (Kallayanpur)', 'Tangail', 'Sirajganj', 'Rangpur', 'Dinajpur'
            ]);

            __autocomplete(document.querySelector('input[type="text"][name="to"]'), [
                'Bogura', 'Dhaka', 'Dhaka (Kallayanpur)', 'Tangail', 'Sirajganj', 'Rangpur', 'Dinajpur'
            ]);
        });
    </script>
<?php
$javascript = ob_get_clean();
__visualize_fontend(array(
    'data' => $content,
    'javascript' => $javascript
));
