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
    <div class="page-area">
        <div class="block">
            <div class="departure">
                <p>Dhaka - Bogra on 27-July, 2019</p>
            </div>
            <div class="bus-lists">
                <form id="SearchForm" action="" method="post">
                    <div>
                        <label for="from">From</label><br>
                        <input type="text" name="from" id="from">
                    </div>
                    <div>
                        <label for="to">To</label><br>
                        <input type="text" name="to" id="to">
                    </div>
                    <div>
                        <label for="departure">Date of Journey</label><br>
                        <input type="text" name="departure" id="departure">
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Search">
                    </div>
                </form>
                <table class="list">
                    <thead>
                    <tr>
                        <th>Operator (Bus Type)</th>
                        <th>Departure</th>
                        <th>Arrival</th>
                        <th>Seats Available</th>
                        <th>Fare</th>
                    </tr>
                    <thead>
                    <tbody>
                    <tr>
                        <td>
                            <span class="operator">S.R Travels (Pvt) Ltd</span>
                            1, AK1J, Non AC<br>
                            Route: Dhaka - Kodda - Sirajganj - Sherpur - Bogra
                        </td>
                        <td>06:30 AM </td>
                        <td>11:30 AM</td>
                        <td>31</td>
                        <td>
                            <span>৳ 350</span>
                            <button>View Seats</button>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <div class="booking-area-title">Choose your seat(s)</div>
                            <div class="booking-area" fare="350">
                                <div>
                                    <div>Hold the cursor on seats for seat numbers, click to select or deselect</div>
                                    <div class="bus-layout">
                                        <div class="stearing"></div>
                                        <div class="seats">
                                            <div>
                                                <span title="A1"></span> <span title="B1"></span><br>
                                                <span class="booked" title="A2"></span> <span class="booked" title="B2"></span><br>
                                                <span title="A3"></span> <span title="B3"></span><br>
                                                <span title="A4"></span> <span title="B4"></span><br>
                                                <span title="A5"></span> <span class="booked" title="B5"></span><br>
                                                <span title="A6"></span> <span title="B6"></span><br>
                                                <span title="A7"></span> <span title="B7"></span><br>
                                                <span class="booked" title="A8"></span> <span title="B8"></span><br>
                                                <span title="A9"></span> <span title="B9"></span><br>
                                                <span title="A10"></span> <span title="B10"></span><br>
                                                <span title="A11"></span> <span title="B11"></span><br>
                                            </div>
                                            <div>
                                                <span title="C1"></span> <span class="booked" title="D1"></span><br>
                                                <span title="C2"></span> <span title="D2"></span><br>
                                                <span title="C3"></span> <span title="D3"></span><br>
                                                <span title="C4"></span> <span title="D4"></span><br>
                                                <span class="booked" title="C5"></span> <span title="D5"></span><br>
                                                <span title="C6"></span> <span title="D6"></span><br>
                                                <span title="C7"></span> <span title="D7"></span><br>
                                                <span title="C8"></span> <span title="D8"></span><br>
                                                <span title="C9"></span> <span title="D9"></span><br>
                                                <span title="C10"></span> <span title="D10"></span><br>
                                                <span title="C11"></span> <span title="D11"></span><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="seats-notation">
                                        <div>
                                            <span class="seat available"></span> Available Seats
                                        </div>
                                        <div>
                                            <span class="seat booked"></span> Booked Seats
                                        </div>
                                        <div>
                                            <span class="seat selected"></span> Selected Seats
                                        </div>
                                    </div>
                                    <div class="selected-seats">
                                        <div>
                                            <table>
                                                <thead>
                                                <tr>
                                                    <th>Seats</th>
                                                    <th>Fare</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="selected-total">
                                        Total: <span>00.00</span>
                                    </div>
                                    <div class="checkout-confirm">
                                        <form action="checkout.php">
                                            <input type="submit" name="submit_checkout" value="Continue">
                                            <input type="button" name="close_area" value="Close">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="operator">Alhamra Paribahan</span>
                            <span class="operator-type">1, Hino 1J Pluss, Non AC<span><br>
                            <span class="small bold">Route:</span> <span class="small"> Dhaka - Bogra - Gobindaganj - Palashbari - Gaibandha</span>
                        </td>
                        <td>07:15 AM </td>
                        <td>03:00 PM</td>
                        <td>26</td>
                        <td>
                            <span>৳ 350</span>
                            <button>View Seats</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
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
            document.addEventListener('click', function (e) {
                var seats = document.querySelectorAll('.booking-area .seats');
                seats.forEach(function (seat) {
                    if (seat.contains(e.target) && e.target.matches('span')) {
                        if(!e.target.classList.contains('booked'))
                        {
                            if(e.target.classList.contains('selected'))
                            {
                                removeSelection(e.target);
                            }
                            else
                            {
                                addSelection(e.target)
                            }
                        }
                    }
                });
            });

            function removeSelection(elem) {
                //elem.classList.remove('selected');
                var parent = elem.parentNode.parentNode.parentNode.parentNode.parentNode;
                var checkoutForm = parent.querySelector('.checkout-confirm>form');
                var checkoutList = parent.querySelector('.selected-seats table tbody tr[seat="'+elem.title+'"]');
                var booked = checkoutForm.querySelector('input[name="checkout_seats[]"][checkout="'+elem.title+'"]');

                if(checkoutList!=null && booked!=null)
                {
                    checkoutList.remove();
                    booked.remove();
                    var checkoutTotal = parent.querySelector('.selected-total span');
                    var fare = parseFloat(parent.getAttribute('fare'));
                    checkoutTotal.textContent = parseFloat(checkoutTotal.textContent) - fare;
                    elem.classList.remove('selected');
                }
            }

            function addSelection(elem) {

                var parent = elem.parentNode.parentNode.parentNode.parentNode.parentNode;
                var checkoutForm = parent.querySelector('.checkout-confirm>form');
                var checkoutList = parent.querySelector('.selected-seats table tbody');
                var checkoutTotal = parent.querySelector('.selected-total span');
                var booked = checkoutForm.querySelectorAll('input[name="checkout_seats[]"]');
                var fare = parseFloat(parent.getAttribute('fare'));
                var total = parseFloat(checkoutTotal.textContent) + fare;

                if(booked.length<4)
                {
                    var input = document.createElement('input');
                    input.setAttribute("name", "checkout_seats[]");
                    input.setAttribute("checkout", elem.title);
                    input.setAttribute("type", "hidden");
                    input.value = elem.title;
                    checkoutForm.prepend(input);

                    var tr = document.createElement('tr');
                    var tdSeat = document.createElement('td');
                    var tdFare = document.createElement('td');
                    var txtSeat = document.createTextNode(elem.title);
                    var txtFare = document.createTextNode(parseFloat(fare).toFixed(2));

                    tr.setAttribute("seat", elem.title);
                    tdSeat.appendChild(txtSeat);
                    tdFare.appendChild(txtFare);

                    tr.appendChild(tdSeat);
                    tr.appendChild(tdFare);

                    checkoutList.appendChild(tr);

                    checkoutTotal.textContent = parseFloat(total).toFixed(2);

                    elem.classList.add('selected');
                }
                else
                {
                    alert('Only 4 Seats can be selected at a time');
                }

            }

            // flatpickr(document.querySelector('input[type="text"][name="departure"]'), {
            //     altInput: true,
            //     altFormat: "j F, Y",
            //     dateFormat: "Y-m-d",
            //     minDate: "today"
            // });
            //
            // __autocomplete(document.querySelector('input[type="text"][name="from"]'), [
            //     'Bogura', 'Dhaka', 'Dhaka (Kallayanpur)', 'Tangail', 'Sirajganj', 'Rangpur', 'Dinajpur'
            // ]);
            //
            // __autocomplete(document.querySelector('input[type="text"][name="to"]'), [
            //     'Bogura', 'Dhaka', 'Dhaka (Kallayanpur)', 'Tangail', 'Sirajganj', 'Rangpur', 'Dinajpur'
            // ]);
        });
    </script>
<?php
$javascript = ob_get_clean();
__visualize_fontend(array(
    'data' => $content,
    'javascript' => $javascript
));
