<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Coupon Page</title>
		<script src="http://yaniv.isa-geek.net/CouponShop/JSFilesLibery.js" type="text/javascript"></script>
		<?php
			require '../ServerConnection.php';

			$cpn_id= $_GET["id"];

			$cpn= $cpn_dao->getCoupon($cpn_id);
			$imgs_arr= $img_dao->getImagesByCouponId($cpn_id);
			$bus= $bus_dao->getBussiness($cpn->getBussinessId());
			$ctg= $ctg_dao->getCategory($cpn->getCategory());
		?>
	</head>
	<body>
		<div id="navbar"></div><br><br>
		<input type="hidden" id="cpn-id" value="<?php echo $cpn->getId();	?>">

		<script  type='text/javascript'>
			var cpn_id= document.getElementById("cpn-id").value;
			buildNavBar();
			couponImagesCarouselBuilder(cpn_id);
		</script>

		<div class='jumbotron'>

			<div id='coupon-images-carousel' class='carousel slide' data-ride="carousel">
				<ol id='crsl-list' class='carousel-indicators'>
				</ol>
				<div id='crsl-inner' class='carousel-inner'></div>
				<a class="left carousel-control" href="#coupon-images-carousel" role="button" data-slide="prev">
	    			<span class="icon-prev" aria-hidden="true"></span>
	    			<span class="sr-only">Previous</span>
	  			</a>
				<a class="right carousel-control" href="#coupon-images-carousel" role="button" data-slide="next">
					<span class="icon-next" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>

			<div class="container text-center">
				<h2 id='<?php echo "coupon_".$cpn_id; ?>'><?php echo $cpn->getName(); ?></h2><br>

				<input type="hidden" id="coupon-id" value='<?php echo $cpn_id; ?>'>
				<input type="number" value="1" id="quantity" maxlength="2">
				<button type="button" class="btn btn-primary" onclick="addToCart()">Add To Cart</button><br>

				<span><?php echo "new price:" . $cpn->getNewPrice(); ?></span>
				<del><?php echo "normal price: " . $cpn->getNormalPrice(); ?></del><br><br>
				<span><?php echo 'category: ' . $ctg->getName(); ?></span><br>
				<span><?php echo 'Seller: ' . $bus->getName(); ?></span><br><br>
				<p><?php echo $cpn->getDescription(); ?></p>

			</div>

		</div>
	</body>
	<footer>

	</footer>
</html>
