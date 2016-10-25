function createNewOrder ()
{
    var user_id= docCookies.getItem("yaniv-isa-geek-userid");
    var total_price = document.getElementById('cart-total-price').innerText;

    $.ajax({
        url: 'http://yaniv.isa-geek.net/CouponShop/Order/createNewOrder.php',
        type: 'POST',
        data: {"user_id" : user_id, "total_price": total_price},
        success: function(data)
        {
            if (data!=null)
            {
                createNewOrderCoupons(user_id, data);
            }
            else
            {
                alert("there is a problem creating new order, please try again later.");
            }
        }
    });
}

function createNewOrderCoupons(user_id, order_id)
{
    $.ajax({
        url: 'http://yaniv.isa-geek.net/CouponShop/Order/createNewOrderCoupons.php',
        type: 'POST',
        data: {"user_id" : user_id, "order_id": order_id},
        success: function(data)
        {
            if (data!=null)
            {
                alert("order number " + order_id + " was successfully created.");
                emptyCart(user_id);
                window.location.href="http://yaniv.isa-geek.net/CouponShop/home.html";
            }
            else
            {
                alert("new order was created, but there was a problem adding coupons, so the order will be removed.");
                removeOrder(order_id);
                window.location.href="http://yaniv.isa-geek.net/CouponShop/home.html";
            }
        }
    });
}
