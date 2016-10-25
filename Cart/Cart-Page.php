<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>User's Cart Page</title>
		<script src="http://yaniv.isa-geek.net/CouponShop/JSFilesLibery.js" type="text/javascript"></script>
		<?php
			require  __DIR__ .'/../ServerConnection.php';
		?>

		<script type="text/javascript">
			function changeCheckBoxes (val)
			{
				document.getElementById("check-all").checked= val;
				document.getElementsByName('checkbox').forEach(function (ele)
				{
					ele.checked= val;
				});
			}
			function updateTotalPrice ()
			{
				var sum = 0;
				document.getElementsByName("total").forEach(function (ele)
				{
					var coupon_id = ele.classList[0];
					var price = parseInt( document.getElementById("price-" + coupon_id).innerHTML );
					var quantity = parseInt( document.getElementById("quantity-" + coupon_id).value );
					ele.innerHTML = price * quantity;
					sum += price * quantity;
				});

				document.getElementById('cart-total-price').innerHTML= sum;
			}
		</script>

	</head>
	<body>
		<div id="navbar"></div><br><br>

		<script  type='text/javascript'>
			buildNavBar();
		</script>

		<div class="panel panel-info">
			<div class="panel-heading text-center"><h1>Your Cart</h1></div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>
									<div class="checkbox">
										<label><input type="checkbox" id="check-all" onclick="changeCheckBoxes(document.getElementById('check-all').checked)">Select for all</label>
										</script>
									</div>
								</th>
								<th>icon</th>
								<th>Coupon</th>
								<th>Sold By</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody id="cart-table">
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer panel-primary">
				<div class="row">
					<div class="col-sm-4">
						<button id="select-all" class="btn btn-success btn-md" onclick="changeCheckBoxes(true)">Select All</button>
						<button id="deselect-all" class="btn btn-warning btn-md"  onclick="changeCheckBoxes(false)">Deselect All</button>
						<button id="remove-selected" class="btn btn-danger btn-md" onclick="removeSelectedCoupons()">Remove selected from Cart</button>
					</div>
					<div class="col-sm-4 text-center">
						<button id="payment" class="btn btn-primary btn-lg" onclick="createNewOrder()">Proceed to Order</button>
					</div>
					<div class="col-sm-4">
						<h2 class="text-primary text-right">total price: <div id="cart-total-price">0</div></h2>
						<h2>
					</div>
				</div>
			</div>
		</div>


		<?php

			$usr_id= $_COOKIE["yaniv-isa-geek-userid"];

			if ($usr_id!= null)
			{
				echo '<script type="text/javascript">';

				$crt_items= $crt_dao->getCart($usr_id);
				foreach ($crt_items as $item)
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
					echo "cartItemToTable($parm);";
				}

				echo "updateTotalPrice();";
				echo "</script>";
			}

		?>
	</body>
	<footer>

	</footer>
</html>
