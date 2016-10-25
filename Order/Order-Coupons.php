<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Order Coupons Page</title>
		<script src="http://yaniv.isa-geek.net/CouponShop/JSFilesLibery.js" type="text/javascript"></script>
		<?php
			require  __DIR__ . '/../ServerConnection.php';
			$order_id= $_GET["id"];
			$order= $ord_dao->getOrder($order_id);
		?>

		<script type="text/javascript">
		</script>

	</head>
	<body>
		<div id="navbar"></div><br><br>

		<script  type='text/javascript'>
			buildNavBar();
		</script>

		<div class="panel panel-info">
			<div class="panel-heading text-center"><h1>Your Order Coupons</h1></div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>icon</th>
								<th>Coupon</th>
								<th>Sold By</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody id="order-coupons-table">
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer panel-primary">
				<h2 class="text-primary text-right pull-right">total price: <?php
					$total= $order->getTotalPrice();
					if ($total != null)
					{
					 	echo $total;
					}
					else
					{
						echo 0;
					}
					?></h2>
			</div>
		</div>


		<?php

			$usr_id= $_COOKIE["yaniv-isa-geek-userid"];
			$order_id= $_GET["id"];
			$order_user= $order->getUserId();

			if ($usr_id != null && $usr_id == $order_user) // if the watching user is the same user that made the order
			{
				echo '<script type="text/javascript">';

				$order_items= $ord_cpn_dao->getOrder($order_id);
				foreach ($order_items as $item)
				{
					$cpn = $cpn_dao->getCoupon($item->getCouponId());

					// getting first image object that belong to the coupon using getImagesByCouponId function and item's coupon_id
					$img = $img_dao->getImagesByCouponId($item->getCouponId())[0];

					// getting bussiness name of the bussiness that sells the coupon in the item
					$bus_name = ($bus_dao->getBussiness($cpn->getBussinessId()))->getName();

					$parm =  $cpn->getId() . ', ';
					$parm = $parm . '"' . $cpn->getName() . '", ';
					$parm = $parm . $cpn->getNewPrice() . ', ';
					$parm = $parm . '"' . $bus_name . '", ';
					$parm = $parm . '"' . $img->getSource() . '", ';
					$parm = $parm . $item->getQuantity();
					echo "orderCouponItemToTable($parm);";
				}

				echo "</script>";
			}
			else
			{
				echo '<script type="text/javascript">';
				echo "alert('you dont have premission to see this order')";
				echo "</script>";
			}

		?>
	</body>
	<footer>

	</footer>
</html>
