function orderItemToTable (order_id, status, date, total)
{
    var tr= document.createElement("tr");

    var id= $("<a></a>").text(order_id).attr("name", "order-id").attr("href", "http://yaniv.isa-geek.net/CouponShop/Order/Order-Coupons.php?id=" + order_id);
    addToTable(tr, id.get(0));

    var stat = $("<span></span>").text(status).attr("name", "status");
    addToTable(tr, stat.get(0));

    var dat = $("<span></span>").text(date).attr("name", "date");
    addToTable(tr, dat.get(0));

    var tot = $("<span></span>").text(total).attr("name", "total-price");
    addToTable(tr, tot.get(0));

    var cancel = $("<button></buttonn>").text("Cancel Order " + order_id).attr("name", "cancel").attr("tupe", "button");
    if (status == "pending")
    {
        cancel.attr("class", "btn btn-danger");
        cancel.attr("onclick", "callRemoveOrder(" + order_id + ")");
    }
    else
    {
        cancel.attr("disabled", true);
    }
    addToTable(tr, cancel.get(0));

    $("#orders-table").append(tr);
}
