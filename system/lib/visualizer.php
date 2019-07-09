<?php

function __visualize(array $data=array())
{
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title><?= isset($data['title']) ? $data['title'] : '' ?> </title>
        <link rel="stylesheet" href="assets/css/styles.css">
	</head>
	<body>
		<table width="100%" height="800px" border="0" cellspacing="0" cellpadding="20">
			<tr height="10px" bgcolor="#42A22E">
				<td colspan="2">
					<table border="0" cellpadding="0" width="100%">
						<tr>
							<td width="70%">
								<img src="assets/img/logo-bus-white.png" height="25px" width="25x"> <font color="white" face="verdana" size="6"><b> TICKET RESERV. SYSTEM</b></font>
							</td>
							<td align="right">
								<?= !isset($data['area']) || ( isset($data['area']) && $data['area']!='profile' ) ? '<a href="profile.php">' : '' ?>
								<table border="0" cellspacing="5" cellpadding="0" bgcolor="<?= isset($data['area']) && $data['area']=='profile' ? '#88C480' : '#55A74C' ?>">
									<tr>
										<td width="42px" rowspan="2">
											<img src="assets/img/demo_profile_pic.png" alt="[+]" height="42px" width="42px">
										</td>
										<td valign="bottom">
											<font face="Arial" color="#000000"><b><?= htmlspecialchars(isset($data['user']) ? $data['user'] : '') ?></b></font>
										</td>
									</tr>
									<tr>
										<td valign="top">
											<font face="Arial" size="2" color="#000000"><b><?= htmlspecialchars(isset($data['usermail']) ? $data['usermail'] : '') ?></b></font>
										</td>
									</tr>
								</table>
								<?= !isset($data['area']) || ( isset($data['area']) && $data['area']!='profile' ) ? '</a>' : '' ?>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td rowspan="2" width="270px" bgcolor="#2F3640" valign="top">
					<?= __renderMenu('index', (isset($data['area']) ? $data['area'] : ''), 'index.php', 'Dashboard') ?><hr/>
					<?= __renderMenu('supportstaff', (isset($data['area']) ? $data['area'] : ''), 'supportstaff.php', 'Support Staff') ?><hr/>
					<?= __renderMenu('busmanager', (isset($data['area']) ? $data['area'] : ''), 'busmanager.php', 'Bus Manager') ?><hr/>
					<?= __renderMenu('buscounter', (isset($data['area']) ? $data['area'] : ''), 'buscounter.php', 'Bus Counter') ?><hr/>
					<?= __renderMenu('counterstaff', (isset($data['area']) ? $data['area'] : ''), 'counterstaff.php', 'Counter Staff') ?><hr/>
					<?= __renderMenu('managebus', (isset($data['area']) ? $data['area'] : ''), 'managebus.php', 'Manage Bus') ?><hr/>
					<?= __renderMenu('busschedule', (isset($data['area']) ? $data['area'] : ''), 'busschedule.php', 'Bus Schedule') ?><hr/>
					<?= __renderMenu('tickets', (isset($data['area']) ? $data['area'] : ''), 'tickets.php', 'Tickets') ?><hr/>
					<?= __renderMenu('discount', (isset($data['area']) ? $data['area'] : ''), 'discount.php', 'Promotional Discount') ?><hr/>
					<?= __renderMenu('transaction', (isset($data['area']) ? $data['area'] : ''), 'transaction.php', 'Transactions') ?><hr/>
					<?= __renderMenu('paymethod', (isset($data['area']) ? $data['area'] : ''), 'paymethod.php', 'Payment Method') ?><hr/>
					<?= __renderMenu('supportticket', (isset($data['area']) ? $data['area'] : ''), 'supportticket.php', 'Support Tickets') ?><hr/>
					<?= __renderMenu('settings', (isset($data['area']) ? $data['area'] : ''), 'settings.php', 'General Settings') ?><hr/>
					<?= __renderMenu('logout', (isset($data['area']) ? $data['area'] : ''), 'logout.php', 'Logout') ?>
				</td>
				<td bgcolor="#e6e6e6" valign="top">
					<?= isset($data['data']) ? $data['data'] : '' ?>
				</td>
			</tr>
			<tr height="80px" bgcolor="#C7CBD1">
				<td>
					<table width="100%">
						<tr>
							<td>
								<font face="verdana">© <?= date('Y') ?> BTRS - All Rights Reserved</font>
							</td>
							<td width="50%" align="right">
								<font face="verdana">Developed By <b>M. Rashedul Islam</b></font>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</body>
	</html>
	<?php
}