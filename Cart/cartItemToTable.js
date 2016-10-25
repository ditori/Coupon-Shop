function cartItemToTable (coupon_id, coupon_name, price, bussiness_name, image_src, quantity)
{
    var table = document.getElementById("cart-table");
    var cpn_url="http://yaniv.isa-geek.net/CouponShop/Coupon/coupon-page.php?id=" + coupon_id;

    // creating new "tr" element to add to the table and giving him an id.
    var tr= document.createElement("tr");
    tr.setAttribute("id", "cpn-" + coupon_id);

    // adding checkbox for operation selection
    var check = document.createElement("div");
    var inpt = document.createElement("input");
    var lbl= document.createElement("label");

    setAttributes(inpt, { "type" : "checkbox", "id" : coupon_id, "name" : "checkbox"});
    setAttributes(check, {"class" : "checkbox"});
    lbl.appendChild(inpt);
    check.appendChild(lbl);
    addToTable(tr, check);

    // creating coupon icon
    var icon= document.createElement("img");
    var attrs = {"name" : "icon", "src" : image_src, "class" : "img-thumbnail",
    "height" : "250", "width": "250"};
    setAttributes(icon, attrs);
    addToTable(tr, icon);

    // creating  coupon name
    var cpn_name = document.createElement("a");
    setAttributes(cpn_name, {"name" : "coupon-name", "href" : cpn_url});
    cpn_name.appendChild(document.createTextNode(coupon_name));
    addToTable(tr, cpn_name);

    // adding bussiness name
    var bus_spn= document.createElement("span");
    setAttributes(bus_spn, {"name" : "bussiness-name"});
    bus_spn.appendChild(document.createTextNode(bussiness_name));
    addToTable(tr, bus_spn);

    // adding price
    var price_spn= document.createElement("span");
    setAttributes(price_spn, {"id" : "price-" + coupon_id});
    price_spn.appendChild(document.createTextNode(price));
    addToTable(tr, price_spn);

    // adding quantity
    var qnt = document.createElement("input");
    setAttributes(qnt, {"type" : "number", "id" : "quantity-" + coupon_id,"value" : quantity, "min" : 1});
    // calling function updateCouponInCart to update when the quantity of a couoon in the cart was changed
    qnt.addEventListener("change", function ()
        {
            updateCouponInCart(docCookies.getItem("yaniv-isa-geek-userid"), coupon_id, qnt.value);
        });

    // add button
    var add_btn = document.createElement("input");
    setAttributes(add_btn, {"type" : "button", "value" : "+"});

    // sub button
    var sub_btn = document.createElement("input");
    setAttributes(sub_btn, {"type" : "button", "value" : "-"});

    // creating holding div
    var qnt_div = document.createElement("div");
    qnt_div.appendChild(add_btn);
    qnt_div.appendChild(qnt);
    qnt_div.appendChild(sub_btn);
    addToTable(tr, qnt_div);

    // adding total price
    var total= parseInt(price) * parseInt(quantity);
    var total_spn= document.createElement("span");
    total_spn.appendChild(document.createTextNode(total));
    setAttributes(total_spn, {"name" : "total", "class" : coupon_id});
    addToTable(tr, total_spn);

    // adding tr to the table
    table.appendChild(tr);

    // adding event listener for add and sub buttons
    add_btn.addEventListener("click", function ()
        {
            qnt.value++;
            updateCouponInCart(docCookies.getItem("yaniv-isa-geek-userid"), coupon_id, qnt.value);
        });
    sub_btn.addEventListener("click", function ()
        {
            if (qnt.value!=1)
            {
                qnt.value--;
                updateCouponInCart(docCookies.getItem("yaniv-isa-geek-userid"), coupon_id, qnt.value);
            }
        });
}
