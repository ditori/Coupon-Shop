<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Coupon Page</title>
		<script src="http://yaniv.isa-geek.net/CouponShop/JSFilesLibery.js" type="text/javascript"></script>
		<?php
			require  __DIR__ . '/../ServerConnection.php';

			$bus_id= $_GET["id"];
			$bus= $bus_dao->getBussiness($bus_id);
		?>
	</head>
	<body>
		<div id="navbar"></div><br><br>
		<h1><?php echo $bus->getName(); ?></h1><br>
		<div id='list'></div>

		<div id="bussines_id" style="display: none;"><?php echo $bus_id ?></div>

		<script  type='text/javascript'>
			buildNavBar();
			var id= document.getElementById("bussines_id").innerText;
			GetCoupons('Bussiness/PostBussinessCoupons.php?id=' + id);
		</script>
	</body>
	<footer>

	</footer>
</html>
