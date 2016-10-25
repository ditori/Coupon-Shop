<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Coupon Page</title>
		<script src="http://yaniv.isa-geek.net/CouponShop/JSFilesLibery.js" type="text/javascript"></script>
		<?php
			require  __DIR__ . '/../ServerConnection.php';

			$ctg_id= $_GET["id"];
			$ctg= $ctg_dao->getCategory($ctg_id);
		?>
	</head>
	<body>
		<div id="navbar"></div><br><br>
		<h1><?php echo $ctg->getName(); ?></h1><br>
		<div id='list'></div>

		<div id="category_id" style="display: none;"><?php echo $ctg_id ?></div>

		<script  type='text/javascript'>
			buildNavBar();
			var id= document.getElementById("category_id").innerText;
			GetCoupons('Category/PostCategoryCoupons.php?id=' + id);
		</script>
	</body>
	<footer>

	</footer>
</html>
