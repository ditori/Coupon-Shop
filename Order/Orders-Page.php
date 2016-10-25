<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>User's Orders Page</title>
		<script src="http://yaniv.isa-geek.net/CouponShop/JSFilesLibery.js" type="text/javascript"></script>
		<?php
			require  __DIR__ . '/../ServerConnection.php';
		?>

	</head>
	<body>
		<div id="navbar"></div><br><br>

		<script  type='text/javascript'>
			buildNavBar();
		</script>

		<div class="panel panel-info">
			<div class="panel-heading text-center"><h1>Your Orders</h1></div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Order Id</th>
								<th>Status</th>
								<th>Date</th>
								<th>Total Price</th>
								<th>Cancel Order</th>
							</tr>
						</thead>
						<tbody id="orders-table">
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer panel-primary">
			</div>
		</div>


		<?php

			$usr_id= $_COOKIE["yaniv-isa-geek-userid"];

			if ($usr_id!= null)
			{
				echo '<script type="text/javascript">';

				$ord_items= $ord_dao->getAllOrders($usr_id);
				foreach ($ord_items as $item)
				{
					$parm = $item->getOrderId() . ', ';
					$parm = $parm . '"' . $item->getStatus() . '", ';
					$parm = $parm . '"' . $item->getOrderDate() . '", ';
					$parm = $parm . $item->getTotalPrice();
					echo "orderItemToTable($parm);";
				}

				echo "</script><br>";
			}

		?>
	</body>
	<footer>
	</footer>
</html>
