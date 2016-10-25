function updateCouponInCart (user_id, coupon_id, quantity)
{
    var xhr = new XMLHttpRequest();
    var url= 'http://yaniv.isa-geek.net/CouponShop/Cart/updateCouponInCart.php';
    var parm = "user_id=" + user_id; // getting cookie id
    parm = parm + "&coupon_id=" + coupon_id;
    parm = parm + "&quantity=" + quantity;

    if (docCookies.getItem("yaniv-isa-geek-userid")==null)
    {
        alert("Please login to your user account in order to use our shopping cart.");
        return;
    }

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && xhr.status == 200)
		{
			var data = JSON.parse(xhr.responseText);

            if (data == null)
            {
                alert("Could not update this coupon in your cart.");
            }
            else
            {
                updateTotalPrice();
            }
		}
	}
	xhr.send(parm);
}
