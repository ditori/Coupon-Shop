function getCouponsImages(coupon_id)
{
	var xhr = new XMLHttpRequest();
	var parm= "coupon_id=" + coupon_id;
	var url= 'http://yaniv.isa-geek.net/CouponShop/Image/getCouponImages.php';
	xhr.open("POST", url, false);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && xhr.status == 200)
		{
			var data = JSON.parse(xhr.responseText);

			return data;
		}
	}
	xhr.send(parm);
}
