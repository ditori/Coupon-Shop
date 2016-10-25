function GetCoupons (parm)
{
	var url= "http://yaniv.isa-geek.net/CouponShop/" + parm;
	var xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && xhr.status == 200)
		{
			var data = JSON.parse(xhr.responseText);

			data.forEach(function (ob)
			{
				var list = document.getElementById('list');

				//creating coupon div
				var div = document.createElement('div');
				div.setAttribute('class', 'col-xs-12 col-sm-6 col-md-3 col-lg-2');

				//createing thumbnail element
				var thm = document.createElement('div');
				thm.setAttribute('class', 'thumbnail');
				thm.setAttribute('id', ob.coupon_id);

				// ######## image element to the thumbail ############
				var img= document.createElement('img');
				setImagesSource(ob.coupon_id, img);
				var lnk= document.createElement('a');
				lnk.setAttribute('href', 'http://yaniv.isa-geek.net/CouponShop/Coupon/coupon-page.php?id=' + ob.coupon_id);
				lnk.appendChild(img);
				thm.appendChild(lnk);
				// ######## image element to the thumbail end ############

				//adding coupon name
				var name_el= document.createElement('h3');
				var name = document.createElement('a');
				name.appendChild(document.createTextNode(ob.coupon_name));
				name.setAttribute('href', 'http://yaniv.isa-geek.net/CouponShop/Coupon/coupon-page.php?id=' + ob.coupon_id);
				name_el.appendChild(name);

				//adding new price
				var new_price= document.createElement('h4');
				new_price.appendChild(document.createTextNode('price: ' + ob.new_price));

				//adding description
				var desc= document.createElement('p');
				desc.appendChild(document.createTextNode(ob.description));

				//createing caption element
				var cap = document.createElement('div');
				cap.setAttribute('class', 'caption');
				cap.appendChild(name_el);
				cap.appendChild(new_price);
				cap.appendChild(desc);

				// combaining all
				div.appendChild(thm);
				div.appendChild(cap);
				list.appendChild(div);
			});
		}
	}
	xhr.send();
}

function setImagesSource(coupon_id, element)
{
	var xhr = new XMLHttpRequest();
	var parm= "coupon_id=" + coupon_id;
	var url= 'http://yaniv.isa-geek.net/CouponShop/Image/getCouponImages.php';
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && xhr.status == 200)
		{
			var data = JSON.parse(xhr.responseText);

			element.setAttribute("src", data[0].source);
		}
	}
	xhr.send(parm);
}
