<?php
/**
 * @author MD. RASHEDUL ISLAM
 * @package Bus Ticket Reservation System
 * @version v2.0
 * @see https://github.com/rashed370/webtech-final
 */

require_once 'system/lib/function.php';
connectDatabase();
$__from = isset($_REQUEST['from']) && !empty($_REQUEST['from']) ? $_REQUEST['from'] : 'Unkown';
$__to = isset($_REQUEST['to']) && !empty($_REQUEST['to']) ? $_REQUEST['to'] : 'Unkown';
$__departure = isset($_REQUEST['departure']) && !empty($_REQUEST['departure']) && __validDate($_REQUEST['departure'], 'Y-m-d') && $_REQUEST['departure']>=date('Y-m-d') ? $_REQUEST['departure'] : date('Y-m-d');


$schedules = getSchedule($__from, $__to, $__departure);

ob_start();
?>
    <!-- PAGE CONTENT GOES HERE -->
    <div class="page-area">
        <div class="block">
            <div class="departure">
                <p><?= htmlspecialchars($__from) ?> - <?= htmlspecialchars($__to) ?> on <?= __formatDate($__departure, 'j F, Y', 'Y-m-d') ?></p>
            </div>
            <div class="bus-lists">
                <form id="SearchForm" action="search.php" method="get">
                    <div>
                        <label for="from">From</label><br>
                        <div style="width: 100%">
                        <input type="text" name="from" id="from" value="<?= htmlspecialchars($__from) ?>">
                        </div>
                    </div>
                    <div>
                        <label for="to">To</label><br>
                        <div style="width: 100%">
                        <input type="text" name="to" id="to" value="<?= htmlspecialchars($__to) ?>">
                        </div>
                    </div>
                    <div>
                        <label for="departure">Date of Journey</label><br>
                        <input type="text" name="departure" id="departure" value="<?= htmlspecialchars($__departure) ?>">
                    </div>
                    <div>
                        <input type="submit" value="Search">
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
                    <?php if(!empty($schedules)) : ?>
                    <?php foreach ($schedules as $schedule) : ?>
                    <?php
                        $bus = getBusById($schedule['busid']);
                        $operator = $bus['manager'];
                    ?>
                    <tr>
                        <td>
                            <span class="operator"><?= htmlspecialchars(getUserDetails($operator, 'companyName')) ?></span>
                            <?= htmlspecialchars($bus['name']) ?>, <?= htmlspecialchars($bus['type']) ?><br>
                            <?= !empty( $schedule['description'] ) ? htmlspecialchars($schedule['description']) : '<br>' ?>
                        </td>
                        <td><?= __formatDate($schedule['departure'], 'h:i A') ?></td>
                        <td><?= __formatDate($schedule['arrival'], 'h:i A') ?></td>
                        <td><?= seatsAvailable($schedule['id'], $bus) ?></td>
                        <td>
                            <span>৳ <?= htmlspecialchars($schedule['fare']) ?></span>
                            <button class="expand-bookings" scheduleid="<?= $schedule['id'] ?>">View Seats</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">
                            No trips found. Please call our call centre @ 10210 and we might arrange the tickets for you.
                        </td>
                    </tr>
                    <?php endif; ?>
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
        var __routes = <?= json_encode(__getRoutesSuggesion()) ?>;
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

                if(e.target.matches('button.expand-bookings') && e.target.hasAttribute('scheduleid'))
                {
                    var parent = e.target.parentNode.parentNode;
                    getPublicBooking(parent, {schedule: e.target.getAttribute('scheduleid')});
                }

                if(e.target.matches('input[type="button"][name="close_area"]'))
                {
                    var parent = e.target.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode;
                    closeBookingArea(parent);
                }
            });

            flatpickr(document.querySelector('input[type="text"][name="departure"]'), {
                altInput: true,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
                minDate: "today"
            });

            __autocomplete(document.querySelector('input[type="text"][name="from"]'), __routes);

            __autocomplete(document.querySelector('input[type="text"][name="to"]'), __routes);
        });
    </script>
<?php
$javascript = ob_get_clean();

disconnectDatabase();
__visualize_fontend(array(
    'data' => $content,
    'javascript' => $javascript
));
