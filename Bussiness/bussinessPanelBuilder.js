function printBussinessList ()
{
	var xhr = new XMLHttpRequest();
    xhr.open("GET","http://yaniv.isa-geek.net/CouponShop/Bussiness/PostBussiness.php",true);
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && xhr.status == 200)
		{
			var data = JSON.parse(xhr.responseText);

			data.forEach(function (ob)
				{
					var li = document.createElement('li');
					var a = document.createElement('a');
					a.setAttribute('href', 'http://yaniv.isa-geek.net/CouponShop/Bussiness/bussiness-page.php?id=' + ob.bussiness_id);
					a.appendChild(document.createTextNode(ob.name));
					li.appendChild(a);
					document.getElementById('bussiness').appendChild(li);
				}
			);
		}
	}
	xhr.send();
}
