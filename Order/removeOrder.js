
function callRemoveOrder(order_id)
{
    var conf= confirm("You requested to remove order number " + order_id + ". Are you sure of that?");
    if (conf == true)
    {
        removeOrder(order_id);
    }
}

function removeOrder(order_id)
{
    var xhr = new XMLHttpRequest();
    var url= 'http://yaniv.isa-geek.net/CouponShop/Order/removeOrder.php';
    var parm = "order_id=" + order_id;

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && xhr.status == 200)
		{
			var data = JSON.parse(xhr.responseText);

            if (data == true)
            {
                alert("Operation completed, the order has been removed.");
                location.reload();

            }
            else
            {
                alert("Operation failed, please try again later.");
            }
		}
	}
	xhr.send(parm);
}
