
function removeSelectedCoupons()
{
    var flag= 0;
    document.getElementsByName('checkbox').forEach(function (ele)
    {
        if (ele.checked==true)
        {
            flag++;
            removeCouponFromCart(docCookies.getItem("yaniv-isa-geek-userid"), ele.id);
        }
    });

    if (flag==0)
    {
        alert("Please select coupon in order to remove it from the cart.");
    }
}

function removeCouponFromCart(user_id, coupon_id)
{
    var xhr = new XMLHttpRequest();
    var url= 'http://yaniv.isa-geek.net/CouponShop/Cart/removeCouponFromCart.php';
    var parm = "user_id=" + user_id; // getting cookie id
    parm = parm + "&coupon_id=" + coupon_id;

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
                alert("Could not remove coupon from your cart.");
            }
            else
            {
                location.reload();
            }
		}
	}
	xhr.send(parm);
}
