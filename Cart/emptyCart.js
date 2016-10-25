function emptyCart (user_id)
{
    $.ajax({
        url: 'http://yaniv.isa-geek.net/CouponShop/Cart/emptyCart.php',
        type: 'POST',
        data: {"user_id" : user_id},
        success: function(data)
        {
            if (data!=true)
            {
                alert("there was a problem empty your cart, please try later empty it manually.");
            }
        }
    });
}
