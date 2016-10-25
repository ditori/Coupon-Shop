function addToCart ()
{
    var xhr = new XMLHttpRequest();
    var url= 'http://yaniv.isa-geek.net/CouponShop/Cart/addCouponToCart.php';
    var parm = "user_id=" + docCookies.getItem("yaniv-isa-geek-userid"); // getting cookie id
    parm = parm + "&coupon_id=" + document.getElementById("coupon-id").value;
    parm = parm + "&quantity=" + document.getElementById("quantity").value;

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

            if (data== null)
            {
                alert("Could not add this coupon to your cart.");
            }
            else
            {
                alert("Coupon has been added to your cart!");
                location.reload();
            }
		}
	}
	xhr.send(parm);
}
