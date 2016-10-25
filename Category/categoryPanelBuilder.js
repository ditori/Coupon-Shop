function printCategoryList ()
{
	var xhr = new XMLHttpRequest();
    xhr.open("GET","http://yaniv.isa-geek.net/CouponShop/Category/PostCategorys.php",true);
	xhr.onreadystatechange = function()
	{
		if (xhr.readyState == 4 && xhr.status == 200)
		{
			var data = JSON.parse(xhr.responseText);

			data.forEach(function (ob)
				{
					var li = document.createElement('li');
					var a = document.createElement('a');
					a.setAttribute('href', 'http://yaniv.isa-geek.net/CouponShop/Category/category-page.php?id=' + ob.category_id);
					a.appendChild(document.createTextNode(ob.name));
					li.appendChild(a);
					document.getElementById('categorys').appendChild(li);
				}
			);
		}
	}
	xhr.send();
}
