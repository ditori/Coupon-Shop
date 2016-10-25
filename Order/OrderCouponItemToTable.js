function orderCouponItemToTable (coupon_id, coupon_name, price, bussiness_name, image_src, quantity)
{
    var tr= document.createElement("tr");

    var icon= $("<img></img>").attr("name", "icon").attr("src", image_src).attr("height", "250").attr("width", "250");
    addToTable(tr, icon.get(0));

    var name = $("<a></a>").text(coupon_name).attr("name", "coupon-name").attr("href", "http://yaniv.isa-geek.net/CouponShop/Coupon/coupon-page.php?id=" + coupon_id);
    addToTable(tr, name.get(0));

    var bus_spn = $("<span></span>").text(bussiness_name).attr("name", "bussiness-name");
    addToTable(tr, bus_spn.get(0));

    var price_spn = $("<span></span>").text(price).attr("name", "price");
    addToTable(tr, price_spn.get(0));

    var qnt_spn = $("<span></span>").text(quantity).attr("name", "quantity");
    addToTable(tr, qnt_spn.get(0));

    var total= parseInt(price) * parseInt(quantity);
    var total_spn = $("<span></span>").text(total).attr("name", "total price");
    addToTable(tr, total_spn.get(0));

    $("#order-coupons-table").append(tr);
}
